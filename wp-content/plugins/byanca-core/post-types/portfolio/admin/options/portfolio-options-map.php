<?php

if ( ! function_exists( 'byanca_select_portfolio_options_map' ) ) {
	function byanca_select_portfolio_options_map() {
		
		byanca_select_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'byanca-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = byanca_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'byanca-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'byanca-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'byanca-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'byanca-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'byanca-core' ),
				'parent'        => $panel_archive,
				'options'       => byanca_select_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'byanca-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'byanca-core' ),
				'default_value' => 'normal',
				'options'       => byanca_select_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'byanca-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'byanca-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'byanca-core' ),
					'landscape' => esc_html__( 'Landscape', 'byanca-core' ),
					'portrait'  => esc_html__( 'Portrait', 'byanca-core' ),
					'square'    => esc_html__( 'Square', 'byanca-core' )
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'byanca-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'byanca-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'byanca-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'byanca-core' )
				)
			)
		);
		
		$panel = byanca_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'byanca-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'byanca-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'byanca-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = byanca_select_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'byanca-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'byanca-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => byanca_select_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'byanca-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'byanca-core' ),
				'default_value' => 'normal',
				'options'       => byanca_select_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = byanca_select_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'byanca-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'byanca-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => byanca_select_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'byanca-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'byanca-core' ),
				'default_value' => 'normal',
				'options'       => byanca_select_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'byanca-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'byanca-core' ),
					'yes' => esc_html__( 'Yes', 'byanca-core' ),
					'no'  => esc_html__( 'No', 'byanca-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'byanca-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'byanca-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'byanca-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'byanca-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'byanca-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'byanca-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'byanca-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = byanca_select_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'byanca-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'byanca-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'byanca-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'byanca-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_options_map', 'byanca_select_portfolio_options_map', byanca_select_set_options_map_position( 'portfolio' ) );
}