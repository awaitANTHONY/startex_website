<?php
/**
 * Woocommerce helper functions
 */

if ( ! function_exists( 'byanca_select_woocommerce_meta_box_functions' ) ) {
	function byanca_select_woocommerce_meta_box_functions( $post_types ) {
		$post_types[] = 'product';
		
		return $post_types;
	}
	
	add_filter( 'byanca_select_filter_meta_box_post_types_save', 'byanca_select_woocommerce_meta_box_functions' );
}

if ( ! function_exists( 'byanca_select_woocommerce_add_social_share_option' ) ) {
	function byanca_select_woocommerce_add_social_share_option( $container ) {
		if ( byanca_select_is_woocommerce_installed() ) {
			byanca_select_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_social_share_on_product',
					'default_value' => 'no',
					'label'         => esc_html__( 'Product', 'byanca' ),
					'description'   => esc_html__( 'Show Social Share for Product Items', 'byanca' ),
					'parent'        => $container
				)
			);
		}
	}
	
	add_action( 'byanca_select_action_post_types_social_share', 'byanca_select_woocommerce_add_social_share_option', 10, 1 );
}

if ( ! function_exists( 'byanca_select_woocommerce_style_dynamics_deps' ) ) {
    function byanca_select_woocommerce_style_dynamics_deps( $deps ) {
        $style_dynamic_deps_array = array();
        if ( byanca_select_is_woocommerce_installed() && byanca_select_load_woo_assets() ) {
            $style_dynamic_deps_array[] = 'byanca-select-woo';
            if (byanca_select_is_responsive_on()) {
                $style_dynamic_deps_array[] = 'byanca-select-woo-responsive';
            }
        }

        return array_merge($deps, $style_dynamic_deps_array);
    }

    add_filter('byanca_select_filter_style_dynamic_deps','byanca_select_woocommerce_style_dynamics_deps');
}

if ( ! function_exists( 'byanca_select_get_woo_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param array $additional_params array of additional parameters to pass to template
	 *
	 * @return html
	 * @see byanca_select_get_template_part()
	 */
	function byanca_select_get_woo_shortcode_module_template_part( $template, $module, $slug = '', $params = array(), $additional_params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/woocommerce/shortcodes/' . $module;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		if ( is_array( $additional_params ) && count( $additional_params ) ) {
			extract( $additional_params );
		}
		
		$templates = array();
		
		if ( $temp !== '' ) {
			if ( $slug !== '' ) {
				$templates[] = "{$temp}-{$slug}.php";
			}
			
			$templates[] = $temp . '.php';
		}
		$located = byanca_select_find_template_path( $templates );
		if ( $located ) {
			ob_start();
			include( $located );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'byanca_select_is_woocommerce_page' ) ) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function byanca_select_is_woocommerce_page() {
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			return is_woocommerce();
		} elseif ( function_exists( 'is_cart' ) && is_cart() ) {
			return is_cart();
		} elseif ( function_exists( 'is_checkout' ) && is_checkout() ) {
			return is_checkout();
		} elseif ( function_exists( 'is_account_page' ) && is_account_page() ) {
			return is_account_page();
		}
	}
}

if ( ! function_exists( 'byanca_select_is_woocommerce_shop' ) ) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function byanca_select_is_woocommerce_shop() {
		return function_exists( 'is_shop' ) && ( is_shop() || is_product() );
	}
}

if ( ! function_exists( 'byanca_select_get_woo_shop_page_id' ) ) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function byanca_select_get_woo_shop_page_id() {
		if ( byanca_select_is_woocommerce_installed() ) {
			//get shop page id from options table
			$shop_id = get_option( 'woocommerce_shop_page_id' );
			$page_id = ! empty( $shop_id ) ? $shop_id : '-1';
			
			return $page_id;
		}
	}
}

if ( ! function_exists( 'byanca_select_is_product_category' ) ) {
	function byanca_select_is_product_category() {
		return function_exists( 'is_product_category' ) && is_product_category();
	}
}

if ( ! function_exists( 'byanca_select_is_product_tag' ) ) {
	function byanca_select_is_product_tag() {
		return function_exists( 'is_product_tag' ) && is_product_tag();
	}
}

if ( ! function_exists( 'byanca_select_load_woo_assets' ) ) {
	/**
	 * Function that checks whether WooCommerce assets needs to be loaded.
	 *
	 * @see byanca_select_is_woocommerce_page()
	 * @see byanca_select_has_woocommerce_shortcode()
	 * @see byanca_select_has_woocommerce_widgets()
	 * @return bool
	 */
	function byanca_select_load_woo_assets() {
		return byanca_select_is_woocommerce_installed() && ( byanca_select_is_woocommerce_page() || byanca_select_has_woocommerce_shortcode() || byanca_select_has_woocommerce_widgets() );
	}
}

if ( ! function_exists( 'byanca_select_return_woocommerce_global_variable' ) ) {
	function byanca_select_return_woocommerce_global_variable() {
		if ( byanca_select_is_woocommerce_installed() ) {
			global $product;
			
			return $product;
		}
	}
}

if ( ! function_exists( 'byanca_select_has_woocommerce_shortcode' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function byanca_select_has_woocommerce_shortcode() {
		$woocommerce_shortcodes = array(
			'add_to_cart',
			'add_to_cart_url',
			'product_page',
			'product',
			'products',
			'product_categories',
			'product_category',
			'recent_products',
			'featured_products',
			'sale_products',
			'best_selling_products',
			'top_rated_products',
			'product_attribute',
			'related_products',
			'woocommerce_messages',
			'woocommerce_cart',
			'woocommerce_checkout',
			'woocommerce_order_tracking',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order',
			'woocommerce_pay',
			'woocommerce_thankyou'
		);
		
		$woocommerce_shortcodes = apply_filters( 'byanca_select_filter_woocommerce_shortcodes_list', $woocommerce_shortcodes );
		
		foreach ( $woocommerce_shortcodes as $woocommerce_shortcode ) {
			$has_shortcode = byanca_select_has_shortcode( $woocommerce_shortcode );
			
			if ( $has_shortcode ) {
				return true;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'byanca_select_has_woocommerce_widgets' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function byanca_select_has_woocommerce_widgets() {
		$widgets_array = array(
			'qodef_woocommerce_dropdown_cart',
			'woocommerce_widget_cart',
			'woocommerce_layered_nav',
			'woocommerce_layered_nav_filters',
			'woocommerce_price_filter',
			'woocommerce_product_categories',
			'woocommerce_product_search',
			'woocommerce_product_tag_cloud',
			'woocommerce_products',
			'woocommerce_recent_reviews',
			'woocommerce_recently_viewed_products',
			'woocommerce_top_rated_products'
		);
		
		$widgets_array = apply_filters( 'byanca_select_filter_woocommerce_widgets_list', $widgets_array );
		
		foreach ( $widgets_array as $widget ) {
			$active_widget = is_active_widget( false, false, $widget );
			
			if ( $active_widget ) {
				return true;
			}
		}
		
		return false;
	}
}

if(!function_exists('byanca_select_woocommerce_product_single_class')) {
	function byanca_select_woocommerce_product_single_class($classes) {

		if(in_array('woocommerce', $classes)) {
			$id = get_the_ID();

			$product_single_layout      = byanca_select_options()->getOptionValue( 'single_product_layout' );
			$product_single_layout_meta = get_post_meta( $id, 'qodef_single_product_layout_meta', true );
			if ( ! empty( $product_single_layout_meta ) ) {
				$product_single_layout = $product_single_layout_meta;
			}

			$product_sticky_content = '';
			if ($product_single_layout === 'sticky-info') {
				$product_sticky_content = byanca_select_options()->getOptionValue( 'woo_enable_single_sticky_content' );
			}
			if ($product_single_layout_meta === 'sticky-info') {
				$product_sticky_content_meta = get_post_meta( $id, 'qodef_woo_enable_single_sticky_content_meta', true );

				if ( ! empty( $product_sticky_content_meta ) ) {
					$product_sticky_content = $product_sticky_content_meta;
				}
			}

			$product_thumbnail_position = '';
			if ($product_single_layout === 'standard' || $product_single_layout === 'simple') {
				$product_thumbnail_position = byanca_select_options()->getOptionValue( 'woo_set_thumb_images_position' );
			}
			if ($product_single_layout_meta === 'standard' || $product_single_layout_meta === 'simple') {
				$product_thumbnail_position_meta = get_post_meta( $id, 'qodef_woo_set_thumb_images_position_meta', true );

				if ( ! empty( $product_thumbnail_position_meta ) ) {
					$product_thumbnail_position = $product_thumbnail_position_meta;
				}
			}

			$product_additional_info_position      = byanca_select_options()->getOptionValue( 'single_product_additional_info_position' );
			$product_additional_info_position_meta = get_post_meta( $id, 'qodef_single_product_additional_info_position_meta', true );
			if ( ! empty( $product_additional_info_position_meta ) ) {
				$product_additional_info_position = $product_additional_info_position_meta;
			}

			if ( $product_single_layout !== '' ) {
				$classes[] = 'qodef-woo-single-page-' . $product_single_layout;
			}

			if (
				( $product_single_layout === 'wide-gallery' ) ||
				( $product_single_layout === 'sticky-info' && ! empty( $product_sticky_content ) && $product_sticky_content === 'yes' )
			) {
				$classes[] = 'qodef-woo-sticky-holder-enabled';
			}

			if ( $product_single_layout === 'standard' && ! empty( $product_thumbnail_position ) ) {
				$classes[] = 'qodef-woo-single-thumb-' . $product_thumbnail_position;
			}

			if ( ! empty( $product_additional_info_position ) ) {
				$classes[] = 'qodef-woo-single-info-' . $product_additional_info_position;
			}
		}

		return $classes;
	}

	add_filter('body_class', 'byanca_select_woocommerce_product_single_class');
}

if ( ! function_exists( 'byanca_select_add_product_to_search_types' ) ) {
    function byanca_select_add_product_to_search_types( $post_types ) {
        $post_types['product'] = esc_html__( 'Product', 'byanca' );

        return $post_types;
    }

    add_filter( 'byanca_select_filter_search_post_type_widget_params_post_type', 'byanca_select_add_product_to_search_types' );
}

if ( ! function_exists( 'byanca_select_get_woocommerce_sale' ) ) {
	function byanca_select_get_woocommerce_sale( $product ) {
		$enable_percent_mark = byanca_select_options()->getOptionValue( 'woo_enable_percent_sign_value' );
		$price               = intval( $product->get_regular_price() );
		$sale_price          = intval( $product->get_sale_price() );
		
		if ( $price > 0 && $enable_percent_mark === 'yes' ) {
			return '-' . ( 100 - round( ( $sale_price * 100 ) / $price ) ) . '%';
		} else {
			return esc_html__( 'Sale', 'byanca' );
		}
	}
}

if(!function_exists('byanca_select_woocommerce_product_list_rating_class')) {
	function byanca_select_woocommerce_product_list_rating_class($classes) {

		if(in_array('woocommerce', $classes)) {
			$disable_star_rating = byanca_select_options()->getOptionValue( 'woo_disable_star_rating' );

			if ($disable_star_rating === 'yes') {
				$classes[] = 'qodef-woo-product-list-star-rating-disabled';
			}
		}

		return $classes;
	}

	add_filter('body_class', 'byanca_select_woocommerce_product_list_rating_class');
}

if ( ! function_exists( 'byanca_select_is_yith_wcqv_installed' ) ) {
	function byanca_select_is_yith_wcqv_installed() {
		return defined( 'YITH_WCQV' ) && get_option( 'yith-wcqv-enable' ) == 'yes';
	}
}

if ( ! function_exists( 'byanca_select_is_yith_wcwl_installed' ) ) {
	function byanca_select_is_yith_wcwl_installed() {
		return defined( 'YITH_WCWL' );
	}
}

if ( ! function_exists( 'byanca_select_woocommerce_comments_form_style' ) ) {
	function byanca_select_woocommerce_comments_form_style( $comment_form ) {

		$commenter = wp_get_current_commenter();

		$comment_form['fields']['author'] = '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'byanca' ) . '&nbsp;<span class="required">*</span></label> ' .
							'<input id="author" name="author" type="text" placeholder="' . esc_attr__('Name *', 'byanca') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>';

		$comment_form['fields']['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'byanca' ) . '&nbsp;<span class="required">*</span></label> ' .
							'<input id="email" name="email" type="email" placeholder="' . esc_attr__('Email *', 'byanca') . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>';

		$comment_form['comment_field'] = '';

		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
			$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'byanca' ) . '</label><select name="rating" id="rating" aria-required="true" required>
				<option value="">' . esc_html__( 'Rate&hellip;', 'byanca' ) . '</option>
				<option value="5">' . esc_html__( 'Perfect', 'byanca' ) . '</option>
				<option value="4">' . esc_html__( 'Good', 'byanca' ) . '</option>
				<option value="3">' . esc_html__( 'Average', 'byanca' ) . '</option>
				<option value="2">' . esc_html__( 'Not that bad', 'byanca' ) . '</option>
				<option value="1">' . esc_html__( 'Very poor', 'byanca' ) . '</option>
			</select></div>';
		}

		$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'byanca' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__('Your review *', 'byanca') . '" aria-required="true" required></textarea></p>';

		return $comment_form;
	}

	add_filter( 'woocommerce_product_review_comment_form_args', 'byanca_select_woocommerce_comments_form_style' );
}

if ( ! function_exists( 'byanca_select_woocommerce_add_html_before_account_navigation' ) ) {
	function byanca_select_woocommerce_add_html_before_account_navigation( $container ) {
		if ( byanca_select_is_woocommerce_installed() ) {

			$current_user = wp_get_current_user();

			if(is_user_logged_in()) {
				print '<div class="qodef-my-account-personal-info-holder">';
				print '<h2 class="qodef-my-account-personal-info-title">' . esc_html__( 'Hello', 'byanca' ) . '</h2>';
				print '<p class="qodef-my-account-personal-info">';
				print '<span>@' . esc_html( $current_user->user_login ) . '</span>';
				print '</p>';
				print'</div>';
			}
		}
	}

	add_action( 'woocommerce_before_account_navigation', 'byanca_select_woocommerce_add_html_before_account_navigation', 10, 1 );
}