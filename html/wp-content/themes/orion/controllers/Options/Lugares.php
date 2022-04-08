<?php

namespace Inc\Options;


if (!defined('ABSPATH')) {
    exit;
}
class Lugares
{

    static function Lugares(){
        return array(
            'Clinica',
            'Hospital',
            'Domicilio',
            'Parroquia'
        );
    }
}