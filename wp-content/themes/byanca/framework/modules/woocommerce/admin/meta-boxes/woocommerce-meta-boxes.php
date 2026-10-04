<?php

if ( ! function_exists( 'byanca_select_map_woocommerce_meta' ) ) {
	function byanca_select_map_woocommerce_meta() {

		$woocommerce_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'byanca' ),
				'name'  => 'woo_product_meta'
			)
		);

		byanca_select_create_meta_box_field(array(
            'name'        => 'qodef_single_product_layout_meta',
            'type'        => 'select',
            'label'       => esc_html__('Single Product Layout', 'byanca'),
            'description' => esc_html__('Select single product page layout', 'byanca'),
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                ''             => esc_html__('Default', 'byanca'),
                'simple'     => esc_html__('Simple', 'byanca'),
                'standard'     => esc_html__('Standard', 'byanca'),
                'wide-gallery' => esc_html__('Wide Gallery', 'byanca'),
                'sticky-info'  => esc_html__('Sticky Info', 'byanca')
            )
        ));

		$show_standard_layout_container = byanca_select_add_admin_container(
            array(
                'parent' => $woocommerce_meta_box,
                'name' => 'qodef_show_standard_layout_container',
                'dependency' => array(
					'hide' => array(
						'qodef_single_product_layout_meta'  => array('', 'wide-gallery', 'sticky-info')
					)
				)
            )
        );

		byanca_select_create_meta_box_field(
			array(
				'name'    => 'qodef_woo_set_thumb_images_position_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Set Thumbnail Images Position', 'byanca' ),
				'options' => array(
					''             => esc_html__( 'Default', 'byanca' ),
					'below-image'  => esc_html__( 'Below Featured Image', 'byanca' ),
					'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'byanca' )
				),
				'parent'  => $show_standard_layout_container
			)
		);

		$show_sticky_info_layout_container = byanca_select_add_admin_container(
            array(
                'parent' => $woocommerce_meta_box,
                'name' => 'qodef_show_sticky_info_layout_container',
                'dependency' => array(
					'show' => array(
						'qodef_single_product_layout_meta'  => array('sticky-info')
					)
				)
            )
        );

		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_woo_enable_single_sticky_content_meta',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Sticky Side Text', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Product pages', 'byanca' ),
				'parent'        => $show_sticky_info_layout_container
			)
		);

		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_single_product_additional_info_position_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Set Product Additional Info Position', 'byanca' ),
				'description'   => esc_html__( 'Set additional info position for single product layout (Description / Review / Additional Info)', 'byanca' ),
				'options'       => array(
					''                     => esc_html__( 'Default', 'byanca' ),
					'inside-summary'       => esc_html__( 'Inside Summary', 'byanca' ),
					'below-featured-image' => esc_html__( 'Below Featured Image', 'byanca' )
				),
				'parent'        => $woocommerce_meta_box
			)
		);

		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'byanca' ),
				'description' => esc_html__( 'Choose image layout when it appears in Select Product List - Masonry layout shortcode', 'byanca' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'byanca' ),
					'small'              => esc_html__( 'Small', 'byanca' ),
					'large-width'        => esc_html__( 'Large Width', 'byanca' ),
					'large-height'       => esc_html__( 'Large Height', 'byanca' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'byanca' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);

		byanca_select_create_meta_box_field(
            array(
                'name'          => 'qodef_product_featured_image_size_original_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Dimensions for Product List Shortcode - Image Original Proportion', 'byanca' ),
                'description'   => esc_html__( 'Choose image layout when it appears in Masonry type product lists where image proportion is original', 'byanca' ),
                'default_value' => 'default',
                'parent'        => $woocommerce_meta_box,
                'options'       => array(
                    'qodef-default'     => esc_html__( 'Default', 'byanca' ),
                    'qodef-large-width' => esc_html__( 'Large Width', 'byanca' )
                )
            )
        );

		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'byanca' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'byanca' ),
				'options'       => byanca_select_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);

		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'byanca' ),
				'parent'        => $woocommerce_meta_box
			)
		);

		byanca_select_create_meta_box_field(
            array(
                'type'        => 'text',
                'name'        => 'qodef_woo_single_product_page_padding_meta',
                'label'       => esc_html__('Page Padding', 'byanca'),
                'description' => esc_html__('Define padding for Single Product Page in format top right bottom left', 'byanca'),
                'parent'      => $woocommerce_meta_box,
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_woo_single_product_bottom_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Bottom Section Background Color', 'byanca' ),
				'description' => esc_html__( 'Choose a background color for single product layout bottom section (Related Products, ...)', 'byanca' ),
				'parent'      => $woocommerce_meta_box
			)
		);

		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_woo_product_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Product List Image', 'byanca' ),
				'description' => esc_html__( 'Choose an Image for displaying in product list shortcode. If not uploaded, product image will be shown.', 'byanca' ),
				'parent'      => $woocommerce_meta_box
			)
		);

		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_woo_product_unique_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Product Unique Image', 'byanca' ),
				'description' => esc_html__( 'Choose an Image for displaying in product list shortcode unique cases. If not uploaded, product list image will be shown, then product image.', 'byanca' ),
				'parent'      => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_woocommerce_meta', 99 );
}