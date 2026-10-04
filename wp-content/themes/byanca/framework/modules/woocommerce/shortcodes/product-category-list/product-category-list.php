<?php

namespace ByancaCore\CPT\Shortcodes\ProductCategoryList;

use ByancaCore\Lib;

class ProductCategoryList implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'qodef_product_category_list';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product Category List', 'byanca' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-category-list extended-custom-icon',
					'category'                  => esc_html__( 'by BYANCA', 'byanca' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
                        array(
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'type',
                                'heading'     => esc_html__( 'Type', 'byanca' ),
                                'value'       => array(
                                    esc_html__( 'Standard', 'byanca' ) => 'standard',
                                    esc_html__( 'Masonry', 'byanca' )  => 'masonry'
                                ),
                                'admin_label' => true
                            ),
                            array(
                                'type'       => 'textfield',
                                'param_name' => 'number_of_posts',
                                'heading'    => esc_html__( 'Number of Product Categories', 'byanca' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'number_of_columns',
                                'heading'     => esc_html__( 'Number of Columns', 'byanca' ),
                                'value'       => array(
                                    esc_html__( 'One', 'byanca' )   => '1',
                                    esc_html__( 'Two', 'byanca' )   => '2',
                                    esc_html__( 'Three', 'byanca' ) => '3',
                                    esc_html__( 'Four', 'byanca' )  => '4',
                                    esc_html__( 'Five', 'byanca' )  => '5',
                                    esc_html__( 'Six', 'byanca' )   => '6'
                                ),
                                'save_always' => true
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
                                'dependency' => array( 'element' => 'type', 'value' => array( 'standard' ) ),
                                'save_always' => true
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
                        )
                    )
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                       => 'standard',
			'number_of_posts'            => '8',
			'number_of_columns'          => '4',
			'space_between_items'        => 'normal',
			'orderby'                    => 'date',
			'order'                      => 'ASC',
			'category_slugs'             => '',
			'image_size'                 => 'full',
			'display_title'              => 'yes',
			'title_appearance'           => '',
			'title_position'             => '',
			'title_tag'                  => 'h5',
			'title_transform'            => '',
			'title_color'                => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );

		$params['category_slugs'] = trim( $params['category_slugs'] );
		if ( empty( $params['category_slugs'] ) ) {
			$params['category_slugs'] = array();
		} else {
			$params['category_slugs'] = explode( ',', str_replace( ' ', '', $params['category_slugs'] ) );
		}

		$params['title_tag']    = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles( $params );

		$additional_params                   = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$additional_params['query_result']   = $this->generateProductCategoryQueryArray( $params );

		$params['this_object'] = $this;

		$html = byanca_select_get_woo_shortcode_module_template_part( 'templates/product-category-list', 'product-category-list', '', $params, $additional_params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-' . $params['type'] . '-layout' : 'qodef-' . $default_atts['type'] . '-layout';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['title_appearance'] ) ? 'qodef-title-' . $params['title_appearance'] . '-appears' : '';
		$holderClasses[] = ! empty( $params['title_position'] ) ? 'qodef-' . $params['title_position'] . '-title' : '';
		$holderClasses[] = $this->getColumnNumberClass( $params );

		return implode( ' ', $holderClasses );
	}
	
	private function getColumnNumberClass( $params ) {
		$columnsNumber = '';
		$columns       = $params['number_of_columns'];
		
		switch ( $columns ) {
			case 1:
				$columnsNumber = 'qodef-one-column';
				break;
			case 2:
				$columnsNumber = 'qodef-two-columns';
				break;
			case 3:
				$columnsNumber = 'qodef-three-columns';
				break;
			case 4:
				$columnsNumber = 'qodef-four-columns';
				break;
			case 5:
				$columnsNumber = 'qodef-five-columns';
				break;
			case 6:
				$columnsNumber = 'qodef-six-columns';
				break;
			default:
				$columnsNumber = 'qodef-four-columns';
				break;
		}
		
		return $columnsNumber;
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