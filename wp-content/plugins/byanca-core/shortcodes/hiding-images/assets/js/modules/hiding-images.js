(function ($) {
	'use strict';

	$(document).ready(qodefOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefHidingImages();
	}

	/**
	 * Init Hiding Images
	 */
	function qodefHidingImages() {
		var containers = $('.qodef-hiding-images');

		if (containers.length) {
			var containerInView = function(element) {
				var toggleClasses = function () {
					if (qodef.scroll > element.offset().top - qodef.windowHeight*0.8 &&
						qodef.scroll < element.offset().top + element.height()) {
						!element.hasClass('qodef-in-view') && element.addClass('qodef-in-view');
					} else {
						element.hasClass('qodef-in-view') && element.removeClass('qodef-in-view');
					}
				}

				$(window).scroll(function () {
					toggleClasses();
				});

				toggleClasses();
			}

			containers.each(function(){
				containerInView($(this));
			})
		}
	}

})(jQuery);