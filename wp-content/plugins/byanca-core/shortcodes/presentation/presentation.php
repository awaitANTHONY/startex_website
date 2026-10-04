<?php
namespace ByancaCore\CPT\Shortcodes\Presentation;

use ByancaCore\Lib;

class Presentation implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_presentation';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Presentation', 'byanca-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by BYANCA', 'byanca-core' ),
					'icon'                      => 'icon-wpb-presentation extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'byanca-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'byanca-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title', 'byanca-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'byanca-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title', 'byanca-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title Top Margin (px)', 'byanca-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'show_separator',
							'heading'     => esc_html__( 'Show Separator', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'byanca-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'byanca-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text', 'byanca-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_top_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'byanca-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text', 'byanca-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_1',
							'heading'     => esc_html__( 'Primary Image', 'byanca-core' ),
							'description' => esc_html__( 'Select image from media library', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size_1',
							'heading'     => esc_html__( 'Primary Image Size', 'byanca-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'byanca-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_2',
							'heading'     => esc_html__( 'Secondary Image', 'byanca-core' ),
							'description' => esc_html__( 'Select image from media library', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size_2',
							'heading'     => esc_html__( 'Secondary Image Size', 'byanca-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'show_button',
							'heading'     => esc_html__( 'Show Button', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'admin_label' => true,
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_type',
							'heading'     => esc_html__( 'Type', 'byanca-core' ),
							'value'       => array(
								esc_html__( 'Default', 'byanca-core' ) => '',
								esc_html__( 'Solid', 'byanca-core' )   => 'solid',
								esc_html__( 'Outline', 'byanca-core' ) => 'outline',
								esc_html__( 'Simple', 'byanca-core' )  => 'simple'
							),
							'dependency'  => array( 'element' => 'show_button', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Button', 'byanca-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_size',
							'heading'    => esc_html__( 'Size', 'byanca-core' ),
							'value'      => array(
								esc_html__( 'Default', 'byanca-core' ) => '',
								esc_html__( 'Small', 'byanca-core' )   => 'small',
								esc_html__( 'Medium', 'byanca-core' )  => 'medium',
								esc_html__( 'Large', 'byanca-core' )   => 'large',
								esc_html__( 'Huge', 'byanca-core' )    => 'huge'
							),
							'dependency' => array( 'element' => 'show_button', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Button', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Text', 'byanca-core' ),
							'value'       => esc_html__( 'Button Text', 'byanca-core' ),
							'save_always' => true,
							'admin_label' => true,
							'dependency'  => array( 'element' => 'show_button', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Button', 'byanca-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Link', 'byanca-core' ),
							'dependency' => array( 'element' => 'show_button', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Button', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_target',
							'heading'     => esc_html__( 'Link Target', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_link_target_array() ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'show_button', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Button', 'byanca-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_top_margin',
							'heading'    => esc_html__( 'Button Top Margin (px)', 'byanca-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Button', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name' => 'additional_effect',
							'heading'    => esc_html__( 'Additional Effect', 'byanca-core' ),
							'value'      => array(
								esc_html__( 'None', 'byanca-core' )  => '',
								esc_html__( 'Parallax Effect', 'byanca-core' ) => 'parallax-effect',
							),
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'      => '',
			'title'             => '',
			'title_tag'         => 'h2',
			'title_color'       => '',
			'title_top_margin'  => '',
			'show_separator'    => false,
			'text'              => '',
			'text_color'        => '',
			'text_top_margin'   => '',
			'image_1'           => '',
			'image_size_1'      => 'full',
			'image_2'           => '',
			'image_size_2'      => 'full',
			'show_button'       => true,
			'button_type'       => 'outline',
			'button_size'       => 'small',
			'button_text'       => '',
			'button_link'       => '',
			'button_target'     => '_self',
			'button_top_margin' => '',
			'additional_effect' => ''
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );

		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['text_styles']    = $this->getTextStyles( $params );

		$params['show_separator'] = ! empty( $params['show_separator'] ) ? $params['show_separator'] : $args['show_separator'];

		$params['image_1']        = $this->getImage( $params['image_1'] );
		$params['image_size_1']   = $this->getImageSize( $params['image_size_1'] );
		$params['image_2']        = $this->getImage( $params['image_2'] );
		$params['image_size_2']   = $this->getImageSize( $params['image_size_2'] );

		$params['show_button']    = ! empty( $params['show_button'] ) ? $params['show_button'] : $args['show_button'];

		$params['button_type']    = ! empty( $params['button_type'] ) ? $params['button_type'] : $args['button_type'];
		$params['button_size']    = ! empty( $params['button_size'] ) ? $params['button_size'] : $args['button_size'];
		$params['button_target']  = ! empty( $params['button_target'] ) ? $params['button_target'] : $args['button_target'];
		$params['button_styles']  = $this->getButtonStyles( $params );
		$params['parallax_data_1'] = $this->getParallaxData1($params);
        $params['parallax_data_2'] = $this->getParallaxData2($params);
        $params['parallax_data_3'] = $this->getParallaxData2($params);
		
		$html = byanca_core_get_shortcode_module_template_part( 'templates/presentation', 'presentation', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getImage( $image_input ) {
		$image = array();
		
		if ( ! empty( $image_input ) ) {
			$id = $image_input;
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}
		
		return $image;
	}
	
	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . byanca_select_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . byanca_select_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

	private function getbuttonStyles( $params ) {
		$styles = array();

		if ( $params['button_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . byanca_select_filter_px( $params['button_top_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	public function getParallaxData1 ( $params ) {
		$parallaxData = array();

		if ($params['additional_effect'] === 'parallax-effect') {
		    $y_absolute = rand(-80, -100);
		    $smoothness = 20; //1 is for linear, non-animated parallax

		    $parallaxData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
		}

		return $parallaxData;
    }
    
    public function getParallaxData2( $params ) {
		$parallaxData = array();

		if ($params['additional_effect'] === 'parallax-effect') {
		    $y_absolute = rand(-130, -160);
		    $smoothness = 20; //1 is for linear, non-animated parallax

		    $parallaxData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
		}

		return $parallaxData;
	}

	
	public function getParallaxData3 ( $params ) {
		$parallaxData = array();

		if ($params['additional_effect'] === 'parallax-effect') {
		    $y_absolute = rand(-20, -40);
		    $smoothness = 20; //1 is for linear, non-animated parallax

		    $parallaxData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
		}

		return $parallaxData;
    }
}