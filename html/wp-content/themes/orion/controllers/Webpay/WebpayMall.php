<?php

namespace Inc\Webpay;

use Inc\Creapost\Creapost;
use Inc\Webpay\Certificates;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

class WebpayMall
{
    public function initMall($amount, $buyOrder, $sessionId, $returnUrl, $finalUrl, $stores, $modo = 'dev')
    {

        if (substr($finalUrl, 0, 4) != "http") $finalUrl = 'http:' . $finalUrl;
        if (substr($returnUrl, 0, 4) != "http") $returnUrl = 'http:' . $returnUrl;


        if ($modo == 'dev') {
            $configuration = Configuration::forTestingWebpayPlusMall();
            // $storeCode = "597044444402";
        } else {
            $configuration = new Configuration();
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()['commerce_code']);
            $configuration->setPrivateKey(Certificates::Certificates()['private_key']);
            $configuration->setPublicCert(Certificates::Certificates()['public_cert']);
        }
        $webpay = new Webpay($configuration);

        $result = $webpay->getMallNormalTransaction()->initTransaction($buyOrder, $sessionId, $returnUrl, $finalUrl, $stores);
        return array(
            'result' => $result,
            'credencials' => array(
                'commerce_code' => Certificates::Certificates()['commerce_code'],
                'private_key' => Certificates::Certificates()['private_key'],
                'public_cert' => Certificates::Certificates()['public_cert'],
            )
        );
    }

    public function webpayresponse($tokenWs, $modo = 'dev')
    {

        if ($modo == 'dev') {
            $configuration = Configuration::forTestingWebpayPlusMall();
        } else {
            $configuration = new Configuration();
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()["commerce_code"]);
            $configuration->setPrivateKey(Certificates::Certificates()["private_key"]);
            $configuration->setPublicCert(Certificates::Certificates()["public_cert"]);
        }

        $webpay = new Webpay($configuration);
        $result = $webpay->getMallNormalTransaction()->getTransactionResult($tokenWs);

        $output = $result->detailOutput;
        $urlfinal = $result->urlRedirection;


        return  [
            'urlfinal' => $urlfinal,
            'tokenWs' => $tokenWs,
            'result' => $result
        ];
    }



    public function logResponse($result, $tagacf, $idp)
    {

        $amount = 0;
        if (is_array($result["result"]->detailOutput)) {
            $restb = $result["result"]->detailOutput[0]->responseCode;
        } else {
            $restb = $result["result"]->detailOutput->responseCode;
        }

        if ($restb == 0) {
            $estadotransaccion = 'Aprobado';
            $estadopedido = 'PAGADO';
        } else {
            $estadotransaccion = 'Rechazada';
            $estadopedido = 'RECHAZADO';
        }

        $content = get_field($tagacf, $idp);
        $newcontent = '=======================================<br>';
        $newcontent .= 'Orden de compra: <strong>' . $result["result"]->buyOrder . '</strong><br>';
        $newcontent .= 'Numero Tarjeta: <strong>' . $result["result"]->cardDetail->cardNumber . '</strong><br>';
        $newcontent .= 'Fecha expiración: <strong>' . $result["result"]->cardDetail->cardExpirationDate . '</strong><br>';
        $newcontent .= '_______________<br>';

        if(is_array($result["result"]->detailOutput)){
            foreach ($result["result"]->detailOutput as $store) {
                $newcontent .= 'Código Comercio: <strong>' . $store->commerceCode . '</strong><br>';
                $newcontent .= 'Codigo Autorización: <strong>' . $store->authorizationCode . '</strong><br>';
                $newcontent .= 'Cantidad: <strong>' . $store->amount . '</strong><br>';
                $newcontent .= 'Tipo de Pago: <strong>' . $store->paymentTypeCode . '</strong><br>';
                $newcontent .= 'Tarjeta: <strong>' . $this->PaymentType($store->paymentTypeCode) . '</strong><br>';
                $newcontent .= 'Codigo Respuesta: <strong>' . $store->responseCode . '</strong><br>';
                $newcontent .= '_______________<br>';
                $amount = $amount + $store->amount;
            }
        } else {
            $newcontent .= 'Código Comercio: <strong>' . $result["result"]->detailOutput->commerceCode . '</strong><br>';
            $newcontent .= 'Codigo Autorización: <strong>' . $result["result"]->detailOutput->authorizationCode . '</strong><br>';
            $newcontent .= 'Cantidad: <strong>' . $result["result"]->detailOutput->amount . '</strong><br>';
            $newcontent .= 'Tipo de Pago: <strong>' . $result["result"]->detailOutput->paymentTypeCode . '</strong><br>';
            $newcontent .= 'Tarjeta: <strong>' . $this->PaymentType($result["result"]->detailOutput->paymentTypeCode) . '</strong><br>';
            $newcontent .= 'Codigo Respuesta: <strong>' . $result["result"]->detailOutput->responseCode . '</strong><br>';
            $newcontent .= '_______________<br>';
            $amount = $amount + $result["result"]->detailOutput->amount;
        }
        

        $newcontent .= 'Numero de sesion: <strong>' . $result["result"]->sessionId . '</strong><br>';
        $newcontent .= 'Fecha transacción: <strong>' . $result["result"]->transactionDate . '</strong><br>';
        $newcontent .= 'Resultado Transacción: <strong>' . $estadotransaccion . '</strong><br>';
        $newcontent .= '=======================================<br>';
        $newcontent2 = $content . $newcontent;
        update_field($tagacf, $newcontent2, $idp);
        wp_set_object_terms($idp, $estadopedido, 'ordenes_estado', false);
        return $amount;
        // wp_set_object_terms($idp, $this->PaymentType($result->detailOutput->paymentTypeCode), 'tarjeta', false);

    }

    public function PaymentType($paymenttype)
    {
        $tarjeta = 'desconocida';
        if ($paymenttype == 'VD') {
            $tarjeta = 'Venta Débito';
        }
        if ($paymenttype == 'VC') {
            $tarjeta = 'Credito en cuotas';
        }
        if ($paymenttype == 'VN') {
            $tarjeta = 'Credito Normal';
        }
        if ($paymenttype == 'S2') {
            $tarjeta = 'Credito 2 cuotas sin interes';
        }
        if ($paymenttype == 'SI') {
            $tarjeta = 'Credito 3 cuotas sin interes';
        }
        if ($paymenttype == 'N2' || $paymenttype == '2C') {
            $tarjeta = 'Credito 2 cuotas';
        }
        if ($paymenttype == 'N3' || $paymenttype == '3C') {
            $tarjeta = 'Credito 3 cuotas';
        }
        if ($paymenttype == 'N4' || $paymenttype == '4C') {
            $tarjeta = 'Credito 4 cuotas';
        }
        if ($paymenttype == 'N5' || $paymenttype == '5C') {
            $tarjeta = 'Credito 5 cuotas';
        }
        if ($paymenttype == 'N6' || $paymenttype == '6C') {
            $tarjeta = 'Credito 6 cuotas';
        }
        if ($paymenttype == 'N7' || $paymenttype == '7C') {
            $tarjeta = 'Credito 7 cuotas';
        }
        if ($paymenttype == 'N8' || $paymenttype == '8C') {
            $tarjeta = 'Credito 8 cuotas';
        }
        if ($paymenttype == 'N9' || $paymenttype == '9C') {
            $tarjeta = 'Credito 9 cuotas';
        }
        if ($paymenttype == 'N10' || $paymenttype == '10C') {
            $tarjeta = 'Credito 10 cuotas';
        }
        if ($paymenttype == 'N11' || $paymenttype == '11C') {
            $tarjeta = 'Credito 11 cuotas';
        }
        if ($paymenttype == 'N12' || $paymenttype == '12C') {
            $tarjeta = 'Credito 12 cuotas';
        }
        if ($paymenttype == 'VP') {
            $tarjeta = 'prepago';
        }
        return $tarjeta;
    }

    //RESPONSE
    // object(Transbank\Webpay\transactionResultOutput)#484 (8) {
    //     ["accountingDate"]=>
    //     string(4) "0606"
    //     ["buyOrder"]=>
    //     string(4) "2515"
    //     ["cardDetail"]=>
    //     object(Transbank\Webpay\cardDetail)#490 (2) {
    //       ["cardNumber"]=>
    //       string(3) "011"
    //       ["cardExpirationDate"]=>
    //       NULL
    //     }
    //     ["detailOutput"]=>
    //     array(2) {
    //       [0]=>
    //       object(stdClass)#486 (7) {
    //         ["sharesNumber"]=>
    //         int(0)
    //         ["amount"]=>
    //         string(5) "31500"
    //         ["commerceCode"]=>
    //         string(12) "597044444402"
    //         ["buyOrder"]=>
    //         string(9) "695979714"
    //         ["authorizationCode"]=>
    //         string(6) "689824"
    //         ["paymentTypeCode"]=>
    //         string(2) "VD"
    //         ["responseCode"]=>
    //         int(0)
    //       }
    //       [1]=>
    //       object(stdClass)#485 (7) {
    //         ["sharesNumber"]=>
    //         int(0)
    //         ["amount"]=>
    //         string(4) "3500"
    //         ["commerceCode"]=>
    //         string(12) "597044444403"
    //         ["buyOrder"]=>
    //         string(9) "195149919"
    //         ["authorizationCode"]=>
    //         string(6) "763677"
    //         ["paymentTypeCode"]=>
    //         string(2) "VD"
    //         ["responseCode"]=>
    //         int(0)
    //       }
    //     }
    //     ["sessionId"]=>
    //     string(4) "4183"
    //     ["transactionDate"]=>
    //     string(29) "2020-06-06T07:11:47.619-04:00"
    //     ["urlRedirection"]=>
    //     string(57) "https://webpay3gint.transbank.cl/webpayserver/voucher.cgi"
    //     ["VCI"]=>
    //     string(3) "TSY"


    //   e0189b13639d966ae96706dffa048212230bee8ca475cbd3a6d3291e0ba5f49a
}
