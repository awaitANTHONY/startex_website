(function($) {
    'use strict';

    var productCategoryList = {};
    qodef.modules.productCategoryList = productCategoryList;
	
	productCategoryList.qodefOnDocumentReady = qodefOnDocumentReady;
    productCategoryList.qodefOnWindowLoad = qodefOnWindowLoad;
	productCategoryList.qodefOnWindowResize = qodefOnWindowResize;
	
	$(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
	$(window).resize(qodefOnWindowResize);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		initProductCategoryListMasonry();
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
		initProductCategoryListMasonry();
	}
	
	function initProductCategoryListMasonry(){
		var masonryHolder = $('.qodef-pcl-holder.qodef-masonry-layout'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
			var size = masonry.find('.qodef-pcl-sizer').width();
			
			masonry.waitForImages(function(){
				masonry.isotope({
					layoutMode: 'packery',
					itemSelector: '.qodef-pcli',
					percentPosition: true,
					packery: {
						gutter: '.qodef-pcl-gutter',
						columnWidth: '.qodef-pcl-sizer'
					}
				});
				
				qodef.modules.common.setFixedImageProportionSize(masonry, masonry.find('.qodef-pcli'), size, true);
				
				masonry.isotope( 'layout').css('opacity', '1');
			});
		}
	}

})(jQuery);