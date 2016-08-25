<?php
require_once('./classes/class_conexao_bd.php');
require_once('./classes/class_pesquisador.php');

class fachada_pesquisador {

	var $oConexao;
	
	function fachada_pesquisador(){
		$this->oConexao = new conexao();
	}
	
	
	function pesquisador($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$y){
		$oPesquisador = new pesquisador($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$y);
		return $oPesquisador;	
	}
	
	function getPesquisadoresNome(){
		$ano=$_SESSION['sAno']; 
		$sql = "SELECT pesquisador.* FROM pesquisador,"._BDPROPESP.".usuario usuario,selecao where usuario.id=pesquisador.id and selecao.codPesq=pesquisador.id and selecao.ano='$ano' ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vPesq= array();
      		while($vPesq= array_shift($vetor)) {
				$oPesquisador = new pesquisador($vPesq[id],$vPesq[titulacao],$vPesq[anoTitulacao],$vPesq[localTitulacao],$vPesq[agenciaTitulacao],$vPesq[depart],$vPesq[fone],$vPesq[codCategoria],$vPesq[codUnidade],$vPesq[codArea],$vPesq[codSubArea],$vPesq[especialidade],$vPesq[dtNascimento],$vPesq[nacionalidade],$vPesq[naturalidade],$vPesq[origem],$vPesq[flagPosGrad],$vPesq[posGrad],$vPesq[produtividade],$vPesq[flagIc],$vPesq[flagAgenciaIc],$vPesq[celular]);
				$vetPesquisador[] = $oPesquisador;
        	}
			return $vetPesquisador; 
		} else return false; 
	}
	
	function getPesquisadorId($id){
		$sql = "SELECT * FROM pesquisador WHERE id='$id'";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vPesq = array_shift($vetor); 
			$oPesquisador = new pesquisador($vPesq[id],$vPesq[titulacao],$vPesq[anoTitulacao],$vPesq[localTitulacao],$vPesq[agenciaTitulacao],$vPesq[depart],$vPesq[fone],$vPesq[codCategoria],$vPesq[codUnidade],$vPesq[codArea],$vPesq[codSubArea],$vPesq[especialidade],$vPesq[dtNascimento],$vPesq[nacionalidade],$vPesq[naturalidade],$vPesq[origem],$vPesq[flagPosGrad],$vPesq[posGrad],$vPesq[produtividade],$vPesq[flagIc],$vPesq[flagAgenciaIc],$vPesq[celular]);
        	return $oPesquisador;
      	} else     	return false; 
    }
	function getPesqNomeCpf($cpf){
		$sql = "SELECT pesquisador.id,usuario.nome FROM pesquisador,"._BDPROPESP.".usuario WHERE usuario.cpf='$cpf' and pesquisador.id=usuario.id";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vPesq = array_shift($vetor);
			return $vPesq; 
		}else return false; 
    }
	
	function getPesqUsrNomeClass($nome,$class){ 
		$ano  = $_SESSION['sAno']; 
		$tipo = $_SESSION['sEdital']; 
		$sql  = "SELECT pesquisador.id, usuario.nome, unidade.desc unidade, selecao.numBolsaAtend, pesquisador.status,selecao.statusClass 
		FROM "._BDPROPESP.".usuario usuario, outeiro_pibic.selecao, outeiro_pibic.pesquisador
		LEFT OUTER JOIN outeiro_pibic.unidade 
		ON unidade.cod = pesquisador.codUnidade 
		WHERE pesquisador.id = usuario.id  
		AND usuario.nome LIKE '%$nome%' 
		AND selecao.codPesq = usuario.id 
		AND selecao.ano='$ano' 
		AND selecao.tipo='".$tipo."' 
		AND selecao.statusClass like '$class%' 
		ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetDados=$this->oConexao->vetor();
		if($vetDados) {
			return $vetDados; 
		} else return false; 
	}

	function getPesqUsrUnidadeClass($unidade,$class){ 
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital']; 
		$sql  = "SELECT pesquisador.id, usuario.nome, unidade.desc unidade, selecao.numBolsaAtend, pesquisador.status, selecao.statusClass FROM pesquisador, "._BDPROPESP.".usuario usuario,selecao LEFT OUTER JOIN unidade on pesquisador.codUnidade = unidade.cod WHERE pesquisador.id = usuario.id  AND unidade.desc LIKE '$unidade%' and selecao.codPesq = usuario.id and selecao.ano='$ano' and selecao.tipo='".$tipo."' and selecao.statusClass like '$class%' ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetDados=$this->oConexao->vetor();
		if($vetDados) {
			return $vetDados; 
		} else return false; 
	}
	
	function getPesqUsr($codPlano){ 
		$sql="SELECT usuario.nome orientador,pesquisador.depart departamento, unidade.desc unidade FROM pesquisador, "._BDPROPESP.".usuario usuario, unidade, plano WHERE plano.cod = '".$codPlano."' and pesquisador.id = plano.codPesq and pesquisador.id = usuario.id and pesquisador.codUnidade = unidade.cod ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vetDados = array();
			$vetDados = array_shift($vetor);
			return $vetDados; 
		} else return false; 
	}
	function getPesqUsrId($id){ 
		$sql="SELECT usuario.nome orientador,pesquisador.depart departamento, unidade.desc unidade FROM pesquisador, "._BDPROPESP.".usuario usuario, unidade, plano WHERE usuario.id = '".$id."' and pesquisador.id = '".$id."' and pesquisador.codUnidade = unidade.cod";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vetDados = array();
			$vetDados = array_shift($vetor);
			return $vetDados; 
		} else return false; 
	}
	function getPesqUsrClass($class){ 
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql="SELECT pesquisador.id, usuario.nome, unidade.desc unidade, selecao.numBolsaAtend, pesquisador.status, selecao.statusClass FROM "._BDPROPESP.".usuario usuario,outeiro_pibic.selecao, outeiro_pibic.pesquisador LEFT OUTER JOIN outeiro_pibic.unidade on pesquisador.codUnidade = unidade.cod WHERE pesquisador.id = usuario.id  and selecao.codPesq = usuario.id and selecao.ano='$ano' and selecao.tipo='".$tipo."' and selecao.statusClass like '$class%' ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetDados=$this->oConexao->vetor();
		if($vetDados) {
			return $vetDados; 
		} else return false; 
	}
	
	function getStatusPesq($id){
		$sql = "SELECT status FROM pesquisador WHERE pesquisador.id= '".$id."'";
		$this->oConexao->executaSQL($sql);
		$vetDados=$this->oConexao->vetor();
		if($vetDados) {
			$vetStatus= array_shift($vetDados);
			return $vetStatus[status]; 
		} else return false; 
	}
	
	function getPesqNomeComBolsa(){
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT DISTINCT pesquisador.id, usuario.nome FROM pesquisador,selecao,"._BDPROPESP.".usuario usuario,bolsa,bolsistabolsa WHERE pesquisador.id!=30 and pesquisador.id=usuario.id and pesquisador.id=selecao.codPesq and selecao.ano=$ano and selecao.tipo=$tipo and selecao.statusClass=1 and bolsa.codPesq=pesquisador.id and bolsistabolsa.codBolsa=bolsa.cod and bolsistabolsa.dtFinal='' and bolsa.ano=$ano order by usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqSelecionado($ano,$tpSelecao){
		$sql  = "SELECT usuario.nome nome,usuario.id,selecao.numBolsaAtend FROM selecao,"._BDPROPESP.".usuario usuario WHERE usuario.id!=30 and usuario.id=selecao.codPesq and selecao.ano=$ano and selecao.tipo=$tpSelecao and selecao.statusClass=1 and selecao.numBolsaAtend >0 order by usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqSelecionadoTipo($ano,$tpSelecao,$tpBolsa){
	$sql  = "SELECT usuario.nome nome,usuario.id,selecao.numBolsaAtend FROM bolsa, selecao,"._BDPROPESP.".usuario usuario WHERE usuario.id!=30 and usuario.id=selecao.codPesq and usuario.id = bolsa.codPesq and selecao.ano=$ano and selecao.tipo=$tpSelecao and selecao.statusClass=1 and bolsa.tipo =$tpBolsa and bolsa.ano=$ano and selecao.numBolsaAtend >0 order by usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	
	function getPesqNomeAno(){ 
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT pesquisador.id, usuario.nome FROM pesquisador, "._BDPROPESP.".usuario usuario,selecao WHERE pesquisador.id = usuario.id  and selecao.codPesq = usuario.id and selecao.ano='$ano' and selecao.tipo=$tipo and selecao.statusClass =1 ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetDados=$this->oConexao->vetor();
		if($vetDados) {
			return $vetDados; 
		} else return false; 
	}
	function getPesqSelecao($id,$ano,$tipoSelecao){
		$sql = "SELECT usuario.nome nome,pesquisador.produtividade prod,pesquisador.anoTitulacao anoTitulacao FROM pesquisador,selecao,"._BDPROPESP.".usuario usuario WHERE usuario.id='".$id."' and pesquisador.id=usuario.id and selecao.codPesq=pesquisador.id and selecao.ano='$ano' and selecao.tipo='".$tipoSelecao."' ";
		$this->oConexao->executaSQL($sql);
		$vetDados=$this->oConexao->vetor();
		if($vetDados) {
			return $vetDados; 
		} else return false; 
	}
	function getPesqBolsaVaga(){
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT pesquisador.id,usuario.nome,selecao.numBolsaAtend from "._BDPROPESP.".usuario usuario,pesquisador,selecao where usuario.id=pesquisador.id and selecao.ano='$ano' and selecao.tipo='$tipo' and selecao.numBolsaAtend>0 and selecao.codPesq=pesquisador.id order by usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vPesq = array();
      		while($vPesq= array_shift($vetor)) {
				$sql = "SELECT bolsa.* from bolsa,oferta where bolsa.ano='".$ano."' and bolsa.codPesq='".$vPesq[id]."' AND oferta.codtipoEdital='".$tipo."' AND oferta.ano='$ano' AND bolsa.tipo=oferta.codTipoBolsa";
				$this->oConexao->executaSQL($sql); 
				$qtd = $this->oConexao->numero_linhas();
				if($qtd<$vPesq[numBolsaAtend]){
					$vetPesquisador[] =$vPesq;
				}
			}
			return $vetPesquisador; 
		}else return false;
	}
	function getDadosPubPorNome($tipo){
		$ano = $_SESSION['sAno'];
		$sql="SELECT usuario.nome, pesquisador.id, pesquisador.produtividade,selecao.numBolsaAtend,unidade.desc unidade FROM "._BDPROPESP.".usuario usuario, pesquisador,selecao left outer join unidade on pesquisador.codUnidade=unidade.cod WHERE pesquisador.id = usuario.id AND selecao.codPesq = usuario.id and selecao.ano='$ano' and selecao.tipo=$tipo and selecao.statusClass =1 and selecao.numBolsaAtend>0 and pesquisador.id!=30 ORDER BY usuario.nome ";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vDados= array();
      		while($vDados= array_shift($vetor)) {
				$vetDados[] = $vDados;
        	}
			return $vetDados; 
		} else return false; 
	}
	function getDadosPubPorPontos($tipo){ 
		$ano = $_SESSION['sAno'];
		$sql = "SELECT  usuario.nome nome, pesquisador.id,selecao.numBolsa,selecao.numBolsaAtend,pesquisador.produtividade prod,unidade.desc unidade,case ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao>5 then sum(planilha.qtdFinal * itemproducao.pontos) ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=5 then sum(planilha.qtdFinal * itemproducao.pontos)*1.1 " ;
		$sql .="when year(curdate())-pesquisador.anoTitulacao=4 then sum(planilha.qtdFinal * itemproducao.pontos)*1.2 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=3 then sum(planilha.qtdFinal * itemproducao.pontos)*1.3 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=2 then sum(planilha.qtdFinal * itemproducao.pontos)*1.4 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao<=1 then sum(planilha.qtdFinal * itemproducao.pontos)*1.5 end ponto ";
		$sql .="FROM selecao,"._BDPROPESP.".usuario usuario inner join pesquisador on usuario.id=pesquisador.id left outer join planilha on usuario.id=planilha.codPesq inner join itemproducao on planilha.codItem = itemproducao.cod LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod ";
		$sql .="where selecao.codPesq=usuario.id and selecao.ano='$ano' and selecao.tipo=$tipo and selecao.statusClass='1' and pesquisador.id!='30' and selecao.numBolsaAtend >0 ";
		if($tipo==1){ //PIBIc Capital
			$sql .=" and pesquisador.produtividade!=1  GROUP BY usuario.id order by ponto desc";
		}
		else{        //PIBIC Interior
			$sql .=" GROUP BY usuario.id order by ponto desc";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vDados= array();
      		while($vDados= array_shift($vetor)) {
				$vetDados[] = $vDados;
        	}
			return $vetDados; 
		} else return false; 
	}
	function getDadosPorNomePt(){
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT  usuario.nome nome, pesquisador.id,selecao.numBolsa,selecao.numBolsaAtend ,pesquisador.produtividade prod,unidade.desc unidade,case ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao>5 then sum(planilha.qtdFinal * itemproducao.pontos) ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=5 then sum(planilha.qtdFinal * itemproducao.pontos)*1.1 " ;
		$sql .="when year(curdate())-pesquisador.anoTitulacao=4 then sum(planilha.qtdFinal * itemproducao.pontos)*1.2 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=3 then sum(planilha.qtdFinal * itemproducao.pontos)*1.3 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=2 then sum(planilha.qtdFinal * itemproducao.pontos)*1.4 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao<=1 then sum(planilha.qtdFinal * itemproducao.pontos)*1.5 end ponto ";
		$sql .="FROM selecao,"._BDPROPESP.".usuario usuario inner join pesquisador on usuario.id=pesquisador.id left outer join planilha on usuario.id=planilha.codPesq inner join itemproducao on planilha.codItem = itemproducao.cod LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod ";
		$sql .="where selecao.codPesq=usuario.id and selecao.ano='$ano' and selecao.tipo=$tipo and selecao.statusClass='1' and pesquisador.id!='30'";
		if($tipo==1){ //PIBIc Capital
			$sql .=" and pesquisador.produtividade!=1  GROUP BY usuario.id order by nome";
		}
		else{        //PIBIC Interior
			$sql .=" GROUP BY usuario.id order by nome";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			$vDados= array();
      		while($vDados= array_shift($vetor)) {
				$vetDados[] = $vDados;
        	}
			return $vetDados; 
		} else return false; 
	}
	function getDadosLogId($id){
		$sql = "SELECT usuario.nome nome,pesquisador.produtividade prod,pesquisador.anoTitulacao anoTitulacao FROM pesquisador INNER JOIN "._BDPROPESP.".usuario usuario ON usuario.id=pesquisador.id  WHERe pesquisador.id='".$id."'";
		$this->oConexao->executaSQL($sql);
		$vetDados=$this->oConexao->vetor();
		if($vetDados) {
			return $vetDados; 
		} else return false; 
	}
	function getPesqBolsistas($id){ 
		$tipo = $_SESSION['sEdital'];
		$ano  = $_SESSION['sAno'];
		
		$sql  = "SELECT bolsista.*,bolsa.cod codigoBolsa,bolsa.ano, bolsa.codPesq, bolsa.tipo tipoBolsa, bolsistabolsa.dtFinal,bolsistabolsa.dtInicial FROM bolsista,bolsa,bolsistabolsa,oferta  WHERE bolsa.codPesq='".$id."' and bolsa.ano='$ano' and bolsa.cod=bolsistabolsa.codBolsa and bolsista.cod=bolsistabolsa.codBolsista AND oferta.codTipoEdital='".$tipo."' AND oferta.ano='$ano' AND bolsa.tipo=oferta.codTipoBolsa  ORDER BY bolsista.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqBolsistasAno($id,$ano){ //VERIFICAR!!!!! 
		$sql = "SELECT bolsista.*,bolsa.cod codigoBolsa, bolsa.codPesq, bolsistabolsa.dtFinal FROM bolsista,bolsa,bolsistabolsa  where bolsa.cod=bolsistabolsa.codBolsa and bolsista.cod=bolsistabolsa.codBolsista and bolsa.codPesq='".$id."' and bolsa.ano='$ano' ORDER BY bolsista.nome";  
		$this->oConexao->executaSQL($sql); 
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	
	function getPesqBolsistasAnoAtualAnterior($id){ 
		$anoAtual  = $_SESSION['sAno'];
		$anoAnterior = $anoAtual - 1;
		$anoAnterior2 = $anoAnterior - 1;
		$sql = "SELECT bolsista.*,bolsa.cod codigoBolsa, bolsa.codPesq, bolsa.ano, bolsa.tipo tipoBolsa, bolsistabolsa.dtInicial, bolsistabolsa.dtFinal FROM bolsista,bolsa,bolsistabolsa  where bolsa.cod=bolsistabolsa.codBolsa and bolsista.cod=bolsistabolsa.codBolsista and bolsa.codPesq='".$id."' and (bolsa.ano='$anoAtual' OR bolsa.ano='$anoAnterior' OR bolsa.ano='$anoAnterior2')  ORDER BY bolsista.nome";  
		$this->oConexao->executaSQL($sql); 
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	
	function getPesqBolsistasAnoAtualAnteriorEdital($id,$edital){ 
		$anoAtual  = $_SESSION['sAno'];
		$anoAnterior = $anoAtual - 1;
		$anoAnterior2 = $anoAnterior - 1;
		$sql = "SELECT bolsista.*,bolsa.cod codigoBolsa, bolsa.codPesq, bolsa.ano, bolsa.tipo tipoBolsa, bolsistabolsa.dtInicial, bolsistabolsa.dtFinal FROM bolsista,bolsa,bolsistabolsa  where bolsa.cod=bolsistabolsa.codBolsa and bolsista.cod=bolsistabolsa.codBolsista and bolsa.codPesq='".$id."' and (bolsa.ano='$anoAtual' OR bolsa.ano='$anoAnterior' OR bolsa.ano='$anoAnterior2')  ORDER BY bolsista.nome";  
		$this->oConexao->executaSQL($sql); 
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
		
	function getPesqBolsistasSelecao($id,$ano,$tpSelecao){ 
		$sql = "SELECT bolsista.*,bolsa.cod codigoBolsa, bolsa.codPesq, bolsistabolsa.dtFinal FROM bolsista,bolsa,bolsistabolsa,oferta  where bolsa.cod=bolsistabolsa.codBolsa and bolsista.cod=bolsistabolsa.codBolsista and bolsa.codPesq='".$id."' and bolsa.ano='$ano' AND oferta.codTipoEdital='".$tpSelecao."' AND oferta.ano='$ano' AND bolsa.tipo=oferta.codTipoBolsa  ORDER BY bolsista.nome";  
		$this->oConexao->executaSQL($sql); 
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqBolsistasAt($id){ //VERIFICAR!!!!!
		$year = date('Y');
		$yPas = $year-1; 
		$sql  = "SELECT bolsista.*,bolsa.cod codigoBolsa, bolsa.ano,bolsa.tipo,bolsa.codPesq, bolsistabolsa.dtFinal FROM bolsista,bolsa,bolsistabolsa  WHERE bolsa.codPesq='".$id."' and (bolsa.ano='$year' or bolsa.ano='$yPas') and bolsa.cod=bolsistabolsa.codBolsa and bolsista.cod=bolsistabolsa.codBolsista and bolsistabolsa.dtFinal='' ORDER BY bolsa.ano DESC, bolsista.nome ASC";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqBolsistasAtivos($id){ 
		$ano = $_SESSION['sAno'];
		$sql = "SELECT bolsista.cod,bolsista.nome,bolsa.cod bolsaCod  FROM bolsista,bolsa,bolsistabolsa  where bolsa.cod=bolsistabolsa.codBolsa and bolsa.ano='".$ano."' and bolsista.cod=bolsistabolsa.codBolsista and bolsistabolsa.dtFinal='' and bolsa.codPesq='".$id."' ORDER BY bolsista.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
 	
	function getClassificadosProd(){ 
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql = "SELECT usuario.nome nome,pesquisador.id,selecao.cod codSelecao, selecao.numBolsa numBolsa,selecao.numBolsaAtend ,unidade.desc unidade FROM selecao,pesquisador INNER JOIN "._BDPROPESP.".usuario usuario ON usuario.id=pesquisador.id LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod WHERe selecao.codPesq=pesquisador.id and selecao.ano='$ano' and selecao.tipo='$tipo' and selecao.statusClass='1'and pesquisador.produtividade='1' and pesquisador.id!='30' ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {			
			return $vetor; 
		} else return false; 
	}
	function getClassificadosProdTpSelecao($tipo){ 
		$ano  = $_SESSION['sAno'];
		$sql = "SELECT usuario.nome nome,pesquisador.id,selecao.numBolsa numBolsa,selecao.numBolsaAtend ,unidade.desc unidade FROM selecao,pesquisador INNER JOIN "._BDPROPESP.".usuario usuario ON usuario.id=pesquisador.id LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod WHERe selecao.codPesq=pesquisador.id and selecao.ano='$ano' and selecao.tipo='$tipo' and selecao.statusClass='1'and pesquisador.produtividade='1' and pesquisador.id!='30' ORDER BY usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {			
			return $vetor; 
		} else return false; 
	}
function getClassificadosPonto(){ //Os pesquisadores de produ��o n�o se enquadram nesta situa��o.
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT  usuario.nome nome, pesquisador.id,selecao.numBolsa,selecao.numBolsaAtend ,pesquisador.produtividade prod,unidade.desc unidade,case ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao>5 then sum(planilha.qtdFinal * itemproducao.pontos) ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=5 then sum(planilha.qtdFinal * itemproducao.pontos)*1.1 " ;
		$sql .="when year(curdate())-pesquisador.anoTitulacao=4 then sum(planilha.qtdFinal * itemproducao.pontos)*1.2 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=3 then sum(planilha.qtdFinal * itemproducao.pontos)*1.3 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=2 then sum(planilha.qtdFinal * itemproducao.pontos)*1.4 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao<=1 then sum(planilha.qtdFinal * itemproducao.pontos)*1.5 end ponto ";
		$sql .="FROM selecao,"._BDPROPESP.".usuario usuario inner join pesquisador on usuario.id=pesquisador.id left outer join planilha on usuario.id=planilha.codPesq inner join itemproducao on planilha.codItem = itemproducao.cod LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod ";
		$sql .="where selecao.codPesq=usuario.id and selecao.ano='$ano' and selecao.tipo='$tipo' and selecao.statusClass='1' and pesquisador.id!='30' ";
		if($tipo==1){ //PIBIc Capital
			$sql .=" and pesquisador.produtividade!=1  GROUP BY usuario.id order by ponto desc";
		}
		else{        //PIBIC Interior
			$sql .=" GROUP BY usuario.id order by ponto desc";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	
	
	function getClassificadosPonto_2014(){ //Os pesquisadores de produ��o n�o se enquadram nesta situa��o.
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT  usuario.nome nome, pesquisador.id,selecao.cod codSelecao, selecao.numBolsa,selecao.numBolsaAtend, pesquisador.produtividade prod,unidade.desc unidade,case ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao>5 then sum(planilha.qtdFinal * itemproducao.pontos) ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=5 then sum(planilha.qtdFinal * itemproducao.pontos)*1.1 " ;
		$sql .="when year(curdate())-pesquisador.anoTitulacao=4 then sum(planilha.qtdFinal * itemproducao.pontos)*1.2 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=3 then sum(planilha.qtdFinal * itemproducao.pontos)*1.3 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=2 then sum(planilha.qtdFinal * itemproducao.pontos)*1.4 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao<=1 then sum(planilha.qtdFinal * itemproducao.pontos)*1.5 end ponto ";
		$sql .="FROM selecao,"._BDPROPESP.".usuario usuario inner join pesquisador on usuario.id=pesquisador.id left outer join planilha on usuario.id=planilha.codPesq inner join itemproducao on planilha.codItem = itemproducao.cod LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod ";
		$sql .="where selecao.codPesq=usuario.id and selecao.ano='$ano' and selecao.tipo='$tipo' and selecao.statusClass='1' and pesquisador.id!='30' ";
		if($tipo==1){ //PIBIc Capital
			$sql .=" and pesquisador.produtividade!=1  GROUP BY usuario.id order by ponto desc";
		}
		else{        //PIBIC Interior
			$sql .=" GROUP BY usuario.id order by ponto desc";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor;
		} else return false;
	}
	

	function getClassificadosPontoInf(){ 
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT  usuario.nome nome, pesquisador.id,selecao.numBolsa,selecao.numBolsaAtend ,pesquisador.produtividade prod,unidade.desc unidade,case ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao>5 then sum(planilha.qtd * itemproducao.pontos) ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=5 then sum(planilha.qtd * itemproducao.pontos)*1.1 " ;
		$sql .="when year(curdate())-pesquisador.anoTitulacao=4 then sum(planilha.qtd * itemproducao.pontos)*1.2 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=3 then sum(planilha.qtd * itemproducao.pontos)*1.3 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=2 then sum(planilha.qtd * itemproducao.pontos)*1.4 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao<=1 then sum(planilha.qtd * itemproducao.pontos)*1.5 end ponto ";
		$sql .="FROM selecao,"._BDPROPESP.".usuario usuario inner join pesquisador on usuario.id=pesquisador.id left outer join planilha on usuario.id=planilha.codPesq inner join itemproducao on planilha.codItem = itemproducao.cod LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod ";
		$sql .="where selecao.codPesq=usuario.id and selecao.ano='$ano' and selecao.tipo=$tipo and selecao.statusClass='1' and pesquisador.id!='30' ";
		if($tipo==1){ //PIBIc Capital
			$sql .="and pesquisador.produtividade!=1  GROUP BY usuario.id order by ponto desc";
		}
		else{        //PIBIC Interior
			$sql .="GROUP BY usuario.id order by ponto desc";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getClassificadosPontoAval(){ 
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql  = "SELECT  usuario.nome nome, pesquisador.id,selecao.numBolsa,selecao.numBolsaAtend ,pesquisador.produtividade prod,unidade.desc unidade,case ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao>5 then sum(planilha.qtd2 * itemproducao.pontos) ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=5 then sum(planilha.qtd2 * itemproducao.pontos)*1.1 " ;
		$sql .="when year(curdate())-pesquisador.anoTitulacao=4 then sum(planilha.qtd2 * itemproducao.pontos)*1.2 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=3 then sum(planilha.qtd2 * itemproducao.pontos)*1.3 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao=2 then sum(planilha.qtd2 * itemproducao.pontos)*1.4 ";
		$sql .="when year(curdate())-pesquisador.anoTitulacao<=1 then sum(planilha.qtd2 * itemproducao.pontos)*1.5 end ponto ";
		$sql .="FROM selecao,"._BDPROPESP.".usuario usuario inner join pesquisador on usuario.id=pesquisador.id left outer join planilha on usuario.id=planilha.codPesq inner join itemproducao on planilha.codItem = itemproducao.cod LEFT OUTER JOIN unidade on pesquisador.codUnidade=unidade.cod ";
		$sql .="where selecao.codPesq=usuario.id and selecao.ano='$ano' and selecao.tipo=$tipo and selecao.statusClass='1' and pesquisador.id!='30' ";
		if($tipo==1){ //PIBIc Capital
			$sql .="and pesquisador.produtividade!=1  GROUP BY usuario.id order by ponto desc";
		}
		else{        //PIBIC Interior
			$sql .="GROUP BY usuario.id order by ponto desc";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	
	function getSemPlanilha(){ 
		$ano  = $_SESSION['sAno'];
		$tipo = $_SESSION['sEdital'];
		$sql= "SELECT usuario.nome nome, pesquisador.id, pesquisador.produtividade prod, selecao.numBolsa numBolsa,selecao.numBolsaAtend ,unidade.desc unidade, planilha.codPesq id2 FROM selecao,pesquisador INNER JOIN "._BDPROPESP.".usuario usuario ON usuario.id = pesquisador.id LEFT OUTER JOIN unidade ON pesquisador.codUnidade = unidade.cod LEFT JOIN planilha ON pesquisador.id = planilha.codPesq WHERE planilha.codPesq IS NULL AND selecao.codPesq=usuario.id and selecao.ano='$ano' and selecao.tipo='$tipo' and selecao.statusClass='1' and pesquisador.id!='30'  ";
		if($tipo==1){ //PIBIc Capital
			$sql .="and pesquisador.produtividade!=1  ORDER BY usuario.nome";
		}
		else{       //outros
			$sql .="ORDER BY usuario.nome";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
		
	function hasBolsa($codPesq){
		$ano = $_SESSION['sAno'];
		$sql = "SELECT bolsa.* from bolsa,bolsistabolsa where bolsa.codPesq='$codPesq' and bolsa.ano='$ano' and bolsistabolsa.codBolsa=bolsa.cod and bolsistabolsa.dtFinal=''";
		$this->oConexao->executaSQL($sql); 
		if($this->oConexao->numero_linhas()>0){
			return true;
		}
		else return false;
	}
	function getPesqEmail($tpBolsa){
		$ano = $_SESSION['sAno'];
		$sql = "SELECT distinct usuario.nome,pesquisador.fone,usuario.email from "._BDPROPESP.".usuario usuario,pesquisador,bolsa,bolsistabolsa where bolsa.codPesq=usuario.id  and pesquisador.id=usuario.id and bolsa.ano='$ano' and bolsa.tipo like '$tpBolsa%' and bolsistabolsa.codBolsa=bolsa.cod and bolsistabolsa.dtFinal='' order by usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqEmailEdital($tpEdital){
		$ano = $_SESSION['sAno'];
		$sql = "SELECT distinct usuario.nome,pesquisador.fone,usuario.email from "._BDPROPESP.".usuario usuario,pesquisador,selecao where selecao.codPesq=usuario.id  and selecao.ano='$ano' and selecao.tipo like '$tpEdital%' and selecao.numBolsaAtend>0 and pesquisador.id=usuario.id order by usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqPorGArea($codGArea,$tipo,$year,$tpSel){
		// tipo 0=todoa na base,tipo 1 = com bolsa no edital/ano, tipo 2 = inscritos no edital/ano
		if($tipo=='1' or $tipo=='2'){
			$sql1 = ",selecao ";
			$sql2 = " and selecao.codPesq=pesquisador.id and selecao.ano='$year' and selecao.tipo='$tpSel' and selecao.statusClass='1'";
			if($tipo=='1'){
				$sql2.= " and selecao.numBolsaAtend>0 ";
			}
		}
		if($codGArea==""){
			$sql="SELECT grandearea.nome garea,area.nome area,subarea.nome sarea,usuario.nome ";
			$sql.="FROM "._BDPROPESP.".usuario ";
			$sql.=$sql1;
			$sql.=", outeiro_pibic.pesquisador LEFT OUTER JOIN outeiro_pibic.grandearea on substring(grandearea.cod,1,1)=substring(pesquisador.codArea,1,1) LEFT OUTER JOIN outeiro_pibic.area on area.cod=pesquisador.codArea LEFT OUTER JOIN outeiro_pibic.subarea  ON pesquisador.codSubArea=subarea.cod ";
			$sql.="WHERE usuario.id=pesquisador.id and usuario.id!='30' ";
			$sql.=$sql2;
			$sql.=" order by grandearea.nome,area.nome,subarea.nome,usuario.nome";
		}
		else{
			$codArea = substr($codGArea,0,1);
			$sql="SELECT grandearea.nome garea,area.nome area,subarea.nome sarea,usuario.nome ";
			$sql.="FROM "._BDPROPESP.".usuario,outeiro_pibic.grandearea,outeiro_pibic.area ";
			$sql.=$sql1;
			$sql.=", outeiro_pibic.pesquisador LEFT OUTER JOIN outeiro_pibic.subarea  ON pesquisador.codSubArea=subarea.cod ";
			$sql.="WHERE usuario.id=pesquisador.id and usuario.id!='30' and substring(pesquisador.codArea,1,1)='$codArea' and grandearea.cod='$codGArea' and area.cod=pesquisador.codArea ";
			$sql.=$sql2;
			$sql.=" order by grandearea.nome,area.nome,subarea.nome,usuario.nome";
		}
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getPesqPorArea($codArea,$tipo,$year,$tpSel){
		// tipo 0=todoa na base,tipo 1 = com bolsa no edital/ano, tipo 2 = inscritos no edital/ano
		$gArea = substr($codArea,0,1);
		if($tipo=='1' or $tipo=='2'){
			$sql1 = ",selecao ";
			$sql2 = " and selecao.codPesq=pesquisador.id and selecao.ano='$year' and selecao.tipo='$tpSel' and selecao.statusClass='1'";
			if($tipo=='1'){
				$sql2.= " and selecao.numBolsaAtend>0 ";
			}
		}
		$sql="SELECT grandearea.nome garea,area.nome area,subarea.nome sarea,usuario.nome ";
		$sql.="FROM "._BDPROPESP.".usuario,outeiro_pibic.grandearea,outeiro_pibic.area ";
		$sql.=$sql1;
		$sql.=", outeiro_pibic.pesquisador LEFT OUTER JOIN outeiro_pibic.subarea  ON pesquisador.codSubArea=subarea.cod ";
		$sql.="WHERE usuario.id=pesquisador.id and usuario.id!='30' and pesquisador.codArea = '$codArea' and grandearea.cod like '$gArea%' and area.cod=pesquisador.codArea ";
		$sql.=$sql2;
		$sql.=" order by grandearea.nome,area.nome,subarea.nome,usuario.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	
	function getNumPesqGArea($ano,$tpSel){
		$sql="SELECT grandearea.cod,grandearea.nome,count(pesquisador.id) qtd 
			FROM pesquisador,selecao,grandearea
			WHERE selecao.codPesq = pesquisador.id
			AND selecao.ano = '$ano'
			AND selecao.tipo = '$tpSel'
			AND selecao.statusClass = '1'
			AND pesquisador.id != '30'
			AND substring( pesquisador.codArea, 1, 1 ) = substring( grandearea.cod, 1, 1 )
			Group By  grandearea.cod
			order by  grandearea.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getNumPesqArea($ano,$tpSel){
		$sql="SELECT area.cod,area.nome,count(pesquisador.id) qtd 
			FROM pesquisador,selecao,area
			WHERE selecao.codPesq = pesquisador.id
			AND selecao.ano = '$ano'
			AND selecao.tipo = '$tpSel'
			AND selecao.statusClass = '1'
			AND pesquisador.id != '30'
			AND pesquisador.codArea = area.cod
			Group By  area.cod
			order by  area.nome";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	function getNumPesqUnidade($ano,$tpSel){
		$sql="SELECT unidade.cod,unidade.desc,count(pesquisador.id) qtd 
			FROM pesquisador,selecao,unidade
			WHERE selecao.codPesq = pesquisador.id
			AND selecao.ano = '$ano'
			AND selecao.tipo = '$tpSel'
			AND selecao.statusClass = '1'
			AND pesquisador.id != '30'
			AND unidade.cod = pesquisador.codUnidade 
			Group By  unidade.cod
			order by  unidade.desc";
		$this->oConexao->executaSQL($sql);
		$vetor=$this->oConexao->vetor();
		if($vetor) {
			return $vetor; 
		} else return false; 
	}
	
	function valida($oPesquisador){ 
		
		//checa ano titulo
			if ($oPesquisador->getAnoTitulo()=="") {
				$this->pErroMsg .= _ERRMSG19;		
			}
		//checa unidade
			if ($oPesquisador->getUnidade()=="") {
				$this->pErroMsg .= _ERRMSG25;		
			}
		//checa depart
			if ($oPesquisador->getDepart()=="") {
				$this->pErroMsg .= _ERRMSG20;		
			}
		//checa categoria
			if ($oPesquisador->getCategoria()=="") {
				$this->pErroMsg .= _ERRMSG21;		
			}
			
		//checa area
			if ($oPesquisador->getArea()=="") {
				$this->pErroMsg .= _ERRMSG22;		
			}
		//checa produtividade
			if ($oPesquisador->getProd()=="") {
				$this->pErroMsg .= _ERRMSG24;		
			}
			
								
		return $this->pErroMsg;
		
	}// Fim da function_valida
	
		
		
	/*
------------------------------------------------
| Fun��o que insere os dados no banco de dados |
------------------------------------------------
*/	
	function insere($oPesquisador){
		$sql = "INSERT INTO pesquisador VALUES ('".$oPesquisador->getId()."', '','', '', '','','".$oPesquisador->getTelefone()."','','','','','','','','','', '', '', '','','0','0', '".$oPesquisador->getCelular()."')";
		$this->oConexao->executaSQL($sql);		
	}
	function insere_pesqUsr($oPesquisador){ ///verificar issoto!! axo qnaum vale
		$sql = "INSERT INTO pesquisador VALUES ('$id_insert','', '','', '', '','','','','','','','','','','', '', '', '','','','','','','1','1')";
		$this->oConexao->executaSQL($sql);		
	}
	/*
------------------------------------------------
| Fun��o que insere os dados no banco de dados |
------------------------------------------------
*/	
	function atualiza($oPesquisador){
		$sql = "UPDATE pesquisador SET titulacao='".$oPesquisador->getTitulo()."',anoTitulacao='".$oPesquisador->getAnoTitulo()."',localTitulacao='".$oPesquisador->getLocalTitulo()."',agenciaTitulacao='".$oPesquisador->getAgenciaTitulo()."',";
		$sql.="depart='".$oPesquisador->getDepart()."',fone='".$oPesquisador->getTelefone()."',codUnidade='".$oPesquisador->getUnidade()."',codCategoria='".$oPesquisador->getCategoria()."',codArea='".$oPesquisador->getArea()."',codSubArea='".$oPesquisador->getSubArea()."',especialidade='".$oPesquisador->getEspecialidade()."', ";
		$sql.="dtNascimento='".$oPesquisador->getDtNasc()."', nacionalidade='".$oPesquisador->getNacionalidade()."',naturalidade='".$oPesquisador->getNaturalidade()."',origem='".$oPesquisador->getOrigem()."',flagPosGrad='".$oPesquisador->getFlgPos()."',posGrad='".$oPesquisador->getPos()."',  ";
		$sql.="produtividade='".$oPesquisador->getProd()."', flagIc ='".$oPesquisador->getFlgIC()."',flagAgenciaIc ='".$oPesquisador->getFlgAgenciaIC()."',celular='".$oPesquisador->getCelular()."' WHERE id = '".$oPesquisador->getId()."'";
		$this->oConexao->executaSQL($sql);
	}
		
	function ativa($id){
		$sql = "UPDATE pesquisador SET status = '1' WHERE id = '".$id."'";
		$this->oConexao->executaSQL($sql);
	}
	function desativa($id){
		$sql = "UPDATE pesquisador SET status = '0' WHERE id = '".$id."'";
		$this->oConexao->executaSQL($sql);
	}
				
		
	
}// fimclass

?>