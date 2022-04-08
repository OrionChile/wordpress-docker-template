<?php 
namespace Inc\Acf;

use Inc\Formulas\Numbers;
// use Inc\Formulas\ValidaRUT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



Class ACFrepeater{

    function updateSubFieldbySubfield($fieldname, $selLabel, $selValue, $targetLabel, $targetValue, $id) {
        $values = get_field($fieldname, $id);
        foreach ($values as $key => $value) {
            if($value[$selLabel] === $selValue){
                $values[$key][$targetLabel] = $targetValue;
                
            }
        };
        update_field($fieldname, $values, $id);   
    }

    function updateAllSubField($fieldname, $targetLabel, $targetValue, $id){
        $values = get_field($fieldname, $id);
            foreach ($values as $key => $value) {
                    $values[$key][$targetLabel] = $targetValue;
                
            };
            update_field($fieldname, $values, $id);        
        }

    function deleteRowbySubField($fieldname, $selLabel, $selValue,  $id){
        $values = get_field($fieldname, $id);
        $looplong = sizeof($values);
        for ($key=$looplong; $key >= 0 ; $key--) { 
            if($values[$key][$selLabel] === $selValue){
                array_splice($values, $key, 1); 
            }
        }
        update_field($fieldname, $values, $id); 
    }

    function deleteAllfields($fieldname, $id){
        update_field($fieldname, [], $id); 
    }

    function addSubRow($fieldname, $id, $addsubfield, $active = false){
        $total = 0;
        $values = get_field($fieldname, $id);
        foreach ($values as $value) {
            if($active){
                if($value[$active]){
                    $addfield = Numbers::MoneytoNumber($value[$addsubfield]);
                    $total = $total + intval($addfield);
                }
            } else {
                $addfield = Numbers::MoneytoNumber($value[$addsubfield]);
                $total = $total + $addfield;
            }
        }
        return array(
            'int' => $total,
            'string' => Numbers::NumbertoMoney($total)
        );
    }
    

}
