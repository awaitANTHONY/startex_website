<?php

if ( ! function_exists( 'byanca_select_woocommerce_dropdown_cart_options_map' ) ) {
	
	/**
	 * Add Woocommerce dropdown cart options to WooCommerce options page
	 */
	function byanca_select_woocommerce_dropdown_cart_options_map() {
		
		/**
		 * WooCommerce Dropdown Cart Settings
		 */
		$panel_dropdown_cart = byanca_select_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_dropdown_cart',
				'title' => esc_html__( 'Dropdown Cart', 'byanca' )
			)
		);	

		byanca_select_add_admin_field(
			array(
				'parent'        => $panel_dropdown_cart,
				'type'          => 'select',
				'name'          => 'dropdown_cart_type',
				'default_value' => 'icon_based',
				'label'         => esc_html__( 'Select Drodown Cart Type', 'byanca' ),
				'description'   => esc_html__( 'Choose dropdown cart type to use', 'byanca' ),
				'options'       => array(
					'icon_based' => esc_html__( 'Icon Based', 'byanca' ),
					'plain_text' => esc_html__( 'Plain Text', 'byanca' )
				)
			)
		);

		$dropdwon_cart_type_icon_based_container = byanca_select_add_admin_container(
			array(
				'parent'          => $panel_dropdown_cart,
				'name'            => 'dropdwon_cart_type_icon_based_container',
				'dependency' => array(
					'show' => array(
						'dropdown_cart_type' => 'icon_based'
					)
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'parent'        => $dropdwon_cart_type_icon_based_container,
				'type'          => 'select',
				'name'          => 'dropdown_cart_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Drodown Cart Icon Source', 'byanca' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'byanca' ),
				'options'       => byanca_select_get_icon_sources_array( false, false )
			)
		);

		$dropdwon_cart_icon_pack_container = byanca_select_add_admin_container(
			array(
				'parent'          => $dropdwon_cart_type_icon_based_container,
				'name'            => 'dropdwon_cart_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'dropdown_cart_icon_source' => 'icon_pack'
					)
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'parent'        => $dropdwon_cart_icon_pack_container,
				'type'          => 'select',
				'name'          => 'dropdown_cart_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Dropdown Cart Icon Pack', 'byanca' ),
				'description'   => esc_html__( 'Choose icon pack for dropdown cart icon', 'byanca' ),
				'options'       => byanca_select_icon_collections()->getIconCollectionsExclude( array( 'font_awesome', 'ion_icons', 'linear_icons', 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$dropdwon_cart_icon_svg_path_container = byanca_select_add_admin_container(
			array(
				'parent'          => $dropdwon_cart_type_icon_based_container,
				'name'            => 'dropdwon_cart_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'dropdown_cart_icon_source' => 'svg_path'
					)
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'parent'      => $dropdwon_cart_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'dropdown_cart_icon_svg_path',
				'label'       => esc_html__( 'Dropdown Cart Icon SVG Path', 'byanca' ),
				'description' => esc_html__( 'Enter your dropdown cart icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'byanca' ),
			)
		);

		$icon_style_group = byanca_select_add_admin_group(
			array(
				'parent'      => $dropdwon_cart_type_icon_based_container,
				'name'        => 'dropdown_cart_icon_style_group',
				'title'       => esc_html__( 'Dropdown Cart Icon Style', 'byanca' ),
				'description' => esc_html__( 'Define styles for dropdown cart icon', 'byanca' )
			)
		);

		$icon_colors_row = byanca_select_add_admin_row(
			array(
				'parent' => $icon_style_group,
				'name'   => 'icon_colors_row'
			)
		);

		byanca_select_add_admin_field(
			array(
				'parent' => $icon_colors_row,
				'name'   => 'dropdown_cart_icon_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Icon Color', 'byanca' )
			)
		);

		byanca_select_add_admin_field(
			array(
				'parent' => $icon_colors_row,
				'name'   => 'dropdown_cart_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Icon Hover Color', 'byanca' )
			)
		);

		$dropdwon_cart_type_plain_text_container = byanca_select_add_admin_container(
			array(
				'parent'          => $panel_dropdown_cart,
				'name'            => 'dropdwon_cart_type_plain_text_container',
				'dependency' => array(
					'show' => array(
						'dropdown_cart_type' => 'plain_text'
					)
				)
			)
		);

		$text_style_group = byanca_select_add_admin_group(
			array(
				'parent'      => $dropdwon_cart_type_plain_text_container,
				'name'        => 'dropdown_cart_text_style_group',
				'title'       => esc_html__( 'Dropdown Cart Text Style', 'byanca' ),
				'description' => esc_html__( 'Define styles for dropdown cart text', 'byanca' )
			)
		);

		$text_colors_row = byanca_select_add_admin_row(
			array(
				'parent' => $text_style_group,
				'name'   => 'text_colors_row'
			)
		);

		byanca_select_add_admin_field(
			array(
				'parent' => $text_colors_row,
				'name'   => 'dropdown_cart_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'byanca' )
			)
		);

	}
	
	add_action( 'byanca_select_woocommerce_additional_options_map', 'byanca_select_woocommerce_dropdown_cart_options_map');
}