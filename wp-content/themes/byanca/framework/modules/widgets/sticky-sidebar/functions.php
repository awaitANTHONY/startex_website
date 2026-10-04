<?php

if ( ! function_exists( 'byanca_select_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function byanca_select_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_sticky_sidebar_widget' );
}