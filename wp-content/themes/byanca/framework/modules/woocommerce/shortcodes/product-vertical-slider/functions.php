<?php
if ( ! function_exists( 'byanca_select_add_product_vertical_slider_shortcode' ) ) {
	function byanca_select_add_product_vertical_slider_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'ByancaCore\CPT\Shortcodes\ProductVerticalSlider\ProductVerticalSlider',
		);

		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

		return $shortcodes_class_name;
	}

	if ( byanca_select_core_plugin_installed() ) {
		add_filter( 'byanca_core_filter_add_vc_shortcode', 'byanca_select_add_product_vertical_slider_shortcode' );
	}
}

if ( ! function_exists( 'byanca_select_add_product_vertical_slider_into_shortcodes_list' ) ) {
	function byanca_select_add_product_vertical_slider_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'qodef_product_vertical_slider';

		return $woocommerce_shortcodes;
	}

	add_filter( 'byanca_select_filter_woocommerce_shortcodes_list', 'byanca_select_add_product_vertical_slider_into_shortcodes_list' );
}