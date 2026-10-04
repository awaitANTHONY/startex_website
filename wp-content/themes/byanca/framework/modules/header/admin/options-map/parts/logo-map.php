<?php

if ( ! function_exists( 'byanca_select_logo_options_map' ) ) {
	function byanca_select_logo_options_map() {
		
		byanca_select_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'byanca' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = byanca_select_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'byanca' )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'byanca' )
			)
		);
		
		$hide_logo_container = byanca_select_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'byanca' ),
				'parent'        => $hide_logo_container
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'byanca' ),
				'parent'        => $hide_logo_container
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'byanca' ),
				'parent'        => $hide_logo_container
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'byanca' ),
				'parent'        => $hide_logo_container
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'byanca' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'byanca_select_action_options_map', 'byanca_select_logo_options_map', byanca_select_set_options_map_position( 'logo' ) );
}