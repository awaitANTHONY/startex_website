<?php

if ( ! function_exists( 'byanca_select_quick_shop_options_map' ) ) {
	function byanca_select_quick_shop_options_map() {

		$quick_shop_panel = byanca_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Quick Shop', 'byanca' ),
				'name'  => 'quick_shop',
				'page'  => '_woocommerce_page'
			)
		);
		
		byanca_select_add_admin_field(
			array(
				'parent'        => $quick_shop_panel,
				'type'          => 'yesno',
				'name'          => 'enable_quick_shop',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Quick Shop', 'byanca' )
			)
		);

		$enable_quick_shop_container = byanca_select_add_admin_container(
			array(
				'parent'     => $quick_shop_panel,
				'name'       => 'enable_quick_shop_container',
				'dependency' => array(
					'hide' => array(
						'enable_quick_shop' => array( 'no', '' )
					)
				)
			)
		);

		byanca_select_add_admin_field(
			array(
				'parent'      => $enable_quick_shop_container,
				'type'        => 'text',
				'name'        => 'quick_shop_opener_text',
				'label'       => esc_html__( 'Opener Text', 'byanca' ),
				'description' => esc_html__( 'Enter opener text', 'byanca' )
			)
		);

	}
	
	add_action( 'byanca_select_woocommerce_additional_options_map', 'byanca_select_quick_shop_options_map' );
}