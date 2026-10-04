<?php

namespace ByancaCore\CPT\Shortcodes\ProductCategoryListCarousel;

use ByancaCore\Lib;

class ProductCategoryListCarousel implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'qodef_product_category_list_carousel';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product Category List - Carousel', 'byanca' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-category-list-carousel extended-custom-icon',
					'category'                  => esc_html__( 'by BYANCA', 'byanca' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
                        array(
                            array(
                                'type'       => 'textfield',
                                'param_name' => 'number_of_posts',
                                'heading'    => esc_html__( 'Number of Product Categories', 'byanca' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'space_between_items',
                                'heading'     => esc_html__( 'Space Between Items', 'byanca' ),
                                'value'       => array_flip( array_merge( array( 'colossal' => esc_html__( 'Colossal (80)', 'byanca' ), 'gigantic' => esc_html__( 'Gigantic (60)', 'byanca' ) ), byanca_select_get_space_between_items_array() ) ),
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
                                'type'       => 'textfield',
                                'param_name' => 'category_slugs',
                                'heading'    => esc_html__( 'Enter the category slugs you want to display, separated by commas (leave empty for showing all categories)', 'byanca' )
                            ),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'image_size',
                                'heading'    => esc_html__( 'Image Proportions', 'byanca' ),
                                'value'      => array(
                                    esc_html__( 'Original', 'byanca' )  => 'full',
									esc_html__( 'Square', 'byanca' )    => 'byanca_select_image_square',
									esc_html__( 'Landscape', 'byanca' ) => 'byanca_select_image_landscape',
									esc_html__( 'Portrait', 'byanca' )  => 'byanca_select_image_portrait',
									esc_html__( 'Thumbnail', 'byanca' ) => 'thumbnail',
									esc_html__( 'Medium', 'byanca' )    => 'medium',
									esc_html__( 'Large', 'byanca' )     => 'large'
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
								'type'        => 'textfield',
								'param_name'  => 'carousel_stage_padding',
								'heading'     => esc_html__( 'Stage Padding (%)', 'byanca' ),
								'description' => esc_html__( 'Input the percentage value for the visible preview part for the sliders located to the left and right of the currently highlighted slide.', 'byanca' ),
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
								'group'      => esc_html__( 'Title Styles', 'byanca' )
							),
                            array(
								'type'       => 'dropdown',
								'param_name' => 'title_appearance',
								'heading'    => esc_html__( 'Title Appearance', 'byanca' ),
								'value'      => array(
									esc_html__( 'On Hover Only', 'byanca' ) => '',
									esc_html__( 'Always', 'byanca' )        => 'always',
									esc_html__( 'Never', 'byanca' )         => 'never'
                                ),
								'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Title Styles', 'byanca' )
							),
                            array(
								'type'       => 'dropdown',
								'param_name' => 'title_position',
								'heading'    => esc_html__( 'Title Position', 'byanca' ),
								'value'      => array(
									esc_html__( 'Default', 'byanca' ) => '',
									esc_html__( 'Center', 'byanca' )  => 'center'
								),
								'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Title Styles', 'byanca' )
							),
                            array(
								'type'       => 'dropdown',
								'param_name' => 'title_tag',
								'heading'    => esc_html__( 'Title Tag', 'byanca' ),
								'value'      => array_flip( byanca_select_get_title_tag( true ) ),
								'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Title Styles', 'byanca' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'title_transform',
								'heading'    => esc_html__( 'Title Text Transform', 'byanca' ),
								'value'      => array_flip( byanca_select_get_text_transform_array( true ) ),
								'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Title Styles', 'byanca' )
							),
                            array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'byanca' ),
								'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Title Styles', 'byanca' )
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
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'number_of_posts'                   => '8',
			'space_between_items'               => 'normal',
			'orderby'                           => 'date',
			'order'                             => 'ASC',
			'category_slugs'                    => '',
			'image_size'                        => 'full',
			'responsive_layout'                 => '',
			'number_of_visible_items'           => '1',
			'slider_loop'                       => 'yes',
			'slider_autoplay'                   => 'yes',
			'slider_speed'                      => '5000',
			'slider_speed_animation'            => '600',
			'carousel_stage_padding'            => '0',
			'slider_navigation'                 => 'yes',
			'slider_navigation_skin'            => 'default',
			'slider_pagination'                 => 'yes',
			'slider_pagination_skin'            => 'default',
			'slider_pagination_pos'             => 'bellow-slider',
			'display_title'                     => 'yes',
			'title_appearance'                  => '',
			'title_position'                    => '',
			'title_tag'                         => 'h5',
			'title_transform'                   => '',
			'title_color'                       => '',
			'number_of_visible_items_1281_1366' => '',
			'number_of_visible_items_1025_1280' => '',
			'number_of_visible_items_769_1024'  => '',
			'number_of_visible_items_681_768'   => '',
			'number_of_visible_items_680'       => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );

		$params['class_name'] = 'pclc';

		$params['category_slugs'] = trim( $params['category_slugs'] );
		if ( empty( $params['category_slugs'] ) ) {
			$params['category_slugs'] = array();
		} else {
			$params['category_slugs'] = explode( ',', str_replace( ' ', '', $params['category_slugs'] ) );
		}

		$params['title_tag']    = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles( $params );

		$params['carousel_stage_padding'] = $this->parseStagePadding( $params, $default_atts );

		$additional_params                   = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$additional_params['holder_data']    = $this->getProductCategoryListCarouselDataAttributes( $params );
		$additional_params['query_result']   = $this->generateProductCategoryQueryArray( $params );

		$params['this_object'] = $this;

		$html = byanca_select_get_woo_shortcode_module_template_part( 'templates/product-category-list-carousel', 'product-category-list-carousel', '', $params, $additional_params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['title_appearance'] ) ? 'qodef-title-' . $params['title_appearance'] . '-appears' : '';
		$holderClasses[] = ! empty( $params['title_position'] ) ? 'qodef-' . $params['title_position'] . '-title' : '';

		return implode( ' ', $holderClasses );
	}

	public function parseStagePadding( $params, $args ) {
		$stage_padding = floatval($params['carousel_stage_padding']);

		if ($stage_padding < 0 || $stage_padding > 100) {
			$stage_padding = $args['carousel_stage_padding'];
		}

		return $stage_padding / 100;
	}

	public function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		return implode( ';', $styles );
	}

	private function getProductCategoryListCarouselDataAttributes( $params ) {
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

	/**
     * Find product category from slug
     * @since 4.4
     *
     * @param $slug
     *
     * @return string
     */
    public function productCategoryFromSlug($slug) {
	    $product_category_title = '';

	    $slug = trim($slug);
	    if (!empty($slug)) {

            $product_category = get_term_by('slug', $slug, 'product_cat');
            if (is_object($product_category)) {

                $product_category_title = $product_category->name;
            }

        }

        return $product_category_title;
    }

	private function generateProductCategoryQueryArray( $params ) {
		$queryArray = get_terms( array(
			'taxonomy'   => 'product_cat',
			'number'     => $params['number_of_posts'],
			'orderby'    => $params['orderby'],
			'order'      => $params['order'],
			'slug'       => $params['category_slugs'],
			'hide_empty' => false
		) );
		
		return $queryArray;
	}
}