<div class="qodef-qs-products-holder">
	<div class="qodef-qs-products-holder-inner clearfix">
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post();
			byanca_select_get_module_template_part( 'modules/quick-shop/templates/parts/info-below-image', 'woocommerce', '', $params );
		endwhile;
		else:
			byanca_select_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>
<div class="qodef-qs-loader-wrapper">
	<span class="qodef-qs-loader"><?php esc_attr_e('Loading','byanca'); ?></span>
</div>