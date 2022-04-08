<?php 
namespace Inc\Login;
use Inc\Login\LoginImage;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Login{
    private static $loaded = false;
    public function __construct() 
    {
        $this->login();
    }
    public function login(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
        new LoginImage();
    }
}
?>