<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://manthansparmar7.com
 * @since      1.0.0
 *
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/includes
 * @author     Manthan Parmar <manthansparmar7@test.com>
 */
class Gutenberg_Cta_Ajax_Testimonials_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'gutenberg-cta-ajax-testimonials',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
