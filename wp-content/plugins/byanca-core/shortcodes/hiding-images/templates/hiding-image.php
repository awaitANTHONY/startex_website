<div class="qodef-hi-other-image <?php echo esc_attr($image_classes); ?>">
	<?php if (!empty($other_link)) : ?>
        <a class="qodef-hiding-image-other-link" href="<?php echo esc_url($other_link); ?>" <?php byanca_select_inline_attr($other_target, 'target'); ?>></a>
    <?php endif; ?>
    <?php echo wp_get_attachment_image($image, 'full'); ?>
</div>