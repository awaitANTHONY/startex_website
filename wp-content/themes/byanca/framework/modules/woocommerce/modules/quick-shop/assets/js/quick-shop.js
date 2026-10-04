(function ($) {
	"use strict";
	
	var quickShop = {};
	qodef.modules.quickShop = quickShop;
	qodef.modules.quickShopStart = 0;
	qodef.modules.quickShopEnd = 0;

	quickShop.qodefInitQuickShop = qodefInitQuickShop;

	quickShop.qodefOnWindowLoad = qodefOnWindowLoad;
    quickShop.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(window).on('load', qodefOnWindowLoad);
    $(document).ready(qodefOnDocumentReady);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
	
	/*
	 All functions to be called on $(window).on('load', ) should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefInitQuickShop();
		qodefQuickShop();
		qodefQuickShopLoadbyCategories();
	}

    function qodefOnDocumentReady() {
        qodefQuickShopAreaScroll();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function qodefOnWindowResize() {
        qodefModifyQuickShop();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
        qodefModifyQuickShop();
    }

    function qodefInitQuickShop() {
	    var quickShopButtonOpen = $('a.qodef-quick-shop-opener'),
		    quickShopButtonOpenHeight = quickShopButtonOpen.length ? quickShopButtonOpen.outerWidth() : 0,
		    quickShopButtonOpenTopOffset = quickShopButtonOpen.length ? quickShopButtonOpen.offset().top : -1,
		    contentHolder = $('.qodef-content'),
		    contentTopOffset = contentHolder.length ? contentHolder.offset().top : 0,
		    titleArea = $('.qodef-title-holder'),
		    titleAreaHeight = titleArea.length ? titleArea.outerHeight() : 0,
		    disregardTopElements = $('.qs-disregard-top'),
		    footer = $('.qodef-page-footer');

	    qodef.modules.quickShopStart = contentTopOffset + titleAreaHeight;
	    qodef.modules.quickShopEnd = footer.length ? footer.offset().top : qodef.document.height();

	    disregardTopElements.each(function() {
	    	var currentElement = $(this);

	    	if (qodef.modules.quickShopStart < currentElement.offset().top + currentElement.outerHeight()) {
	    		qodef.modules.quickShopStart = currentElement.offset().top + currentElement.outerHeight();
		    }
	    });

	    if(quickShopButtonOpenTopOffset >= qodef.modules.quickShopStart && quickShopButtonOpenTopOffset + quickShopButtonOpenHeight <= qodef.modules.quickShopEnd) {
		    quickShopButtonOpen.addClass('qodef-quick-shop-opener-appear');
	    } else {
		    quickShopButtonOpen.removeClass('qodef-quick-shop-opener-appear');
	    }
    }

    function qodefModifyQuickShop() {
	    var quickShopButtonOpen = $('a.qodef-quick-shop-opener'),
		    quickShopButtonOpenHeight = quickShopButtonOpen.length ? quickShopButtonOpen.outerWidth() : 0,
		    quickShopButtonOpenTopOffset = quickShopButtonOpen.length ? quickShopButtonOpen.offset().top : -1;

	    if(quickShopButtonOpenTopOffset >= qodef.modules.quickShopStart && quickShopButtonOpenTopOffset + quickShopButtonOpenHeight <= qodef.modules.quickShopEnd) {
		    quickShopButtonOpen.addClass('qodef-quick-shop-opener-appear');
	    } else {
		    quickShopButtonOpen.removeClass('qodef-quick-shop-opener-appear');
	    }
    }

	function qodefQuickShop() {
		var wrapper = $('.qodef-wrapper'),
			quickShopArea = $('.qodef-quick-shop-holder'),
			quickShopButtonOpen = $('a.qodef-quick-shop-opener'),
			cssClass = 'qodef-quick-shop-opened',
			slideWithContent = true;

		if (qodef.body.hasClass('qodef-quick-shop')) {
			cssClass = 'qodef-quick-shop-opened';
			slideWithContent = true;
		}

		if (quickShopArea.length) {
			quickShopArea.find('select').select2();
		}

		$('a.qodef-quick-shop-opener, a.qodef-qs-close').on('click', function (e) {
			if (e.cancelable) {
				e.preventDefault();
			}

			if (!quickShopButtonOpen.hasClass('opened')) {
				quickShopButtonOpen.addClass('opened');
				qodef.body.addClass(cssClass);

				$(window).scroll(function () {
					if (quickShopArea.find('select').data('select2').isOpen()) {
						quickShopArea.find('select').select2("close");
					}
					qodef.body.removeClass(cssClass);
					quickShopButtonOpen.removeClass('opened');
				});
			} else {
				quickShopButtonOpen.removeClass('opened');
				qodef.body.removeClass(cssClass);
			}

			if (slideWithContent) {
				e.stopPropagation();

				wrapper.on('click', function () {
					if (e.cancelable) {
						e.preventDefault();
					}
					quickShopButtonOpen.removeClass('opened');
					qodef.body.removeClass('qodef-quick-shop-opened');
				});
			}
		});
	}

	function qodefQuickShopLoadbyCategories() {
		var categoryHolder = $('.qodef-qs-filter'),
			itemsHolder = $('.qodef-qs-products-holder-inner'),
			loader  = $('.qodef-qs-loader');
		
		var nonceHolder = $('.qodef-qs-filter-holder').find('input[name*="qodef_product_quickview_nonce_"]');
		
		categoryHolder.on('change', function (e) {
			itemsHolder.fadeOut(200, function() {
				loader.fadeIn(200);
			});
			if (e.cancelable) {
				e.preventDefault();
			}
			var currentValue = $(this).val();
			var ajaxData = {
				action: "byanca_select_quick_shop_filter",
				cat : currentValue,
				product_quickview_id: nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length),
				product_quickview_nonce: nonceHolder.val()
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: qodefGlobalVars.vars.qodefAjaxUrl,
				success: function (data) {

					var response = $.parseJSON(data),
						responseHtml =  response.html;

					itemsHolder.html(responseHtml);
					loader.fadeOut(200, function() {
						itemsHolder.fadeIn(200);
					});
				}
			});
		});
	}

    function qodefQuickShopAreaScroll(){
        var quickShopArea = $('.qodef-quick-shop-holder');

        if(quickShopArea.length){
            qodef.modules.common.qodefInitPerfectScrollbar().init(quickShopArea);
        }
    }

})(jQuery);
