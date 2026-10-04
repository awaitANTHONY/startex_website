(function($) {
    'use strict';

    var interactiveLinkShowcase = {};
    qodef.modules.interactiveLinkShowcase = interactiveLinkShowcase;

    interactiveLinkShowcase.qodefInitInteractiveLinkShowcase = qodefInitInteractiveLinkShowcase;
    interactiveLinkShowcase.qodefOnDocumentReady = qodefOnDocumentReady;
    interactiveLinkShowcase.qodefOnWindowLoad = qodefOnWindowLoad;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitInteractiveLinkShowcase();
        qodefILSLoading.init('.qodef-ils--loading-fx');
    }

    /*
     All functions to be called on $(window).on('load', ) should be in this function
     */
    function qodefOnWindowLoad() {
	    qodefInitInteractiveLinkShowcaseFullScreen();
    }

    /**
     * Init item showcase shortcode
     */
    function qodefInitInteractiveLinkShowcase() {
        var interactiveLinkShowcase = $('.qodef-ils-holder');
	
	    if (interactiveLinkShowcase.length) {
		    interactiveLinkShowcase.each(function(){
			    var thisInteractiveLinkShowcase = $(this),
				    singleImage = thisInteractiveLinkShowcase.find('.qodef-ils-item-image'),
				    singleLink  = thisInteractiveLinkShowcase.find('.qodef-ils-item-link');
			    
			    singleImage.eq(0).addClass('qodef-active');
			    thisInteractiveLinkShowcase.find('.qodef-ils-item-link[data-index="0"]').addClass('qodef-active');
			
			    singleLink.children().on('touchstart mouseenter', function() {
				    var thisLink = $(this).parent(),
					    index = parseInt( thisLink.data('index'), 10 );
				
				    singleImage.removeClass('qodef-active').eq(index).addClass('qodef-active');
				    singleLink.removeClass('qodef-active');
				    thisInteractiveLinkShowcase.find('.qodef-ils-item-link[data-index="'+index+'"]').addClass('qodef-active');
			    });
		    });
	    }
    }

    function qodefInitInteractiveLinkShowcaseFullScreen(){
		var holders = $('.qodef-ils-holder.qodef-ils-fullscreen');

        if(holders.length){
            holders.each(function(){
                var holder = $(this),
                    topOffset = holder.offset().top,
                    footer = $('.qodef-page-footer'),
	                footerHeight = footer.length ? footer.outerHeight() : 0,
	                contentBottom = $('.qodef-content-bottom'),
	                contentBottomHeight = contentBottom.length ? contentBottom.outerHeight() : 0,
                    height = qodef.windowHeight - topOffset - footerHeight - contentBottomHeight;

	            holder
		            .css('height', height)
	                .css('opacity', 1);
            });
        }
    }

    var qodefILSLoading = {
        init: function (selector) {
			var $ils = $(selector);
			
			if ($ils.length) {
                qodefILSLoading.loadingFX($ils);
			}
        },
        loadingFX: function ($ils) {
            var $links = $ils.find('.qodef-ils-item-link');

            $links.appear(function() {
                $(this).addClass('qodef-ils--loaded');
			});
        }
    }

})(jQuery);