<?php

if ( ! function_exists( 'byanca_core_reviews_map' ) ) {
	function byanca_core_reviews_map() {
		
		$reviews_panel = byanca_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'byanca-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'byanca-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'byanca-core' ),
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'byanca-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'byanca-core' ),
			)
		);
	}
	
	add_action( 'byanca_select_action_additional_page_options_map', 'byanca_core_reviews_map', 75 ); //one after elements
}