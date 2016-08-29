<?
  class form_produto(){	
	
	
	function principal(){
		
	//$edicao = "";	
		
	?>  
	   
	  <form action="?action_formProduto.php method="post" name="form1">
	    <td> Nome do produto: <input type="text" id="nomeProduto" name="nome" value=""> 
		 Descricao: <input type="text" id="nomeProduto" name="descricao" value=""> </td>
	    <td> Preco: <input type="text" id="nomeProduto" name="preco" value=""> </td>
		
	        <input type="submit" name="submit" value="submit">
	  </form>
	  
	<?
	  }
  }
?>
