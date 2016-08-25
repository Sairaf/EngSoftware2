<?php

require_once('./control.php');
require_once('./form/form_pesquisador.php');
require_once('./form/form_curriculo.php');


class control_pesquisador extends control{
	
	function control_pesquisador($pg){
		control::control();
		control::setPagina($pg);
		switch($this->getPagina()){
			case "pesquisador":
				$this->head("","");
			  	$frmPesquisador = new form_pesquisador();
				
				// Filtra pesquisadores Aprovados e Reprovados
				$fClassificado=$_POST['form_class'];
				// Filtra pesquisadores por Nome ou Unidade
				$fColuna=$_POST['form_coluna'];
				// Texto a ser buscado
				$fConsulta=$_POST['form_consulta'];
				// pg recebe o valor 1
				$pagina2=$_POST['pg'];
				
				$frmPesquisador->setPerfilLogado($this->getPerfil());
				// pesqId exibe a listagem completa com nome de todos os pesquisadores paginados?
				if ($_POST['pesqId']==""){
				//nLinhas recebe $cLinha em form_pesquisador.php. Quantidade de registros retornados
					for($i=1;$i<=$_POST['nLinhas'];$i++){
						if($_POST['form_check'.$i]==1){
							$fExe=true;
							$id=$_POST['form_id'.$i];
							if($_POST['acao']=="ativar"){
				   				$this->oFachada->ativa($id,"pesquisador");
							}
				   			elseif($_POST['acao']=="desativar"){
				   				$this->oFachada->desativa($id,"pesquisador");
							}
				   			elseif($_POST['acao']=="aprovar"){
				   				$this->oFachada->aprova($id);
				   			}
				   			elseif($_POST['acao']=="reprovar"){
				   				$this->oFachada->reprova($id);
				   			}
						}
					}
					if ($fExe){
						$this->oJavaScript->mensagem("Operação efetuada com sucesso.");
					}
				}// fim if post id
				else {
					$id = $_POST['pesqId'];
					if($_POST['acao']=="ativar"){
						$this->oFachada->ativa($id,"pesquisador");
						$this->oJavaScript->mensagem(_GBTEXT6);
				   	}
				   	elseif($_POST['acao']=="desativar"){
				   		$this->oFachada->desativa($id,"pesquisador");
						$this->oJavaScript->mensagem(_GBTEXT4);
				   	}
				   	elseif($_POST['acao']=="aprovar"){
				   		$this->oFachada->aprova($id);
						$this->oJavaScript->mensagem("Pesquisador aprovado com sucesso.");
				   	}
				   	elseif($_POST['acao']=="reprovar"){
				   		$this->oFachada->reprova($id);
						$this->oJavaScript->mensagem("Pesquisador reprovado com sucesso.");
				   	}
				}//fim else post id
				$frmPesquisador->form_admin($fClassificado,$fColuna,$fConsulta,$pagina2);
				$this->foot();
			break;
			case "ficha_pesquisador":
				$pesqId =($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
			  	$this->head("pesquisador",$pesqId);
				$frmPesquisador = new form_pesquisador();
				$frmPesquisador->setId($pesqId);
				$frmPesquisador->setPerfilLogado($this->getPerfil());
	   			if ($_POST['acao']=="update"){
					$oPesquisador = $this->oFachada->pesquisador($pesqId,$_POST['form_titulo'],$_POST['form_anoTitu'],$_POST['form_localTitu'],$_POST['form_finanTitu'],$_POST['form_depart'],$_POST['form_fone'],$_POST['form_categoria'],$_POST['form_unid'],$_POST['lstArea'],$_POST['lstSubArea'],$_POST['form_esp'],$_POST['form_dtnasc'],$_POST['form_nacionalidade'],$_POST['form_naturalidade'],$_POST['form_origem'],$_POST['form_orientPos'],$_POST['form_localPos'],$_POST['form_Prod'],$_POST['form_ic'],$_POST['lstAgencia'],$_POST['form_celular']);
					$oUsuario 	  = $this->oFachada->getUsuarioId($pesqId);
					
					if($_POST['form_email2']){
						$email    = $_POST['form_email'].",".$_POST['form_email2'];
					}
					else $email   = $_POST['form_email'];
					
					$oUsuario->setNome($_POST['form_nome']);
					$oUsuario->setCpf($_POST['form_cpf']);
					$oUsuario->setEmail($email);

					$form_aceitaBolsa1 	= 	$_POST['form_aceitaBolsa1'];
					$form_aceitaBolsa2 	= 	$_POST['form_aceitaBolsa2'];
					$form_aceitaBolsa3 	= 	$_POST['form_aceitaBolsa3'];
					$form_aceitaBolsa4 	= 	$_POST['form_aceitaBolsa4'];
					$form_aceitaBolsa5 	= 	$_POST['form_aceitaBolsa5'];
					$form_aceitaBolsa6 	= 	$_POST['form_aceitaBolsa6'];
					$form_aceitaBolsa8 	= 	$_POST['form_aceitaBolsa8'];
					$form_aceitaBolsa17 = 	$_POST['form_aceitaBolsa17'];
					$form_aceitaBolsa25 = 	$_POST['form_aceitaBolsa25'];
					
					$form_prioridBolsa1 = 	$_POST['form_prioridBolsa1'];
					$form_prioridBolsa2 = 	$_POST['form_prioridBolsa2'];
					$form_prioridBolsa3 = 	$_POST['form_prioridBolsa3'];
					$form_prioridBolsa4 = 	$_POST['form_prioridBolsa4'];
					$form_prioridBolsa5 = 	$_POST['form_prioridBolsa5'];
					$form_prioridBolsa6 = 	$_POST['form_prioridBolsa6'];
					$form_prioridBolsa8 = 	$_POST['form_prioridBolsa8'];
					$form_prioridBolsa17 = 	$_POST['form_prioridBolsa17'];
					$form_prioridBolsa25 = 	$_POST['form_prioridBolsa25'];
					
					$form_qtdBolsa1 	= 	$_POST['form_qtdBolsa1'];
					$form_qtdBolsa2 	= 	$_POST['form_qtdBolsa2'];
					$form_qtdBolsa3 	= 	$_POST['form_qtdBolsa3'];
					$form_qtdBolsa4 	= 	$_POST['form_qtdBolsa4'];
					$form_qtdBolsa5 	= 	$_POST['form_qtdBolsa5'];
					$form_qtdBolsa6 	= 	$_POST['form_qtdBolsa6'];
					$form_qtdBolsa8 	= 	$_POST['form_qtdBolsa8'];
					$form_qtdBolsa17 	= 	$_POST['form_qtdBolsa17'];
					$form_qtdBolsa25 	= 	$_POST['form_qtdBolsa25'];
					
					$oPeriodoIn     = $this->oFachada->getInscricaoAberta();
					if($oPeriodoIn){
						$tpSelecao  = $oPeriodoIn->getTpSelecao();
					}
					else $tpSelecao=1;
					
					if ($this->oFachada->valida($oPesquisador,"pesquisador") AND $this->oFachada->valida($oUsuario,"usuario")){
						$this->oFachada->atualiza($oUsuario,"usuario"); 
						$this->oFachada->atualiza($oPesquisador,"pesquisador");

						$oSelecao = $this->oFachada->getSelecaoPorPesqAnoTp($pesqId,$tpSelecao);
	
						$tipoBolsa=1;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa1)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa1)){
									$form_prioridBolsa1 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa1)){
									$form_qtdBolsa1 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa1,$form_qtdBolsa1);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa1)){
									$form_prioridBolsa1 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa1)){
									$form_qtdBolsa1 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa1,$form_qtdBolsa1);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
								$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}

						$tipoBolsa=2;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa2)){
							
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa2)){
									$form_prioridBolsa2 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa2)){
									$form_qtdBolsa2 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa2,$form_qtdBolsa2);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa2)){
									$form_prioridBolsa2 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa2)){
									$form_qtdBolsa2 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa2,$form_qtdBolsa2);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
								$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$tipoBolsa=3;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa3)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa3)){
									$form_prioridBolsa3 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa3)){
									$form_qtdBolsa3 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa3,$form_qtdBolsa3);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa3)){
									$form_prioridBolsa3 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa3)){
									$form_qtdBolsa3 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa3,$form_qtdBolsa3);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
						$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$tipoBolsa=4;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa4)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa4)){
									$form_prioridBolsa4 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa4)){
									$form_qtdBolsa4 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa4,$form_qtdBolsa4);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa4)){
									$form_prioridBolsa4 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa4)){
									$form_qtdBolsa4 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa4,$form_qtdBolsa4);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
						$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$tipoBolsa=5;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa5)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa5)){
									$form_prioridBolsa5 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa5)){
									$form_qtdBolsa5 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa5,$form_qtdBolsa5);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa5)){
									$form_prioridBolsa5 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa5)){
									$form_qtdBolsa5 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa5,$form_qtdBolsa5);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
						$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$tipoBolsa=6;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa6)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa6)){
									$form_prioridBolsa6 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa6)){
									$form_qtdBolsa6 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa6,$form_qtdBolsa6);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa6)){
									$form_prioridBolsa6 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa6)){
									$form_qtdBolsa6 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa6,$form_qtdBolsa6);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
						$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$tipoBolsa=8;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa8)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa8)){
									$form_prioridBolsa8 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa8)){
									$form_qtdBolsa8 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa8,$form_qtdBolsa8);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa8)){
									$form_prioridBolsa8 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa8)){
									$form_qtdBolsa8 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa8,$form_qtdBolsa8);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
						$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$tipoBolsa=17;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa17)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa17)){
									$form_prioridBolsa17 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa17)){
									$form_qtdBolsa17 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa17,$form_qtdBolsa17);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa17)){
									$form_prioridBolsa17 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa17)){
									$form_qtdBolsa17 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa17,$form_qtdBolsa17);
								
							}
						}else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
						$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$tipoBolsa=25;
						// SE O CAMPO DE ACEITE DA BOLSA FOI MARCADO
						if(isset($form_aceitaBolsa25)){
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa25)){
									$form_prioridBolsa25 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa25)){
									$form_qtdBolsa25 = 1;	
								}
								$this->oFachada->updateNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa25,$form_qtdBolsa25);
							}
							// SE NÃO HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA, INSERE NO BD
							else {
								// Se a prioridade não for setada, seta como 5
								if(empty($form_prioridBolsa25)){
									$form_prioridBolsa25 = 5;	
								}
								// Se a quantidade não for setada, seta como 1
								if(empty($form_qtdBolsa25)){
									$form_qtdBolsa25 = 1;	
								}
								$this->oFachada->insereNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa,$form_prioridBolsa25,$form_qtdBolsa25);
								
							}
						} 
						// SE INTERESSE NÃO ESTÁ SETADO MAS HÁ REGISTRO NO BD
						else{
							// VERIFICA SE HÁ REGISTRO DE SOLICITAÇÃO DA BOLSA
							$oBolsaSelecao = $this->oFachada->getBolsaSelecaoTipo($oSelecao->getCod(),$tipoBolsa);
							if ($oBolsaSelecao){
								// SE HÁ REGISTROS NO BD DO TIPO DA BOLSA MAS O INTERESSE NÃO FOI SETADO, EXCLUI O REGISTRO
						$this->oFachada->deleteNumBolsaSelecao($oSelecao->getCod(),$tipoBolsa);
							}
						}
						
						$this->oJavaScript->mensagem(_GBTEXT3);
						$frmPesquisador->form_ficha("update");
					} // Fim if ($this->oFachada->valida($oPesquisador,"pesquisador")and $this->oFachada->valida($oUsuario,"usuario"))
					
					
						
					else {
						$this->oFachada->err();
					}
			 	} // Fim if ($_POST['acao']=="update"){
				else{
					$frmPesquisador->form_ficha("update");
				}
				$this->foot();	  
			break;
			case "planilha":
				$pesqId =($_GET['pesqId']!="")?$_GET['pesqId']:$_POST['pesqId'];
			  	$this->head("pesquisador",$pesqId);
			  	$frmPlanilha = new form_planilha();
				$frmPlanilha->setId($pesqId);
				$frmPlanilha->setPerfilLogado($this->getPerfil());
				if (!$this->oFachada->hasPlanilha($pesqId) and $_POST['acao']!="Novo"){
				 	$frmPlanilha->form_plan("Novo");
				 }
				 elseif ($_POST['acao']=="Novo"){
				 	$this->oFachada->nova_planilha($pesqId,$_POST['ncampo']);
					$this->oJavaScript->mensagem(_GBTEXT3);
					$frmPlanilha->form_plan("update");
					}
				elseif ($_POST['acao']=="update"){
					$this->oFachada->atualiza_planilha($pesqId,$_POST['ncampo']);
					$frmPlanilha->form_plan("update");
					$this->oJavaScript->mensagem(_GBTEXT3);
					
					
					}
				else {
					$frmPlanilha->form_plan("update");
					}
				$this->foot();
			break;
			case "itemplanilha":
				$this->head("","");
				$frmPlanilha = new form_planilha();
			  	if ($_POST['acao']=="update"){
					$nCampo = $_POST['ncampo'];
					for ($i=1;$i<=$nCampo;$i++){
						$oItemProd = $this->oFachada->itemproducao($_POST['cod'.$i],"","",$_POST['valor'.$i]);
						if($oItemProd)
							$this->oFachada->updatePontos($oItemProd);
					}
					$this->oJavaScript->mensagem(_GBTEXT3);
					$frmPlanilha->form_itemplan("update");
				}
				else {
					$frmPlanilha->form_itemplan("update");
				}
				$this->foot();
			break;
			case "curriculo":
				if ($_GET['pesqId']!=""){ $pesqId=$_GET['pesqId'];}
				else{$pesqId=$_POST['pesqId'];}
			   	$this->head("pesquisador",$pesqId);
				if ($_POST['acao']=="update"){
					$oArquivo = $this->oFachada->arquivo();
					$oArquivo->setCod($pesqId);
					$oArquivo->setDiretorio('curriculo');
					if ($this->oFachada->upload($oArquivo)){
						$frmCurriculo= new form_curriculo();
						$frmCurriculo->setId($pesqId);
				 		$frmCurriculo->setPerfilLogado($this->getPerfil());
						$frmCurriculo->form_curric("update");
					}
					else{
						$this->oFachada->err();
					}
				 }
				 else {
				 	$frmCurriculo= new form_curriculo();
					$frmCurriculo->setId($pesqId);
					$frmCurriculo->setPerfilLogado($this->getPerfil());
					$frmCurriculo->form_curric("update");
				}
				$this->foot();
			break;
			default:
				$this->oJavaScript->redireciona3("index.php");
			}
		
	}
	
}


?>