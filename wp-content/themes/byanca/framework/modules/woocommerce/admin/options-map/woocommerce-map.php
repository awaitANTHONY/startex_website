<?php

if ( ! function_exists( 'byanca_select_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function byanca_select_woocommerce_options_map() {
		
		byanca_select_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'byanca' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = byanca_select_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'byanca' )
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'name'        => 'woo_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'byanca' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for main shop page', 'byanca' ),
				'options'     => byanca_select_get_space_between_items_array( true ),
				'parent'      => $panel_product_list
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'byanca' ),
				'default_value' => 'qodef-woocommerce-columns-3',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'byanca' ),
				'options'       => array(
					'qodef-woocommerce-columns-3' => esc_html__( '3 Columns', 'byanca' ),
					'qodef-woocommerce-columns-4' => esc_html__( '4 Columns', 'byanca' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'byanca' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'byanca' ),
				'default_value' => 'normal',
				'options'       => byanca_select_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'byanca' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'byanca' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'byanca' ),
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'byanca' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'qodef_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'byanca' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'byanca' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'byanca' ),
				'default_value' => 'h4',
				'options'       => byanca_select_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'byanca' ),
				'parent'        => $panel_product_list
			)
		);

		byanca_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_disable_star_rating',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Star Rating', 'byanca' ),
				'description'   => esc_html__( 'Disabling this option will remove star rating on default product lists', 'byanca' ),
				'parent'        => $panel_product_list
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = byanca_select_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'byanca' )
			)
		);

		byanca_select_add_admin_field(array(
			'name'        	=> 'single_product_layout',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Single Product Layout', 'byanca'),
			'default_value'	=> 'simple',
			'description' 	=> esc_html__('Select single product page layout', 'byanca'),
			'options'		=> array(
				'simple'     => esc_html__('Simple', 'byanca'),
				'standard'     => esc_html__('Standard', 'byanca'),
				'wide-gallery' => esc_html__('Wide Gallery', 'byanca'),
                'sticky-info'  => esc_html__('Sticky Info', 'byanca')
			),
			'parent'      	=> $panel_single_product
		));

		/********************** Standard - Single Product Layout **********************/

		$panel_single_product_standard = byanca_select_add_admin_container(array(
			'name' => 'panel_single_product_standard',
			'parent' => $panel_single_product,
			'dependency' => array(
				'hide' => array(
					'single_product_layout'  => array('wide-gallery', 'sticky-info')
				)
			)
		));

			byanca_select_add_admin_field(array(
				'name'          => 'woo_set_thumb_images_position',
				'type'          => 'select',
				'label'         => esc_html__('Set Thumbnail Images Position', 'byanca'),
				'default_value' => 'below-image',
				'options'		=> array(
					'below-image'  => esc_html__('Below Featured Image', 'byanca'),
					'on-left-side' => esc_html__('On The Left Side Of Featured Image', 'byanca')
				),
				'parent'        => $panel_single_product_standard
			));


	/********************** Standard - Single Product Layout **********************/

	/********************** Sticky Info - Single Product Layout **********************/

		$panel_single_product_sticky_info = byanca_select_add_admin_container(array(
			'name' => 'panel_single_product_sticky_info',
			'parent' => $panel_single_product,
			'hidden_property' => 'single_product_layout',
			'dependency' => array(
				'show' => array(
					'single_product_layout'  => array('sticky-info')
				)
			)
		));

			byanca_select_add_admin_field(array(
				'name'          => 'woo_enable_single_sticky_content',
				'type'          => 'yesno',
				'label'         => esc_html__('Sticky Side Text', 'byanca'),
				'description'   => esc_html__('Enabling this option will make side text sticky on Single Product pages', 'byanca'),
				'default_value' => 'yes',
				'parent'        => $panel_single_product_sticky_info
			));

	/********************** Sticky Info - Single Product Layout **********************/

		byanca_select_add_admin_field(array(
			'name'          => 'single_product_additional_info_position',
			'type'          => 'select',
			'label'         => esc_html__('Set Product Additional Info Position', 'byanca'),
			'default_value' => 'below-featured-image',
			'description'   => esc_html__('Set additional info position for single product layout (Description / Review / Additional Info)', 'byanca'),
			'options'		=> array(
				'below-featured-image' => esc_html__('Below Featured Image', 'byanca'),
				'inside-summary'  => esc_html__('Inside Summary', 'byanca')
			),
			'parent'        => $panel_single_product
		));

		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'byanca' ),
				'parent'        => $panel_single_product,
				'options'       => byanca_select_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_single_product_title_tag',
				'default_value' => 'h3',
				'label'         => esc_html__( 'Single Product Title Tag', 'byanca' ),
				'options'       => byanca_select_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '4',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'byanca' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'byanca' ),
					'3' => esc_html__( 'Three', 'byanca' ),
					'2' => esc_html__( 'Two', 'byanca' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'byanca' ),
				'parent'        => $panel_single_product,
				'options'       => byanca_select_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'byanca' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'byanca' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'byanca' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'byanca' ),
				'default_value' => 'qodef-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'byanca' ),
				'options'       => array(
					'qodef-woocommerce-columns-3' => esc_html__( '3 Columns', 'byanca' ),
					'qodef-woocommerce-columns-4' => esc_html__( '4 Columns', 'byanca' )
				),
				'parent'        => $panel_single_product,
			)
		);

		byanca_select_add_admin_field(
            array(
                'type'        => 'text',
                'name'        => 'woo_single_product_page_padding',
                'label'       => esc_html__('Page Padding', 'byanca'),
                'description' => esc_html__('Define padding for Single Product Page in format top right bottom left', 'byanca'),
                'parent'      => $panel_single_product,
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

		byanca_select_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'woo_single_product_bottom_background_color',
				'label'       => esc_html__( 'Bottom Section Background Color', 'byanca' ),
				'description' => esc_html__( 'Choose a background color for single product layout bottom section (Related Products, ...)', 'byanca' ),
				'parent'      => $panel_single_product
			)
		);

		do_action('byanca_select_woocommerce_additional_options_map');
	}
	
	add_action( 'byanca_select_action_options_map', 'byanca_select_woocommerce_options_map', byanca_select_set_options_map_position( 'woocommerce' ) );
}