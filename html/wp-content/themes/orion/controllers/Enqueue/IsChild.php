<?php 
/**
 * @package dekaz startertheme
 */

namespace Inc\Enqueue;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class IsChild{
    public static function IsChild() {
        if (get_template_directory() === get_stylesheet_directory()) {
            return false;
        } else {
          return true;
        }
      }
}
?>