<?php
    include_once('config.php');
    include_once('vendor/autoload.php');
    require_once('../../../wp-load.php'); 
    include_once('testeEmail.php');


initAtualizaPagamento();

function initAtualizaPagamento(){
    if(IS_SANDBOX){
        $token = ACCESS_TOKEN_SANDBOX;
    }else{
        $token = ACCESS_TOKEN; 
    }
    
    $pagamentosPen = buscaPagamentosPendentes();

    foreach($pagamentosPen as $row){
        if($row != null && !empty($row)){
            echo 'Pesquisando ID:'.$row->id_compra;
            pesquisaIdPagamentoMP($row->id_compra,  $token);
        }
    }
    
    realizaEnvioEmail();
    
}

function pesquisaIdPagamentoMP($id, $token){
    if(!empty($id)){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/merchant_orders?external_reference='.$id,
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
        
        if(!empty($payment_info)){
			$elements = $payment_info->elements[0];
			if($elements!=null){
                $status_pagamento = $elements->order_status;
                $status_pedido = $elements->status;
                
                $payments = $elements->payments[0];
                $id_mercadopago = $payments->id;
                
                echo 'Retorno da API: ID'.$id.', ID MP: '.$id_mercadopago;
                atualizaStatusPagamento($id, $id_mercadopago, $status_pagamento, $status_pedido);
			}
        }
    }
}

function buscaPagamentosPendentes(){
    global $wpdb;
    $tabela = TABLE_PAGAMENTO;
    $resultado = $wpdb->get_results("SELECT * FROM $tabela pagamento WHERE pagamento.status_pagamento not like '%paid%' or pagamento.status_pagamento is null");
    return $resultado;
}


function atualizaStatusPagamento($id_compra, $id_MP, $status, $status_pedido){
    global $wpdb;
    $table_name = TABLE_PAGAMENTO;
    
    if(!empty($id_compra) && !empty($id_MP) &&  !empty($status) && !empty($status_pedido)){
        echo 'Update do id: '.$id_compra.', id do MP:'.$id_MP;
    
        $data = array(
            'status_pagamento'=>$status,
            'id_mercadopago'=>$id_MP,
            'status_pedido'=>$status_pedido
        );
        
        $conditon = array('id_compra' => $id_compra);
        
        $wpdb->update($table_name, $data, $conditon);
    }else{
        print "<div id='error'>
        <p class='wpdberror'><strong>Os campos id_compra e id_MP estão vazios</strong><br />
        </div>";
    }
    
    if($wpdb->last_error !== ''){
        $error = $wpdb->last_error;

        print "<div id='error'>
        <p class='wpdberror'><strong>WordPress database error:</strong>[$error]<br />
        </div>";
    }
}

function obterInscricoes(){
    global $wpdb;
    $tabela = TABLE_INSCRICAO;
    $resultado = $wpdb->get_results("SELECT * FROM $tabela inscricao WHERE 1");
    foreach($resultado as $inscricao){
        if($inscricao!=null && !empty($inscricao)){
            echo nl2br('Gravando:'.$inscricao->id.'--'.$inscricao->id_compra);
            registroEmail($inscricao->id, $inscricao->id_compra);
        }
    }
}

function registroEmail($id_inscricao, $id_mercadopago){
    global $wpdb;
    $wpdb->insert(TABLE_EMAIL, array(
        'id_inscricao' => $id_inscricao,
        'data_disparo' => date('Y-m-d H:m:s'),
        'id_mercadopago' => $id_mercadopago,
        'email_enviado' => 0
    ));
    if($wpdb->last_error !== ''){
        $error = $wpdb->last_error;

        print "<div id='error'>
        <p class='wpdberror'><strong>WordPress database error:</strong>[$error]<br />
        </div>";
    }
}

 