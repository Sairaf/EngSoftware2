<?
require_once('./class/class_usuario.php');
require_once('./fachada/conexao_bd.php');

class fachada_usuario(){
		var $conexao;
		
		function fachada_supermercado(){
			$conexao = new conexaoBD();
		}
		
		function supermercado($a,$b,$c,$d,$e,$f){
			$Super = new supermercado($a,$b,$c,$d,$e,$f);
			return $Super;
		}
}
?>