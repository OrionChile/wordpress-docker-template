<?php
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

if (class_exists('Inc\\init')) :
	new \Inc\init();
endif;
