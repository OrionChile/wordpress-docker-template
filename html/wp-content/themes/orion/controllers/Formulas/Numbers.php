<?php
namespace Inc\Formulas;

if (!defined('ABSPATH')) {
    exit;
}
class Numbers
{
    public static function MoneytoNumber($valor)
    {
        $valor = str_replace("$","", $valor);
        $valor = str_replace('.','', $valor);
        $valor = str_replace('.','', $valor);
        $valor = str_replace('.','', $valor);
        $valor = str_replace('.','', $valor);
        $valor = str_replace(',','', $valor);
        $valor = str_replace(',','', $valor);
        $valor = str_replace(',','', $valor);
        $valor = str_replace(',','', $valor);
        $valor = str_replace(',','', $valor);
        $valor = intval($valor);
        return $valor;
    }

    public static function NumbertoMoney($valor)
    {
        return '$'.number_format($valor, 0);
    }
}
