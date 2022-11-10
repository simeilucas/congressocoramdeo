<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    include_once('config.php');
    require_once('../../../wp-load.php'); 

    //enviarEmail("Simei Lucas", "simeilucas@gmail.com");

    function realizaEnvioEmail(){
        
        $inscricoes_pagas= obtemInscricoesPagas();
        echo 'OBTENDO INSCRICOES PAGAS';
        
        foreach($inscricoes_pagas as $inscricao){
           
           $result = obtemEmailsNaoDisparados($inscricao->id_compra);
           echo 'EMAILS NAO DISPARADOS';
           
           if($result!=null && !empty($result)){
                var_dump($result);
                foreach($result as $inscrito_email){
                    
                    if(($inscrito_email!=null && !empty($inscrito_email)) && $inscrito_email->email_enviado == "0"){
                        var_dump($inscrito_email);
                        $info_inscricoes = obtemInformacoesInscricao($inscrito_email->id_inscricao);
                        
                        foreach($info_inscricoes as $info_inscrito){
                            $nome = $info_inscrito->nome;
                            $email = $info_inscrito->email;
                            
                            if(($nome!=null && !empty($result)) && ($email!=null && !empty($email))){
                                echo nl2br('Enviando email para: '.$nome.'-'.$email);
                                enviarEmail($nome, $email);
                                atualizaTabelaEmail($info_inscrito->id_compra);  
                            }
                        }
                    }
        

                }

           }
        }
    }
    
    function obtemInscricoesPagas(){
        global $wpdb;
        $tabela = TABLE_PAGAMENTO;
        $resultado = $wpdb->get_results("SELECT * FROM $tabela pagamento WHERE pagamento.status_pagamento like '%paid%'");
        return $resultado;
    }
    
    function obtemEmailsNaoDisparados($id_mercadopago){
        global $wpdb;
        $tabela = TABLE_EMAIL;
        $resultado = $wpdb->get_results("SELECT * FROM $tabela email WHERE email.id_mercadopago = $id_mercadopago");
        return $resultado;
    }
    
    function obtemInformacoesInscricao($id){
        global $wpdb;
        $tabela = TABLE_INSCRICAO;
        $resultado = $wpdb->get_results("SELECT * FROM $tabela inscricao WHERE inscricao.id = $id");
        return $resultado;
    }
     
    function enviarEmail($nome, $email){

        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'ump3ipc@congressocoramdeo.com';                     //SMTP username
            $mail->Password   = 'Cor@mDeo123';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $mail->setFrom('ump3ipc@congressocoramdeo.com', 'Congresso CoramDeo');
            $mail->addAddress($email, $nome);     //Add a recipient
            $mail->addReplyTo('ump3ipc@congressocoramdeo.com', 'Congresso CoramDeo');
            $mail->isHTML(true);
            $mail->Subject = 'Congresso CoramDeo 2022';
            $mail->msgHTML(file_get_contents('email.html'), __DIR__);
            $mail->send();
            echo nl2br('E-mail enviado com sucesso');
            
        } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    function atualizaTabelaEmail($id_mercadopago){
        global $wpdb;
        $tabela = TABLE_EMAIL;
        $wpdb->update($tabela, array('email_enviado'=>1), array('id_mercadopago'=>$id_mercadopago));
    }

 
?>