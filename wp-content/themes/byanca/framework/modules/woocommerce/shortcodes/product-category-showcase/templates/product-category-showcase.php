<div class="qodef-product-category-showcase <?php echo esc_attr( $holder_classes ) ?>">
	<div class="qodef-pcs-inner">

		<div class="qodef-pcs-primary-holder">

			<?php if ( ! empty( $category_1 ) && ! empty( $image_1 ) ) { ?>
				<div class="qodef-pcs-image-holder">
					<div class="qodef-pcs-image">
						<div class="qodef-pcs-image-inner">
							<a itemprop="url" class="qodef-pcs-link" href="<?php echo esc_url( get_term_link( $category_1, 'product_cat' ) ); ?>">
								<?php if ( is_array( $image_size_1 ) && count( $image_size_1 ) ) :
									echo byanca_select_generate_thumbnail( $image_1['image_id'], null, $image_size_1[0], $image_size_1[1] );
								else:
									echo wp_get_attachment_image( $image_1['image_id'], $image_size_1 );
								endif; ?>
								<h5 class="qodef-pcs-title" <?php echo byanca_select_get_inline_style($title_styles_1); ?>> <?php echo esc_html($category_name_1); ?></h5>
							</a>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>

		<div class="qodef-pcs-secondary-holder">

			<?php if ( ! empty( $category_2 ) && ! empty( $image_2 ) ) { ?>
				<div class="qodef-pcs-image-holder">
					<div class="qodef-pcs-image">
						<div class="qodef-pcs-image-inner">
							<a itemprop="url" class="qodef-pcs-link" href="<?php echo esc_url( get_term_link( $category_2, 'product_cat' ) ); ?>">
								<?php if ( is_array( $image_size_2 ) && count( $image_size_2 ) ) :
									echo byanca_select_generate_thumbnail( $image_2['image_id'], null, $image_size_2[0], $image_size_2[1] );
								else:
									echo wp_get_attachment_image( $image_2['image_id'], $image_size_2 );
								endif; ?>
								<h5 class="qodef-pcs-title" <?php echo byanca_select_get_inline_style($title_styles_2); ?>> <?php echo esc_html($category_name_2); ?></h5>
							</a>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if ( ! empty( $category_3 ) && ! empty( $image_3 ) ) { ?>
				<div class="qodef-pcs-image-holder">
					<div class="qodef-pcs-image">
						<div class="qodef-pcs-image-inner">
							<a itemprop="url" class="qodef-pcs-link" href="<?php echo esc_url( get_term_link( $category_3, 'product_cat' ) ); ?>">
								<?php if ( is_array( $image_size_3 ) && count( $image_size_3 ) ) :
									echo byanca_select_generate_thumbnail( $image_3['image_id'], null, $image_size_3[0], $image_size_3[1] );
								else:
									echo wp_get_attachment_image( $image_3['image_id'], $image_size_3 );
								endif; ?>
								<h5 class="qodef-pcs-title" <?php echo byanca_select_get_inline_style($title_styles_3); ?>> <?php echo esc_html($category_name_3); ?></h5>
							</a>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>

	</div>
</div>