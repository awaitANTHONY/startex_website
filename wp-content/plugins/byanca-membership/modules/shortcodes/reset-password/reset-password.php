<?php

namespace ByancaMembership\Shortcodes\ByancaUserResetPassword;

use ByancaMembership\Lib\ShortcodeInterface;

class ByancaUserResetPassword implements ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_user_reset_password';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {}
	
	public function render( $atts, $content = null ) {
		$args = array();
		
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$html = byanca_membership_get_module_template_part( 'shortcodes', 'reset-password', 'reset-password-template', '', $params );
		
		return $html;
	}
}