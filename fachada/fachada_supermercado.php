require_once('./class/class_supermercado.php');
require_once('./fachada/conexao_bd.php');
	class fachada_supermercado{
		
		var $conexao;
		
		function fachada_supermercado(){
			$conexao = new conexaoBD();
		}
		
		function supermercado($a,$b,$c,$d,$e,$f){
			$Super = new supermercado($a,$b,$c,$d,$e,$f);
			return $Super;
		}
		
	}
