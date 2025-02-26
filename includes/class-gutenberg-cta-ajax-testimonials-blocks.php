<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Gutenberg_Cta_Ajax_Testimonials_Blocks
 * Handles block registration for the plugin.
 */
class Gutenberg_Cta_Ajax_Testimonials_Blocks {
    /**
     * Register Gutenberg Block - Call to Action Block
     */
    public static function register_cta_block() {
        // Correctly reference the block script and styles from the blocks folder
        wp_register_script(
            'call-to-action-block',
            plugins_url( 'blocks/call-to-action/build/index.js', __FILE__ ),
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' ),
            plugin_dir_path( __FILE__ ) . '../blocks/call-to-action/build/index.js'  // Use relative path outside the class folder
        );

        // Register frontend style
        wp_register_style(
            'call-to-action-style',
            plugins_url( 'blocks/call-to-action/style.css', __FILE__ ),
            array(),
            plugin_dir_path( __FILE__ ) . '../blocks/call-to-action/style.css'  // Correct path
        );

        // Register editor style
        wp_register_style(
            'call-to-action-editor-style',
            plugins_url( 'blocks/call-to-action/editor.css', __FILE__ ),
            array( 'wp-edit-blocks' ),
            plugin_dir_path( __FILE__ ) . '../blocks/call-to-action/editor.css'  // Correct path
        );

        // Register the block type
        register_block_type( 'gutenberg-cta-ajax-testimonials/call-to-action', array(
            'editor_script' => 'call-to-action-block',
            'editor_style'  => 'call-to-action-editor-style',
            'style'         => 'call-to-action-style',
        ));
    }
}
