<?php

if ( ! function_exists( 'byanca_select_like' ) ) {
	/**
	 * Returns ByancaSelectClassLike instance
	 *
	 * @return ByancaSelectClassLike
	 */
	function byanca_select_like() {
		return ByancaSelectClassLike::get_instance();
	}
}

function byanca_select_get_like() {
	
	echo wp_kses( byanca_select_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}