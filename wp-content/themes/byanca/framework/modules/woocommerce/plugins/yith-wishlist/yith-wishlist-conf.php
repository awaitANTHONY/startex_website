<?php

/*************** YITH WISHLIST FILTERS - begin ***************/

//Add yith wishlist button shop archive pages
add_action( 'byanca_select_action_woo_pl_info_on_image_hover', 'byanca_select_woocommerce_wishlist_shortcode', 2 );
add_action( 'byanca_select_action_woo_pl_info_below_image', 'byanca_select_woocommerce_wishlist_shortcode', 2 );

//Add yith wishlist button product list shortcode
add_action('byanca_select_action_product_list_shortcode', 'byanca_select_woocommerce_wishlist_shortcode', 2);

//Remove quick view button from wishlist
remove_all_actions('yith_wcwl_table_after_product_name');

/*************** YITH WISHLIST FILTERS - end ***************/