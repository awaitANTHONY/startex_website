<?php

if (!function_exists('byanca_core_enqueue_styles_for_portfolio_vertical_slider_shortcodes')) {
    /**
     * Function that includes all necessary 3rd party styles for this shortcode
     */
    function byanca_core_enqueue_styles_for_portfolio_vertical_slider_shortcodes() {
        wp_enqueue_style('swiper-css', BYANCA_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-vertical-slider/assets/css/plugins/swiper.min.css');
    }

    add_action('byanca_select_action_enqueue_third_party_styles', 'byanca_core_enqueue_styles_for_portfolio_vertical_slider_shortcodes');
}

if (!function_exists('byanca_core_enqueue_scripts_for_portfolio_vertical_slider_shortcodes')) {
    /**
     * Function that includes all necessary 3rd party scripts for this shortcode
     */
    function byanca_core_enqueue_scripts_for_portfolio_vertical_slider_shortcodes() {
        wp_enqueue_script('swiper-js', BYANCA_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-vertical-slider/assets/js/plugins/swiper.min.js', array('jquery'), false, true);
    }

    add_action('byanca_select_action_enqueue_third_party_scripts', 'byanca_core_enqueue_scripts_for_portfolio_vertical_slider_shortcodes');
}

if (!function_exists('byanca_core_add_portfolio_vertical_slider_shortcode')) {
    function byanca_core_add_portfolio_vertical_slider_shortcode($shortcodes_class_name) {
        $shortcodes = array(
            'ByancaCore\CPT\Shortcodes\Portfolio\PortfolioVerticalSlider'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('byanca_core_filter_add_vc_shortcode', 'byanca_core_add_portfolio_vertical_slider_shortcode');
}

if (!function_exists('byanca_core_set_portfolio_vertical_slider_icon_class_name_for_vc_shortcodes')) {
    /**
     * Function that set custom icon class name for portfolio vertical slider shortcode to set our icon for Visual Composer shortcodes panel
     */
    function byanca_core_set_portfolio_vertical_slider_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-portfolio-vertical-slider';

        return $shortcodes_icon_class_array;
    }

    add_filter('byanca_core_filter_add_vc_shortcodes_custom_icon_class', 'byanca_core_set_portfolio_vertical_slider_icon_class_name_for_vc_shortcodes');
}