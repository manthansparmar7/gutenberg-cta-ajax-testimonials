<?php

/**
 * Uninstall Gutenberg CTA Ajax Testimonials Plugin.
 *
 * This file is executed when the plugin is deleted.
 * It ensures that all custom post type data related to 'user_testimonials'
 * is removed from the database.
 *
 * @package Gutenberg_Cta_Ajax_Testimonials
 * @since   1.0.0
 */

// Exit if uninstall is not called from WordPress.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Define the custom post type to be deleted.
$post_type = 'user_testimonials';

// Fetch all posts of this CPT.
$testimonials = get_posts(
	array(
		'post_type'      => $post_type,
		'numberposts'    => -1,
		'post_status'    => 'any',
		'fields'         => 'ids',
	)
);

// Loop through each testimonial and delete it.
if ( ! empty( $testimonials ) ) {
	foreach ( $testimonials as $testimonial_id ) {
		wp_delete_post( $testimonial_id, true );
	}
}

// Clean up CPT metadata from the database.
global $wpdb;
$wpdb->query(
	$wpdb->prepare(
		"DELETE FROM {$wpdb->postmeta} WHERE post_id IN (SELECT ID FROM {$wpdb->posts} WHERE post_type = %s)",
		$post_type
	)
);

// Clean up any orphaned term relationships.
$wpdb->query(
	$wpdb->prepare(
		"DELETE FROM {$wpdb->term_relationships} WHERE object_id IN (SELECT ID FROM {$wpdb->posts} WHERE post_type = %s)",
		$post_type
	)
);
