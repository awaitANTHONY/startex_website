(function($) {
    'use strict';

    var productListCarousel = {};
    qodef.modules.productListCarousel = productListCarousel;

    productListCarousel.qodefOnWindowLoad = qodefOnWindowLoad;

    $(window).on('load', qodefOnWindowLoad);

    /*
     All functions to be called on $(window).on('load', ) should be in this function
     */
    function qodefOnWindowLoad() {
	    qodefInitProductListCarouselFullScreenSlider();
    }

	function qodefInitProductListCarouselFullScreenSlider(){
		var holders = $('.qodef-plc-holder.qodef-plc-items-full-screen');

        if(holders.length){
            holders.each(function(){
                var holder = $(this),
                    itemHolder = holder.find('.qodef-plc-item'),
                    topOffset = holder.offset().top,
                    footer = $('.qodef-page-footer'),
	                footerHeight = footer.length ? footer.outerHeight() : 0,
	                contentBottom = $('.qodef-content-bottom'),
	                contentBottomHeight = contentBottom.length ? contentBottom.outerHeight() : 0,
                    height = qodef.windowHeight - topOffset - footerHeight - contentBottomHeight;

	            itemHolder.css('height', height);
	            holder.delay(200).animate({'opacity': 1}, 400);
            });
        }
    }

})(jQuery);