<?php
namespace ByancaCore\CPT\Shortcodes\PricingTable;

use ByancaCore\Lib;

class PricingTableItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_pricing_table_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Pricing Table Item', 'byanca-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-pricing-table-item extended-custom-icon',
					'category'                  => esc_html__( 'by BYANCA', 'byanca-core' ),
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'qodef_pricing_table' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'byanca-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'byanca-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'set_active_item',
							'heading'     => esc_html__( 'Set Item As Active', 'byanca-core' ),
							'value'       => array_flip( byanca_select_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'active_item_label',
							'heading'    => esc_html__( 'Set Active Item Label', 'byanca-core' ),
							'dependency' => array( 'element' => 'set_active_item', 'value' => 'yes' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'content_padding',
							'heading'     => esc_html__( 'Content Padding', 'byanca-core' ),
							'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'byanca-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'content_background_color',
							'heading'    => esc_html__( 'Content Background Color', 'byanca-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'byanca-core' ),
							'description' => esc_html__( 'Select image from media library', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'byanca-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'byanca-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'byanca-core' ),
							'value'       => esc_html__( 'Basic Plan', 'byanca-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'byanca-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'price',
							'heading'    => esc_html__( 'Price', 'byanca-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'price_color',
							'heading'    => esc_html__( 'Price Color', 'byanca-core' ),
							'dependency' => array( 'element' => 'price', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'currency',
							'heading'     => esc_html__( 'Currency', 'byanca-core' ),
							'description' => esc_html__( 'Default mark is $', 'byanca-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'currency_color',
							'heading'    => esc_html__( 'Currency Color', 'byanca-core' ),
							'dependency' => array( 'element' => 'currency', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'price_period',
							'heading'     => esc_html__( 'Price Period', 'byanca-core' ),
							'description' => esc_html__( 'Default label is Monthly', 'byanca-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'price_period_color',
							'heading'    => esc_html__( 'Price Period Color', 'byanca-core' ),
							'dependency' => array( 'element' => 'price_period', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'byanca-core' ),
							'value'       => esc_html__( 'BUY NOW', 'byanca-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Button Link', 'byanca-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_type',
							'heading'     => esc_html__( 'Button Type', 'byanca-core' ),
							'value'       => array(
								esc_html__( 'Solid', 'byanca-core' )   => 'solid',
								esc_html__( 'Outline', 'byanca-core' ) => 'outline'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'button_text', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea_html',
							'param_name' => 'content',
							'heading'    => esc_html__( 'Content', 'byanca-core' ),
							'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'             => '',
			'set_active_item'          => 'no',
			'active_item_label'        => '',
			'content_padding'          => '',
			'content_background_color' => '',
			'image'                    => '',
			'image_size'               => 'full',
			'title'                    => '',
			'title_color'              => '',
			'price'                    => '100',
			'price_color'              => '',
			'currency'                 => '$',
			'currency_color'           => '',
			'price_period'             => 'Monthly',
			'price_period_color'       => '',
			'button_text'              => '',
			'link'                     => '',
			'button_type'              => 'outline'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']             = preg_replace( '#^<\/p>|<p>$#', '', $content ); // delete p tag before and after content
		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['holder_styles']       = $this->getHolderStyles( $params );
		$params['image']               = $this->getImage( $params );
		$params['image_size']          = $this->getImageSize( $params['image_size'] );
		$params['title_styles']        = $this->getTitleStyles( $params );
		$params['price_styles']        = $this->getPriceStyles( $params );
		$params['currency_styles']     = $this->getCurrencyStyles( $params );
		$params['price_period_styles'] = $this->getPricePeriodStyles( $params );
		$params['button_type']         = ! empty( $params['button_type'] ) ? $params['button_type'] : $args['button_type'];
		
		$html = byanca_core_get_shortcode_module_template_part( 'templates/pricing-table-template', 'pricing-table', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['set_active_item'] === 'yes' ? 'qodef-pt-active-item' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['content_background_color'] ) ) {
			$itemStyle[] = 'background-color: ' . $params['content_background_color'];
		}

		if ( $params['content_padding'] !== '' ) {
			$itemStyle[] = 'padding: ' . $params['content_padding'];
		}
		
		return implode( ';', $itemStyle );
	}

	private function getImage( $params ) {
		$image = array();

		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];

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
		$itemStyle = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getPriceStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['price_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getCurrencyStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['currency_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['currency_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getPricePeriodStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['price_period_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_period_color'];
		}
		
		return implode( ';', $itemStyle );
	}
}