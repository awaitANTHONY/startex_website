<?php

if ( ! function_exists( 'byanca_select_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function byanca_select_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'byanca_select_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'byanca_select_header_standard_meta_map' ) ) {
	function byanca_select_header_standard_meta_map( $parent ) {
		$hide_dep_options = byanca_select_get_hide_dep_for_header_standard_meta_boxes();
		
		byanca_select_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'qodef_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'byanca' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'byanca' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'byanca' ),
					'left'   => esc_html__( 'Left', 'byanca' ),
					'right'  => esc_html__( 'Right', 'byanca' ),
					'center' => esc_html__( 'Center', 'byanca' )
				),
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_additional_header_area_meta_boxes_map', 'byanca_select_header_standard_meta_map' );
}