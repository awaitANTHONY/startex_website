(function($) {
    'use strict';

    var productCategoryShowcase = {};
    qodef.modules.productCategoryShowcase = productCategoryShowcase;

	productCategoryShowcase.qodefOnDocumentReady = qodefOnDocumentReady;
    productCategoryShowcase.qodefOnWindowLoad = qodefOnWindowLoad;
	productCategoryShowcase.qodefOnWindowResize = qodefOnWindowResize;

	$(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
	$(window).resize(qodefOnWindowResize);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		initProductCategoryShowcase();
		initProductCategoryShowcaseFx();
	}

	/*
	 All functions to be called on $(window).on('load', ) should be in this function
	 */
	function qodefOnWindowLoad() {

	}

	/*
	All functions to be called on $(window).resize() should be in this function
	*/
	function qodefOnWindowResize() {

	}

	function initProductCategoryShowcase(){
		var showcases = $('.qodef-product-category-showcase');

		if(showcases.length){
			showcases.each(function(){
				var holder = $(this),
					links = holder.find('.qodef-pcs-link');
				
				links.on('mouseenter', function () {
					links.addClass('qodef-pcs-link-covered');
					$(this).removeClass('qodef-pcs-link-covered');
				}).on('mouseleave', function () {
					links.removeClass('qodef-pcs-link-covered');
				});
			});
		}
	}

    function initProductCategoryShowcaseFx() {
        var items = $('.qodef-pcs-with-loading-fx .qodef-pcs-image');

        if (items.length && !qodef.htmlEl.hasClass('touch')) {
            var coeff = 6;

            items.appear(function() {
                var item = $(this),
                    delay = 100 * (Math.floor(Math.random() * coeff)) + 'ms';

                item
                    .addClass('qodef-appeared')
                    .css('transition-delay', delay);
            })
        }
    }

})(jQuery);