<?php 
namespace Inc\CustomTax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class TaxClientes  
{
    function __construct()
    {
        add_action( 'init', array($this, 'taxClientes'));      
    }

    public function taxClientes(){
        
        register_taxonomy( 
            'cliente_nombre',   //nombre de la taxonomia
            'clientes',  //nombre del custom type a colocar
            array(
                'label' => __('Nombre'), //nombre visible
                'hierarchical' => false, // si es como tag o categoria
                'show_ui' => true,
                'show_admin_column' => true
            )     
        );

        register_taxonomy( 
            'cliente_email',   //nombre de la taxonomia
            'clientes',  //nombre del custom type a colocar
            array(
                'label' => __('Email'), //nombre visible
                'hierarchical' => false, // si es como tag o categoria
                'show_ui' => true,
                'show_admin_column' => true
            )     
        );

        register_taxonomy( 
            'cliente_phone',   //nombre de la taxonomia
            'clientes',  //nombre del custom type a colocar
            array(
                'label' => __('Celular'), //nombre visible
                'hierarchical' => false, // si es como tag o categoria
                'show_ui' => true,
                'show_admin_column' => true
            )     
        );


        register_taxonomy( 
            'cliente_tipo',   //nombre de la taxonomia
            'clientes',  //nombre del custom type a colocar
            array(
                'label' => __('Tipo'), //nombre visible
                'hierarchical' => false, // si es como tag o categoria
                'show_ui' => true,
                'show_admin_column' => true
            )     
        );




     
    }
}

?>