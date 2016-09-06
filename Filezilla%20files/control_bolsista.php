<?php

require_once('./control.php');
require_once('./form/form_bolsista.php');

class control_bolsista extends control{
	
	function control_bolsista($pg){
		control::control();
		control::setPagina($pg);
		switch($this->getPagina()){
			case "bolsista":
				$pesqId  = ($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
			  	$pagina2 = $_POST['pg'];
				$this->head("pesquisador",$pesqId);

				$frmBolsista = new form_bolsista();
				$frmBolsista->setPerfilLogado($this->getPerfil());

				if($_POST['acao']=="novo" OR $_POST['acao']=="update" OR $_POST['acao']=="substituir_novo" OR $_POST['acao']=="substituir_incluir" OR $_POST['acao']=="incluir"){
					$oBolsista = $this->oFachada->bolsista($_POST['bolCod'],$_POST['form_nome'],$_POST['form_rg'],$_POST['form_orgao'],$_POST['form_dtRg'],$_POST['form_cpf'],$_POST['form_sexo'],$_POST['form_nacionalidade'],$_POST['form_naturalidade'],$_POST['form_origem'],$_POST['form_dtnasc'],$_POST['form_endereco'],$_POST['form_fone'],$_POST['form_cidade'],$_POST['form_bairro'],$_POST['form_estado'],$_POST['form_cep'],$_POST['form_email'],$_POST['lstInstituicao'],$_POST['form_curso'],$_POST['form_matricula'],$_POST['form_banco'],$_POST['form_agencia'],$_POST['form_conta'],"",$_POST['form_cota']);
					if($this->oFachada->valida($oBolsista,"bolsista")){
						//	acao=novo    -> novo bolsista e nova bolsa
						//	acao=incluir -> nova bolsa mas bolsista já na base
						if($_POST['acao']=="novo" OR $_POST['acao']=="incluir"){ 

							// Testando se há algum periodo aberto de cadastro
							$oFachada=new fachada();
							$vetPeriodo = $oFachada->getPeriodoAberto('2');
							if($vetPeriodo){
								$oPeriodo   = array_shift($vetPeriodo);
								$anoBolsa  = $oPeriodo->getAno();				
							}
							$oBolsa     = $this->oFachada->bolsa('',$pesqId,'',$_SESSION['sAno'],'','','','');
							//Valor recebido trocado
							$tpSelecao  = $_SESSION['sEdital'];
							//$tpSelecao  =$_POST['tpSelecao'];							
							if($_POST['acao']=="novo") $idBolsista = $this->oFachada->insere($oBolsista,"bolsista");
							else					   $idBolsista = $_POST['bolCod'];
							//	Busca os tipos de bolsas ofertados em determinado edital, por ordem de prioridade
							$vOferta  = $oFachada->getOfertasAnoEdital($_SESSION['sAno'],$tpSelecao);	
							$numPlanos = $oFachada->getPlanoCodPesq($pesqId);
							$numBolsasGeral = $oFachada->getBolsaAtivaPesqAno($pesqId,$_SESSION['sAno']);
							
							if(!$numBolsasGeral){
								$qtBolsas = 0;
							}else{
								$qtBolsas = count($numBolsasGeral);
							}
							
							if ($vOferta){
								// Quantidade máxima de bolsas que o pesquisador pode receber
								//Linha abaixo alterada para suportar os bolsistas do Pibic-PE
/*COTA MÁXIMA AO LADO -->!*/	$_COTA_MAX_BOLSA  = 7; 
								//	Quantidade de bolsas ativas (com bolsistas implementados) que possui no edital em vigor
								$vetBolsas        = $this->oFachada->getBolsaAtivaPesqAnoTp($pesqId,$anoBolsa,$tpSelecao);
								//$vetBolsas        = $this->oFachada->getBolsaAtivaPesqAnoTp($pesqId,2015,$tpSelecao);
								if($vetBolsas){								
									$numBolsasAtivas    = count($vetBolsas);
								} else $numBolsasAtivas = 0;								
								//	BUSCA O TIPO DA BOLSA COM A QUAL O PESQUISADOR FOI CONTEMPLADO	
															;
								while($oferta = array_shift($vOferta)){									
									$oAtend = $this->oFachada->getAtendPorPesqTpAno($pesqId,$oferta->getCodTipoBolsa(),$_SESSION['sAno']);
									// CASO O PESQUISADOR TENHA SIDO ATENDIDO COM A MODALIDADE DE BOLSA EM QUESTAO											
									
									if($oAtend)	{																		
										// Verifica a quantidade de bolsas de determinado tipo que o pesquisador já possui implementada 
										$temBolsaTipo = $oFachada->getBolsaTipoPesqAnoAtiva($pesqId,$oferta->getCodTipoBolsa(),$_SESSION['sAno']);
										if ($temBolsaTipo==false) $numBolsaTipo = 0;
										else $numBolsaTipo = count($temBolsaTipo);				
																				
										if ($numPlanos) $qtPlanos = count($numPlanos);
										else $qtPlanos = 0;
										

																			
										if (($numBolsasAtivas<$_COTA_MAX_BOLSA) and ($qtBolsas<=$qtPlanos)){												
										/*Menor  ou igual adicionado ao teste abaixo. Trocar por uma solução melhor*/	
											
											if ($numBolsaTipo<$oAtend->getQtd()){													
												$oBolsa->setTipo($oferta->getCodTipoBolsa());
												break;
											}
										}
									} // Fim $oAtend
								}//fim while
		
								// IMPLEMENTAÇÃO DA BOLSA

								if($oBolsa->getTipo()!=""){
									if($_POST['acao']=="incluir") $this->oFachada->atualiza($oBolsista,"bolsista");
									$idBolsa    = $this->oFachada->insere($oBolsa,"bolsa");
									$oBolsistaB = $this->oFachada->bolsistabolsa($idBolsa,$idBolsista,"","");
									$this->oFachada->insere($oBolsistaB,"bolsistabolsa");
									$frmBolsista->setCod($idBolsista);
									$frmBolsista->setCodBolsa($idBolsa);
									$frmBolsista->form_cadbolsista($pesqId,"update");
									$this->foot();
									$this->oJavaScript->mensagem(_GBTEXT2);
								}elseif($qtBolsas>=$qtPlanos and $_SESSION['sEdital'] != 10){							
									$frmBolsista->form_admin($pesqId,$pagina2);
									$this->foot();			
									//$this->oJavaScript->mensagem($tpSelecao);									
									$this->oJavaScript->mensagem("Número de planos insuficiente");
								}
								else{
									$frmBolsista->form_admin($pesqId,$pagina2);
									$this->foot();			
									//$this->oJavaScript->mensagem($tpSelecao);									
									$this->oJavaScript->mensagem("Cota de bolsas já alcançada");
								}//fim if tipobolsa
							}
							else {
								$frmBolsista->form_admin($pesqId,$pagina2);
								$this->foot();
								$this->oJavaScript->mensagem("Oferta de bolsas não definida no sistema.");
							}//fim oferta
						}
						elseif($_POST['acao']=="update"){
							$this->oFachada->atualiza($oBolsista,"bolsista");
							$frmBolsista->setCod($_POST['bolCod']);
							$frmBolsista->setCodBolsa($_POST['bolsaCod']);
							$frmBolsista->form_cadbolsista($pesqId,"update");
							$this->foot();
							$this->oJavaScript->mensagem(_GBTEXT3);
						}
						//substitui bolsista da bolsa por um q nao estah na base
						elseif($_POST['acao']=="substituir_novo"){  
							$dia  = date('d');
							$mes  = date('m');
							$ano  = date('Y');
							$data = "$dia/$mes/$ano";
							$oBB  = $this->oFachada->getBolsistaBAtivoCodBolsa($_POST['bolsaCod']);
							$oBB->setDtFinal($data);
							$this->oFachada->atualiza($oBB,"bolsistabolsa");
							$idBolsista = $this->oFachada->insere($oBolsista,"bolsista");
							$oBolsistaB = $this->oFachada->bolsistabolsa($_POST['bolsaCod'],$idBolsista,"","");
							$this->oFachada->insere($oBolsistaB,"bolsistabolsa");
							$frmBolsista->setCod($idBolsista);
							$frmBolsista->setCodBolsa($_POST['bolsaCod']);
							$frmBolsista->form_cadbolsista($pesqId,"update");
							$this->foot();
							$this->oJavaScript->mensagem("Substituição realizada com sucesso.");
						}
						//substitui bolsista da bolsa por um q já estava na base
						elseif($_POST['acao']=="substituir_incluir"){ 
							$dia  = date('d');
							$mes  = date('m');
							$ano  = date('Y');
							$data = "$dia/$mes/$ano";
							$oBB  = $this->oFachada->getBolsistaBAtivoCodBolsa($_POST['bolsaCod']);
							$oBB->setDtFinal($data);
							$this->oFachada->atualiza($oBB,"bolsistabolsa");
							$this->oFachada->atualiza($oBolsista,"bolsista");
							$oBolsistaB = $this->oFachada->bolsistabolsa($_POST['bolsaCod'],$oBolsista->getCod(),"","");
							$this->oFachada->insere($oBolsistaB,"bolsistabolsa");
							$frmBolsista->setCod($oBolsista->getCod());
							$frmBolsista->setCodBolsa($_POST['bolsaCod']);
							$frmBolsista->form_cadbolsista($pesqId,"update");
							$this->foot();
							$this->oJavaScript->mensagem("Substituição realizada com sucesso.");
						}
						
					}// fim if valida bolsista
					else{
						$this->oFachada->err();
						$this->foot();
					}					
				}// fim if acao
				else{
					$frmBolsista->form_admin($pesqId,$pagina2);
					$this->foot();
				}
						  
			break;
			case "listabolsistas":
				$pagina2   = $_POST['pg'];
				$fConsulta = $_POST['form_consulta'];
				$this->head("listabolsistas","");
				
				$frmBolsista = new form_bolsista();
				$frmBolsista->setPerfilLogado($this->getPerfil());
				if($_POST['acao']=="update_bollist"){
					$oBolsista = $this->oFachada->bolsista($_POST['bolCod'],$_POST['form_nome'],$_POST['form_rg'],$_POST['form_orgao'],$_POST['form_dtRg'],$_POST['form_cpf'],$_POST['form_sexo'],$_POST['form_nacionalidade'],$_POST['form_naturalidade'],$_POST['form_origem'],$_POST['form_dtnasc'],$_POST['form_endereco'],$_POST['form_fone'],$_POST['form_cidade'],$_POST['form_bairro'],$_POST['form_estado'],$_POST['form_cep'],$_POST['form_email'],$_POST['lstInstituicao'],$_POST['form_curso'],$_POST['form_matricula'],$_POST['form_banco'],$_POST['form_agencia'],$_POST['form_conta'],"",$_POST['form_cota']);
					if($this->oFachada->valida($oBolsista,"bolsista")){
						$this->oFachada->atualiza($oBolsista,"bolsista");
						$frmBolsista->setCod($_POST['bolCod']);
						$frmBolsista->setCodBolsa($_POST['bolsaCod']);
						$frmBolsista->form_cadbolsista($pesqId,"update_bollist");
						$this->foot();
						$this->oJavaScript->mensagem(_GBTEXT3);
					}
					else{
						$this->oFachada->err();
						$this->foot();
					}		
				}
				else{
					$frmBolsista->form_adminbolsistas($fConsulta,$pagina2);
					$this->foot();
				}
			
			break;
			case "novo_bolsista":
				$pesqId   = ($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
				$acao2    = ($_GET['acao2']!="")?$_GET['acao2']:$_POST['acao2'];
				$bolsaCod = ($_GET['bolsaCod']!="")?$_GET['bolsaCod']:$_POST['bolsaCod'];
			  	$this->head("pesquisador",$pesqId);
				$tpSelecao = "";
				if($this->getPerfil()=="Pesquisador"){
					$vetPeriodo     = $this->oFachada->getPeriodoAberto('2');
					if($vetPeriodo){
						$oPeriodo   = array_shift($vetPeriodo);
						$tpSelecao  = $oPeriodo->getTpSelecao();
						$anoBolsa = $oPeriodo->getAno();		
					}
				}
				else {
					$tpSelecao = $_SESSION['sEdital']; 
					$anoBolsa = $_SESSION['sAno'];	
				}
			/**/	$tpSelecao = $_SESSION['sEdital']; 								
				$frmBolsista = new form_bolsista();
				$frmBolsista->setCodBolsa($bolsaCod);
				if ($acao2!="substituir" and $this->getPerfil()=="Pesquisador" and (($tpSelecao=="") or ($this->oFachada->valida_insercaoAno($pesqId,$tpSelecao,$anoBolsa)==false))){
					$this->oFachada->err();
				}
				elseif($acao2!="substituir" and $this->oFachada->valida_insercaoAno($pesqId,$tpSelecao,$anoBolsa)==false){
					$this->oFachada->err();
				}

				elseif($acao2=="substituir" and $this->oFachada->valida_substituicao($bolsaCod)==false){
					$this->oFachada->err();
				}
				elseif($_POST['acao']=="novo"){
					$acao=($acao2=="substituir")?"substituir_novo":"novo";
					$frmBolsista->setPerfilLogado($this->getPerfil());
					$frmBolsista->form_cadbolsista($pesqId,$acao,$tpSelecao);
				}
				elseif($_POST['acao']=="incluir"){
					$acao=($acao2=="substituir")?"substituir_incluir":"incluir";
					$frmBolsista->setPerfilLogado($this->getPerfil());
					$frmBolsista->setCod($_POST['bolCod']);
					$frmBolsista->form_cadbolsista($pesqId,$acao,$tpSelecao);
				}
				elseif($_POST['acao']=="buscar"){
					$frmBolsista->form_buscabolsista($pesqId,$_POST['form_cpf'],$acao2);	
				}
				else{
					$frmBolsista->form_buscabolsista($pesqId,"",$acao2);
				}
				$this->foot();
				
			break;
							
			case "atualiza_bolsista":
			  	$pesqId=($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
			  	$this->head("pesquisador",$pesqId);
			  	$frmBolsista = new form_bolsista();
				$frmBolsista->setCod($_GET['bolCod']);
				$frmBolsista->setCodBolsa($_GET['bolsaCod']);
				$frmBolsista->setPerfilLogado($this->getPerfil());
			  	$frmBolsista->form_cadbolsista($pesqId,"update");
				$this->foot();
			break;
			case "atualiza_bolsistalista":
			  	$this->head("listabolsistas","");
			  	$frmBolsista = new form_bolsista();
				$frmBolsista->setCod($_GET['bolCod']);
				$frmBolsista->setCodBolsa($_GET['bolsaCod']);
				$frmBolsista->setPerfilLogado($this->getPerfil());
			  	$frmBolsista->form_cadbolsista("","update_bollist");
				$this->foot();
			break;
			case "substitui_bolsista":
				$frmBolsista = new form_bolsista();
				$pesqId=$_GET['pesqId'];
				$this->head("pesquisador",$pesqId);
				$frmBolsista->setCodBolsa($_GET['bolsaCod']);
				$frmBolsista->setPerfilLogado($this->getPerfil());
				if ($this->oFachada->valida_substituicao($_GET['bolsaCod'])){
					$frmBolsista->form_buscabolsista($pesqId,"","substituir");
				}
				else{
					$this->oFachada->err();
				}
				$this->foot();
			break;
			case "comprovante_bolsista":
			$frmBolsista = new form_bolsista();
				$pesqId=$_GET['pesqId'];
				$this->head("pesquisador",$pesqId);
				$frmBolsista->setCodBolsa($_GET['bolsaCod']);
				$frmBolsista->setPerfilLogado($this->getPerfil());
				if ($this->oFachada->valida_substituicao($_GET['bolsaCod'])){
					$frmBolsista->form_buscabolsista($pesqId,"","substituir");
				}
				else{
					$this->oFachada->err();
				}
				$this->foot();
			break;
			default:			
				$this->oJavaScript->redireciona3("index.php");
			  
		}
		
	}
	
}


?>