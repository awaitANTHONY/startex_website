<?php

if ( ! function_exists( 'byanca_core_add_dropcaps_shortcodes' ) ) {
	function byanca_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'ByancaCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'byanca_core_filter_add_vc_shortcode', 'byanca_core_add_dropcaps_shortcodes' );
}