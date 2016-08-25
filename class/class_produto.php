<?
	class produto{
		var $id;
		var $nomeP;		
		var $preco;
		var $descricao;
		
		function produto($a,$b,$c,$d){
			$id = $a;
			$nomeP = $b;
			$preco = $c;
			$desricao = $d;
		}
		
		function setId($a){
			$id = $a;
		}
		
		function setNomeProduto($a){
			$nomeP = $a;
		}
		
		function setPreco($a){
			$preco = $a;
		}
		
		function setDescricao($a){
			$descricao = $a;
		}
		
		function getId(){
			return $id;
		}
		
		function getNomeProduto(){
			return $nomeP;
		}
		
		function getDescricao(){
			return $descricao;
		}
		
		function getPreco(){
			return $preco;
		}
	}