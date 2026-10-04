<?php

namespace ByancaCore\CPT\Shortcodes\Portfolio;

use ByancaCore\Lib;

class PortfolioVerticalSlider implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'qodef_portfolio_vertical_slider';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Portfolio category filter
        add_filter('vc_autocomplete_qodef_portfolio_vertical_slider_category_callback', array(&$this, 'portfolioCategoryAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //Portfolio category render
        add_filter('vc_autocomplete_qodef_portfolio_vertical_slider_category_render', array(&$this, 'portfolioCategoryAutocompleteRender',), 10, 1); // Get suggestion(find). Must return an array

        //Portfolio selected projects filter
        add_filter('vc_autocomplete_qodef_portfolio_vertical_slider_selected_projects_callback', array(&$this, 'portfolioIdAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //Portfolio selected projects render
        add_filter('vc_autocomplete_qodef_portfolio_vertical_slider_selected_projects_render', array(&$this, 'portfolioIdAutocompleteRender',), 10, 1); // Render exact portfolio. Must return an array (label,value)

        //Portfolio tag filter
        add_filter('vc_autocomplete_qodef_portfolio_vertical_slider_tag_callback', array(&$this, 'portfolioTagAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //Portfolio tag render
        add_filter('vc_autocomplete_qodef_portfolio_vertical_slider_tag_render', array(&$this, 'portfolioTagAutocompleteRender',), 10, 1); // Get suggestion(find). Must return an array
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Portfolio Vertical Slider', 'byanca-core'),
                    'base' => $this->base,
                    'category' => esc_html__('by BYANCA', 'byanca-core'),
                    'icon' => 'icon-wpb-portfolio-vertical-slider extended-custom-icon',
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'param_name' => 'number_of_items',
                            'heading' => esc_html__('Number of Portfolios Items', 'byanca-core'),
                            'admin_label' => true,
                            'description' => esc_html__('Set number of items for your portfolio slider. Enter -1 to show all', 'byanca-core')
                        ),
                        array(
                            'type' => 'autocomplete',
                            'param_name' => 'category',
                            'heading' => esc_html__('One-Category Portfolio List', 'byanca-core'),
                            'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'byanca-core')
                        ),
                        array(
                            'type' => 'autocomplete',
                            'param_name' => 'selected_projects',
                            'heading' => esc_html__('Show Only Projects with Listed IDs', 'byanca-core'),
                            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true
                            ),
                            'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'byanca-core')
                        ),
                        array(
                            'type' => 'autocomplete',
                            'param_name' => 'tag',
                            'heading' => esc_html__('One-Tag Portfolio List', 'byanca-core'),
                            'description' => esc_html__('Enter one tag slug (leave empty for showing all tags)', 'byanca-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'orderby',
                            'heading' => esc_html__('Order By', 'byanca-core'),
                            'value' => array_flip(byanca_select_get_query_order_by_array()),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'order',
                            'heading' => esc_html__('Order', 'byanca-core'),
                            'value' => array_flip(byanca_select_get_query_order_array()),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_title',
                            'heading' => esc_html__('Enable Title', 'byanca-core'),
                            'value' => array_flip(byanca_select_get_yes_no_select_array(false, true)),
                            'group' => esc_html__('Content Layout', 'byanca-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading' => esc_html__('Title Tag', 'byanca-core'),
                            'value' => array_flip(byanca_select_get_title_tag(true)),
                            'dependency' => array('element' => 'enable_title', 'value' => array('yes')),
                            'group' => esc_html__('Content Layout', 'byanca-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_text_transform',
                            'heading' => esc_html__('Title Text Transform', 'byanca-core'),
                            'value' => array_flip(byanca_select_get_text_transform_array(true)),
                            'dependency' => array('element' => 'enable_title', 'value' => array('yes')),
                            'group' => esc_html__('Content Layout', 'byanca-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_category',
                            'heading' => esc_html__('Enable Category', 'byanca-core'),
                            'value' => array_flip(byanca_select_get_yes_no_select_array(false, true)),
                            'group' => esc_html__('Content Layout', 'byanca-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_excerpt',
                            'heading' => esc_html__('Enable Excerpt', 'byanca-core'),
                            'value' => array_flip(byanca_select_get_yes_no_select_array(false)),
                            'group' => esc_html__('Content Layout', 'byanca-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'excerpt_length',
                            'heading' => esc_html__('Excerpt Length', 'byanca-core'),
                            'description' => esc_html__('Number of characters', 'byanca-core'),
                            'dependency' => array('element' => 'enable_excerpt', 'value' => array('yes')),
                            'group' => esc_html__('Content Layout', 'byanca-core')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
	        'type'                 => 'vertical-slider',
	        'number_of_items'      => '9',
	        'item_type'            => 'vertical-slider',
	        'item_style'           => 'vertical-slider',
	        'number_of_columns'    => 'one',
	        'space_between_items'  => 'no',
	        'category'             => '',
	        'selected_projects'    => '',
	        'tag'                  => '',
	        'orderby'              => 'date',
	        'order'                => 'ASC',
	        'enable_title'         => 'yes',
	        'title_tag'            => 'h3',
	        'title_text_transform' => '',
	        'enable_category'      => 'yes',
	        'enable_excerpt'       => '',
	        'excerpt_length'       => ''
        );
        $params = shortcode_atts($args, $atts);

        $html = '<div class="qodef-portfolio-vertical-slider-holder">';
        $html .= byanca_select_execute_shortcode('qodef_portfolio_list', $params);
        $html .= '</div>';

        return $html;
    }

    /**
     * Filter portfolio categories
     *
     * @param $query
     *
     * @return array
     */
    public function portfolioCategoryAutocompleteSuggester($query) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['slug'];
                $data['label'] = ((strlen($value['portfolio_category_title']) > 0) ? esc_html__('Category', 'byanca-core') . ': ' . $value['portfolio_category_title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioCategoryAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get portfolio category
            $portfolio_category = get_term_by('slug', $query, 'portfolio-category');
            if (is_object($portfolio_category)) {

                $portfolio_category_slug = $portfolio_category->slug;
                $portfolio_category_title = $portfolio_category->name;

                $portfolio_category_title_display = '';
                if (!empty($portfolio_category_title)) {
                    $portfolio_category_title_display = esc_html__('Category', 'byanca-core') . ': ' . $portfolio_category_title;
                }

                $data = array();
                $data['value'] = $portfolio_category_slug;
                $data['label'] = $portfolio_category_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter portfolios by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function portfolioIdAutocompleteSuggester($query) {
        global $wpdb;
        $portfolio_id = (int)$query;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : -1, stripslashes($query), stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__('Id', 'byanca-core') . ': ' . $value['id'] . ((strlen($value['title']) > 0) ? ' - ' . esc_html__('Title', 'byanca-core') . ': ' . $value['title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioIdAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get portfolio
            $portfolio = get_post((int)$query);
            if (!is_wp_error($portfolio)) {

                $portfolio_id = $portfolio->ID;
                $portfolio_title = $portfolio->post_title;

                $portfolio_title_display = '';
                if (!empty($portfolio_title)) {
                    $portfolio_title_display = ' - ' . esc_html__('Title', 'byanca-core') . ': ' . $portfolio_title;
                }

                $portfolio_id_display = esc_html__('Id', 'byanca-core') . ': ' . $portfolio_id;

                $data = array();
                $data['value'] = $portfolio_id;
                $data['label'] = $portfolio_id_display . $portfolio_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter portfolio tags
     *
     * @param $query
     *
     * @return array
     */
    public function portfolioTagAutocompleteSuggester($query) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['slug'];
                $data['label'] = ((strlen($value['portfolio_tag_title']) > 0) ? esc_html__('Tag', 'byanca-core') . ': ' . $value['portfolio_tag_title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio tag by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioTagAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get portfolio category
            $portfolio_tag = get_term_by('slug', $query, 'portfolio-tag');
            if (is_object($portfolio_tag)) {

                $portfolio_tag_slug = $portfolio_tag->slug;
                $portfolio_tag_title = $portfolio_tag->name;

                $portfolio_tag_title_display = '';
                if (!empty($portfolio_tag_title)) {
                    $portfolio_tag_title_display = esc_html__('Tag', 'byanca-core') . ': ' . $portfolio_tag_title;
                }

                $data = array();
                $data['value'] = $portfolio_tag_slug;
                $data['label'] = $portfolio_tag_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }
}