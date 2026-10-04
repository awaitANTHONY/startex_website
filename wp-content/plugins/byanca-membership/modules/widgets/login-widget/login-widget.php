<?php

class ByancaMembershipLoginRegister extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'qodef_login_register_widget',
			esc_html__( 'Byanca Login Widget', 'byanca-membership' ),
			array( 'description' => esc_html__( 'Login and register membership widget', 'byanca-membership' ) )
		);
	}
	
	public function widget( $args, $instance ) {
		$additional_class = is_user_logged_in() ? 'qodef-user-logged-in' : 'qodef-user-not-logged-in';
		
		echo '<div class="widget qodef-login-register-widget ' . esc_attr( $additional_class ) . '">';
        if ( ! is_user_logged_in() ) {
            echo byanca_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template', 'logged-out' );
        } else {
            echo byanca_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template', 'logged-in' );
        }
		echo '</div>';
	}
}

if ( ! function_exists( 'byanca_membership_login_widget_load' ) ) {
	function byanca_membership_login_widget_load() {
		register_widget( 'ByancaMembershipLoginRegister' );
	}
	
	add_action( 'widgets_init', 'byanca_membership_login_widget_load' );
}

