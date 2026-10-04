<?php
/*
Plugin Name: Byanca Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Select Themes
Version: 1.1.2
*/

define( 'BYANCA_TWITTER_FEED_VERSION', '1.1.2' );
define( 'BYANCA_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'BYANCA_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'BYANCA_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'BYANCA_TWITTER_ASSETS_PATH', BYANCA_TWITTER_ABS_PATH . '/assets' );
define( 'BYANCA_TWITTER_ASSETS_URL_PATH', BYANCA_TWITTER_URL_PATH . 'assets' );
define( 'BYANCA_TWITTER_SHORTCODES_PATH', BYANCA_TWITTER_ABS_PATH . '/shortcodes' );
define( 'BYANCA_TWITTER_SHORTCODES_URL_PATH', BYANCA_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'byanca_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function byanca_twitter_theme_installed() {
		return defined( 'SELECT_ROOT' );
	}
}

if ( ! function_exists( 'byanca_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function byanca_twitter_feed_text_domain() {
		load_plugin_textdomain( 'byanca-twitter-feed', false, BYANCA_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'byanca_twitter_feed_text_domain' );
}