<?php
namespace Inc\Formulas;

if (!defined('ABSPATH')) {
    exit;
}
class Fecha
{
    public static function Fecha()
    {
        date_default_timezone_set('America/Santiago');
        $date = date('d/m/Y h:i:s a', time());
        return $date;
    }
}
