<?php

if(class_exists('ByancaSelectClassWidget')) {
	class ByancaSelectClassButtonWidget extends ByancaSelectClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_button_widget',
				esc_html__('Byanca Button Widget', 'byanca'),
				array('description' => esc_html__('Add button element to widget areas', 'byanca'))
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__('Type', 'byanca'),
					'options' => array(
						'solid'   => esc_html__('Solid', 'byanca'),
						'outline' => esc_html__('Outline', 'byanca'),
						'simple'  => esc_html__('Simple', 'byanca')
					)
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__('Size', 'byanca'),
					'options'     => array(
						'small'  => esc_html__('Small', 'byanca'),
						'medium' => esc_html__('Medium', 'byanca'),
						'large'  => esc_html__('Large', 'byanca'),
						'huge'   => esc_html__('Huge', 'byanca')
					),
					'description' => esc_html__('This option is only available for solid and outline button type', 'byanca')
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__('Text', 'byanca'),
					'default' => esc_html__('Button Text', 'byanca')
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__('Link', 'byanca')
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__('Link Target', 'byanca'),
					'options' => byanca_select_get_link_target_array()
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__('Color', 'byanca')
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'hover_color',
					'title' => esc_html__('Hover Color', 'byanca')
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'background_color',
					'title'       => esc_html__('Background Color', 'byanca'),
					'description' => esc_html__('This option is only available for solid button type', 'byanca')
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_background_color',
					'title'       => esc_html__('Hover Background Color', 'byanca'),
					'description' => esc_html__('This option is only available for solid button type', 'byanca')
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'border_color',
					'title'       => esc_html__('Border Color', 'byanca'),
					'description' => esc_html__('This option is only available for solid and outline button type', 'byanca')
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_border_color',
					'title'       => esc_html__('Hover Border Color', 'byanca'),
					'description' => esc_html__('This option is only available for solid and outline button type', 'byanca')
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__('Margin', 'byanca'),
					'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'byanca')
				)
			);
		}
		
		public function widget($args, $instance) {
			$params = '';
			
			if ( !is_array($instance) ) {
				$instance = array();
			}
			
			// Filter out all empty params
			$instance = array_filter($instance, function($array_value) {
				return trim($array_value) != '';
			});
			
			// Default values
			if ( !isset($instance['text']) ) {
				$instance['text'] = 'Button Text';
			}
			
			// Generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
			
			echo '<div class="widget qodef-button-widget">';
			echo do_shortcode("[qodef_button $params]"); // XSS OK
			echo '</div>';
		}
	}
}