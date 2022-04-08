<?php 
namespace Inc\CustomPost;
use Inc\CustomPost\ClientesPost;
// use Inc\setup\menu;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class CustomPost{
    private static $loaded = false;
    public function __construct() 
    {
        $this->custompost();
    }
    public function custompost(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
        // new PostCustom();
        new ClientesPost();
        
    }
}
// https://developer.wordpress.org/resource/dashicons/#tag
// https://codex.wordpress.org/Post_Types
// single-$posttype.php 

?>