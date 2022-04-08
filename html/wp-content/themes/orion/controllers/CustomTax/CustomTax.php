<?php 
namespace Inc\CustomTax;
use Inc\CustomTax\TaxClientes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class CustomTax{
    private static $loaded = false;
    public function __construct() 
    {
        $this->customtax();
    }
    public function customtax(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
        new TaxClientes();
    }
}


?>