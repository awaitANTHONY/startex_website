<?php
$item_classes           = $this_object->getItemClasses( $params );
$shader_styles          = $this_object->getShaderStyles( $params );
$content_styles         = $this_object->getStandardContentStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="qodef-pli qodef-item-space <?php echo esc_attr( $item_classes ); ?>" <?php byanca_select_inline_style($content_styles); ?>>
	<div class="qodef-pli-inner">
		<div class="qodef-pli-image">
			<?php byanca_select_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
		</div>
		<?php do_action('byanca_select_action_product_list_shortcode'); ?>
		<div class="qodef-pli-text" <?php echo byanca_select_get_inline_style( $shader_styles ); ?>>
			<div class="qodef-pli-text-outer">
				<div class="qodef-pli-text-inner">
					<?php byanca_select_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
				</div>
			</div>
		</div>
		<div class="qodef-pli-info">
			<div class="qodef-pli-info-outer">
				<div class="qodef-pli-info-inner">
					<?php byanca_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>

					<?php byanca_select_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>

					<?php byanca_select_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>

					<?php byanca_select_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>

					<?php byanca_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
				</div>
			</div>
		</div>
		<a class="qodef-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</div>