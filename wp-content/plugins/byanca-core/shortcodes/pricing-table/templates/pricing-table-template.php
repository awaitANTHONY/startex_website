<div class="qodef-price-table qodef-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pt-inner">
		<?php if ( ! empty( $set_active_item ) && $set_active_item === 'yes' && ! empty( $active_item_label ) ) { ?>
			<span class="qodef-pt-active-item-label"><?php echo esc_html($active_item_label); ?></span>
		<?php } ?>
		<?php if (!empty($image)) { ?>
			<div class="qodef-pt-image-holder">
				<?php if(is_array($image_size) && count($image_size)) : ?>
	                <?php echo byanca_select_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
	            <?php else: ?>
					<?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
	            <?php endif; ?>
			</div>
		<?php } ?>
		<div class="qodef-pt-main-holder" <?php echo byanca_select_get_inline_style($holder_styles); ?>>
			<div class="qodef-pt-title-holder">
				<h5 class="qodef-pt-title" <?php echo byanca_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></h5>
			</div>
			<div class="qodef-pt-prices">
				<span class="qodef-pt-value" <?php echo byanca_select_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span><span
						class="qodef-pt-price" <?php echo byanca_select_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<span class="qodef-pt-mark" <?php echo byanca_select_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></span>
			</div>
			<div class="qodef-pt-content">
				<?php echo do_shortcode($content); ?>
			</div>
			<?php
			if(!empty($button_text)) { ?>
				<div class="qodef-pt-button">
					<?php echo byanca_select_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'medium'
					)); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>