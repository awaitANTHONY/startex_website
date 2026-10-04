<?php
namespace ByancaCore\CPT\Shortcodes\InteractiveLinkShowcase;

use ByancaCore\Lib;

class InteractiveLinkShowcase implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_interactive_link_showcase';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Interactive Link Showcase', 'byanca-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by BYANCA', 'byanca-core' ),
					'icon'     => 'icon-wpb-interactive-link-showcase extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'byanca-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'byanca-core' )    => 'standard',
								esc_html__( 'Full Screen', 'byanca-core' ) => 'fullscreen'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Link Skin', 'byanca-core' ),
							'value'       => array(
								esc_html__( 'Default', 'byanca-core' ) => '',
								esc_html__( 'Light', 'byanca-core' )   => 'light'
							),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'link_target',
							'heading'     => esc_html__( 'Link Target', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_link_target_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'link_items',
							'heading'    => esc_html__( 'Link Items', 'byanca-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'title',
									'heading'    => esc_html__( 'Title', 'byanca-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'link',
									'heading'    => esc_html__( 'Link', 'byanca-core' )
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Image', 'byanca-core' ),
									'description' => esc_html__( 'Select image from media library', 'byanca-core' )
								)
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name' => 'additional_effect',
							'heading'    => esc_html__( 'Additional Effect', 'byanca-core' ),
							'value'      => array(
								esc_html__( 'None', 'byanca-core' )  => '',
								esc_html__( 'Loading Effect', 'byanca-core' ) => 'loading-effect',
							),
							'dependency' => array('element' => 'type', 'value' => array('standard'))
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'             => '',
			'skin'             => '',
			'background_color' => '',
			'link_target'      => '_self',
			'link_items'       => '',
			'additional_effect' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']      = $this->getHolderClasses( $params, $args );
		$params['image_holder_styles'] = $this->getImageHolderStyles( $params );
		$params['link_items']          = json_decode( urldecode( $params['link_items'] ), true );
		$params['link_target']         = ! empty( $params['link_target'] ) ? $params['link_target'] : $args['link_target'];
		
		$html = byanca_core_get_shortcode_module_template_part( 'templates/interactive-link-showcase', 'interactive-link-showcase', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-ils-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? 'qodef-ils-skin-' . $params['skin'] : '';
		$holderClasses[] = ($params['additional_effect'] == 'loading-effect') ? 'qodef-ils--loading-fx' : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getImageHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
}