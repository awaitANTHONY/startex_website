<?php

if ( ! function_exists( 'byanca_select_portfolio_category_additional_fields' ) ) {
	function byanca_select_portfolio_category_additional_fields() {
		
		$fields = byanca_select_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		byanca_select_add_taxonomy_field(
			array(
				'name'   => 'qodef_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'byanca-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'byanca_select_action_custom_taxonomy_fields', 'byanca_select_portfolio_category_additional_fields' );
}