<?php

if ( ! function_exists( 'byanca_select_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function byanca_select_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = byanca_select_options()->getOptionValue( 'footer_top_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo byanca_select_dynamic_css( '.qodef-page-footer .qodef-footer-top-holder', $item_styles );
	}
	
	add_action( 'byanca_select_action_style_dynamic', 'byanca_select_footer_top_general_styles' );
}

if ( ! function_exists( 'byanca_select_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function byanca_select_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = byanca_select_options()->getOptionValue( 'footer_bottom_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo byanca_select_dynamic_css( '.qodef-page-footer .qodef-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'byanca_select_action_style_dynamic', 'byanca_select_footer_bottom_general_styles' );
}