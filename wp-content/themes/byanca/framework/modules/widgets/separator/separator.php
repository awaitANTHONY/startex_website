<?php

if(class_exists('ByancaSelectClassWidget')) {
	class ByancaSelectClassSeparatorWidget extends ByancaSelectClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_separator_widget',
				esc_html__('Byanca Separator Widget', 'byanca'),
				array('description' => esc_html__('Add a separator element to your widget areas', 'byanca'))
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
						'normal'     => esc_html__('Normal', 'byanca'),
						'full-width' => esc_html__('Full Width', 'byanca')
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'position',
					'title'   => esc_html__('Position', 'byanca'),
					'options' => array(
						'center' => esc_html__('Center', 'byanca'),
						'left'   => esc_html__('Left', 'byanca'),
						'right'  => esc_html__('Right', 'byanca')
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'border_style',
					'title'   => esc_html__('Style', 'byanca'),
					'options' => array(
						'solid'  => esc_html__('Solid', 'byanca'),
						'dashed' => esc_html__('Dashed', 'byanca'),
						'dotted' => esc_html__('Dotted', 'byanca')
					)
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__('Color', 'byanca')
				),
				array(
					'type'  => 'textfield',
					'name'  => 'width',
					'title' => esc_html__('Width (px or %)', 'byanca')
				),
				array(
					'type'  => 'textfield',
					'name'  => 'thickness',
					'title' => esc_html__('Thickness (px)', 'byanca')
				),
				array(
					'type'  => 'textfield',
					'name'  => 'top_margin',
					'title' => esc_html__('Top Margin (px or %)', 'byanca')
				),
				array(
					'type'  => 'textfield',
					'name'  => 'bottom_margin',
					'title' => esc_html__('Bottom Margin (px or %)', 'byanca')
				)
			);
		}
		
		public function widget($args, $instance) {
			if ( !is_array($instance) ) {
				$instance = array();
			}
			
			//prepare variables
			$params = '';
			
			//is instance empty?
			if ( is_array($instance) && count($instance) ) {
				//generate shortcode params
				foreach ( $instance as $key => $value ) {
					$params .= " $key='$value' ";
				}
			}
			
			echo '<div class="widget qodef-separator-widget">';
			echo do_shortcode("[qodef_separator $params]"); // XSS OK
			echo '</div>';
		}
	}
}