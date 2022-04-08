<?php 
namespace Inc\Acf;
use Inc\Formulas\ValidaRUT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class ACFValidaRUT  
{
    function __construct()
    {
        add_filter('acf/validate_value/name=rut', array($this, 'my_acf_validate_rut'), 10, 4);
    }
    public function my_acf_validate_rut( $valid, $value, $field, $input ){
        // bail early if value is already invalid
        if( !$valid ) {
            return $valid;
        }
        if (!ValidaRUT::validarut($value)) {
            $valid = 'no es un RUT valido';
        }
      
        
        // return
        return $valid;
        
        
    }

}



?>