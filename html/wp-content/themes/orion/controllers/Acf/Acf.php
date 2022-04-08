<?php 
namespace Inc\Acf;
use Inc\Acf\ACFValidaRUT;
use Inc\Acf\ACFValidaImagen;
use Inc\Acf\ACFselector;
use Inc\Acf\ACFoptions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Acf{
    private static $loaded = false;
    public function __construct() 
    {
        $this->acf();
    }
    public function acf(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
        // new ACFValidaRUT();
        // new ACFValidaImagen();
        // new ACFselector();
        new ACFOptions();
    }
}
?>