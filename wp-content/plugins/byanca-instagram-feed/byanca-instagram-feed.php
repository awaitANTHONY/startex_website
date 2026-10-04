<?php
/*
Plugin Name: Byanca Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Select Themes
Version: 2.0.1
*/
define('BYANCA_INSTAGRAM_FEED_VERSION', '2.0.1');
define('BYANCA_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('BYANCA_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'BYANCA_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'BYANCA_INSTAGRAM_ASSETS_PATH', BYANCA_INSTAGRAM_ABS_PATH . '/assets' );
define( 'BYANCA_INSTAGRAM_ASSETS_URL_PATH', BYANCA_INSTAGRAM_URL_PATH . 'assets' );
define( 'BYANCA_INSTAGRAM_SHORTCODES_PATH', BYANCA_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'BYANCA_INSTAGRAM_SHORTCODES_URL_PATH', BYANCA_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'byanca_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function byanca_instagram_theme_installed() {
        return defined( 'SELECT_ROOT' );
    }
}

if ( ! function_exists( 'byanca_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function byanca_instagram_feed_text_domain() {
		load_plugin_textdomain( 'byanca-instagram-feed', false, BYANCA_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'byanca_instagram_feed_text_domain' );
}