<?php
include_once('config.php');
include_once('dao_wp.php'); 
require_once('../../../wp-load.php'); ?>
<html>
<head>
<title>Sorteio Congresso Coram Deo</title>
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
  font-size: 15px;
  color: #fff;
  text-transform: uppercase;
}

td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 15px;
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
a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
}
</style>
</head>
<section>
	<div>
	<img src="images/logoCoramDeo2.png" width="300" height="68" border="0" alt="" align="center"></a></td>

		<h3><b>Sorteio Congresso Coram Deo </b></h3>
		
		<!--<a href="https://congressocoramdeo.com/wp-content/themes/congressocoramdeo/resultadoSorteio.php" class="button">Go to Google</a>-->
		<div class="tbl-header">
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
					<th scope="col"><a href="https://congressocoramdeo.com/wp-content/themes/congressocoramdeo/resultadoSorteio.php" class="button"><h4>Realizar Sorteio</h4></a></th>
					
					</tr>
				</thead>
			</table>
		</div>
		
	</div>
</section>

<div class="made-with-love">
  Made with
  <i>♥</i> by
  <a target="_blank" href="https://github.com/simeilucas">Simei Lucas</a>
</div>