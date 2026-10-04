<div class="qodef-presentation-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-presentation-secondary-image" <?php echo byanca_select_get_inline_attrs($parallax_data_2); ?>>
        <?php if(is_array($image_size_2) && count($image_size_2)) : ?>
            <?php echo byanca_select_generate_thumbnail($image_2['image_id'], null, $image_size_2[0], $image_size_2[1]); ?>
        <?php else: ?>
            <?php echo wp_get_attachment_image($image_2['image_id'], $image_size_2); ?>
        <?php endif; ?>
    </div>
	<div class="qodef-presentation-info">
		<div class="qodef-presentation-primary-image" <?php echo byanca_select_get_inline_attrs($parallax_data_1); ?>>
	        <?php if(is_array($image_size_1) && count($image_size_1)) : ?>
	            <?php echo byanca_select_generate_thumbnail($image_1['image_id'], null, $image_size_1[0], $image_size_1[1]); ?>
	        <?php else: ?>
	            <?php echo wp_get_attachment_image($image_1['image_id'], $image_size_1); ?>
	        <?php endif; ?>
	    </div>
	    <div class="qodef-presentation-text-holder"  <?php echo byanca_select_get_inline_attrs($parallax_data_3); ?>>
	        <?php if(!empty($title)) { ?>
	            <<?php echo esc_attr($title_tag); ?> class="qodef-presentation-title" <?php echo byanca_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
	        <?php } ?>
			<?php if($show_separator === 'yes') { ?>
				<span class="qodef-presentation-separator"></span>
			<?php } ?>
			<?php if(!empty($text)) { ?>
	            <p class="qodef-presentation-text" <?php echo byanca_select_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	        <?php } ?>
			<?php if($show_button === 'yes' && !empty($button_link) && !empty($button_text)) { ?>

				<div class="qodef-presentation-button" <?php echo byanca_select_get_inline_style($button_styles); ?>>
					<?php
					$button_params = array(
						'type'         => esc_attr($button_type),
						'size'         => esc_attr($button_size),
						'link'         => esc_url($button_link),
						'target'       => esc_attr($button_target),
						'text'         => esc_html($button_text)
					);

					echo byanca_select_return_button_html( $button_params );
					?>
				</div>

			<?php } ?>
	    </div>
	</div>
</div>