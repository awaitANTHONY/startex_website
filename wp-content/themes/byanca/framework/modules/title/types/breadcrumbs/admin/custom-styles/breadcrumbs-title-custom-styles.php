<?php

if ( ! function_exists( 'byanca_select_breadcrumbs_title_area_typography_style' ) ) {
	function byanca_select_breadcrumbs_title_area_typography_style() {
		
		$item_styles = byanca_select_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-breadcrumbs'
		);
		
		echo byanca_select_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = byanca_select_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-breadcrumbs a:hover'
		);
		
		echo byanca_select_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'byanca_select_action_style_dynamic', 'byanca_select_breadcrumbs_title_area_typography_style' );
}