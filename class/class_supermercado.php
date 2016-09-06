<?
	class supermercado{
		private var $id;
		private var $nomeSupermercado;
		private var $descricao;
		
		function supermercado($a,$b,$c){
			$id = $a;
			$nomeSupermercado = $b;
			$descricao =  $c;
		}
		
		
		function setNome($a){
			$nomeSupermercado = $a
		}
		
		function setDescricao($a){
			$descricao = $a;
		}
		
		function getNome(){
			return $nomeSupermercado;
		}
		
		function getDescricao(){
			return descricao
		}
	}
?>
