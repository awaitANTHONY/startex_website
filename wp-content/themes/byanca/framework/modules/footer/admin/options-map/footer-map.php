<?php

if ( ! function_exists( 'byanca_select_footer_options_map' ) ) {
	function byanca_select_footer_options_map() {

		byanca_select_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'byanca' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = byanca_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'byanca' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'byanca' ),
				'parent'        => $footer_panel
			)
		);

        byanca_select_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'byanca' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'byanca' ),
                'parent'        => $footer_panel,
            )
        );

		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'byanca' ),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = byanca_select_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'byanca' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'byanca' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'byanca' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'byanca' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'byanca' ),
					'left'   => esc_html__( 'Left', 'byanca' ),
					'center' => esc_html__( 'Center', 'byanca' ),
					'right'  => esc_html__( 'Right', 'byanca' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		byanca_select_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'byanca' ),
				'description' => esc_html__( 'Set background color for top footer area', 'byanca' ),
				'parent'      => $show_footer_top_container
			)
		);

		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'byanca' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = byanca_select_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'byanca' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'byanca' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		byanca_select_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'byanca' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'byanca' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'byanca_select_action_options_map', 'byanca_select_footer_options_map', byanca_select_set_options_map_position( 'footer' ) );
}