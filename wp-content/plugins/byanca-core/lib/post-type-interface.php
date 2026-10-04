<?php

namespace ByancaCore\Lib;

/**
 * interface PostTypeInterface
 * @package ByancaCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}