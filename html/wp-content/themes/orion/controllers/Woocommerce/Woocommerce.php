<?php 
namespace Inc\Woocommerce;
// use Inc\setup\removegutenberg;
// use Inc\setup\menu;

class Woocommerce{
    private static $loaded = false;
    public function __construct() 
    {
        $this->woocommerce();
    }
    public function woocommerce(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
    }
}
?>