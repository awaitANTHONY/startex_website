<?php

if ( ! function_exists( 'byanca_select_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function byanca_select_register_search_opener_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_search_opener_widget' );
}