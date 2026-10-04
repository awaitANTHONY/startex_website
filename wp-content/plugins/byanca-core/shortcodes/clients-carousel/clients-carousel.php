<?php
namespace ByancaCore\CPT\Shortcodes\ClientsCarousel;

use ByancaCore\Lib;

class ClientsCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_clients_carousel';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Clients Carousel', 'byanca-core' ),
					'base'            => $this->getBase(),
					'category'        => esc_html__( 'by BYANCA', 'byanca-core' ),
					'icon'            => 'icon-wpb-clients-carousel extended-custom-icon',
					'as_parent'       => array( 'only' => 'qodef_clients_carousel_item' ),
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'byanca-core' ),
							'value'       => array(
								esc_html__( 'One', 'byanca-core' )   => '1',
								esc_html__( 'Two', 'byanca-core' )   => '2',
								esc_html__( 'Three', 'byanca-core' ) => '3',
								esc_html__( 'Four', 'byanca-core' )  => '4',
								esc_html__( 'Five', 'byanca-core' )  => '5',
								esc_html__( 'Six', 'byanca-core' )   => '6'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'byanca-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'byanca-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'items_hover_animation',
							'heading'     => esc_html__( 'Items Hover Animation', 'byanca-core' ),
							'value'       => array(
								esc_html__( 'Switch Images', 'byanca-core' ) => 'switch-images',
								esc_html__( 'Roll Over', 'byanca-core' )     => 'roll-over'
							),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_1281_1366',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 1281px-1366px', 'byanca-core' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_1025_1280',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 1025px-1280px', 'byanca-core' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_769_1024',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 769px-1024px', 'byanca-core' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_681_768',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size between 681px-768px', 'byanca-core' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_visible_items_680',
							'heading'     => esc_html__( 'Number Of Visible Items on screen size bellow 680px', 'byanca-core' ),
							'group'       => esc_html__( 'Responsiveness', 'byanca-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'number_of_visible_items'           => '4',
			'slider_loop'                       => 'yes',
			'slider_autoplay'                   => 'yes',
			'slider_speed'                      => '5000',
			'slider_speed_animation'            => '600',
			'slider_navigation'                 => 'no',
			'slider_pagination'                 => 'no',
			'items_hover_animation'             => 'switch-images',
			'number_of_visible_items_1281_1366' => '',
			'number_of_visible_items_1025_1280' => '',
			'number_of_visible_items_769_1024'  => '',
			'number_of_visible_items_681_768'   => '',
			'number_of_visible_items_680'       => ''
		);
		
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['carousel_data']  = $this->getSliderData( $params );
		$params['content']        = $content;
		
		$html = byanca_core_get_shortcode_module_template_part( 'templates/clients-carousel', 'clients-carousel', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['items_hover_animation'] ) ? 'qodef-cc-hover-' . $params['items_hover_animation'] : 'qodef-cc-hover-switch-images';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = ! empty( $params['number_of_visible_items'] ) ? $params['number_of_visible_items'] : '4';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

		if ( $params['number_of_visible_items_1281_1366'] !== '' ) {
			$slider_data['data-number-of-items-1281-1366'] = $params['number_of_visible_items_1281_1366'];
		}

		if ( $params['number_of_visible_items_1025_1280'] !== '' ) {
			$slider_data['data-number-of-items-1025-1280'] = $params['number_of_visible_items_1025_1280'];
		}

		if ( $params['number_of_visible_items_769_1024'] !== '' ) {
			$slider_data['data-number-of-items-769-1024'] = $params['number_of_visible_items_769_1024'];
		}

		if ( $params['number_of_visible_items_681_768'] !== '' ) {
			$slider_data['data-number-of-items-681-768'] = $params['number_of_visible_items_681_768'];
		}

		if ( $params['number_of_visible_items_680'] !== '' ) {
			$slider_data['data-number-of-items-680'] = $params['number_of_visible_items_680'];
		}
		
		return $slider_data;
	}
}