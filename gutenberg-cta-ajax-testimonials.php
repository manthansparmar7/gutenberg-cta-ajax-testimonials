<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://manthansparmar7.com
 * @since             1.0.0
 * @package           Gutenberg_Cta_Ajax_Testimonials
 *
 * @wordpress-plugin
 * Plugin Name:       Gutenberg CTA & AJAX Testimonials
 * Plugin URI:        https://https://manthansparmar7.com
 * Description:       A WordPress plugin that adds a Call to Action block and an AJAX-powered testimonial system.
 * Version:           1.0.0
 * Author:            Manthan Parmar
 * Author URI:        https://https://manthansparmar7.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gutenberg-cta-ajax-testimonials
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GUTENBERG_CTA_AJAX_TESTIMONIALS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gutenberg-cta-ajax-testimonials-activator.php
 */
function activate_gutenberg_cta_ajax_testimonials() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gutenberg-cta-ajax-testimonials-activator.php';
	Gutenberg_Cta_Ajax_Testimonials_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gutenberg-cta-ajax-testimonials-deactivator.php
 */
function deactivate_gutenberg_cta_ajax_testimonials() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gutenberg-cta-ajax-testimonials-deactivator.php';
	Gutenberg_Cta_Ajax_Testimonials_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gutenberg_cta_ajax_testimonials' );
register_deactivation_hook( __FILE__, 'deactivate_gutenberg_cta_ajax_testimonials' );

/**
 * Register Custom Post Type on WordPress init.
 */
function register_testimonials_cpt_on_init() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-gutenberg-cta-ajax-testimonials-activator.php';
    Gutenberg_Cta_Ajax_Testimonials_Activator::register_testimonials_cpt();
}
add_action( 'init', 'register_testimonials_cpt_on_init' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gutenberg-cta-ajax-testimonials.php';

/**
* This file defines a class that registers a shortcode to display 
* a frontend testimonial submission form.
 */
require plugin_dir_path(__FILE__) . 'includes/class-gutenberg-cta-ajax-testimonials-shortcodes.php';

/**
 * This file Handles the enqueueing of scripts and styles for the Gutenberg CTA & AJAX Testimonials plugin.
 *
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-gutenberg-cta-ajax-testimonials-assets.php';

/**
 * This file Handles front-end AJAX requests for submitting testimonials.
 *
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-gutenberg-cta-ajax-testimonials-frontend-ajax.php';

/**
 * This file Handles backend AJAX requests for testimonials listing.
 *
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-gutenberg-cta-ajax-testimonials-backend-ajax.php';

/**
 * This file Handles admin operations.
 *
 */
require_once plugin_dir_path(__FILE__) . 'admin/class-gutenberg-cta-ajax-testimonials-admin.php';

/**
 * This file Handles admin settings.
 *
 */
require_once plugin_dir_path(__FILE__) . 'admin/class-gutenberg-cta-ajax-testimonials-settings.php';

/**
 * Block dependencies.
 *
 */
function gutenberg_cta_block_register() {
    wp_register_script(
        'call-to-action-block',
        plugins_url( 'blocks/call-to-action/build/index.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' ),
        plugin_dir_path( __FILE__ ) . 'blocks/call-to-action/build/index.js'
    );

    wp_register_style(
        'call-to-action-style',
        plugins_url( 'blocks/call-to-action/style.css', __FILE__ ),
        array(),
        plugin_dir_path( __FILE__ ) . 'blocks/call-to-action/style.css'
    );

    wp_register_style(
        'call-to-action-editor-style',
        plugins_url( 'blocks/call-to-action/editor.css', __FILE__ ),
        array( 'wp-edit-blocks' ),
        plugin_dir_path( __FILE__ ) . 'blocks/call-to-action/editor.css'
    );

    register_block_type( 'gutenberg-cta-ajax-testimonials/call-to-action', array(
        'editor_script' => 'call-to-action-block',
        'editor_style'  => 'call-to-action-editor-style',
        'style'         => 'call-to-action-style',
    ));
}
add_action( 'init', 'gutenberg_cta_block_register' );


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gutenberg_cta_ajax_testimonials() {

	$plugin = new Gutenberg_Cta_Ajax_Testimonials();
	$plugin->run();

}
run_gutenberg_cta_ajax_testimonials();