<?php
get_header();
byanca_select_get_title();
do_action( 'byanca_select_action_before_main_content' ); ?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action( 'byanca_select_action_after_container_open' ); ?>
	<div class="qodef-container-inner clearfix">
		<?php
			$byanca_taxonomy_id   = get_queried_object_id();
			$byanca_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$byanca_taxonomy      = ! empty( $byanca_taxonomy_id ) ? get_term_by( 'id', $byanca_taxonomy_id, $byanca_taxonomy_type ) : '';
			$byanca_taxonomy_slug = ! empty( $byanca_taxonomy ) ? $byanca_taxonomy->slug : '';
			$byanca_taxonomy_name = ! empty( $byanca_taxonomy ) ? $byanca_taxonomy->taxonomy : '';
			
			byanca_core_get_archive_portfolio_list( $byanca_taxonomy_slug, $byanca_taxonomy_name );
		?>
	</div>
	<?php do_action( 'byanca_select_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
