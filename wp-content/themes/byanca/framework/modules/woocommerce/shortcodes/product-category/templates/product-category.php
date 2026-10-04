<div class="qodef-product-category <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pc-inner">
		<?php if ( ! empty( $background_label ) ) { ?>
			<div class="qodef-pc-background-label-holder">
				<span class="qodef-pc-background-label" <?php echo byanca_select_get_inline_style($background_label_styles); ?>> <?php echo esc_html($background_label); ?></span>
			</div>
		<?php } ?>
		<?php if ( is_array( $images ) && count( $images ) ) { ?>
			<div class="qodef-pc-image-list">
				<?php $image_counter = 0;
				foreach ( $images as $image ) {
					if ($image_counter < 2) {
						$image_counter++;
						?>
						<div class="qodef-pc-image" <?php echo byanca_select_get_inline_attrs(${'parallax_data_'.($image_counter)}); ?>>
							<div class="qodef-pc-image-inner">
								<?php if ( ! empty( $category ) ) { ?>
									<a itemprop="url" class="qodef-pc-link" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) ); ?>">
								<?php } ?>
									<?php if ( is_array( $image_size ) && count( $image_size ) ) :
										echo byanca_select_generate_thumbnail( $image['image_id'], null, $image_size[0], $image_size[1] );
									else:
										echo wp_get_attachment_image( $image['image_id'], $image_size );
									endif; ?>
								<?php if ( ! empty( $category ) ) { ?>
									</a>
								<?php } ?>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
			<div class="qodef-pc-title-holder">
				<?php if ( ! empty( $category ) ) { ?>
					<a itemprop="url" class="qodef-pc-link" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) ); ?>">
				<?php } ?>
						<span class="qodef-pc-title" <?php echo byanca_select_get_inline_style($title_styles); ?>> <?php echo esc_html($category_name); ?></span>
				<?php if ( ! empty( $category ) ) { ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>