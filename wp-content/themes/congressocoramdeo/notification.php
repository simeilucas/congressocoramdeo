<?php
    include_once('config.php');
    include_once('vendor/autoload.php');
    include_once("atualizaPagamento.php");
    include_once("dao_wp.php");
 
    global $token;
    if(IS_SANDBOX){
        $token = ACCESS_TOKEN_SANDBOX;
    }else{
        $token = ACCESS_TOKEN; 
    }
    
    initAtualizaPagamento();
    
    MercadoPago\SDK::setAccessToken($token);
    $id_pagamento = $_GET["data_id"];

    $payment = MercadoPago\Payment::find_by_id($_POST["data"]["id"]);
    $fp =fopen('log.txt','a');
    $html='';

    $external = $payment->{'external_reference'};
    $id_ = $payment->{'id'};
    $status = $payment->{'status'};

    if(!empty($external) && !empty($status) && !empty($id_pagamento)){
        atualizaStatusPagamento($id_pagamento, $external, $status, "_");
    }
    
    $html= $payment;
    pesquisaPagamento($id_pagamento, $token);
    
    $write=fwrite($fp, $html);
    fclose($fp);


    function pesquisaPagamento($valor, $token){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$valor,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS =>10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));
    
        $payment_info = json_decode(curl_exec($curl));
        curl_close($curl);
        //var_dump($payment_info);
        if(!empty($payment_info)){
            $file =fopen($valor.'log_payment_info.txt','a');
            fwrite($file, $payment_info);
            fclose($file);
        }
    
    }
?>