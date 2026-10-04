<?php
/**
 * Wordpress Users Login
 */

if ( ! function_exists( 'byanca_membership_login_user' ) ) {
	/**
	 * Login user
	 */
	function byanca_membership_login_user() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			byanca_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'byanca-membership' ) );
		} else {
			check_ajax_referer( 'qodef-ajax-login-nonce', 'security' );
			$data = $_POST;
			
			$login = $data['login_data'];
			parse_str( $login, $login_data );
			
			$credentials['user_login']    = $login_data['user_login_name'];
			$credentials['user_password'] = $login_data['user_login_password'];
			$redirect_uri                 = $login_data['redirect'];
			
			if ( isset( $credentials['remember'] ) && $credentials['remember'] == 'forever' ) {
				$credentials['remember'] = true;
			} else {
				$credentials['remember'] = false;
			}
			$user_signon = wp_signon( $credentials, false );
			
			if ( is_wp_error( $user_signon ) ) {
				byanca_membership_ajax_response( 'error', esc_html__( 'Wrong username or password.', 'byanca-membership' ) );
			} else {
				if ( $redirect_uri == '' ) {
					$redirect_uri = byanca_membership_get_dashboard_page_url();
					if ( empty( $redirect_uri ) ) {
						$redirect_uri = esc_url( home_url( '/' ) );
					}
				}
				byanca_membership_ajax_response( 'success', esc_html__( 'Login successful, redirecting...', 'byanca-membership' ), $redirect_uri );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_byanca_membership_login_user', 'byanca_membership_login_user' );
}

if ( ! function_exists( 'byanca_membership_register_user' ) ) {
	/**
	 * Register new user
	 */
	function byanca_membership_register_user() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			byanca_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'byanca-membership' ) );
		} else {
			check_ajax_referer( 'qodef-ajax-register-nonce', 'security' );
			$data = $_POST;
			
			$register = $data['register_data'];
			parse_str( $register, $register_data );
			$credentials['user_login']       = $register_data['user_register_name'];
			$credentials['user_email']       = $register_data['user_register_email'];
			$credentials['password']         = $register_data['user_register_password'];
			$credentials['confirm_password'] = $register_data['user_register_confirm_password'];
			
			$user_id    = username_exists( $credentials['user_login'] );
			$user_email = email_exists( $credentials['user_email'] );
			
			if ( ! $user_id && ! $user_email ) {
				if ( $credentials['password'] == $credentials['confirm_password'] ) {
					$user_save_flag = wp_create_user( $credentials['user_login'], $credentials['password'], $credentials['user_email'] );
					
					if ( is_wp_error( $user_save_flag ) ) {
						byanca_membership_ajax_response( 'error', esc_html__( 'Something went wrong', 'byanca-membership' ) );
					} else {
					    $default_params = array(
                            'ID' => $user_save_flag
                        );
					    $additional_params = array(
                            'role' =>  apply_filters('byanca_membership_default_role', get_option('default_role'))
                        );
					    $additional_params = apply_filters('byanca_membership_additional_registration_params', $additional_params, $register_data);
						wp_update_user( array_merge($default_params, $additional_params) );
						$mail_to = $credentials['user_email'];
						
						$subject = esc_html__( 'User Registration', 'byanca-membership' ); //Subject
						$message = esc_html__( 'You have registered successfully on ', 'byanca-membership' ) . esc_url( get_site_url() ); //Message
						wp_mail( $mail_to, $subject, $message );
						byanca_membership_ajax_response( 'success', esc_html__( 'You have registered successfully, please login with the created credentials', 'byanca-membership' ) );
						
					}
				} else {
					byanca_membership_ajax_response( 'error', esc_html__( 'Both passwords must match in order to register', 'byanca-membership' ) );
				}
			} elseif ( $user_id ) {
				byanca_membership_ajax_response( 'error', esc_html__( 'Username already exists', 'byanca-membership' ) );
			} else {
				byanca_membership_ajax_response( 'error', esc_html__( 'User with that name already exists', 'byanca-membership' ) );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_byanca_membership_register_user', 'byanca_membership_register_user' );
}

if ( ! function_exists( 'byanca_membership_user_lost_password' ) ) {
	/**
	 * Reset user password
	 */
	function byanca_membership_user_lost_password() {
		
		if ( ! function_exists( 'retrieve_password' ) ) {
			ob_start();
			include_once( ABSPATH . 'wp-login.php' );
			ob_clean();
		}
		
		$result = retrieve_password();
		if ( $result === true ) {
			byanca_membership_ajax_response( 'success', esc_html__( 'We have sent you an email', 'byanca-membership' ) );
		} else {
			byanca_membership_ajax_response( 'error', $result->get_error_message() );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_byanca_membership_user_lost_password', 'byanca_membership_user_lost_password' );
}