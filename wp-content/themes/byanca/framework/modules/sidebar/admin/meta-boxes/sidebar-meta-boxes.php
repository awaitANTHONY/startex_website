<?php

if ( ! function_exists( 'byanca_select_map_sidebar_meta' ) ) {
	function byanca_select_map_sidebar_meta() {
		$qodef_sidebar_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => apply_filters( 'byanca_select_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'byanca' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'byanca' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'byanca' ),
				'parent'      => $qodef_sidebar_meta_box,
                'options'       => byanca_select_get_custom_sidebars_options( true )
			)
		);

		byanca_select_create_meta_box_field(
            array(
	            'name'          => 'qodef_sidebar_type_meta',
	            'type'          => 'select',
	            'label'         => esc_html__('Sidebar Type', 'byanca'),
	            'description'   => esc_html__('Choose a type of Sidebar', 'byanca'),
	            'parent'        => $qodef_sidebar_meta_box,
	            'default_value' => '',
                'options'       => array(
	                ''         => esc_html__( 'Default', 'byanca' ),
	                'standard' => esc_html__( 'Standard', 'byanca' ),
	                'custom'   => esc_html__( 'Custom', 'byanca' )
                )
            )
        );
		
		$qodef_custom_sidebars = byanca_select_get_custom_sidebars();
		if ( count( $qodef_custom_sidebars ) > 0 ) {
			byanca_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'byanca' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'byanca' ),
					'parent'      => $qodef_sidebar_meta_box,
					'options'     => $qodef_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_sidebar_meta', 31 );
}