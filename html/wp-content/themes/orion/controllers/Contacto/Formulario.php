<?php 
namespace Inc\Contacto;
if ( ! defined( 'ABSPATH' ) ) {exit;}


class Formulario  
{
    public function recatchpa3($secret, $token)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];
        
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $res = json_decode($response, true);
        return $res['success'];
    }

    public function sumaformulario(){
        $actual = get_field('num_formularios','option');
        if($actual == ''){ update_field('num_formularios','0','option');}
        $actual = intval($actual) + 1;
        update_field('num_formularios',$actual,'option');
        return strval($actual);
    }
    
  
}