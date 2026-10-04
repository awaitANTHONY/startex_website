<?php

if ( ! function_exists( 'byanca_core_enqueue_scripts_for_pie_chart_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function byanca_core_enqueue_scripts_for_pie_chart_shortcodes() {
		wp_enqueue_script( 'counter', BYANCA_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/counter.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'easypiechart', BYANCA_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/easypiechart.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'byanca_select_action_enqueue_third_party_scripts', 'byanca_core_enqueue_scripts_for_pie_chart_shortcodes' );
}

if ( ! function_exists( 'byanca_core_add_pie_chart_shortcodes' ) ) {
	function byanca_core_add_pie_chart_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'ByancaCore\CPT\Shortcodes\PieChart\PieChart'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'byanca_core_filter_add_vc_shortcode', 'byanca_core_add_pie_chart_shortcodes' );
}

if ( ! function_exists( 'byanca_core_set_pie_chart_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for pie chart shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function byanca_core_set_pie_chart_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-pie-chart';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'byanca_core_filter_add_vc_shortcodes_custom_icon_class', 'byanca_core_set_pie_chart_icon_class_name_for_vc_shortcodes' );
}