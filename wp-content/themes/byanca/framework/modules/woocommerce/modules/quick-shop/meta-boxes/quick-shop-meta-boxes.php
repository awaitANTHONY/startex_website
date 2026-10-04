<?php

if ( ! function_exists( 'byanca_select_map_quick_shop_meta' ) ) {
	function byanca_select_map_quick_shop_meta() {
		
		$quick_shop_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => apply_filters( 'byanca_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'quick_shop_meta' ),
				'title' => esc_html__( 'Quick Shop', 'byanca' ),
				'name'  => 'quick_shop_meta'
			)
		);

		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_enable_quick_shop_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Quick Shop', 'byanca' ),
				'options'       => byanca_select_get_yes_no_select_array(),
				'parent'        => $quick_shop_meta_box
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_quick_shop_meta', 100 );
}