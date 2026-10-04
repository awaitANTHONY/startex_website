<?php

if ( ! function_exists( 'byanca_select_disable_behaviors_for_header_vertical_sliding' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function byanca_select_disable_behaviors_for_header_vertical_sliding( $allow_behavior ) {
		return false;
	}
	
	if ( byanca_select_check_is_header_type_enabled( 'header-vertical-sliding', byanca_select_get_page_id() ) ) {
		add_filter( 'byanca_select_filter_allow_sticky_header_behavior', 'byanca_select_disable_behaviors_for_header_vertical_sliding' );
		add_filter( 'byanca_select_filter_allow_content_boxed_layout', 'byanca_select_disable_behaviors_for_header_vertical_sliding' );
	}
}