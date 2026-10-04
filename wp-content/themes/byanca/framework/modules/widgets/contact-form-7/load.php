<?php

if ( byanca_select_contact_form_7_installed() ) {
	include_once SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_cf7_widget' );
}

if ( ! function_exists( 'byanca_select_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function byanca_select_register_cf7_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassContactForm7Widget';
		
		return $widgets;
	}
}