<?php

if ( ! function_exists( 'byanca_select_woocommerce_yith_template_single_title' ) ) {
	/**
	 * Function for overriding product title template in YITH Quick View plugin template
	 */
	function byanca_select_woocommerce_yith_template_single_title() {
		the_title( '<h4  itemprop="name" class="qodef-yith-product-title entry-title">', '</h4>' );
	}
}

if ( ! function_exists( 'byanca_select_woocommerce_yith_qcv_single_link_label' ) ) {
	function byanca_select_woocommerce_yith_qcv_single_link_label() {
		$product = wc_get_product( get_the_ID() );
		
		if ( ! empty( $product ) ) {
			$button_params = array(
				'type' => 'simple',
				'link' => get_permalink( $product->get_id() ),
				'text' => esc_html__( 'View full details', 'byanca' ),
				'custom_class' => 'qodef-product-single-link'
			);
			
			echo byanca_select_return_button_html( $button_params );
		}
	}
}