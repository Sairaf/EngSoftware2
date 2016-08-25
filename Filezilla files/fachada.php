<?php

require_once(dirname(__FILE__).'/form/form_erro.php');
require_once(dirname(__FILE__).'/fachada/fachada_usuario.php');
require_once(dirname(__FILE__).'/fachada/fachada_perfil.php');
require_once(dirname(__FILE__).'/fachada/fachada_perfil_usr.php');
require_once(dirname(__FILE__).'/fachada/fachada_senha.php');
require_once(dirname(__FILE__).'/fachada/fachada_categoria.php');
require_once(dirname(__FILE__).'/fachada/fachada_periodo.php');
require_once(dirname(__FILE__).'/fachada/fachada_tipoproducao.php');
require_once(dirname(__FILE__).'/fachada/fachada_producao.php');
require_once(dirname(__FILE__).'/fachada/fachada_itemproducao.php');
require_once(dirname(__FILE__).'/fachada/fachada_planilha.php');
require_once(dirname(__FILE__).'/fachada/fachada_unidade.php');
require_once(dirname(__FILE__).'/fachada/fachada_pesquisador.php');
require_once(dirname(__FILE__).'/fachada/fachada_grandeArea.php');
require_once(dirname(__FILE__).'/fachada/fachada_area.php');
require_once(dirname(__FILE__).'/fachada/fachada_subArea.php');
require_once(dirname(__FILE__).'/fachada/fachada_oferta.php');
require_once(dirname(__FILE__).'/fachada/fachada_arquivo.php');
require_once(dirname(__FILE__).'/fachada/fachada_bolsa.php');
require_once(dirname(__FILE__).'/fachada/fachada_bolsista.php');
require_once(dirname(__FILE__).'/fachada/fachada_bolsistabolsa.php');
require_once(dirname(__FILE__).'/fachada/fachada_publicacao.php');
require_once(dirname(__FILE__).'/fachada/fachada_termo.php');
require_once(dirname(__FILE__).'/fachada/fachada_relatorios.php');
require_once(dirname(__FILE__).'/fachada/fachada_logcomprovante.php');
require_once(dirname(__FILE__).'/fachada/fachada_avaliacao.php');
require_once(dirname(__FILE__).'/fachada/fachada_avalrelatorio.php');
require_once(dirname(__FILE__).'/fachada/fachada_avalrelexterno.php');
require_once(dirname(__FILE__).'/fachada/fachada_avalplanilha.php');
require_once(dirname(__FILE__).'/fachada/fachada_consultor.php');
require_once(dirname(__FILE__).'/fachada/fachada_email.php');
require_once(dirname(__FILE__).'/fachada/fachada_tipoBolsa.php');
require_once(dirname(__FILE__).'/fachada/fachada_selecao.php');
require_once(dirname(__FILE__).'/fachada/fachada_atendimento.php');
require_once(dirname(__FILE__).'/fachada/fachada_plano.php');
require_once(dirname(__FILE__).'/fachada/fachada_atividade.php');
require_once(dirname(__FILE__).'/fachada/fachada_instituicao.php');
require_once(dirname(__FILE__).'/fachada/fachada_agencia.php');
require_once(dirname(__FILE__).'/fachada/fachada_notificacao.php');
require_once(dirname(__FILE__).'/fachada/fachada_noticia.php');
require_once(dirname(__FILE__).'/fachada/fachada_docportal.php');
require_once(dirname(__FILE__).'/fachada/fachada_calendario.php');
require_once(dirname(__FILE__).'/fachada/fachada_edital.php');
require_once(dirname(__FILE__).'/fachada/fachada_tipoedital.php');
require_once(dirname(__FILE__).'/fachada/fachada_categportal.php');
require_once(dirname(__FILE__).'/fachada/fachada_maxbolsa.php');
require_once(dirname(__FILE__).'/fachada/fachada_relatorioresumos.php');



class fachada {
	var $pErroMsg;
	var $oJavaScript;
	
	function fachada(){
		$oJavaScript = new javascript();
	}
	
	function setErro($a){
		$this->pErroMsg=$a;
	}
	function getErro(){
		return $this->pErroMsg;
	}
	function addErro($b){
		$this->pErroMsg.=$b;
	}
	
	function valida($oObjeto,$classId){
		switch ($classId){
			case "usuario":
				$fUsuario = new fachada_usuario();
				$this->pErroMsg .= $fUsuario->valida($oObjeto);
				break;
			case "periodo":
				$fPeriodo = new fachada_periodo();
				$this->pErroMsg .= $fPeriodo->valida($oObjeto);
				break;
			case "cpf":
				$fSenha = new fachada_senha();
				$this->pErroMsg .= $fSenha->valida($oObjeto);
				break;	
			case "oferta":
				$fOferta = new fachada_oferta();
				$this->pErroMsg .= $fOferta->valida($oObjeto);
				break;	
			case "pesquisador":
				$fPesq = new fachada_pesquisador();
				$this->pErroMsg .= $fPesq->valida($oObjeto);
				break;
			case "termo":
				$fTermo = new fachada_termo();
				$this->pErroMsg .= $fTermo->valida($oObjeto);
				break;	
			case "bolsista":
				$fBolsista = new fachada_bolsista();
				$this->pErroMsg .= $fBolsista->valida($oObjeto);
				break;	
			case "bolsistabolsa":
				$fBolsistaB = new fachada_bolsistabolsa();
				$this->pErroMsg .= $fBolsistaB->valida($oObjeto);
				break;	
			case "bolsa":
				$fBolsa = new fachada_bolsa();
				$this->pErroMsg .= $fBolsa->valida($oObjeto);
				break;
			case "plano":
				$fPlano = new fachada_plano();
				$this->pErroMsg .= $fPlano->valida($oObjeto);
				break;
			case "tipobolsa":
				$fTpBolsa = new fachada_tipoBolsa();
				$this->pErroMsg .= $fTpBolsa->valida($oObjeto);
				break;
			case "instituicao":
				$fInst= new fachada_instituicao();
				$this->pErroMsg .= $fInst->valida($oObjeto);
				break;
			case "agencia":
				$fAgencia = new fachada_agencia();
				$this->pErroMsg .= $fAgencia->valida($oObjeto);
				break;
			case "notificacao":
				$fNotificacao = new fachada_notificacao();
				$this->pErroMsg .= $fNotificacao->valida($oObjeto);
				break;
			case "noticia":
				$fNoticia = new fachada_noticia();
				$this->pErroMsg .= $fNoticia->valida($oObjeto);
				break;
			case "calendario":
				$fCalendario = new fachada_calendario();
				$this->pErroMsg .= $fCalendario->valida($oObjeto);
				break;
			case "unidade":
				$fUnidade = new fachada_unidade();
				$this->pErroMsg .= $fUnidade->valida($oObjeto);
				break;
			case "edital":
				$fEdital = new fachada_edital();
				$this->pErroMsg .= $fEdital->valida($oObjeto);
				break;
			case "selecao":
				$fEdital = new fachada_selecao();
				$this->pErroMsg .= $fEdital->valida($oObjeto);
				break;
			case "tipoedital":
				$fTpEdital = new fachada_tipoedital();
				$this->pErroMsg .= $fTpEdital->valida($oObjeto);
				break;
			case "maxbolsa":
				$fMax = new fachada_maxbolsa();
				$this->pErroMsg .= $fMax->valida($oObjeto);
				break;
			case "categportal":
				$fCateg = new fachada_categportal();
				$this->pErroMsg .= $fCateg->valida($oObjeto);
				break;
			default:
				return false;
		}
		if ($this->pErroMsg==""){
			return true;		}
		else {
			return false;
		}
	}
	
	function insere($oObjeto,$classId){
	switch ($classId){
			case "usuario":
				$fUsuario = new fachada_usuario();
				$id_insert = $fUsuario->insere($oObjeto);
				return $id_insert;
				break;
			case "pesqUsr":
				$fPesquisador= new fachada_pesquisador();
				$fPesquisador->insere_pesqUsr($oObjeto);
				break;
			case "pesquisador":
				$fPesquisador= new fachada_pesquisador();
				$fPesquisador->insere($oObjeto);
				break;
			case "perfilusr":
				$fPerfilUsr = new fachada_perfilusr();
				$fPerfilUsr->insere($oObjeto);
				break;
			default:
			case "periodo":
				$fPeriodo = new fachada_periodo();
				$fPeriodo->insere($oObjeto);
				break;
			case "oferta":
				$fOferta = new fachada_oferta();
				$fOferta->insere($oObjeto);
				break;	
			case "bolsistabolsa":
				$fBolsistaB = new fachada_bolsistabolsa();
				$fBolsistaB->insere($oObjeto);
				break;
			case "bolsista":
				$fBolsista = new fachada_bolsista();
				$id_insert = $fBolsista->insere($oObjeto);
				return $id_insert;
				break;
			case "bolsa":
				$fBolsa = new fachada_bolsa();
				$id_insert = $fBolsa->insere($oObjeto);
				return $id_insert;
				break;
			case "avaliacao":
				$fAval = new fachada_avaliacao();
				$id_insert = $fAval->insere($oObjeto);
				return $id_insert;
				break;
			case "avalrelatorio":
				$fAvalRel = new fachada_avalrelatorio();
				$fAvalRel->insere($oObjeto);
				break;
			case "avalrelexterno":
				$fAvalRelEx = new fachada_avalrelexterno();
				$fAvalRelEx->insere($oObjeto);
				break;
			case "avalplanilha":
				$fAvalPlan = new fachada_avalplanilha();
				$fAvalPlan->insere($oObjeto);
				break;
			case "notificacao":
				$fNotificacao = new fachada_notificacao();
				return $fNotificacao->insere($oObjeto);
				break;
			case "notificacao":
				$fAvalPlan = new fachada_avalplanilha();
				$fAvalPlan->insere($oObjeto);
				break;
			case "consultor":
				$fConsultor = new fachada_consultor();
				$fConsultor->insere($oObjeto);
				break;
			case "tipobolsa":
				$fTpBolsa = new fachada_tipoBolsa();
				$fTpBolsa->insere($oObjeto);
				break;
			case "selecao":
				$fSelecao = new fachada_selecao();
				$fSelecao->insere($oObjeto);
				break;
			case "atendimento":
				$fAtend = new fachada_atendimento();
				$fAtend->insere($oObjeto);
				break;
			case "plano":
				$fPlano = new fachada_plano();
				return $fPlano->insere($oObjeto);
				break;
			case "atividade":
				$fAtividade = new fachada_atividade();
				$fAtividade->insere($oObjeto);
				break;
			case "instituicao":
				$fInst = new fachada_instituicao();
				return $fInst->insere($oObjeto);
				break;
			case "agencia":
				$fAgencia = new fachada_agencia();
				return $fAgencia->insere($oObjeto);
				break;
			case "noticia":
				$fNoticia = new fachada_noticia();
				return $fNoticia->insere($oObjeto);
				break;
			case "docportal":
				$fDoc = new fachada_docportal();
				return $fDoc->insere($oObjeto);
				break;
			case "calendario":
				$fCalendario = new fachada_calendario();
				return $fCalendario->insere($oObjeto);
				break;
			case "unidade":
				$fUnidade = new fachada_unidade();
				return $fUnidade->insere($oObjeto);
				break;
			case "edital":
				$fEdital = new fachada_edital();
				$id_insert = $fEdital->insere($oObjeto);
				return $id_insert;
				break;
			case "tipoedital":
				$fTpEdital = new fachada_tipoedital();
				$fTpEdital->insere($oObjeto);
				break;
			case "maxbolsa":
				$fMax = new fachada_maxbolsa();
				$fMax->insere($oObjeto);
				break;
			case "relatorioresumos":
				$fRel = new fachada_relatorioresumos();
				$fRel->insere($oObjeto);
				break;	
			case "categportal":
				$fCateg = new fachada_categportal();
				$id_insert = $fCateg->insere($oObjeto);
				return $id_insert;
				break;
			default:
				return false;
		}
	}
	
	function atualiza($oObjeto,$classId){
		switch ($classId){
			case "usuario":
				$fUsuario = new fachada_usuario();
				$fUsuario->atualiza($oObjeto);
				break;
			case "periodo":
				$fPeriodo = new fachada_periodo();
				$fPeriodo->atualiza($oObjeto);
				break;
			case "oferta":
				$fOferta = new fachada_oferta();
				$fOferta->atualiza($oObjeto);
				break;	
			case "pesquisador":
				$fPesquisador= new fachada_pesquisador();
				$fPesquisador->atualiza($oObjeto);
				break;
			case "termo":
				$fTermo= new fachada_termo();
				$fTermo->atualiza($oObjeto);
				break;
			case "bolsistabolsa":
				$fBolsistaB = new fachada_bolsistabolsa();
				$fBolsistaB->atualiza($oObjeto);
				break;	
			case "bolsista":
				$fBolsista = new fachada_bolsista();
				$fBolsista->atualiza($oObjeto);
				break;
			case "consultor":
				$fConsultor = new fachada_consultor();
				$fConsultor->atualiza($oObjeto);
				break;
			case "tipobolsa":
				$fTpBolsa = new fachada_tipoBolsa();
				$fTpBolsa->atualiza($oObjeto);
				break;
			case "selecao":
				$fSelecao = new fachada_selecao();
				$fSelecao->atualiza($oObjeto);
				break;
			case "atendimento":
				$fAtend = new fachada_atendimento();
				$fAtend->atualiza($oObjeto);
				break;
			case "plano":
				$fPlano = new fachada_plano();
				$fPlano->atualiza($oObjeto);
				break;
			case "atividade":
				$fAtividade = new fachada_atividade();
				$fAtividade->atualiza($oObjeto);
				break;
			case "instituicao":
				$fInst = new fachada_instituicao();
				$fInst->atualiza($oObjeto);
				break;
			case "agencia":
				$fAgencia = new fachada_agencia();
				$fAgencia->atualiza($oObjeto);
				break;
			case "notificacao":
				$fNotificacao = new fachada_notificacao();
				$fNotificacao->atualiza($oObjeto);
				break;
			case "noticia":
				$fNoticia = new fachada_noticia();
				return $fNoticia->atualiza($oObjeto);
				break;
			case "docportal":
				$fDoc = new fachada_docportal();
				return $fDoc->atualiza($oObjeto);
				break;
			case "calendario":
				$fCalendario = new fachada_calendario();
				return $fCalendario->atualiza($oObjeto);
				break;
			case "edital":
				$fEdital = new fachada_edital();
				return $fEdital->atualiza($oObjeto);
				break;
			case "unidade":
				$fUnidade = new fachada_unidade();
				return $fUnidade->atualiza($oObjeto);
				break;
			case "tipoedital":
				$fTpEdital = new fachada_tipoedital();
				$fTpEdital->atualiza($oObjeto);
				break;
			case "maxbolsa":
				$fMax = new fachada_maxbolsa();
				$fMax->atualiza($oObjeto);
				break;
			case "relatorioresumos":
				$frel = new fachada_relatorioresumos();
				$frel->atualiza($oObjeto);
				break;	
			default:
				return false;
		}
	}

	function ativa($chave,$classId){
		switch ($classId){
			case "usuario":
				$fUsuario = new fachada_usuario();
				$fUsuario->ativa($chave);
				break;
			case "pesquisador":
				$fPesquisador= new fachada_pesquisador();
				$fPesquisador->ativa($chave);
				break;
			case "tipobolsa":
				$fTpBolsa = new fachada_tipoBolsa();
				$fTpBolsa->ativa($chave);
				break;
			case "unidade":
				$fUnidade = new fachada_unidade();
				$fUnidade->ativa($chave);
				break;
			case "relatorioresumos":
				$fRel = new fachada_relatorioresumos();
				$fURel->ativa($chave);
				break;	
			default:
				return false;
		}
	}
	
	function desativa($chave,$classId){
		switch ($classId){
			case "usuario":
				$fUsuario = new fachada_usuario();
				$fUsuario->desativa($chave);
				break;
			case "pesquisador":
				$fPesquisador= new fachada_pesquisador();
				$fPesquisador->desativa($chave);
				break;
			case "tipobolsa":
				$fTpBolsa = new fachada_tipoBolsa();
				$fTpBolsa->desativa($chave);
				break;
			case "unidade":
				$fUnidade = new fachada_unidade();
				$fUnidade->desativa($chave);
				break;
			case "relatorioresumos":
				$fRel = new fachada_relatorioresumos();
				$fRel->desativa($chave);
				break;
			default:
				return false;
		}
	}
	
	function err(){
		$erro=$this->pErroMsg;
		$this->setErro("");
		$oErro = new erro($erro);
	}
	
//usuario--------------------------------------------------------

	function usuario($id,$login,$cpf,$nome,$email,$senha,$status){
		$fUsuario = new fachada_usuario();
		$oUsuario=$fUsuario->usuario($id,$login,$cpf,$nome,$email,$senha,$status);
		return $oUsuario;
	}
	
	function getUsuarioNomeLoginStatus($status,$consulta){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioNomeLoginStatus($status,$consulta);
		return $vetUsuario;
	}
	
	function getUsuarioNomeLoginStatusLimit($status,$consulta,$inicio,$fim){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioNomeLoginStatusLimit($status,$consulta,$inicio,$fim);
		return $vetUsuario;
	}
	
	function getUsuarioNomeStatus($status,$consulta){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioNomeStatus($status,$consulta);
		return $vetUsuario;
	}
	
	function getUsuarioNomeStatusLimit($status,$consulta,$inicio,$fim){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioNomeStatusLimit($status,$consulta,$inicio,$fim);
		return $vetUsuario;
	}
	
	function getUsuarioLoginStatus($status,$consulta){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioLoginStatus($status,$consulta);
		return $vetUsuario;
	}
	
	function getUsuarioLoginStatusLimit($status,$consulta,$inicio,$fim){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioLoginStatusLimit($status,$consulta,$inicio,$fim);
		return $vetUsuario;
	}
	
	function getUsuarioPorPerfilStatus($status,$consulta){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioPorPerfilStatus($status,$consulta);
		return $vetUsuario;
	}
	
	function getUsuarioPorPerfilStatusLimit($status,$consulta,$inicio,$fim){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioPorPerfilStatusLimit($status,$consulta,$inicio,$fim);
		return $vetUsuario;
	}
	function getUsuarioStatus($status){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioStatus($status);
		return $vetUsuario;
	}
	
	function getUsuarioStatusLimit($status,$inicio,$fim){
		$fUsuario = new fachada_usuario();
		$vetUsuario=$fUsuario->getUsuarioStatusLimit($status,$inicio,$fim);
		return $vetUsuario;
	}
	function getLoginId($id){
		$fUsuario = new fachada_usuario();
		$login=$fUsuario->getLoginId($id);
		return $login;
	}
	function getEmailId($id){
		$fUsuario = new fachada_usuario();
		$email=$fUsuario->getEmailId($id);
		return $email;
	}
	function getEmailTipoUsuario($tipo){
		$fUsuario = new fachada_usuario();
		$email=$fUsuario->getEmailTipoUsuario($tipo);
		return $email;
	}
	function getEmailAvaliadorTipo($tipo){
		$fUsuario = new fachada_usuario();
		$email=$fUsuario->getEmailAvaliadorTipo($tipo);
		return $email;
	}
	function getUsuarioId($id){
		$fUsuario = new fachada_usuario();
		$usuario=$fUsuario->getUsuarioId($id);
		return $usuario;
	}
	function getNomeId($id){
		$fUsuario = new fachada_usuario();
		$nome=$fUsuario->getNomeId($id);
		return $nome;
	}
	function getUsuarioCpf($cpf){
		$fUsuario = new fachada_usuario();
		$usuario=$fUsuario->getUsuarioCpf($cpf);
		return $usuario;
	}
	function getUsuarioCpfPropesp($cpf){
		$fUsuario = new fachada_usuario();
		$usuario=$fUsuario->getUsuarioCpfPropesp($cpf);
		return $usuario;
	}
	function mudaSenha($id,$senha){
		$fUsuario = new fachada_usuario();
		$fUsuario->mudaSenha($id,$senha);
	}
	function autentica($login,$perfil,$senha){
		$fUsuario = new fachada_usuario();
		$autenticacao= $fUsuario->autentica($login,$perfil,$senha);
		return $autenticacao;
	}
	function getUsrConsultorTipo($tipo){
		$fUsuario = new fachada_usuario();
		$vetDados=$fUsuario->getUsrConsultorTipo($tipo);
		return $vetDados;	
	}
	function getUsrPesqOuConsultores(){
		$fUsuario = new fachada_usuario();
		$vetDados=$fUsuario->getUsrPesqOuConsultores();
		return $vetDados;	
	}
	function isPesquisador($id){
		$fUsuario = new fachada_usuario();
		return $fUsuario->isPesquisador($id);
	}
	function isConsultor($id){
		$fUsuario = new fachada_usuario();
		return $fUsuario->isConsultor($id);
	}
//fim usuario---------------------------------------------------	

//pesquisador---------------------------------------------------
	function pesquisador($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$x){
		$fPesq= new fachada_pesquisador();
		$oPesquisador= $fPesq->pesquisador($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$x);
		return $oPesquisador;
	}
		
	function getPesquisadorId($id){
		$fPesq= new fachada_pesquisador();
		$oPesquisador= $fPesq->getPesquisadorId($id);
		return $oPesquisador;
	}
	function getPesqNomeCpf($cpf){
		$fPesq = new fachada_pesquisador();
		$vPesq = $fPesq->getPesqNomeCpf($cpf);
		return $vPesq;
	}
	function getPesqUsrNomeClass($nome,$class){ 
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqUsrNomeClass($nome,$class);
		return $vetDados; 
	}
	function getPesqUsrNomeClassLimit($nome,$class,$inicio,$fim){ 
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqUsrNomeClassLimit($nome,$class,$inicio,$fim);
		return $vetDados; 
	}
	function getPesqUsrUnidadeClass($unidade,$class){ 
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqUsrUnidadeClass($unidade,$class);
		return $vetDados; 
	}
	function getPesqUsrUnidadeClassLimit($unidade,$class,$inicio,$fim){ 
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqUsrUnidadeClassLimit($unidade,$class,$inicio,$fim);
		return $vetDados; 
	}
	function getPesqUsrClass($class){ 
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqUsrClass($class);
		return $vetDados; 
	}
	function getPesqUsrClassLimit($class,$inicio,$fim){ 
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqUsrClassLimit($class,$inicio,$fim);
		return $vetDados; 
	}
	function getStatusPesq($id){
		$fPesq= new fachada_pesquisador();
		return $fPesq->getStatusPesq($id);
	}
		
	function updateNumBolsas($valor,$valorc,$valoru,$id){
		$fPesq= new fachada_pesquisador();
		$fPesq->updateNumBolsas($valor,$valorc,$valoru,$id);
	}
	function getClassificadosProd(){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getClassificadosProd();
		return $vetDados; 
	}
	function getClassificadosProdTpSelecao($tipo){
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getClassificadosProdTpSelecao($tipo);
		return $vetDados; 
	}
	function getClassificadosPonto(){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getClassificadosPonto();
		return $vetDados; 
	}
	function getClassificadosPontoInf(){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getClassificadosPontoInf();
		return $vetDados; 
	}
	function getClassificadosPontoAval(){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getClassificadosPontoAval();
		return $vetDados; 
	}
	function getSemPlanilha(){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getSemPlanilha();
		return $vetDados; 
	}
	
	function distribuir2014(){
		$fPesq     = new fachada_pesquisador();
		$fAtend    = new fachada_atendimento();
		$fSelecao  = new fachada_selecao();
		$fOferta   = new fachada_oferta();
		$fMax      = new fachada_maxbolsa();
		$fPlano  = new fachada_plano();
		$ano       = $_SESSION['sAno'];
		$tpSelecao = $_SESSION['sEdital'];		
		// retorna um vetor com as bolsas ofertadas em um edital em determinado ano. (cod,codTipoEdital,codTipoBolsa,ano,prioridade,qtd)
		$vetOfertaBolsas = $fOferta->getOfertasAnoEdital($ano,$tpSelecao);
		$ofertaBolsasGeral = array();
		
		for($i=0;$i<count($vetOfertaBolsas);$i++){
			$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][codTipoBolsa] = $vetOfertaBolsas[$i]->getCodTipoBolsa();
			$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][qtdBolsaOfertada] = $vetOfertaBolsas[$i]->getQtd();			
		} //Fim do FOR
		
		// retorna um vetor com a quantidade máxima que um pesquisador pode receber de acordo com a pontuação mínima. (cod,ponto,qtd,tpselecao,ano)
		
		$vetMax    = $fMax->getMaxbolsaSelecao();  
		$qtdBolsasOfertadas	   = 0; //Quantidade das bolsas ofertadas em um edital
		$vetAtend  = array();
		if($vetMax and $vetOfertaBolsas ){		
			$maxqtd = $vetMax[0]->getQtd();
			for($i=0;$i<count($vetOfertaBolsas);$i++){
				$qtdBolsasOfertadas 	= $qtdBolsasOfertadas + $vetOfertaBolsas[$i]->getQtd(); //Soma das quantidades de bolsas ofertadas em um edital
			}
			$fSelecao->zeraNumBolsaAtend();  //zera o numero de bolsas atendidas, caso esteja redistribuindo
			$fAtend->deletaTodosAt();		 //deleta os atendimentos, caso esteja redistribuindo
			if($tpSelecao==1){		//problema: considera q os pedidos s�o menores q o disponivel			
				$vetProd = $fPesq->getClassificadosProd(); // retorna os pesquisadores de produtividade inscritos e ativos(codSelecao, nome,id,numBolsa,numBolsaAtend,unidade)
				while($Produtividade = array_shift($vetProd )){ 				
					// Busca a quantidade de planos do pesquisador no ano atual
					$qtdPlanoPesqAnoAtual = count($fPlano->getPlanoCodPesq($Produtividade[id]));
					//$fSelecao->updateNumBolsa($qtdPlanoPesqAnoAtual,$Produtividade[id],$tpSelecao);
					// Retorna um vetor com o(s) tipo(s) de bolsas e quantidade solicitadas pelo pesquisador: codInscricaoSelecao, tipoBolsa, prioridadeBolsa, qtdBolsa
					$vTipoBolsasSolicitadas = $fSelecao->getBolsaSelecaoAsc($Produtividade[codSelecao]);
					$max = $qtdPlanoPesqAnoAtual;  // quantidade m�xima que um pesquisador poder� receber
					
						// Caso o pesquisador tenha solicitado somente um tipo de bolsa
						if (count($vTipoBolsasSolicitadas)==1){						
							$BolsaSolicitada = array_shift($vTipoBolsasSolicitadas);
							$tipoBolsa = $BolsaSolicitada->getTipoBolsa();
							// Verifica se a quantidade de bolsas já atingiu a quantidade máxima permitida
							if ($Produtividade[numBolsaAtend] < $max){							
								// verifica se a quantidade de determinado tipo de bolsa reinvindicado é menor ou ou igual à quantidade de planos de trabalho criados
								if ($BolsaSolicitada->getQtdBolsa() <= $qtdPlanoPesqAnoAtual){
									$qtdeBolsaAserAtend = $BolsaSolicitada->getQtdBolsa();
								} 
								else $qtdeBolsaAserAtend = $qtdPlanoPesqAnoAtual;
								// Verifica se a quantidade da bolsa desejada é suficiente para atender a quantidade solicitada pelo pesquisador
								if ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>=$qtdeBolsaAserAtend){								
									// instancia um objeto da classe Atendimento
									$oAtend = $fAtend->atendimento($Produtividade[id],$ano,$ofertaBolsasGeral[$tipoBolsa][codTipoBolsa],$qtdeBolsaAserAtend);
									$fAtend->insere($oAtend); //insere o objeto no banco de dados	
									$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdeBolsaAserAtend;
									// atualiza  a quantidade de bolsas recebidas como sendo igual à  quantidade solicitada pelo pesquisador
									$fSelecao->updateNumBolsaAtend($qtdeBolsaAserAtend,$Produtividade[id]); 									
								} 
								elseif ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>0){
								
									// recebe a quantidade de bolsas restantes que é menor do que a quantidade que o pesquisador solicitou
									$qtdBolsasRestante = $ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada];
									// instancia um objeto da classe Atendimento
									$oAtend = $fAtend->atendimento($Produtividade[id],$ano,$ofertaBolsasGeral[$tipoBolsa][codTipoBolsa],$qtdBolsasRestante);
									$fAtend->insere($oAtend); //insere o objeto no banco de dados	
									$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdBolsasRestante;
									// atualiza  a quantidade de bolsas recebidas como sendo igual à  quantidade de bolsas restante
									$fSelecao->updateNumBolsaAtend($qtdBolsasRestante,$Produtividade[id]);
									}
							}
							else break;
						}// Fim count($vTipoBolsasSolicitadas)==1)
						elseif (count($vTipoBolsasSolicitadas)>1){
							while($BolsaSolicitada = array_shift($vTipoBolsasSolicitadas)){
								$tipoBolsa = $BolsaSolicitada->getTipoBolsa();
								// echo "Id do Pesquisador: ".$Produtividade[id].". Nome do Pesquisador: ".$Produtividade[nome].". Tipo da bolsa: ".$tipoBolsa."<br />";
								// Verifica se a quantidade de bolsas já atingiu a quantidade máxima permitida
								if ($Produtividade[numBolsaAtend] < $max){
									// verifica se a quantidade de determinado tipo de bolsa reinvindicado é menor ou ou igual à quantidade de planos de trabalho criados
									if ($BolsaSolicitada->getQtdBolsa() <= $qtdPlanoPesqAnoAtual){
										$qtdeBolsaAserAtend = $BolsaSolicitada->getQtdBolsa();
									}
									else $qtdeBolsaAserAtend = $qtdPlanoPesqAnoAtual;
									// Verifica se a quantidade da bolsa desejada é suficiente para atender a quantidade solicitada pelo pesquisador
									if ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>=$qtdeBolsaAserAtend){
										$qtdBolsa = $qtdeBolsaAserAtend-$Produtividade[numBolsaAtend];
										if ($qtdBolsa == 0){
											$qtdBolsa = $qtdeBolsaAserAtend;
										}
										// instancia um objeto da classe Atendimento
										$oAtend = $fAtend->atendimento($Produtividade[id],$ano,$tipoBolsa,$qtdBolsa);
										$fAtend->insere($oAtend); //insere o objeto no banco de dados
										$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdBolsa;
										// atualiza  a quantidade de bolsas recebidas (do objeto) como sendo igual à  quantidade solicitada pelo pesquisador
										$Produtividade[numBolsaAtend] += $qtdBolsa;
										// atualiza  a quantidade de bolsas recebidas (no Banco de Dados) como sendo igual à  quantidade solicitada pelo pesquisador
										$fSelecao->updateNumBolsaAtend($Produtividade[numBolsaAtend],$Produtividade[id]);
									}
									elseif ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>0){
										// recebe a quantidade de bolsas restantes que é menor do que a quantidade que o pesquisador solicitou
										$qtdBolsasRestante = $ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada];
										// instancia um objeto da classe Atendimento
										$oAtend = $fAtend->atendimento($Produtividade[id],$ano,$tipoBolsa,$qtdBolsasRestante);
										$fAtend->insere($oAtend); //insere o objeto no banco de dados
										$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdBolsasRestante;
										// atualiza  a quantidade de bolsas recebidas (do objeto) como sendo igual à quantidade restante
										$Produtividade[numBolsaAtend] += $qtdBolsasRestante;
										// atualiza  a quantidade de bolsas recebidas (no Banco de Dados) como sendo igual à quantidade restante
										$fSelecao->updateNumBolsaAtend($Produtividade[numBolsaAtend],$Produtividade[id]);
										continue;										
									}
								} else break;
							}// while
						} // elseif (count($vTipoBolsasSolicitadas)>1)
				}//FIM DO WHILE DE ARRAY DE PESQUISADORES DE PRODUTIVIDADE
			}// fim do if $tpSelecao==1			
			$vetPesqPontos = $fPesq->getClassificadosPonto_2014(); //retorna a relação de pesquisadores por ordem de pontuação.
			// INICIO DA ORDENAÇÃO DO VETOR DE PONTUAÇÃO
			foreach($vetPesqPontos as &$vetor){
    			$anoNota = $_SESSION['sAno']-1;
				if ($this->getSelecaoNotaPesq($vetor[id],$anoNota)){
					$notaPesquisador = $this->getSelecaoNotaPesq($vetor[id],$anoNota);
					
				}
				else $notaPesquisador = 0;
				$vetor[ponto] = $vetor[ponto] + ($notaPesquisador*0.025*$vetor[ponto]);
			}
			
			foreach ($vetPesqPontos as $chave => $linha) { 			
				$nome[$chave] = $linha; 
				$id[$chave] = $linha['id']; 
				$numBolsa[$chave] = $linha['numBolsa']; 
				$unidade[$chave] = $linha['unidade']; 
				$ponto[$chave] = $linha['ponto']; 
			} 
			array_multisort($ponto, SORT_DESC, $nome, SORT_ASC, $vetPesqPontos);
			// FIM DA ORDENA��O DO VETOR DE PONTUA��O
			//foreach ($vetPesqPontos as $vetor) { 
			//	echo "O nome do pesquisadador (ID: ".$vetor[id].") � ".$vetor[nome].", sua pontua��o � ".$vetor[ponto]."<br>";

			// $vetPesqPontos retorna os pesquisadores inscritos e ativos(codSelecao, nome,id,numBolsa,numBolsaAtend,unidade)
			while($Pesquisador = array_shift($vetPesqPontos)){
				// Busca a quantidade de planos do pesquisador no ano atual
				$qtdPlanoPesqAnoAtual = count($fPlano->getPlanoCodPesq($Pesquisador[id]));
				// verifica se o pesquisador possui alguma bolsa em vigor
				$vBolsasAtivasPesq = $this->getBolsaAtivaPesqAno($Pesquisador[id],$ano); 
				if($vBolsasAtivasPesq){				
					$qtdBolsaAtivas = count($vBolsasAtivasPesq); // quantidade de bolsas ativas de um pesquisador
				} else $qtdBolsaAtivas = 0;
				$qtdMaxBolsaPorPontuacao = 0;
				// verifica a quantidade máxima que o pesquisador pode receber comparando as pontuações mínima e máxima. //Por exemplo, pontuação > 300 pontos-> $max=2; pontuação > 0 pontos -> $max=1;
				for ($i=0;$i<count($vetMax);$i++){
					if($Pesquisador[ponto] >= $vetMax[$i]->getPonto()){
						$qtdMaxBolsaPorPontuacao = $vetMax[$i]->getQtd();						
						break;
					}
				}
				// Inicialmente a quantidade máxima de bolsas que o pesquisador pode receber é definida pela quantidade máxima de bolsas por pontuação
				$qtdBolsasPesqPodeReceber = $qtdMaxBolsaPorPontuacao;
				// Caso a soma da quantidade máxima de bolsas permitidas com a quantidade de bolsas ativas de um pesquisador exceda $qtdMaxBolsaPorPontuacao, decrementa $qtdMaxBolsaPorPontuacao
				while(($qtdBolsasPesqPodeReceber+$qtdBolsaAtivas)>$qtdMaxBolsaPorPontuacao){
					$qtdBolsasPesqPodeReceber--;
				}
				if ($qtdBolsasPesqPodeReceber > $qtdPlanoPesqAnoAtual){
					$qtdBolsasPesqPodeReceber = $qtdPlanoPesqAnoAtual;					
				}
				/* Se a quantidade de bolsas que o pesquisador pode receber for maior do que a quantidade que ele solicitou, $qtdBolsasPesqPodeReceber passa a ser igual a quantidade solicitada
				if($qtdBolsasPesqPodeReceber>$Pesquisador[numBolsa]){
					$qtdBolsasPesqPodeReceber = $Pesquisador[numBolsa];
				}*/
				// Retorna um vetor com o(s) tipo(s) de bolsas e quantidade solicitadas pelo pesquisador: codInscricaoSelecao, tipoBolsa, prioridadeBolsa, qtdBolsa
				$vTipoBolsasSolicitadas = $fSelecao->getBolsaSelecaoAsc($Pesquisador[codSelecao]);

					// Caso o pesquisador tenha solicitado somente um tipo de bolsa
					if (count($vTipoBolsasSolicitadas)==1){					
						$BolsaSolicitada = array_shift($vTipoBolsasSolicitadas);
						$tipoBolsa = $BolsaSolicitada->getTipoBolsa();
						// Verifica se a quantidade de bolsas já atingiu a quantidade máxima permitida
						if ($Pesquisador[numBolsaAtend] < $qtdBolsasPesqPodeReceber){
							// verifica se a quantidade de determinado tipo de bolsa reinvindicado é menor ou ou igual à quantidade de planos de trabalho criados							
							if ($BolsaSolicitada->getQtdBolsa() <= $qtdBolsasPesqPodeReceber){
								$qtdeBolsaAserAtend = $BolsaSolicitada->getQtdBolsa();								
							}
							else $qtdeBolsaAserAtend = $qtdBolsasPesqPodeReceber;
							// Verifica se a quantidade da bolsa desejada é suficiente para atender a quantidade solicitada pelo pesquisador
							if ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>=$qtdeBolsaAserAtend){
								// instancia um objeto da classe Atendimento
								$oAtend = $fAtend->atendimento($Pesquisador[id],$ano,$ofertaBolsasGeral[$tipoBolsa][codTipoBolsa],$qtdeBolsaAserAtend);
								$fAtend->insere($oAtend); //insere o objeto no banco de dados
								$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdeBolsaAserAtend;
								// atualiza  a quantidade de bolsas recebidas como sendo igual à  quantidade solicitada pelo pesquisador
								$fSelecao->updateNumBolsaAtend($qtdeBolsaAserAtend,$Pesquisador[id]);								
							}
							elseif ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>0){
								// recebe a quantidade de bolsas restantes que é menor do que a quantidade que o pesquisador solicitou
								$qtdBolsasRestante = $ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada];
								// instancia um objeto da classe Atendimento
								$oAtend = $fAtend->atendimento($Pesquisador[id],$ano,$ofertaBolsasGeral[$tipoBolsa][codTipoBolsa],$qtdBolsasRestante);
								$fAtend->insere($oAtend); //insere o objeto no banco de dados
								$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdBolsasRestante;
								// atualiza  a quantidade de bolsas recebidas como sendo igual à  quantidade de bolsas restante
								$fSelecao->updateNumBolsaAtend($qtdBolsasRestante,$Pesquisador[id]);
							}
						}
						else break;
					}// Fim count($vTipoBolsasSolicitadas)==1)
					elseif (count($vTipoBolsasSolicitadas)>1){
						while($BolsaSolicitada = array_shift($vTipoBolsasSolicitadas)){												
							$tipoBolsa = $BolsaSolicitada->getTipoBolsa();
							// Verifica se a quantidade de bolsas já atingiu a quantidade máxima permitida
							if ($Pesquisador[numBolsaAtend] < $qtdBolsasPesqPodeReceber){
							
								// verifica se a quantidade de determinado tipo de bolsa reinvindicado é menor ou ou igual à quantidade de planos de trabalho criados
								if ($BolsaSolicitada->getQtdBolsa() <= $qtdBolsasPesqPodeReceber){
									$qtdeBolsaAserAtend = $BolsaSolicitada->getQtdBolsa();									
								}
								else $qtdeBolsaAserAtend = $qtdBolsasPesqPodeReceber;
								// Verifica se a quantidade da bolsa desejada é suficiente para atender a quantidade solicitada pelo pesquisador
								if ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>=$qtdeBolsaAserAtend){
									$qtdeBolsaAserAtend = $qtdeBolsaAserAtend-$Pesquisador[numBolsaAtend];									
									if ($qtdeBolsaAserAtend == 0){									
										$qtdeBolsaAserAtend = $qtdBolsasPesqPodeReceber - $Pesquisador[numBolsaAtend];
									}
									//echo "Linha 910: Antes de atender o pesquisador: ".$Pesquisador[id]."<br />";
									// instancia um objeto da classe Atendimento
									$oAtend = $fAtend->atendimento($Pesquisador[id],$ano,$tipoBolsa,$qtdeBolsaAserAtend);
									$fAtend->insere($oAtend); //insere o objeto no banco de dados
									$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdeBolsaAserAtend;
									// atualiza  a quantidade de bolsas recebidas (do objeto) como sendo igual à  quantidade solicitada pelo pesquisador
									$Pesquisador[numBolsaAtend] += $qtdeBolsaAserAtend;
									// atualiza  a quantidade de bolsas recebidas (no Banco de Dados) como sendo igual à  quantidade solicitada pelo pesquisador
									$fSelecao->updateNumBolsaAtend($Pesquisador[numBolsaAtend],$Pesquisador[id]);																		
								}
								elseif ($ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada]>0){					
															
									// recebe a quantidade de bolsas restantes que é menor do que a quantidade que o pesquisador solicitou									
									$qtdBolsasRestante = $ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada];
									// instancia um objeto da classe Atendimento
									$oAtend = $fAtend->atendimento($Pesquisador[id],$ano,$tipoBolsa,$qtdBolsasRestante);
									$fAtend->insere($oAtend); //insere o objeto no banco de dados
									$ofertaBolsasGeral[$tipoBolsa][qtdBolsaOfertada] -= $qtdBolsasRestante;
									// atualiza  a quantidade de bolsas recebidas (do objeto) como sendo igual à quantidade restante
									$Pesquisador[numBolsaAtend] += $qtdBolsasRestante;
									// atualiza  a quantidade de bolsas recebidas (no Banco de Dados) como sendo igual à quantidade restante
									$fSelecao->updateNumBolsaAtend($Pesquisador[numBolsaAtend],$Pesquisador[id]);
									continue;
								}
								
							} else break;							
						} // while						
					} // elseif (count($vTipoBolsasSolicitadas)>1)				
			}//FIM DO WHILE DE ARRAY DE PESQUISADORES QUE NÃO SÃO DE PRODUTIVIDADE			
			echo "teste";
		} //fim if($vetMax and $vetOfertaBolsas )
	} // fim de Distribuir 2014
	
	function distribuir(){
		$fPesq     = new fachada_pesquisador();
		$fAtend    = new fachada_atendimento();
		$fSelecao  = new fachada_selecao();
		$fOferta   = new fachada_oferta();
		$fMax      = new fachada_maxbolsa();
		$ano       = $_SESSION['sAno'];
		$tpSelecao = $_SESSION['sEdital'];
		// retorna um vetor com as bolsas ofertadas em um edital em determinado ano. (cod,codTipoEdital,codTipoBolsa,ano,prioridade,qtd)
		$vetOfertaBolsas = $fOferta->getOfertasAnoEdital($ano,$tpSelecao);
		$ofertaBolsasGeral = array();
		$qtdOfertaBolsasCapital = 0;
		$qtdOfertaBolsasAF = 0;
		$qtdOfertaBolsasInterior = 0;
		$qtdOfertaBolsasPIBITI = 0;
		
		for($i=0;$i<count($vetOfertaBolsas);$i++){
			// Soma as quantidades de bolsas ofertadas do 1 - CNPq, 2 - UFPA e  3- FAPESPA e atribui ao vetor $ofertaBolsasGeral
			if( ($vetOfertaBolsas[$i]->getPrioridade() == 1) OR ($vetOfertaBolsas[$i]->getPrioridade() == 2) OR ($vetOfertaBolsas[$i]->getPrioridade() == 3) ){
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][codTipoBolsa] = $vetOfertaBolsas[$i]->getCodTipoBolsa();
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][qtdBolsaOfertada] = $vetOfertaBolsas[$i]->getQtd();
				//Soma a quantidade de cada bolsa e agrupa no total do subedital Capital
				$qtdOfertaBolsasCapital += $vetOfertaBolsas[$i]->getQtd();
			}
			// Soma as quantidades de bolsas ofertadas do 4 - CNPq AF e 5 - UFPA AF e atribui ao vetor $ofertaBolsasGeral
			if( ($vetOfertaBolsas[$i]->getPrioridade() == 4) OR ($vetOfertaBolsas[$i]->getPrioridade() == 5) ){
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][codTipoBolsa] = $vetOfertaBolsas[$i]->getCodTipoBolsa();
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][qtdBolsaOfertada] = $vetOfertaBolsas[$i]->getQtd();					
				//Soma a quantidade de cada bolsa e agrupa no total do subedital AF
				$qtdOfertaBolsasAF += $vetOfertaBolsas[$i]->getQtd();		
			}
			// Soma a quantidade de bolsas ofertadas do 6 - Interior e atribui ao vetor $ofertaBolsasGeral
			if( ($vetOfertaBolsas[$i]->getPrioridade() == 6)){
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][codTipoBolsa] = $vetOfertaBolsas[$i]->getCodTipoBolsa();
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][qtdBolsaOfertada] = $vetOfertaBolsas[$i]->getQtd();					
				//Soma a quantidade de cada bolsa e agrupa no total do subedital Interior
				$qtdOfertaBolsasInterior += $vetOfertaBolsas[$i]->getQtd();	
				}
			// Soma a quantidade de bolsas ofertadas do 7 - PIBITI e atribui ao vetor $ofertaBolsasGeral
			if( ($vetOfertaBolsas[$i]->getPrioridade() == 7)){
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][codTipoBolsa] = $vetOfertaBolsas[$i]->getCodTipoBolsa();
				$ofertaBolsasGeral[$vetOfertaBolsas[$i]->getCodTipoBolsa()][qtdBolsaOfertada] = $vetOfertaBolsas[$i]->getQtd();					
				//Soma a quantidade de cada bolsa e agrupa no total do subedital Interior
				$qtdOfertaBolsasPIBITI += $vetOfertaBolsas[$i]->getQtd();	
				}				
		} //Fim do FOR
		
		// retorna um vetor com a quantidade m�xima que um pesquisador pode receber de acordo com a pontua��o m�nima. (cod,ponto,qtd,tpselecao,ano)
		$vetMax    = $fMax->getMaxbolsaSelecao();  
		$oferta	   = 0;
		$vetAtend  = array();
		if($vetMax and $vetOfertaBolsas ){
			$maxqtd = $vetMax[0]->getQtd();
			for($i=0;$i<count($vetOfertaBolsas);$i++){
				$oferta 	= $oferta + $vetOfertaBolsas[$i]->getQtd(); //Soma das quantidades de bolsas ofertadas em um edital
			}
			$fSelecao->zeraNumBolsaAtend();  //zera o numero de bolsas atendidas,caso esteja redistribuindo
			$fAtend->deletaTodosAt();		 //deleta os atendimentos,caso esteja redistribuindo
			if($tpSelecao==1){		//problema: considera q os pedidos s�o menores q o disponivel
				$vetProd = $fPesq->getClassificadosProd(); // retorna os pesquisadores de produtividade inscritos e ativos(nome,id,numBolsa,numBolsaAtend,unidade)
				
				while($l = array_shift($vetProd )){ 
					// Retorna um vetor com o(s) tipo(s) de bolsas e quantidade solicitadas pelo pesquisador: tipoConjBolsasSolic,qtdBolsaTipoSolic
					$vTipoBolsasSolicitadas = $fSelecao->getTipoBolsasSolicitadasAno($l[id]);
					$max = $maxqtd;  // quantidade m�xima que um pesquisador poder� receber
					
					if($l[numBolsa]>$max){ // se o n�mero de bolsas solicitadas for maior que o n�mero m�ximo de bolsas permitido a um pesquisador
						$fSelecao->updateNumBolsaAtend($max,$l[id]); // seta no banco de dados o numero de bolsas atendidas igual ao n�mero m�ximo de bolsas permitidas
					}
					else {
							// Caso o pesquisador tenha solicitado um tipo de bolsa
							if (count($vTipoBolsasSolicitadas)==1){
								$vEditalBolsaSolicitada = array_shift($vTipoBolsasSolicitadas);
								$flagProximaBolsa=1;
								$algumaBolsaJaAtendida = 0;
								while ($flagProximaBolsa==1){
									switch($vEditalBolsaSolicitada["tipoConjBolsasSolic"]){
									case "1":
									// Verifica se o subedital Capital ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasCapital >0){
										// Verifica se ainda h� bolsas CNPq
										if ($ofertaBolsasGeral[1][qtdBolsaOfertada]>0){
											
											// Verifica se o n�mero de bolsas CNPq � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[1][qtdBolsaOfertada]>=$l[numBolsa]){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[1][codTipoBolsa],$l[numBolsa]);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[1][qtdBolsaOfertada] -= $l[numBolsa];
												$qtdOfertaBolsasCapital -= $l[numBolsa];
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($l[numBolsa],$l[id]);
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[1][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[1][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasCapital -= $qtdBolsasSolic;
												$l[numBolsa]--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim cnpq										
										// Verifica se ainda h� bolsas UFPA
										elseif ($ofertaBolsasGeral[2][qtdBolsaOfertada]>0){
											
											if ($ofertaBolsasGeral[2][qtdBolsaOfertada]>=$l[numBolsa]){ 
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[2][codTipoBolsa],$l[numBolsa]);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados
												$ofertaBolsasGeral[2][qtdBolsaOfertada] -= $l[numBolsa];
												$qtdOfertaBolsasCapital -= $l[numBolsa];
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($l[numBolsa]+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[2][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[2][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasCapital -= $qtdBolsasSolic;
												$l[numBolsa]--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim ufpa
										// Verifica se ainda h� bolsas FAPESPA
										elseif ($ofertaBolsasGeral[4][qtdBolsaOfertada]>0){
											
											if ($ofertaBolsasGeral[4][qtdBolsaOfertada]>=$l[numBolsa]){ 
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[4][codTipoBolsa],$l[numBolsa]);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados
												$ofertaBolsasGeral[4][qtdBolsaOfertada] -= $l[numBolsa];
												$qtdOfertaBolsasCapital -= $l[numBolsa];
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($l[numBolsa]+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[4][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[4][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasCapital -= $qtdBolsasSolic;
												$l[numBolsa]--;
												$flagProximaBolsa=1;	
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim fapespa										
									} // fim subedital Capital if($qtdOfertaBolsasCapital >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									case "2":
									// Verifica se o subedital AF ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasAF >0){
										// Verifica se ainda h� bolsas CNPq AF
										if ($ofertaBolsasGeral[5][qtdBolsaOfertada]>0){
											
											// Verifica se o n�mero de bolas CNPq AF � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[5][qtdBolsaOfertada]>=$l[numBolsa]){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[5][codTipoBolsa],$l[numBolsa]);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[5][qtdBolsaOfertada] -= $l[numBolsa];
												$qtdOfertaBolsasAF -= $l[numBolsa];
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($l[numBolsa]+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[5][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[5][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasAF -= $qtdBolsasSolic;
												$l[numBolsa]--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim CNPq AF
										// Verifica se ainda h� bolsas UFPA AF
										elseif ($ofertaBolsasGeral[6][qtdBolsaOfertada]>0){
											
											// Verifica se o n�mero de bolas UFPA AF � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[6][qtdBolsaOfertada]>=$l[numBolsa]){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[6][codTipoBolsa],$l[numBolsa]);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[6][qtdBolsaOfertada] -= $l[numBolsa];
												$qtdOfertaBolsasAF -= $l[numBolsa];
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($l[numBolsa]+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[6][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[6][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasAF -= $qtdBolsasSolic;
												$l[numBolsa]--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim CNPq AF								
									} // fim subedital AF if($qtdOfertaBolsasAF >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									case "3":
									// Verifica se o subedital Interior ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasInterior >0){
										// Verifica se ainda h� bolsas Interior
										if ($ofertaBolsasGeral[3][qtdBolsaOfertada]>0){
											
											// Verifica se o n�mero de bolas CNPq � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[3][qtdBolsaOfertada]>=$l[numBolsa]){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[3][codTipoBolsa],$l[numBolsa]);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[3][qtdBolsaOfertada] -= $l[numBolsa];
												$qtdOfertaBolsasInterior -= $l[numBolsa];
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($l[numBolsa]+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[3][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[3][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasInterior -= $qtdBolsasSolic;
												$l[numBolsa]--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim Interior								
									} // fim subedital INTERIOR if($qtdOfertaBolsasINTERIOR >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									
									case "4":
									// Verifica se o subedital PIBITI ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasPIBITI >0){
										// Verifica se ainda h� bolsas Interior
										if ($ofertaBolsasGeral[8][qtdBolsaOfertada]>0){
											
											// Verifica se o n�mero de bolsas PIBITI CNPq � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[8][qtdBolsaOfertada]>=$l[numBolsa]){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[8][codTipoBolsa],$l[numBolsa]);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[8][qtdBolsaOfertada] -= $l[numBolsa];
												$qtdOfertaBolsasPIBITI -= $l[numBolsa];
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($l[numBolsa]+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[8][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[8][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasPIBITI -= $qtdBolsasSolic;
												$l[numBolsa]--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim PIBITI								
									} // fim subedital PIBITI if($qtdOfertaBolsasPIBITI >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									
									} //final switch
								} //Fim while ($flagProximaBolsa=1)	
							}// Fim count($vTipoBolsasSolicitadas)==1)
							elseif (count($vTipoBolsasSolicitadas)==2){
								$qtdBolsasSolic = 1;
								// Caso o pesquisador j� tenha recebido alguma bolsa durante a distribui��o atual de bolsas
								$algumaBolsaJaAtendida = 0;
								while($bolsaSolic = array_shift($vTipoBolsasSolicitadas)){
									switch($bolsaSolic["tipoConjBolsasSolic"]){
									case "1":
									// Verifica se o subedital Capital ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasCapital >0){
										// Verifica se ainda h� bolsas CNPq
										if ($ofertaBolsasGeral[1][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[1][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados	
											$ofertaBolsasGeral[1][qtdBolsaOfertada]--;
											$qtdOfertaBolsasCapital--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim cnpq
										// Verifica se ainda h� bolsas UFPA
										elseif ($ofertaBolsasGeral[2][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[2][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[2][qtdBolsaOfertada]--;
											$qtdOfertaBolsasCapital--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim ufpa
										// Verifica se ainda h� bolsas FAPESPA
										elseif ($ofertaBolsasGeral[4][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[4][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[4][qtdBolsaOfertada]--;
											$qtdOfertaBolsasCapital--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim fapespa										
									} // fim subedital Capital
									break;
									case "2":
									// Verifica se o subedital AF ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasAF >0){
										// Verifica se ainda h� bolsas CNPq AF
										if ($ofertaBolsasGeral[5][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[5][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[5][qtdBolsaOfertada]--;
											$qtdOfertaBolsasAF--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim cnpq af
										// Verifica se ainda h� bolsas UFPA AF
										elseif ($ofertaBolsasGeral[6][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[6][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados	
											$ofertaBolsasGeral[6][qtdBolsaOfertada]--;
											$qtdOfertaBolsasAF--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim ufpa af									
									} // fim subedital AF
									break;
									case "3":
									// Verifica se o subedital Interior ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasInterior >0){
										// Verifica se ainda h� bolsas Interior
										if ($ofertaBolsasGeral[3][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[3][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[3][qtdBolsaOfertada]--;
											$qtdOfertaBolsasInterior--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim Interior									
									} // fim subedital Interior
									break;
									case "4":
									// Verifica se o subedital PIBITI ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasPIBITI >0){
										// Verifica se ainda h� bolsas Interior
										if ($ofertaBolsasGeral[8][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[8][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[8][qtdBolsaOfertada]--;
											$qtdOfertaBolsasPIBITI--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim PIBITI									
									} // fim subedital PIBITI
									break;									
									} //final switch
								}// while
							} // elseif (count($vTipoBolsasSolicitadas)==2)
						} // Fim do else ($l[numBolsa]>$max)
				}//FIM DO WHILE DE ARRAY DE PESQUISADORES DE PRODUTIVIDADE
			}// fim do if $tpSelecao==1
			
			
			$vetPesqPontos = $fPesq->getClassificadosPonto(); //retorna a rela��o de pesquisadores por ordem de pontua��o.
			
			// INICIO DA ORDENA��O DO VETOR DE PONTUA��O
			
			foreach($vetPesqPontos as &$vetor){
    			$anoNota = $_SESSION['sAno']-1;
				
				if ($this->getSelecaoNotaPesq($vetor[id],$anoNota)){
					$notaPesquisador = $this->getSelecaoNotaPesq($vetor[id],$anoNota);
				}
				else $notaPesquisador = 0;
				$vetor[ponto] = $vetor[ponto] + ($notaPesquisador*0.025*$vetor[ponto]);
			}
			
			foreach ($vetPesqPontos as $chave => $linha) { 
				$nome[$chave] = $linha['nome']; 
				$id[$chave] = $linha['id']; 
				$numBolsa[$chave] = $linha['numBolsa']; 
				$unidade[$chave] = $linha['unidade']; 
				$ponto[$chave] = $linha['ponto']; 
			} 

			array_multisort($ponto, SORT_DESC, $nome, SORT_ASC, $vetPesqPontos);
			// FIM DA ORDENA��O DO VETOR DE PONTUA��O

			//foreach ($vetPesqPontos as $vetor) { 
			//	echo "O nome do pesquisadador (ID: ".$vetor[id].") � ".$vetor[nome].", sua pontua��o � ".$vetor[ponto]."<br>";
			//}

			while($l = array_shift($vetPesqPontos)){
				$valorAtendido = 0;
				
				
				//verifica se ainda h� bolsa para distribuir
				if (($qtdOfertaBolsasCapital > 0) || ($qtdOfertaBolsasAF > 0) || ($qtdOfertaBolsasInterior > 0) || ($qtdOfertaBolsasPIBITI > 0)){
	
					$vBolsasAtivasPesq = $this->getBolsaAtivaPesqAno($l[id],2014); //verifica se determinado pesquisador possui bolsa em vigor
					if($vBolsasAtivasPesq){
						$numbolAtivas = count($vBolsasAtivasPesq); // quantidade de bolsas ativas de um pesquisador
					} else $numbolAtivas = 0;
					
					
					$ponto = $l[ponto]; // pontua��o do pesquisador
					$maxBolsaPorPontuacao   = 0;
					// verfica a quantidade m�xima que o pesquisador poder� receber comparando as pontua��es m�nima e m�xima. 
					//Por exemplo, pontua��o > 300 pontos -> $max=2; pontua��o > 0 pontos -> $max=1;
					for ($i=0;$i<count($vetMax);$i++){
						if($ponto >= $vetMax[$i]->getPonto()){
							$maxBolsaPorPontuacao   = $vetMax[$i]->getQtd();
							break;
						} 
					}
					// Caso a soma da quantidade m�xima de bolsas permitidas com o n�mero de bolsas ativas de um pesquisador exceda 2
					$BolsasPesqPodeReceber = $maxBolsaPorPontuacao;
					while(($BolsasPesqPodeReceber+$numbolAtivas)>2){
						$BolsasPesqPodeReceber--;
					}
					
					// Quantidade de bolsas que o pesquisador pode receber				
					if($BolsasPesqPodeReceber>$l[numBolsa]){
						$BolsasPesqPodeReceber = $l[numBolsa];
					}

					// Retorna um vetor com o(s) tipo(s) de bolsas e quantidade solicitadas pelo pesquisador: tipoSubEdital,qtdBolsa
					$vTipoBolsasSolicitadas = $fSelecao->getTipoBolsasSolicitadasAno($l[id]);

						// Caso o pesquisador tenha solicitado um tipo de bolsa
							if (count($vTipoBolsasSolicitadas)==1){
								$vEditalBolsaSolicitada = array_shift($vTipoBolsasSolicitadas);
								$flagProximaBolsa=1;
								$algumaBolsaJaAtendida = 0;
								while ($flagProximaBolsa==1){

									switch($vEditalBolsaSolicitada["tipoConjBolsasSolic"]){
									case "1":
									// Verifica se o subedital Capital ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasCapital >0){
										// Verifica se ainda h� bolsas CNPq
										if ($ofertaBolsasGeral[1][qtdBolsaOfertada]>0){
											// Verifica se o n�mero de bolas CNPq � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[1][qtdBolsaOfertada]>=$BolsasPesqPodeReceber){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[1][codTipoBolsa],$BolsasPesqPodeReceber);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[1][qtdBolsaOfertada] -= $BolsasPesqPodeReceber;
												$qtdOfertaBolsasCapital -= $BolsasPesqPodeReceber;
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($BolsasPesqPodeReceber,$l[id]);												
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[1][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[1][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasCapital -= $qtdBolsasSolic;
												$BolsasPesqPodeReceber--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim cnpq										
										// Verifica se ainda h� bolsas UFPA
										elseif ($ofertaBolsasGeral[2][qtdBolsaOfertada]>0){
											if ($ofertaBolsasGeral[2][qtdBolsaOfertada]>=$BolsasPesqPodeReceber){ 
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[2][codTipoBolsa],$BolsasPesqPodeReceber);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados
												$ofertaBolsasGeral[2][qtdBolsaOfertada] -= $BolsasPesqPodeReceber;
												$qtdOfertaBolsasCapital -= $BolsasPesqPodeReceber;
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($BolsasPesqPodeReceber+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;

											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[2][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[2][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasCapital -= $qtdBolsasSolic;
												$BolsasPesqPodeReceber--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim ufpa
										// Verifica se ainda h� bolsas FAPESPA
										elseif ($ofertaBolsasGeral[4][qtdBolsaOfertada]>0){
											if ($ofertaBolsasGeral[4][qtdBolsaOfertada]>=$BolsasPesqPodeReceber){ 
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[4][codTipoBolsa],$BolsasPesqPodeReceber);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados
												$ofertaBolsasGeral[4][qtdBolsaOfertada] -= $BolsasPesqPodeReceber;
												$qtdOfertaBolsasCapital -= $BolsasPesqPodeReceber;
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($BolsasPesqPodeReceber+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {

												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[4][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[4][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasCapital -= $qtdBolsasSolic;
												$BolsasPesqPodeReceber--;
												$flagProximaBolsa=1;	
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim fapespa																		
									} // fim subedital Capital if($qtdOfertaBolsasCapital >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									case "2":
									// Verifica se o subedital AF ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasAF >0){
										// Verifica se ainda h� bolsas CNPq AF
										if ($ofertaBolsasGeral[5][qtdBolsaOfertada]>0){
											// Verifica se o n�mero de bolas CNPq AF � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[5][qtdBolsaOfertada]>=$BolsasPesqPodeReceber){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[5][codTipoBolsa],$BolsasPesqPodeReceber);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[5][qtdBolsaOfertada] -= $BolsasPesqPodeReceber;
												$qtdOfertaBolsasAF -= $BolsasPesqPodeReceber;
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($BolsasPesqPodeReceber+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[5][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[5][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasAF -= $qtdBolsasSolic;
												$BolsasPesqPodeReceber--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim CNPq AF
										// Verifica se ainda h� bolsas UFPA AF
										elseif ($ofertaBolsasGeral[6][qtdBolsaOfertada]>0){
											// Verifica se o n�mero de bolas CNPq AF � suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[6][qtdBolsaOfertada]>=$BolsasPesqPodeReceber){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[6][codTipoBolsa],$BolsasPesqPodeReceber);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[6][qtdBolsaOfertada] -= $BolsasPesqPodeReceber;
												$qtdOfertaBolsasAF -= $BolsasPesqPodeReceber;
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($BolsasPesqPodeReceber+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[6][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[6][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasAF -= $qtdBolsasSolic;
												$BolsasPesqPodeReceber--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim UFPA AF								
									} // fim subedital AF if($qtdOfertaBolsasAF >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									case "3":
									// Verifica se o subedital Interior ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasInterior >0){
										// Verifica se ainda h� bolsas Interior
										if ($ofertaBolsasGeral[3][qtdBolsaOfertada]>0){
											// Verifica se o n�mero de bolsas Interior suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[3][qtdBolsaOfertada]>=$BolsasPesqPodeReceber){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[3][codTipoBolsa],$BolsasPesqPodeReceber);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[3][qtdBolsaOfertada] -= $BolsasPesqPodeReceber;
												$qtdOfertaBolsasInterior -= $BolsasPesqPodeReceber;
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($BolsasPesqPodeReceber+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[3][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[3][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasInterior -= $qtdBolsasSolic;
												$BolsasPesqPodeReceber--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim Interior								
									} // fim subedital Interior if($qtdOfertaBolsasInterior >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									default: 
										$flagProximaBolsa=0;
										echo "Nenhuma das op��es.";
									break;
									case "4":
									// Verifica se o subedital PIBITI ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasPIBITI >0){
										// Verifica se ainda h� bolsas PIBITI
										if ($ofertaBolsasGeral[8][qtdBolsaOfertada]>0){
											// Verifica se o n�mero de bolsas PIBITI suficiente para atender a quantidade solicitada pelo pesq
											if ($ofertaBolsasGeral[8][qtdBolsaOfertada]>=$BolsasPesqPodeReceber){
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[8][codTipoBolsa],$BolsasPesqPodeReceber);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[8][qtdBolsaOfertada] -= $BolsasPesqPodeReceber;
												$qtdOfertaBolsasPIBITI -= $BolsasPesqPodeReceber;
												$flagProximaBolsa=0;
												$fSelecao->updateNumBolsaAtend($BolsasPesqPodeReceber+$algumaBolsaJaAtendida,$l[id]);
												// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
												$algumaBolsaJaAtendida = 0;
											} 
											else {
												// instancia um objeto da classe Atendimento
												$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[8][codTipoBolsa],$qtdBolsasSolic);
												$fAtend->insere($oAtend); //insere o objeto no banco de dados	
												$ofertaBolsasGeral[8][qtdBolsaOfertada] -= $qtdBolsasSolic;
												$qtdOfertaBolsasPIBITI -= $qtdBolsasSolic;
												$BolsasPesqPodeReceber--;
												$flagProximaBolsa=1;
												$fSelecao->updateNumBolsaAtend($qtdBolsasSolic,$l[id]);
												$algumaBolsaJaAtendida = 1;
											}
										} // Fim PIBITI								
									} // fim subedital PIBITI if($qtdOfertaBolsasPIBITI >0)
									// Caso o subedital n�o possua mais bolsas dispon�veis
									else $flagProximaBolsa=0;
									break;
									default: 
										$flagProximaBolsa=0;
										echo "Nenhuma das op��es.";
									break;									
									} //final switch
								} //Fim while ($flagProximaBolsa=1)	
							}// Fim count($vTipoBolsasSolicitadas)==1)
							elseif (count($vTipoBolsasSolicitadas)==2){
								
								$qtdBolsasSolic = 1;
								// Caso o pesquisador j� tenha recebido alguma bolsa durante a distribui��o atual de bolsas
								$algumaBolsaJaAtendida = 0;
								while($bolsaSolic = array_shift($vTipoBolsasSolicitadas)){
									
									switch($bolsaSolic["tipoConjBolsasSolic"]){
									case "1":
									// Verifica se o subedital Capital ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasCapital >0){
										
										// Verifica se ainda h� bolsas CNPq
										if ($ofertaBolsasGeral[1][qtdBolsaOfertada]>0){
										
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[1][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados	
											$ofertaBolsasGeral[1][qtdBolsaOfertada]--;
											$qtdOfertaBolsasCapital--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;							
										} // Fim cnpq
										// Verifica se ainda h� bolsas UFPA
										elseif ($ofertaBolsasGeral[2][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[2][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[2][qtdBolsaOfertada]--;
											$qtdOfertaBolsasCapital--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim ufpa
										// Verifica se ainda h� bolsas FAPESPA
										elseif ($ofertaBolsasGeral[4][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[4][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[4][qtdBolsaOfertada]--;
											$qtdOfertaBolsasCapital--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim fapespa										
									} // fim subedital Capital
									break;
									case "2":
									// Verifica se o subedital AF ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasAF >0){

										// Verifica se ainda h� bolsas CNPq AF
										if ($ofertaBolsasGeral[5][qtdBolsaOfertada]>0){

											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[5][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[5][qtdBolsaOfertada]--;
											$qtdOfertaBolsasAF--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim cnpq af
										// Verifica se ainda h� bolsas UFPA AF
										elseif ($ofertaBolsasGeral[6][qtdBolsaOfertada]>0){

											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[6][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados	
											$ofertaBolsasGeral[6][qtdBolsaOfertada]--;
											$qtdOfertaBolsasAF--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim ufpa af									
									} // fim subedital AF
									break;
									case "3":
									// Verifica se o subedital Interior ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasInterior >0){
										// Verifica se ainda h� bolsas Interior
										if ($ofertaBolsasGeral[3][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[3][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[3][qtdBolsaOfertada]--;
											$qtdOfertaBolsasInterior--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim Interior									
									} // fim subedital Interior
									break;
									
									case "4":
									// Verifica se o subedital PIBITI ainda possui bolsas dispon�veis
									if($qtdOfertaBolsasPIBITI >0){
										// Verifica se ainda h� bolsas PIBITI
										if ($ofertaBolsasGeral[8][qtdBolsaOfertada]>0){
											// instancia um objeto da classe Atendimento
											$oAtend = $fAtend->atendimento($l[id],$ano,$ofertaBolsasGeral[8][codTipoBolsa],$qtdBolsasSolic);
											$fAtend->insere($oAtend); //insere o objeto no banco de dados
											$ofertaBolsasGeral[8][qtdBolsaOfertada]--;
											$qtdOfertaBolsasPIBITI--;
											$fSelecao->updateNumBolsaAtend($qtdBolsasSolic+$algumaBolsaJaAtendida,$l[id]);
											// Zera a vari�vel para ser utilizada com o pr�ximo pesquisador
											$algumaBolsaJaAtendida = 1;
										} // Fim PIBITI									
									} // fim subedital PIBITI
									break;									
									default: 
										$flagProximaBolsa=0;
										echo "Nenhuma das op��es.";
									} //final switch
								}// while
							} // elseif (count($vTipoBolsasSolicitadas)==2)
				}//if (($qtdOfertaBolsasCapital) OR ($qtdOfertaBolsasAF) OR ($qtdOfertaBolsasInterior))
			}//fim while naum producao
			
			
			
		} //fim if($vetMax and $vetOfertaBolsas )
	} // fim de Distribuir
	
	function getDadosPubPorNome($tipo){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getDadosPubPorNome($tipo);
		return $vetDados; 
	}
	function getDadosPubPorPontos($tipo){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getDadosPubPorPontos($tipo);
		return $vetDados; 
	}
	function getDadosPorNomePt(){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getDadosPorNomePt();
		return $vetDados; 
	}
	
	function getPesqNomeComBolsa(){
		$fPesq = new fachada_pesquisador();
		$vetDados=$fPesq->getPesqNomeComBolsa();
		return $vetDados; 
	}
	function getPesqSelecionado($ano,$tpSelecao){
		$fPesq = new fachada_pesquisador();
		$vetDados=$fPesq->getPesqSelecionado($ano,$tpSelecao);
		return $vetDados; 
	}
	function getPesqSelecionadoTipo($ano,$tpSelecao,$tpBolsa){
		$fPesq = new fachada_pesquisador();
		$vetDados=$fPesq->getPesqSelecionadoTipo($ano,$tpSelecao,$tpBolsa);
		return $vetDados; 
	}	
	function getPesqNomeAno(){ 
		$fPesq = new fachada_pesquisador();
		$vetDados=$fPesq->getPesqNomeAno();
		return $vetDados;
	}
	function getPesqSelecao($id,$ano,$tipoSelecao){
		$fPesq = new fachada_pesquisador();
		$vetDados=$fPesq->getPesqSelecao($id,$ano,$tipoSelecao);
		return $vetDados;
	}
	function getPesqBolsaVaga(){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsaVaga();
		return $vetDados; 
	}
	function getDadosLogId($id){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getDadosLogId($id);
		return $vetDados;
	}
	function getPesqBolsistas($id){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistas($id);
		return $vetDados;
	}
	function getPesqBolsistasAno($id,$ano){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistasAno($id,$ano);
		return $vetDados;
	}
	
	function getPesqBolsistasAnoAtualAnterior($id){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistasAnoAtualAnterior($id);
		return $vetDados;
	}
		
	function getPesqBolsistasSelecao($id,$ano,$tpSelecao){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistasSelecao($id,$ano,$tpSelecao);
		return $vetDados;
	}
	function getPesqBolsistasAt($id){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistasAt($id);
		return $vetDados;
	}
	function getPesqBolsistasLimit($id,$inicio,$fim){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistasLimit($id,$inicio,$fim);
		return $vetDados;	
	}
	function getPesqBolsistasAtLimit($id,$inicio,$fim){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistasAtLimit($id,$inicio,$fim);
		return $vetDados;	
	}
	function getPesqNumBolsas($codPesq){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqNumBolsas($codPesq);
		return $vetDados;	
	}
	function hasBolsa($codPesq){
		$fPesq= new fachada_pesquisador();
		return $fPesq->hasBolsa($codPesq);
	}
	function getPesqBolsistasAtivos($id){
		$fPesq= new fachada_pesquisador();
		$vetDados=$fPesq->getPesqBolsistasAtivos($id);
		return $vetDados;
	}
	function getPesqUsr($id){ 
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getPesqUsr($id);
		return $vetDados;	
	}
	function getPesqUsrId($id){ 
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getPesqUsrId($id);
		return $vetDados;	
	}
	function getPesqEmail($tpBolsa){
		$fPesq    = new fachada_pesquisador();

		$vetDados = $fPesq->getPesqEmail($tpBolsa);
		return $vetDados;	
	}
	function getPesqEmailEdital($tpEdital){
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getPesqEmailEdital($tpEdital);
		return $vetDados;	
	}
	function getPesqPorGArea($codGArea,$tipo,$year,$tpSel){
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getPesqPorGArea($codGArea,$tipo,$year,$tpSel);
		return $vetDados;	
	}
	function getPesqPorArea($codArea,$tipo,$year,$tpSel){
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getPesqPorArea($codArea,$tipo,$year,$tpSel);
		return $vetDados;	
	}
	function getNumPesqGArea($ano,$tpSel){
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getNumPesqGArea($ano,$tpSel);
		return $vetDados;	
	}
	function getNumPesqArea($ano,$tpSel){
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getNumPesqArea($ano,$tpSel);
		return $vetDados;	
	}
	function getNumPesqUnidade($ano,$tpSel){
		$fPesq    = new fachada_pesquisador();
		$vetDados = $fPesq->getNumPesqUnidade($ano,$tpSel);
		return $vetDados;	
	}
//fim pesquisador-----------------------------------------------

//perfil--------------------------------------------------------

	function perfil($cod,$desc){
		$fPerfil = new fachada_perfil();
		$oPerfil = $fPerfil->perfil();
		return $oPerfil;
	}
	
	function getPerfis(){
		$fPerfil = new fachada_perfil();
		$vetPerfil=$fPerfil->getPerfis();
		return $vetPerfil;
	}
	function getPerfilUsuario($id){
		$fPerfil = new fachada_perfil();
		$vetPerfil=$fPerfil->getPerfilUsuario($id);
		return $vetPerfil;
	}
	function getPerfilCod($cod){
		$fPerfil = new fachada_perfil();
		$oPerfil=$fPerfil->getPerfilCod($cod);
		return $oPerfil;
	}
	
	
//fim perfil---------------------------------------------------------

// perfil_usr--------------------------------------------------------

	function perfilusr($codPerfil,$codUsr,$codSistema){
		$fPerfilUsr = new fachada_perfilusr();
		$oPerfilUsr= $fPerfilUsr->perfilusr($codPerfil,$codUsr,$codSistema);
		return $oPerfilUsr; 
	}
	function deletaPerfilUsr($codPesq){
		$fPerfilUsr = new fachada_perfilusr();
		$fPerfilUsr->deletaPerfilUsr($codPesq);
	}
// fim perfil_usr-----------------------------------------------------


// fun��es de senha

	function envia($oUsuario){
		$fSenha= new fachada_senha();
		$senha=$fSenha->envia($oUsuario);
		return $senha;
	}
	function enviaEscolha($oUsuario,$senha){
		$fSenha= new fachada_senha();
		$senha=$fSenha->envia2($oUsuario,$senha);
		return $senha;
	}
	function valida_mudaSenha($usuario,$oldpsw,$newpsw1,$newpsw2){
		$fUsuario = new fachada_usuario();
		$this->pErroMsg .= $fUsuario->valida_mudaSenha($usuario,$oldpsw,$newpsw1,$newpsw2);
		if ($this->pErroMsg==""){
			return true;		}
		else {
			return false;
		}
	}

//fim func��es de senha----------------------------------------------

// categorias--------------------------------------------------------
	function categoria($a,$b){
		$fCategoria= new fachada_categoria();
		$oCategoria =$fCategoria->categoria($a,$b);
		return $oCategoria;
	}
	
	function getCategorias(){
		$fCategoria= new fachada_categoria();
		$vetCategoria=$fCategoria->getCategorias();
		return $vetCategoria;
	}
	
// fim categorias----------------------------------------------------

// per�odos----------------------------------------------------------
	function periodo($a,$b,$c,$d,$e,$f){
		$fPeriodo=new fachada_periodo();
		$oPeriodo=$fPeriodo->periodo($a,$b,$c,$d,$e,$f);
		return $oPeriodo;
	}
	function getPeriodos(){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodos();
		return $vetPeriodo;
	}
	function getPeriodosTipo($tipo){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodosTipo($tipo);
		return $vetPeriodo;
	}
	function getPeriodosAno($ano){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodosAno($ano);
		return $vetPeriodo;
	}
	function getPeriodosTipoLimit($tipo,$inicio,$fim){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodosTipoLimit($tipo,$inicio,$fim);
		return $vetPeriodo;
	}
	function getPeriodoTipoAnoAberto($tipo,$ano){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodoTipoAnoAberto($tipo,$ano);
		return $vetPeriodo;
	}
	
	function getPeriodoTipoAnoAbertoEdital($tipo,$ano,$tpSelecao){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodoTipoAnoAbertoEdital($tipo,$ano,$tpSelecao);
		return $vetPeriodo;
	}
	
	function getPeriodoTipoAno($tipo,$ano){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodoTipoAno($tipo,$ano);
		return $vetPeriodo;
	}
	
	function getPeriodoTipoAnoEdital($tipo,$ano,$tpEdital){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodoTipoAnoEdital($tipo,$ano,$tpEdital);
		return $vetPeriodo;
	}
	
	function getPeriodoTipo($tipo){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodoTipo($tipo);
		return $vetPeriodo;
	}	
	function getPeriodoCod($cod){
		$fPeriodo=new fachada_periodo();
		$oPeriodo=$fPeriodo->getPeriodoCod($cod);
		return $oPeriodo;
	}
	function getInscricaoAberta(){ 
		$fPeriodo=new fachada_periodo();
		return $fPeriodo->getInscricaoAberta();
	}
	function getPeriodoAberto($tipo){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodoAberto($tipo);
		return $vetPeriodo;
	}
	function getPeriodoAbertoSelecao($tipo,$tpSelecao){
		$fPeriodo=new fachada_periodo();
		$vetPeriodo=$fPeriodo->getPeriodoAbertoSelecao($tipo,$tpSelecao);
		return $vetPeriodo;
	}	
	function getDescTpPeriodo($tipo){
		$fPeriodo=new fachada_periodo();
		return $fPeriodo->getDescTpPeriodo($tipo);
	}
	function valida_periodoAno($tipo,$tpselecao,$ano){
		$fPeriodo=new fachada_periodo();
		return $fPeriodo->valida_periodoAno($tipo,$tpselecao,$ano);
	}
//fim periodos----------------------------------------------------

//tipo producao---------------------------------------------------
	function tipoproducao($a,$b){
		$fTpProducao=new fachada_tipoproducao();
		$oTpProducao=$fTpProducao->tipoproducao($a,$b);
		return $oTpProducao;
	}
	function getTpProducoes(){
		$fTpProducao=new fachada_tipoproducao();
		$vetTpProducao=$fTpProducao->getTpProducoes();
		return $vetTpProducao;
	}
// fim tipo producao-----------------------------------------------

// producao--------------------------------------------------------
	function producao($a,$b,$c){
		$fProducao=new fachada_producao();
		$oProducao=$fProducao->producao($a,$b,$c);
		return $oProducao;
	}
	function getProdPorTpProd($codTpProd){
		$fProducao=new fachada_producao();
		$vetProducao=$fProducao->getProdPorTpProd($codTpProd);
		return $vetProducao;
	}
// fim producao ---------------------------------------------------
 
// item producao---------------------------------------------------
	function itemproducao($a,$b,$c,$d){
		$fItProducao = new fachada_itemproducao();
		$oItProducao = $fItProducao->itemproducao($a,$b,$c,$d);
		return $oItProducao;
	}
	function getItemPorProd($codProd){
		$fItProducao   = new fachada_itemproducao();
		$vetItProducao = $fItProducao->getItemPorProd($codProd);
		return $vetItProducao;
	}
	function updatePontos($oItem){
		$fItProducao = new fachada_itemproducao();
		$fItProducao->updatePontos($oItem);
	}
// fim item producao----------------------------------------------

// planilha ------------------------------------------------------
	function planilha($a,$b,$c,$d,$e){
		$fPlanilha=new fachada_planilha();
		$oPlanilha=$fPlanilha->planilha($a,$b,$c,$d,$e);
		return $oPlanilha;
	}
	function hasPlanilha($codPesq){
		$fPlanilha=new fachada_planilha();
		$flgPlan=$fPlanilha->hasPlanilha($codPesq);
		return $flgPlan;
	}
	function getPlanItemPesq($codPesq,$codItem){
		$fPlanilha=new fachada_planilha();
		$oPlanilha=$fPlanilha->getPlanItemPesq($codPesq,$codItem);
		return $oPlanilha;
	}
	function getPlanilhaPesq($codPesq){
		$fPlanilha=new fachada_planilha();
		$vetPlanilha=$fPlanilha->getPlanilhaPesq($codPesq);
		return $vetPlanilha;
	}
	function nova_planilha($codPesq,$numLinhas){
		$fPlanilha=new fachada_planilha();
		$oPlanilha=$fPlanilha->nova_planilha($codPesq,$numLinhas);
	}
	function atualiza_planilha($codPesq,$numLinhas){
		$fPlanilha=new fachada_planilha();
		$oPlanilha=$fPlanilha->atualiza_planilha($codPesq,$numLinhas);
	}
	function setPontoFinal($tipo){
		$fPlanilha=new fachada_planilha();
		$fPlanilha->setPontoFinal($tipo);
	}
	function hasAvaliacao($codPesq){
		$fPlanilha=new fachada_planilha();
		return $fPlanilha->hasAvaliacao($codPesq);
	}
	
//fim planilha ---------------------------------------------------

// unidade---------------------------------------------------------
	function unidade($a,$b,$c,$d){
		$fUnidade= new fachada_unidade();
		$oUnidade=$fUnidade->unidade($a,$b,$c,$d);
		return $oUnidade;
	}
	function getUnidades(){
		$fUnidade= new fachada_unidade();
		$vetUnidade=$fUnidade->getUnidades();
		return $vetUnidade;
	}
	function getUnidadeTipo($tipo){
		$fUnidade= new fachada_unidade();
		$vetUnidade=$fUnidade->getUnidadeTipo($tipo);
		return $vetUnidade;
	}
	function getUnidadeCod($cod){
		$fUnidade= new fachada_unidade();
		$oUnidade=$fUnidade->getUnidadeCod($cod);
		return $oUnidade;
	}
	
	function getTipoUnidade($codUnidade){
		$fUnidade= new fachada_unidade();
		$tipoUnidade=$fUnidade->getTipoUnidade($codUnidade);
		return $tipoUnidade;
	}	

// fim unidade---------------------------------------------------

//grande area----------------------------------------------------
	function grandeArea($a,$b,$c){
		$fGArea= new fachada_grandeArea();
		$oGArea=$fGArea->grandeArea($a,$b,$c);
		return $oGArea;
	}
	function getGAreas(){
		$fGArea= new fachada_grandeArea();
		$vetGArea=$fGArea->getGAreas();
		return $vetGArea;
	}
	function getGAreaCod($cod){
		$fGArea= new fachada_grandeArea();
		$vetGArea=$fGArea->getGAreaCod($cod);
		return $vetGArea;
	}
	
//fim grande area -----------------------------------------------
	
// area ---------------------------------------------------------
	function area($a,$b,$c){
		$fArea= new fachada_area();
		$oArea=$fArea->area($a,$b,$c);
		return $oArea;
	}
	function getAreasPorGArea($cod){
		$fArea= new fachada_area();
		$vetArea=$fArea->getAreasPorGArea($cod);
		return $vetArea;
	}
// fim area ----------------------------------------------------

//sub area------------------------------------------------------
	function subArea($a,$b,$c){
		$fSArea= new fachada_subArea();
		$oSArea=$fSArea->subArea($a,$b,$c);
		return $oSArea;
	}
	function getSubAreasPorArea($cod){
		$fSArea= new fachada_subArea();
		$vetSArea=$fSArea->getSubAreasPorArea($cod);
		return $vetSArea;
	}
// fim sub area ------------------------------------------------

// oferta -----------------------------------------------------
	function oferta($a,$b,$c,$d,$e,$f){
		$fOferta= new fachada_oferta();
		$oOferta=$fOferta->oferta($a,$b,$c,$d,$e,$f);
		return $oOferta;
	}
	function getOfertas(){
		$fOferta= new fachada_oferta();
		$vetOfertaBolsas=$fOferta->getOfertas();
		return $vetOfertaBolsas;
	}
	function getOfertaCod($cod){
		$fOferta= new fachada_oferta();
		$oOferta=$fOferta->getOfertaCod($cod);
		return $oOferta;
	}
	function getOfertasDesc(){
		$fOferta= new fachada_oferta();
		$vetDados=$fOferta->getOfertasDesc();
		return $vetDados;
	}
	function getOfertasAno($ano){
		$fOferta= new fachada_oferta();
		$oOferta=$fOferta->getOfertaAno($ano);
		return $oOferta;
	}
	function getOfertasAnoDesc($ano){
		$fOferta= new fachada_oferta();
		$vetDados=$fOferta->getOfertasAnoDesc($ano);
		return $vetDados;
	}
	function getOfertasAnoEdital($ano,$codEdital){
		$fOferta= new fachada_oferta();
		$vetDados=$fOferta->getOfertasAnoEdital($ano,$codEdital);
		return $vetDados;
	}
	function getOfertasAnoEditalDesc($ano,$codEdital){
		$fOferta= new fachada_oferta();
		$vetDados=$fOferta->getOfertasAnoEditalDesc($ano,$codEdital);
		return $vetDados;
	}
	function getOfertasAnoEditalPorDesc($ano,$codEdital){
		$fOferta= new fachada_oferta();
		$vetDados=$fOferta->getOfertasAnoEditalPorDesc($ano,$codEdital);
		return $vetDados;
	}
	function getQtdPorAno($ano){
		$fOferta= new fachada_oferta();
		return $fOferta->getQtdPorAno($ano);
	}	
	
	// TIPO DE EDITAL AO QUAL PERTENCE UM TIPO DE BOLSA EM DETERMINADO ANO
	function getTipoEditalBolsa($tipoBolsa,$anoBolsa){
		$fOferta= new fachada_oferta();
		$vetDados=$fOferta->getTipoEditalBolsa($tipoBolsa,$anoBolsa);
		return $vetDados;
	}		
	
// fim oferta---------------------------------------------------

// upload ------------------------------------------------------
	function arquivo(){
		$fArquivo = new fachada_arquivo();
		return $fArquivo;
	}
	function upload($oArquivo){
		$this->pErroMsg = $oArquivo->upload(); 
		if ($this->pErroMsg=="")	return true;		
		else 						return false;
	}
	function recortar($origem,$destino){
		$fArquivo = new fachada_arquivo();
		$this->pErroMsg = $fArquivo->recortar($origem,$destino); 
		if ($this->pErroMsg=="")	return true;		
		else 						return false;
	}

// fim upload---------------------------------------------------

// bolsa -------------------------------------------------------
	function bolsa($a,$b,$c,$d,$e,$f,$g,$h){
		$fBolsa = new fachada_bolsa();
		$oBolsa = $fBolsa->bolsa($a,$b,$c,$d,$e,$f,$g,$h);
		return $oBolsa;
	}
	function getBolsaCod($cod){
		$fBolsa = new fachada_bolsa();
		$oBolsa = $fBolsa->getBolsaCod($cod);
		return $oBolsa;
	}
	function getBolsaPesqStatus($codPesq,$status){
		$fBolsa   = new fachada_bolsa();
		$vetBolsa = $fBolsa->getBolsaPesqStatus($codPesq,$status);
		return $vetBolsa;
	}
	
	function getBolsaPesqAno($codPesq,$ano){
		$fBolsa   = new fachada_bolsa();
		$vetBolsa = $fBolsa->getBolsaPesqAno($codPesq,$ano);
		return $vetBolsa;
	}
	
	function getBolsaTipoPesqAno($codPesq,$tipoBolsa,$ano){	
		$fBolsa   = new fachada_bolsa();
		$vetBolsa = $fBolsa->getBolsaTipoPesqAno($codPesq,$tipoBolsa,$ano);
		return $vetBolsa;
	}	
	
	function getBolsaTipoPesqAnoAtiva($codPesq,$tipoBolsa,$ano){	
		$fBolsa   = new fachada_bolsa();
		$vetBolsa = $fBolsa->getBolsaTipoPesqAnoAtiva($codPesq,$tipoBolsa,$ano);
		return $vetBolsa;
	}	

	function getBolsaAtivaPesqAno($codPesq,$ano){
		$fBolsa   = new fachada_bolsa();
		$vetBolsa = $fBolsa->getBolsaAtivaPesqAno($codPesq,$ano);
		return $vetBolsa;
	}
	function getBolsaAtivaPesqAnoTp($codPesq,$ano,$tpSelecao){
		$fBolsa   = new fachada_bolsa();
		$vetBolsa = $fBolsa->getBolsaAtivaPesqAnoTp($codPesq,$ano,$tpSelecao);
		return $vetBolsa;
	}
	function getBolsaAtivaPesqAnoTp2($codPesq,$ano,$tpSelecao){
		$fBolsa   = new fachada_bolsa();
		$vetBolsa = $fBolsa->getBolsaAtivaPesqAnoTp2($codPesq,$ano,$tpSelecao);
		return $vetBolsa;
	}
	function getNomePesqBolsa($codBolsa){
		$fBolsa = new fachada_bolsa();
		return $fBolsa->getNomePesqBolsa($codBolsa);
	}
	function atualizaCodPlano($codBolsa,$codPlano){
		$fBolsa = new fachada_bolsa();
		$fBolsa->atualizaCodPlano($codBolsa,$codPlano);
	}
	function atualizaCodPesq($codBolsa,$codPesq){
		$fBolsa = new fachada_bolsa();
		$fBolsa->atualizaCodPesq($codBolsa,$codPesq);
	}
	function atualizaPublicar($codBolsa,$flgPublicar){
		$fBolsa = new fachada_bolsa();
		$fBolsa->atualizaPublicar($codBolsa,$flgPublicar);
	}
	function atualizaAceiteTermo($codBolsa,$aceite){
		$fBolsa = new fachada_bolsa();
		$fBolsa->atualizaAceiteTermo($codBolsa,$aceite);
	}
// fim bolsa----------------------------------------------------

// publicacao --------------------------------------------------
	function publicacao($a,$b,$c,$d){
		$fPub = new fachada_publicacao();
		$oPub = $fPub->publicacao($a,$b,$c,$d);
		return $oPub;
	}
	function getPubliCod($cod){
		$fPub = new fachada_publicacao();
		$oPub = $fPub->getPubliCod($cod);
		return $oPub;
	}
	function getPublicacaoAno(){
		$fPub = new fachada_publicacao();
		$oPub = $fPub->getPublicacaoAno();
		return $oPub;
	}
	function publicar(){
		$fPub = new fachada_publicacao();
		$fPub->publicar();
	}
	function despublicar(){
		$fPub = new fachada_publicacao();
		$fPub->despublicar();
	}

//fim publicacao------------------------------------------------

//termo---------------------------------------------------------

	function termo($a,$b,$c){
		$fTermo = new fachada_termo();
		$oTermo = $fTermo->termo($a,$b,$c);
		return $oTermo;
	}
	function getTermoCod($cod){
		$fTermo = new fachada_termo();
		$oTermo = $fTermo->getTermoCod($cod);
		return $oTermo;
	}
	
	
//fim termo-----------------------------------------------------

//relatorios----------------------------------------------------
	function mostra($rel){
		$fRel = new fachada_relatorios($rel);
		$fRel->mostra();
	}
	
// fim relatorios ----------------------------------------------

//log comprovante-----------------------------------------------
	function geraCodigo(){
		$fComp = new fachada_logcomprovante();
		return $fComp->geraCodigo();
	}
	function loga($codigo,$data,$hora,$idLogado,$id,$prod,$ficha,$planilha,$curriculo,$codBolsistas,$flgPlanos){
		$fComp = new fachada_logcomprovante();
		$fComp->loga($codigo,$data,$hora,$idLogado,$id,$prod,$ficha,$planilha,$curriculo,$codBolsistas,$flgPlanos);
	}
		

// fim log comprovante------------------------------------------

// bolsista bolsa ----------------------------------------------
	function bolsistabolsa($a,$b,$c,$d){
		$fBolsistaB = new fachada_bolsistabolsa();
		$oBolsistaB = $fBolsistaB->bolsistabolsa($a,$b,$c,$d);
		return $oBolsistaB;
	}
	function getBolsistasBolsa(){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasBolsa();
		return $vetDados;
	}
	function getBolsistasBolsaLimit($inicio,$fim){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasBolsaLimit($inicio,$fim);
		return $vetDados;
	}
	function getBolsistasBAtivos(){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasBAtivos();
		return $vetDados;
	}
	function getBolsistasBAtivosAno(){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasBAtivosAno();
		return $vetDados;
	}
	function getBolsistasAno(){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasAno();
		return $vetDados;
	}
	function getBolsistasBAtivosNome($nome){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasBAtivosNome($nome);
		return $vetDados;
	}
	function getBolsistasNome($nome){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasNome($nome);
		return $vetDados;
	}
	function getBolsistasBAtivosAnoTp($tipo){
		$fBolsistaB = new fachada_bolsistabolsa();
		$vetDados = $fBolsistaB->getBolsistasBAtivosAnoTp($tipo);
		return $vetDados;
	}
	function getBolsistaBAtivoPorCodB($codBolsista){
		$fBolsistaB = new fachada_bolsistabolsa();
		$oBolsistaB = $fBolsistaB->getBolsistaBAtivoPorCodB($codBolsista);
		return $oBolsistaB;
	}
	function getBolsistaBAtivoCodBolsa($codBolsa){
		$fBolsistaB = new fachada_bolsistabolsa();
		$oBolsistaB = $fBolsistaB->getBolsistaBAtivoCodBolsa($codBolsa);
		return $oBolsistaB;
	}
	function getBolsistaBPorCodB($codBolsista){
		$fBolsistaB = new fachada_bolsistabolsa();
		$oBolsistaB = $fBolsistaB->getBolsistaBPorCodB($codBolsista);
		return $oBolsistaB;
	}
	function getBolsistaBPorCodBB($codBolsa,$codBolsista){
		$fBolsistaB = new fachada_bolsistabolsa();
		$oBolsistaB = $fBolsistaB->getBolsistaBPorCodBB($codBolsa,$codBolsista);
		return $oBolsistaB;
	}
//fim bolsista bolsa--------------------------------------------

// bolsista ----------------------------------------------------
	function bolsista($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$x,$z,$y,$w){
		$fBolsista = new fachada_bolsista();
		$oBolsista = $fBolsista->bolsista($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$x,$z,$y,$w);
		return $oBolsista;
	}
	function getBolsistas(){
		$fBolsista = new fachada_bolsista();
		$vetBolsista = $fBolsista->getBolsistas();
		return $vetBolsista;
	}
	function getBolsistaCod($cod){
		$fBolsista = new fachada_bolsista();
		$oBolsista = $fBolsista->getBolsistaCod($cod);
		return $oBolsista;
	}
	function getBolsistaCpf($cpf){
		$fBolsista = new fachada_bolsista();
		$oBolsista = $fBolsista->getBolsistaCpf($cpf);
		return $oBolsista;
	}
	function getBolsistaFromPesq($codPesq){
		$fBolsista = new fachada_bolsista();
		$oBolsista = $fBolsista->getBolsistaFromPesq($codPesq);
		return $oBolsista;
	}
	function getBolsistaNome($cod){
		$fBolsista = new fachada_bolsista();
		$nome= $fBolsista->getBolsistaNome($cod);
		return $nome;
	}
	function getBolsistaCodPesq($cod){
		$fBolsista = new fachada_bolsista();
		$codPesq= $fBolsista->getBolsistaCodPesq($cod);
		return $codPesq;
	}
	function getBolsistaPlano($codPlano){
		$fBolsista = new fachada_bolsista();
		$oBolsista = $fBolsista->getBolsistaPlano($codPlano);
		return $oBolsista;
	}
	function temBolsa($cod){
		$fBolsista = new fachada_bolsista();
		return $fBolsista->temBolsa($cod);
	}
	function getFolha($ano,$tpSel,$tpBolsa){
		$fBolsista = new fachada_bolsista();
		$vetDados  = $fBolsista->getFolha($ano,$tpSel,$tpBolsa);
		return $vetDados;
	}
	function getDadosPremioCnpq($ano,$codUnidade){
		$fBolsista = new fachada_bolsista();
		$vetDados  = $fBolsista->getDadosPremioCnpq($ano,$codUnidade);
		return $vetDados;
	}
	
	function valida_insercao($codPesq,$tpSelecao){
		$fBolsista = new fachada_bolsista();
		$this->pErroMsg .=$fBolsista->valida_insercao($codPesq,$tpSelecao);
		if ($this->pErroMsg==""){
			return true;		}
		else {
			return false;
		}
	}
	
	function valida_insercaoAno($codPesq,$tpSelecao,$ano){
		$fBolsista = new fachada_bolsista();
		$this->pErroMsg .=$fBolsista->valida_insercaoAno($codPesq,$tpSelecao,$ano);
		if ($this->pErroMsg==""){
			return true;		}
		else {
			return false;
		}
	}	
	
	function valida_substituicao($codBolsa){
		$fBolsista = new fachada_bolsista();
		return $fBolsista->valida_substituicao($codBolsa);
	}
	function substitui($oBolsista){
		$fBolsista = new fachada_bolsista();
		return $fBolsista->substitui($oBolsista);
	}
//fimbolsista---------------------------------------------------

//avaliacao-----------------------------------------------------
	function avaliacao($a,$b,$c){
		$fAval = new fachada_avaliacao();
		$oAval = $fAval->avaliacao($a,$b,$c);
		return $oAval; 
	}
	function getAvaliadores(){
		$fAval = new fachada_avaliacao();
		$vetAval= $fAval->getAvaliadores($codUsr);
		return $vetAval;
	}
	function getAvaliacaoCod($cod){
		$fAval = new fachada_avaliacao();
		$oAval = $fAval->getAvaliacaoCod($cod);
		return $oAval; 
	}
	function getUsrAvaliacoes($codUsr){
		$fAval = new fachada_avaliacao();
		$vetAval= $fAval->getUsrAvaliacoes($codUsr);
		return $vetAval;
	}
	function getUsrAvaliacoesTipo($codUsr,$tipo){
		$fAval = new fachada_avaliacao();
		$vetAval= $fAval->getUsrAvaliacoesTipo($codUsr,$tipo);
		return $vetAval;
	}
	function getNomesAvaliadorBolsista($tpAval){
		$fAval = new fachada_avaliacao();
		$vetDados= $fAval->getNomesAvaliadorBolsista($tpAval);
		return $vetDados;
	}
	function getNomesAvaliadorBolsistaPorParecer($parecer,$tpAval){
		$fAval = new fachada_avaliacao();
		$vetDados= $fAval->getNomesAvaliadorBolsistaPorParecer($parecer,$tpAval);
		return $vetDados;
	}
	function getDescTpAvaliacao($tipo){
		$fAval = new fachada_avaliacao();
		$desc= $fAval->getDescTpAvaliacao($tipo);
		return $desc;
	}
	function getDescAbrevTpAval($tipo){
		$fAval = new fachada_avaliacao();
		$desc= $fAval->getDescAbrevTpAval($tipo);
		return $desc;
	}
	function valida_avaliacao($codUsr,$tipo,$codPesq){
		$fAval = new fachada_avaliacao();
		$this->pErroMsg .= $fAval->valida_avaliacao($codUsr,$tipo,$codPesq);
		if ($this->pErroMsg==""){
			return true;		}
		else {
			return false;
		}
	}
	function removeAval($codUsr,$cod,$tipo){ //significado de cod depende do tipo
		$fAval = new fachada_avaliacao();
		$fAval->removeAval($codUsr,$cod,$tipo);
	}
//fim avaliacao-------------------------------------------------

//avaliacao rel-------------------------------------------------
	function avalrelatorio($a,$b,$c,$d,$e,$f,$g,$h,$i,$j){
		$fAvalRel = new fachada_avalrelatorio();
		$oAvalRel = $fAvalRel->avalrelatorio($a,$b,$c,$d,$e,$f,$g,$h,$i,$j);
		return $oAvalRel; 
	}
	function getBolsistaParecerAvalRel($codAval){
		$fAvalRel = new fachada_avalrelatorio();
		return $fAvalRel->getBolsistaParecerAvalRel($codAval);
	}
	function getUsrBolsistaParecerAvalRel($codUsr,$tipo){
		$fAvalRel = new fachada_avalrelatorio();
		return $fAvalRel->getUsrBolsistaParecerAvalRel($codUsr,$tipo);
	}
	function getUsrBolParecerAvalRelTpSelecao($codUsr,$tipo,$vetTpSelAno){
		$fAvalRel = new fachada_avalrelatorio();
		return $fAvalRel->getUsrBolParecerAvalRelTpSelecao($codUsr,$tipo,$vetTpSelAno);
	}
	function getAvalRelCod($cod){
		$fAvalRel = new fachada_avalrelatorio();
		$oAvalRel = $fAvalRel->getAvalRelCod($cod);
		return $oAvalRel; 
	}
	function getUsrAvalRel($codUsr,$tpAval){
		$fAvalRel = new fachada_avalrelatorio();
		$vetAvalRel= $fAvalRel->getUsrAvalRel($codUsr,$tpAval);
		return $vetAvalRel;
	}
	function getUsrAvalRelSemParecer($codUsr,$tpAval){
		$fAvalRel = new fachada_avalrelatorio();
		$vetAvalRel= $fAvalRel->getUsrAvalRelSemParecer($codUsr,$tpAval);
		return $vetAvalRel;
	}
	function getUsrBolsaAvalRel($codUsr){
		$fAvalRel = new fachada_avalrelatorio();
		$vetDados= $fAvalRel->getUsrBolsaAvalRel($codUsr);
		return $vetDados;
	}
	function getUsrPesqAvalRel($codUsr,$tpAval){
		$fAvalRel = new fachada_avalrelatorio();
		$vetDados= $fAvalRel->getUsrPesqAvalRel($codUsr,$tpAval);
		return $vetDados;
	}
	function getUsrPesqPorAvalRel($codAval){
		$fAvalRel = new fachada_avalrelatorio();
		$vetDados= $fAvalRel->getUsrPesqPorAvalRel($codAval);
		return $vetDados;
	}
	function getBolsistaAvalRel($codBolsista){
		$fAvalRel = new fachada_avalrelatorio();
		$vetDados= $fAvalRel->getBolsistaAvalRel($codBolsista);
		return $vetDados;
	}
	function getBolsaAvalRel($codBolsa){
		$fAvalRel = new fachada_avalrelatorio();
		$vetDados= $fAvalRel->getBolsaAvalRel($codBolsa);
		return $vetDados;
	
	}
	function avaliaRel($oAvalRel){
		$fAvalRel = new fachada_avalrelatorio();
		$fAvalRel->avaliaRel($oAvalRel);
	}
		
//fim avaliacao rel---------------------------------------------

// avaliacao plan-----------------------------------------------
	function avalplanilha($a,$b,$c,$d,$e,$f){
		$fAvalPlan = new fachada_avalplanilha();
		$oAvalPlan = $fAvalPlan->avalplanilha($a,$b,$c,$d,$e,$f);
		return $oAvalPlan;
	}
	function getAvalPlanilhaCod($cod){
		$fAvalPlan = new fachada_avalplanilha();
		$oAvalPlan = $fAvalPlan->getAvalPlanilhaCod($cod);
		return $oAvalPlan;
	}
	function getAvalPlanilhaCodPesq($codPesq,$tipo){
		$fAvalPlan = new fachada_avalplanilha();
		$oAvalPlan = $fAvalPlan->getAvalPlanilhaCodPesq($codPesq,$tipo);
		return $oAvalPlan;
	}
	function getAvaliadoresPlanilha($tipo){
		$fAvalPlan = new fachada_avalplanilha();
		$vetDados  = $fAvalPlan->getAvaliadoresPlanilha($tipo);
		return $vetDados;
	}
	function getAvaliadoresPlanilhaProdoutor($tipo){
		$fAvalPlan = new fachada_avalplanilha();
		$vetDados  = $fAvalPlan->getAvaliadoresPlanilhaProdoutor($tipo);
		return $vetDados;
	}
	function getUsrPesqAvalPlan($codUsr,$tipo){
		$fAvalPlan = new fachada_avalplanilha();
		$vetDados  = $fAvalPlan->getUsrPesqAvalPlan($codUsr,$tipo);
		return $vetDados;
	}
	function getUsrPesqAvalPlanProdoutor($codUsr,$tipo){
		$fAvalPlan = new fachada_avalplanilha();
		$vetDados  = $fAvalPlan->getUsrPesqAvalPlanProdoutor($codUsr,$tipo);
		return $vetDados;
	}
	function getUsrAvalTipoTpSelecao($codUsr,$tipo,$vetTpSelAno){
		$fAvalPlan = new fachada_avalplanilha();
		$oAvalPlan = $fAvalPlan->getUsrAvalTipoTpSelecao($codUsr,$tipo,$vetTpSelAno);
		return $oAvalPlan;
	}
	function getPesqAvalPlanilha($cod){
		$fAvalPlan = new fachada_avalplanilha();
		$vetDados  = $fAvalPlan->getPesqAvalPlanilha($cod);
		return $vetDados;
	}
	function avaliaPlan($oAvalPlan){
		$fAvalPlan = new fachada_avalplanilha();
		$fAvalPlan->avaliaPlan($oAvalPlan);
	}
//fim avaliacao plan--------------------------------------------

//avaliacao rel externo-------------------------------------------------
	function avalrelexterno($a,$b,$c,$d){
		$fAvalRel = new fachada_avalrelexterno();
		$oAvalRel = $fAvalRel->avalrelexterno($a,$b,$c,$d);
		return $oAvalRel; 
	}
	function getBolsistaParecerAvalRelEx($codAval){
		$fAvalRel = new fachada_avalrelexterno();
		return $fAvalRel->getBolsistaParecerAvalRelEx($codAval);
	}
	function getUsrBolsistaParecerAvalRelEx($codUsr,$tipo){
		$fAvalRel = new fachada_avalrelexterno();
		return $fAvalRel->getUsrBolsistaParecerAvalRelEx($codUsr,$tipo);
	}
	function getUsrBolParecerAvalRelExTpSelecao($codUsr,$tipo,$vetTpSelAno){
		$fAvalRel = new fachada_avalrelexterno();
		return $fAvalRel->getUsrBolParecerAvalRelExTpSelecao($codUsr,$tipo,$vetTpSelAno);
	}
	function getNomesAvaliadorExBolsista(){
		$fAvalRel = new fachada_avalrelexterno();
		$vetDados= $fAvalRel->getNomesAvaliadorExBolsista();
		return $vetDados;
	}
	function getNomesAvaliadorExBolsistaPorParecer($parecer){
		$fAvalRel = new fachada_avalrelexterno();
		$vetDados= $fAvalRel->getNomesAvaliadorExBolsistaPorParecer($parecer,$tpAval);
		return $vetDados;
	}
	function getAvalRelExternoCod($cod){
		$fAvalRel = new fachada_avalrelexterno();
		$oAvalRel = $fAvalRel->getAvalRelExternoCod($cod);
		return $oAvalRel; 
	}
	function getUsrAvalRelExterno($codUsr){
		$fAvalRel = new fachada_avalrelexterno();
		$vetAvalRel= $fAvalRel->getUsrAvalRelExterno($codUsr);
		return $vetAvalRel;
	}
	function getUsrAvalRelExSemParecer($codUsr){
		$fAvalRel = new fachada_avalrelexterno();
		$vetAvalRel= $fAvalRel->getUsrAvalRelExSemParecer($codUsr);
		return $vetAvalRel;
	}
	function getUsrBolsaAvalRelEx($codUsr){
		$fAvalRel = new fachada_avalrelexterno();
		$vetDados= $fAvalRel->getUsrBolsaAvalRelEx($codUsr);
		return $vetDados;
	}
	function getUsrPesqAvalRelEx($codUsr){
		$fAvalRel = new fachada_avalrelexterno();
		$vetDados= $fAvalRel->getUsrPesqAvalRelEx($codUsr);
		return $vetDados;
	}
	function getUsrPesqPorAvalRelEx($codAval){
		$fAvalRel = new fachada_avalrelexterno();
		$vetDados= $fAvalRel->getUsrPesqPorAvalRelEx($codAval);
		return $vetDados;
	}
	function getBolsistaAvalRelEx($codBolsista){
		$fAvalRel = new fachada_avalrelexterno();
		$vetDados= $fAvalRel->getBolsistaAvalRelEx($codBolsista);
		return $vetDados;
	}
	function getBolsaAvalRelEx($codBolsa){
		$fAvalRel = new fachada_avalrelexterno();
		$vetDados= $fAvalRel->getBolsaAvalRelEx($codBolsa);
		return $vetDados;
	
	}
	function avaliaRelEx($oAvalRelEx){
		$fAvalRel = new fachada_avalrelexterno();
		$fAvalRel->avaliaRelEx($oAvalRelEx);
	}
		
//fim avaliacao rel externo---------------------------------------------

//consultor ----------------------------------------------------
	function consultor($a,$b,$c,$d,$e,$f,$g,$h){
		$fConsultor = new fachada_consultor();
		$oConsultor = $fConsultor->consultor($a,$b,$c,$d,$e,$f,$g,$h);
		return $oConsultor;
	}
	function getConsultorId($id){
		$fConsultor = new fachada_consultor();
		$oConsultor = $fConsultor->getConsultorId($id);
		return $oConsultor;
	}
	function getConsultoresTipo($tipo){
		$fConsultor = new fachada_consultor();
		$vetConsultor = $fConsultor->getConsultoresTipo($tipo);
		return $vetConsultor;
	
	}
	function mudaTipo($id,$tipo){
		$fConsultor = new fachada_consultor();
		$vetConsultor = $fConsultor->mudaTipo($id,$tipo);
		return $vetConsultor;
	}

// fim consultor -----------------------------------------------

//email---------------------------------------------------------
	function enviaMsgGeral($destino,$subject,$message){
		$email = $this->getEmailTipoUsuario($destino);
		$fMail = new fachada_email();
		if ($fMail->send_varios($email,$subject,$message)){
			return true;
		}
		else return false;
	}
	function enviaMsgAvalTipo($tipo,$subject,$message){
		$email = $this->getEmailAvaliadorTipo($tipo);
		if($email){
			$fMail = new fachada_email();
			if ($fMail->send_varios($email,$subject,$message)){
				return true;
			}
			else return false;
		}
		else return false;
	}
	function send($email,$subject,$message,$att){
		$fMail = new fachada_email();

		if(count($email)>1 and $att!=false){
			if ($fMail->send_variosAtt($email,$subject,$message,$att)){
				return true;
			}
			else return false;

		}
		elseif(count($email)>1 and $att==false){
			if ($fMail->send_varios($email,$subject,$message)){
				return true;
			}
			else return false;
		}
		elseif(count($email)==1 and $att!=false){
			if ($fMail->send_att($email,$subject,$message,$att)){
				return true;
			}
			else return false;
		}
		elseif(count($email)==1 and $att==false){
			if ($fMail->send($email,$subject,$message)){
				return true;
			}
			else return false;
		}
	}
	
	function receive($from,$subject,$message){
		$fMail = new fachada_email();
			if ($fMail->receive($from,$subject,$message)){
				return true;
			}
			else return false;
	}	
//fim email-----------------------------------------------------

//tipo de bolsa-------------------------------------------------
	function tipoBolsa($cod,$desc,$status){
		$fTpBolsa = new fachada_tipoBolsa();
		$oTipoBolsa = $fTpBolsa->tipoBolsa($cod,$desc,$status);
		return $oTipoBolsa;
	}
	function getTiposBolsa(){
		$fTpBolsa = new fachada_tipoBolsa();
		$vetTipoBolsa = $fTpBolsa->getTiposBolsa();
		return $vetTipoBolsa;
	}
	function getVetTiposBolsa(){
		$fTpBolsa = new fachada_tipoBolsa();
		$vetTipoBolsa = $fTpBolsa->getVetTiposBolsa();
		return $vetTipoBolsa;
	}
	function getTiposBolsaStatus($status){
		$fTpBolsa = new fachada_tipoBolsa();
		$vetTipoBolsa = $fTpBolsa->getTiposBolsaStatus($status);
		return $vetTipoBolsa;
	}
	function getTipoBolsaCod($cod){
		$fTpBolsa = new fachada_tipoBolsa();
		$oTipoBolsa = $fTpBolsa->getTipoBolsaCod($cod);
		return $oTipoBolsa;
	}
	function getDescTipoBolsaCod($cod){
		$fTpBolsa = new fachada_tipoBolsa();
		$desc = $fTpBolsa->getDescTipoBolsaCod($cod);
		return $desc;
	}

// fim tipo de bolsa--------------------------------------------

//selecao ------------------------------------------------------
	function selecao($a,$b,$c,$d,$e,$f,$g){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->selecao($a,$b,$c,$d,$e,$f,$g);
		return $oSelecao;
	}
	
	function insereBolsaSelecao($a,$b,$c){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->insereBolsaSelecao($a,$b,$c);
		return $oSelecao;
	}
	
	function getSelecaoPorPesq($codPesq){
		$fSelecao   = new fachada_selecao();
		$vetSelecao = $fSelecao->getSelecaoPorPesq($codPesq);
		return $vetSelecao;
	}
	function getSelecaoPorPesqAno($codPesq){
		$fSelecao   = new fachada_selecao();
		$vetSelecao = $fSelecao->getSelecaoPorPesqAno($codPesq);
		return $vetSelecao;
	}
	function getSelecaoPorPesqAnoTp($codPesq,$tipo){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->getSelecaoPorPesqAnoTp($codPesq,$tipo);
		return $oSelecao;
	}
	
	function getSelecaoPorPesqTpAno($codPesq,$tipo,$ano){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->getSelecaoPorPesqTpAno($codPesq,$tipo,$ano);
		return $oSelecao;
	}	
	
	function getSelecaoPorAno($codPesq, $ano){		
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->getSelecaoPorAno($codPesq,$ano);
		return $oSelecao;
	}
	
	function getSelecaoPorAnoBolAtend($codPesq, $ano){		
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->getSelecaoPorAnoBolAtend($codPesq,$ano);
		return $oSelecao;
	}
	// TIPO SELECAO ---------------------------------------------------------------------------
	function getSelecaoBolsasSolicTipo($idSelecao,$tipoConjBolsasSolic){
		$fSelecao = new fachada_selecao();
		$vetSelecaoBolsas = $fSelecao->getSelecaoBolsasSolicTipo($idSelecao,$tipoConjBolsasSolic);
		return $vetSelecaoBolsas;
	}	

	function getSelecaoBolsasSolic($idSelecao){
		$fSelecao = new fachada_selecao();
		$vetSelecaoBolsas = $fSelecao->getSelecaoBolsasSolic($idSelecao);
		return $vetSelecaoBolsas;
	}
	
	function updateNumTipoBolsaSelecao($cod,$tipoConjBolsasSolic,$numBolsas){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->updateNumTipoBolsaSelecao($cod,$tipoConjBolsasSolic,$numBolsas);
	}
	
	function insereNumTipoBolsaSelecao($idInscSelecaoAno,$tipoConjBolsasSolic,$qtdBolsaTipoSolic){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->insereNumTipoBolsaSelecao($idInscSelecaoAno,$tipoConjBolsasSolic,$qtdBolsaTipoSolic);
	}	
	// ---------------------------------------------------------------------------
	
	// BOLSA SELECAO ---------------------------------------------------------------------------
	function getBolsaSelecaoTipo($idSelecao,$tipoBolsa){
		$fSelecao = new fachada_selecao();
		$oBolsaSelecao = $fSelecao->getBolsaSelecaoTipo($idSelecao,$tipoBolsa);
		return $oBolsaSelecao;
	}
	
	function updateNumBolsaSelecao($idSelecao,$tipoBolsa,$prioridadeBolsa,$numBolsas){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->updateNumBolsaSelecao($idSelecao,$tipoBolsa,$prioridadeBolsa,$numBolsas);
	}	
	
	function deleteNumBolsaSelecao($idSelecao,$tipoBolsa){
		$fSelecao = new fachada_selecao();
		$fSelecao->deleteNumBolsaSelecao($idSelecao,$tipoBolsa);
	}
	
	function insereNumBolsaSelecao($idSelecao,$tipoBolsa,$prioridadeBolsa,$numBolsas){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->insereNumBolsaSelecao($idSelecao,$tipoBolsa,$prioridadeBolsa,$numBolsas);
	}	
	
	function getBolsaSelecaoAsc($idSelecao){
		$fSelecao = new fachada_selecao();
		$vBolsaSelecao = $fSelecao->getBolsaSelecaoAsc($idSelecao);
		return $vBolsaSelecao;
	}
	
	function getBolsaSelecaoDesc($idSelecao){
		$fSelecao = new fachada_selecao();
		$vBolsaSelecao = $fSelecao->getBolsaSelecaoDesc($idSelecao);
		return $vBolsaSelecao;
	}					
	// ---------------------------------------------------------------------------
	
	function getTiposSelecao(){
		$fSelecao = new fachada_selecao();
		$vetSelecao = $fSelecao->getTiposSelecao();
		return $vetSelecao;
	}
	function updateNumBolsaAtend($valor,$codPesq){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->updateNumBolsaAtend($valor,$codPesq);
	}
	function zeraNumBolsaAtend(){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->eraNumBolsaAtend();
	}
	function updateNumBolsa($valor,$codPesq,$tipo){
		$fSelecao = new fachada_selecao();
		$oSelecao = $fSelecao->updateNumBolsa($valor,$codPesq,$tipo);
	}

	
	function aprova($id){
		$fSelecao = new fachada_selecao();
		$fSelecao->aprova($id);
	}
	function reprova($id){
		$fSelecao = new fachada_selecao();
		$fSelecao->reprova($id);
	}
	
/*	function deleteNumTipoBolsaSelecao($idInscSelecaoAno,$tipoConjBolsasSolic){
		$fSelecao = new fachada_selecao();
		$fSelecao->deleteNumTipoBolsaSelecao($idInscSelecaoAno,$tipoConjBolsasSolic);
	}	
	*/
	function getSelecaoNotaPesq($idPesq,$ano){
		$fSelecao = new fachada_selecao();
		$notaPesquisador = $fSelecao->getSelecaoNotaPesq($idPesq,$ano);
		return $notaPesquisador;
	}	
	

//fim selecao --------------------------------------------------

// atendimento--------------------------------------------------
	function atendimento($a,$b,$c,$d){
		$fAtend = new fachada_atendimento();
		$oAtend = $fAtend->atendimento($a,$b,$c,$d);
		return $oAtend;
	}
	function getAtendPorPesq($codPesq){
		$fAtend = new fachada_atendimento();
		$vetAtend = $fAtend->getAtendPorPesq($codPesq);
		return $vetAtend;
	}
	function getAtendPorPesqAno($codPesq){
		$fAtend = new fachada_atendimento();
		$vetAtend = $fAtend->getAtendPorPesqAno($codPesq);
		return $vetAtend;
	}
	function getDescAtendPorPesqAno($codPesq){
		$fAtend = new fachada_atendimento();
		$vetAtend = $fAtend->getDescAtendPorPesqAno($codPesq);
		return $vetAtend;
	}
	
	function getAtendPorPesqAnoTp($codPesq,$tipo){
		$fAtend = new fachada_atendimento();
		$oAtend = $fAtend->getAtendPorPesqAnoTp($codPesq,$tipo);
		return $oAtend;
	}	
	
	function getDescAtendPorPesqSel($codPesq,$selecao){
		$fAtend = new fachada_atendimento();
		$vetDados = $fAtend->getDescAtendPorPesqSel($codPesq,$selecao);
		return $vetDados;
	}
	function getAtendPorPesqTpAno($codPesq,$tipo,$ano){
		$fAtend = new fachada_atendimento();
		$oAtend = $fAtend->getAtendPorPesqTpAno($codPesq,$tipo,$ano);
		return $oAtend;
	}
	function getDescAtendPorPesqAnoTp($codPesq,$tipo){
		$fAtend = new fachada_atendimento();
		$vetDados = $fAtend->getDescAtendPorPesqAnoTp($codPesq,$tipo);
		return $vetDados;
	}
	function deletaOAt($oAtend){
		$fAtend = new fachada_atendimento();
		$fAtend->deletaOAt($oAtend);
	}
	function deletaAt($codPesq){
		$fAtend = new fachada_atendimento();
		$fAtend->deletaAt($codPesq);
	}
	function deletaTodosAt(){
		$fAtend = new fachada_atendimento();
		$fAtend->deletaTodosAt();
	}
//fim atendimento-----------------------------------------------

//plano --------------------------------------------------------
	function plano($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p){
		$fPlano = new fachada_plano();
		$oPlano = $fPlano->plano($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$l,$m,$n,$o,$p);
		return $oPlano;
	}
	function getPlanoCod($cod){
		$fPlano = new fachada_plano();
		$oPlano = $fPlano->getPlanoCod($cod);
		return $oPlano;
	}
	function getPlanoCodPesq($codPesq){
		$fPlano = new fachada_plano();
		$vetPlano = $fPlano->getPlanoCodPesq($codPesq);
		return $vetPlano;
	}
	function getPlanoDispCodPesqAno($codPesq,$ano){
		$fPlano = new fachada_plano();
		$vetPlano = $fPlano->getPlanoDispCodPesqAno($codPesq,$ano);
		return $vetPlano;
	}
	function isFree($codPlano){
		$fPlano = new fachada_plano();
		return $fPlano->isFree($codPlano);
	}
	
	function hasPlano($codPesq,$ano,$tpSelecao){
		$fPlano = new fachada_plano();
		// Retorna um vetor com os planos n�o atribu�dos a uma bolsa
		$vetPlano = $fPlano->getPlanoDispCodPesqAno($codPesq,$ano);
		$numPlano = count($vetPlano);
		if($vetPlano==false){
			$plano = "Não";
		}
		else{
			$fSelecao  = new fachada_selecao();
			$oSelecao  = $fSelecao->getSelecaoPorPesqTpAno($codPesq,$tpSelecao,$ano);
			$numPedido = $oSelecao->getNumBolsa();
			if($numPedido>$numPlano){
				$plano = "Incompleto";
			}
			else $plano = "Sim";
		}
		return $plano;
	}
	
	function podeCriarPlano_FUNCIONANDO($codPesq,$ano,$tpSelecao){
		$fPlano = new fachada_plano();
		// Retorna um vetor com os planos n�o atribu�dos a uma bolsa
		$vPlanosLivres = $fPlano->getPlanoDispCodPesqAno($codPesq,$ano);
		$numPlanosLivres = count($vPlanosLivres);
		if($vPlanosLivres == false){
			$plano = "podeCriar";
		}
		else{
			$fSelecao  = new fachada_selecao();
			$oSelecao  = $fSelecao->getSelecaoPorPesqTpAno($codPesq,$tpSelecao,$ano);
			$idInscricao = $oSelecao->getCod();
			// Retorna um vetor com os tipos de bolsas solicitadas na inscri��o
			$vBolsaSelecao = $fSelecao->getBolsaSelecaoDesc($oSelecao->getCod());
			$numBolsaSelecao = 0;
			
			if ($vBolsaSelecao){
				// Busca a quantidade m�xima de bolsas solicitadas
				while ($oBolsaSelecao = array_shift($vBolsaSelecao)){
					if ($oBolsaSelecao->getQtdBolsa() == 2){
						$numBolsaSelecao = 2;
						break;
					} 
					elseif($oBolsaSelecao->getQtdBolsa() == 1){
						if ($numBolsaSelecao < 2){
							$numBolsaSelecao += 1;
						}
						else break;
					}
				} // FIM DO WHILE
				$fSelecao->updateNumBolsa($numBolsaSelecao,$codPesq,$tpSelecao);
			}
			
			if($numBolsaSelecao>$numPlanosLivres){
				$plano = "podeCriar_incompleto";
			}
			else $plano = "naoPodeCriar";
		}
		return $plano;
	}
	
	
	function podeCriarPlano($codPesq,$ano,$tpSelecao){
		$fPlano = new fachada_plano();
		// Retorna um vetor com os planos n�o atribu�dos a uma bolsa
		$cont = 0;				
		$vPlanosLivres = $fPlano->getPlanoDispCodPesqAno($codPesq,$ano);		
		if ($vPlanosLivres==false){
			$numPlanosLivres = 0;		
		} else $numPlanosLivres = count($vPlanosLivres);

		$fSelecao  = new fachada_selecao();						
		$oSelecao  = $fSelecao->getSelecaoPorPesqTpAno($codPesq,$tpSelecao,$ano);
		// Retorna um vetor com os tipos de bolsas solicitadas na inscri��o	
		if(!$oSelecao)
		{					
			$oSelecao  = $fSelecao->getSelecaoPorPesqTpAno($codPesq,$_SESSION['sEdital'],$ano);
			$cont = 1;
		}		
		if($_SESSION['sEdital'] == 9)
		{		
		 $vBolsaSelecao = $fSelecao->getBolsaSelecaoDescProdoutor($oSelecao->getCod());				
		}else if($_SESSION['sEdital'] == 20){
		 $vBolsaSelecao = $fSelecao->getBolsaSelecaoDescAcervos($oSelecao->getCod());	
		}else{
		 $vBolsaSelecao = $fSelecao->getBolsaSelecaoDesc($oSelecao->getCod());	
		}		

		$numBolsaSelecao = 0;
		if ($vBolsaSelecao){		
			// Busca a quantidade m�xima de bolsas solicitadas
			while ($oBolsaSelecao = array_shift($vBolsaSelecao)){
				if ($oBolsaSelecao->getQtdBolsa() == 2){
					$numBolsaSelecao = 2;									
					break;
				} 
				elseif($oBolsaSelecao->getQtdBolsa() == 1){
					if ($numBolsaSelecao < 2){

						$numBolsaSelecao += 1;
					}
					
				}elseif($_SESSION['sEdital'] != 1 or $_SESSION['sEdital'] != 2) $numBolsaSelecao += $oBolsaSelecao->getQtdBolsa();
			} // FIM DO WHILE
			
			//$fSelecao->updateNumBolsa($numBolsaSelecao,$codPesq,$tpSelecao);			
			$fBolsa = new fachada_bolsa();
			/*$bolsaPesq = $fBolsa->getBolsaAtivaPesqAno($codPesqs,$ano)
			if($bolsaPesq){
				$qtdBolsa = count($bolsaPesq);
			}else{
				$qtdBolsa = 0;
			}
			if($qtdBolsa> $numBolsaSelecao)*/
			$fSelecao->atualizaNumBolsas($numBolsaSelecao,$codPesq,$tpSelecao,$oSelecao->getCod());			
			if($numBolsaSelecao+1>=$numPlanosLivres && $cont == 0){						
				$plano = "podeCriar";								
			}
			 
			else $plano = "naoPodeCriar";
			
		} // FIM DO if ($vBolsaSelecao){
		else $plano = "naoPodeCriar";

		return $plano;
	}

		
	function hasPlanoAno($codPesq,$ano){
		$fPlano = new fachada_plano();
		$vetPlano = $fPlano->getPlanoCodPesqAno($codPesq,$ano);
		$numPlano = count($vetPlano);
		if($vetPlano==false){
			$plano = "N�o";
		}
		else{
			$fSelecao = new fachada_selecao();
			$oSelecao = $fSelecao->getSelecaoCodPesqAno($codPesq,$ano);
			$numPedido = $oSelecao->getNumBolsa();
			if($numPedido>$numPlano){
				$plano = "Incompleto";
			}
			else $plano = "Sim";
		}
		return $plano;
	}
	function getPlanosAtivosAno($ano,$keyword){
		$fPlano = new fachada_plano();
		$vetPlano = $fPlano->getPlanosAtivosAno($ano,$keyword);
		return $vetPlano;
	}
	function getPlanosPesqAnoEdital($codPesq,$ano,$edital){
		$fPlano = new fachada_plano();
		$vetPlano = $fPlano->getPlanosPesqAnoEdital($codPesq,$ano,$edital);
		return $vetPlano;
	}
	function getPlanosAtivosAvancado($ano,$unidade,$garea,$area){
		$fPlano = new fachada_plano();
		$vetPlano = $fPlano->getPlanosAtivosAvancado($ano,$unidade,$garea,$area);
		return $vetPlano;
	}
	function getDadosResumoPlanosCod($cod){
		$fPlano = new fachada_plano();
		$vetPlano = $fPlano->getDadosResumoPlanosCod($cod);
		return $vetPlano;
	
	}
//fim plano-----------------------------------------------------

//atividade ----------------------------------------------------
	function atividade($a,$b,$c,$d,$e){
		$fAtividade = new fachada_atividade();
		$oAtividade = $fAtividade->atividade($a,$b,$c,$d,$e);
		return $oAtividade;
	}
	function getAtividadeCod($cod){
		$fAtividade = new fachada_atividade();
		$oAtividade = $fAtividade->getAtividadeCod($cod);
		return $oAtividade;
	}
	function getAtividadeCodPlano($codPlano){
		$fAtividade = new fachada_atividade();
		$vetAtividade = $fAtividade->getAtividadeCodPlano($codPlano);
		return $vetAtividade;
	}
	function removeAtividade($cod){
		$fAtividade = new fachada_atividade();
		$fAtividade->removeAtividade($cod);
	}
// fim atividade------------------------------------------------

//instituicoes -------------------------------------------------
	function instituicao($a,$b,$c){
		$fInst = new fachada_instituicao();
		$oInst = $fInst->instituicao ($a,$b,$c);
		return $oInst;
	}
	function getInstituicoes(){
		$fInst = new fachada_instituicao();
		$vetInst = $fInst->getInstituicoes();
		return $vetInst;
	}
	function getInstCod($cod){
		$fInst = new fachada_instituicao();
		$oInst = $fInst->getInstCod($cod);
		return $oInst;
	}
//fim instituicoes -------------------------------------------------

//agencia ---------------------------------------------------------
	function agencia($a,$b,$c){
		$fAgencia = new fachada_agencia();
		$oAgencia = $fAgencia->agencia ($a,$b,$c);
		return $oAgencia;
	}
	function getAgencias(){
		$fAgencia = new fachada_agencia();
		$vetAgencia = $fAgencia->getAgencias();
		return $vetAgencia ;
	}
	function getAgenciaCod($cod){
		$fAgencia = new fachada_agencia();
		$oAgencia = $fAgencia->getAgenciaCod($cod);
		return $oAgencia;
	}
//fim agencia --------------------------------------------------

//notificacao ---------------------------------------------------------
	function notificacao($a,$b,$c){
		$fNotificacao = new fachada_notificacao();
		$oNotificacao = $fNotificacao->notificacao($a,$b,$c);
		return $oNotificacao;
	}
	function getNotificacoes(){
		$fNotificacao = new fachada_notificacao();
		$oNotificacao = $fNotificacao->getNotificacoes();
		return $oNotificacao;
	}
	function getNotificacaoTipo($tipo){
		$fNotificacao = new fachada_notificacao();
		$oNotificacao = $fNotificacao->getNotificacaoTipo($tipo);
		return $oNotificacao;
	}
	function getNotificacaoCod($cod){
		$fNotificacao = new fachada_notificacao();
		$oNotificacao = $fNotificacao->getNotificacaoCod($cod);
		return $oNotificacao;
	}
//fim notificacao --------------------------------------------------

//noticia----------------------------------------------------------
	function noticia($cod,$titulo,$descricao,$data){
		$fNoticia = new fachada_noticia();
		$oNoticia = $fNoticia->noticia($cod,$titulo,$descricao,$data);
		return $oNoticia;
	}
	function getNoticias(){
		$fNoticia = new fachada_noticia();
		$vetNoticia = $fNoticia->getNoticias;
		return $vetNoticia;
	}
	function getNoticiasLimit($inicio,$fim){
		$fNoticia = new fachada_noticia();
		$vetNoticia = $fNoticia->getNoticiasLimit($inicio,$fim);
		return $vetNoticia;
	}
	function getNoticiasOrdData(){
		$fNoticia = new fachada_noticia();
		$vetNoticia = $fNoticia->getNoticiasOrdData();
		return $vetNoticia;
	}
	function getNoticiasOrdDataLimit($inicio,$fim){
		$fNoticia = new fachada_noticia();
		$vetNoticia = $fNoticia->getNoticiasOrdDataLimit($inicio,$fim);
		return $vetNoticia;
	}
	function getNoticiaCod($cod){
		$fNoticia = new fachada_noticia();
		$oNoticia = $fNoticia->getNoticiaCod($cod);
		return $oNoticia;
	}
	function deletaNoticia($vetCod){
		$fNoticia = new fachada_noticia();
		$fNoticia->deletaNoticia($vetCod);
	}
//fim noticia---------------------------------------------------------------



// docportal - documentos e estatistica ------------------------------------
	function docportal($cod,$titulo,$tipo,$codcateg){
		$fDoc       = new fachada_docportal();
		$oDocumento = $fDoc->docportal($cod,$titulo,$tipo,$codcateg);
		return $oDocumento;
	}
	function getDocsTipoCateg($tipo,$codcateg){
		$fDoc   = new fachada_docportal();
		$vetDoc = $fDoc->getDocsTipoCateg($tipo,$codcateg);
		return $vetDoc;
	}
	function getDocsTipo($tipo){
		$fDoc   = new fachada_docportal();
		$vetDoc = $fDoc->getDocsTipo($tipo);
		return $vetDoc;
	}
	function getDocCod($cod){
		$fDoc       = new fachada_docportal();
		$oDocumento = $fDoc->getDocCod($cod);
		return $oDocumento;
	}
	function deletaDoc($cod){
		$fDoc = new fachada_docportal();
		$fDoc->deletaDoc($cod);
	}


//fim docportal-------------------------------------------------------------

//calendario----------------------------------------------------------
	function calendario($cod,$descricao,$dataInicial,$dataFinal){
		$fCalendario = new fachada_calendario();
		$oCalendario = $fCalendario->calendario($cod,$descricao,$dataInicial,$dataFinal);
		return $oCalendario;
	}
	function getCalendarioOrdData(){
		$fCalendario = new fachada_calendario();
		$vetCalendario = $fCalendario->getCalendarioOrdData();
		return $vetCalendario;
	}
	function getCalendarioOrdDataAno(){
		$fCalendario = new fachada_calendario();
		$vetCalendario = $fCalendario->getCalendarioOrdDataAno();
		return $vetCalendario;
	}
	function getCalendarioCod($cod){
		$fCalendario = new fachada_calendario();
		$oCalendario = $fCalendario->getCalendarioCod($cod);
		return $oCalendario;
	}
	function deletaCalendario($vetCod){
		$fCalendario = new fachada_calendario();
		$fCalendario->deletaCalendario($vetCod);
	}
//fim calendario---------------------------------------------------------
//edital----------------------------------------------------------
	function edital($cod,$tipo,$ano){
		$fEdital = new fachada_edital();
		$oEdital = $fEdital->edital($cod,$tipo,$ano);
		return $oEdital;
	}
	function getEditais(){
		$fEdital = new fachada_edital();
		$vetEdital = $fEdital->getEditais();
		return $vetEdital;
	}
	function getEditalTipo($tipo){
		$fEdital = new fachada_edital();
		$vetEdital = $fEdital->getEditalTipo($tipo);
		return $vetEdital;
	}
	function getEditalCod($cod){
		$fEdital = new fachada_edital();
		$oEdital = $fEdital->getEditalCod($cod);
		return $oEdital;
	}
	function deletaEdital($vetCod){
		$fEdital = new fachada_edital();
		$fEdital->deletaEdital($vetCod);
	}
//fim edital---------------------------------------------------------
//tipo de edital-------------------------------------------------
	function tipoedital($cod,$desc){
		$fTpEdital = new fachada_tipoedital();
		$oTipoEdital = $fTpEdital->tipoedital($cod,$desc);
		return $oTipoEdital;
	}
	function getTipoEdital(){
		$fTpEdital = new fachada_tipoedital();
		$vetTipoEdital = $fTpEdital->getTipoEdital();
		return $vetTipoEdital;
	}
	function getTipoEditalCod($cod){
		$fTpEdital = new fachada_tipoedital();
		$oTipoEdital = $fTpEdital->getTipoEditalCod($cod);
		return $oTipoEdital;
	}
	function getDescTipoEditalCod($cod){
		$fTpEdital = new fachada_tipoedital();
		$desc = $fTpEdital->getDescTipoEditalCod($cod);
		return $desc;
	}

// fim tipo de edital--------------------------------------------

//max bolsa------------------------------------------------
	
	function maxbolsa($cod,$ponto,$qtd,$tpselecao,$ano){
		$fMax = new fachada_maxbolsa();
		$oMax = $fMax->maxbolsa($cod,$ponto,$qtd,$tpselecao,$ano);
		return $oMax;
	}
	function getMaxbolsaCod($cod){
		$fMax   = new fachada_maxbolsa();
		$oMax = $fMax->getMaxbolsaCod($cod);
		return $oMax;
	}
	function getMaxbolsaSelecao(){
		$fMax   = new fachada_maxbolsa();
		$vetMax = $fMax->getMaxbolsaSelecao();
		return $vetMax;
	}
	function deletaMaxbolsa($cod){
		$fMax   = new fachada_maxbolsa();
		$vetMax = $fMax->deletaMaxbolsa($cod);
	}


//fim max bolsa------------------------------------------------


//categ portal------------------------------------------------
	
	function categportal($cod,$desc,$tipo){
		$fCateg = new fachada_categportal();
		$oCateg = $fCateg->categportal($cod,$desc,$tipo);
		return $oCateg;
	}
	function getCategPortalTipo($tipo){
		$fCateg = new fachada_categportal();
		$vetCateg = $fCateg->getCategPortalTipo($tipo);
		return $vetCateg;
	}
	function getCategPortalCod($cod){
		$fCateg = new fachada_categportal();
		$oCateg = $fCateg->getCategPortalCod($cod);
		return $oCateg;
	}

//fim categ portal------------------------------------------------


//categ relatorio
	function relatorioresumos($Cod,$CodBolsa,$TipoArquivo,$status){
	    $fRel = new fachada_relatorioresumos();
		$oRel = $fRel->relatorioresumos($Cod,$CodBolsa,$TipoArquivo,$status);
		return $oRel;
	}
	
	function getRelatorio(){
		$fRel = new fachada_relatorioresumos();
		$oRel = $fRel->getRelatorio();
		return $oRel;
	}
	
	function getRelatorioCodBolsa($codBolsa){
		$fRel = new fachada_relatorioresumos();
		$oRel = $fRel->getRelatorioCodBolsa($codBolsa);
		return $oRel;
	}
	
	function getRelatorioCodBolsaTipo($codBolsa,$tipo){
		$fRel = new fachada_relatorioresumos();
		$oRel = $fRel->getRelatorioCodBolsaTipo($codBolsa,$tipo);
		return $oRel;
	}
	
	function getRelatorioCod($cod){
		$fRel = new fachada_relatorioresumos();
		$oRel = $fRel->getRelatorioCod($cod);
		return $oRel;
	}
	
	function getRelatorioTipoArquivo($tipoArquivo){
		$fRel = new fachada_relatorioresumos();
		$oRel = $fRel->getRelatorioTipoArquivo($tipoArquivo);
		return $oRel;
	}
	
	function deletaResumoBolsa($codBolsa){
		$fRel = new fachada_relatorioresumos();
		$fRel->deletaResumoBolsa($codBolsa);
	}
	

//fim categ relatorio
}//fim fachada

?>