<?php
$item_classes           = $this_object->getItemClasses( $params );
$shader_styles          = $this_object->getShaderStyles( $params );
$text_wrapper_styles    = $this_object->getTextWrapperStyles( $params );
$content_styles         = $this_object->getStandardContentStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );

$masonry_image_size = get_post_meta(get_the_ID(), 'qodef_product_featured_image_size_original_meta', true);
if(empty($masonry_image_size)) {
    $masonry_image_size = '';
}
?>
<div class="qodef-pli qodef-item-space <?php echo esc_html($masonry_image_size); ?>">
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
		<a class="qodef-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="qodef-pli-text-wrapper" <?php echo byanca_select_get_inline_style( $text_wrapper_styles ); ?>>
		<?php byanca_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>

		<?php byanca_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>

		<?php byanca_select_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
		
		<?php byanca_select_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>

		<?php byanca_select_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
	</div>
</div>