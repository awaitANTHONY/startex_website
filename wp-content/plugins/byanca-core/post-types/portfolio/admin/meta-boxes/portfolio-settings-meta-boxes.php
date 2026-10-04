<?php

if ( ! function_exists( 'byanca_core_map_portfolio_settings_meta' ) ) {
	function byanca_core_map_portfolio_settings_meta() {
		$meta_box = byanca_select_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'byanca-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		byanca_select_create_meta_box_field( array(
			'name'        => 'qodef_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'byanca-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'byanca-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'byanca-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'byanca-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'byanca-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'byanca-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'byanca-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'byanca-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'byanca-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'byanca-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'byanca-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'byanca-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'byanca-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'byanca-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = byanca_select_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'qodef_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'byanca-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'byanca-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => byanca_select_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'byanca-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'byanca-core' ),
				'default_value' => '',
				'options'       => byanca_select_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = byanca_select_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'qodef_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'byanca-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'byanca-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => byanca_select_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'byanca-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'byanca-core' ),
				'default_value' => '',
				'options'       => byanca_select_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'byanca-core' ),
				'parent'        => $meta_box,
				'options'       => byanca_select_get_yes_no_select_array()
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'byanca-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'byanca-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'byanca-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'byanca-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'byanca-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'byanca-core' ),
				'parent'      => $meta_box
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'byanca-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'byanca-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'byanca-core' ),
					'small'              => esc_html__( 'Small', 'byanca-core' ),
					'large-width'        => esc_html__( 'Large Width', 'byanca-core' ),
					'large-height'       => esc_html__( 'Large Height', 'byanca-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'byanca-core' )
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'byanca-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'byanca-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'byanca-core' ),
					'large-width' => esc_html__( 'Large Width', 'byanca-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'byanca-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'byanca-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_core_map_portfolio_settings_meta', 41 );
}