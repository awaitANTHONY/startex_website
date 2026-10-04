<?php

if ( ! function_exists( 'byanca_select_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function byanca_select_register_separator_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_separator_widget' );
}