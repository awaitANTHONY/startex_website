<?php

if ( ! function_exists( 'byanca_select_set_hide_dep_options_title_centered' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this title type is selected
	 */
	function byanca_select_set_hide_dep_options_title_centered( $hide_dep_options ) {
		$hide_dep_options[] = 'centered';
		
		return $hide_dep_options;
	}
	
	// hide breadcrumbs meta
	add_filter( 'byanca_select_filter_breadcrumbs_title_hide_meta_boxes', 'byanca_select_set_hide_dep_options_title_centered' );
}