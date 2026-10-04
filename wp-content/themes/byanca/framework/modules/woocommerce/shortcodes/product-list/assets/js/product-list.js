(function ($) {
	'use strict';

	var productList = {};
	qodef.modules.productList = productList;

	productList.qodefOnDocumentReady = qodefOnDocumentReady;
	productList.qodefOnWindowLoad = qodefOnWindowLoad;

	$(document).ready(qodefOnDocumentReady);
	$(window).on('load', qodefOnWindowLoad);

	/*
	    All functions to be called on $(document).ready() should be in this function
	*/
	function qodefOnDocumentReady() {

	}

	/*
	    All functions to be called on $(window).on('load', ) should be in this function
	*/
	function qodefOnWindowLoad() {
		qodefInitProductListJustifiedGallery();
		qodefInitProductListFx();
	}

	/**
	 * Initializes product list justified gallery
	 */
	function qodefInitProductListJustifiedGallery() {
		var productLists = $('.qodef-pl-holder.qodef-justified-gallery-layout');

		if (productLists.length) {
			productLists.each(function () {
				var productList = $(this),
					spacing = typeof productList.data('space-value') !== 'undefined' ? productList.data('space-value') : 10,
					rowHeight = typeof productList.data('row-height') !== 'undefined' ? productList.data('row-height') : 500,
					lastRow = typeof productList.data('last-row') !== 'undefined' ? productList.data('last-row') : 'nojustify',
					justifyThreshold = typeof productList.data('justify-threshold') !== 'undefined' ? productList.data('justify-threshold') : 0.75,
					thisProductList = productList.children('.qodef-pl-outer'),

					isStage_1367_1440 = window.matchMedia("(min-width: 1367px)").matches && window.matchMedia("(max-width: 1440px)").matches,
					isStage_1281_1366 = window.matchMedia("(min-width: 1281px)").matches && window.matchMedia("(max-width: 1366px)").matches,
					isStage_1025_1280 = window.matchMedia("(min-width: 1025px)").matches && window.matchMedia("(max-width: 1280px)").matches,
					isStage_769_1024 = window.matchMedia("(min-width: 769px)").matches && window.matchMedia("(max-width: 1024px)").matches,
					isStage_681_768 = window.matchMedia("(min-width: 681px)").matches && window.matchMedia("(max-width: 768px)").matches,
					isStage_481_680 = window.matchMedia("(min-width: 481px)").matches && window.matchMedia("(max-width: 680px)").matches,
					isStage_480 = window.matchMedia("(max-width: 480px)").matches;

				if (isStage_1367_1440 && typeof productList.data('space-value-1367-1440') !== 'undefined' && productList.data('space-value-1367-1440') !== false) {
		            spacing = productList.data('space-value-1367-1440');
	            }
	            if (isStage_1367_1440 && typeof productList.data('row-height-1367-1440') !== 'undefined' && productList.data('row-height-1367-1440') !== false) {
		            rowHeight = productList.data('row-height-1367-1440');
	            }

				if (isStage_1281_1366 && typeof productList.data('space-value-1281-1366') !== 'undefined' && productList.data('space-value-1281-1366') !== false) {
		            spacing = productList.data('space-value-1281-1366');
	            }
	            if (isStage_1281_1366 && typeof productList.data('row-height-1281-1366') !== 'undefined' && productList.data('row-height-1281-1366') !== false) {
		            rowHeight = productList.data('row-height-1281-1366');
	            }

	            if (isStage_1025_1280 && typeof productList.data('space-value-1025-1280') !== 'undefined' && productList.data('space-value-1025-1280') !== false) {
		            spacing = productList.data('space-value-1025-1280');
	            }
	            if (isStage_1025_1280 && typeof productList.data('row-height-1025-1280') !== 'undefined' && productList.data('row-height-1025-1280') !== false) {
		            rowHeight = productList.data('row-height-1025-1280');
	            }

	            if (isStage_769_1024 && typeof productList.data('space-value-769-1024') !== 'undefined' && productList.data('space-value-769-1024') !== false) {
		            spacing = productList.data('space-value-769-1024');
	            }
	            if (isStage_769_1024 && typeof productList.data('row-height-769-1024') !== 'undefined' && productList.data('row-height-769-1024') !== false) {
		            rowHeight = productList.data('row-height-769-1024');
	            }

	            if (isStage_681_768 && typeof productList.data('space-value-681-768') !== 'undefined' && productList.data('space-value-681-768') !== false) {
		            spacing = productList.data('space-value-681-768');
	            }
	            if (isStage_681_768 && typeof productList.data('row-height-681-768') !== 'undefined' && productList.data('row-height-681-768') !== false) {
		            rowHeight = productList.data('row-height-681-768');
	            }

	            if (isStage_481_680 && typeof productList.data('space-value-481-680') !== 'undefined' && productList.data('space-value-481-680') !== false) {
		            spacing = productList.data('space-value-481-680');
	            }
	            if (isStage_481_680 && typeof productList.data('row-height-481-680') !== 'undefined' && productList.data('row-height-481-680') !== false) {
		            rowHeight = productList.data('row-height-481-680');
	            }

	            if (isStage_480 && typeof productList.data('space-value-480') !== 'undefined' && productList.data('space-value-480') !== false) {
		            spacing = productList.data('space-value-480');
	            }
	            if (isStage_480 && typeof productList.data('row-height-480') !== 'undefined' && productList.data('row-height-480') !== false) {
		            rowHeight = productList.data('row-height-480');
	            }

				var qodefJustifiedGalleryFx = function () {
					var items = $('.qodef-pl-with-loading-fx.qodef-justified-gallery-layout .qodef-pli-inner:not(.qodef-appeared)');

					if (items.length && !qodef.htmlEl.hasClass('touch')) {
						var coeff = 6;

						items.appear(function () {
							var item = $(this),
								delay = 100 * (Math.floor(Math.random() * coeff)) + 'ms';

							item
								.addClass('qodef-appeared')
								.css('transition-delay', delay);
						})
					}
				};

				thisProductList.waitForImages(function () {
					thisProductList.justifiedGallery({
						captions: false,
						rowHeight: rowHeight,
						margins: spacing,
						border: 0,
						lastRow: lastRow,
						justifyThreshold: justifyThreshold,
						selector: '> .qodef-pli'
					}).on('jg.complete jg.rowflush', function () {
						var gal = $(this);
						var deducted = false;
						gal.find('.qodef-pli').addClass('show').each(function () {
							$(this).height(Math.round($(this).height()));
							if (!deducted && $(this).width() == 0) {
								gal.height(gal.height() - $(this).height() - spacing);
								deducted = true;
							}
						});
					});
					productList.css('opacity', '1');
					setTimeout(function() {
						qodefJustifiedGalleryFx();
					}, 500);
				});
			});
		}
	}

	/**
	 * Initializes product list fx
	 */
	function qodefInitProductListFx() {
		var items = $('.qodef-pl-with-loading-fx:not(.qodef-justified-gallery-layout) .qodef-pli-inner:not(.qodef-appeared)');

		if (items.length && !qodef.htmlEl.hasClass('touch')) {
			var coeff = 6;

			var initAppear = function() {
				items.appear(function () {
					var item = $(this),
						delay = 150 * (Math.floor(Math.random() * coeff)) + 'ms';
	
					item
						.addClass('qodef-appeared')
						.css('transition-delay', delay);
				});
			}

			//wait for loader fadeout
			setTimeout(function(){
				initAppear();
			}, 600);
		}
	}
})(jQuery);