<div class="qodef-pclc-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="qodef-pclc-outer qodef-owl-slider" <?php echo byanca_select_get_inline_attrs( $holder_data ); ?>>
		<?php foreach ( $query_result as $query ) {
			$term_id     = $query->term_id;
			$term_name   = $query->name;
			$term_img_id = get_term_meta( $term_id, 'thumbnail_id', true );

			if ($term_id) { ?>
			<div class="qodef-pcli qodef-item-space">
				<div class="qodef-pcli-inner">
					<div class="qodef-pcli-image">
						<?php if ($term_img_id) {
							echo wp_get_attachment_image( $term_img_id, $image_size );
						} else { ?>
							<img src="<?php echo SELECT_ASSETS_ROOT; ?>/img/placeholder.png" alt="<?php echo esc_attr( $term_name ); ?>" />
						<?php } ?>
					</div>
					<div class="qodef-pcli-text">
						<div class="qodef-pcli-text-outer">
							<div class="qodef-pcli-text-inner">
								<?php if($display_title === 'yes') { ?>
								    <<?php echo esc_attr($title_tag); ?> itemprop="name" class="entry-title qodef-pcl-title" <?php echo byanca_select_get_inline_style($title_styles); ?>>
										<?php echo esc_html( $term_name ); ?>
									</<?php echo esc_attr($title_tag); ?>>
								<?php } ?>
							</div>
						</div>
					</div>
					<a itemprop="url" class="qodef-pcli-link" href="<?php echo esc_url( get_term_link( $term_id ) ); ?>"></a>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
	</div>
</div>