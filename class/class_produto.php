<?
	class produto{
		var $id;
		var $nomeP;
		var $fabricante;
		var $preco;
		var $descricao;
		var $dataRegistro;
		var $tipoProduto;
		
		function produto($a,$b,$c,$d,$e,$f,$g){
			$id = $a;
			$nomeP = $b;
			$preco = $c;
			$descricao = $d;
			$fabricante = $e;
			$dataRegistro = $f;
			$tipoProduto = $g;
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
		
		
		function setFabricante($a){
			$fabricante = $a;
		}
		
		function setData($a){
			$data = $a;
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
		
		function getrFabricante(){
			return $fabricante;
		}
		
		function getData(){
			return $data;
		}
	}
