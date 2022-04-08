<?php

namespace Inc\Cremaciones;

use Inc\Acf\ACFrepeater;
use Inc\Formulas\Numbers;
use Inc\Webpay\Certificates;

class Ordenes
{
    public function sumaGeneral($order_id)
    {
        if (get_field('tipo_de_necesidad', $order_id) === ' A Futuro') {
            //aqui suma planes
            return $this->SumaPlanes($order_id);
        } else {
            //aqui suma valores fallecidos
            return $this->SumaFallecidos($order_id);
        }
    }


    private function SumaPlanes($order_id)
    {
        $repeater = new ACFrepeater();
        $fundacion = get_field('fundacion', $order_id);
        $percFunda = get_field('porcentaje', $fundacion->ID);
        $funeraria = get_field('funerarias', $order_id);
        $funerariaAdicional = get_field('funerarias_adicional', $order_id);
        //planes
        $resultplanes = $repeater->addSubRow(
            'planes',
            $order_id,
            'precio_total',
            'activo'
        );


        $restultotal = $resultplanes;
        $restante = 100 - intval($percFunda);

        if(Certificates::Certificates()['config'] === 'dev'){
            $commercecode = "597044444402";
        } else{
            $commercecode = get_field('codigo_comercio', $funeraria->ID);
        }

        //store del principal
        $stores[] = array(
            'tipo' => 'funeraria_principal',
            'nombrefuneraria' => get_the_title($funeraria->ID),
            "storeCode" => $commercecode,
            "amount" => intval($resultplanes['int'] * $restante / 100),
            "buyOrder" => rand(),
            "sessionId" => rand()
        );


        //adicional
        if (get_field('agrega_adicional', $order_id)) {
            $resultplanesadicional = $repeater->addSubRow(
                'planes_adicional',
                $order_id,
                'precio_total',
                'activo'
            );
            $restultotal = array(
                'int' => $resultplanes['int'] + $resultplanesadicional['int'],
                'string' => Numbers::NumbertoMoney($resultplanes['int'] + $resultplanesadicional['int'])
            );

            if(Certificates::Certificates()['config'] === 'dev'){
                $commercecode = "597044444403";
            } else{
                $commercecode = get_field('codigo_comercio', $funerariaAdicional->ID);
            }

            $stores[] = array(
                'tipo' => 'funeraria_adicional',
                'nombrefuneraria' => get_the_title($funerariaAdicional->ID),
                "storeCode" => $commercecode,
                "amount" => intval($resultplanesadicional['int'] * $restante / 100),
                "buyOrder" => rand(),
                "sessionId" => rand()
            );

            $valores[$funerariaAdicional->ID] = array(
                'tipo' => 'funeraria_adicional',
                'nombrefuneraria' => get_the_title($funerariaAdicional->ID),
                'precio' => $resultplanesadicional['int'],
                'preciopagado' => intval($resultplanesadicional['int'] * $restante / 100)
            );
        }

        //FUNDACION
        if (intval($percFunda) !== 0) {
            $stores[] = array(
                'tipo' => 'fundacion',
                'nombrefuneraria' => get_the_title($fundacion->ID),
                "storeCode" => get_field('codigo_comercio', $fundacion->ID),
                "amount" => ceil($restultotal['int'] * intval($percFunda) / 100),
                "buyOrder" => rand(),
                "sessionId" => rand()
            );
        }
        return $stores;
    }

    private function SumaFallecidos($order_id)
    {
        $fallecidos = get_field('num_fallecidos', $order_id);
        // var_dump($fallecidos);
        $acumulado = [];
        foreach ($fallecidos as $fallecido) {
            $total = Numbers::MoneytoNumber($fallecido["precio_por_fallecido"]);

            $valores[$fallecido["funeraria"]->ID] = array(
                'nombrefuneraria' => get_the_title($fallecido["funeraria"]->ID),
                'preciobruto' => $total + $acumulado[$fallecido["funeraria"]->ID],
            );
            $acumulado[$fallecido["funeraria"]->ID] = $valores[$fallecido["funeraria"]->ID]['preciobruto'];
        }


        return array(
            'valores' => $valores,
            // 'stores' => $stores,
            'valoresString' => $valores
        );
    }

    private function getPlanImg($funerariaID, $titulo)
    {
        $planes = get_field('planes', $funerariaID);
        foreach ($planes as $plan) {
            if ($plan['titulo'] === $titulo) {
                return $plan['imagen'];
            }
        }
    }

    public function successBuy($order_id)
    {
        $funerariaRES = get_the_title(get_field('funerarias', $order_id));
        $planesRES = '';

        if (get_field('agrega_adicional', $order_id)) {
            $funerariaRES =  $funerariaRES . ' | ' . get_the_title(get_field('funerarias_adicional', $order_id));
        }

        $planes = get_field('planes', $order_id);
        $planes_adicional = get_field('planes_adicional', $order_id);

        foreach ($planes as $key => $plan) {
            if ($plan['activo']) {
                if ($key === 0) {
                    $planesRES = $plan['nombre_del_plan'];
                } else {
                    $planesRES = $planesRES . ' | ' . $plan['nombre_del_plan'];
                }
            }
        }
        if ($planes_adicional) {
            foreach ($planes_adicional as $key => $plan) {
                if ($plan['activo']) {
                    if ($key === 0) {
                        $planesRES = $plan['nombre_del_plan'];
                    } else {
                        $planesRES = $planesRES . ' | ' . $plan['nombre_del_plan'];
                    }
                }
            }
        }



        return array(
            'funeraria' => $funerariaRES,
            'plan' => $planesRES,
            'fundacion' => get_the_title(get_field('fundacion', $order_id))
        );
    }







    private function getPriceCartLine($planid, $order_id)
    {
        if (get_field('tipo_de_necesidad', $order_id) === ' A Futuro') {

            $planes = get_field('planes', $order_id);
            $total = 0;
            foreach ($planes as $plan) {
                if ($planid === sanitize_title($plan["nombre_del_plan"]) && $plan['activo']) {
                    $total = $total + Numbers::MoneytoNumber($plan['precio_total']);
                }
            }

            $planesadic = get_field('planes_adicional', $order_id);
            foreach ($planesadic as $plan) {
                if ($planid === sanitize_title($plan["nombre_del_plan"]) && $plan['activo']) {
                    $total = $total + Numbers::MoneytoNumber($plan['precio_total']);
                }
            }
            // return $planes;
            return $total;
        } else {
            $total = 0;
            $acumulado = [];
            $fallecidos = get_field('num_fallecidos', $order_id);
            foreach ($fallecidos as $fallecido) {
                if ($planid === $fallecido["identificador_plan"]) {
                    $total =    intval($acumulado[$fallecido["identificador_plan"]]) +
                        Numbers::MoneytoNumber($fallecido['precio_por_fallecido']);
                    $acumulado[$fallecido["identificador_plan"]] = $total;
                }
            }
            return $total;
        }
    }



    public function cartlista($planesLista, $order_id)
    {
        $result = [];
        foreach ($planesLista as $set) {
            foreach ($set['planes'] as $plan) {
                $fundacionID = get_field('fundacion', $order_id)->ID;
                $planid = sanitize_title($plan['nombre_del_plan']);
                $fundacionResult =
                    Numbers::NumbertoMoney(
                        $this->getPriceCartLine($planid, $order_id) *
                            get_field('porcentaje', $fundacionID) / 100
                    ) . ' (' . get_field('porcentaje', $fundacionID) . '%)';

                if ($plan['activo']) {
                    $result[$planid] = array(
                        'producto' => array(
                            'nombre' => $plan['nombre_del_plan'],
                            'imagen' => $this->getPlanImg($set['funeraria']->ID, $plan['nombre_del_plan'])['url']
                        ),
                        'entidad' => get_the_title($set['funeraria']->ID),
                        'entidadimg' => get_the_post_thumbnail_url($set['funeraria']->ID),
                        'fundacion' => get_the_title($fundacionID),
                        'fundacionimg' => get_the_post_thumbnail_url($fundacionID),
                        'fundacionResult' => $fundacionResult,
                        'cantidad' => $plan['cantidad'],
                        'total' => Numbers::NumbertoMoney($this->getPriceCartLine($planid, $order_id)),
                        'idplan' => $planid,
                        // "set" => $set,
                        // "test" => $this->getPriceCartLine($planid, $order_id)
                    );
                }
            }
        }
        return $result;
    }

    public function disableAllPlans($order_id)
    {


        $values = get_field('planes', $order_id);
        foreach ($values as $key => $plan) {
            $values[$key]['activo'] = false;
        };
        update_field('planes', $values, $order_id);

        $values = get_field('planes_adicional', $order_id);
        foreach ($values as $key => $plan) {
            $values[$key]['activo'] = false;
        };
        update_field('planes_adicional', $values, $order_id);
    }

    public function cartAddPlanNumber($order_id)
    {
        $result = 0;
        $planes = get_field('planes', $order_id);
        foreach ($planes as $plan) {
            if ($plan['activo']) {
                $result = $result + intval($plan['cantidad']);
            }
        };
        $planes = get_field('planes_adicional', $order_id);
        foreach ($planes as $plan) {
            if ($plan['activo']) {
                $result = $result + intval($plan['cantidad']);
            }
        };
        return $result;
    }

    public function getFunerariaPrice($order_id, $adicional = false)
    {
        if ($adicional) {
            $planfield = 'planes_adicional';
            $funeraria = 'funerarias_adicional';
        } else {
            $planfield = 'planes';
            $funeraria = 'funerarias';
        }
        $planes = get_field($planfield, $order_id);
        $total = 0;
        if (get_field('tipo_de_necesidad', $order_id) === ' A Futuro') {
            //aqui suma planes
            foreach ($planes as $plan) {
                $total = $total + Numbers::MoneytoNumber($plan['precio_total']);
            }
            return $total;
        } else {
            //aqui suma fallecidos
            $fallecidos = get_field('num_fallecidos', $order_id);
            foreach ($fallecidos as $fallecido) {
                if ($fallecido['funeraria'] === $funeraria) {
                    $total = $total + Numbers::MoneytoNumber($fallecido['precio_por_fallecido']);
                }
            }
            return $total;
        }
    }

    public function getFundacionString($order_id, $adicional = false)
    {
        $fundacion = get_field('fundacion', $order_id);
        $porcentaje = get_field('porcentaje', $fundacion->ID);
        $total = $this->getFunerariaPrice($order_id, $adicional) * intval($porcentaje) / 100;
        return get_the_title($fundacion->ID) . ' (' . $porcentaje . '%)  ' . Numbers::NumbertoMoney($total);
    }

    public function getPlanes($order_id, $adicional = false)
    {
        if ($adicional) {
            $planfield = 'planes_adicional';
        } else {
            $planfield = 'planes';
        }
        $planes = get_field($planfield, $order_id);
        $result = '';
        foreach ($planes as $key => $plan) {
            if ($key === 0) {
                $result = $plan['nombre_del_plan'];
            } else {
                $result = $result . ' | ' . $plan['nombre_del_plan'];
            }
        }

        return $result;
    }
}
