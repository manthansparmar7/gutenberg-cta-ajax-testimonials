(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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
	let currentPage = 1;
	
	function loadTestimonials(page) {
		$("#ajax-loader").show();
		$.ajax({
			url: ajaxurl,
			type: "POST",
			data: { action: "load_testimonials", page: page },
			success: function (response) {
				$("#testimonial-list").html(response);
				$("#page-number").text(page);
				currentPage = page;
				$("#ajax-loader").hide();
				
				if ($(".testimonial-row").length > 0) {
					$("#pagination").show();
				} else {
					$("#pagination").hide();
				}
			}
		});
	}

	$("#prev-page").click(function () {
		if (currentPage > 1) {
			loadTestimonials(currentPage - 1);
		}
	});

	$("#next-page").click(function () {
		loadTestimonials(currentPage + 1);
	});

	$(document).on("click", ".approve-btn", function () {
		let id = $(this).data("id");
		$("#ajax-loader").show();
		$.ajax({
			url: ajaxurl,
			type: "POST",
			data: { action: "approve_testimonial", id: id },
			success: function (response) {
				if (response.success) {
					$("#status-" + id).text("Approved");
					$("#action-" + id).html("<button class='delete-btn' data-id='" + id + "'>Delete</button>");
				}
				$("#ajax-loader").hide();
			}
		});
	});

	$(document).on("click", ".delete-btn", function () {
		let id = $(this).data("id");
		$("#ajax-loader").show();
		$.ajax({
			url: ajaxurl,
			type: "POST",
			data: { action: "delete_testimonial", id: id },
			success: function (response) {
				if (response.success) {
					$("#testimonial-" + id).remove();
					if ($(".testimonial-row").length === 0) {
						$("#pagination").hide();
					}
				}
				$("#ajax-loader").hide();
			}
		});
	});
});