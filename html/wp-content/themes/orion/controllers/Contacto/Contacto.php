<?php 
namespace Inc\Contacto;
if ( ! defined( 'ABSPATH' ) ) {exit;}


class Contacto  
{
    public function whatsapp($numero,$text = '')
    {
        return array(
            'link' => 'https://api.whatsapp.com/send?phone='.$numero.'&text='.$text,
            'name' => $numero
        );
    }
    public function telefono($numero)
    {
        return array(
            'link' => 'tel:'.$numero,
            'name' => $numero
        );
    }

    public function email($email)
    {
        return array(
            'link' => 'mailto:'.$email,
            'name' => $email
        );
    }
  
}