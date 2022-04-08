<?php 
namespace Inc\Setup;
use Inc\Setup\RemoveGutenberg;
use Inc\Setup\Menu;
use Inc\Setup\ImageSizes;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Setup{
    private static $loaded = false;
    public function __construct() 
    {
        $this->setup();
    }
    public function setup(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
        new RemoveGutenberg();
        new Menu();
        new Support();
        new ImageSizes();
    }

    public function secret(){
        $plaintext = '!piG54xRvoKdFGpUTUARH0%q*K5wc0LjsT8^F*y0TcSvuEk2v#QCSJo&hxE8UMWQ5Q';
        return $plaintext;
    }
}
?>