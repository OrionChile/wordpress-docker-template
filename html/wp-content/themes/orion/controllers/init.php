<?php

namespace Inc;

use Inc\Enqueue\Enqueue;
use Inc\Setup\Setup;
use Inc\CustomPost\CustomPost;
use Inc\CustomTax\CustomTax;
use Inc\Acf\Acf;
use Inc\Email\Email;
use Inc\Login\Login;
use Inc\Woocommerce\Woocommerce;

if (!defined('ABSPATH')) {
	exit;
}
class init
{
	private static $loaded = false;
	public function __construct()
	{

		$this->initClasses();
	}

	public function initClasses()
	{
		if (self::$loaded) {
			return;
		}
		self::$loaded = true;
		new Setup();
		new Enqueue();
		new CustomPost();
		new CustomTax();
		new Acf();
		new Login();
	}
}
