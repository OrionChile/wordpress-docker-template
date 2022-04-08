<?php
namespace Inc\Webpay;

use Inc\Creapost\Creapost;
use Inc\Webpay\Certificates;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

class WebpayPlus
{
    public function init($amount, $buyOrder, $sessionId, $returnUrl, $finalUrl, $storeCode = "597044444402", $modo = 'dev')
    {
        if (substr($finalUrl, 0, 4) != "http") $finalUrl = 'http:' . $finalUrl;
        if (substr($returnUrl, 0, 4) != "http") $returnUrl = 'http:' . $returnUrl;
        

        if ($modo == 'dev') {
            $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
                ->getNormalTransaction();
        } else {
            // $certificates = new WebpayCredentialController();
            $configuration = new Configuration();
            
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()["commerce_code"]);
            $configuration->setPrivateKey(Certificates::Certificates()["private_key"]);
            $configuration->setPublicCert(Certificates::Certificates()["public_cert"]);
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
        return $initResult;
    }
    
    public function webpayresponse($tokenWs, $modo = 'dev'){
        // return $request;
        if ($modo == 'dev') {
            $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))->getNormalTransaction();
            $result = $transaction->getTransactionResult($tokenWs);
        } else {
            
            $configuration = new Configuration();
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(Certificates::Certificates()["commerce_code"]);
            $configuration->setPrivateKey(Certificates::Certificates()["private_key"]);
            $configuration->setPublicCert(Certificates::Certificates()["public_cert"]);
            $webpay = new Webpay($configuration);
            $transaction = $webpay->getNormalTransaction($tokenWs);
            $result = $transaction->getTransactionResult($tokenWs);
         
        }


        $output = $result->detailOutput;
        $urlfinal = $result->urlRedirection;

        
        return  ['urlfinal' => $urlfinal, 'tokenWs' => $tokenWs, 'result' => $result];

    
    }

    public function webpayfinal($request){
        
        // Cookie::queue('tbktok', $request['token_ws'], 5);
        return 'tbktok';
        // return redirect()->route('successful')->withCookie(cookie('tbpass', 'pass'));
    }

    public function logResponse($result, $tagacf, $idp)
    {
        $ses = $result["result"]->sessionId;
        if ($result["result"]->detailOutput->responseCode == 0) {
            $estadotransaccion = 'Aprobado';
            $estadopedido = 'PAGADO';
        } else {
            $estadotransaccion = 'Rechazada';
            $estadopedido = 'RECHAZADO';
        }

        // echo '<script>  window.localStorage.clear() </script>';
        // // echo '<script>window.localStorage.setItem("authorizationCode",' . $result->detailOutput->authorizationCode . ')</script>';
        // echo '<script>window.localStorage.setItem("amount",' . $result->detailOutput->amount . ')</script>';
        // echo '<script>window.localStorage.setItem("responseCode","'.$result->detailOutput->responseCode.'")</script>';
        // echo '<script>window.localStorage.setItem("paymenttype","' . $result->detailOutput->paymentTypeCode  . '")</script>';
        // echo '<script>window.localStorage.setItem("sessionid","'.$result->sessionId.'")</script>';
        

        $content = get_field($tagacf, $idp);
        $newcontent = 'Código Comercio: <strong>' . $result["result"]->detailOutput->commerceCode. '</strong><br>';
        $newcontent .= 'Orden de compra: <strong>' . $result["result"]->buyOrder . '</strong><br>';
        $newcontent .= 'Numero Tarjeta: <strong>' . $result["result"]->cardDetail->cardNumber . '</strong><br>';
        $newcontent .= 'Fecha expiración: <strong>' . $result["result"]->cardDetail->cardExpirationDate . '</strong><br>';
        $newcontent .= 'Cantidad: <strong>' . $result["result"]->detailOutput->amount . '</strong><br>';
        $newcontent .= 'Codigo Autorización: <strong>' . $result["result"]->detailOutput->authorizationCode . '</strong><br>';
        $newcontent .= 'Tipo de Pago: <strong>' . $result["result"]->detailOutput->paymentTypeCode . '</strong><br>';
        $newcontent .= 'Tarjeta: <strong>' . $this->PaymentType($result["result"]->detailOutput->paymentTypeCode) . '</strong><br>';
        $newcontent .= 'Codigo Respuesta: <strong>' . $result["result"]->detailOutput->responseCode . '</strong><br>';
        $newcontent .= 'Numero de sesion: <strong>' . $result["result"]->sessionId . '</strong><br>';
        $newcontent .= 'Fecha transacción: <strong>' . $result["result"]->transactionDate . '</strong><br>';
        $newcontent .= 'Resultado Transacción: <strong>' . $estadotransaccion . '</strong><br>';
        $newcontent2 = $content . $newcontent;
        update_field($tagacf, $newcontent2, $idp);
        wp_set_object_terms($idp, $estadopedido, 'ordenes_estado', false);
        // wp_set_object_terms($idp, $this->PaymentType($result->detailOutput->paymentTypeCode), 'tarjeta', false);
    
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
}
