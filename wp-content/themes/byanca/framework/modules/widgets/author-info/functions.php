<?php

if ( ! function_exists( 'byanca_select_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function byanca_select_register_author_info_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_author_info_widget' );
}