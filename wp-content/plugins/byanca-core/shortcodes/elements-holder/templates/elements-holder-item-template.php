<div class="qodef-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo byanca_select_get_inline_attrs($holder_data); ?>>
	<?php if (!empty($item_link)) : ?>
		<a class="qodef-ehi-link" href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
	<?php endif; ?>
	<div class="qodef-eh-item-bgrnd" <?php echo byanca_select_get_inline_style($bgrnd_styles); ?>></div>
	<div class="qodef-eh-item-inner">
		<div class="qodef-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo byanca_select_get_inline_style($content_styles); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>