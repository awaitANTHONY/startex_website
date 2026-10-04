<?php
namespace ByancaCore\CPT\Shortcodes\Tabs;

use ByancaCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_tabs';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Tabs', 'byanca-core' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'qodef_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by BYANCA', 'byanca-core' ),
					'icon'            => 'icon-wpb-tabs extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'byanca-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'byanca-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'byanca-core' ) => 'standard',
								esc_html__( 'Simple', 'byanca-core' )   => 'simple',
								esc_html__( 'Vertical', 'byanca-core' ) => 'vertical'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'top_offset',
							'heading'    => esc_html__( 'Top Menu Offset (px)', 'byanca-core' ),
							'dependency' => array( 'element' => 'type', 'value' => 'vertical' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
			'type'         => 'standard',
			'top_offset'   => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		// Extract tab titles
		preg_match_all( '/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		
		/**
		 * get tab titles array
		 */
		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach ( $tab_titles as $tab ) {
			preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
			$tab_title_array[] = $tab_matches[1][0];
		}

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['items_styles']   = $this->getItemsStyles( $params );
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = byanca_core_get_shortcode_module_template_part( 'templates/tab-template', 'tabs', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-tabs-' . esc_attr( $params['type'] ) : 'qodef-tabs-standard';
		
		return implode( ' ', $holderClasses );
	}

	private function getItemsStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['top_offset'] ) ) {
			$styles[] = 'top: ' . byanca_select_filter_px( $params['top_offset'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}