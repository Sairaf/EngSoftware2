<?php
session_name("PIBIC");
session_start();


if ($_POST['ano_trabalho']!=""){
	  $_SESSION['sAno']=$_POST['ano_trabalho']; 
}
elseif(!isset($_SESSION['sAno'])){
	$_SESSION['sAno'] = date("Y");
}
/* Tipos de Editais/Selecao: 
* 1 - PIBIC
* 2 - PIBIC Interior
*/

if ($_POST['tipo_edital']!=""){
	  $_SESSION['sEdital']=$_POST['tipo_edital']; 
}
elseif(!isset($_SESSION['sEdital'])){

	$_SESSION['sEdital'] = 1; 
}

require_once(dirname(__FILE__).'/main.php');
$oMain = new main();
$oMain->setAutenticado($_SESSION['sAutenticado']);
$oMain->setLogin($_SESSION['sLogin']);
$oMain->setPerfil($_SESSION['sPerfil']);
$oMain->setId($_SESSION['sId']);
$oMain->setPagina($_GET[pagina]);
$oMain->index();
?>