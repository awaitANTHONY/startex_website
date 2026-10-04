<?php
namespace ByancaCore\CPT\Shortcodes\ImageCarousel;

use ByancaCore\Lib;

class ImageCarousel implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'qodef_image_carousel';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
		    		'name'                      => esc_html__( 'Image Carousel', 'byanca-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by BYANCA', 'byanca-core' ),
				    'icon'                      => 'icon-wpb-image-carousel extended-custom-icon',
				    'as_parent'                 => array( 'only' => 'qodef_image' ),
				    'js_view'                   => 'VcColumnView',
					'params'                    => array(
					    array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'byanca-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'byanca-core' )
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'number_of_visible_items',
						    'heading'     => esc_html__( 'Number of Visible Items', 'byanca-core' ),
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
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__( 'Space Between Items', 'byanca-core' ),
                            'value'       => array_flip( byanca_select_get_space_between_items_array() ),
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
							'type'        => 'textfield',
							'param_name'  => 'carousel_stage_padding',
							'heading'     => esc_html__( 'Stage Padding (%)', 'byanca-core' ),
							'description' => esc_html__( 'Input the percentage value for the visible preview part for the sliders located to the left and right of the currently highlighted slide.', 'byanca-core' )
						),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'slider_navigation',
						    'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'byanca-core' ),
						    'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'slider_pagination',
						    'heading'     => esc_html__( 'Enable Slider Pagination', 'byanca-core' ),
						    'value'       => array_flip( byanca_select_get_yes_no_select_array( false, true ) ),
						    'save_always' => true
					    )
				    )
			    )
		    );
	    }
    }
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'number_of_visible_items' => '3',
			'space_between_items'     => 'normal',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'carousel_stage_padding'  => '0',
			'slider_navigation'       => 'yes',
			'slider_pagination'       => 'yes'
		);
		$params = shortcode_atts( $args, $atts );

		$params['carousel_stage_padding'] = $this->parseStagePadding( $params, $args );

		$holder_classes = $this->getHolderClasses( $params, $args );
		$slider_data    = $this->getSliderData( $params );

		$html = '<div class="qodef-image-carousel-holder ' . esc_attr( $holder_classes ) . '">';
			$html .= '<div class="qodef-ic-inner qodef-owl-slider" ' . byanca_select_get_inline_attrs( $slider_data ) . '>';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $holderClasses );
	}

	public function parseStagePadding( $params, $args ) {
		$stage_padding = floatval($params['carousel_stage_padding']);

		if ($stage_padding < 0 || $stage_padding > 100) {
			$stage_padding = $args['carousel_stage_padding'];
		}

		return $stage_padding / 100;
	}

	private function getSliderData( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']             = $params['number_of_visible_items'] !== '' ? $params['number_of_visible_items'] : '3';
		$slider_data['data-enable-loop']                 = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']             = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']                = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation']      = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-slider-custom-padding']       = 'yes';
		$slider_data['data-slider-custom-padding-value'] = $params['carousel_stage_padding'];
		$slider_data['data-enable-navigation']           = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']           = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		
		return $slider_data;
	}
}