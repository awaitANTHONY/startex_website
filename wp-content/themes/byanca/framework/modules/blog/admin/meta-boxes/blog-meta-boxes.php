<?php

foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'byanca_select_map_blog_meta' ) ) {
	function byanca_select_map_blog_meta() {
		$qodef_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$qodef_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'byanca' ),
				'name'  => 'blog_meta'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'byanca' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'byanca' ),
				'parent'      => $blog_meta_box,
				'options'     => $qodef_blog_categories
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'byanca' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'byanca' ),
				'parent'      => $blog_meta_box,
				'options'     => $qodef_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'byanca' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'byanca' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'byanca' ),
					'in-grid'    => esc_html__( 'In Grid', 'byanca' ),
					'full-width' => esc_html__( 'Full Width', 'byanca' )
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'byanca' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'byanca' ),
				'parent'      => $blog_meta_box,
				'options'     => byanca_select_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'byanca' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'byanca' ),
				'options'     => byanca_select_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'byanca' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'byanca' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'byanca' ),
					'fixed'    => esc_html__( 'Fixed', 'byanca' ),
					'original' => esc_html__( 'Original', 'byanca' )
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'byanca' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'byanca' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'byanca' ),
					'standard'        => esc_html__( 'Standard', 'byanca' ),
					'load-more'       => esc_html__( 'Load More', 'byanca' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'byanca' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'byanca' )
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'qodef_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'byanca' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'byanca' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_blog_meta', 30 );
}