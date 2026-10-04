<?php

if ( ! function_exists( 'byanca_select_sidebar_options_map' ) ) {
	function byanca_select_sidebar_options_map() {
		
		byanca_select_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'byanca' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = byanca_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'byanca' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		byanca_select_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'byanca' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'byanca' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => byanca_select_get_custom_sidebars_options()
		) );

		byanca_select_add_admin_field(
            array(
	            'name'          => 'sidebar_type',
	            'type'          => 'select',
	            'label'         => esc_html__('Sidebar Type', 'byanca'),
	            'description'   => esc_html__('Choose a type of Sidebar', 'byanca'),
	            'parent'        => $sidebar_panel,
	            'default_value' => '',
                'options'       => array(
	                'standard' => esc_html__( 'Standard', 'byanca' ),
	                'custom'   => esc_html__( 'Custom', 'byanca' )
                )
            )
        );
		
		$byanca_custom_sidebars = byanca_select_get_custom_sidebars();
		if ( count( $byanca_custom_sidebars ) > 0 ) {
			byanca_select_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'byanca' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'byanca' ),
				'parent'      => $sidebar_panel,
				'options'     => $byanca_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'byanca_select_action_options_map', 'byanca_select_sidebar_options_map', byanca_select_set_options_map_position( 'sidebar' ) );
}