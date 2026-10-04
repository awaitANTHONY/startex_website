<?php

if ( ! function_exists( 'byanca_core_add_image_shortcodes' ) ) {
	function byanca_core_add_image_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'ByancaCore\CPT\Shortcodes\Image\Image'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'byanca_core_filter_add_vc_shortcode', 'byanca_core_add_image_shortcodes' );
}

if ( ! function_exists( 'byanca_core_set_image_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for image shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function byanca_core_set_image_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'byanca_core_filter_add_vc_shortcodes_custom_icon_class', 'byanca_core_set_image_icon_class_name_for_vc_shortcodes' );
}