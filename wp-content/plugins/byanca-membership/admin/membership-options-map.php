<?php
/**
 * Options map file
 */


if ( ! function_exists( 'byanca_membership_get_pages_list' ) ) {
	function byanca_membership_get_pages_list() {
		$all_pages = array();
		$pages     = get_pages();
		if ( ! empty( $pages ) ) {
			$all_pages[] = esc_html__( 'Default', 'byanca-membership' );
			foreach ( $pages as $page ) {
				$all_pages[ $page->ID ] = esc_html( $page->post_title );
			}
		}
		return $all_pages;
	}
}

if ( ! function_exists( 'byanca_membership_options_map' ) ) {
	function byanca_membership_options_map( $page ) {
		
		if ( byanca_membership_theme_installed() ) {
			
			$panel_social_login = byanca_select_add_admin_panel(
				array(
					'page'  => $page,
					'name'  => 'panel_social_login',
					'title' => esc_html__( 'Enable Social Login', 'byanca-membership' )
				)
			);
			
			byanca_select_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Enable Social Login', 'byanca-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login from social networks of your choice', 'byanca-membership' ),
					'parent'        => $panel_social_login
				)
			);
			
			$panel_enable_social_login = byanca_select_add_admin_panel(
				array(
					'page'       => $page,
					'name'       => 'panel_enable_social_login',
					'title'      => esc_html__( 'Enable Login via', 'byanca-membership' ),
					'dependency' => array(
						'show' => array(
							'enable_social_login' => 'yes'
						)
					)
				)
			);

			byanca_select_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'qodef_membership_privacy_policy_text',
					'label'         => esc_html__( 'Privacy Policy Text', 'byanca-membership' ),
					'description'   => esc_html__( 'Enter privacy policy text for registration modal form', 'byanca-membership' ),
					'parent'        => $panel_social_login
				)
			);
			byanca_select_add_admin_field(
				array(
					'type'          => 'select',
					'name'          => 'qodef_membership_privacy_policy_link',
					'label'         => esc_html__( 'Privacy Policy Link', 'byanca-membership' ),
					'description'   => esc_html__( 'Choose Privacy Policy Link page to link from registration modal form', 'byanca-membership' ),
					'default_value' => '',
					'options'       => byanca_membership_get_pages_list(),
					'parent'        => $panel_social_login
				)
			);
			byanca_select_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'qodef_membership_privacy_policy_link_text',
					'label'         => esc_html__( 'Privacy Policy Link Text', 'byanca-membership' ),
					'description'   => esc_html__( 'Enter privacy policy link text for registration modal form. Default value is "privacy policy"', 'byanca-membership' ),
					'parent'        => $panel_social_login
				)
			);
			
			byanca_select_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_facebook_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Facebook', 'byanca-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login via Facebook', 'byanca-membership' ),
					'parent'        => $panel_enable_social_login
				)
			);
			
			$enable_facebook_social_login_container = byanca_select_add_admin_container(
				array(
					'name'       => 'enable_facebook_social_login_container',
					'parent'     => $panel_enable_social_login,
					'dependency' => array(
						'show' => array(
							'enable_facebook_social_login' => 'yes'
						)
					)
				)
			);
			
			byanca_select_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'enable_facebook_login_fbapp_id',
					'default_value' => '',
					'label'         => esc_html__( 'Facebook App ID', 'byanca-membership' ),
					'description'   => esc_html__( 'Copy your application ID form created Facebook Application', 'byanca-membership' ),
					'parent'        => $enable_facebook_social_login_container
				)
			);
			
			byanca_select_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_google_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Google+', 'byanca-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login via Google+', 'byanca-membership' ),
					'parent'        => $panel_enable_social_login
				)
			);
			
			$enable_google_social_login_container = byanca_select_add_admin_container(
				array(
					'name'       => 'enable_google_social_login_container',
					'parent'     => $panel_enable_social_login,
					'dependency' => array(
						'show' => array(
							'enable_google_social_login' => 'yes'
						)
					)
				)
			);
			
			byanca_select_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'enable_google_login_client_id',
					'default_value' => '',
					'label'         => esc_html__( 'Client ID', 'byanca-membership' ),
					'description'   => esc_html__( 'Copy your Client ID form created Google Application', 'byanca-membership' ),
					'parent'        => $enable_google_social_login_container
				)
			);
		}
	}
	
	add_action( 'byanca_select_action_social_options', 'byanca_membership_options_map' );
}
