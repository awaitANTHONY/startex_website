<?php $icon_html = byanca_select_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="qodef-icon-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo byanca_select_get_inline_style($holder_styles); ?>>
	<?php if(!empty($link)) : ?>
		<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
	<?php else: ?>
		<span class="qodef-icon-list-no-link">
	<?php endif; ?>
		<div class="qodef-il-icon-holder">
			<?php echo wp_kses_post($icon_html); ?>
		</div>
		<p class="qodef-il-text" <?php echo byanca_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
	<?php if(!empty($link)) : ?>
		</a>
	<?php else: ?>
		</span>
	<?php endif; ?>
</div>