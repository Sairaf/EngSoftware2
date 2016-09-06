<?
require("./fachada/fachada_produto.php");

  class form_produto(){	
	var $perfilLogado;
	
	var $id;
	
	function getPerfil(){
	   return $perfilLogado;
	}
	
	function infoProduto($id){
		$fachada = new Fachada();
		$prod = $fachada->getProdutoId($id);
		
		if($prod){
			//adicionar fabricante e data de registro na tabela produto e no class_produto
		   $nome = $prod->getNome();
		   $desc = $prod->getDescricao();
		   $fabricante = $prod->getFabricante();
		   $preco = $prod->getPreco();
		   $dataRegistro = $prod->getData();
		}else{
		//clocar uma mensagem de erro aqui e redirecionar para a página 
		}
	}
	
	
	function cadastroProduto(){
		$fachada = new Fachada();
	
	//$edicao = "";	
		
	?>  
	   
	  <form action="?action_formProduto.php method="post" name="form1">
	    <td> Nome do produto: <input type="text" id="nomeProduto" name="nome" value=""> 
		 Descricao: <input type="text" id="nomeProduto" name="descricao" value=""> </td>
		 Fabricante: <input type="text" id="Fabricante" name="fabricante" value=""> </td>
		 Data de Registro : <input type="text" id="nomeProduto" name="" value=""><?/*Date*/?> </td>
	    <td> Preco: <input type="text" id="nomeProduto" name="preco" value=""> </td>
	    
	    
		//Criar opção para anexar imagem
	        <input type="submit" name="submit" value="submit">
	  </form>
	  
	<?
	  }
  }
?>
