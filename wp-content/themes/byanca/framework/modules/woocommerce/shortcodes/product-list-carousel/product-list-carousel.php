<?php

namespace ByancaCore\CPT\Shortcodes\ProductListCarousel;

use ByancaCore\Lib;

class ProductListCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_product_list_carousel';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product List - Carousel', 'byanca' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list-carousel extended-custom-icon',
					'category'                  => esc_html__( 'by BYANCA', 'byanca' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'byanca' ),
							'value'       => array(
								esc_html__( 'Standard', 'byanca' ) => 'standard',
								esc_html__( 'Simple', 'byanca' )   => 'simple'
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
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'byanca' ),
							'value'       => array_flip( byanca_select_get_space_between_items_array() ),
							'save_always' => true
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
							'type'        => 'dropdown',
							'heading'     => esc_html__( 'Image Proportions', 'byanca' ),
							'param_name'  => 'image_size',
							'value'       => array(
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
							'param_name'  => 'responsive_layout',
							'heading'     => esc_html__( 'Responsive Layout', 'byanca' ),
							'value'       => array(
								esc_html__( 'Default', 'byanca' ) => '',
								esc_html__( 'Fixed', 'byanca' )   => 'fixed'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'byanca' ),
							'value'       => array(
								esc_html__( 'One', 'byanca' )   => '1',
								esc_html__( 'Two', 'byanca' )   => '2',
								esc_html__( 'Three', 'byanca' ) => '3',
								esc_html__( 'Four', 'byanca' )  => '4',
								esc_html__( 'Five', 'byanca' )  => '5',
								esc_html__( 'Six', 'byanca' )   => '6'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'byanca' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'byanca' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'byanca' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'byanca' ),
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'byanca' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'byanca' ),
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_mousewheel',
							'heading'     => esc_html__( 'Change Slides on Mousewheel', 'byanca' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'carousel_stage_padding',
							'heading'     => esc_html__( 'Stage Padding (%)', 'byanca' ),
							'description' => esc_html__( 'Input the percentage value for the visible preview part for the sliders located to the left and right of the currently highlighted slide.', 'byanca' ),
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_full_screen_item',
							'heading'     => esc_html__( 'Enable Full Screen Items', 'byanca' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'byanca' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_navigation_skin',
							'heading'    => esc_html__( 'Slider Navigation Skin', 'byanca' ),
							'value'      => array(
								esc_html__( 'Default', 'byanca' ) => 'default',
								esc_html__( 'Light', 'byanca' )   => 'light'
							),
							'dependency' => array( 'element' => 'slider_navigation', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'byanca' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_pagination_skin',
							'heading'    => esc_html__( 'Slider Pagination Skin', 'byanca' ),
							'value'      => array(
								esc_html__( 'Default', 'byanca' ) => 'default',
								esc_html__( 'Light', 'byanca' )   => 'light'
							),
							'dependency' => array( 'element' => 'slider_pagination', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_pagination_pos',
							'heading'    => esc_html__( 'Slider Pagination Position', 'byanca' ),
							'value'      => array(
								esc_html__( 'Below Carousel', 'byanca' )  => 'bellow-slider',
								esc_html__( 'Inside Carousel', 'byanca' ) => 'inside-slider'
							),
							'dependency' => array( 'element' => 'slider_pagination', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'byanca' )
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
							'group'      => esc_html__( 'Product Info', 'byanca' )
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
							'dependency' => array( 'element' => 'type', 'value' => array( 'standard' ) ),
							'group'      => esc_html__( 'Product Info', 'byanca' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_excerpt',
							'heading'    => esc_html__( 'Display Excerpt', 'byanca' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'dependency' => array( 'element' => 'type', 'value' => array( 'standard' ) ),
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
							'dependency' => array( 'element' => 'type', 'value' => array( 'standard' ) ),
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
							'dependency' => array( 'element' => 'type', 'value' => array( 'standard' ) ),
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
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_1281_1366',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 1281px-1366px', 'byanca' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_1025_1280',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 1025px-1280px', 'byanca' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_769_1024',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 769px-1024px', 'byanca' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_681_768',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 681px-768px', 'byanca' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_680',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size bellow 680px', 'byanca' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                              => 'standard',
			'number_of_posts'                   => '8',
			'space_between_items'               => 'normal',
			'on_hover_behavior'                 => '',
			'orderby'                           => 'date',
			'order'                             => 'ASC',
			'taxonomy_to_display'               => 'category',
			'taxonomy_values'                   => '',
			'image_size'                        => 'full',
			'responsive_layout'                 => '',
			'number_of_visible_items'           => '1',
			'slider_loop'                       => 'yes',
			'slider_autoplay'                   => 'yes',
			'slider_speed'                      => '5000',
			'slider_speed_animation'            => '600',
			'slider_mousewheel'                 => '',
			'carousel_stage_padding'            => '0',
			'enable_full_screen_item'           => 'no',
			'slider_navigation'                 => 'yes',
			'slider_navigation_skin'            => 'default',
			'slider_pagination'                 => 'yes',
			'slider_pagination_skin'            => 'default',
			'slider_pagination_pos'             => 'bellow-slider',
			'display_title'                     => 'yes',
			'product_info_behavior'             => 'on-hover',
			'product_info_skin'                 => '',
			'title_tag'                         => 'h5',
			'title_transform'                   => '',
			'display_category'                  => 'no',
			'display_excerpt'                   => 'no',
			'excerpt_length'                    => '20',
			'display_rating'                    => 'yes',
			'display_price'                     => 'yes',
			'display_button'                    => 'yes',
			'button_skin'                       => 'default',
			'shader_background_color'           => '',
			'number_of_visible_items_1281_1366' => '',
			'number_of_visible_items_1025_1280' => '',
			'number_of_visible_items_769_1024'  => '',
			'number_of_visible_items_681_768'   => '',
			'number_of_visible_items_680'       => ''
		);
		$params = shortcode_atts( $default_atts, $atts );

		$params['class_name']              = 'plc';
		$params['type']                    = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		$params['title_tag']               = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['enable_full_screen_item'] = ! empty( $params['enable_full_screen_item'] ) ? $params['enable_full_screen_item'] : $default_atts['enable_full_screen_item'];

		$params['carousel_stage_padding'] = $this->parseStagePadding( $params, $default_atts );

		$additional_params                   = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$additional_params['holder_data']    = $this->getProductListCarouselDataAttributes( $params );
		
		$queryArray                        = $this->generateProductQueryArray( $params );
		$query_result                      = new \WP_Query( $queryArray );
		$additional_params['query_result'] = $query_result;
		
		$params['this_object'] = $this;
		
		$html = byanca_select_get_woo_shortcode_module_template_part( 'templates/product-list', 'product-list-carousel', $params['type'], $params, $additional_params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-plc-' . $params['type'] : 'qodef-plc-' . $default_atts['type'];
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['on_hover_behavior'] ) ? 'qodef-on-hover-' . $params['on_hover_behavior'] : '';
		$holderClasses[] = ! empty( $params['responsive_layout'] ) ? 'qodef-responsive-layout-' . $params['responsive_layout'] : '';
		$holderClasses[] = ! empty( $params['product_info_behavior'] ) ? 'qodef-product-info-show-' . $params['product_info_behavior'] : 'qodef-product-info-show-' . $default_atts['product_info_behavior'];
		$holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'qodef-product-info-' . $params['product_info_skin'] : '';
		$holderClasses[] = $this->getCarouselClasses( $params, $default_atts );
		
		return implode( ' ', $holderClasses );
	}
	
	private function getCarouselClasses( $params ) {
		$carouselClasses   = array();
		$carouselClasses[] = ! empty( $params['slider_navigation_skin'] ) ? 'qodef-plc-nav-' . $params['slider_navigation_skin'] . '-skin' : '';
		$carouselClasses[] = ! empty( $params['slider_pagination_pos'] ) ? 'qodef-plc-pag-' . $params['slider_pagination_pos'] : '';
		$carouselClasses[] = ! empty( $params['slider_pagination_skin'] ) ? 'qodef-plc-pag-' . $params['slider_pagination_skin'] . '-skin' : '';
		$carouselClasses[] = $params['enable_full_screen_item'] === 'yes' ? 'qodef-plc-items-full-screen' : 'qodef-disable-bottom-space';
		
		return implode( ' ', $carouselClasses );
	}

	public function parseStagePadding( $params, $args ) {
		$stage_padding = floatval($params['carousel_stage_padding']);

		if ($stage_padding < 0 || $stage_padding > 100) {
			$stage_padding = $args['carousel_stage_padding'];
		}

		return $stage_padding / 100;
	}

	private function getProductListCarouselDataAttributes( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']             = ! empty( $params['number_of_visible_items'] ) ? $params['number_of_visible_items'] : '1';
		$slider_data['data-enable-loop']                 = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']             = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']                = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation']      = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-slider-custom-padding']       = 'yes';
		$slider_data['data-slider-custom-padding-value'] = $params['carousel_stage_padding'];
		$slider_data['data-enable-navigation']           = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']           = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		$slider_data['data-enable-mousewheel-scroll']           = ! empty( $params['slider_mousewheel'] ) ? $params['slider_mousewheel'] : '';
		

		if ( $params['number_of_visible_items_1281_1366'] !== '' ) {
			$slider_data['data-number-of-items-1281-1366'] = $params['number_of_visible_items_1281_1366'];
		}

		if ( $params['number_of_visible_items_1025_1280'] !== '' ) {
			$slider_data['data-number-of-items-1025-1280'] = $params['number_of_visible_items_1025_1280'];
		}

		if ( $params['number_of_visible_items_769_1024'] !== '' ) {
			$slider_data['data-number-of-items-769-1024'] = $params['number_of_visible_items_769_1024'];
		}

		if ( $params['number_of_visible_items_681_768'] !== '' ) {
			$slider_data['data-number-of-items-681-768'] = $params['number_of_visible_items_681_768'];
		}

		if ( $params['number_of_visible_items_680'] !== '' ) {
			$slider_data['data-number-of-items-680'] = $params['number_of_visible_items_680'];
		}
		
		return $slider_data;
	}
	
	public function generateProductQueryArray( $params ) {
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

	public function getImageBackgroundStyles( $params ) {
		$styles = array();

		if ( $params['enable_full_screen_item'] === 'yes' ) {

			$unique_image_meta       = get_post_meta( get_the_ID(), 'qodef_woo_product_unique_featured_image_meta', true );
			$image_meta              = get_post_meta( get_the_ID(), 'qodef_woo_product_list_featured_image_meta', true );
			$has_featured            = ! empty( $unique_image_meta ) || ! empty( $image_meta ) || has_post_thumbnail();
			$product_unique_image_id = ! empty( $unique_image_meta ) ? byanca_select_get_attachment_id_from_url( $unique_image_meta ) : '';
			$product_list_image_id   = ! empty( $image_meta ) ? byanca_select_get_attachment_id_from_url( $image_meta ) : '';

			if ($has_featured) {
				if ( ! empty( $product_unique_image_id ) ) {
					$featured_image = wp_get_attachment_image_url( $product_unique_image_id, 'full' );
				} elseif ( ! empty( $product_list_image_id ) ) {
					$featured_image = wp_get_attachment_image_url( $product_list_image_id, 'full' );
				} else {
					$featured_image = get_the_post_thumbnail_url( get_the_ID() );
				}
			}

			$styles[] = 'background-image: url(' . esc_url( $featured_image ) .')';
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
}