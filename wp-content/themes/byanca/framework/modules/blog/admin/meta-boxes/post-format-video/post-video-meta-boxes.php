<?php

if ( ! function_exists( 'byanca_select_map_post_video_meta' ) ) {
	function byanca_select_map_post_video_meta() {
		$video_post_format_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'byanca' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'byanca' ),
				'description'   => esc_html__( 'Choose video type', 'byanca' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'byanca' ),
					'self'            => esc_html__( 'Self Hosted', 'byanca' )
				)
			)
		);
		
		$qodef_video_embedded_container = byanca_select_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'qodef_video_embedded_container'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'byanca' ),
				'description' => esc_html__( 'Enter Video URL', 'byanca' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'byanca' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'byanca' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'byanca' ),
				'description' => esc_html__( 'Enter video image', 'byanca' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_post_video_meta', 22 );
}