<?php

if ( ! function_exists( 'byanca_select_get_quick_shop' ) ) {
	/**
	 * Loads HTML
	 */
	function byanca_select_get_quick_shop() {

		if ( byanca_select_get_meta_field_intersect( 'enable_quick_shop' ) === 'yes' ) {
			byanca_select_load_quick_shop_template();
		}
	}
	
	//Get subscribe popup HTML
	add_action( 'byanca_select_action_after_footer_content', 'byanca_select_get_quick_shop' );
}

if ( ! function_exists( 'byanca_select_load_quick_shop_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function byanca_select_load_quick_shop_template() {
		$parameters  = array();
		$opener_text = byanca_select_options()->getOptionValue( 'quick_shop_opener_text' );

		$parameters['quick_shop_opener_text'] = ! empty($opener_text) ? $opener_text : esc_html__('Quick Shop', 'byanca');
		$parameters['filter_params'] = byanca_select_page_quick_shop_filter_params();
		$parameters['list_params'] = byanca_select_page_quick_shop_list_params();


		byanca_select_get_module_template_part( 'modules/quick-shop/templates/quick-shop', 'woocommerce', '', $parameters );
	}
}

if (!function_exists('byanca_select_page_quick_shop_class')) {
	/**
	 * Function that adds classes on body for quick shop
	 */
	function byanca_select_page_quick_shop_class($classes) {

		if (byanca_select_get_meta_field_intersect('enable_quick_shop') === 'yes') {
			$classes[] = 'qodef-quick-shop';
		}

		return $classes;
	}

	add_filter('body_class', 'byanca_select_page_quick_shop_class');
}
if (!function_exists('byanca_select_page_quick_shop_filter_params')) {

	function byanca_select_page_quick_shop_filter_params() {
		$filter_params = array();

		$args = array(
			'taxonomy'   => "product_cat",
			'hide_empty' => false,
		);
		$product_categories = get_terms($args);

		$filter_params['product_categories'] = $product_categories;

		return $filter_params;
	}

}
if (!function_exists('byanca_select_page_quick_shop_list_params')) {

	function byanca_select_page_quick_shop_list_params() {
		$list_params = array();

		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => 8
		);
		$query_result = new \WP_Query( $queryArray );
		$list_params['query_result'] = $query_result;

        $list_params['title_params'] = array(
            'display_title' => 'yes',
            'title_tag' => 'h6',
            'title_styles' => '',
            'class_name' => 'qsi'
        );

        $list_params['image_params'] = array(
            'class_name' => 'pli',
            'image_size' => 'qs_portrait'
        );

        $list_params['category_params'] = array(
            'display_category' => 'yes',
            'class_name' => 'qsi'
        );

        $list_params['price_params'] = array(
            'display_price' => 'yes',
            'class_name' => 'qsi'
        );

        $list_params['add_to_cart_params'] = array(
            'display_button' => 'yes',
            'class_name' => 'qsi'
        );


		return $list_params;
	}

}
if ( ! function_exists( 'byanca_select_quick_shop_filter' ) ) {
	function byanca_select_quick_shop_filter() {
		$params = array();
		
		check_ajax_referer( 'qodef_product_quickview_nonce_' . sanitize_text_field( $_POST['product_quickview_id'] ), 'product_quickview_nonce' );

		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => 8
		);

		if ( ! empty( $_POST['cat'] ) ) {
			$queryArray['product_cat'] = $_POST['cat'];
		}

		$query_results         = new \WP_Query( $queryArray );
        $params['title_params'] = array(
            'display_title' => 'yes',
            'title_tag' => 'h6',
            'title_styles' => '',
            'class_name' => 'qsi'
        );

        $params['image_params'] = array(
            'class_name' => 'pli',
            'image_size' => 'qs_portrait'
        );

        $params['category_params'] = array(
            'display_category' => 'yes',
            'class_name' => 'qsi'
        );

        $params['price_params'] = array(
            'display_price' => 'yes',
            'class_name' => 'qsi'
        );

        $params['add_to_cart_params'] = array(
            'display_button' => 'yes',
            'class_name' => 'qsi'
        );
		ob_start();

		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				byanca_select_get_module_template_part( 'modules/quick-shop/templates/parts/info-below-image', 'woocommerce', '', $params );
			endwhile;
		else:
			byanca_select_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;

		$html = ob_get_contents();

		ob_end_clean();

		wp_reset_postdata();

		$return_obj = array(
			'html' => $html,
		);

		echo json_encode( $return_obj );
		exit;
	}

	add_action( 'wp_ajax_nopriv_byanca_select_quick_shop_filter', 'byanca_select_quick_shop_filter' );
	add_action( 'wp_ajax_byanca_select_quick_shop_filter', 'byanca_select_quick_shop_filter' );
}