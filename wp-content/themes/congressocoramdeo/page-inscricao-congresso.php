<?php
/**
 * Template Name: congresso coram deo
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<style>
input[type="submit"]:disabled {
  background: #ccc;
}
.msg-alertas{ 
     width:100%; 
     overflow:hidden; 
     margin:0 auto; 
     padding:10px; 
     background-color:#FFFFFF; 
} 
.ms{ 
    width:100%; 
    margin:auto;  
    padding:1em; 
    float:left; 
    display:block; 
    margin-bottom:10px;
    font-family:Verdana, Arial, Helvetica, sans-serif; 
    font-weight:100; 
    font-size:16px;
}
	 
.erro   { background-color:#FFCACA; border:2px #a60202 solid; color:#a60202; border-radius:5px; }
.ok     { background-color:#A6FFBC; border:2px #00bd00 solid; color:#00bd00; border-radius:5px; }
.info   { background-color:#B3E7FF; border:2px #018ace solid; color:#018ace; border-radius:5px; }
/*input:invalid {
    background-color: ivory;
    border: none;
    outline: 2px solid red;
    border-radius: 5px;
}*/

</style>
<div class="container">
	</br>	
	<h1>Inscrição Congresso <i>CoramDeo</i> 2022</h1>
	</br>
	<h5>Olá! Ficamos felizes com o seu interesse em participar do Congresso Coram Deo 2ª Edição! Para realizar a sua inscrição, preencha os campos a seguir e nos conte mais sobre você. Usaremos essas informações para, com a permissão de Deus, proporcionar a melhor experiência possível para você. Nos encontramos em novembro!</h5>
	</br>

	<form method="post">
		<div class="input-group">
			<label>Seu Nome Completo: </label><br />
			<input type="text" name="user_nome" class="form-control" size="60" required>
		</div>
		</br>
		<div class="input-group">
			<label>Seu E-mail: </label><br />
			<input type="email" name="user_email" class="form-control" size="60" required>
		</div>
		</br>
		<div class="input-group">
			<label>Número de Celular: </label><br />
			<input type="tel" name="user_telefone" maxlength="14" minlength="13" class="form-control" size="60" onkeydown="javascript: fMasc( this, mTel );" required>
		</div>
		</br>
		<div class="input-group">
			<label> Digite seu CPF: </label>  <br />
			
			<input type="text" id="user_cpf" maxlength="14" minlength="11" name="user_cpf" class="form-control" size="60" maxlength="14" 
			onkeydown="javascript: fMasc( this, mCPF );" onBlur="validaCPF()" required>
			</br>
			<span id='cpf_invalido' style='display: none; color: red;'>CPF Inválido.</span>
		</div>
		</br>
		<div class="input-group"> 
			<label>Digite sua Idade: </label> <br />
			<input type="text" name="user_idade" class="form-control" size="13" maxlength="2">
		</div>
		</br>
		<div class="input-group">
			<label>Sua Igreja: </label><br />
			<input type="text" name="user_igreja" class="form-control" size="60" required>
		</div>
		</br>
		</br>
		<div class="input-group">
			<label><b>Em quais dias você estará no Congresso <i>CoramDeo</i> ? </b></label>
			</br>
				<input type="checkbox" name="todos_dias" value="todos_dias" id="todos_dias" onClick="disableAlternativas()">
				<label>Todos os dias</label>
				</br>
				<input type="checkbox" name="dia_um" value="04/11" id="04/11">
				<label>04/11 - Sexta feira;</label>
				</br>
				<input type="checkbox" name="dia_dois" value="05/11_manha" id="05/11_manha">
				<label>05/11 - Sábado de manhã (Café da manhã);</label>
				</br>
				<input type="checkbox" name="dia_tres" value="05/11_noite" id="05/11_noite">
				<label>05/11 - Sábado à noite;</label>
				</br>
				<input type="checkbox" name="dia_quatro" value="06/11_manha" id="06/11_manha">
				<label>06/11 - Domingo de manhã (EBD); </label>
				</br>
				<input type="checkbox" name="dia_cinco" value="06/11_noite" id="06/11_noite">
				<label>06/11 - Domingo à noite (Culto);</label>

		</div>
		</br>
		</br>
		<div class="input-group">
			<label><b>Vai fazer apenas sua inscrição ou vai fazer mais alguma: <i>esposo(a), filhos...</i>? </b></label>
			</br>
			
			<label><small>*Faça a inscrição do seu esposo(a) ou familiar pois não é possivel realizar mais de um PIX de mesmo valor num mesmo dia. Assim vai gerar apenas uma cobrança.</small></label>
			</br>
			<input type="radio" name="inscricao" value="unica_inscricao" id="unica_inscricao" onClick="habilitaPagamento()">
			<label>Seguir para Pagamento;</label></br>
			
			<input type="radio" name="inscricao" value="outra_inscricao" id="outra_inscricao" onClick="habilitaPagamento()">
			<label>Realizar mais uma inscrição (Familiar);</label></br>
			
		</div>
		</br>
		<div class="input-group">
			<input type="submit" disabled title="Você será redirecionado para o link de Pagamento do Mercado Pago para fazer seu PIX" name="botaoPagar" id="botaoPagar" value="Efetuar Pagamento" class="form-control btn btn-danger"></input>
			<input type="submit" disabled title="Caso queira realizar a inscrição de outra pessoa" name="botaoCadastrar" id="botaoCadastrar" value="Realizar outra inscrição" >
		</div>
		</br>
		</br>

	</form>	

<!-- Script de máscara de campos--> 
<script type="text/javascript">
			function fMasc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}
			function mTel(tel) {
				tel=tel.replace(/\D/g,"")
				tel=tel.replace(/^(\d)/,"($1")
				tel=tel.replace(/(.{3})(\d)/,"$1)$2")
				if(tel.length == 9) {
					tel=tel.replace(/(.{1})$/,"-$1")
				} else if (tel.length == 10) {
					tel=tel.replace(/(.{2})$/,"-$1")
				} else if (tel.length == 11) {
					tel=tel.replace(/(.{3})$/,"-$1")
				} else if (tel.length == 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				} else if (tel.length > 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				}
				return tel;
			}
			function mCNPJ(cnpj){
				cnpj=cnpj.replace(/\D/g,"")
				cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
				cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
				cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
				cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
				return cnpj
			}
			function mCPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
			function mCEP(cep){
				cep=cep.replace(/\D/g,"")
				cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
				cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
				return cep
			}
			function mNum(num){
				num=num.replace(/\D/g,"")
				return num
			}

			function habilitaPagamento(){
				
				if(document.getElementById('unica_inscricao').checked == true){
					document.getElementById('botaoPagar').disabled=false
					//document.getElementById('outra_inscricao').checked = false
				}else{
					document.getElementById('botaoPagar').disabled=true
					//document.getElementById('outra_inscricao').checked = true
				}

				if(document.getElementById('outra_inscricao').checked == true){
					document.getElementById('botaoCadastrar').disabled=false
					//document.getElementById('unica_inscricao').checked = false
				}else{
					document.getElementById('botaoCadastrar').disabled=true
					//ocument.getElementById('unica_inscricao').checked = true
				}
			}

			function disableAlternativas() {
				if(document.getElementById('todos_dias').checked ==true){
					document.getElementById('04/11').disabled=true
					document.getElementById('04/11').checked=false
					document.getElementById('05/11_manha').disabled=true
					document.getElementById('05/11_manha').checked=false
					document.getElementById('05/11_noite').disabled=true
					document.getElementById('05/11_noite').checked=false
					document.getElementById('06/11_manha').disabled=true
					document.getElementById('06/11_manha').checked=false
					document.getElementById('06/11_noite').disabled=true
					document.getElementById('06/11_noite').checked=false
				}else{
					document.getElementById('04/11').disabled=false
					document.getElementById('05/11_manha').disabled=false
					document.getElementById('05/11_noite').disabled=false
					document.getElementById('06/11_manha').disabled=false
					document.getElementById('06/11_noite').disabled=false
				}
 			}

			function invalidaCPF(validador){
				let cpfInvalido = document.getElementById('cpf_invalido');
				let value_cpf = document.querySelector('#user_cpf');

				if(validador){
					cpfInvalido.style.display = "inline";
					value_cpf.style.outline= "2px solid red";
					//value_cpf.setAttribute("aria-invalid", "true");
					value_cpf.setAttribute("isvalid", "false");
				}else{
					cpfInvalido.style.display = "none";
					value_cpf.style.outline= "1px solid grey";
					value_cpf.setAttribute("isvalid", "true");
				}
			}

			function validaCPF(){
				let value_cpf = document.querySelector('#user_cpf');

				//Remove tudo o que não é dígito
				let validar_cpf = value_cpf.value.replace( /\D/g , "");
		
				//verificação da quantidade números
				// verificação de CPF valido
				var Soma;
				var Resto;
		
				Soma = 0;
				for (i=1; i<=9; i++) Soma = Soma + parseInt(validar_cpf.substring(i-1, i)) * (11 - i);
				Resto = (Soma * 10) % 11;
		
				if ((Resto == 10) || (Resto == 11))  Resto = 0;
				if (Resto != parseInt(validar_cpf.substring(9, 10)) ){
					invalidaCPF(true);
				}else{
					invalidaCPF(false);
				}
	
				Soma = 0;
				for (i = 1; i <= 10; i++) Soma = Soma + parseInt(validar_cpf.substring(i-1, i)) * (12 - i);
				Resto = (Soma * 10) % 11;
	
				if ((Resto == 10) || (Resto == 11))  Resto = 0;
				if (Resto != parseInt(validar_cpf.substring(10, 11) ) ) {
					invalidaCPF(true);
				}else{
					invalidaCPF(false);
				}
		
				//formatação final
				cpf_final = validar_cpf.replace( /(\d{3})(\d)/ , "$1.$2");
				cpf_final = cpf_final.replace( /(\d{3})(\d)/ , "$1.$2");
				cpf_final = cpf_final.replace(/(\d{3})(\d{1,2})$/ , "$1-$2");
				document.getElementById('campo_cpf').value = cpf_final;
				return retorno;
			}

		</script>

<?php get_footer(); ?>
