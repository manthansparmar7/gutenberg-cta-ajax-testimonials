<?php
/**
 * Handles AJAX requests for managing testimonials in the WordPress admin panel.
 *
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/admin
 */

 class Gutenberg_Cta_Ajax_Testimonials_Admin_Ajax {

    /**
     * Register AJAX hooks.
     */
    public function __construct() {
        add_action('wp_ajax_load_testimonials', array($this, 'gcta_ajax_load_testimonials'));
        add_action('wp_ajax_approve_testimonial', array($this, 'gcta_approve_testimonial'));
        add_action('wp_ajax_delete_testimonial', array($this, 'gcta_delete_testimonial'));
    }

    /**
     * Load testimonials via AJAX.
     */
    public function gcta_ajax_load_testimonials() {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        ob_start();
        $this->gcta_load_testimonials($page);
        wp_send_json_success(ob_get_clean());
    }

    /**
     * Approve a testimonial.
     */
    public function gcta_approve_testimonial() {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            wp_update_post(['ID' => $id, 'post_status' => 'publish']);
            wp_send_json_success(['message' => 'Testimonial approved']);
        }
    }

    /**
     * Delete a testimonial permanently.
     */
    public function gcta_delete_testimonial() {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            wp_delete_post($id, true);
            wp_send_json_success(['message' => 'Testimonial deleted']);
        }
    }

    /**
     * Function to load testimonials (placeholder).
     */
    private function gcta_load_testimonials($page) {
        // Implement the logic to fetch and display testimonials here.
        echo "Loading testimonials for page " . esc_html($page);
    }
}

// Initialize the class
new Gutenberg_Cta_Ajax_Testimonials_Admin_Ajax();
