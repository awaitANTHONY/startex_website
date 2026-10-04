<?php
$product_image_size = 'woocommerce_thumbnail';

$unique_image_meta       = get_post_meta( get_the_ID(), 'qodef_woo_product_unique_featured_image_meta', true );
$image_meta              = get_post_meta( get_the_ID(), 'qodef_woo_product_list_featured_image_meta', true );
$has_featured            = ! empty( $unique_image_meta ) || ! empty( $image_meta ) || has_post_thumbnail();
$product_unique_image_id = ! empty( $unique_image_meta ) ? byanca_select_get_attachment_id_from_url( $unique_image_meta ) : '';
$product_list_image_id   = ! empty( $image_meta ) ? byanca_select_get_attachment_id_from_url( $image_meta ) : '';

if ($has_featured) {
	if ( ! empty( $product_unique_image_id ) ) {
		echo wp_get_attachment_image( $product_unique_image_id, apply_filters( 'byanca_select_filter_product_list_image_simple_size', $product_image_size ) );
	} elseif ( ! empty( $product_list_image_id ) ) {
		echo wp_get_attachment_image( $product_list_image_id, apply_filters( 'byanca_select_filter_product_list_image_simple_size', $product_image_size ) );
	} else {
		the_post_thumbnail( apply_filters( 'byanca_select_filter_product_list_image_simple_size', $product_image_size ) );
	}
}