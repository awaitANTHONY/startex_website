(function ($) {
    'use strict';

    var portfolioVerticalSlider = {};
    qodef.modules.portfolioVerticalSlider = portfolioVerticalSlider;

    portfolioVerticalSlider.qodefPortfolioVerticalSlider = qodefPortfolioVerticalSlider;
    portfolioVerticalSlider.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefPortfolioVerticalSlider();
    }

    /**
     * Init bordered carousel shortcode
     */
    function qodefPortfolioVerticalSlider() {
        var slidersHolder = $('.qodef-portfolio-vertical-slider-holder');

        if (slidersHolder.length) {
            var sliders = slidersHolder.find('.swiper-container');

            sliders.each(function () {
                var slider = $(this),
                    swiper = new Swiper(slider, {
                        direction: 'vertical',
                        loop: true,
                        autoplay: false,
                        mousewheel: true,
                        slidesPerView: 3,
                        spaceBetween: 0,
                        centeredSlides: true,
                        speed: 500,
                    });
            });
        }
    }


})(jQuery);
