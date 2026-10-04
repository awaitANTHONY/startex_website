<?php if ( byanca_select_options()->getOptionValue( 'enable_social_share' ) == 'yes' && byanca_select_options()->getOptionValue( 'enable_social_share_on_portfolio_item' ) == 'yes' ) : ?>
	<div class="qodef-ps-info-item qodef-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo byanca_select_get_social_share_html( array( 'type'  => 'list', 'title' => esc_attr__( 'Share:', 'byanca-core' ) ) ); ?>
	</div>
<?php endif; ?>