<?php

namespace Inc\Login;

if (!defined('ABSPATH')) {
	exit;
}
class LoginImage
{
	public function __construct()
	{
		add_action('login_head', array($this, 'custom_login_logo'));
		add_filter('login_headerurl', array($this, 'change_wp_login_url'));
		add_filter('login_headertext', array($this, 'change_wp_login_title'));
	}

	//cambia imagen del login
	public function custom_login_logo()
	{
		echo '<style type="text/css">h1 a { background: url(' . get_stylesheet_directory_uri() . '/images/logoblanco.svg) 50% 50% no-repeat !important;background-size: contain!important; }</style>';
	}

	//cambia el url a la pagina
	public function change_wp_login_url()
	{
		return home_url();
	}

	public function change_wp_login_title()
	{
		return get_option('blogname');
	}
}
