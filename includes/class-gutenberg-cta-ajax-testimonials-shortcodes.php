<?php
/**
 * Shortcode handler for the Testimonial Form.
 *
 * This file defines a class that registers a shortcode to display 
 * a frontend testimonial submission form.
 *
 * @link       https://manthansparmar7.com
 * @since      1.0.0
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/includes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Gutenberg_Cta_Ajax_Testimonials_Shortcodes
 *
 * Handles testimonial form shortcode.
 *
 * @since 1.0.0
 */
class Gutenberg_Cta_Ajax_Testimonials_Shortcodes {

    /**
     * Constructor to initialize the shortcode.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_shortcode( 'testimonial_form', array( $this, 'render_testimonial_form' ) );
    }

    /**
     * Renders the testimonial submission form.
     *
     * This function includes the frontend testimonial form template 
     * located in the `public` folder.
     *
     * @since 1.0.0
     * @return string The output buffer containing the form HTML.
     */
    public function render_testimonial_form() {
        ob_start();

        // Define the form template path.
        $file_path = plugin_dir_path( __FILE__ ) . '../public/frontend-testimonial-form.php';

        // Include the form template if it exists, otherwise show an error message.
        if ( file_exists( $file_path ) ) {
            include $file_path;
        } else {
            echo esc_html__( 'Testimonial form template not found.', 'gutenberg-cta-ajax-testimonials' );
        }

        return ob_get_clean();
    }
}

// Initialize the shortcode class.
new Gutenberg_Cta_Ajax_Testimonials_Shortcodes();
