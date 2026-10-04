<div class="qodef-membership-dashboard-page">
	<div class="qodef-membership-dashboard-page-content">
		<div class="qodef-profile-image">
            <?php echo byanca_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First Name', 'byanca-membership' ); ?>:</span>
			<?php echo byanca_select_get_plugin_module_template_part($first_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'byanca-membership' ); ?>:</span>
			<?php echo byanca_select_get_plugin_module_template_part($last_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'byanca-membership' ); ?>:</span>
			<?php echo byanca_select_get_plugin_module_template_part($email); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'byanca-membership' ); ?>:</span>
			<?php echo byanca_select_get_plugin_module_template_part($description); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'byanca-membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo byanca_select_get_plugin_module_template_part($website); ?></a>
		</p>
        <?php do_action('byanca_membership_action_dashboard_additional_user_fields');?>
	</div>
</div>
