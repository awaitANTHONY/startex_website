<?php

if ( ! function_exists( 'byanca_select_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function byanca_select_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'byanca_select_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function byanca_select_get_dropdown_cart_icon_class() {
		$classes = array(
			'qodef-header-cart'
		);

		$dropdown_cart_type = byanca_select_options()->getOptionValue( 'dropdown_cart_type' );
		if ( ! empty( $dropdown_cart_type ) && $dropdown_cart_type === 'plain_text' ) {
			$classes[] = 'qodef-header-cart-plain-text';
		} else {
			$classes[] = byanca_select_get_icon_sources_class( 'dropdown_cart', 'qodef-header-cart' );
		}
		
		return $classes;
	}
}