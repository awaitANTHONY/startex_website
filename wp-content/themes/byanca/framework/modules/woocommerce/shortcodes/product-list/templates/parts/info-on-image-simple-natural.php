<?php
$item_classes           = $this_object->getItemClasses( $params );
$shader_styles          = $this_object->getShaderStyles( $params );
$content_styles         = $this_object->getStandardContentStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );

if($enable_fixed_proportions == 'yes'){
	$masonry_image_size = get_post_meta(get_the_ID(), 'qodef_product_featured_image_size', true);

	if(empty($masonry_image_size)) {
		$masonry_image_size = 'qodef-default';
	}

	$params['image_size'] = $masonry_image_size;
}
else if($enable_fixed_proportions == 'no'){
	$masonry_image_size = get_post_meta(get_the_ID(), 'qodef_product_featured_image_size_original_meta', true);

	if(empty($masonry_image_size)) {
		$masonry_image_size = 'qodef-default';
	}
}

else {
	$masonry_image_size = '';
}
?>
<div class="qodef-pli qodef-item-space <?php echo esc_html($masonry_image_size); ?>">
	<div class="qodef-pli-inner">
		<div class="qodef-pli-image">
			<?php byanca_select_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
		</div>
		<div class="qodef-pli-info">
			<div class="qodef-pli-info-outer">
				<div class="qodef-pli-info-inner">
					<?php byanca_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>

					<?php byanca_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
				</div>
			</div>
		</div>
		<a class="qodef-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</div>