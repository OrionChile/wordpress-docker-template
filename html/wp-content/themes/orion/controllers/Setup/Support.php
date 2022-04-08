<?php
namespace Inc\Setup;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Support
{
    public function __construct()
    {
        add_theme_support( 'post-thumbnails' );
        add_filter( 'show_admin_bar' , array($this,'my_function_admin_bar'));
        //quita la barra de administracion
        add_action('get_header', array($this,'remove_admin_login_header'));

    }

    public function remove_admin_login_header(){
        remove_action('wp_head', '_admin_bar_bump_cb');
    }

    public function my_function_admin_bar(){ return false; }
}
