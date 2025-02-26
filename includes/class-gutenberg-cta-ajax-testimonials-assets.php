<?php
/**
 * Handles the enqueueing of scripts and styles for the Gutenberg CTA & AJAX Testimonials plugin.
 *
 * This class ensures that all CSS and JavaScript files are properly loaded
 * for both the frontend, admin dashboard, and Gutenberg blocks.
 *
 * @package Gutenberg_Cta_Ajax_Testimonials
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Gutenberg_Cta_Ajax_Testimonials_Assets
 *
 * Manages the loading of plugin assets (CSS & JS).
 */
class Gutenberg_Cta_Ajax_Testimonials_Assets {

    /**
     * Constructor.
     *
     * Hooks the asset enqueueing methods into WordPress actions.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
        add_action( 'enqueue_block_assets', array( $this, 'enqueue_block_assets' ) ); // ✅ Gutenberg block assets
    }

    /**
     * Enqueue frontend scripts and styles.
     *
     * This function loads styles and scripts required for the front-end functionality,
     * including testimonial form handling via AJAX.
     */
    public function enqueue_frontend_assets() {
        wp_enqueue_style(
            'gutenberg-cta-testimonials-style',
            plugin_dir_url( __FILE__ ) . '../public/css/frontend-style.css',
            array(),
            '1.0.0'
        );

        wp_enqueue_script(
            'gutenberg-cta-testimonials-frontend',
            plugin_dir_url( __FILE__ ) . '../public/js/testimonial-form.js',
            array( 'jquery' ),
            '1.0.0',
            true
        );

        // Pass AJAX URL and nonce for security
        wp_localize_script( 'gutenberg-cta-testimonials-frontend', 'testimonial_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'testimonial_submission' ),
        ) );
    }

    /**
     * Enqueue admin scripts and styles.
     *
     * This function loads scripts and styles specific to the WordPress admin area.
     */
    public function enqueue_admin_assets() {
        wp_enqueue_style(
            'gutenberg-cta-testimonials-admin-style',
            plugin_dir_url( __FILE__ ) . '../admin/css/admin-style.css',
            array(),
            '1.0.0'
        );

        wp_enqueue_script(
            'gutenberg-cta-testimonials-admin-script',
            plugin_dir_url( __FILE__ ) . '../admin/js/admin-script.js',
            array( 'jquery' ),
            '1.0.0',
            true
        );
    }

    /**
     * Enqueue Gutenberg block assets (CSS & JS).
     *
     * Loads the styles and scripts necessary for rendering and editing the custom Gutenberg blocks.
     */
    public function enqueue_block_assets() {
        wp_enqueue_style(
            'gutenberg-cta-testimonials-block-style',
            plugin_dir_url( __FILE__ ) . '../public/css/block-style.css',
            array(),
            '1.0.0'
        );

        wp_enqueue_script(
            'gutenberg-cta-testimonials-block-script',
            plugin_dir_url( __FILE__ ) . '../public/js/block-script.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor' ),
            '1.0.0',
            true
        );
    }
}

// Initialize the asset management class.
new Gutenberg_Cta_Ajax_Testimonials_Assets();