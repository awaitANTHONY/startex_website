<?php

namespace ByancaCore\CPT\Shortcodes\ProductCategory;

use ByancaCore\Lib;

class ProductCategory implements Lib\ShortcodeInterface
{
    private $base;

    function __construct()
    {
        $this->base = 'qodef_product_category';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Product id filter
        add_filter('vc_autocomplete_qodef_product_category_category_callback', array(&$this, 'productCategoryAutocompleteSuggester',), 10, 1);

        //Product id render
        add_filter('vc_autocomplete_qodef_product_category_category_render', array(&$this, 'productCategoryAutocompleteRender',), 10, 1);
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Product Category', 'byanca'),
                    'base' => $this->getBase(),
                    'category' => esc_html__('by BYANCA', 'byanca'),
                    'icon' => 'icon-wpb-product-category extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params' => array(
                        array(
	                        'type'        => 'autocomplete',
	                        'param_name'  => 'category',
	                        'heading'     => esc_html__( 'Selected Product Category', 'byanca' ),
	                        'settings'    => array(
		                        'sortable'      => true,
		                        'unique_values' => true
	                        ),
	                        'admin_label' => true,
	                        'save_always' => true
                        ),
                        array(
							'type'        => 'dropdown',
							'param_name'  => 'layout',
							'heading'     => esc_html__( 'Layout', 'byanca' ),
							'value'       => array(
								esc_html__( 'Left', 'byanca' )  => 'left',
								esc_html__( 'Right', 'byanca' ) => 'right'
							),
							'admin_label' => true
						),
                        array(
	                        'type'        => 'attach_images',
	                        'param_name'  => 'images',
	                        'heading'     => esc_html__( 'Images', 'byanca' ),
	                        'description' => esc_html__( 'Select images from media library', 'byanca' )
                        ),
                        array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'byanca' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'byanca' )
						),
                        array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'byanca' )
						),
                        array(
							'type'       => 'textfield',
							'param_name' => 'background_label',
							'heading'    => esc_html__( 'Background Label', 'byanca' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_label_color',
							'heading'    => esc_html__( 'Background Label Color', 'byanca' )
                        ),
                        array(
							'type'        => 'dropdown',
							'param_name' => 'additional_effect',
							'heading'    => esc_html__( 'Additional Effect', 'byanca' ),
							'value'      => array(
								esc_html__( 'None', 'byanca' )  => '',
								esc_html__( 'Parallax Effect', 'byanca' ) => 'parallax-effect',
							),
						)
                    )
                )
            );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null)
    {
        $args = array(
	        'category'               => '',
	        'layout'                 => 'left',
	        'images'                 => '',
	        'image_size'             => 'full',
	        'title_color'            => '',
	        'background_label'       => '',
            'background_label_color' => '',
            'additional_effect'      => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

	    $params['holder_classes']          = $this->getHolderClasses( $params, $args );
	    $params['background_label_styles'] = $this->getBackgroundLabelStyles( $params );
	    $params['images']                  = $this->getImages( $params );
	    $params['image_size']              = $this->getImageSize( $params['image_size'] );
	    $params['title_styles']            = $this->getTitleStyles( $params );
	    if ( ! $this->productCategoryExists( $params[ 'category' ] ) ) {
			$params[ 'category' ] = '';
		}
        $params['category_name']           = $this->productCategoryFromSlug( $params['category'] );
        $params['parallax_data_1'] = $this->getParallaxData1($params);
        $params['parallax_data_2'] = $this->getParallaxData2($params);

        $html = $html = byanca_select_get_woo_shortcode_module_template_part( 'templates/product-category', 'product-category', '', $params );

        return $html;
    }

    private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['layout'] ) ? 'qodef-' . $params['layout'] . '-layout' : 'qodef-' . $default_atts['layout'] . '-layout';
		$holderClasses[] = ! empty( $params['additional_effect'] ) ? 'qodef-pc-with-' . $params['additional_effect']  : '';

		return implode( ' ', $holderClasses );
    }
    
    
	public function getParallaxData1 ( $params ) {
		$parallaxData = array();

		if ($params['additional_effect'] === 'parallax-effect') {
		    $y_absolute = rand(-60, -80);
		    $smoothness = 20; //1 is for linear, non-animated parallax

		    $parallaxData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
		}

		return $parallaxData;
    }
    
    public function getParallaxData2( $params ) {
		$parallaxData = array();

		if ($params['additional_effect'] === 'parallax-effect') {
		    $y_absolute = rand(-90, -120);
		    $smoothness = 20; //1 is for linear, non-animated parallax

		    $parallaxData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
		}

		return $parallaxData;
	}
	

	private function getImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;

		if ( $params['images'] !== '' ) {
			$image_ids = explode( ',', $params['images'] );
		}

		foreach ( $image_ids as $id ) {

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['title']    = get_the_title( $id );
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

			$images[ $i ] = $image;
			$i ++;
		}

		return $images;
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

	public function getBackgroundLabelStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['background_label_color'] ) ) {
			$styles[] = 'color: ' . $params['background_label_color'];
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
    public function productCategoryAutocompleteSuggester($query)
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
    public function productCategoryAutocompleteRender($query)
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