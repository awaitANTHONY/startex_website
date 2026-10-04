<?php

if ( ! function_exists( 'byanca_core_include_reviews_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function byanca_core_include_reviews_shortcodes_files() {
		foreach ( glob( BYANCA_CORE_ABS_PATH . '/reviews/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'byanca_core_action_include_shortcodes_file', 'byanca_core_include_reviews_shortcodes_files' );
}