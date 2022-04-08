<?php
namespace Inc\Setup;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class RemoveGutenberg
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_dequeue_style('wp-block-library');
        });
    }
}
