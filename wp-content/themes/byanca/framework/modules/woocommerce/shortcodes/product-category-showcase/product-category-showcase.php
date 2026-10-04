<?php

namespace ByancaCore\CPT\Shortcodes\ProductCategoryShowcase;

use ByancaCore\Lib;

class ProductCategoryShowcase implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'qodef_product_category_showcase';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Product Category 1 id filter
        add_filter('vc_autocomplete_qodef_product_category_showcase_category_1_callback', array(&$this, 'productCategoryShowcaseAutocompleteSuggester',), 10, 1);

        //Product Category 1 id render
        add_filter('vc_autocomplete_qodef_product_category_showcase_category_1_render', array(&$this, 'productCategoryShowcaseAutocompleteRender',), 10, 1);

        //Product Category 2 id filter
        add_filter('vc_autocomplete_qodef_product_category_showcase_category_2_callback', array(&$this, 'productCategoryShowcaseAutocompleteSuggester',), 10, 1);

        //Product Category 2 id render
        add_filter('vc_autocomplete_qodef_product_category_showcase_category_2_render', array(&$this, 'productCategoryShowcaseAutocompleteRender',), 10, 1);

        //Product Category 3 id filter
        add_filter('vc_autocomplete_qodef_product_category_showcase_category_3_callback', array(&$this, 'productCategoryShowcaseAutocompleteSuggester',), 10, 1);

        //Product Category 3 id render
        add_filter('vc_autocomplete_qodef_product_category_showcase_category_3_render', array(&$this, 'productCategoryShowcaseAutocompleteRender',), 10, 1);
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product Category Showcase', 'byanca' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-category-showcase extended-custom-icon',
					'category'                  => esc_html__( 'by BYANCA', 'byanca' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category_1',
							'heading'     => esc_html__( 'Selected Product Category', 'byanca' ),
							'settings'    => array(
								'sortable'      => true,
								'unique_values' => true
							),
							'admin_label' => true,
							'save_always' => true,
							'group'       => esc_html__( 'Product Category 1', 'byanca' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_1',
							'heading'     => esc_html__( 'Image', 'byanca' ),
							'description' => esc_html__( 'Select image from media library', 'byanca' ),
							'group'       => esc_html__( 'Product Category 1', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size_1',
							'heading'     => esc_html__( 'Image Size', 'byanca' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'byanca' ),
							'group'       => esc_html__( 'Product Category 1', 'byanca' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color_1',
							'heading'    => esc_html__( 'Title Color', 'byanca' ),
							'group'      => esc_html__( 'Product Category 1', 'byanca' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category_2',
							'heading'     => esc_html__( 'Selected Product Category', 'byanca' ),
							'settings'    => array(
								'sortable'      => true,
								'unique_values' => true
							),
							'admin_label' => true,
							'save_always' => true,
							'group'       => esc_html__( 'Product Category 2', 'byanca' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_2',
							'heading'     => esc_html__( 'Image', 'byanca' ),
							'description' => esc_html__( 'Select image from media library', 'byanca' ),
							'group'       => esc_html__( 'Product Category 2', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size_2',
							'heading'     => esc_html__( 'Image Size', 'byanca' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'byanca' ),
							'group'       => esc_html__( 'Product Category 2', 'byanca' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color_2',
							'heading'    => esc_html__( 'Title Color', 'byanca' ),
							'group'      => esc_html__( 'Product Category 2', 'byanca' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category_3',
							'heading'     => esc_html__( 'Selected Product Category', 'byanca' ),
							'settings'    => array(
								'sortable'      => true,
								'unique_values' => true
							),
							'admin_label' => true,
							'save_always' => true,
							'group'       => esc_html__( 'Product Category 3', 'byanca' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_3',
							'heading'     => esc_html__( 'Image', 'byanca' ),
							'description' => esc_html__( 'Select image from media library', 'byanca' ),
							'group'       => esc_html__( 'Product Category 3', 'byanca' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size_3',
							'heading'     => esc_html__( 'Image Size', 'byanca' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'byanca' ),
							'group'       => esc_html__( 'Product Category 3', 'byanca' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color_3',
							'heading'    => esc_html__( 'Title Color', 'byanca' ),
							'group'      => esc_html__( 'Product Category 3', 'byanca' )
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
						)
                    )
                )
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'category_1'    => '',
			'image_1'       => '',
			'image_size_1'  => 'full',
			'title_color_1' => '',
			'category_2'    => '',
			'image_2'       => '',
			'image_size_2'  => 'full',
			'title_color_2' => '',
			'category_3'    => '',
			'image_3'       => '',
			'image_size_3'  => 'full',
			'title_color_3' => '',
			'additional_effect' => ''
		);
		
		$params       = shortcode_atts( $default_atts, $atts );
		$params['holder_classes'] = $this->getHolderClasses( $params );

		foreach ( array( 1, 2, 3 ) as $index ) {
			$params[ 'image_' . $index ]        = $this->getImage( $params[ 'image_' . $index ] );
			$params[ 'image_size_' . $index ]   = $this->getImageSize( $params[ 'image_size_' . $index ] );
			$params[ 'title_styles_' . $index ] = $this->getTitleStyles( $params[ 'title_color_' . $index ] );

			if ( ! $this->productCategoryExists( $params[ 'category_' . $index ] ) ) {
				$params[ 'category_' . $index ] = '';
			}

			$params[ 'category_name_' . $index ] = $this->productCategoryFromSlug( $params[ 'category_' . $index ] );
		}

		$html = byanca_select_get_woo_shortcode_module_template_part( 'templates/product-category-showcase', 'product-category-showcase', '', $params );
		
		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses   = array();

		$holderClasses[] = ($params['additional_effect'] == 'loading-effect') ? 'qodef-pcs-with-loading-fx' : '';

		return implode( ' ', $holderClasses );
	}

	private function getImage( $image ) {
		$image_id = '';
		$img      = array();

		if ( $image !== '' ) {
			$image_id = trim( $image );
		}

		$img['image_id'] = $image_id;
		$image_original  = wp_get_attachment_image_src( $image_id, 'full' );
		$img['url']      = $image_original[0];
		$img['title']    = get_the_title( $image_id );
		$img['alt']      = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		return $img;
	}

	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'full';
		}
	}

	public function getTitleStyles( $title_color ) {
		$styles = array();

		if ( ! empty( $title_color ) ) {
			$styles[] = 'color: ' . $title_color;
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

	/**
     * Find if product category exists
     * @since 4.4
     *
     * @param $slug
     *
     * @return boolean
     */
    public function productCategoryExists($slug) {

	    $slug = trim($slug);
	    if (!empty($slug)) {

            $product_category = get_term_by('slug', $slug, 'product_cat');
            return is_object($product_category);

        }

        return false;
    }

	/**
     * Filter product category
     *
     * @param $query
     *
     * @return array
     */
    public function productCategoryShowcaseAutocompleteSuggester($query)
    {
        global $wpdb;

        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.slug AS slug, a.name AS product_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'product_cat' AND a.name LIKE '%%%s%%'", stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['slug'];
                $data['label'] = ((strlen($value['product_category_title']) > 0) ? esc_html__('Category', 'byanca') . ': ' . $value['product_category_title'] : '');
                $results[] = $data;
            }
        }

        return $results;

    }

    /**
     * Find product category
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function productCategoryShowcaseAutocompleteRender($query)
    {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {

            $product_category = get_term_by('slug', $query, 'product_cat');
            if (is_object($product_category)) {

                $product_category_slug = $product_category->slug;
                $product_category_title = $product_category->name;

                $product_category_title_display = '';
                if (!empty($product_category_title)) {
                    $product_category_title_display = esc_html__('Category', 'byanca') . ': ' . $product_category_title;
                }

                $data = array();
                $data['value'] = $product_category_slug;
                $data['label'] = $product_category_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }
}