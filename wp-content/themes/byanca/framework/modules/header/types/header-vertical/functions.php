<?php

if ( ! function_exists( 'byanca_select_register_header_vertical_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function byanca_select_register_header_vertical_type( $header_types ) {
		$header_type = array(
			'header-vertical' => 'ByancaSelectNamespace\Modules\Header\Types\HeaderVertical'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'byanca_select_init_register_header_vertical_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function byanca_select_init_register_header_vertical_type() {
		add_filter( 'byanca_select_filter_register_header_type_class', 'byanca_select_register_header_vertical_type' );
	}
	
	add_action( 'byanca_select_action_before_header_function_init', 'byanca_select_init_register_header_vertical_type' );
}

if ( ! function_exists( 'byanca_select_include_header_vertical_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function byanca_select_include_header_vertical_menu( $menus ) {
		$menus['vertical-navigation'] = esc_html__( 'Vertical Navigation', 'byanca' );
		
		return $menus;
	}
	
	if ( byanca_select_check_is_header_type_enabled( 'header-vertical' ) ) {
		add_filter( 'byanca_select_filter_register_headers_menu', 'byanca_select_include_header_vertical_menu' );
	}
}

if ( ! function_exists( 'byanca_select_get_header_vertical_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function byanca_select_get_header_vertical_main_menu() {
		$menu_opening = byanca_select_options()->getOptionValue('vertical_menu_dropdown_opening');
		
		$params = array(
			'opening_class' => 'qodef-vertical-dropdown-'. ( $menu_opening !== '' ? $menu_opening : 'below' )
		);

		byanca_select_get_module_template_part( 'templates/vertical-navigation', 'header/types/header-vertical', '', $params );
	}
}

if ( ! function_exists( 'byanca_select_vertical_header_holder_class' ) ) {
	/**
	 * Return holder class
	 */
	function byanca_select_vertical_header_holder_class() {
		$center_content = byanca_select_get_meta_field_intersect( 'vertical_header_center_content', byanca_select_get_page_id() );
		$holder_class   = $center_content === 'yes' ? 'qodef-vertical-alignment-center' : 'qodef-vertical-alignment-top';
		
		return $holder_class;
	}
}

if ( ! function_exists( 'byanca_select_header_vertical_per_page_custom_styles' ) ) {
	/**
	 * Return header per page styles
	 */
	function byanca_select_header_vertical_per_page_custom_styles( $style, $class_prefix, $page_id ) {
		$header_area_style    = array();
		$header_area_selector = array( $class_prefix . '.qodef-header-vertical .qodef-vertical-area-background' );
		
		$vertical_header_background_color  = get_post_meta( $page_id, 'qodef_vertical_header_background_color_meta', true );
		$disable_vertical_background_image = get_post_meta( $page_id, 'qodef_disable_vertical_header_background_image_meta', true );
		$vertical_background_image         = get_post_meta( $page_id, 'qodef_vertical_header_background_image_meta', true );
		$vertical_shadow                   = get_post_meta( $page_id, 'qodef_vertical_header_shadow_meta', true );
		$vertical_border                   = get_post_meta( $page_id, 'qodef_vertical_header_border_meta', true );
		
		if ( ! empty( $vertical_header_background_color ) ) {
			$header_area_style['background-color'] = $vertical_header_background_color;
		}
		
		if ( $disable_vertical_background_image == 'yes' ) {
			$header_area_style['background-image'] = 'none';
		} elseif ( $vertical_background_image !== '' ) {
			$header_area_style['background-image'] = 'url(' . $vertical_background_image . ')';
		}
		
		if ( $vertical_shadow == 'yes' ) {
			$header_area_style['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
		}
		
		if ( $vertical_border == 'yes' ) {
			$header_border_color = get_post_meta( $page_id, 'qodef_vertical_header_border_color_meta', true );
			
			if ( $header_border_color !== '' ) {
				$header_area_style['border-right'] = '1px solid ' . $header_border_color;
			}
		}
		
		$current_style = '';
		
		if ( ! empty( $header_area_style ) ) {
			$current_style .= byanca_select_dynamic_css( $header_area_selector, $header_area_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'byanca_select_filter_add_header_page_custom_style', 'byanca_select_header_vertical_per_page_custom_styles', 10, 3 );
}

if ( ! function_exists( 'byanca_select_vertical_header_style_type_class' ) ) {
	/**
	 * Function that adds vertical header style type class to body tag
	 */
	function byanca_select_vertical_header_style_type_class( $classes ) {
		$vertical_header_style_type = byanca_select_get_meta_field_intersect( 'vertical_header_style_type', byanca_select_get_page_id() );

		if (!empty($vertical_header_style_type)) {
			$classes[] = 'qodef-header-vertical-' . $vertical_header_style_type;
		}

		return $classes;
	}

	add_filter( 'body_class', 'byanca_select_vertical_header_style_type_class' );
}