<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://https://manthansparmar7.com
 * @since      1.0.0
 *
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/includes
 * @author     Manthan Parmar <manthansparmar7@test.com>
 */
class Gutenberg_Cta_Ajax_Testimonials_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
        flush_rewrite_rules(); // Clears permalinks to remove CPT rules.
    }

}
