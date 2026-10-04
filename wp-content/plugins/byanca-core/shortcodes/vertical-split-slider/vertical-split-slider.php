<?php
namespace ByancaCore\CPT\Shortcodes\VerticalSplitSlider;

use ByancaCore\Lib;

class VerticalSplitSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_vertical_split_slider';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Vertical Split Slider', 'byanca-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-vertical-split-slider extended-custom-icon',
					'category'  => esc_html__( 'by BYANCA', 'byanca-core' ),
					'as_parent' => array( 'only' => 'qodef_vertical_split_slider_left_panel, qodef_vertical_split_slider_right_panel' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_scrolling_animation',
							'heading'    => esc_html__( 'Enable Scrolling Animation', 'byanca-core' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_numeric_navigation',
							'heading'    => esc_html__( 'Enable Numeric Navigation', 'byanca-core' ),
							'value'      => array_flip( byanca_select_get_yes_no_select_array( false ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'enable_scrolling_animation' => 'no',
			'enable_numeric_navigation'  => 'no'
		);
		$params = shortcode_atts( $args, $atts );

		$holder_classes = $this->getHolderClasses( $params );
		$holder_data    = $this->getHolderData( $params, $args );

		$html = '<div class="qodef-vertical-split-slider ' . esc_attr( $holder_classes ) . '" ' . byanca_select_get_inline_attrs( $holder_data ) . '>';
			$html .= do_shortcode( $content );
			$html .= '<div class="qodef-vss-horizontal-mask"></div>';
			$html .= '<div class="qodef-vss-vertical-mask"></div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_scrolling_animation'] === 'yes' ? 'qodef-vss-scrolling-animation' : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderData( $params, $args ) {
		$holder_data = array();

		$holder_data['data-enable-numeric-navigation'] = ! empty( $params['enable_numeric_navigation'] ) ? $params['enable_numeric_navigation'] : $args['enable_numeric_navigation'];

		return $holder_data;
	}
}
