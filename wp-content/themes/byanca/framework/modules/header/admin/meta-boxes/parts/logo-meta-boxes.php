<?php

if ( ! function_exists( 'byanca_select_logo_meta_box_map' ) ) {
	function byanca_select_logo_meta_box_map() {
		
		$logo_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => apply_filters( 'byanca_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'byanca' ),
				'name'  => 'logo_meta'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'byanca' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'byanca' ),
				'parent'      => $logo_meta_box
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'byanca' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'byanca' ),
				'parent'      => $logo_meta_box
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'byanca' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'byanca' ),
				'parent'      => $logo_meta_box
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'byanca' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'byanca' ),
				'parent'      => $logo_meta_box
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'byanca' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'byanca' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_logo_meta_box_map', 47 );
}