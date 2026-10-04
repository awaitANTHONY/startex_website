<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = SELECT_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'byanca_select_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function byanca_select_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'byanca_select_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'byanca_select_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function byanca_select_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'byanca' ),
				'value'      => array(
					esc_html__( 'Full Width', 'byanca' ) => 'full-width',
					esc_html__( 'In Grid', 'byanca' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Select Anchor ID', 'byanca' ),
				'description' => esc_html__( 'For example "home"', 'byanca' ),
				'group'       => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'byanca' ),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'byanca' ),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'byanca' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'byanca' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'byanca' ),
				'value'       => array(
					esc_html__( 'Never', 'byanca' )        => '',
					esc_html__( 'Below 1280px', 'byanca' ) => '1280',
					esc_html__( 'Below 1024px', 'byanca' ) => '1024',
					esc_html__( 'Below 768px', 'byanca' )  => '768',
					esc_html__( 'Below 680px', 'byanca' )  => '680',
					esc_html__( 'Below 480px', 'byanca' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'byanca' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Select Parallax Background Image', 'byanca' ),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Select Parallax Speed', 'byanca' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'byanca' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Select Parallax Section Height (px)', 'byanca' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'dynamic_text_color_value',
				'heading'    => esc_html__( 'Dynamic Text Color Value', 'byanca' ),
				'description' => esc_html__( 'This text color value will be used if Dynamic Color metabox is set to Yes on this page.', 'byanca' ),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'byanca' ),
				'value'      => array(
					esc_html__( 'Default', 'byanca' ) => '',
					esc_html__( 'Left', 'byanca' )    => 'left',
					esc_html__( 'Center', 'byanca' )  => 'center',
					esc_html__( 'Right', 'byanca' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'byanca' ),
				'value'      => array(
					esc_html__( 'Full Width', 'byanca' ) => 'full-width',
					esc_html__( 'In Grid', 'byanca' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'byanca' ),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'byanca' ),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'byanca' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'byanca' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'byanca' ),
				'value'       => array(
					esc_html__( 'Never', 'byanca' )        => '',
					esc_html__( 'Below 1280px', 'byanca' ) => '1280',
					esc_html__( 'Below 1024px', 'byanca' ) => '1024',
					esc_html__( 'Below 768px', 'byanca' )  => '768',
					esc_html__( 'Below 680px', 'byanca' )  => '680',
					esc_html__( 'Below 480px', 'byanca' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'byanca' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'byanca' ),
				'value'      => array(
					esc_html__( 'Default', 'byanca' ) => '',
					esc_html__( 'Left', 'byanca' )    => 'left',
					esc_html__( 'Center', 'byanca' )  => 'center',
					esc_html__( 'Right', 'byanca' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'byanca' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( byanca_select_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Select Enable Passepartout', 'byanca' ),
					'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Select Settings', 'byanca' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Select Passepartout Size', 'byanca' ),
					'value'       => array(
						esc_html__( 'Tiny', 'byanca' )   => 'tiny',
						esc_html__( 'Small', 'byanca' )  => 'small',
						esc_html__( 'Normal', 'byanca' ) => 'normal',
						esc_html__( 'Large', 'byanca' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'byanca' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Select Disable Side Passepartout', 'byanca' ),
					'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'byanca' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Select Disable Top Passepartout', 'byanca' ),
					'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'byanca' )
				)
			);

			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_bottom_paspartu',
					'heading'     => esc_html__( 'Select Disable Bottom Passepartout', 'byanca' ),
					'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'byanca' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'byanca_select_vc_row_map' );
}