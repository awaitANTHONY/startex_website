<?php

if ( ! function_exists( 'byanca_core_map_testimonials_meta' ) ) {
	function byanca_core_map_testimonials_meta() {
		$testimonial_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'byanca-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'byanca-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'byanca-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'byanca-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'byanca-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'byanca-core' ),
				'description' => esc_html__( 'Enter author name', 'byanca-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'byanca-core' ),
				'description' => esc_html__( 'Enter author job position', 'byanca-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_core_map_testimonials_meta', 95 );
}