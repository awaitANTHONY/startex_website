<div class="qodef-social-login-holder">
    <div class="qodef-social-login-holder-inner">
        <form method="post" class="qodef-login-form">
            <?php
            $redirect = '';
            if ( isset( $_GET['redirect_uri'] ) ) {
                $redirect = $_GET['redirect_uri'];
            } ?>
            <fieldset>
                <div>
                    <input type="text" name="user_login_name" id="user_login_name" placeholder="<?php esc_attr_e( 'User Name', 'byanca-membership' ) ?>" value="" required pattern=".{3,}" title="<?php esc_attr_e( 'Three or more characters', 'byanca-membership' ); ?>"/>
                </div>
                <div>
                    <input type="password" name="user_login_password" id="user_login_password" placeholder="<?php esc_attr_e( 'Password', 'byanca-membership' ) ?>" value="" required/>
                </div>
                <div class="qodef-lost-pass-remember-holder clearfix">
                    <span class="qodef-login-remember">
                        <input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
                        <label for="rememberme" class="qodef-checbox-label"><?php esc_html_e( 'Remember me', 'byanca-membership' ) ?></label>
                    </span>
                </div>
                <input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( $redirect ); ?>">
                <div class="qodef-login-button-holder">
                    <a href="<?php echo wp_lostpassword_url(); ?>" class="qodef-login-action-btn" data-el="#qodef-reset-pass-content" data-title="<?php esc_attr_e( 'Lost Password?', 'byanca-membership' ); ?>"><?php esc_html_e( 'Lost Your password?', 'byanca-membership' ); ?></a>
                    <?php
                    if ( byanca_membership_theme_installed() ) {
                        echo byanca_select_get_button_html( array(
                            'html_type' => 'button',
                            'text'      => esc_html__( 'Login', 'byanca-membership' ),
                            'type'      => 'outline',
                            'size'      => 'small'
                        ) );
                    } else {
                        echo '<button type="submit">' . esc_html__( 'Login', 'byanca-membership' ) . '</button>';
                    }
                    ?>
                    <?php wp_nonce_field( 'qodef-ajax-login-nonce', 'qodef-login-security' ); ?>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
    if(byanca_membership_theme_installed()) {
        //if social login enabled add social networks login
        $social_login_enabled = byanca_select_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
        if($social_login_enabled) { ?>
            <div class="qodef-login-form-social-login">
                <div class="qodef-login-social-title">
                    <?php esc_html_e('Connect with Social Networks', 'byanca-membership'); ?>
                </div>
                <div class="qodef-login-social-networks">
                    <?php do_action('byanca_membership_social_network_login'); ?>
                </div>
            </div>
        <?php }
    }
    do_action( 'byanca_membership_action_login_ajax_response' );
    ?>
</div>