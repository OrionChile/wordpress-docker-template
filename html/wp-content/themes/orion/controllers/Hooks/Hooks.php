<?php 
namespace Inc\Hooks;

use Inc\Hooks\EmailPedidos;
use Inc\Hooks\ExcelPedidos;
use Inc\Hooks\ExcelClientes;
use Inc\Hooks\PreUpdatePost;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hooks{
    private static $loaded = false;
    public function __construct() 
    {
        $this->hooks();
    }
    public function hooks(){
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
        new EmailPedidos();
        new ExcelPedidos();
        new ExcelClientes();
    }
}
?>