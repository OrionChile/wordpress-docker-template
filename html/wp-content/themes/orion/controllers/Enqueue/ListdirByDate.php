<?php

namespace Inc\Enqueue;

if (!defined('ABSPATH')) {
	exit;
}
class ListdirByDate
{

	public static function dirdate($pathtosearch)
	{
		$file_array = [];
		foreach (glob($pathtosearch) as $filename) {
			$file_array[filectime($filename)] = basename($filename);
		}
		ksort($file_array);
		$ultimo = '';

		foreach ($file_array as $key => $value) {
			$ultimo = $value;
		}
		return $ultimo;
	}
}
