<?php

namespace Inc\Webpay;

use Inc\Creapost\Creapost;
use Inc\Webpay\Certificates;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

if (!defined('ABSPATH')) {
    exit;
}

class WebpayWP
{
    public function InitMall($amount, $buyOrder, $sessionId, $returnUrl, $finalUrl, $storeCode = "597044444402", $modo = 'dev')
    {
        if (substr($finalUrl, 0, 4) != "http") $finalUrl = 'http:' . $finalUrl;
        if (substr($returnUrl, 0, 4) != "http") $returnUrl = 'http:' . $returnUrl;
        

        if ($modo == 'dev') {
            $configuration = Configuration::forTestingWebpayPlusMall();
            $storeCode = "597044444402";
        } else {
            $configuration = new Configuration();
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()['commerce_code']);
            $configuration->setPrivateKey(Certificates::Certificates()['private_key']);
            $configuration->setPublicCert(Certificates::Certificates()['public_cert']);
         }
         $webpay = new Webpay($configuration);

        $stores = [
            [
                // "storeCode" => "597044444402",
                "storeCode" => $storeCode,
                "amount" => $amount,
                "buyOrder" => explode('_', $buyOrder)[1],
                "sessionId" => $sessionId
            ],
           
        ];

        $request = array(
            "buyOrder"  => $buyOrder,
            "sessionId" => $sessionId,
            "urlReturn" => $returnUrl,
            "urlFinal"  => $finalUrl,
            "stores"  => $stores,
        );
        $result = $webpay->getMallNormalTransaction()->initTransaction($buyOrder, $sessionId, $returnUrl, $finalUrl, $stores);
        return $result;
    }

    public function PaymentType($paymenttype){
        $tarjeta = 'desconocida';
        if($paymenttype == 'VD') {$tarjeta = 'Venta Débito';}
        if($paymenttype == 'VC') {$tarjeta = 'Credito en cuotas';}
        if($paymenttype == 'VN') {$tarjeta = 'Credito Normal';}
        if($paymenttype == 'S2') {$tarjeta = 'Credito 2 cuotas sin interes';}
        if($paymenttype == 'SI') {$tarjeta = 'Credito 3 cuotas sin interes';}
        if($paymenttype == 'N2' || $paymenttype == '2C') {$tarjeta = 'Credito 2 cuotas';}
        if($paymenttype == 'N3' || $paymenttype == '3C') {$tarjeta = 'Credito 3 cuotas';}
        if($paymenttype == 'N4' || $paymenttype == '4C') {$tarjeta = 'Credito 4 cuotas';}
        if($paymenttype == 'N5' || $paymenttype == '5C') {$tarjeta = 'Credito 5 cuotas';}
        if($paymenttype == 'N6' || $paymenttype == '6C') {$tarjeta = 'Credito 6 cuotas';}
        if($paymenttype == 'N7' || $paymenttype == '7C') {$tarjeta = 'Credito 7 cuotas';}
        if($paymenttype == 'N8' || $paymenttype == '8C') {$tarjeta = 'Credito 8 cuotas';}
        if($paymenttype == 'N9' || $paymenttype == '9C') {$tarjeta = 'Credito 9 cuotas';}
        if($paymenttype == 'N10' || $paymenttype == '10C') {$tarjeta = 'Credito 10 cuotas';}
        if($paymenttype == 'N11' || $paymenttype == '11C') {$tarjeta = 'Credito 11 cuotas';}
        if($paymenttype == 'N12' || $paymenttype == '12C') {$tarjeta = 'Credito 12 cuotas';}
        if($paymenttype == 'VP') {$tarjeta = 'prepago';}
        return $tarjeta;
    }

    public function ResponseMall($token,$modo = 'dev')
    {
        if ($modo == 'dev') {
            $configuration = Configuration::forTestingWebpayPlusMall();
        } else {
            $configuration = new Configuration();
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()['commerce_code']);
            $configuration->setPrivateKey(Certificates::Certificates()['private_key']);
            $configuration->setPublicCert(Certificates::Certificates()['public_cert']);
        }
        $webpay = new Webpay($configuration);
        $result = $webpay->getMallNormalTransaction()->getTransactionResult($token);
        return $result;           
        }
    
    public function Init($amount, $buyOrder, $sessionId, $returnUrl, $finalUrl, $modo = 'dev')
    {
        if (substr($finalUrl, 0, 4) != "http") {
            $finalUrl = 'http:' . $finalUrl;
        }
        if (substr($returnUrl, 0, 4) != "http") {
            $returnUrl = 'http:' . $returnUrl;
        }

        if ($modo == 'dev') {
            $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
                ->getNormalTransaction();
        } else {
            $configuration = new Configuration();
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()['commerce_code']);
            $configuration->setPrivateKey(Certificates::Certificates()['private_key']);
            $configuration->setPublicCert(Certificates::Certificates()['public_cert']);
            $webpay = new Webpay($configuration);
            $transaction = $webpay->getNormalTransaction();
        }


        $initResult = $transaction->initTransaction(
            $amount,
            $buyOrder,
            $sessionId,
            $returnUrl,
            $finalUrl
        );

        $formAction = $initResult->url;
        $tokenWs = $initResult->token;
        return array(
            'formaction' => $formAction,
            'tokenws' => $tokenWs,
            'modo' => $modo
        );
    }

    public function Response($modo = 'dev')
    {
        if ($modo == 'dev') {
            $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))->getNormalTransaction();
            return $transaction;
        } else {
            $configuration = new Configuration();
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()['commerce_code']);
            $configuration->setPrivateKey(Certificates::Certificates()['private_key']);
            $configuration->setPublicCert(Certificates::Certificates()['public_cert']);
            $webpay = new Webpay($configuration);
            $transaction = $webpay->getNormalTransaction();
            return $transaction;
        }
    }

    public function logResponseMall($result, $tagacf)
    {
        $idp = explode("--", $result->sessionId);
        $ses = $result->sessionId;
        if ($result->detailOutput->responseCode == 0) {
            $estadotransaccion = 'Aprobado';
            $estadopedido = '2 PAGADO';
        } else {
            $estadotransaccion = 'Rechazada';
            $estadopedido = '2 RECHAZADO';
        }

        echo '<script>  window.localStorage.clear() </script>';
        // echo '<script>window.localStorage.setItem("authorizationCode",' . $result->detailOutput->authorizationCode . ')</script>';
        echo '<script>window.localStorage.setItem("amount",' . $result->detailOutput->amount . ')</script>';
        echo '<script>window.localStorage.setItem("responseCode","'.$result->detailOutput->responseCode.'")</script>';
        echo '<script>window.localStorage.setItem("paymenttype","' . $result->detailOutput->paymentTypeCode  . '")</script>';
        echo '<script>window.localStorage.setItem("sessionid","'.$result->sessionId.'")</script>';
        

        $content = get_field($tagacf, $idp[1]);
        $newcontent = 'Código Comercio: <strong>' . $result->detailOutput->commerceCode. '</strong><br>';
        $newcontent .= 'Orden de compra: <strong>' . $result->buyOrder . '</strong><br>';
        $newcontent .= 'Numero Tarjeta: <strong>' . $result->cardDetail->cardNumber . '</strong><br>';
        $newcontent .= 'Fecha expiración: <strong>' . $result->cardDetail->cardExpirationDate . '</strong><br>';
        $newcontent .= 'Cantidad: <strong>' . $result->detailOutput->amount . '</strong><br>';
        $newcontent .= 'Codigo Autorización: <strong>' . $result->detailOutput->authorizationCode . '</strong><br>';
        $newcontent .= 'Tipo de Pago: <strong>' . $result->detailOutput->paymentTypeCode . '</strong><br>';
        $newcontent .= 'Tarjeta: <strong>' . $this->PaymentType($result->detailOutput->paymentTypeCode) . '</strong><br>';
        $newcontent .= 'Codigo Respuesta: <strong>' . $result->detailOutput->responseCode . '</strong><br>';
        $newcontent .= 'Numero de sesion: <strong>' . $result->sessionId . '</strong><br>';
        $newcontent .= 'Fecha transacción: <strong>' . $result->transactionDate . '</strong><br>';
        $newcontent .= 'Resultado Transacción: <strong>' . $estadotransaccion . '</strong><br>';
        $newcontent2 = $content . $newcontent;
        update_field($tagacf, $newcontent2, $idp[1]);
        wp_set_object_terms($idp[1], $estadopedido, 'estado', false);
        wp_set_object_terms($idp[1], $this->PaymentType($result->detailOutput->paymentTypeCode), 'tarjeta', false);
    
    }
}
//response


//inicial
