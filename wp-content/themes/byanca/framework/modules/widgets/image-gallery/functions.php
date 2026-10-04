<?php

if ( ! function_exists( 'byanca_select_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function byanca_select_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_image_gallery_widget' );
}