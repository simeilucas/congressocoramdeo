<?php
 include_once("vendor/autoload.php");
 include_once('config.php');
 include_once('dao_wp.php');
 	   
 global $valor;
 global $quantidade;
 global $id_compra;

 if(($_COOKIE["id_compra"] == null) || (empty($_COOKIE["id_compra"]))){
	$id_compra = rand(1, 999999);
	setcookie("id_compra",  $id_compra, time()+3600, "/", URL);
 }
 
//Tem que fazer validacao se a pessoa vai apenas no domingo, se sim não paga!
	if(!empty($_POST['botaoPagar'])){
		

		$user_nome = sanitize_text_field($_POST['user_nome']);
		$user_email = sanitize_text_field($_POST['user_email']);		
		$user_telefone = sanitize_text_field($_POST['user_telefone']);
		$tel_formatado = limpaCampo($user_telefone);
		$user_igreja = sanitize_text_field($_POST['user_igreja']);
		$user_cpf = sanitize_text_field($_POST['user_cpf']);
		$user_cpf = limpaCampo($user_cpf);
		$user_idade = sanitize_text_field($_POST['user_idade']);

		$todos_dias = isset($_POST['todos_dias']);
		$dia_um = isset($_POST['dia_um'])? 1 : 0;
		$dia_dois = isset($_POST['dia_dois'])? 1 : 0;
		$dia_tres = isset($_POST['dia_tres'])? 1 : 0;
		$dia_quatro = isset($_POST['dia_quatro'])? 1 : 0; 
		$dia_cinco = isset($_POST['dia_cinco'])? 1 : 0;

	   if($todos_dias == 1){
		   $dia_um = $todos_dias;
		   $dia_dois = $todos_dias;
		   $dia_tres = $todos_dias;
		   $dia_quatro = $todos_dias;
		   $dia_cinco = $todos_dias;
	   }

        if(($_COOKIE["id_compra"] == null) || (empty($_COOKIE["id_compra"]))){
			$id_compra = rand(1, 999999);
			setcookie("id_compra",  $id_compra, time()+3600, "/", URL);
			echo "ID da compra botao pagamento no cookie".$_COOKIE["id_compra"]; 
		}

       if((!$_COOKIE["id_compra"] == null) || (!empty($_COOKIE["id_compra"]))){
    	   if(isCPFNaoCadastrado($user_cpf)){
        	   gravarInscricao($user_nome,$user_email,$tel_formatado,$user_idade, $user_igreja,$user_cpf,$dia_um,$dia_dois,$dia_tres,$dia_quatro,$dia_cinco, $_COOKIE["id_compra"]);
        	   criarPagamento($_COOKIE["id_compra"]);
        	   realizaCadastroDisparoEmail($_COOKIE["id_compra"]);
        	   mensagemCadastro($user_nome);
        	   setcookie("id_compra",  $id_compra, time()-3600, "/", URL);
        	   //exit;
    	   }
       }else{
           echo 'Ocorreu um erro na sua inscrição. Teste novamente abrindo o site na Navegação anônima';
       }
	   
	}

	if(!empty($_POST['botaoCadastrar'])){
		//grava os dados do usuário


		$user_nome = sanitize_text_field($_POST['user_nome']);
		$user_email = sanitize_text_field($_POST['user_email']);		
		$user_telefone = sanitize_text_field($_POST['user_telefone']);
		$tel_formatado = limpaCampo($user_telefone);
		$user_igreja = sanitize_text_field($_POST['user_igreja']);
		$user_cpf = sanitize_text_field($_POST['user_cpf']);
		$user_cpf = limpaCampo($user_cpf);
		$user_idade = sanitize_text_field($_POST['user_idade']);

		$todos_dias = isset($_POST['todos_dias']);
		$dia_um = isset($_POST['dia_um'])? 1 : 0;
		$dia_dois = isset($_POST['dia_dois'])? 1 : 0;
		$dia_tres = isset($_POST['dia_tres'])? 1 : 0;
		$dia_quatro = isset($_POST['dia_quatro'])? 1 : 0;
		$dia_cinco = isset($_POST['dia_cinco'])? 1 : 0;

	   if($todos_dias == 1){
		   $dia_um = $todos_dias;
		   $dia_dois = $todos_dias;
		   $dia_tres = $todos_dias;
		   $dia_quatro = $todos_dias;
		   $dia_cinco = $todos_dias;
	   }
	   
	   		
	    if(($_COOKIE["id_compra"] == null) || (empty($_COOKIE["id_compra"]))){
			$id_compra = rand(1, 999999);
			setcookie("id_compra",  $id_compra, time()+3600, "/", URL);
			echo "ID da compra botao cadastrar".$_COOKIE["id_compra"]; 
		}
		
	   if((!$_COOKIE["id_compra"] == null) || (!empty($_COOKIE["id_compra"]))){
	       if(isCPFNaoCadastrado($user_cpf)){
        	   gravarInscricao($user_nome,$user_email,$tel_formatado,$user_idade, $user_igreja,$user_cpf,$dia_um,$dia_dois,$dia_tres,$dia_quatro,$dia_cinco, $_COOKIE["id_compra"]);
        	   realizaCadastroDisparoEmail($_COOKIE["id_compra"]);
        	   mensagemCadastro($user_nome);
	       }
	   }else{
	       echo 'Ocorreu um erro na sua inscrição. Teste novamente abrindo o site na Navegação anônima';
	   }
	}

	function limpaCampo($valor_campo){
		$valor_campo = trim($valor_campo);
		$valor_campo = str_replace(".", "", $valor_campo);
		$valor_campo = str_replace(",", "", $valor_campo);
		$valor_campo = str_replace("-", "", $valor_campo);
		$valor_campo = str_replace("/", "", $valor_campo);
		$valor_campo = str_replace("(","", $valor_campo);
		$valor_campo = str_replace(")","", $valor_campo);
		return $valor_campo;
	}

	function criarPagamento($ext){
		if(IS_SANDBOX){
			MercadoPago\SDK::setAccessToken(ACCESS_TOKEN_SANDBOX); 
		}else{
			MercadoPago\SDK::setAccessToken(ACCESS_TOKEN); 
			MercadoPago\SDK::setClientId(CLIENT_ID); 
			MercadoPago\SDK::setClientSecret(CLIENT_SECRET); 
		}
		
		$inscritos = obtemQtdeValorInscricao($ext);
		$quantidade = count($inscritos);
		$valor_dinheiro = VALOR_CONGRESSO * $quantidade;

		$preference = new MercadoPago\Preference();

		$nomes = "";

		$payer = new MercadoPago\Payer();
		foreach($inscritos as $valor){
			$id = 1;
			$nomes = $nomes."\n".$valor->nome;
			
			$tel = $valor->telefone;

			if(empty($payer->email) || $payer->email == null){
				$payer->email = $valor->email;
				$payer->name = $valor->nome;
				$payer->identification = array(
					"type" => 'CPF',
					"number" => $valor->cpf
				);
				$payer->phone = array(
					"area_code" => substr($tel, 0, 2),
					"number" => substr($tel, 2, strlen($tel))
				);
			}
		}
		$preference->payer = $payer;

		$item1 = new MercadoPago\Item();
		$item1->id = 1;
		$item1->title = "Inscrição Congresso Coram Deo: ".$nomes; 
		$item1->quantity = $quantidade;
		$item1->unit_price = VALOR_CONGRESSO;
		$item1->currency_id = "BRL";
	
		$preference->items = array($item1);



		#Formas de pagamento não aceitas
		$preference->payment_methods = array(
			"excluded_payment_types" => array(
				array("id" => "credit_card"),
				array("id" => "ticket"),
				array("id" => "digital_currency"),
				array("id" => "digital_wallet"),
				array("id" => "debit_card")
			),
			"installments" => 12
		);	

		$preference->external_reference = $ext;
		$preference->auto_return = "approved";
		$preference->statement_descriptor = "CONGRESSO CORAM DEO";
		
    	$preference->date_of_expiration = "2022-11-05T22:00:00.000-04:00";

		if(IS_SANDBOX){
			$preference->back_urls = array(
				"success" => URL_SUCCESS_SANDBOX,
				"failure" => URL_FAILURE_SANDBOX,
				"pending" => URL_PENDING_SANDBOX
			);
			$preference->notification_url = NOTIFICATION_URL_SANDBOX;
		}else{
			$preference->back_urls = array(
				"success" => URL_SUCCESS,
				"failure" => URL_FAILURE,
				"pending" => URL_PENDING
			);
			$preference->notification_url = NOTIFICATION_URL;
		}
		$preference->save(); 
		

		gravarPagamento($ext, $quantidade, $valor_dinheiro);
		//chamarChekout($preference);
	}

	function chamarChekout($preference){
		if(IS_SANDBOX){
			wp_redirect( $preference->sandbox_init_point );
		}else{
			wp_redirect( $preference->init_point );
		}
	}
	
	function realizaCadastroDisparoEmail($id_mercadopago){
		$result = obtemQtdeValorInscricao($id_mercadopago);
		if(!empty($result) && $result != null){
			foreach($result as $inscricao){
				$id_inscricao = $inscricao->id;
				if(!empty($id_inscricao) && $id_inscricao != null){
					gravaRegistroEmail($id_inscricao, $id_mercadopago);
				}
			}
		}
		
	}
	
	function mensagemCadastro($nome){
		echo '<div class="msg-alertas">'.
		'<span class="ms ok" id="span_ok"><i class="icon icon-users-1"></i>Inscrição de <b>'.$nome.'</b> realizada com sucesso!!!</span>'.
		'</div>';
	}

	function mensagemCPFCadastrado($cpf){
		echo '<div class="msg-alertas">'.
		'<span class="ms erro"><i class="icon icon-hand-paper-o"></i>O CPF <b>'.$cpf.'</b> já foi cadastrado.</span>'.
		'</div>';
	}

	function mensagemCadastroApenasDomingo($nome){
		echo '<div class="msg-alertas">'.
		'<span class="ms info"><i class="icon icon-info-1"></i><b>'.$nome.'</b> não precisa pagar, pois vai participar apenas no domingo</span>'.
		'</div>';
	}

	function isCPFNaoCadastrado($user_cpf){
		$retorno = true;
		if($user_cpf != '04937645188'){
			$result = obtemCPF($user_cpf);
			$quantidade = count($result);

			if($quantidade > 0){
				mensagemCPFCadastrado($user_cpf);
				$retorno = false;
			}
		}
		return $retorno;
	}



	
