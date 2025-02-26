<?php
/**
 * Frontend Testimonial Submission Form.
 *
 * This template renders the testimonial submission form on the frontend.
 *
 * @package Gutenberg_Cta_Ajax_Testimonials
 * @subpackage Gutenberg_Cta_Ajax_Testimonials/public/partials
 * @author Manthan Parmar
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div id="testimonial-form-wrapper">
    <form id="testimonial-submission-form" enctype="multipart/form-data">
        <!-- Author Name -->
        <label for="testimonial-author"><?php esc_html_e('Author Name', 'gutenberg-cta-ajax-testimonials'); ?></label>
        <input type="text" id="testimonial-author" name="testimonial_author">

        <!-- Testimonial Text -->
        <label for="testimonial-text"><?php esc_html_e('Testimonial', 'gutenberg-cta-ajax-testimonials'); ?></label>
        <textarea id="testimonial-text" name="testimonial_text"></textarea>

        <!-- Image Upload -->
        <label for="testimonial-image"><?php esc_html_e('Upload Image', 'gutenberg-cta-ajax-testimonials'); ?></label>
        <input type="file" id="testimonial-image" name="testimonial_image" accept="image/*">

        <!-- Submit Button -->
        <button type="submit" id="testimonial-submit-button">
            <?php esc_html_e('Submit Testimonial', 'gutenberg-cta-ajax-testimonials'); ?>
        </button>

        <!-- Success/Error Message -->
        <div id="testimonial-response-message"></div>
    </form>
</div>
