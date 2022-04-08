<?php

namespace Inc\Lang;

class Lang
{
	public static function langField(string $input)
	{
		pll_current_language() == 'es' ? $en = '' : $en = 'en';
		return $input . $en;
	}
}
