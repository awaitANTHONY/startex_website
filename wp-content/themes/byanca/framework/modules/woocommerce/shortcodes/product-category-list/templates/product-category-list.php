<div class="qodef-pcl-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="qodef-pcl-outer qodef-outer-space">
		<?php if ( $type === 'masonry' ) { ?>
			<div class="qodef-pcl-sizer"></div>
			<div class="qodef-pcl-gutter"></div>
		<?php } ?>
		<?php foreach ( $query_result as $query ) {
			$term_id     = $query->term_id;
			$term_name   = $query->name;
			$term_img_id = get_term_meta( $term_id, 'thumbnail_id', true );
			
			$item_class     = '';
			$cat_image_size = get_term_meta( $term_id, 'woo_category_masonry_fixed_dimensions', true );
			
			if ( ! empty( $cat_image_size ) && $type === 'masonry' ) {
				switch ( $cat_image_size ) {
					case 'small' :
						$image_size = 'byanca_select_image_square';
						break;
					case 'large-width':
						$image_size = 'byanca_select_image_landscape';
						break;
					case 'large-height':
						$image_size = 'byanca_select_image_portrait';
						break;
					case 'large-width-height':
						$image_size = 'byanca_select_image_huge';
						break;
				}
				
				$masonry_image_size = 'full';
				if ( in_array( $cat_image_size, array( 'small', 'large-width', 'large-height', 'large-width-height' ) ) ) {
					$masonry_image_size = $cat_image_size;
				}
				$item_class = 'qodef-masonry-image-' . $masonry_image_size;
			}

			if ($term_id) { ?>
			<div class="qodef-pcli qodef-item-space <?php echo esc_html( $item_class ); ?>">
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