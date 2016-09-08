<?php
require_once(dirname(__FILE__).'/javascript.php');
require_once(dirname(__FILE__).'/fachada.php');

class main{
	var $pId;
	var $pAutenticado;
	var $pLogin;
	var $pPagina;
	var $pPerfil;
	var $oFachada;
	var $oJavaScript;
	
	
	
	function main(){
		$this->oFachada = new fachada();
		$this->oJavaScript= new javascript();

		
	}
	function setId($a){
	$this->setId = $a;
	}
	function setAutenticado($auth){
	$this->pAutenticado = $auth;
	}
	function setLogin($lo){
	$this->pLogin = $lo;
	}
	function setPagina($p){
	$this->pPagina = $p;
	}
	function setPerfil($f){
	$this->pPerfil = $f;
	}
	function getId(){
	return $this->setId;
	}
	function getAutenticado(){
	return $this->pAutenticado;
	}
	function getLogin(){
	return $this->pLogin;
	}
	function getPagina(){
	return $this->pPagina;
	}
	
	function getPerfil(){
	return $this->pPerfil;
	}
		
	function head($menu=null,$id=null){
		require_once("ads/tema.php"); //AJUSTAR!
		require_once(dirname(__FILE__).'/config.php');//AJUSTAR
		themeheader($menu,$id);
	}
	function foot(){
	    themefooter(); 
	}
	function negaAcesso(){
		$this->oJavaScript->mensagem(_GBTEXT14);
		$this->oJavaScript->redireciona3("index.php");
	}
	
	function index(){
					
	//verifica se ta logado
		if ( ($this->getAutenticado()) AND ($this->getPagina()=="pdf") ){
			session_name("PIBIC");
			$_SESSION[$_SESSION['sPerfil']];
			header("Location: ".$_GET['pdf'].".php");
			
		}
		elseif($this->getAutenticado()){			
			require_once(dirname(__FILE__).'/control/control_pesquisador.php');
			require_once(dirname(__FILE__).'/control/control_selecao.php');
			require_once(dirname(__FILE__).'/control/control_bolsista.php');
			require_once(dirname(__FILE__).'/control/control_plano.php');
			require_once(dirname(__FILE__).'/control/control_usuario.php');
			require_once(dirname(__FILE__).'/control/control_periodo.php');
			require_once(dirname(__FILE__).'/control/control_pontos.php');
			require_once(dirname(__FILE__).'/control/control_oferta.php');
			require_once(dirname(__FILE__).'/control/control_relatorio.php');
			require_once(dirname(__FILE__).'/control/control_termo.php');
			require_once(dirname(__FILE__).'/control/control_avaliacao.php');
			require_once(dirname(__FILE__).'/control/control_tpbolsa.php');
			require_once(dirname(__FILE__).'/control/control_relatoBolsa.php');
			require_once(dirname(__FILE__).'/control/control_resumo.php');
			require_once(dirname(__FILE__).'/control/control_instituicao.php');
			require_once(dirname(__FILE__).'/control/control_comprovante.php');							
			require_once(dirname(__FILE__).'/control/control_certificado.php');							
			require_once(dirname(__FILE__).'/control/control_unidade.php');	
			require_once(dirname(__FILE__).'/control/control_edital.php');	
			require_once(dirname(__FILE__).'/control/control_tpedital.php');	
			require_once(dirname(__FILE__).'/control/control_categportal.php');

			switch($this->getPagina()){
				case "logoff":
			 		@session_name("PIBIC");
			  		@session_destroy();
			  		$this->oJavaScript->redireciona3("index.php");
				break;
			  	case "pesquisador":
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or $this->getPerfil()=="pesquisador"){
						$oControl = new control_pesquisador($this->getPagina());
					}
					else $this->negaAcesso();
				break;
				case "ficha_pesquisador":
					$pesqId =($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or ($this->getPerfil()=="Pesquisador" and $this->getId()==$pesqId)){
						$oControl = new control_pesquisador($this->getPagina());
					}
					else $this->negaAcesso();
				break;
				case "planilha":
					$pesqId =($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or ($this->getPerfil()=="Pesquisador" and $this->getId()==$pesqId)){
						$oControl = new control_pesquisador($this->getPagina());
					}
					else $this->negaAcesso();
				break;
				case "itemplanilha":
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" ){
						$oControl = new control_pesquisador($this->getPagina());
					}
					else $this->negaAcesso();
				break;
				case "curriculo":
					$pesqId =($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or ($this->getPerfil()=="Pesquisador" and $this->getId()==$pesqId)){
						$oControl = new control_pesquisador($this->getPagina());
					}
					else $this->negaAcesso();
				break;
				case "selecao":
					$pesqId =($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
					if($this->getPerfil()=="Pesquisador" and $this->getId()==$pesqId){
						$oControl = new control_selecao($this->getPagina());
					}
					else $this->negaAcesso();
				break;
				case "atendimento":
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or $this->getPerfil()=="Pesquisador"){
						require_once(dirname(__FILE__).'/control/control_atendimento.php');	
						$oControl = new control_atendimento($this->getPagina());
					}
					else $this->negaAcesso();
				break;
			 		 
			  	case "bolsista":
			  		if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or $this->getPerfil()=="Pesquisador" ){
						$oControl = new control_bolsista($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
				case "listabolsistas":
			  		if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador"){
						$oControl = new control_bolsista($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
			  	case "novo_bolsista":
			  		if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or $this->getPerfil()=="Pesquisador" ){
						$oControl = new control_bolsista($this->getPagina());
					}
					else $this->negaAcesso(); 
			  	break;
			  	case "atualiza_bolsista":
			  		if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or $this->getPerfil()=="Pesquisador" ){
						$oControl = new control_bolsista($this->getPagina());
					}
					else $this->negaAcesso(); 
			  	break;
				case "atualiza_bolsistalista":
			  		if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" ){
						$oControl = new control_bolsista($this->getPagina());
					}
					else $this->negaAcesso(); 
			  	break;
				case "substitui_bolsista":
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador"){
						$oControl = new control_bolsista($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
			  	case "desativa_bolsa":
					require_once(dirname(__FILE__).'/control/control_bolsa.php');
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador"){
						$oControl = new control_bolsa($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
			  	case "substitui_orientador":
					require_once(dirname(__FILE__).'/control/control_bolsa.php');
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador")
						$oControl = new control_bolsa($this->getPagina());
					else $this->negaAcesso();
				break;
				case "termo_bolsa":
					require_once(dirname(__FILE__).'/control/control_bolsa.php');
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador" or $this->getPerfil()=="Pesquisador"){
						$oControl = new control_bolsa($this->getPagina());
					}
					else $this->negaAcesso();
				break;
			  	case "comprovante":
				  	$oControl = new control_comprovante($this->getPagina());	  
			  	break;
				case "certificado":
				  	$oControl = new control_certificado($this->getPagina());	  
			  	break;
			  	case "plano":
					$oControl = new control_plano($this->getPagina());
			  	break;
			  	case "novo_plano":
			  		$oControl = new control_plano($this->getPagina());
			  	break;
			  	case "atualiza_plano":
			  		$oControl = new control_plano($this->getPagina());
			  	break;
				case "select_plano":
					$oControl = new control_plano($this->getPagina());
			  	break;
			  	case "atividade":
			  		$oControl = new control_plano($this->getPagina());
			  	break;
			  	case "atualiza_atividade":
			  		$oControl = new control_plano($this->getPagina());	
			  	break;
			  	case "remover_atividade":
			  		$oControl = new control_plano($this->getPagina());
			  	break;
			  	case "relatorio_bolsa":
			  		$oControl = new control_relatoBolsa($this->getPagina());
			  	break;
				case "relatorio_bollist":
					if($this->getPerfil()=="Administrador" or $this->getPerfil()=="Operador"){
			  			$oControl = new control_relatoBolsa($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
				case "resumo":
			  		$oControl = new control_resumo($this->getPagina());
			  	break;
				case "resumo_bollist":
					if($this->getPerfil()=="Administrador" or $this->getPerfil()=="Operador"){
			  			$oControl = new control_resumo($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
				case "usuario":
					if($this->getPerfil()=="Administrador" ){
			  	 		$oControl = new control_usuario($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
			  	case "novo_usuario":
					if($this->getPerfil()=="Administrador" ){
			  			$oControl = new control_usuario($this->getPagina());
					}
					else $this->negaAcesso();
				break;
			  	case "atualiza_usuario":
					if($this->getPerfil()=="Administrador" ){
			  			$oControl = new control_usuario($this->getPagina());
					}
					else $this->negaAcesso();
			  	break;
			  	case "muda_senha":
					$usrId =($_GET['usrId']!="")?$_GET['usrId']:$_POST['usrId'];
					if ($this->getId()==$usrId)
						$oControl = new control_usuario($this->getPagina());
					else $this->negaAcesso();
			  	break;
			  	case "consultor":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_usuario($this->getPagina());
					else $this->negaAcesso();
			  	break;
			  	case "periodo":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_periodo($this->getPagina());
					else $this->negaAcesso();
			  	break;
			  	case "novo_periodo":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_periodo($this->getPagina());
					else $this->negaAcesso();
			  	break;
			   	case "atualiza_periodo":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_periodo($this->getPagina());
					else $this->negaAcesso();
			  	break;
			  	case "classificacao":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_pontos($this->getPagina());
					else $this->negaAcesso();
			  	break;
			  	case "pontuacao":
					if($this->getPerfil()=="Administrador" )
			   			$oControl = new control_pontos($this->getPagina());
					else $this->negaAcesso();
				break;	
			  	case "oferta":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_oferta($this->getPagina());
					else $this->negaAcesso();
			  	break;
			   	case "nova_oferta":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_oferta($this->getPagina());
					else $this->negaAcesso();
			  	break;
			   	case "atualiza_oferta":
					if($this->getPerfil()=="Administrador" )
			  			$oControl = new control_oferta($this->getPagina());
					else $this->negaAcesso();
			  	break;
			  	case "relatorio":
					if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador"){
						$oControl = new control_relatorio($this->getPagina());
					}
					else $this->negaAcesso();  
			  	break;	
			   	case "termo":
			  		$oControl = new control_termo($this->getPagina());
			  	break;
			  	case "avaliacao":
			  		$oControl = new control_avaliacao($this->getPagina());
			  	break;
			  	case "nova_avaliacao":
			  		$oControl = new control_avaliacao($this->getPagina());
			  	break;
			  	case "remover_avaliacao":
			  		$oControl = new control_avaliacao($this->getPagina());
			  	break;
			   	case "visualiza_objetoAval":
			  		$oControl = new control_avaliacao($this->getPagina());
				break;
			  	case "parecer":
			  		$oControl = new control_avaliacao($this->getPagina());
				break;
				case "parecer_bollist":
			  		if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador"){
						$oControl = new control_avaliacao($this->getPagina());
					}
					else $this->negaAcesso();  	
				break;
			  	case "avaliacao_bolsista":
			  		$oControl = new control_avaliacao($this->getPagina());				 
			  	break;
				case "avaliacao_bollist":
			  		if($this->getPerfil()=="Administrador"  or $this->getPerfil()=="Operador"){
						$oControl = new control_avaliacao($this->getPagina());
					}
					else $this->negaAcesso();  		 
			  	break;
			   	case "avalplanilha":
			   		$oControl = new control_avaliacao($this->getPagina());		
			   	break;
			  	case "mensagem": //corrigir para generalizar, estah para avaliacoes
			  		$oControl = new control_avaliacao($this->getPagina());
				break;
			  	case "tipoBolsa":
			  	   $oControl = new control_tpbolsa($this->getPagina());
			  	break;
			  	case "novo_tipoBolsa":
			  	   $oControl = new control_tpbolsa($this->getPagina());
			  	break;
			   	case "atualiza_tipoBolsa":
			  	   $oControl = new control_tpbolsa($this->getPagina());
			  	break;
			  	case "instituicao":
			  		 $oControl = new control_instituicao($this->getPagina());
			  	break;
			  	case "nova_instituicao":
			  		$oControl = new control_instituicao($this->getPagina());
			  	break;
			  	case "agencia":
					require_once(dirname(__FILE__).'/control/control_agencia.php');	
			  		$oControl = new control_agencia($this->getPagina());
			  	break;
			  	case "nova_agencia":
					require_once(dirname(__FILE__).'/control/control_agencia.php');	
			  		$oControl = new control_agencia($this->getPagina());
			  	break;
				case "notificacao":
					require_once(dirname(__FILE__).'/control/control_notificacao.php');	
			  		$oControl = new control_notificacao($this->getPagina());
			  	break;
				case "noticia":
					require_once(dirname(__FILE__).'/control/control_noticia.php');	
			  		$oControl = new control_noticia($this->getPagina());
			  	break;
				case "atualiza_noticia":
					require_once(dirname(__FILE__).'/control/control_noticia.php');	
			  		$oControl = new control_noticia($this->getPagina());
			  	break;
				case "nova_noticia":
					require_once(dirname(__FILE__).'/control/control_noticia.php');	
			  		$oControl = new control_noticia($this->getPagina());
			  	break;
				case "docportal":
					require_once(dirname(__FILE__).'/control/control_docportal.php');	
			  		$oControl = new control_docportal($this->getPagina());
			  	break;
				case "novo_docportal":
					require_once(dirname(__FILE__).'/control/control_docportal.php');	
			  		$oControl = new control_docportal($this->getPagina());
			  	break;
				case "atualiza_docportal":
					require_once(dirname(__FILE__).'/control/control_docportal.php');	
			  		$oControl = new control_docportal($this->getPagina());
			  	break;
				case "calendario":
					require_once(dirname(__FILE__).'/control/control_calendario.php');
					$oControl = new control_calendario($this->getPagina());
			  	break;
				case "atualiza_calendario":
					require_once(dirname(__FILE__).'/control/control_calendario.php');
					$oControl = new control_calendario($this->getPagina());
			  	break;
				case "novo_calendario":
					require_once(dirname(__FILE__).'/control/control_calendario.php');
					$oControl = new control_calendario($this->getPagina());
			  	break;
				case "unidade":
			  		$oControl = new control_unidade($this->getPagina());
			  	break;
				case "nova_unidade":
			  		$oControl = new control_unidade($this->getPagina());
			  	break;
				case "atualiza_unidade":
			  		$oControl = new control_unidade($this->getPagina());
			  	break;
				case "edital":
			  		$oControl = new control_edital($this->getPagina());
			  	break;
				case "novo_edital":
			  		$oControl = new control_edital($this->getPagina());
			  	break;
				case "atualiza_edital":
			  		$oControl = new control_edital($this->getPagina());
			  	break;
				case "tipoedital":
			  	   $oControl = new control_tpedital($this->getPagina());
			  	break;
			  	case "novo_tipoedital":
			  	   $oControl = new control_tpedital($this->getPagina());
			  	break;
			   	case "atualiza_tipoedital":
			  	   $oControl = new control_tpedital($this->getPagina());
			  	break;
				case "maxbolsa":
					require_once(dirname(__FILE__).'/control/control_maxbolsa.php');
					$oControl = new control_maxbolsa($this->getPagina());
				break;
				case "novo_maxbolsa":
					require_once(dirname(__FILE__).'/control/control_maxbolsa.php');
					$oControl = new control_maxbolsa($this->getPagina());
				break;
				case "atualiza_maxbolsa":
					require_once(dirname(__FILE__).'/control/control_maxbolsa.php');
					$oControl = new control_maxbolsa($this->getPagina());
				break;
				case "deleta_maxbolsa":
					require_once(dirname(__FILE__).'/control/control_maxbolsa.php');
					$oControl = new control_maxbolsa($this->getPagina());
				break;
				case "categportal":
			  	   $oControl = new control_categportal($this->getPagina());
			  	break;
			  	case "nova_categportal":
			  	   $oControl = new control_categportal($this->getPagina());
			  	break;
			  	default:

					if ($this->getPerfil()=="Pesquisador"){
						require_once(dirname(__FILE__).'/form/form_pesquisador.php');
						$this->head("pesquisador","");
        				$frmPesquisador = new form_pesquisador();
        				$frmPesquisador->setId($this->getId());
        				$frmPesquisador->setPerfilLogado($this->getPerfil());
        				$frmPesquisador->form_ficha("update");
        				$this->foot();
        			}
        			elseif ($this->getPerfil()=="Consultor"){
        				require_once(dirname(__FILE__).'/form/form_avaliacao.php');
						$this->head("","");
        				$frmAval = new form_avaliacao();
        				$tipo = '3';
        				$frmAval->setTipo($tipo);
        				$frmAval->setPerfilLogado($this->getPerfil());
        				$frmAval->form_admin($this->getId());
        				$this->foot();
        			}
        			else
        			{
						require_once(dirname(__FILE__).'/princ.php');
    			    	$this->head("dpq");
    				  	$oPrincipal = new principal();
    				  	$oPrincipal->setPerfil($this->getPerfil());
    				  	$oPrincipal->menu();
    				  	$this->foot();
					}
			      
		    }// fim switch
			
		} //fim if autenticado
		else {
			require_once(dirname(__FILE__).'/control/control_livre.php');
			$oControl = new control_livre($this->getPagina());
		}
	}
}
?>