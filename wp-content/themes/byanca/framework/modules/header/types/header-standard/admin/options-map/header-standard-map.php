<?php

if ( ! function_exists( 'byanca_select_get_hide_dep_for_header_standard_options' ) ) {
	function byanca_select_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'byanca_select_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'byanca_select_header_standard_map' ) ) {
	function byanca_select_header_standard_map( $parent ) {
		$hide_dep_options = byanca_select_get_hide_dep_for_header_standard_options();
		
		byanca_select_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'byanca' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'byanca' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'byanca' ),
					'left'   => esc_html__( 'Left', 'byanca' ),
					'center' => esc_html__( 'Center', 'byanca' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_additional_header_menu_area_options_map', 'byanca_select_header_standard_map' );
}