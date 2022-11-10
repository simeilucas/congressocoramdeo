<?php
include_once('config.php');
include_once('dao_wp.php'); 
require_once('../../../wp-load.php'); ?>
<html>
<head>
<title>Inscrições Não Pagas</title>
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
		<!--INSCRICOES AINDA NÃO PAGAS-->
		<?php
		global $wpdb;
		$inscricao = TABLE_INSCRICAO;
		$pagamento = TABLE_PAGAMENTO;
		$result = $wpdb->get_results("SELECT * FROM $inscricao inscricao inner join $pagamento pagamento on pagamento.id_compra=inscricao.id_compra WHERE pagamento.status_pagamento not like '%paid%' or pagamento.status_pagamento is null ORDER BY id DESC");
		$quantidade = count($result)
		?>
		
		
		<h3>Lista de quem não pagou ainda: <b><?php echo $quantidade?> inscrições ainda não pagas</b></h3>
		
		<?php
            if(isset($_GET['updatePagamento'])){
		        $id = (int)$_GET['updatePagamento'];
            	
            	global $wpdb;
            	$pagamento = TABLE_PAGAMENTO;
            	$wpdb->update($pagamento, array('status_pagamento'=>'paid'), array('id_compra'=>$id));
            	Header('Location: '.$_SERVER['PHP_SELF']);
            	echo 'ID '.$id.' atualizado';
            }
    	?>
		
		<div class="tbl-header">
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">Email</th>
						<th scope="col">Telefone</th>
						<th scope="col">Igreja</th>
						<th scope="col">$</th>
						<!--<th scope="col"></th>-->
					</tr>
				</thead>
			</table>
		</div>
		<div class="tbl-content">
		    <form method="post">
    			<table cellpadding="0" cellspacing="0" border="0">
    				<tbody>
    					<?php foreach ($result as $valor): ?>
    					<tr>
    						<th scope="row"><?php echo $valor->nome;?></th>
    						<td><?php echo $valor->email;?></td>
    						<td><?php echo $valor->telefone;?></td>
    						<td><?php echo $valor->igreja;?></td>
    						<td><a href="?updatePagamento=<?php echo $valor->id_compra;?>" class="button">Pagamento realizado?</a></td>
    					</tr>
    					<?php endforeach ?>
    				</tbody>
    			</table>
		    </form>
		    
		    
		</div>
	</div>
</section>

<div class="made-with-love">
  Made with
  <i>♥</i> by
  <a target="_blank" href="https://github.com/simeilucas">Simei Lucas</a>
</div>