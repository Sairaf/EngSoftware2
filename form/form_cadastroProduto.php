<?
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
	  <form action="form_cadastroProduto.php" method="post" name="form1">
	    <br> 
		  
		 <p><?echo $_SERVER['SERVER_NAME'];?> </p></p><input type="text" id="nomeProduto" name="nome" value=""> <br>
		 <p>Descricao: </p><input type="text" id="nomeProduto" name="descricao" value=""> </br>
		 <p>Fabricante: </p><input type="text" id="Fabricante" name="fabricante" value=""> </br>
		 <p>Data de Registro : </p><input type="text" id="nomeProduto" name="" value=""><?/*Date*/?> </br>
	     <p>Preco: </p><input type="text" id="nomeProduto" name="preco" value=""> </br>
	    
	    
		
	      <input type="submit" name="submit" value="Enviar">
		  
	  </form>
	  
	<?
		if(empty($_POST['nome'])){
			?><p> OI</p><?
		}
	 }
  