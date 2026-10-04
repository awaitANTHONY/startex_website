<?php

if ( ! function_exists( 'byanca_select_disable_behaviors_for_header_vertical' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function byanca_select_disable_behaviors_for_header_vertical( $allow_behavior ) {
		return false;
	}
	
	if ( byanca_select_check_is_header_type_enabled( 'header-vertical', byanca_select_get_page_id() ) ) {
		add_filter( 'byanca_select_filter_allow_sticky_header_behavior', 'byanca_select_disable_behaviors_for_header_vertical' );
		add_filter( 'byanca_select_filter_allow_content_boxed_layout', 'byanca_select_disable_behaviors_for_header_vertical' );
	}
}