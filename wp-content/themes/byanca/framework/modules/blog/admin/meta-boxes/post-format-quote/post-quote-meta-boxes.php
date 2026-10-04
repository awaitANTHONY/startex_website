<?php

if ( ! function_exists( 'byanca_select_map_post_quote_meta' ) ) {
	function byanca_select_map_post_quote_meta() {
		$quote_post_format_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'byanca' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'byanca' ),
				'description' => esc_html__( 'Enter Quote text', 'byanca' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'byanca' ),
				'description' => esc_html__( 'Enter Quote author', 'byanca' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_post_quote_meta', 25 );
}