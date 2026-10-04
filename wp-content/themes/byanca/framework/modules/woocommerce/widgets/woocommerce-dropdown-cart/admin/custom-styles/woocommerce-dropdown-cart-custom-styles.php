<?php

if ( ! function_exists( 'byanca_select_dropdown_cart_styles' ) ) {
	/**
	 * Generates styles for dropdown cart
	 */
	function byanca_select_dropdown_cart_styles() {
		$dropdown_cart_type = byanca_select_options()->getOptionValue( 'dropdown_cart_type' );

		if ( ! empty( $dropdown_cart_type ) && $dropdown_cart_type === 'plain_text' ) {

			$text_color = byanca_select_options()->getOptionValue( 'dropdown_cart_text_color' );

			if ( ! empty( $text_color ) ) {
				echo byanca_select_dynamic_css( '.qodef-shopping-cart-holder a.qodef-header-cart', array( 'color' => $text_color ) );
			}
		} else {

			$icon_color       = byanca_select_options()->getOptionValue( 'dropdown_cart_icon_color' );
			$icon_hover_color = byanca_select_options()->getOptionValue( 'dropdown_cart_hover_color' );

			if ( ! empty( $icon_color ) ) {
				echo byanca_select_dynamic_css( '.qodef-shopping-cart-holder a.qodef-header-cart', array( 'color' => $icon_color ) );
			}

			if ( ! empty( $icon_hover_color ) ) {
				echo byanca_select_dynamic_css( '.qodef-shopping-cart-holder a.qodef-header-cart:hover', array( 'color' => $icon_hover_color ) );
			}
		}
	}
	
	add_action( 'byanca_select_action_style_dynamic', 'byanca_select_dropdown_cart_styles' );
}