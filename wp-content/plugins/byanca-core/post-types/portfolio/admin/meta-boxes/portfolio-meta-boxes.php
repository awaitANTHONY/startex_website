<?php

if ( ! function_exists( 'byanca_core_map_portfolio_meta' ) ) {
	function byanca_core_map_portfolio_meta() {
		global $byanca_select_global_Framework;
		
		$byanca_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$byanca_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$byanca_portfolio_images = new ByancaSelectClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'byanca-core' ), '', '', 'portfolio_images' );
		$byanca_select_global_Framework->qodeMetaBoxes->addMetaBox( 'portfolio_images', $byanca_portfolio_images );
		
		$byanca_portfolio_image_gallery = new ByancaSelectClassMultipleImages( 'qodef-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'byanca-core' ), esc_html__( 'Choose your portfolio images', 'byanca-core' ) );
		$byanca_portfolio_images->addChild( 'qodef-portfolio-image-gallery', $byanca_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$byanca_portfolio_images_videos = byanca_select_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'byanca-core' ),
				'name'  => 'qodef_portfolio_images_videos'
			)
		);
		byanca_select_add_repeater_field(
			array(
				'name'        => 'qodef_portfolio_single_upload',
				'parent'      => $byanca_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'byanca-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'byanca-core' ),
						'options' => array(
							'image' => esc_html__('Image','byanca-core'),
							'video' => esc_html__('Video','byanca-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'byanca-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'byanca-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'byanca-core'),
							'vimeo' => esc_html__('Vimeo', 'byanca-core'),
							'self' => esc_html__('Self Hosted', 'byanca-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'byanca-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'byanca-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'byanca-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$byanca_additional_sidebar_items = byanca_select_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'byanca-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		byanca_select_add_repeater_field(
			array(
				'name'        => 'qodef_portfolio_properties',
				'parent'      => $byanca_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'byanca-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'byanca-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'byanca-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'byanca-core' )
					)
				)
			)
		);
	}
	
	add_action( 'byanca_select_action_meta_boxes_map', 'byanca_core_map_portfolio_meta', 40 );
}