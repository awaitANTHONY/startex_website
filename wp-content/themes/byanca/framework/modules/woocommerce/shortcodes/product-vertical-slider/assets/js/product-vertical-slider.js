(function ($) {
    'use strict';

    var productVerticalSlider = {};
    qodef.modules.productVerticalSlider = productVerticalSlider;

    productVerticalSlider.qodefProductVerticalSlider = qodefProductVerticalSlider;
    productVerticalSlider.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefProductVerticalSlider();
    }

    /**
     * Init bordered carousel shortcode
     */
    function qodefProductVerticalSlider() {
        var holder = $('.qodef-product-vertical-slider-holder');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    slider = thisHolder.children('.swiper-container'),
                    activeSlideTitle = '';

                new Swiper(slider, {
                    direction: 'vertical',
                    loop: true,
                    autoplay: false,
                    mousewheel: true,
                    slidesPerView: 3,
                    spaceBetween: 0,
                    centeredSlides: true,
                    speed: 800,
                    on: {
                        init: function () {
                            slider.css('visibility', 'visible');
                        },
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'custom',
                        renderCustom: function (swiper, current, total) {
                            if (swiper.hasOwnProperty('activeIndex') && swiper.hasOwnProperty('slides') && typeof swiper.slides[swiper.activeIndex] !== 'undefined') {
                                activeSlideTitle = $(swiper.slides[swiper.activeIndex]).find('.qodef-pli-title a').text();
                            }
                            return '<span class="swiper-pagination-title">' + activeSlideTitle + '</span><span class="swiper-pagination-current">' + current + '</span>/<span class="swiper-pagination-total">' + total + '</span>';
                        }
                    }
                });
            });
        }
    }


})(jQuery);