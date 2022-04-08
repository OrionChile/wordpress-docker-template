<?php

namespace Inc\Cremaciones;

use Inc\Cremaciones\Ordenes;
use Inc\Formulas\Numbers;

class Emailcliente
{
    public static function html($order_id)
    {
        $ordenes = new Ordenes();
        if (get_field('agrega_adicional', $order_id)) {
            $emailhtml = file_get_contents(get_template_directory_uri() . '/emails/email-cliente_adicional.html');
        } else {
            $emailhtml = file_get_contents(get_template_directory_uri() . '/emails/email-cliente.html');
        }
        $fundacion = get_field('fundacion', $order_id);
        $fundacion_por = get_field('porcentaje', $fundacion->ID);

        $fundacion_valor = Numbers::NumbertoMoney($ordenes->getFunerariaPrice($order_id) * Numbers::MoneytoNumber($fundacion_por) / 100);
        $searchTerms = array(
            '{{servicio}}',
            '{{tiponecesidad}}',
            '{{funeraria}}',
            '{{planes}}',
            '{{pago}}',
            '{{website}}',
            '{{fundacion_por}}',
            '{{fundacion_valor}}',
            '{{fundacion}}'
        );
        $replacements = array(
            get_field('planes', $order_id)[0]['servicio'], //servicio
            get_field('tipo_de_necesidad', $order_id), //tipo necesidad
            get_the_title(get_field('funerarias', $order_id)), //funeraria
            $ordenes->getPlanes($order_id), //planes
            Numbers::NumbertoMoney($ordenes->getFunerariaPrice($order_id)), //pago
            home_url(), //website
            $fundacion_por,
            $fundacion_valor,
            get_the_title($fundacion->ID), //fundacion


        );
        $emailhtml = str_replace($searchTerms, $replacements, $emailhtml);

        if (get_field('agrega_adicional', $order_id)) {
            $searchTerms = array(
                '{{servicio2}}',
                '{{tiponecesidad2}}',
                '{{funeraria2}}',
                '{{planes2}}',
                '{{fundacion2}}',
                '{{pago2}}',
            );
            $replacements = array(
                get_field('planes_adicional', $order_id)[0]['servicio'], //servicio
                get_field('tipo_de_necesidad', $order_id), //tipo necesidad
                get_the_title(get_field('funerarias_adicional', $order_id)), //funeraria
                $ordenes->getPlanes($order_id, true), //planes
                $ordenes->getFundacionString($order_id, true), //fundacion
                Numbers::NumbertoMoney($ordenes->getFunerariaPrice($order_id, true)) //pago
            );
            $emailhtml = str_replace($searchTerms, $replacements, $emailhtml);
        }
        return $emailhtml;
    }
}
