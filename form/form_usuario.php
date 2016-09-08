<?
require("./fachada/fachada.php");
  class form_usuario(){	
	var $perfilLogado;
	
	var $id;
	
	function getPerfil(){
	   return $perfilLogado;
	}
	
	form adicionarUsuario(){
	   <form action="?action_formProduto.php method="post" name="form1">
	    <td> Nome do produto: <input type="text" id="nomeProduto" name="nome" value=""> 
		       Idade: <input type="text" id="idade" name="idade" value=""> </td>
	   </form> 
	    
	    
		//Criar opção para anexar imagem
	        <input type="submit" name="submit" value="submit">
	}
	
	function infoUsuario($id){
		$fachada = new Fachada();
		$prod = $fachada->getProdutoId($id);
		
		if($prod){
			//adicionar fabricante e data de registro na tabela produto e no class_produto
		   $nome = $prod->getNome();
		   $idade = $prod->getDescricao();

		}else{
		//clocar uma mensagem de erro aqui e redirecionar para a página 
		}
	}
	
?>
