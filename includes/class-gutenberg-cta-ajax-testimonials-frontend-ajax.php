<?php
/**
 * Handles AJAX requests for submitting testimonials.
 *
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/includes
 */

class Gutenberg_Cta_Ajax_Testimonials_Ajax {

        /**
         * Register AJAX hooks.
         */
        public function __construct() {
            add_action('wp_ajax_submit_testimonial', array($this, 'handle_testimonial_submission'));
            add_action('wp_ajax_nopriv_submit_testimonial', array($this, 'handle_testimonial_submission')); // Allow non-logged-in users
        }

        /**
         * Handles the AJAX testimonial submission.
         */
        public function handle_testimonial_submission() {
            // Verify nonce for security
            if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gutenberg_cta_testimonials_nonce')) {
                wp_send_json_error(array('message' => 'Security check failed'), 403);
            }

            // Process form data safely
            $author_name      = sanitize_text_field($_POST['testimonial_author']);
            $testimonial_text = sanitize_textarea_field($_POST['testimonial_text']);
        
            // Check if the author name is empty (prevent empty titles)
            if (empty($author_name)) {
                wp_send_json_error(array('message' => 'Author name is required.'));
            }
        
            // Generate a slug from the author name
            $slug = sanitize_title($author_name);
        
            // Ensure unique slug if the same name exists
            $existing_post = get_page_by_path($slug, OBJECT, 'user_testimonials');
            if ($existing_post) {
                $slug .= '-' . wp_generate_password(4, false, false); // Append random 4-character string
            }
        
            // Handle image upload (if applicable)
            $uploaded_file = 0;
            if (!empty($_FILES['testimonial_image']['name'])) {
                $uploaded_file = media_handle_upload('testimonial_image', 0);
                if (is_wp_error($uploaded_file)) {
                    error_log('Image Upload Error: ' . $uploaded_file->get_error_message());
                    wp_send_json_error(array('message' => 'Image upload failed.'));
                }
            }
        
            // Insert into CPT with draft status and proper slug
            $testimonial_post = array(
                'post_title'   => $author_name, // Ensure title is set
                'post_content' => $testimonial_text,
                'post_status'  => 'draft',  // Save as draft first
                'post_type'    => 'user_testimonials',
                'post_name'    => $slug
            );
        
            $post_id = wp_insert_post($testimonial_post);
        
            // Debugging: Check if wp_insert_post() succeeded
            if (is_wp_error($post_id)) {
                error_log('Post Insert Error: ' . $post_id->get_error_message());
                wp_send_json_error(array('message' => 'Failed to save testimonial.'));
            } elseif ($post_id === 0) {
                error_log('Post ID is 0 - Something went wrong');
                wp_send_json_error(array('message' => 'Unexpected error occurred.'));
            } else {
                error_log('Post Inserted Successfully: ' . $post_id);
        
                // If an image is uploaded, attach it to the post
                if ($uploaded_file) {
                    set_post_thumbnail($post_id, $uploaded_file);
                }
        
                wp_send_json_success(array('message' => 'Thank you! Your testimonial has been submitted and is pending review.', 'post_id' => $post_id));
            }
        }
        
}

// Instantiate the class
new Gutenberg_Cta_Ajax_Testimonials_Ajax();