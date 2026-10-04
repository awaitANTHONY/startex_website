<<?php echo esc_attr( $title_tag ); ?> class="qodef-custom-font-holder <?php echo esc_attr( $holder_classes ); ?>" <?php byanca_select_inline_style( $holder_styles ); ?> <?php echo byanca_select_get_inline_attrs( $holder_data ); ?>>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="qodef-custom-font-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
    <?php } ?>
		<?php echo wp_kses_post( $title ); ?>
	<?php if (!empty($link)) { ?>
        </a>
    <?php } ?>
</<?php echo esc_attr( $title_tag ); ?>>