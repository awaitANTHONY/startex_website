<?php

if ( ! function_exists( 'byanca_select_woocommerce_wishlist_shortcode' ) ) {
	function byanca_select_woocommerce_wishlist_shortcode() {
		if ( byanca_select_is_yith_wcwl_installed() ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
	}
}

if ( ! function_exists( 'byanca_select_register_yith_wishlist_widget' ) ) {
	/**
	 * Function that register yith wishlist widget
	 */
	function byanca_select_register_yith_wishlist_widget( $widgets ) {
		$widgets[] = 'ByancaClassYithWishlist';
		
		return $widgets;
	}
	
	add_filter( 'byanca_select_filter_register_widgets', 'byanca_select_register_yith_wishlist_widget' );
}