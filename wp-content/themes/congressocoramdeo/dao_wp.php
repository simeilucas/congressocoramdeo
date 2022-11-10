<?php
include_once("vendor/autoload.php");
include_once('config.php');

function gravarInscricao($user_nome,$user_email,$tel_formatado,$user_idade, $user_igreja,$user_cpf,$dia_um,$dia_dois,$dia_tres,$dia_quatro,$dia_cinco,$ext){
    global $wpdb;
    $wpdb->insert(TABLE_INSCRICAO, array(
        'nome' => $user_nome,
        'email' => $user_email,
        'telefone' => $tel_formatado,
        'igreja'  => $user_igreja,
        'cpf' => $user_cpf,
        'idade' => $user_idade,
        'datacadastro' => date('Y-m-d H:m:s'),
        'dia_quatro' => $dia_um,
        'dia_cinco_manha' => $dia_dois,
        'dia_cinco_noite' => $dia_tres,
        'dia_seis_manha' => $dia_quatro,
        'dia_seis_noite' => $dia_cinco,
        'id_compra' => $ext
    ));

    if($wpdb->last_error !== ''){
        $error = $wpdb->last_error;

        print "<div id='error'>
        <p class='wpdberror'><strong>WordPress database error:</strong>[$error]<br />
        </div>";
    }
}

function gravarPagamento($ext, $qtde_pagamentos, $valor){
    global $wpdb;
    $wpdb->insert(TABLE_PAGAMENTO, array(
        'id_compra' => $ext,
        'data_cadastro' => date('Y-m-d H:m:s'),
        'valor' => $valor,
        'qtde_pagamentos' => $qtde_pagamentos
    ));
    if($wpdb->last_error !== ''){
        $error = $wpdb->last_error;

        print "<div id='error'>
        <p class='wpdberror'><strong>WordPress database error:</strong>[$error]<br />
        </div>";
    }
}

function obtemQtdeValorInscricao($id_compra){
    global $wpdb;
    $tabela = TABLE_INSCRICAO;
    $resultado = $wpdb->get_results("SELECT * FROM $tabela inscricao WHERE inscricao.id_compra = $id_compra");
    return $resultado;
}

function obtemRegistroEmail($id_inscricao, $id_mercadopago){
    global $wpdb;
    $tabela = TABLE_EMAIL;
    $resultado = $wpdb->get_results("SELECT * FROM $tabela email WHERE email.id_inscricao = $id_inscricao and email.id_mercadopago = $id_mercadopago");
    return $resultado;
}


function gravaRegistroEmail($id_inscricao, $id_mercadopago){
    global $wpdb;
    
    $pesquisa_email = obtemRegistroEmail($id_inscricao, $id_mercadopago);
    if(empty($pesquisa_email) && $pesquisa_email == null){
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
}

function obtemCPF($cpf){
    global $wpdb;
    $tabela = TABLE_INSCRICAO;
    $resultado = $wpdb->get_results("SELECT * FROM $tabela inscricao WHERE inscricao.cpf = $cpf");
    return $resultado;
}




