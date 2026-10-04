<?php

if ( ! function_exists( 'byanca_select_map_post_gallery_meta' ) ) {
	
	function byanca_select_map_post_gallery_meta() {
		$gallery_post_format_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'byanca' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		byanca_select_add_multiple_images_field(
			array(
				'name'        => 'qodef_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'byanca' ),
				'description' => esc_html__( 'Choose your gallery images', 'byanca' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_post_gallery_meta', 21 );
}
