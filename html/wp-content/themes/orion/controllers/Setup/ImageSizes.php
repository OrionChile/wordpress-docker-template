<?php
namespace Inc\Setup;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class ImageSizes
{
    public function __construct()
    {
        add_image_size('esc_curso', 1000, 200, true);
        add_image_size('mini', 200, 400, true);
        add_filter('image_size_new', array($this, 'tmh_addimage'));
    }

    public function tmh_addimage($sizes)
    {
        $addsizes = array(
            'esc_curso' => __('Imagen de cada curso'),
            'mini' => __('test'),

        );
        $newsizes = array_merge($sizes, $addsizes);
        return $newsizes;
    }
}
