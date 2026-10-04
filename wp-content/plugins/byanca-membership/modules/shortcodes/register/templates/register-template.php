<div class="qodef-social-register-holder">
	<form method="post" class="qodef-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name" placeholder="<?php esc_attr_e( 'User Name', 'byanca-membership' ) ?>" value="" required
				       pattern=".{3,}" title="<?php esc_attr_e( 'Three or more characters', 'byanca-membership' ); ?>"/>
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email" placeholder="<?php esc_attr_e( 'Email', 'byanca-membership' ) ?>" value="" required />
			</div>
            <div>
                <input type="password" name="user_register_password" id="user_register_password" placeholder="<?php esc_attr_e('Password','byanca-membership') ?>" value="" required />
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password" placeholder="<?php esc_attr_e('Repeat Password','byanca-membership') ?>" value="" required />
            </div>
			<label class="qodef-register-privacy-policy">
				<?php
				$privacy_policy_text      = byanca_membership_theme_installed() ? byanca_select_options()->getOptionValue( 'qodef_membership_privacy_policy_text' ) : '';
				$privacy_policy_link      = byanca_membership_theme_installed() ? byanca_select_options()->getOptionValue( 'qodef_membership_privacy_policy_link' ) : '';
				$privacy_policy_link_text = byanca_membership_theme_installed() ? byanca_select_options()->getOptionValue( 'qodef_membership_privacy_policy_link_text' ) : '';
				$privacy_policy_text      = ! empty( $privacy_policy_text ) ? ( esc_html( $privacy_policy_text ) . ' %s.' ) : esc_html__( 'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our %s.', 'byanca-membership' );
				$privacy_policy_link      = ! empty( $privacy_policy_link ) ? esc_url( get_permalink( $privacy_policy_link ) ) : esc_url( home_url( '/?page_id=3' ) ); // page id 3 is default terms and condition WordPage page
				$privacy_policy_link_text = ! empty( $privacy_policy_link_text ) ? esc_html( $privacy_policy_link_text ) : esc_html__( 'privacy policy', 'byanca-membership' );
				echo sprintf(
					$privacy_policy_text,
					'<a itemprop="url" class="qodef-register-privacy-policy-link" href="' . $privacy_policy_link . '" target="_blank">' . $privacy_policy_link_text . '</a>'
				);
				?>
			</label>
            <?php do_action('byanca_membership_additional_registration_field'); ?>
			<div class="qodef-register-button-holder">
				<?php
				if ( byanca_membership_theme_installed() ) {
					echo byanca_select_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'Register', 'byanca-membership' ),
						'type'      => 'outline',
						'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'Register', 'byanca-membership' ) . '</button>';
				}
				wp_nonce_field( 'qodef-ajax-register-nonce', 'qodef-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'byanca_membership_action_login_ajax_response' ); ?>
</div>