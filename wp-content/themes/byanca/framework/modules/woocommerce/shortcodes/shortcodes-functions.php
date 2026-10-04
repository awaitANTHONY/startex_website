<?php

if ( ! function_exists( 'byanca_select_include_woocommerce_shortcodes' ) ) {
	function byanca_select_include_woocommerce_shortcodes() {
		foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( byanca_select_core_plugin_installed() ) {
		add_action( 'byanca_core_action_include_shortcodes_file', 'byanca_select_include_woocommerce_shortcodes' );
	}
}
