<?php

if ( ! function_exists( 'byanca_select_get_blog_list_types_options' ) ) {
	function byanca_select_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'byanca_select_filter_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'byanca_select_blog_options_map' ) ) {
	function byanca_select_blog_options_map() {
		$blog_list_type_options = byanca_select_get_blog_list_types_options();
		
		byanca_select_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'byanca' ),
				'icon'  => 'fa fa-files-o'
			)
		);
		
		/**
		 * Blog Lists
		 */
		$panel_blog_lists = byanca_select_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'byanca' )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'        => 'blog_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'byanca' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for blog post lists. Default value is large', 'byanca' ),
				'options'     => byanca_select_get_space_between_items_array( true ),
				'parent'      => $panel_blog_lists
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'byanca' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'byanca' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'byanca' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'byanca' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
                'options'       => byanca_select_get_custom_sidebars_options(),
			)
		);
		
		$byanca_custom_sidebars = byanca_select_get_custom_sidebars();
		if ( count( $byanca_custom_sidebars ) > 0 ) {
			byanca_select_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'byanca' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'byanca' ),
					'parent'      => $panel_blog_lists,
					'options'     => byanca_select_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_masonry_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Layout', 'byanca' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'byanca' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'byanca' ),
					'full-width' => esc_html__( 'Full Width', 'byanca' )
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_masonry_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Number of Columns', 'byanca' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'byanca' ),
				'parent'        => $panel_blog_lists,
				'options'       => byanca_select_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Space Between Items', 'byanca' ),
				'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'byanca' ),
				'default_value' => 'normal',
				'options'       => byanca_select_get_space_between_items_array(),
				'parent'        => $panel_blog_lists
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_list_featured_image_proportion',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'byanca' ),
				'default_value' => 'fixed',
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'byanca' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'fixed'    => esc_html__( 'Fixed', 'byanca' ),
					'original' => esc_html__( 'Original', 'byanca' )
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'byanca' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'byanca' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'byanca' ),
					'load-more'       => esc_html__( 'Load More', 'byanca' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'byanca' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'byanca' )
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'byanca' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'byanca' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_tags_area_blog',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Blog Tags on Standard List', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show tags on standard blog list', 'byanca' ),
				'parent'        => $panel_blog_lists
			)
		);
		
		/**
		 * Blog Single
		 */
		$panel_blog_single = byanca_select_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'byanca' )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'        => 'blog_single_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'byanca' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for Blog Single pages. Default value is large', 'byanca' ),
				'options'     => byanca_select_get_space_between_items_array( true ),
				'parent'      => $panel_blog_single
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'byanca' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'byanca' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
                'options'       => byanca_select_get_custom_sidebars_options()
			)
		);
		
		if ( count( $byanca_custom_sidebars ) > 0 ) {
			byanca_select_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'byanca' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'byanca' ),
					'parent'      => $panel_blog_single,
					'options'     => byanca_select_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'byanca' ),
				'parent'        => $panel_blog_single,
				'options'       => byanca_select_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'byanca' ),
				'parent'        => $panel_blog_single,
				'dependency' => array(
					'hide' => array(
						'show_title_area_blog' => 'no'
					)
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'byanca' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'byanca' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'byanca' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'byanca' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_navigation_container = byanca_select_add_admin_container(
			array(
				'name'            => 'qodef_blog_single_navigation_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_single_navigation' => 'yes'
					)
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'byanca' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'byanca' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages. Author biographic info field in Users section must contain some data', 'byanca' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_author_info_container = byanca_select_add_admin_container(
			array(
				'name'            => 'qodef_blog_single_author_info_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_author_info' => 'yes'
					)
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'byanca' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'byanca' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		do_action( 'byanca_select_action_blog_single_options_map', $panel_blog_single );
	}
	
	add_action( 'byanca_select_action_options_map', 'byanca_select_blog_options_map', byanca_select_set_options_map_position( 'blog' ) );
}