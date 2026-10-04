<?php

if ( ! function_exists( 'byanca_select_map_general_meta' ) ) {
	function byanca_select_map_general_meta() {
		
		$general_meta_box = byanca_select_create_meta_box(
			array(
				'scope' => apply_filters( 'byanca_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'byanca' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'byanca' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'byanca' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'byanca' ),
				'parent'        => $general_meta_box
			)
		);
		
		$qodef_content_padding_group = byanca_select_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'byanca' ),
				'description' => esc_html__( 'Define styles for Content area', 'byanca' ),
				'parent'      => $general_meta_box
			)
		);
		
			$qodef_content_padding_row = byanca_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row',
					'parent' => $qodef_content_padding_group
				)
			);
			
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'byanca' ),
						'parent'      => $qodef_content_padding_row
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'byanca' ),
						'parent'        => $qodef_content_padding_row
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'byanca' ),
						'options'       => byanca_select_get_yes_no_select_array(),
						'parent'        => $qodef_content_padding_row
					)
				);
		
			$qodef_content_padding_row_1 = byanca_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row_1',
					'next'   => true,
					'parent' => $qodef_content_padding_group
				)
			);
		
				byanca_select_create_meta_box_field(
					array(
						'name'   => 'qodef_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'byanca' ),
						'parent' => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'name'    => 'qodef_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'byanca' ),
						'parent'  => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);

		$qodef_page_background_text_group = byanca_select_add_admin_group(
			array(
				'name'   => 'qodef_page_background_text_group',
				'title'       => esc_html__( 'Page Background Text', 'byanca' ),
				'description' => esc_html__( 'Entered text will be displayed as page background content. Enabling Dynamic Color will change text color depending on the value set on the corresponding Row element.', 'byanca' ),
				'parent'      => $general_meta_box
			)
		);

			$qodef_page_background_text_row = byanca_select_add_admin_row(
				array(
					'name'   => 'qodef_page_background_text_row',
					'parent' => $qodef_page_background_text_group
				)
			);

				byanca_select_create_meta_box_field(
					array(
						'name'    => 'qodef_page_background_text',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Text', 'byanca' ),
						'args'        => array(
							'col_width' => 4
						),
						'parent'  => $qodef_page_background_text_row
					)
				);

				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_text_dynamic_color',
						'type'        => 'yesnosimple',
						'default_value' => 'no',
						'label'       => esc_html__( 'Dynamic Color', 'byanca' ),
						'parent'      => $qodef_page_background_text_row
					)
				);
			
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'byanca' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'byanca' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'byanca' ),
					'qodef-grid-1300' => esc_html__( '1300px', 'byanca' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'byanca' ),
					'qodef-grid-1100' => esc_html__( '1100px', 'byanca' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'byanca' ),
					'qodef-grid-800'  => esc_html__( '800px', 'byanca' )
				)
			)
		);
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'byanca' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'byanca' ),
				'options'     => byanca_select_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		byanca_select_create_meta_box_field(
			array(
				'name'    => 'qodef_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'byanca' ),
				'parent'  => $general_meta_box,
				'options' => byanca_select_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = byanca_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'byanca' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'byanca' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'byanca' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'byanca' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'byanca' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'byanca' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'name'          => 'qodef_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'byanca' ),
						'description'   => esc_html__( 'Choose background image attachment', 'byanca' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'byanca' ),
							'fixed'  => esc_html__( 'Fixed', 'byanca' ),
							'scroll' => esc_html__( 'Scroll', 'byanca' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'byanca' ),
				'parent'        => $general_meta_box,
				'options'       => byanca_select_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = byanca_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'qodef_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'byanca' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'byanca' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'byanca' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'byanca' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'byanca' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'byanca' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				byanca_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'byanca' ),
						'options'       => byanca_select_get_yes_no_select_array(),
					)
				);

				byanca_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_disable_bottom_paspartu_meta',
						'label'         => esc_html__( 'Disable Bottom Passepartout', 'byanca' ),
						'options'       => byanca_select_get_yes_no_select_array(),
					)
				);
		
				byanca_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'byanca' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'byanca' ),
						'options'       => byanca_select_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		byanca_select_create_meta_box_field(
			array(
				'name'          => 'qodef_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'byanca' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'byanca' ),
				'parent'        => $general_meta_box,
				'options'       => byanca_select_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = byanca_select_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				byanca_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'byanca' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'byanca' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => byanca_select_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = byanca_select_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'qodef_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					byanca_select_create_meta_box_field(
						array(
							'name'   => 'qodef_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'byanca' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = byanca_select_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'byanca' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'byanca' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = byanca_select_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					byanca_select_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'qodef_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'byanca' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'byanca' ),
								'loading_title'         => esc_html__( 'Loading Title', 'byanca' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'byanca' ),
								'pulse'                 => esc_html__( 'Pulse', 'byanca' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'byanca' ),
								'cube'                  => esc_html__( 'Cube', 'byanca' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'byanca' ),
								'stripes'               => esc_html__( 'Stripes', 'byanca' ),
								'wave'                  => esc_html__( 'Wave', 'byanca' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'byanca' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'byanca' ),
								'atom'                  => esc_html__( 'Atom', 'byanca' ),
								'clock'                 => esc_html__( 'Clock', 'byanca' ),
								'mitosis'               => esc_html__( 'Mitosis', 'byanca' ),
								'lines'                 => esc_html__( 'Lines', 'byanca' ),
								'fussion'               => esc_html__( 'Fussion', 'byanca' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'byanca' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'byanca' )
							)
						)
					);

					byanca_select_create_meta_box_field(
					    array(
					        'type'          => 'textsimple',
					        'name'          => 'qodef_loading_title_text_meta',
					        'default_value' => esc_html__('', 'byanca'),
					        'label'         => esc_html__('Loading Title Text', 'byanca'),
					        'parent'        => $row_pt_spinner_animation_meta,
					        'dependency' => array(
					        	'show' => array(
					        		'qodef_smooth_pt_spinner_type_meta' => 'loading_title'
				        		)
				        	)
					    )
					);
					
					byanca_select_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'qodef_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'byanca' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					byanca_select_create_meta_box_field(
						array(
							'name'        => 'qodef_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'byanca' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'byanca' ),
							'options'     => byanca_select_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		byanca_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'byanca' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'byanca' ),
				'parent'      => $general_meta_box,
				'options'     => byanca_select_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_select_map_general_meta', 10 );
}

if ( ! function_exists( 'byanca_select_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function byanca_select_container_background_style( $style ) {
		$page_id      = byanca_select_get_page_id();
		$class_prefix = byanca_select_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .qodef-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'qodef_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'qodef_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'qodef_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = byanca_select_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'byanca_select_filter_add_page_custom_style', 'byanca_select_container_background_style' );
}