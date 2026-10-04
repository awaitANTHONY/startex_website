<?php

if ( ! function_exists( 'byanca_select_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function byanca_select_register_custom_font_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_custom_font_widget' );
}