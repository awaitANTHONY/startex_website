<?php

if ( ! function_exists( 'byanca_select_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function byanca_select_register_blog_list_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_blog_list_widget' );
}