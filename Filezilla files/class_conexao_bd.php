<?php
Class conexao {
    var $pconexao;
    var $pconsulta;
	var $id_ins;
    var $user     = "pibic";
	var $password = "@#*&;.4141";
	var $bd       = "outeiro_propespteste";
	function conexao($servidor='Local'){//construtor
        switch ($servidor){
            case 'Local':
            	$this->conecta("acai.ufpa.br","$this->user","$this->password","$this->bd");
            break;
            default:
            	die("Erro ao conectar no banco de dados<b>Localhost</b>");
            break;
    }
	}
    function conecta($host, $user, $pass, $database)
   {
   		$this->pconexao = @mysql_connect($host, $user, $pass) or die("Erro ao conectar no banco de dados.");
   		@mysql_select_db($database, $this->pconexao) or die("Não pode selecionar o banco de dados");
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
