<?php

if ( ! function_exists( 'byanca_select_centered_title_type_options_meta_boxes' ) ) {
	function byanca_select_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'byanca' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'byanca' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_additional_title_area_meta_boxes', 'byanca_select_centered_title_type_options_meta_boxes', 5 );
}