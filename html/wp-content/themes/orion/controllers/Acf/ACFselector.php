<?php 
namespace Inc\Acf;
// use Inc\Formulas\ValidaRUT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class ACFselector  
{
    function __construct()
    {
     
        add_filter('acf/load_field/name=ciudades', array($this, 'acf_load_color_field_choices'));
    }
    function acf_load_color_field_choices( $field ) {
    
        // reset choices
        $field['choices'] = array();
        // get the textarea value from options page without any formatting
        $choices = 'uno dos detr';
        // explode the value so that each line is a new array piece
        $choices = explode(" ", $choices);
        // remove any unwanted white space
        $choices = array_map('trim', $choices);

        // loop through array and add to field 'choices'
        if( is_array($choices) ) {
            
            foreach( $choices as $choice ) {
                
                $field['choices'][ $choice ] = $choice;
                
            }
            
        }
        // return the field
        return $field;
        
    }
}

?>




