(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

jQuery(document).ready(function ($) {
    $('#testimonial-submission-form').submit(function (e) {
        e.preventDefault(); // Prevent normal form submission

        var form = $(this);
        var messageBox = $('#testimonial-response-message');
        messageBox.hide(); // Hide previous messages

        // Custom Validation
        var authorName = $('#testimonial-author').val().trim();
        var testimonialText = $('#testimonial-text').val().trim();

        if (authorName === '') {
            messageBox.removeClass('success').addClass('error').text("Author name is required.").show();
            return;
        }

        if (testimonialText === '') {
            messageBox.removeClass('success').addClass('error').text("Testimonial text is required.").show();
            return;
        }

        // Prepare Form Data
        var formData = new FormData(this);
        formData.append("action", "submit_testimonial");
        formData.append("nonce", gutenbergCtaTestimonials.nonce); // Security nonce

        $.ajax({
            url: gutenbergCtaTestimonials.ajax_url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    messageBox.removeClass('error').addClass('success').text(response.data.message).show();
                    form.trigger("reset"); // Reset form fields
                } else {
                    messageBox.removeClass('success').addClass('error').text(response.data.message).show();
                }
            },
            error: function () {
                messageBox.removeClass('success').addClass('error').text("Something went wrong!").show();
            }
        });
    });
});


