<?php

if ( ! function_exists( 'byanca_select_register_widgets' ) ) {
	function byanca_select_register_widgets() {
		$widgets = apply_filters( 'byanca_select_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'byanca_select_register_widgets' );
}