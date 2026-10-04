<?php

if ( ! function_exists( 'byanca_select_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function byanca_select_register_icon_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_icon_widget' );
}