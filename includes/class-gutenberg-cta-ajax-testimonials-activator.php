<?php

/**
 * Fired during plugin activation
 *
 * @link       https://manthansparmar7.com
 * @since      1.0.0
 *
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/includes
 */

 class Gutenberg_Cta_Ajax_Testimonials_Activator {

    /**
     * Runs on plugin activation.
     *
     * @since 1.0.0
     */
    public static function activate() {
        self::register_testimonials_cpt();
        self::register_blocks();
        flush_rewrite_rules(); // Refresh permalinks
    }

    /**
     * Registers the 'testimonials' Custom Post Type.
     *
     * @since 1.0.0
     */
    public static function register_testimonials_cpt() {
        $labels = array(
            'name'               => __('User Testimonials', 'gutenberg-cta-ajax-testimonials'),
            'singular_name'      => __('User Testimonial', 'gutenberg-cta-ajax-testimonials'),
            'menu_name'          => __('Testimonials', 'gutenberg-cta-ajax-testimonials'),
            'add_new'            => __('Add New', 'gutenberg-cta-ajax-testimonials'),
            'add_new_item'       => __('Add New Testimonial', 'gutenberg-cta-ajax-testimonials'),
            'edit_item'          => __('Edit Testimonial', 'gutenberg-cta-ajax-testimonials'),
            'new_item'           => __('New Testimonial', 'gutenberg-cta-ajax-testimonials'),
            'view_item'          => __('View Testimonial', 'gutenberg-cta-ajax-testimonials'),
            'all_items'          => __('All Testimonials', 'gutenberg-cta-ajax-testimonials'),
            'search_items'       => __('Search Testimonials', 'gutenberg-cta-ajax-testimonials'),
            'not_found'          => __('No testimonials found.', 'gutenberg-cta-ajax-testimonials'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 25,
            'menu_icon'          => 'dashicons-testimonial',
            'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'has_archive'        => true,
            'rewrite'            => array('slug' => 'user_testimonials', 'with_front' => false),
        );

        register_post_type( 'user_testimonials', $args );
    }

    /**
     * Registers the custom Gutenberg block.
     *
     * @since 1.0.0
     */
    public static function register_blocks() {
        register_block_type( 'gutenberg-cta-ajax-testimonials/call-to-action', array(
            'editor_script' => 'call-to-action-block',
            'editor_style'  => 'call-to-action-editor-style',
            'style'         => 'call-to-action-style',
        ));
    }
}

