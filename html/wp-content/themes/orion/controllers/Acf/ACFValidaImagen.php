<?php 
namespace Inc\Acf;
// use Inc\Formulas\ValidaRUT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACFValidaImagen  
{
    function __construct()
    {
     
        add_filter('acf/validate_value/name=imagen', array($this, 'my_acf_validate_img'), 10, 4);
    }
    public function my_acf_validate_img( $valid, $value, $field, $input ){
	
        // bail early if value is already invalid
        if( !$valid ) {
            return $valid;
        }
        // load image data
        $data = wp_get_attachment_image_src( $value, 'full' );
        $width = $data[1];
        $height = $data[2];
        
        if( $width < 960 ) {
            
            $valid = 'Image must be at least 960px wide';
            
        }
        
        
        // return
        return $valid;
        
        
    }

}





?>