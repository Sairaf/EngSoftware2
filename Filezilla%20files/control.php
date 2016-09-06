<?php
require_once(dirname(__FILE__).'/javascript.php');
require_once(dirname(__FILE__).'/fachada.php');
require_once(dirname(__FILE__).'/config.php');

class control{
	var $pId;
	var $pAutenticado;
	var $pLogin;
	var $pPagina;
	var $pPerfil;
	var $oFachada;
	var $oJavaScript;
	
	function control(){
		$this->oFachada = new fachada();
		$this->oJavaScript= new javascript();
		$this->setAutenticado($_SESSION['sAutenticado']);
		$this->setLogin($_SESSION['sLogin']);
		$this->setPerfil($_SESSION['sPerfil']);
		$this->setId($_SESSION['sId']);
		echo $pPagina;
	}
	function setId($a){
		$this->setId = $a;
	}
	function setAutenticado($auth){
		$this->pAutenticado = $auth;
	}
	function setLogin($lo){
		$this->pLogin = $lo;
	}
	function setPagina($p){
		$this->pPagina = $p;
	}
	
	function setPerfil($f){
		$this->pPerfil = $f;
	}
	function getId(){
		return $this->setId;
	}
	function getAutenticado(){
		return $this->pAutenticado;
	}
	function getLogin(){
	return $this->pLogin;
	}
	function getPagina(){
		return $this->pPagina;
	}
	
	function getPerfil(){
		return $this->pPerfil;
	}
		
	function head($menu=null,$id=null){
		require_once("ads/tema.php");
		themeheader($menu,$id);
	}
	function foot($tipo=null){
	    themefooter($tipo); 
	}
	
}
?>