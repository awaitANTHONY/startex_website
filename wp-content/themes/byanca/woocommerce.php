<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$qodef_sidebar_layout  = byanca_select_sidebar_layout();
$qodef_grid_space_meta = byanca_select_options()->getOptionValue( 'woo_list_grid_space' );
$qodef_holder_classes  = ! empty( $qodef_grid_space_meta ) ? 'qodef-grid-' . $qodef_grid_space_meta . '-gutter' : '';

$product_page_styles = array();
$product_single_page_padding = byanca_select_shop_page_get_meta_field_intersect('woo_single_product_page_padding');
if ($product_single_page_padding !== '') {
	$product_page_styles[] = 'padding: ' . $product_single_page_padding;
}

get_header();
byanca_select_get_title();
get_template_part( 'slider' );
do_action('byanca_select_action_before_main_content');

//Woocommerce content
if ( ! is_singular( 'product' ) ) { ?>
	<div class="qodef-container">
		<div class="qodef-container-inner clearfix">
			<div class="qodef-grid-row <?php echo esc_attr( $qodef_holder_classes ); ?>">
				<div <?php echo byanca_select_get_content_sidebar_class(); ?>>
					<?php byanca_select_woocommerce_content(); ?>
				</div>
				<?php if ( $qodef_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo byanca_select_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
		<div class="qodef-full-width">
			<div class="qodef-full-width-inner" <?php echo byanca_select_get_inline_style($product_page_styles); ?>>
			<?php byanca_select_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>