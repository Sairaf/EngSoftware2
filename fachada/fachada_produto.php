<?
require_once('./class/class_produto.php');
require_once('./fachada/conexao_bd.php');
	class fachada_produto{
		
		var $conexao;
		
		function fachada_produto(){
			$conexao = new conexaoBD();
		}
		
		function produto($a,$b,$c,$d){
			$Produto = new produto($a,$b,$c,$d);
			return $Produto;
		}
		
		function inserir($nomeProduto,$descricao,$preco){
			$sql = "INSERT INTO `produto`(`nomeProduto`, `descricao`, `preco`) VALUES ($nomeProduto,$descricao,$preco)";
			$this->conexao->executarSQL($sql);
		}
		
		function mostrarProdutos(){
			$sql="SELECT * FROM `produto`";
			$this->conexao->executaSQL($sql);
			$vetor=$this->oConexao->vetor();
			if($vetor) {
				$vProduto= array();
				while($vProduto= array_shift($vetor)) {
					$oProduto = new produto($vProduto[idProduto],$vProduto[nomeProduto],$vProduto[descricao],$vProduto[preco]);
					$vetProduto[] = $oProduto;
				}	
				return $oProduto;
      	} else     	return false; 
		}
		
		function mostrarProdutosId($id){
			$sql="SELECT * FROM `produto` where id=$id";
			$this->conexao->executaSQL($sql);
			$vetor=$this->oConexao->vetor();
			if($vetor) {
				$vProduto = array_shift($vetor); 
				$oProduto = new produto($vProduto[idProduto],$vProduto[nomeProduto],$vProduto[descricao],$vProduto[preco]);
        	return $oProduto;
      	} else     	return false; 
		}
	}
?>