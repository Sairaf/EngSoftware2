<?
require("./fachada/fachada.php");

  class form_produto(){	
	var $perfilLogado;
	
	var $id;
	
	function getPerfil(){
	   return $perfilLogado;
	}
	
	function listarProdutos($nome){
		$fachada = new fachada();
		$listaProdutos = $fachada->listaProdutosNome($nome);
		if($listaProdutos){
		?>
		<html>
		<p>Pesquisa de produtos</p>
				
			
		</html>
		<?
		}else{
			
		}

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
	//Criar opção para anexar imagem
	?>  
	  <body>		
	  <div id="fb-root"></div>
		<script>
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7";
					fjs.parentNode.insertBefore(js, fjs);
				}
				(document, 'script', 'facebook-jssdk'));
		</script>
	  <form action="form_produto.php" method="post" name="form1">
	    <br> 
		 <p>Nome do produto: </p><input type="text" id="nomeProduto" name="nome" value=""> <br>
		 <p>Descricao: </p><input type="text" id="nomeProduto" name="descricao" value=""> </br>
		 <p>Fabricante: </p><input type="text" id="Fabricante" name="fabricante" value=""> </br>
		 <p>Data de Registro : </p><input type="text" id="nomeProduto" name="" value=""><?/*Date*/?> </br>
	     <p>Preco: </p><input type="text" id="nomeProduto" name="preco" value=""> </br>
	    
	    
		
	      <input type="submit" name="submit" value="Enviar">
		  <input type="hidden" name="cadastro" value="cadastro">
	  </form>
	  
	<?
	echo $_POST["nomeProduto"];
		if(empty($_POST['nomeProduto'])){
			?><p> OI</p><?
		}
	  }
  }
?>
