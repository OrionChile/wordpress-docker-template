<?php

namespace Inc\Enqueue;

use Inc\Enqueue\IsChild;
use Inc\Enqueue\Wpjscss;

if (!defined('ABSPATH')) {
	exit;
}

class Enqueue
{
	public function __construct()
	{
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));
		add_action('login_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));
	}
	public function enqueue_scripts()
	{
		// the built-in version of jQuery from WordPress
		wp_deregister_script('jquery');

		if (IsChild::IsChild()) {
			$dir2 = get_stylesheet_directory_uri() . '/dist/';
		} else {
			$dir2 = get_template_directory_uri() . '/dist/';
		}

		if (($_SERVER["SERVER_NAME"]) == "localhost") {
			wp_enqueue_script('scriptsDEV', $dir2 . 'main-bundle.js', array(), '1.2', true);
		} else {
			wp_enqueue_script('scripts', $dir2 . wpjscss::wpjscss('main')['js'], array(), '1.1', true);
		}

		if (($_SERVER["SERVER_NAME"]) == "localhost") {
			wp_enqueue_style('styleWP', $dir2 . '/main.css', array(), '1.0.0', false);
		} else {
			wp_enqueue_style('styleWP', $dir2 . wpjscss::wpjscss('main')['css'], array(), '1.0.0', false);
		}
	}


	public function admin_enqueue_scripts()
	{
		if (IsChild::IsChild()) {
			$dir2 = get_stylesheet_directory_uri() . '/dist/';
		} else {
			$dir2 = get_template_directory_uri() . '/dist/';
		}

		if (($_SERVER["SERVER_NAME"]) == "localhost") {
			wp_enqueue_script('scriptsDEV', $dir2 . 'admin-bundle.js', array(), '1.2', true);
		} else {
			wp_enqueue_script('scripts', $dir2 . wpjscss::wpjscss('admin')['js'], array(), '1.1', true);
		}

		if (($_SERVER["SERVER_NAME"]) == "localhost") {
			wp_enqueue_style('styleWP', $dir2 . '/admin.css', array(), '1.0.0', false);
		} else {
			wp_enqueue_style('styleWP', $dir2 . wpjscss::wpjscss('admin')['css'], array(), '1.0.0', false);
		}
	}
}
