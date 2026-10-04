<div class="qodef-pl-holder qodef-grid-list qodef-disable-bottom-space <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
    <div class="qodef-pl-inner qodef-outer-space <?php echo esc_attr($this_object->getHolderInnerClasses($params)); ?> clearfix">
        <?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post();
			echo byanca_select_get_woo_shortcode_module_template_part( 'templates/parts/vertical-slider', 'product-list', '', $params );
		endwhile;
		else:
			byanca_select_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
    </div>
	<div class="swiper-pagination"></div>
</div>