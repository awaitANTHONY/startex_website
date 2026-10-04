<?php

if ( ! function_exists( 'byanca_select_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function byanca_select_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_sidearea_opener_widget' );
}