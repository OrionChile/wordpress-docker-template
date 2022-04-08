<?php

namespace Inc\Setup;

if (!defined('ABSPATH')) {
	exit;
}
class Menu
{
	public function __construct()
	{
		add_action('init', array(&$this, 'menus'));
	}

	public function menus()
	{

		//Registrar menus
		register_nav_menus(array(
			'header-menu' => __('Header Menu', 'orion'),
			'footer-menu' => __('Footer Menu', 'orion'),
		));
	}
}
