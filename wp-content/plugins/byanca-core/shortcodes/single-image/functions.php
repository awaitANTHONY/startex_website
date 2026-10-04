<?php

if ( ! function_exists( 'byanca_core_add_single_image_shortcodes' ) ) {
	function byanca_core_add_single_image_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'ByancaCore\CPT\Shortcodes\SingleImage\SingleImage'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'byanca_core_filter_add_vc_shortcode', 'byanca_core_add_single_image_shortcodes' );
}

if ( ! function_exists( 'byanca_core_set_single_image_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for single image shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function byanca_core_set_single_image_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-single-image';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'byanca_core_filter_add_vc_shortcodes_custom_icon_class', 'byanca_core_set_single_image_icon_class_name_for_vc_shortcodes' );
}