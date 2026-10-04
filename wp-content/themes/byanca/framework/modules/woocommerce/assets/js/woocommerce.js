(function($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefWooCommerceStickySidebar = qodefWooCommerceStickySidebar;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;
    woocommerce.qodefOnWindowLoad = qodefOnWindowLoad;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);

    /*
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
	    qodefInitSingleProductLightbox();
	    qodefInitSingleProductTabsChange();
    }

    /*
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function qodefOnWindowLoad() {
    	qodefInitProductListMasonryShortcode();
        qodefWooCommerceStickySidebar().init();
    }

    /*
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitProductListMasonryShortcode();
    }

    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function qodefInitQuantityButtons() {
		$(document).on('click', '.qodef-quantity-minus, .qodef-quantity-plus', function (e) {
			e.stopPropagation();

			var button = $(this),
				inputField = button.siblings('.qodef-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;

			if (button.hasClass('qodef-quantity-minus')) {
				minus = true;
			}

			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}

			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function qodefInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');

		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}

		var variableProducts = $('.qodef-woocommerce-page .qodef-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}

		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}

		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}

		// After quick view is loaded, this event is fired
		$(document).on('qv_loader_stop', function( event ) {
		    var quickViewDropdown = $('#yith-quick-view-modal select');

		    if (quickViewDropdown.length) {
				quickViewDropdown.select2();
			}
		});
	}

	/*
	 ** Init Product List Natural Masonry Shortcode Layout
	 */
	function qodefInitProductListMasonryShortcode() {
		var container = $('.qodef-pl-holder.qodef-natural-masonry-layout .qodef-pl-outer');

		if (container.length) {
			container.each(function () {
				var thisContainer = $(this);
                var size = thisContainer.find('.qodef-pl-sizer').width();
                var thisContainerParent = $(this).parent();

                qodefResizeProductItems(size, thisContainerParent);

				thisContainer.waitForImages(function () {
					thisContainer.isotope({
                        layoutMode: 'packery',
						itemSelector: '.qodef-pli',
						resizable: false,
                        packery: {
							columnWidth: '.qodef-pl-sizer',
							gutter: '.qodef-pl-gutter'
						}
					});

					setTimeout(function () {
						if (typeof qodef.modules.common.qodefInitParallax === "function") {
							qodef.modules.common.qodefInitParallax();
						}
					}, 1000);

					thisContainer.isotope('layout').css('opacity', 1);
				});
			});
		}
	}

	/*
    ** Init sticky sidebar for single product page when single layout is sticky info
    */
    function qodefWooCommerceStickySidebar(){

        var sswHolder = $('.qodef-single-product-summary');
        var headerHeightOffset = 0;
        var widgetTopOffset = 0;
        var widgetTopPosition = 0;
        var sidebarHeight = 0;
        var sidebarWidth = 0;
        var objectsCollection = [];

        function addObjectItems() {
            if (sswHolder.length){
                sswHolder.each(function(){
                    var thisSswHolder = $(this);
                    widgetTopOffset = thisSswHolder.offset().top;
                    widgetTopPosition = thisSswHolder.position().top;
                    sidebarHeight = thisSswHolder.children('.summary').outerHeight();
                    sidebarWidth = thisSswHolder.width();

                    objectsCollection.push({'object': thisSswHolder, 'offset': widgetTopOffset, 'position': widgetTopPosition, 'height': sidebarHeight, 'width': sidebarWidth});
                });
            }
        }

        function initStickySidebarWidget() {

            if (objectsCollection.length && qodef.body.hasClass('qodef-woo-sticky-holder-enabled')){
                $.each(objectsCollection, function(i){

                    var thisSswHolder = objectsCollection[i]['object'];
                    var thisWidgetTopOffset = objectsCollection[i]['offset'];
                    var thisWidgetTopPosition = objectsCollection[i]['position'];
                    var thisSidebarHeight = objectsCollection[i]['height'];
                    var thisSidebarWidth = objectsCollection[i]['width'];
                    var constant = 59; //59 to prevent mispositioned

                    if (qodef.body.hasClass('qodef-fixed-on-scroll')) {
                        headerHeightOffset = 80;
                        if ($('.qodef-fixed-wrapper').hasClass('qodef-fixed')) {
                            headerHeightOffset = $('.qodef-fixed-wrapper.qodef-fixed').height();
                        }
                    } else {
                        headerHeightOffset = $('.qodef-page-header').height();
                    }

                    if (qodef.windowWidth > 1024) {

                        var sidebarPosition = -(thisWidgetTopPosition - headerHeightOffset - qodefGlobalVars.vars.qodefAddForAdminBar - 10); // 10 is arbitrarily value for smooth sticky animation for first scroll
                        var stickySidebarHeight = thisSidebarHeight - thisWidgetTopPosition;
                        var summaryContentTopMargin = parseInt($('.qodef-single-product-summary').css('margin-top'));
                        var stickySidebarRowHolderHeight = thisSswHolder.parent().outerHeight() - 10 - summaryContentTopMargin; // 10 is arbitrarily value for smooth sticky animation for first scroll

                        //move sidebar up when hits the end of section row
                        var rowSectionEndInViewport = thisWidgetTopOffset - headerHeightOffset - thisWidgetTopPosition - qodefGlobalVars.vars.qodefTopBarHeight + stickySidebarRowHolderHeight;

                        if ((qodef.scroll >= thisWidgetTopOffset - headerHeightOffset - constant) && thisSidebarHeight < stickySidebarRowHolderHeight) {
                            if(thisSswHolder.children('.summary').hasClass('qodef-sticky-sidebar-appeared')) {
                                thisSswHolder.children('.summary.qodef-sticky-sidebar-appeared').css({'top': sidebarPosition+'px'});
                            } else {
                                thisSswHolder.children('.summary').addClass('qodef-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+constant+'px', 'width': thisSidebarWidth, 'margin-top': '-10px'}).animate({'margin-top': '0'}, 200);
                            }

                            if (qodef.scroll + stickySidebarHeight >= rowSectionEndInViewport - 2*constant) {
                                thisSswHolder.children('.summary.qodef-sticky-sidebar-appeared').css({'position': 'absolute', 'top': stickySidebarRowHolderHeight-stickySidebarHeight+sidebarPosition-headerHeightOffset-constant+'px'});
                            } else {
                                thisSswHolder.children('.summary.qodef-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+constant+'px'});
                            }
                        } else {
                            thisSswHolder.children('.summary').removeClass('qodef-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                        }
                    } else {
                        thisSswHolder.children('.summary').removeClass('qodef-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                    }
                });
            }
        }

        return {
            init: function() {
                addObjectItems();

                initStickySidebarWidget();

                $(window).scroll(function(){
                    initStickySidebarWidget();
                });
            },
            reInit: function() {
                addObjectItems();

                initStickySidebarWidget();

                $(window).scroll(function(){
                    initStickySidebarWidget();
                });
            }
        };
    }

	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function qodefInitSingleProductLightbox() {
		var item = $('.qodef-woo-single-page.qodef-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');

		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');

			if (typeof qodef.modules.common.qodefPrettyPhoto === "function") {
				qodef.modules.common.qodefPrettyPhoto();
			}
		}
	}

	/**
     * Init Resize Product Items
     */
    function qodefResizeProductItems(size,container){
        if(container.hasClass('qodef-pl-images-fixed')) {
            var padding = parseInt(container.find('.qodef-pli').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-default'),
                largeWidthMasonryItem = container.find('.qodef-large-width'),
                largeHeightMasonryItem = container.find('.qodef-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-large-width-height');

            if (qodef.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', 2 * size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

	/*
	 ** Init Product Single Tabs Change
	 */
	function qodefInitSingleProductTabsChange() {
		var items = $('.qodef-woo-sticky-holder-enabled.qodef-woo-single-info-inside-summary .qodef-single-product-summary .woocommerce-tabs ul.tabs a');

		if(items.length) {

			items.on('click', function(){

				if (typeof qodef.modules.woocommerce.qodefWooCommerceStickySidebar === 'function') {

					setTimeout(
						function() {
							qodef.modules.woocommerce.qodefWooCommerceStickySidebar().reInit();
						}, 100
					);
                }
			});
		}
	}

})(jQuery);