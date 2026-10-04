<?php

if ( ! function_exists( 'byanca_membership_add_register_shortcodes' ) ) {
	function byanca_membership_add_register_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'ByancaMembership\Shortcodes\ByancaUserRegister\ByancaUserRegister'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'byanca_membership_filter_add_vc_shortcode', 'byanca_membership_add_register_shortcodes' );
}