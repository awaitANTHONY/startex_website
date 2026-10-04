<?php

namespace ByancaCore\CPT\Shortcodes\ProductList;

use ByancaCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_product_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product List', 'byanca' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list extended-custom-icon',
					'category'                  => esc_html__( 'by BYANCA', 'byanca' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'byanca' ),
							'value'       => array(
								esc_html__( 'Standard', 'byanca' )          => 'standard',
								esc_html__( 'Masonry', 'byanca' )           => 'masonry',
								esc_html__( 'Natural Masonry', 'byanca' )   => 'natural-masonry',
								esc_html__( 'Justified Gallery', 'byanca' ) => 'justified-gallery'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_position',
							'heading'     => esc_html__( 'Product Info Position', 'byanca' ),
							'value'       => array(
								esc_html__( 'Info On Image Hover', 'byanca' )            => 'info-on-image',
								esc_html__( 'Info On Image Hover - Simple', 'byanca' )   => 'info-on-image-simple',
								esc_html__( 'Info On Image Hover - Minimal', 'byanca' )  => 'info-on-image-minimal',
								esc_html__( 'Info On Image Hover - Centered', 'byanca' ) => 'info-on-image-centered',
								esc_html__( 'Info On Image Hover - Bottom', 'byanca' )   => 'info-on-image-bottom',
								esc_html__( 'Info On Image Hover - Custom', 'byanca' )   => 'info-on-image-custom',
								esc_html__( 'Info Below Image', 'byanca' )               => 'info-below-image',
								esc_html__( 'Info Below Image - Simple', 'byanca' )      => 'info-below-image-simple',
								esc_html__( 'Info Below Image - Minimal', 'byanca' )     => 'info-below-image-minimal',
								esc_html__( 'Info Below Image - Centered', 'byanca' )    => 'info-below-image-centered'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'byanca' ),
							'value'       => array_flip( byanca_select_get_number_of_columns_array( true ) ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'standard', 'masonry', 'natural-masonry' ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'byanca' ),
							'value'       => array_flip( array_merge( array( 'gigantic' => esc_html__( 'Gigantic (60)', 'byanca' ) ), byanca_select_get_space_between_items_array() ) ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'standard', 'masonry', 'natural-masonry' ) ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value',
							'heading'     => esc_html__( 'Custom Space Between Items (px)', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height',
							'heading'     => esc_html__( 'Row Height', 'byanca' ),
							'description' => esc_html__( 'Targeted row height, which may vary depending on the proportions of the images.', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'content_top_margin',
							'heading'    => esc_html__( 'Content Top Margin (px or %)', 'byanca' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'content_bottom_margin',
							'heading'    => esc_html__( 'Content Bottom Margin (px or %)', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'on_hover_behavior',
							'heading'     => esc_html__( 'On Hover Behavior', 'byanca' ),
							'value'       => array(
								esc_html__( 'Default', 'byanca' )    => '',
								esc_html__( 'Image Zoom', 'byanca' ) => 'zoom'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'byanca' ),
							'value'       => array_flip( byanca_select_get_query_order_by_array( false, array( 'on-sale' => esc_html__( 'On Sale', 'byanca' ) ) ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'byanca' ),
							'value'       => array_flip( byanca_select_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'taxonomy_to_display',
							'heading'     => esc_html__( 'Choose Sorting Taxonomy', 'byanca' ),
							'value'       => array(
								esc_html__( 'Category', 'byanca' ) => 'category',
								esc_html__( 'Tag', 'byanca' )      => 'tag',
								esc_html__( 'Id', 'byanca' )       => 'id'
							),
							'save_always' => true,
							'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'taxonomy_values',
							'heading'     => esc_html__( 'Enter Taxonomy Values', 'byanca' ),
							'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_size',
							'heading'    => esc_html__( 'Image Proportions', 'byanca' ),
							'value'      => array(
								esc_html__( 'Default', 'byanca' )        => '',
								esc_html__( 'Original', 'byanca' )       => 'full',
								esc_html__( 'Square', 'byanca' )         => 'square',
								esc_html__( 'Landscape', 'byanca' )      => 'landscape',
								esc_html__( 'Portrait', 'byanca' )       => 'portrait',
								esc_html__( 'Medium', 'byanca' )         => 'medium',
								esc_html__( 'Large', 'byanca' )          => 'large',
								esc_html__( 'Shop Single', 'byanca' )    => 'woocommerce_single',
								esc_html__( 'Shop Thumbnail', 'byanca' ) => 'woocommerce_thumbnail'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_fixed_proportions',
							'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'byanca' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Set predefined image proportions for your masonry product list. This option will apply image proportions you set in Product Single page - dimensions for masonry option.', 'byanca' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'natural-masonry' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_title',
							'heading'    => esc_html__( 'Display Title', 'byanca' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_info_behavior',
							'heading'    => esc_html__( 'Product Info Behavior', 'byanca' ),
							'value'      => array(
								esc_html__( 'Show On Hover', 'byanca' ) => 'on-hover',
								esc_html__( 'Show Always', 'byanca' )   => 'always'
							),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_info_skin',
							'heading'    => esc_html__( 'Product Info Skin', 'byanca' ),
							'value'      => array(
								esc_html__( 'Default', 'byanca' ) => 'default',
								esc_html__( 'Light', 'byanca' )   => 'light',
								esc_html__( 'Dark', 'byanca' )    => 'dark'
							),
							'group'      => esc_html__( 'Product Info Style', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'byanca' ),
							'value'      => array_flip( byanca_select_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'byanca' ),
							'value'      => array_flip( byanca_select_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_category',
							'heading'    => esc_html__( 'Display Category', 'byanca' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image', 'info-on-image-centered', 'info-on-image-bottom', 'info-on-image-custom', 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_excerpt',
							'heading'    => esc_html__( 'Display Excerpt', 'byanca' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image', 'info-on-image-centered', 'info-on-image-bottom', 'info-on-image-custom', 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'byanca' ),
							'description' => esc_html__( 'Number of characters', 'byanca' ),
							'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Product Info Style', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_rating',
							'heading'    => esc_html__( 'Display Rating', 'byanca' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image', 'info-on-image-centered', 'info-on-image-bottom', 'info-on-image-custom', 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_price',
							'heading'    => esc_html__( 'Display Price', 'byanca' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_button',
							'heading'    => esc_html__( 'Display Button', 'byanca' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image', 'info-on-image-centered', 'info-on-image-bottom', 'info-on-image-custom', 'info-below-image', 'info-below-image-simple' ) ),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_skin',
							'heading'    => esc_html__( 'Button Skin', 'byanca' ),
							'value'      => array(
								esc_html__( 'Default', 'byanca' ) => 'default',
								esc_html__( 'Light', 'byanca' )   => 'light',
								esc_html__( 'Dark', 'byanca' )    => 'dark'
							),
							'dependency' => array( 'element' => 'display_button', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'byanca' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'shader_background_color',
							'heading'    => esc_html__( 'Shader Background Color', 'byanca' ),
							'group'      => esc_html__( 'Product Info Style', 'byanca' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_bottom_margin',
							'heading'    => esc_html__( 'Product Info Bottom Margin (px)', 'byanca' ),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-below-image', 'info-below-image-simple', 'info-below-image-minimal' ) ),
							'group'      => esc_html__( 'Product Info Style', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name' => 'additional_effect',
							'heading'    => esc_html__( 'Additional Effect', 'byanca' ),
							'value'      => array(
								esc_html__( 'None', 'byanca' )  => '',
								esc_html__( 'Loading Effect', 'byanca' ) => 'loading-effect',
							),
							'group'      => esc_html__( 'Additional Options', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value_1367_1440',
							'heading'     => esc_html__( 'Custom Space Between Items (px) on screen size between 1367px-1440px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height_1367_1440',
							'heading'     => esc_html__( 'Row Height on screen size between 1367px-1440px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value_1281_1366',
							'heading'     => esc_html__( 'Custom Space Between Items (px) on screen size between 1281px-1366px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height_1281_1366',
							'heading'     => esc_html__( 'Row Height on screen size between 1281px-1366px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value_1025_1280',
							'heading'     => esc_html__( 'Custom Space Between Items (px) on screen size between 1025px-1280px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height_1025_1280',
							'heading'     => esc_html__( 'Row Height on screen size between 1025px-1280px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value_769_1024',
							'heading'     => esc_html__( 'Custom Space Between Items (px) on screen size between 769px-1024px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height_769_1024',
							'heading'     => esc_html__( 'Row Height on screen size between 769px-1024px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value_681_768',
							'heading'     => esc_html__( 'Custom Space Between Items (px) on screen size between 681px-768px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height_681_768',
							'heading'     => esc_html__( 'Row Height on screen size between 681px-768px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value_481_680',
							'heading'     => esc_html__( 'Custom Space Between Items (px) on screen size between 481px-680px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height_481_680',
							'heading'     => esc_html__( 'Row Height on screen size between 481px-680px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'space_value_480',
							'heading'     => esc_html__( 'Custom Space Between Items (px) on screen size below 480px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'row_height_480',
							'heading'     => esc_html__( 'Row Height on screen size below 480px', 'byanca' ),
							'value'       => '',
							'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                     => 'standard',
			'info_position'            => 'info-on-image',
			'number_of_posts'          => '8',
			'number_of_columns'        => 'four',
			'space_between_items'      => 'normal',
			'space_value'              => '',
			'row_height'               => '',
			'content_top_margin'       => '',
			'content_bottom_margin'    => '',
			'on_hover_behavior'        => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'taxonomy_to_display'      => 'category',
			'taxonomy_values'          => '',
			'image_size'               => 'full',
			'enable_fixed_proportions' => 'no',
			'display_title'            => 'yes',
			'product_info_behavior'    => 'on-hover',
			'product_info_skin'        => '',
			'title_tag'                => 'h5',
			'title_transform'          => '',
			'display_category'         => 'no',
			'display_excerpt'          => 'no',
			'excerpt_length'           => '20',
			'display_rating'           => 'yes',
			'display_price'            => 'yes',
			'display_button'           => 'yes',
			'button_skin'              => 'default',
			'shader_background_color'  => '',
			'info_bottom_margin'       => '',
			'additional_effect'		   => '',
			'space_value_1367_1440'    => '',
			'row_height_1367_1440'     => '',
			'space_value_1281_1366'    => '',
			'row_height_1281_1366'     => '',
			'space_value_1025_1280'    => '',
			'row_height_1025_1280'     => '',
			'space_value_769_1024'     => '',
			'row_height_769_1024'      => '',
			'space_value_681_768'      => '',
			'row_height_681_768'       => '',
			'space_value_481_680'      => '',
			'row_height_481_680'       => '',
			'space_value_480'          => '',
			'row_height_480'           => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );

		$params['class_name']     = 'pli';
		$params['type']           = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		$params['info_position']  = ! empty( $params['info_position'] ) ? $params['info_position'] : $default_atts['info_position'];
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];

		$params['space_value'] = byanca_select_filter_px( $params['space_value'] );

		$additional_params                   = array();
		$additional_params['holder_data']    = $this->getHolderData( $params );
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		
		$queryArray                        = $this->generateProductQueryArray( $params );
		$query_result                      = new \WP_Query( $queryArray );
		$additional_params['query_result'] = $query_result;
		
		$params['this_object'] = $this;

		$html = byanca_select_get_woo_shortcode_module_template_part( 'templates/product-list', 'product-list', $params['type'], $params, $additional_params );
		
		return $html;
	}

	public function getHolderData( $params ) {
		$dataString = '';

		foreach ( $params as $key => $value ) {
			if ( $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );

				if ($key === 'number_of_columns') {

					$value_array = array('one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6);
					if (array_key_exists($value, $value_array)) {
						$value = $value_array[$value];
					}
				}

				$dataString .= ' data-' . $new_key . '=' . esc_attr( $value );
			}
		}

		return $dataString;
	}

	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-' . $params['type'] . '-layout' : 'qodef-' . $default_atts['type'] . '-layout';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['info_position'] ) ? 'qodef-' . $params['info_position'] : 'qodef-' . $default_atts['info_position'];
		$holderClasses[] = ! empty( $params['on_hover_behavior'] ) ? 'qodef-on-hover-' . $params['on_hover_behavior'] : '';
		$holderClasses[] = ! empty( $params['product_info_behavior'] ) ? 'qodef-product-info-show-' . $params['product_info_behavior'] : 'qodef-product-info-show-' . $default_atts['product_info_behavior'];
		$holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'qodef-product-info-' . $params['product_info_skin'] : '';
		$holderClasses[] = $params['type'] === 'vertical-slider' ? 'swiper-container' : '';
		$holderClasses[] = ($params['additional_effect'] == 'loading-effect') ? 'qodef-pl-with-loading-fx' : '';

		$holderClasses[] = $params['enable_fixed_proportions'] === 'yes' ? 'qodef-pl-images-fixed' : '';
		
		return implode( ' ', $holderClasses );
	}

	public function getHolderInnerClasses( $params ) {
		$classes = array();

		$classes[] = $params['type'] === 'vertical-slider' ? 'swiper-wrapper' : '';

		return implode( ' ', $classes );
	}

	private function generateProductQueryArray( $params ) {
		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $params['number_of_posts'],
			'orderby'             => $params['orderby'],
			'order'               => $params['order']
		);
		
		if ( $params['orderby'] === 'on-sale' ) {
			$queryArray['no_found_rows'] = 1;
			$queryArray['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' ) {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
			$queryArray['post__in'] = $ids;
		}

		return $queryArray;
	}
	
	public function getItemClasses( $params ) {
		$itemClasses = array();
		
		$image_size_meta = get_post_meta( get_the_ID(), 'qodef_product_featured_image_size', true );
		
		if ( ! empty( $image_size_meta ) ) {
			$itemClasses[] = 'qodef-fixed-masonry-item qodef-masonry-size-' . $image_size_meta;
		}

		$itemClasses[] = $params['type'] === 'vertical-slider' ? 'swiper-slide' : '';
		
		return implode( ' ', $itemClasses );
	}

	public function getStandardContentStyles( $params ) {
		$styles = array();

		$margin_top    = isset( $params['content_top_margin'] ) ? $params['content_top_margin'] : '';
		$margin_bottom = isset( $params['content_bottom_margin'] ) ? $params['content_bottom_margin'] : '';

		if ( ! empty( $margin_top ) ) {
			if ( byanca_select_string_ends_with( $margin_top, '%' ) || byanca_select_string_ends_with( $margin_top, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin_top;
			} else {
				$styles[] = 'margin-top: ' . byanca_select_filter_px( $margin_top ) . 'px';
			}
		}

		if ( ! empty( $margin_bottom ) ) {
			if ( byanca_select_string_ends_with( $margin_bottom, '%' ) || byanca_select_string_ends_with( $margin_bottom, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin_bottom;
			} else {
				$styles[] = 'margin-bottom: ' . byanca_select_filter_px( $margin_bottom ) . 'px';
			}
		}

		return implode( ';', $styles );
	}

	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getShaderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getTextWrapperStyles( $params ) {
		$styles = array();
		
		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . byanca_select_filter_px( $params['info_bottom_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}