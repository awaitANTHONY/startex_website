<?php 

if ( !function_exists('byanca_membership_dashboard_edit_profile_fields') ) {
	function byanca_membership_dashboard_edit_profile_fields($params){

		extract($params);

		$edit_profile = byanca_select_add_dashboard_fields(array(
			'name' => 'edit_profile',
		));

		$edit_profile_form = byanca_select_add_dashboard_form(array(
			'name' => 'edit_profile_form',
			'form_id'   => 'qodef-membership-update-profile-form',
			'form_action' => 'byanca_membership_update_user_profile',
			'parent' => $edit_profile,
			'button_label' => esc_html__('UPDATE PROFILE','byanca-membership'),
			'button_args' => array(
				'data-updating-text' => esc_html__('UPDATING PROFILE', 'byanca-membership'),
				'data-updated-text' => esc_html__('PROFILE UPDATED', 'byanca-membership'),
			)
		));

		$edit_profile_name_group = byanca_select_add_dashboard_group(array(
			'name' => 'edit_profile_name_group',
			'parent' => $edit_profile_form,
		));

		byanca_select_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'first_name',
			'label' => esc_html__('First Name','byanca-membership'),
			'parent' => $edit_profile_name_group,
			'value' => $first_name
		));
		
		byanca_select_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'last_name',
			'label' => esc_html__('Last Name','byanca-membership'),
			'parent' => $edit_profile_name_group,
			'value' => $last_name
		));

		byanca_select_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'email',
			'label' => esc_html__('Email','byanca-membership'),
			'parent' => $edit_profile_form,
			'value' => $email,
			'args' => array(
				'input_type' => 'email'
			)
		));

		byanca_select_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'url',
			'label' => esc_html__('Website','byanca-membership'),
			'parent' => $edit_profile_form,
			'value' => $website
		));

		byanca_select_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'description',
			'label' => esc_html__('Description','byanca-membership'),
			'parent' => $edit_profile_form,
			'value' => $description
		));

		byanca_select_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'password',
			'label' => esc_html__('Password','byanca-membership'),
			'parent' => $edit_profile_form,
			'args' => array(
				'input_type' => 'password'
			)
		));

		byanca_select_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'password2',
			'label' => esc_html__('Repeat Password','byanca-membership'),
			'parent' => $edit_profile_form,
			'args' => array(
				'input_type' => 'password'
			)
		));

		do_action('byanca_membership_action_additional_edit_profile_fields', $edit_profile_form);

		$edit_profile->render();
	}
}
?>

<div class="qodef-membership-dashboard-page">
	<div>
		<?php byanca_membership_dashboard_edit_profile_fields($params); ?>
		<?php do_action( 'byanca_membership_action_login_ajax_response' ); ?>
	</div>
</div>