<?php

if ( ! function_exists( 'byanca_select_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function byanca_select_register_button_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_button_widget' );
}