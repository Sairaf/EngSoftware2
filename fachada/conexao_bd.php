<?
	class conexaoBD(){
		var $pconexao;
		var $pconsulta;
		var $id_ins;
		var $servername= "localhost";
		var $username= "Admin";
		var $password = "abner19951997";
		
		$conn = new mysqli($servername, $username, $password);
		
		if (mysqli_connect_error()) {
			die("Erro ao conectar ao banco de dados " . mysqli_connect_error());
		}
				  
	   function getconexao(){
		   return $this->pconexao;
	   }
	   function executaSQL($sql){
		   $this->pconsulta = @mysql_query($sql, $this->getconexao()) or die(mysql_error());
	   }
	   function executaTransacao($sql){
	   
		   $this->getconexao()->begin_transaction();
		   $this->pconsulta = @mysql_query($sql, $this->getconexao()) or die(mysql_error());
		   $this->getconexao()->commit();
	   }
	   function numero_linhas(){
		   return (int) mysql_num_rows($this->get_consulta());
	   }
	   function get_consulta(){
		   return $this->pconsulta;
	   }
	   function lista(){
		   return @mysql_fetch_array($this->get_consulta());
	   }
	   function id_insert(){
			return (int)mysql_insert_id($this->getconexao());
	   }
	   function resultado($linha, $campo){
			return mysql_result($this->get_consulta(), $linha, $campo);
	   }
	   function vetor() {
			while($vet = mysql_fetch_array($this->get_consulta()))
				$vetReg[] = $vet;
			return $vetReg;
	   }
	
  }
?>