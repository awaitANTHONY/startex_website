<div class="qodef-qsi">
	<div class="qodef-qsi-inner">
		<div class="qodef-qsi-image">
			<?php byanca_select_get_module_template_part( 'templates/parts/image-qs', 'woocommerce', '', $image_params ); ?>
		</div>
		<?php do_action('byanca_select_action_product_list_shortcode'); ?>
		<div class="qodef-qsi-text">
			<div class="qodef-qsi-text-outer">
				<div class="qodef-qsi-text-inner">
					<?php byanca_select_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $add_to_cart_params ); ?>
				</div>
			</div>
		</div>
		<a class="qodef-qsi-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="qodef-qsi-text-wrapper">
		<?php byanca_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $title_params ); ?>
		<?php byanca_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $price_params ); ?>
	</div>
</div>