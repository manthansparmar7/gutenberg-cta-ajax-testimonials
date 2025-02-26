<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://manthansparmar7.com
 * @since      1.0.0
 *
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/public
 * @author     Manthan Parmar <manthansparmar7@test.com>
 */
class Gutenberg_Cta_Ajax_Testimonials_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gutenberg_Cta_Ajax_Testimonials_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gutenberg_Cta_Ajax_Testimonials_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gutenberg-cta-ajax-testimonials-public.css', array(), time(), 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gutenberg_Cta_Ajax_Testimonials_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gutenberg_Cta_Ajax_Testimonials_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gutenberg-cta-ajax-testimonials-public.js', array( 'jquery' ), $this->version, false );
		// Localize script AFTER enqueueing
		wp_localize_script(
			$this->plugin_name,
			'gutenbergCtaTestimonials',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce('gutenberg_cta_testimonials_nonce')
			)
		);
		
	}

}
