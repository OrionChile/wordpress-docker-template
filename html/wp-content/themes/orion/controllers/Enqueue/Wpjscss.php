<?php
/**
 * @package dekaz startertheme
 */

namespace Inc\Enqueue;

use Inc\enqueue\IsChild;
use Inc\enqueue\Listdir_by_date;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Wpjscss
{

    public static function Wpjscss($prefix)
    {

        if (IsChild::IsChild()) {
            $dir = get_stylesheet_directory() . '/dist/';
        } else {
            $dir = get_template_directory() . '/dist/';
        }

        if ($prefix == 'main') {
            $filecss = 'main*.css';
            $filejs = 'main*.js';
        }

        if ($prefix == 'acfadmin') {
            $filecss = 'acfadmin*.css';
            $filejs = 'acfadmin*.js';
        }

        if ($prefix == 'admin') {
            $filecss = 'admin*.css';
            $filejs = 'admin*.js';
        }

        $cssfinal = ListdirByDate::dirdate($dir . $filecss);
        $jsfinal = ListdirByDate::dirdate($dir . $filejs);
        return array('css' => $cssfinal, 'js' => $jsfinal);
    }
}
