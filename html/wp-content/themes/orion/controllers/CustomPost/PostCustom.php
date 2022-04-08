<?php 
namespace Inc\CustomPost;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class PostCustom  
{
    function __construct()
    {
        add_action( 'init', array($this, 'postcustom'));      
    }

    public function postcustom(){

        register_post_type( 'custompost',
      array(
        'labels' => array(
          'name' => __( 'Customs' ),
          'singular_name' => __( 'custom' )
        ),
        'public' => true,
        'has_archive' => true,
        'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
        'menu_icon'             => 'dashicons-flag',
        'capability_type'       => 'page',
        'show_in_rest'          => false,
      )
    );
    }
}

?>
