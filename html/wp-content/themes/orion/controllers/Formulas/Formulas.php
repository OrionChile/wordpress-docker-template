<?php 
namespace Inc\Formulas;
use Inc\Setup\ValidaRUT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Formulas{
    private static $loaded = false;
    public function __construct() 
    {
        $this->formulas();
    }
    public function formulas(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
        new ValidaRUT();
    }
}
?>