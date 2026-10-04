<?php

if ( ! function_exists( 'byanca_select_get_hide_dep_for_header_widget_areas_meta_boxes' ) ) {
	function byanca_select_get_hide_dep_for_header_widget_areas_meta_boxes() {
		$hide_dep_options = apply_filters( 'byanca_select_filter_header_widget_areas_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'byanca_select_get_hide_dep_for_header_widget_area_two_meta_boxes' ) ) {
	function byanca_select_get_hide_dep_for_header_widget_area_two_meta_boxes() {
		$hide_dep_options = apply_filters( 'byanca_select_filter_header_widget_area_two_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'byanca_select_header_widget_areas_meta_options_map' ) ) {
	function byanca_select_header_widget_areas_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= byanca_select_get_hide_dep_for_header_widget_areas_meta_boxes();
		$hide_dep_widget_area_two 	= byanca_select_get_hide_dep_for_header_widget_area_two_meta_boxes();
		
		$header_widget_areas_container = byanca_select_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_widget_areas_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta' => $hide_dep_widgets
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		byanca_select_add_admin_section_title(
			array(
				'parent' => $header_widget_areas_container,
				'name'   => 'header_widget_areas',
				'title'  => esc_html__( 'Widget Areas', 'byanca' )
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_header_widget_areas_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Widget Areas', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will hide widget areas from header', 'byanca' ),
				'parent'        => $header_widget_areas_container,
			)
		);

		$header_custom_widget_areas_container = byanca_select_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_custom_widget_areas_container',
				'parent'     => $header_widget_areas_container,
				'dependency' => array(
					'hide' => array(
						'qodef_disable_header_widget_areas_meta' => 'yes'
					)
				)
			)
		);
					
		$byanca_custom_sidebars = byanca_select_get_custom_sidebars();
		if ( count( $byanca_custom_sidebars ) > 0 ) {
			byanca_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_header_widget_area_one_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area One', 'byanca' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'byanca' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $byanca_custom_sidebars
				)
			);
		}

		if ( count( $byanca_custom_sidebars ) > 0 ) {
			byanca_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_header_widget_area_two_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area Two', 'byanca' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'byanca' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $byanca_custom_sidebars,
					'dependency' => array(
						'hide' => array(
							'qodef_header_type_meta' => $hide_dep_widget_area_two
						)
					)
				)
			);
		}
		
		do_action( 'byanca_select_header_widget_areas_additional_meta_boxes_map', $header_widget_areas_container );
	}
	
	add_action( 'byanca_select_action_header_widget_areas_meta_boxes_map', 'byanca_select_header_widget_areas_meta_options_map', 10, 1 );
}