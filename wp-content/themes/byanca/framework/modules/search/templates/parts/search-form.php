<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-search-page-form" method="get">
	<h2 class="qodef-search-title"><?php esc_html_e( 'New search:', 'byanca' ); ?></h2>
	<div class="qodef-form-holder">
		<div class="qodef-column-left">
			<input type="text" name="s" class="qodef-search-field" autocomplete="off" value="" placeholder="<?php esc_attr_e( 'Type here', 'byanca' ); ?>"/>
		</div>
		<div class="qodef-column-right">
			<button type="submit" class="qodef-search-submit"><?php echo byanca_select_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?></button>
		</div>
	</div>
	<div class="qodef-search-label">
		<?php esc_html_e( 'If you are not happy with the results below please do another search', 'byanca' ); ?>
	</div>
</form>