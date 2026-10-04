<?php

if ( ! function_exists( 'byanca_select_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function byanca_select_register_social_icon_widget( $widgets ) {
		$widgets[] = 'ByancaSelectClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_social_icon_widget' );
}