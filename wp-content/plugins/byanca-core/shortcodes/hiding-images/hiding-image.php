<?php
namespace ByancaCore\CPT\Shortcodes\HidingImage;

use ByancaCore\Lib;

class HidingImage implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'qodef_hiding_image';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(array(
	            'name'                    => esc_html__('Hiding Image', 'byanca-core'),
	            'base'                    => $this->getBase(),
	            'as_child'                => array('only' => 'qodef_hiding_images'),
	            'category'                => esc_html__('by BYANCA', 'byanca-core'),
	            'icon'                    => 'icon-wpb-hiding-image extended-custom-icon',
	            'params'                  => array(
	                array(
	                    'type'        => 'attach_image',
	                    'admin_label' => true,
	                    'heading'     => esc_html__('Additional Image. Up to 6 supported.', 'byanca-core'),
	                    'param_name'  => 'image',
	                    'description' => ''
	                ),
	                array(
	                    'heading'     => esc_html__('Link', 'byanca-core'),
	                    'type'        => 'textfield',
	                    'param_name'  => 'other_link',
	                    'admin_label' => true
	                ),
	                array(
	                    'type'       => 'dropdown',
	                    'heading'    => esc_html__('Target', 'byanca-core'),
	                    'param_name' => 'other_target',
	                    'value'      => array(
	                        ''                           => '',
	                        esc_html__('Same Window', 'byanca-core')  => '_self',
	                        esc_html__('New Window', 'byanca-core') => '_blank'
	                    ),
	                    'dependency' => array('element' => 'other_link', 'not_empty' => true),
	                ),
	                array(
						'type'        => 'dropdown',
						'param_name'  => 'enable_image_shadow',
						'heading'     => esc_html__( 'Enable Image Shadow', 'byanca-core' ),
						'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
						'save_always' => true
					)
	            )
	        ));
		}
	}

	public function render($atts, $content = null) {

        $default_atts = array(
	        'image'               => '',
	        'other_link'          => '',
	        'other_target'        => '',
	        'enable_image_shadow' => 'no'
        );
        $params = shortcode_atts($default_atts, $atts);

        $params['image_classes'] = $this->getImageClasses( $params );

        return byanca_core_get_shortcode_module_template_part('templates/hiding-image', 'hiding-images', '', $params);
    }

    private function getImageClasses( $params ) {
		$imageClasses = array();

		$imageClasses[] = $params['enable_image_shadow'] === 'yes' ? 'qodef-has-shadow' : '';

		return implode( ' ', $imageClasses );
	}
}