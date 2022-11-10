<?php
include_once('config.php');
include_once('dao_wp.php'); 
require_once('../../../wp-load.php'); ?>
<html>
<head>
<title>Controle Kit Congressista</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
h1, h2, h3{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


/* follow me template */
.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #fff;
}
.made-with-love i {
  font-style: normal;
  color: #F50057;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #fff;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
</style>
</head>
<section>
	<div>
	<img src="images/logoCoramDeo2.png" width="300" height="68" border="0" alt="" align="center"></a></td>
		<!--GERAL INSCRITOS-->
		<?php
			global $wpdb;
			$inscricao = TABLE_INSCRICAO;
			$kit = TABLE_KIT;
			$resultado = $wpdb->get_results("SELECT inscricao.id, inscricao.nome, inscricao.cpf, inscricao.igreja FROM $inscricao inscricao left join $kit kit on inscricao.id=kit.id_inscricao WHERE kit.id_inscricao is null");
			$quantidade = count($resultado);
			
			
		    if(isset($_GET['pegouKit'])){
		        $id = (int)$_GET['pegouKit'];
            	
            	global $wpdb;
                $wpdb->insert(TABLE_KIT, array(
                    'datacadastro' => date('Y-m-d H:m:s'),
                    'id_inscricao' => $id
                ));
                if($wpdb->last_error !== ''){
                    $error = $wpdb->last_error;
                    print "<div id='error'>
                    <p class='wpdberror'><strong>WordPress database error:</strong>[$error]<br />
                    </div>";
                }
            	Header('Location: '.$_SERVER['PHP_SELF']);
            }
			
		?>
		<h3>Inscritos que NÃO pegaram o kit: <b><?php echo $quantidade?></b></h3>
		<div class="tbl-header">
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
					<th scope="col">Nome</th>
					<th scope="col">CPF</th>
					<th scope="col">Igreja</th>
					<th scope="col">Kit Congressista</th>
					</tr>
				</thead>
			</table>
		</div>
		
		<div class="tbl-content">
			<table cellpadding="0" cellspacing="0" border="0">
			<tbody>
				<?php foreach ($resultado as $valor): ?>
				<tr>
					<th scope="row"><?php echo $valor->nome;?></th>
					<td><?php echo $valor->cpf;?></td>
					<td><?php echo $valor->Igreja;?></td>
					<td><a href="?pegouKit=<?php echo $valor->id;?>" class="button">Pegou o kit?</a></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		    </table>
		</div>
		
		<?php
			global $wpdb;
			$inscricao = TABLE_INSCRICAO;
			$kit = TABLE_KIT;
			$resultado = $wpdb->get_results("SELECT inscricao.id, inscricao.nome, inscricao.cpf, inscricao.igreja FROM $inscricao inscricao inner join $kit kit on inscricao.id=kit.id_inscricao");
			$quantidade = count($resultado);
		?>
		<h3>Inscritos que pegaram o kit: <b><?php echo $quantidade?></b></h3>
		<div class="tbl-header">
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
					<th scope="col">Nome</th>
					<th scope="col">CPF</th>
					<th scope="col">Igreja</th>
					</tr>
				</thead>
			</table>
		</div>
		
		<div class="tbl-content">
			<table cellpadding="0" cellspacing="0" border="0">
			<tbody>
				<?php foreach ($resultado as $valor): ?>
				<tr>
					<th scope="row"><?php echo $valor->nome;?></th>
					<td><?php echo $valor->cpf;?></td>
					<td><?php echo $valor->Igreja;?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		    </table>
		</div>
		
	</div>
</section>

<div class="made-with-love">
  Made with
  <i>♥</i> by
  <a target="_blank" href="https://github.com/simeilucas">Simei Lucas</a>
</div>