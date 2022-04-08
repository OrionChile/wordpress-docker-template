<?php 
namespace Inc\CustomPost;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class ClientesPost  
{
    function __construct()
    {
        add_action( 'init', array($this, 'clientespost'));      
    }

    public function clientespost(){

        register_post_type( 'clientes',
      array(
        'labels' => array(
          'name' => __( 'Clientes' ),
          'singular_name' => __( 'Cliente' )
        ),
        'public' => true,
        'has_archive' => true,
        'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessperson',
        'capability_type'       => 'page',
        'show_in_rest'          => false,
      )
    );
    }
}

?>
