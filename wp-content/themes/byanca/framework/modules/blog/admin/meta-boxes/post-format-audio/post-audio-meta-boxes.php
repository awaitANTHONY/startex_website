<?php

if ( ! function_exists( 'byanca_select_map_post_audio_meta' ) ) {
	function byanca_select_map_post_audio_meta() {
		$audio_post_format_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'byanca' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'byanca' ),
				'description'   => esc_html__( 'Choose audio type', 'byanca' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'byanca' ),
					'self'            => esc_html__( 'Self Hosted', 'byanca' )
				)
			)
		);
		
		$qodef_audio_embedded_container = byanca_select_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'qodef_audio_embedded_container'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'byanca' ),
				'description' => esc_html__( 'Enter audio URL', 'byanca' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'byanca' ),
				'description' => esc_html__( 'Enter audio link', 'byanca' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_post_audio_meta', 23 );
}