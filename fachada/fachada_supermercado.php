require_once('./class/class_produto.php');
require_once('./fachada/conexao_bd.php');
	class fachada_produto{
		
		var $conexao;
		
		function fachada_supermercado(){
			$conexao = new conexaoBD();
		}
		
		function supermercado($a,$b,$c,$d,$e,$f){
			$Super = new supermercado($a,$b,$c,$d,$e,$f);
			return $Super;
		}
		
	}
