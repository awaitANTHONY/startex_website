<?php

if ( ! function_exists('byanca_select_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function byanca_select_contact_form_map() {
		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'byanca'),
			'param_name' => 'html_class',
			'value' => array(
				esc_html__('Default', 'byanca') => 'default',
				esc_html__('Custom Style 1', 'byanca') => 'cf7_custom_style_1',
				esc_html__('Custom Style 2', 'byanca') => 'cf7_custom_style_2',
				esc_html__('Custom Style 3', 'byanca') => 'cf7_custom_style_3'
			),
			'description' => esc_html__('You can style each form element individually in Select Options > Contact Form 7', 'byanca')
		));
	}
	
	add_action('vc_after_init', 'byanca_select_contact_form_map');
}