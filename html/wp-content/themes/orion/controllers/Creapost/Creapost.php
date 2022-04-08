<?php

namespace Inc\Creapost;

use WP_Query;
use Bcrypt\Bcrypt;
use Inc\Setup\Setup;
use Inc\Formulas\Fecha;

if (!defined('ABSPATH')) {
    exit;
}


class Creapost
{
    private static $loaded = false;
    // public function __construct() 
    // {
    //     $this->customtax();
    // }
    private function TimeStamp()
    {
        $timeStamp = $minuteCounter = 0;  // set all timers to 0;
        $iCounter = 1; // number use to multiply by minute increment;
        $minuteIncrement = 1; // increment which to increase each post time for future schedule
        $adjustClockMinutes = 0; // add 1 hour or 60 minutes - daylight savings

        // CALCULATIONS
        $minuteCounter = $iCounter * $minuteIncrement; // setting how far out in time to post if future.
        $minuteCounter = $minuteCounter + $adjustClockMinutes; // adjusting for server timezone
        $timeStamp = date('Y-m-d H:i:s', strtotime("+$minuteCounter min")); // format needed for WordPress
        $timeStamp = current_time('Y-m-d H:i:s');
        return $timeStamp;
    }
    private function ClienteExiste($titulonuevo, $emailnuevo)
    {
        $postcolegio = [];
        $args = array(
            'post_type' => 'clientes',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $current_id = get_the_id();
                $titulo = get_the_title($current_id);
                $email = strip_tags(get_the_term_list($current_id, 'email'));
                if ($titulo === $titulonuevo && $email === $emailnuevo) return get_the_id();
            endwhile;
            wp_reset_query();
        endif;
        return false;
    }

    private function BuscaPedido($numpedido)
    {
        $args = array(
            'post_type' => 'pedidos',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $current_id = get_the_id();
                $titulo = get_the_title($current_id);
                if ($titulo === $numpedido) return get_the_id();
            endwhile;
            wp_reset_query();
        endif;
        return false;
    }


    public function CreaClientes(
        $titulo, 
        $email, 
        $tel, 
        $tipo,
        $asunto,
        $apellido = '',
        $whatsapp = false,
        $direccion = '',
        $depto = '',
        $comuna = ''
        )
    {
        //revisa si existe
        $existecliente = $this->ClienteExiste($titulo, $email);
        if ($tipo == 'lead')  $cuenta = 'contactos';
        else $cuenta = 'compras';
        if (!$existecliente) {
            $postStatus = 'publish';
            $userID = 1;
            $new_post = array(
                'post_title' => $titulo,
                // 'post_content' => $leadContent,
                'post_status' => $postStatus,
                'post_date' => $this->TimeStamp(),
                'post_author' => $userID,
                'post_type' => 'clientes',
                // 'post_category' => array($categoryID)
            );
            $post_id = wp_insert_post($new_post);
            wp_set_object_terms($post_id, '1', $cuenta, false);
        } else {
            $post_id = $existecliente;
            $cuentaval =  strip_tags(get_the_term_list($post_id, $cuenta));
            $cuentaval = intval($cuentaval) + 1;
            wp_set_object_terms($post_id, strval($cuentaval), $cuenta, false);
        }
        wp_set_object_terms($post_id, $email, 'email', false);
        wp_set_object_terms($post_id, $tel, 'telefono', false);
        wp_set_object_terms($post_id, $tipo, 'tipo', false);
      
        update_field('nombres', $titulo, $post_id);
        update_field('email', $email, $post_id);
        update_field('telefono', $tel, $post_id);

        $content = '<br>';
        $content .= '----------------------------------------------------';
        $content .= '<br>';
        $content .= '<strong>'.Fecha::Fecha().'</strong>';
        $content .= '<br>';
        $content .= $asunto;
        $content .= '<br>';
        $content .= '----------------------------------------------------';
        $content .= '<br>';

        $contentotal = $content.get_field('asunto', $post_id);

        update_field('asunto', $contentotal, $post_id);
        // update_field('whatsapp', $whatsapp, $post_id);
        // update_field('direccion', $direccion, $post_id);
        // update_field('depto', $depto, $post_id);
        // update_field('comuna', $comuna, $post_id);
    
        return $post_id;
    }

    private function numpedidos(){
        if(get_option( 'pedidos') == '') {
            add_option('pedidos','1');
            return '1';
        }
        $actual = get_option( 'pedidos');
        $actual = intval($actual) + 1;
        update_option('pedidos',$actual);
        return $actual;
    }

    private function buscaSedePorSlug($slugbusca){
        
        if ($post = get_page_by_path($slugbusca, OBJECT, 'sede')) return $post->ID;
        else return false;
    }

    public function CreaPedido($name, $email, $phone, $product, $sede, $estado)
    {
            $idsede = $this->buscaSedePorSlug($sede);
            $numpedidos = $this->numpedidos();

            $postStatus = 'publish';
            $userID = 1;
            $new_post = array(
                'post_title' => get_field('prefijo_orden',$idsede).'_'.$numpedidos,
                // 'post_content' => $leadContent,
                'post_status' => $postStatus,
                'post_date' => $this->TimeStamp(),
                'post_author' => $userID,
                'post_type' => 'pedidos',
                // 'post_category' => array($categoryID)
            );
            $post_id = wp_insert_post($new_post);
        
        wp_set_object_terms($post_id, $name, 'nombre', false);
        wp_set_object_terms($post_id, $email, 'email', false);
        wp_set_object_terms($post_id, $phone, 'telefono', false);

        if($product == 'anual'){
            wp_set_object_terms($post_id, 'ANUAL', 'producto', false);
        } else {
            wp_set_object_terms($post_id, 'MULTISEDE', 'producto', false);
        }
        $valor = $this->getPrecio($idsede, $post_id);
        wp_set_object_terms($post_id, $valor, 'valor', false);
        wp_set_object_terms($post_id, $sede, 'sede', false);
        wp_set_object_terms($post_id, $estado, 'estado', false);
        return $post_id;
    }

    private function getPrecio($idsede, $idpedido){
        $producto = strip_tags(get_the_term_list($idpedido, 'producto'));
        if($producto == 'ANUAL'){
            return get_field('precio_final',$idsede);
        }else{
            return get_field('precio_multisede_actual','option');
        }
    }

    public function getPostByToken($ciphertext, $posttype){
        // $bcrypt = new Bcrypt();
        // $setup = new Setup();
        // $plaintext = $setup->secret();
        // $bcrypt_version = '2a';
        $args = array(
            'post_type' =>  $posttype,
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $posttoken = get_field('token',get_the_id() );
                if($posttoken === $ciphertext){
                    return get_the_id();
                }
            endwhile;
            wp_reset_query();
        endif;
        return false;
    }

 

    public function ActualizaPedidoenClientes($idpedido, $idcliente){
        $row = array(
            'id_pedido' => get_the_title($idpedido),
            'producto'   => strip_tags(get_the_term_list($idpedido, 'producto')),
            'valor'  => strip_tags(get_the_term_list($idpedido, 'valor')),
            'link'  => home_url().'/wp-admin/post.php?post='.$idpedido.'&action=edit',
        );
        add_row('compras', $row, $idcliente);
        return $row;
    }
    public function ActualizaClienteEnPedido($idpedido, $idcliente){
        update_field('cliente',$idcliente, $idpedido);
        $nombres = get_field('nombres',$idcliente);
        $apellidos = get_field('apellidos',$idcliente);
        $email = get_field('email',$idcliente);
        $celular = get_field('celular',$idcliente);
        $whatsapp = get_field('whatsapp',$idcliente);
        $direccion = get_field('direccion',$idcliente);
        $depto = get_field('depto',$idcliente);
        $comuna = get_field('comuna',$idcliente);

        $content = 'Nombres: <strong>'.$nombres.'</strong><br>';
        $content .= 'Apellidos: <strong>'.$apellidos.'</strong><br>';
        $content .= 'Email: <strong>'.$email.'</strong><br>';
        $content .= 'Celular: <strong>'.$celular.'</strong><br>';
        $content .= 'Tiene whatsapp?: <strong>'.($whatsapp == '1' ? 'si' : 'no').'</strong><br>';
        $content .= 'Dirección: <strong>'.$direccion.'</strong><br>';
        $content .= 'Depto: <strong>'.$depto.'</strong><br>';
        $content .= 'Comuna: <strong>'.$comuna.'</strong><br>';

        update_field('datos_cliente', $content, $idpedido);
    }

}
