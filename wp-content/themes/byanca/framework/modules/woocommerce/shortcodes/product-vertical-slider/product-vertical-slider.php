<?php

namespace ByancaCore\CPT\Shortcodes\ProductVerticalSlider;

use ByancaCore\Lib;

class ProductVerticalSlider implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'qodef_product_vertical_slider';

        add_action('vc_before_init', array($this, 'vcMap'));

        //product category filter
        add_filter('vc_autocomplete_qodef_product_vertical_slider_category_callback', array(&$this, 'productCategoryAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //product category render
        add_filter('vc_autocomplete_qodef_product_vertical_slider_category_render', array(&$this, 'productCategoryAutocompleteRender',), 10, 1); // Get suggestion(find). Must return an array

        //product selected projects filter
        add_filter('vc_autocomplete_qodef_product_vertical_slider_selected_projects_callback', array(&$this, 'productIdAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //product selected projects render
        add_filter('vc_autocomplete_qodef_product_vertical_slider_selected_projects_render', array(&$this, 'productIdAutocompleteRender',), 10, 1); // Render exact product. Must return an array (label,value)

        //product tag filter
        add_filter('vc_autocomplete_qodef_product_vertical_slider_tag_callback', array(&$this, 'productTagAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //product tag render
        add_filter('vc_autocomplete_qodef_product_vertical_slider_tag_render', array(&$this, 'productTagAutocompleteRender',), 10, 1); // Get suggestion(find). Must return an array
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Product Vertical Slider', 'byanca'),
                    'base' => $this->base,
                    'category' => esc_html__('by BYANCA', 'byanca'),
                    'icon' => 'icon-wpb-product-vertical-slider extended-custom-icon',
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'param_name' => 'number_of_posts',
                            'heading' => esc_html__('Number of Products', 'byanca'),
                            'admin_label' => true,
                            'description' => esc_html__('Set number of items for your product slider. Enter -1 to show all', 'byanca')
                        ),
                        array(
                            'type' => 'autocomplete',
                            'param_name' => 'selected_projects',
                            'heading' => esc_html__('Show Only Projects with Listed IDs', 'byanca'),
                            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true
                            ),
                            'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'byanca')
                        ),
                        array(
                            'type' => 'autocomplete',
                            'param_name' => 'category',
                            'heading' => esc_html__('One-Category Product List', 'byanca'),
                            'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'byanca')
                        ),
                        array(
                            'type' => 'autocomplete',
                            'param_name' => 'tag',
                            'heading' => esc_html__('One-Tag Product List', 'byanca'),
                            'description' => esc_html__('Enter one tag slug (leave empty for showing all tags)', 'byanca')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'orderby',
                            'heading' => esc_html__('Order By', 'byanca'),
                            'value' => array_flip(byanca_select_get_query_order_by_array()),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'order',
                            'heading' => esc_html__('Order', 'byanca'),
                            'value' => array_flip(byanca_select_get_query_order_array()),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'display_title',
                            'heading' => esc_html__('Display Title', 'byanca'),
                            'value' => array_flip(byanca_select_get_yes_no_select_array(false, true)),
                            'group' => esc_html__('Content Layout', 'byanca')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading' => esc_html__('Title Tag', 'byanca'),
                            'value' => array_flip(byanca_select_get_title_tag(true)),
                            'dependency' => array('element' => 'display_title', 'value' => array('yes')),
                            'group' => esc_html__('Content Layout', 'byanca')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_transform',
                            'heading' => esc_html__('Title Text Transform', 'byanca'),
                            'value' => array_flip(byanca_select_get_text_transform_array(true)),
                            'dependency' => array('element' => 'display_title', 'value' => array('yes')),
                            'group' => esc_html__('Content Layout', 'byanca')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'display_category',
                            'heading' => esc_html__('Display Category', 'byanca'),
                            'value' => array_flip(byanca_select_get_yes_no_select_array(false, true)),
                            'group' => esc_html__('Content Layout', 'byanca')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'display_excerpt',
                            'heading' => esc_html__('Display Excerpt', 'byanca'),
                            'value' => array_flip(byanca_select_get_yes_no_select_array(false)),
                            'group' => esc_html__('Content Layout', 'byanca')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'excerpt_length',
                            'heading' => esc_html__('Excerpt Length', 'byanca'),
                            'description' => esc_html__('Number of characters', 'byanca'),
                            'dependency' => array('element' => 'display_excerpt', 'value' => array('yes')),
                            'group' => esc_html__('Content Layout', 'byanca')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'display_price',
                            'heading' => esc_html__('Display Price', 'byanca'),
                            'value' => array_flip(byanca_select_get_yes_no_select_array(false, true)),
                            'group' => esc_html__('Content Layout', 'byanca')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
	        'type'                => 'vertical-slider',
	        'number_of_posts'     => '9',
	        'item_type'           => 'vertical-slider',
	        'item_style'          => 'vertical-slider',
	        'number_of_columns'   => 'one',
	        'space_between_items' => 'no',
	        'selected_projects'   => '',
	        'category'            => '',
	        'tag'                 => '',
	        'orderby'             => 'date',
	        'order'               => 'ASC',
	        'display_title'       => 'yes',
	        'title_tag'           => 'h1',
	        'title_transform'     => '',
	        'display_category'    => 'yes',
	        'display_excerpt'     => '',
	        'excerpt_length'      => '',
	        'display_price'       => 'yes'
        );
        $params = shortcode_atts($args, $atts);

        if (!empty($params['selected_projects'])) {
        	$params['taxonomy_to_display'] = 'id';
        	$params['taxonomy_values'] = $params['selected_projects'];
        } elseif (!empty($params['category'])) {
        	$params['taxonomy_to_display'] = 'category';
        	$params['taxonomy_values'] = $params['category'];
        }
        elseif (!empty($params['tag'])) {
        	$params['taxonomy_to_display'] = 'tag';
        	$params['taxonomy_values'] = $params['tag'];
        }

        $html = '<div class="qodef-product-vertical-slider-holder">';
        $html .= byanca_select_execute_shortcode('qodef_product_list', $params);
        $html .= '</div>';

        return $html;
    }

    /**
     * Filter product categories
     *
     * @param $query
     *
     * @return array
     */
    public function productCategoryAutocompleteSuggester($query) {
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
     * Find product category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function productCategoryAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get product category
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

    /**
     * Filter products by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function productIdAutocompleteSuggester($query) {
        global $wpdb;
        $product_id = (int)$query;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'product' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : -1, stripslashes($query), stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__('Id', 'byanca') . ': ' . $value['id'] . ((strlen($value['title']) > 0) ? ' - ' . esc_html__('Title', 'byanca') . ': ' . $value['title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find product by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function productIdAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get product
            $product = get_post((int)$query);
            if (!is_wp_error($product)) {

                $product_id = $product->ID;
                $product_title = $product->post_title;

                $product_title_display = '';
                if (!empty($product_title)) {
                    $product_title_display = ' - ' . esc_html__('Title', 'byanca') . ': ' . $product_title;
                }

                $product_id_display = esc_html__('Id', 'byanca') . ': ' . $product_id;

                $data = array();
                $data['value'] = $product_id;
                $data['label'] = $product_id_display . $product_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter product tags
     *
     * @param $query
     *
     * @return array
     */
    public function productTagAutocompleteSuggester($query) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.slug AS slug, a.name AS product_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'product_tag' AND a.name LIKE '%%%s%%'", stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['slug'];
                $data['label'] = ((strlen($value['product_tag_title']) > 0) ? esc_html__('Tag', 'byanca') . ': ' . $value['product_tag_title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find product tag by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function productTagAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get product category
            $product_tag = get_term_by('slug', $query, 'product_tag');
            if (is_object($product_tag)) {

                $product_tag_slug = $product_tag->slug;
                $product_tag_title = $product_tag->name;

                $product_tag_title_display = '';
                if (!empty($product_tag_title)) {
                    $product_tag_title_display = esc_html__('Tag', 'byanca') . ': ' . $product_tag_title;
                }

                $data = array();
                $data['value'] = $product_tag_slug;
                $data['label'] = $product_tag_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }
}