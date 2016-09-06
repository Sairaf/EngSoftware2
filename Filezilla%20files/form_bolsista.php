<?php
require_once('./fachada.php');


class form_bolsista{
	var $pCod;
	var $pCodBolsa;
	var $pPerfilLogado;
		
	function setCod ($a){
		$this->pCod=$a;
	}
	function setCodBolsa ($b){
		$this->pCodBolsa=$b;
	}
	function setPerfilLogado($b){
		$this->pPerfilLogado = $b;
	}
	function getCod(){
		return $this->pCod;
	}
	function getCodBolsa (){
		return $this->pCodBolsa;
	}
	function getPerfilLogado(){
		return $this->pPerfilLogado ;
	}
		

	function form_admin($codPesq,$pagina2){
		$oFachada=new fachada();		
			
		if ($codPesq!="" and $this->getPerfilLogado()=="Pesquisador"){
			$vetDadosBolsistas = $oFachada->getPesqBolsistasAnoAtualAnterior($codPesq);
		}
		elseif ($codPesq!=""){
			$vetDadosBolsistas = $oFachada->getPesqBolsistasAnoAtualAnterior($codPesq);
		}
		
		$editalSelec = 1;
		
		if($_POST['tipo_edital']){
			$editalSelec = $_POST['tipo_edital'];
		}else{
			$editalSelec = $_SESSION['sEdital'];
		}
		
		$numEditaisParticipando = $oFachada->selecaoEdital($codPesq, $editalSelec);
			
		if($this->getPerfilLogado()=="Administrador" AND ($_SESSION['sEdital'] == 10 OR $_SESSION['sEdital'] == 21))//Funcionar para a renovação de bolsas
		{		
		 $anoTrab = $_SESSION['sAno']-1;		 
		}else{			 		
		 $vetorSelecao = array_pop($oFachada->getSelecaoPorPesq($codPesq));
		 if(($vetorSelecao != false) and $this->getPerfilLogado()!="Administrador")
		  {
		   $anoTrab    =  $_SESSION['sAno'];
		   //$_SESSION['sAno'] = $anoTrab;
		  }else{
		   $anoTrab = $_SESSION['sAno'];
		  }
		}				
		$tpEdital   = $_SESSION['sEdital'];

		$vTpEditais = $oFachada->getTipoEdital();		
		$lpp=10;
		$total=0;
		if($vetDadosBolsistas){
			$total = count($vetDadosBolsistas);// Esta função irá retornar o total de linhas na tabela
	    	$paginas = ceil($total / $lpp); // Retorna o total de páginas
	    	if(!isset($pagina2)or $pagina2=="") { 
				$pagina2 = 1; 
			} // Especifica uma valor para variavel pagina caso a mesma não esteja setada
	    	$inicio = ($pagina2-1) * $lpp; // Retorna qual será a primeira linha a ser mostrada no MySQL
			$vetDados = array_slice($vetDadosBolsistas,$inicio,$lpp); 
		}
	    $cLinha   = 0; //contador de linha para os campos
		//$insercao = true;
		//$restrito = false;
		
		$ano =$_SESSION['sAno'];
		
    	$vetOferta = $oFachada->getOfertasAnoEditalDesc($_SESSION['sAno'], $_SESSION['sEdital']);
		$insercao=false;
		$restrito=true;
		$cont = 0;
				
		?>
		<br>
		<center>
		<form action="?pagina=bolsista" method="post" name="form1">
        
  		<table width="543" height="2" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="4B6188">
    	<tbody>
		<?//========================================================================================================?>
		<?if($this->getPerfilLogado()=="Pesquisador" and $numEditaisParticipando > 0){?>
		<form action="index.php" method="post" name="form1" class="txtr" id="form1" >
		<span class="menuTitulo">Edital: </span>
			<select name="tipo_edital" class="txtr" onchange="form1.submit()">
				<?
			
				$insercao=false;
				$today = date("Y-m-d");
				$restrito=true;
				$teste = 0;
			
			// Testando se o pesquisador está na selecao de caso haja inscriçao aberta	

				if($vTpEditais){
					foreach($vTpEditais as $oTpEdital){
								
					if($oFachada->getSelecaoPorPesqTpAno($codPesq,$oTpEdital->getCod(),$anoTrab))
					{
						// Testando se há algum periodo aberto de cadastro				
						$oPeriodo     = $oFachada->getPeriodoTipoAnoEdital('2',$anoTrab,$oTpEdital->getCod());
						//bolsas 	  = $oFachada->getSelecaoPorPesqTpAno($codPesq,$_SESSION['sEdital'],$anoTrab);				
						if(($oPeriodo->getDtFinal() >= $today and $oPeriodo->getDtInicial() <= $today))				
						{
							$teste = 1;
						}	
						$cont++;
						$edi = $oTpEdital->getCod();
						$aux = $oTpEdital->getCod()== $tpEdital? "selected" :"";
					 	echo "<option value=".$oTpEdital->getCod()." $aux>".$oTpEdital->getDescricao()."</option>\n";
						
						if ($teste>0)
						{									
							$oSelecao   = $oFachada->getSelecaoPorPesqTpAno($codPesq,$oTpEdital->getCod(),$oPeriodo->getAno());
							if ($oSelecao)
							{	
								$insercao=true;									
							}
						}
		        	}
				/*
				if($cont == 0){
					echo "<option value=0 selected>Sem inscrição</option>";
					break;
				}	*/				
			}
		 }	
		}else if ($this->getPerfilLogado()=="Pesquisador") {
		  $insercao = false;
		  $restrito = true;
	 	 }else{
		  $insercao = true;
		  $restrito = false;
		}		 
		$cont2 = 0;
		if($this->getPerfilLogado()=="Pesquisador" and $numEditaisParticipando >0){	?>
			</select>
			<span class="menuTitulo">Ano de Trabalho: </span>
		  	<select name="ano_trabalho" class="txtr" onchange="form1.submit()">
            <?			
			for($i=2004;$i<=date('Y')+20;$i++){
				if($oFachada->getSelecaoPorAnoBolAtend($codPesq,$i)){
					$cont2++;
					$aux9 = ($i==$anoTrab) ? "selected" : "";
					echo "<option value=\"$i\"$aux9>$i</option>";
				}
				/*
				if($cont2 == 0){
					echo "<option value=0 selected>Sem inscrição</option>";
					break;
				}*/
			}
		}	
			?>
          </select>
		  
		</form>	

		<?//========================================================================================================?>
      		<tr>
        		<td width="541" >
					<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
            		<tr>
              			<td  height="1"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF"valign=\"top\">
                		 	<tr>
                			  <td height="31" colspan="2"  background="images/barra_menuCad.gif" class="txtbr"><div align="center">Bolsistas</div></td>
       			      		</tr>
                		  <tr class="spanbtn">
                			  <td width="10%" height="19" bgcolor="F5F6FB" >
							  <? if ($insercao==true){ ?>							  
							  	<a href="?pagina=novo_bolsista&pesqId=<?=$codPesq?>"><img src="images/btn_NewUser.gif" width="50" height="12" border="0" title="Novo Bolsista"></a></td>
              			      <? } ?>
							  <td width="90%" bgcolor="F5F6FB">&nbsp;</td>
                		  </tr>
                  		  <tr class="txt2">
                              <td colspan="2"  valign="top" bgcolor="#FFFFFF" class="txtr"><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#DBE7F4" class="txtr2" valign=\"top\">
                                <tr>
                                  <td   colspan="5"><table width="100%" border="0" cellpadding="2" cellspacing="0" bordercolor="#DBE7F4" class="txtr2" valign=\"top\">
                                 	<tr bgcolor="#EAF3FB" class="txtbr" background="images/img_list/bg_coluna2.gif">
                                   		<td width="270" height="18" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">NOME</td>
                                   		<td width="100" height="18" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">TIPO DA BOLSA</td>                                        
                                        
                                   		<td width="100" height="18" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">ENTRADA</td>
                                   		<td width="100" height="18" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">SAIDA</td>																				
               							<td width="73" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr"><div align="center">VIG&Ecirc;NCIA</div></td>
               							<td width="24" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">&nbsp;</td>
               							<td width="32" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">&nbsp;</td>
										<td width="33" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">&nbsp;</td>
                               		</tr>					
									<?											
									$i=0;									
									//<!-- Resultados -->									
								if ($vetDados){
									while ($l=array_shift($vetDados)){									
									$edital_p_bolsa = $_SESSION['sEdital'];	
					
									switch ($edital_p_bolsa){
										case 1:
										$edital_p_bolsa = 1;
										break;	
										case 9:
										if($oFachada->getBolsaAtivaPesqAnoTp2($codPesq,$anoTrab,12)){
												$edital_p_bolsa = 12;
											}else{
												$edital_p_bolsa = 13;
											}		
										break;
										case 20:
										$edital_p_bolsa = 22;
										break;
										case 5:
										$edital_p_bolsa = 8;
										break;										
										case 6:
										$edital_p_bolsa = 9;
										break;				
										case 7:
										$edital_p_bolsa = 10;
										case 17:
										$edital_p_bolsa = 25;
										break;				
										case 8:
										$edital_p_bolsa = 11;
										break;		
										case 10:	
											//Verifica qual dos tipos de bolsa ele recebeu
											if($oFachada->getBolsaAtivaPesqAnoTp2($codPesq,$anoTrab,14)){
												$edital_p_bolsa = 14;
											}elseif($oFachada->getBolsaAtivaPesqAnoTp2($codPesq,$anoTrab,15)){
												$edital_p_bolsa = 15;
											}elseif($oFachada->getBolsaAtivaPesqAnoTp2($codPesq,$anoTrab,13)){
												$edital_p_bolsa = 13;
											}else{
												$edital_p_bolsa = 12;;
											}
										break;
										case 11:
										$edital_p_bolsa = 16;
										break;
										case 14:
										$edital_p_bolsa = 18;
										break;
										case 21:
										$edital_p_bolsa = 23;
										break;
										default:
										$edital_p_bolsa = 0;
										break;
									}						
									$nomeEdital = $oFachada->getDescTipoBolsaCod($l[tipoBolsa]);
									if(($l[tipoBolsa]== $edital_p_bolsa) or ($edital_p_bolsa == 1) or($this->getPerfilLogado()=="Administrador" )){
									
									$cLinha++;
									$anoFinal =	$l[ano]+1;
									
									?>
									
									<tr onMouseOver="this.bgColor='#E3EEFE'" onMouseOut="this.bgColor='#FFFFFF'">
									  <td  class="txtbr"><input type="hidden" name=<?="form_cod".$cLinha?> value=<?=$l[cod]?>><a href=<?="?pagina=atualiza_bolsista&bolCod=$l[cod]&bolsaCod=$l[codigoBolsa]&pesqId=$l[codPesq]"?> class="txtr2b"><?= strtoupper($l[nome])?></a></td>
                                      <?//<td  class="txtbr"><?=$vBolsa[$l[tipoBolsa]]</a></td>?>
									  <td  class="txtbr"><?=$nomeEdital?></a></td>
                                      <td  class="txtbr"><?=$l[dtInicial]?></a></td>
									  <td  class="txtbr"><?=$l[dtFinal]?></a></td>
									  <td  class="txtbr"><?=$l[ano]."/".$anoFinal?></td>
									  <td  class="txtr2">
									  <? 
									  if ( $l[dtFinal]=='' and $restrito==false){
									 	echo "<div align=\"center\"><a href=\"?pagina=desativa_bolsa&bolsaCod=$l[codigoBolsa]&pesqId=$l[codPesq]&bolCod=$l[cod]\"><img src=\"images/img_list/btn_ativo.gif\" width=\"14\" height=\"14\" border=\"0\" title=\"Desativar\"></a></div>";
									    																		  
									  }
									  elseif($restrito==false) {
									   	echo "<div align=\"center\"><a href=\"#\"><img src=\"images/img_list/btn_inativo.gif\" width=\"14\" height=\"14\" border=\"0\" title=\"Ativar\" ></a></div>";									    
															  
									  } ?>
									  </td>
									  <td>
									  <?
									  if($restrito==false) { ?>
									  <div align="center"><a href="?pagina=substitui_bolsista&pesqId=<?=$codPesq?>&bolsaCod=<?=$l[codigoBolsa]?>"><img src="images/btn_Substituir.gif" border="0" title="Substituir Bolsista"></a></div>
									  <? }//fim if
									  ?> 
									  </td>
									   <td>
									  <?
									  if($restrito==false) { ?>
									  <div align="center"><a href="?pagina=substitui_orientador&pesqId=<?=$codPesq?>&bolsaCod=<?=$l[codigoBolsa]?>"><img src="images/btn_Substituir2.gif" border="0" title="Substituir Orientador"></a></div>
									  <? }//fim if
									  ?> 
									  </td> 
								  	</tr><tr><td height="1" colspan="4" bgcolor="DBE7F4"></td></tr>
										<?	
									  
									  } // fim while
									 } 
									}//fim if vetDados
									  ?>
							        </table></td>
                                </tr>
								<tr> 
								  <td height="20" valign="middle" bgcolor="F5F6FB" class="txtbr"> </td>
								  
								</tr>
                              </table></td> 
               			  </tr>
                  			<tr class="txt2">
                   				<td height="20" colspan="8" class="txtr"><table width="100%" border="0" cellspacing="0">
                       					<tr bgcolor="#DBE7F4" class="txt2b" background="images/sub_barra_trans.gif">
                          					<td width="195" height="20" ><div align="left"><span class="txtbr">P&aacute;gina:
                                                    <select name="selectpg" class="txtr" id="selectpg" onChange="document.form1.pg.value=this.value;form1.submit();">
                                           			<?
														for($i=1;$i<=$paginas;$i++) { // Gera um loop com o link para as páginas
														$aux = ($i==$pagina2 ? "selected" : "");
														echo "<option value=\"".$i."\"".$aux.">".$i."</option>\n";}//end for
													?>
										 			</select>
                       					    		</span> </div></td>
                         					<td width="30" background="images/sub_barra_trans.gif" bgcolor="#DBE7F4" >&nbsp;</td>
                          					<td bgcolor="#DBE7F4" ><div align="right"><span class="txtbr">Total de registros encontrados: <?=$total?></span></div></td>
                       					</tr>
                    				</table></td>
                  			</tr>
              			</table></td>
	  			  </tr></table></td>
		  </tr></tbody>
		  </table>
					<input type="hidden" name="pg">
					<input type="hidden" name="acao">
	 				<input type="hidden" name="codBolsa">
					<input type="hidden" name="codBolsista">
					<input type="hidden" name="pesqId" value=<?=$codPesq?>>
	 				<input type="hidden" name="nLinhas" value=<?=$cLinha?>>
		  </form>
</center>
									
	
	<?
			
	}// fim admin
	
	//listagem geral de bolsistas
	function form_adminbolsistas($fConsulta,$pagina2){
		$oFachada=new fachada();
		if($fConsulta)	$vetDadosBolsistas = $oFachada->getBolsistasNome($fConsulta);
		else 			$vetDadosBolsistas = $oFachada->getBolsistasAno();
		
		$lpp   = 15;
		$total = 0;
		if($vetDadosBolsistas){
			$total = count($vetDadosBolsistas);// Esta função irá retornar o total de linhas na tabela
	    	$paginas = ceil($total / $lpp); // Retorna o total de páginas
	    	if(!isset($pagina2)or $pagina2=="") { 
				$pagina2 = 1; 
			} // Especifica uma valor para variavel pagina caso a mesma não esteja setada
	    	$inicio = ($pagina2-1) * $lpp; // Retorna qual será a primeira linha a ser mostrada no MySQL
			$vetDados = array_slice($vetDadosBolsistas,$inicio,$lpp); 
		}
	    $cLinha    = 0; //contador de linha para os campos
		$anoFinal  = $_SESSION['sAno']+1;
		$vetOferta = $oFachada->getOfertasAnoEditalDesc($_SESSION['sAno'], $_SESSION['sEdital']);
		if($vetOferta){
			foreach($vetOferta as $oferta){
				$vBolsa[$oferta[codTipoBolsa]] = $oferta[desc];
			} 
		
		}
		

		?>

		<br>
		<center>
		<form action="?pagina=listabolsistas" method="post" name="form1">
 
  		<table width="670" height="2" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="4B6188">
    	<tbody>
      		<tr>
        		<td width="668" >
					<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
            		<tr>
              			<td  height="1"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF"valign=\"top\">
                		 	<tr>
                			  <td height="31" colspan="2"  background="images/barra_menuCad.gif" class="txtbr"><div align="center">Bolsistas <?= implode("/",$vBolsa)." ".$_SESSION['sAno']."-".$anoFinal; ?></div></td>
       			      		</tr>
							<tr>
                                  <td bgcolor="#EAF3FB" colspan="2"><p class="txtbr">
									
								Filtrar por Nome:                                    
									<input name="form_consulta" type="text" class="txtr" id="form_consulta" size="40"  value=<?=$fConsulta?>>
 									<a href="#"><img src="images/btn_Filtrar.gif" alt="Filtrar" width="45" height="17" border="0" onclick="document.form1.pg.value=1;form1.submit();"></a> </p>
                                  </td>
                                </tr>
                		  <tr class="spanbtn">
							  <td width="" colspan="2" bgcolor="F5F6FB">&nbsp;</td>
                		  </tr>
                  		  <tr class="txt2">
                              <td colspan="2"  valign="top" bgcolor="#FFFFFF" class="txtr">
							  	<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#DBE7F4" class="txtr2" valign=\"top\">
                                <tr>
                                  <td   colspan="5"><table width="100%" border="0" cellpadding="2" cellspacing="0" bordercolor="#DBE7F4" class="txtr2" valign=\"top\">
                                 	<tr bgcolor="#EAF3FB" class="txtbr" background="images/img_list/bg_coluna2.gif">
                                   		<td width="288" height="18" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">NOME</td>
               							<td width="284"   nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">Orientador</td>
										<td width="69"   nowrap background="images/img_list/bg_coluna2.gif" class="txtbr"><div align="center">Bolsa</div></td>
										<td width="69"   nowrap background="images/img_list/bg_coluna2.gif" class="txtbr"><div align="center">Situação</div></td>
                               		</tr>
									<?
									
									$i=0;
									//<!-- Resultados -->
								if ($vetDados){
									while ($l=array_shift($vetDados)){
									$cLinha++;
									$anoFinal =	$l[ano]+1;
									?>
									<tr onMouseOver="this.bgColor='#E3EEFE'" onMouseOut="this.bgColor='#FFFFFF'">
									  <td  class="txtbr"><input type="hidden" name=<?="form_cod".$cLinha?> value=<?=$l[cod]?>><a href=<?="?pagina=atualiza_bolsistalista&bolCod=$l[cod]&bolsaCod=$l[codigoBolsa]"?> class="txtr2b"><?= strtoupper($l[nome])?></a></td>
									  <td  class="txtbr"><?=$l[orientador]?></td>
									  <td  class="txtbr"><div align="center"><?=$vBolsa[$l[tipoBolsa]]?></div></td>
									<?php  
									if ($l[dtFinal] == ""){
										echo "<td  class=\"txtr2\"><div align=\"center\"><a href=\"#\"><img src=\"images/img_list/btn_ativo.gif\" alt=\"Aprovar\" width=\"16\" height=\"16\" border=\"0\" title=\"Período-não terminado\"\"></a></div></td>";									
									}else{
										echo "<td  class=\"txtr2\"><div align=\"center\"><a href=\"#\"><img src=\"images/img_list/btn_inativo.gif\" alt=\"Aprovar\" width=\"16\" height=\"16\" border=\"0\" title=\"Período terminado\" \"></a></div></td>";									
									}
									?>						  
									 
								  	</tr>
									<tr><td height="1" colspan="3" bgcolor="DBE7F4"></td></tr>
										<?	
									  
									  } // fim while
									}//fim if vetDados
									  ?>
							        </table></td>
                                </tr>
								<tr> 
								  <td height="20" valign="middle" bgcolor="F5F6FB" class="txtbr"> </td>
								  
								</tr>
                              </table></td> 
               			  </tr>
                  			<tr class="txt2">
                   				<td height="20" colspan="8" class="txtr"><table width="100%" border="0" cellspacing="0">
                       					<tr bgcolor="#DBE7F4" class="txt2b" background="images/sub_barra_trans.gif">
                          					<td width="195" height="20" ><div align="left"><span class="txtbr">P&aacute;gina:
                                                    <select name="selectpg" class="txtr" id="selectpg" onChange="document.form1.pg.value=this.value;form1.submit();">
                                           			<?
														for($i=1;$i<=$paginas;$i++) { // Gera um loop com o link para as páginas
														$aux = ($i==$pagina2 ? "selected" : "");
														echo "<option value=\"".$i."\"".$aux.">".$i."</option>\n";}//end for
													?>
										 			</select>
                       					    		</span> </div></td>
                         					<td width="30" background="images/sub_barra_trans.gif" bgcolor="#DBE7F4" >&nbsp;</td>
                          					<td bgcolor="#DBE7F4" ><div align="right"><span class="txtbr">Total de registros encontrados: <?=$total?></span></div></td>
                       					</tr>
                    				</table></td>
                  			</tr>
              			</table></td>
	  			  </tr></table></td>
		  </tr></tbody>
		  </table>
					<input type="hidden" name="pg">
					<input type="hidden" name="acao">
	 				<input type="hidden" name="nLinhas" value=<?=$cLinha?>>
		  </form>
	</center>
									
	
	<?

			
	}// fim admin
	
	
	function form_cadbolsista($codPesq,$acao,$tpSelecao=null){
		$oFachada  = new fachada();
		$pagina    = "bolsista";
		$ano       = 0;
		
		// Se código da bolsa está definido
		if($this->getCodBolsa()){
			$oBolsa   = $oFachada->getBolsaCod($this->getCodBolsa());
			$tpBolsa  = $oBolsa->getTipo();
			
		}
		// Se código do bolsista está definido
		if($this->getCod()){
			$oBolsista = $oFachada->getBolsistaCod($this->getCod());
			
		}
		// Se código do bolsista não estiver definido, cria um objeto bolsista vazio
		else {
			$oBolsista = $oFachada->bolsista("","","","","","","","","","","","","","","","","","","","","","","","","");
			$oBolsista->setCpf($_POST['cpf']);
			
		}

		if ($acao == "update" or $acao == "update_bollist"){
			$oBolsistaBolsa = $oFachada->getBolsistaBPorCodBB($this->getCodBolsa(),$this->getCod());
			$ano 			= $oBolsa->getAno();
			$codPlano 		= $oBolsa->getCodPlano();
			
			//identificaçao das paginas no menu
			if($acao=="update"){
				if($oBolsa->getAno()=="2004"){
					$pgPlano ="plano";				
				}
				else{
					$pgPlano = ($oBolsa->getCodPlano()==0)?"select_plano":"atualiza_plano";					
				}
				$pgRelatorio = "relatorio_bolsa";
				$pgAvaliacao = "avaliacao_bolsista";
				$pgResumo     = "resumo";
			
			}
			else{
				if($codPlano>0){
					$pgPlano = "atualiza_plano";
					$alerta  = "return existe_cod();";
				}
				else
					$alerta  = "alert('Plano não definido.');return false;";
				$pgRelatorio = "relatorio_bollist";
				$pgAvaliacao = "avaliacao_bollist";
				$pgResumo    = "resumo_bollist";
			}
			
			//edicao de bolsista cancelado
			if($oBolsistaBolsa->getDtFinal()!=""){
				$edicao="disabled";
				
			}
			
			//cuidado com a permissão de edição
			if($this->getPerfilLogado()=="Pesquisador"){
				$restrito 	= "disabled";
				$editcpf	= "readonly";
				$aviso      =  "Obs: Após salvar o formulário, informe o plano de trabalho.";
				$edicao		= "disabled";
				
				// Testando se há algum periodo aberto de cadastro
				$vetPeriodo     = $oFachada->getPeriodoAbertoSelecao('2',$_SESSION['sEdital']);
				if($vetPeriodo){
					
					$oPeriodo   = array_shift($vetPeriodo);
					$tpSelecao  = $oPeriodo->getTpSelecao();				
				}

				// Testando se o pesquisador está na selecao caso haja inscriçao aberta	
				if ($tpSelecao>0){
					$oSelecao   = $oFachada->getSelecaoPorPesqTpAno($codPesq,$tpSelecao,$oPeriodo->getAno());
					if ($oSelecao){
						$edicao="";
					}
				}
			}// fim verificação da edição	
			 //verifica se vem da lista geral de bolsista ou da lista do pes
			elseif($codPesq=="") $pagina = "listabolsistas";
		}
		//acao == update
		if($acao=="novo" OR $acao=="incluir"){
		
			if($this->getPerfilLogado()=="Pesquisador"){
				$editcpf = "readonly";//cuidado com a edição
				$aviso   =  "Obs: Após salvar o formulário, informe o plano de trabalho.";
			}
			
			// Testando se há algum periodo aberto de cadastro ??????
			$vetPeriodo     = $oFachada->getPeriodoAberto('2');
			if($vetPeriodo){
				$oPeriodo   = array_shift($vetPeriodo);				
				$tpSelecao  = $oPeriodo->getTpSelecao();				
			}
					//					echo $tpSelecao;
			//Busca o tipo da bolsa pela ordem de oferta da selecao
			$vOferta	= $oFachada->getOfertasAnoEdital($_SESSION['sAno'],$tpSelecao);
			if ($vOferta){
				$cotaBolsas       = 0; // Armazena a cota de Bolsas do pesquisador
				// Número de bolsas ATIVAS (com bolsistas) que o pesquisador possui na selecao
				$vetBolsasAtivas = $oFachada->getBolsaAtivaPesqAnoTp($codPesq,$_SESSION['sAno'],$tpSelecao);

				if($vetBolsasAtivas){
					$numBolsasAtivas = count($vetBolsasAtivas);
				} else $numBolsasAtivas = 0;
				
				//busca o tipo de bolsa q tem direito
				while($oferta=array_shift($vOferta)){
					$oAtend = $oFachada->getAtendPorPesqTpAno($codPesq,$oferta->getCodTipoBolsa(),$oferta->getAno()); 
					if($oAtend)	$cotaBolsas = $cotaBolsas + $oAtend->getQtd();
						// Enquanto o número de bolsas ativas for menor que a cota do pesquisador 
					if ($numBolsasAtivas<$cotaBolsas){
						$tpBolsa     = $oferta->getCodTipoBolsa();
						break;
					}
				}//fim while
			}// fim if vOferta
		}
		$vetBanco[]	    = "Banco do Brasil"; 
		if($tpBolsa!=1){
			$vetBanco[] = "Banco Santander";
			$vetBanco[] = "Caixa Econômica Federal";
			$vetBanco[] = "HSBC";
		}
		
		$vetCota = $oFachada->getTipoCota();
		?>
		<br>  
		<center>
		<script language="javascript" src="javascript2.js"></script>
		<script language="javascript" src="javascript/class_bolsista.js"></script>
        <form action="?pagina=<?=$pagina?>" method="post" name="form1">
		<table width="455"  border="0" align="center" cellpadding="0" cellspacing="2" class="tableforms">
			<tr>
            	<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="F5F6FB">
                    	<tr>
                        	<td height="31" colspan="5" background="images/barra_menuCad.gif" class="txtbr"> <div align="center">Cadastro de Bolsista</div></td>                                
	                	</tr>
						<tr class="txt2">
	               			<td colspan="5">
								<? if($acao=="update" or $acao == "update_bollist"){ ?>
									<table width="100%" border="0" cellspacing="1">
									<tr class="spanbtn">
										<td ><a href="?pagina=<?=$pgPlano?>&bolCod=<?=$this->getCod();?>&bolsaCod=<?=$this->getCodBolsa();?>&pesqId=<?=$codPesq?>&planoCod=<?=$codPlano?>" onClick="<?=$alerta?>" ><img src="images/btn_Plano.gif" border="0"></a></td>
										<td ><a href="?pagina=<?=$pgRelatorio?>&bolCod=<?=$this->getCod();?>&bolsaCod=<?=$this->getCodBolsa();?>&pesqId=<?=$codPesq?>&tpRel=relParcial" onClick="return (existe_cod())"><img src="images/btn_RelParcial.gif" border="0"></a></td>
										<td ><a href="?pagina=<?=$pgAvaliacao?>&bolsaCod=<?=$this->getCodBolsa();?>&bolCod=<?=$this->getCod();?>&pesqId=<?=$codPesq?>" onClick="return (existe_cod())" ><img src="images/btn_Avaliacoes.gif" border="0"></a></td>
										<td ><a href="?pagina=<?=$pgResumo?>&bolsaCod=<?=$this->getCodBolsa();?>&bolCod=<?=$this->getCod();?>&pesqId=<?=$codPesq?>" onClick="return (existe_cod())" ><img src="images/btn_Resumo.gif" border="0"></a></td>
									    <td ><a href="?pagina=<?=$pgRelatorio;?>&bolCod=<?=$this->getCod();?>&bolsaCod=<?=$this->getCodBolsa();?>&pesqId=<?=$codPesq?>&tpRel=relFinal" onClick="return (existe_cod())"><img src="images/btn_RelFinal.gif" border="0"></a></td>
									</tr>
							  </table>
								<? }?>
								
							</td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
                        <tr class="txtr2">
                            <td width="87">Nome</td>
                            <td colspan="4"><div align="left"><input name="form_nome" type="text" class="txtr" id="form_nome" size="75" value="<?=$oBolsista->getNome()?>" <?=$edicao ?> > 
                            </div></td>
                            </tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
                           	<td>RG</td>
				           	<td width="144"><input name="form_rg" type="text" class="txtr" id="form_rg" size="16" value="<?=$oBolsista->getRg()?>" <?=$edicao ?>></td>
				        	<td width="27">&nbsp;</td>
              				<td width="78">Org&atilde;o Expedidor </td>
                           	<td width="183" ><input name="form_orgao" type="text" class="txtr" id="form_orgao" size="30" maxlength="30" value="<?=$oBolsista->getOrgaoRg()?>" <?=$edicao ?>></td>
                    	</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Data Expedi&ccedil;&atilde;o </td>
							<td><input name="form_dtRg" type="text" class="txtr" id="form_dtRg" size="16" maxlength="10" onBlur="isDate(this)" value="<?=$oBolsista->getDataRg()?>" <?=$edicao ?>></td>
							<td>&nbsp;</td>
							<td>Data Nascimento</td>
							<td><input name="form_dtnasc" type="text" class="txtr" id="form_dtnasc" size="16" maxlength="10" onBlur="isDate(this)" value="<?=$oBolsista->getDataNasc()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>CPF</td>
						  <td><input name="form_cpf" type="text" class="txtr" id="form_cpf" size="16" maxlength="14" onKeyPress="return(FormataCpf(this,11,event))" onBlur="Verifica_campo_CPF(this)" value="<?=$oBolsista->getCpf()?>" <?=$editcpf ?>></td>
							<td width="27">&nbsp;</td>
							<td width="78">Sexo</td>
							<td ><select name="form_sexo" class="txtr" id="form_sexo" <?=$edicao ?>>
								<option value="" selected></option>
								<option value="f" <? if ($oBolsista->getSexo()=="f"){echo "selected";}?>>Feminino</option>
								<option value="m" <? if ($oBolsista->getSexo()=="m"){echo "selected";}?>>Masculino</option>
								</select>
							</td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Nacionalidade</td>
							<td width="144"><input name="form_nacionalidade" type="text" class="txtr" id="form_nacionalidade" size="20" value="<?=$oBolsista->getNacionalidade()?>" <?=$edicao ?>></td>
							<td width="27">&nbsp;</td>
							<td width="78">Naturalidade</td>
							<td ><input name="form_naturalidade" type="text" class="txtr" id="form_naturalidade" size="30" value="<?=$oBolsista->getNaturalidade()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Pa&iacute;s de Origem</td>
							<td colspan="4"><input name="form_origem" type="text" class="txtr" id="form_origem" size="20" value="<?=$oBolsista->getOrigem()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Endere&ccedil;o</td>
							<td colspan="4"><div align="left"><input name="form_endereco" type="text" class="txtr" id="form_endereco" size="75" maxlength="100" value="<?=$oBolsista->getEndereco()?>" <?=$edicao ?>>
							</div></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Estado</td>
							<td width="144"><input name="form_estado" type="text" class="txtr" id="form_estado" size="20" value="<?=$oBolsista->getEstado()?>" <?=$edicao ?>></td>
							<td width="27">&nbsp;</td>
							<td width="78">Cidade</td>
							<td ><input name="form_cidade" type="text" class="txtr" id="form_cidade" size="30" value="<?=$oBolsista->getCidade()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Bairro</td>
							<td><input name="form_bairro" type="text" class="txtr" id="form_bairro" size="20" value="<?=$oBolsista->getBairro()?>" <?=$edicao ?>></td>
							<td>&nbsp;</td>
							<td>CEP</td>
							<td><input name="form_cep" type="text" class="txtr" id="form_cep" size="11" maxlength="9" value="<?=$oBolsista->getCep()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Telefone</td>
							<td><input name="form_fone" type="text" class="txtr" id="form_fone" size="20" maxlength="20" value="<?=$oBolsista->getFone()?>" <?=$edicao ?>></td>
							<td>&nbsp;</td>
							<td>e-mail</td>
							<td><input name="form_email" type="text" class="txtr" id="form_email" size="30" onBlur="isEmail(this)" value="<?=$oBolsista->getEmail()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td colspan="5">
								 <iframe src="select_instituicao.php?instCod=<?=$oBolsista->getInstituicao()?>&edicao=<?=$edicao?>" name="instituicoes"  width="100%" height="30" scrolling="no"  frameborder="0" marginwidth="0" marginheight="0" <?=$edicao ?>></iframe>
								 <input type="hidden" name="lstInstituicao" >
							</td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Matrícula</td>
							<td><input name="form_matricula" type="text" class="txtr" id="form_matricula" size="20" value="<?=$oBolsista->getMatricula()?>" <?=$edicao ?>></td>
							<td>&nbsp;</td>											
							<td>Curso</td>
							<td><select name="form_curso" class="txtr" id="form_curso" <?=$edicao?>>
								<option value="" selected></option>
								<option value="ADMINISTRAÇÃO"<? if ($oBolsista->getCurso()=="ADMINISTRAÇÃO"){echo "selected";}?>>ADMINISTRAÇÃO</option>
								<option value="AGRONOMIA"<? if ($oBolsista->getCurso()=="AGRONOMIA"){echo "selected";}?>>AGRONOMIA</option>
								<option value="AGRONOMIA"<? if ($oBolsista->getCurso()=="ANTROPOLOGIA"){echo "selected";}?>>AGRONOMIA</option>
								<option value="ARQUITETURA E URBANISMO" <? if ($oBolsista->getCurso()=="ARQUITETURA E URBANISMO"){echo "selected";}?>>ARQUITETURA E URBANISMO</option>
								<option value="ARQUIVOLOGIA"<? if ($oBolsista->getCurso()=="ARQUIVOLOGIA"){echo "selected";}?>>ARQUIVOLOGIA</option>
								<option value="ARTES VISUAIS"<? if ($oBolsista->getCurso()=="ARTES VISUAIS"){echo "selected";}?>>ARTES VISUAIS</option>
								<option value="BIBLIOTECONOMIA"<? if ($oBolsista->getCurso()=="BIBLIOTECONOMIA"){echo "selected";}?>>BIBLIOTECONOMIA</option>
								<option value="BIOMEDICINA"<? if ($oBolsista->getCurso()=="BIOMEDICINA"){echo "selected";}?>>BIOMEDICINA</option>
								<option value="BIOTECNOLOGIA"<? if ($oBolsista->getCurso()=="BIOTECNOLOGIA"){echo "selected";}?>>BIOTECNOLOGIA</option>
								<option value="CIÊNCIA DA COMPUTAÇÃO"<? if ($oBolsista->getCurso()=="CIÊNCIA DA COMPUTAÇÃO"){echo "selected";}?>>CIÊNCIA DA COMPUTAÇÃO</option>
								<option value="CIÊNCIA E TECNOLOGIA"<? if ($oBolsista->getCurso()=="CIÊNCIA E TECNOLOGIA"){echo "selected";}?>>CIÊNCIA E TECNOLOGIA</option>
								<option value="CIÊNCIAS BIOLÓGICAS"<? if ($oBolsista->getCurso()=="CIÊNCIAS BIOLÓGICAS"){echo "selected";}?>>CIÊNCIAS BIOLÓGICAS</option>
								<option value="CIÊNCIAS CONTABÉIS"<? if ($oBolsista->getCurso()=="CIÊNCIAS CONTABÉIS"){echo "selected";}?>>CIÊNCIAS CONTABÉIS</option>
								<option value="CIÊNCIAS ECONÔMICAS"<? if ($oBolsista->getCurso()=="CIÊNCIAS ECONÔMICASO"){echo "selected";}?>>CIÊNCIAS ECONÔMICAS</option>
								<option value="CIÊNCIAS NATURAIS"<? if ($oBolsista->getCurso()=="CIÊNCIAS NATURAIS"){echo "selected";}?>>CIÊNCIAS NATURAIS</option>
								<option value="CIENCIAS SOCIAIS"<? if ($oBolsista->getCurso()=="CIENCIAS SOCIAIS"){echo "selected";}?>>CIENCIAS SOCIAIS</option>
								<option value="CINEMA E AUDIOVISUAL"<? if ($oBolsista->getCurso()=="CINEMA E AUDIOVISUAL"){echo "selected";}?>>CINEMA E AUDIOVISUAL</option>
								<option value="COMUNICAÇÃO SOCIAL"<? if ($oBolsista->getCurso()=="COMUNICAÇÃO SOCIAL"){echo "selected";}?>>COMUNICAÇÃO SOCIAL</option>
								<option value="DANÇA"<? if ($oBolsista->getCurso()=="DANÇA"){echo "selected";}?>>DANÇA</option>
								<option value="DIREITO"<? if ($oBolsista->getCurso()=="DIREITO"){echo "selected";}?>>DIREITO</option>
								<option value="EDUCAÇÃO FÍSICA"<? if ($oBolsista->getCurso()=="EDUCAÇÃO FÍSICA"){echo "selected";}?>>EDUCAÇÃO FÍSICA</option>
								<option value="ENFERMAGEM"<? if ($oBolsista->getCurso()=="ENFERMAGEM"){echo "selected";}?>>ENFERMAGEM</option>
								<option value="ENGENHARIA BIOMEDICA"<? if ($oBolsista->getCurso()=="ENGENHARIA BIOMEDICA"){echo "selected";}?>>ENGENHARIA BIOMEDICA</option>
								<option value="ENGENHARIA CIVIL"<? if ($oBolsista->getCurso()=="ENGENHARIA CIVIL"){echo "selected";}?>>ENGENHARIA CIVIL</option>
								<option value="ENGENHARIA DA COMPUTAÇÃO"<? if ($oBolsista->getCurso()=="ENGENHARIA DA COMPUTAÇÃO"){echo "selected";}?>>ENGENHARIA DA COMPUTAÇÃO</option>
								<option value="ENGENHARIA DE ALIMENTO"<? if ($oBolsista->getCurso()=="ENGENHARIA DE ALIMENTO"){echo "selected";}?>>ENGENHARIA DE ALIMENTO</option>
								<option value="ENGENHARIA DE BIOPROCESSOS"<? if ($oBolsista->getCurso()=="ENGENHARIA DE BIOPROCESSOS"){echo "selected";}?>>ENGENHARIA DE BIOPROCESSOS</option>
								<option value="ENGENHARIA DE CONTROLE E AUTOMAÇÃO"<? if ($oBolsista->getCurso()=="ENGENHARIA DE CONTROLE E AUTOMAÇÃO"){echo "selected";}?>>ENGENHARIA DE CONTROLE E AUTOMAÇÃO</option>
								<option value="ENGENHARIA DE EXPLORAÇÃO E PROD. DE PETROLEO"<? if ($oBolsista->getCurso()=="ENGENHARIA DE EXPLORAÇÃO E PROD. DE PETROLEO"){echo "selected";}?>>ENGENHARIA DE EXPLORAÇÃO E PROD. DE PETROLEO</option>
								<option value="ENGENHARIA DE MATERIAIS"<? if ($oBolsista->getCurso()=="ENGENHARIA DE MATERIAIS"){echo "selected";}?>>ENGENHARIA DE MATERIAIS</option>
								<option value="ENGENHARIA DE PESCA"<? if ($oBolsista->getCurso()=="ENGENHARIA DE PESCA"){echo "selected";}?>>ENGENHARIA DE PESCA</option>
								<option value="ENGENHARIA DE TELECOMUNICAÇÕES"<? if ($oBolsista->getCurso()=="ENGENHARIA DE TELECOMUNICAÇÕES"){echo "selected";}?>>NGENHARIA DE TELECOMUNICAÇÕES</option>
								<option value="ENGENHARIA ELETRICA"<? if ($oBolsista->getCurso()=="ENGENHARIA ELETRICA"){echo "selected";}?>>ENGENHARIA ELETRICA</option>
								<option value="ENGENHARIA FERROVIARIA E LOGISTICA"<? if ($oBolsista->getCurso()=="ENGENHARIA FERROVIARIA E LOGISTICA"){echo "selected";}?>>ENGENHARIA FERROVIARIA E LOGISTICA</option>
								<option value="ENGENHARIA FLORESTAL"<? if ($oBolsista->getCurso()=="ENGENHARIA FLORESTAL"){echo "selected";}?>>ENGENHARIA FLORESTAL</option>
								<option value="ENGENHARIA INDUSTRIAL"<? if ($oBolsista->getCurso()=="ENGENHARIA INDUSTRIAL"){echo "selected";}?>>ENGENHARIA INDUSTRIAL</option>
								<option value="ENGENHARIA MECÂNICA"<? if ($oBolsista->getCurso()=="ENGENHARIA MECÂNICA"){echo "selected";}?>>ENGENHARIA MECÂNICA</option>
								<option value="ENGENHARIA NAVAL"<? if ($oBolsista->getCurso()=="ENGENHARIA NAVAL"){echo "selected";}?>>ENGENHARIA NAVAL</option>
								<option value="ENGENHARIA QUIMICA"<? if ($oBolsista->getCurso()=="ENGENHARIA QUIMICA"){echo "selected";}?>>ENGENHARIA QUIMICA</option>
								<option value="ENGENHARIA SANITARIA E AMBIENTAL"<? if ($oBolsista->getCurso()=="ENGENHARIA SANITARIA E AMBIENTAL"){echo "selected";}?>>ENGENHARIA SANITARIA E AMBIENTAL</option>
								<option value="ESTATISTICA"<? if ($oBolsista->getCurso()=="ESTATISTICA"){echo "selected";}?>>ESTATISTICA</option>
								<option value="FARMACIA"<? if ($oBolsista->getCurso()=="FARMACIA"){echo "selected";}?>>FARMACIA</option>
								<option value="FILOSOFIA"<? if ($oBolsista->getCurso()=="FILOSOFIA"){echo "selected";}?>>FILOSOFIA</option>
								<option value="FISICA"<? if ($oBolsista->getCurso()=="FISICA"){echo "selected";}?>>FISICA</option>
								<option value="FISIOTERAPIA"<? if ($oBolsista->getCurso()=="FISIOTERAPIA"){echo "selected";}?>>FISIOTERAPIA</option>
								<option value="GEOFISICA"<? if ($oBolsista->getCurso()=="GEOFISICA"){echo "selected";}?>>GEOFISICA</option>
								<option value="GEOGRAFIA"<? if ($oBolsista->getCurso()=="GEOGRAFIA"){echo "selected";}?>>GEOGRAFIA</option>
								<option value="GEOLOGIA"<? if ($oBolsista->getCurso()=="GEOLOGIA"){echo "selected";}?>>GEOLOGIA</option>
								<option value="GEOPROCESSAMENTO"<? if ($oBolsista->getCurso()=="GEOPROCESSAMENTO"){echo "selected";}?>>GEOPROCESSAMENTO</option>
								<option value="HISTORIA"<? if ($oBolsista->getCurso()=="HISTORIA"){echo "selected";}?>>HISTORIA</option>
								<option value="LETRAS"<? if ($oBolsista->getCurso()=="LETRAS"){echo "selected";}?>>LETRAS</option>
								<option value="LIC. INT. EM EDUC. E, CIENCIAS, MAT. E LINGUAGENS"<? if ($oBolsista->getCurso()=="LIC. INT. EM EDUC. E, CIENCIAS, MAT. E LINGUAGENS"){echo "selected";}?>>LIC. INT. EM EDUC. E, CIENCIAS, MAT. E LINGUAGENS</option>
								<option value="MATEMÁTICA"<? if ($oBolsista->getCurso()=="MATEMÁTICA"){echo "selected";}?>>MATEMÁTICA</option>
								<option value="MEDICINA"<? if ($oBolsista->getCurso()=="MEDICINA"){echo "selected";}?>>MEDICINA</option>
								<option value="MEDICINA VETERINARIA"<? if ($oBolsista->getCurso()=="MEDICINA VETERINARIA"){echo "selected";}?>>MEDICINA VETERINARIA</option>
								<option value="METEOROLOGIA"<? if ($oBolsista->getCurso()=="METEOROLOGIA"){echo "selected";}?>>METEOROLOGIA</option>
								<option value="MUSEOLOGIA"<? if ($oBolsista->getCurso()=="MUSEOLOGIA"){echo "selected";}?>>MUSEOLOGIA</option>
								<option value="MÚSICA"<? if ($oBolsista->getCurso()=="MÚSICA"){echo "selected";}?>>MÚSICA</option>
								<option value="NUTRIÇÃO"<? if ($oBolsista->getCurso()=="NUTRIÇÃO"){echo "selected";}?>>NUTRIÇÃO</option>
								<option value="OCEANOGRAFIA"<? if ($oBolsista->getCurso()=="OCEANOGRAFIA"){echo "selected";}?>>OCEANOGRAFIA</option>
								<option value="ODONTOLOGIA"<? if ($oBolsista->getCurso()=="ODONTOLOGIA"){echo "selected";}?>>ODONTOLOGIA</option>
								<option value="PEDAGOGIA"<? if ($oBolsista->getCurso()=="PEDAGOGIA"){echo "selected";}?>>PEDAGOGIA</option>
								<option value="PRODUÇÃO MULTIMIDIA - TECNOLOGICO"<? if ($oBolsista->getCurso()=="PRODUÇÃO MULTIMIDIA - TECNOLOGICO"){echo "selected";}?>>PRODUÇÃO MULTIMIDIA - TECNOLOGICO</option>
								<option value="PSICOLOGIA"<? if ($oBolsista->getCurso()=="PSICOLOGIA"){echo "selected";}?>>PSICOLOGIA</option>
								<option value="QUIMICA"<? if ($oBolsista->getCurso()=="QUIMICA"){echo "selected";}?>>QUIMICA</option>
								<option value="QUIMICA INDUSTRIAL"<? if ($oBolsista->getCurso()=="QUIMICA INDUSTRIAL"){echo "selected";}?>>QUIMICA INDUSTRIAL</option>
								<option value="SERVIÇO SOCIAL"<? if ($oBolsista->getCurso()=="SERVIÇO SOCIAL"){echo "selected";}?>>SERVIÇO SOCIAL</option>
								<option value="SISTEMA DE INFORMAÇÃO"<? if ($oBolsista->getCurso()=="SISTEMA DE INFORMAÇÃO"){echo "selected";}?>>SISTEMA DE INFORMAÇÃO</option>
								<option value="TEATRO"<? if ($oBolsista->getCurso()=="TEATRO"){echo "selected";}?>>TEATRO</option>
								<option value="TERAPIA OCUPACIONAL"<? if ($oBolsista->getCurso()=="TERAPIA OCUPACIONAL"){echo "selected";}?>>TERAPIA OCUPACIONAL</option>
								<option value="TURISMO"<? if ($oBolsista->getCurso()=="TURISMO"){echo "selected";}?>>TURISMO</option>
								</select>
							</td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>						
						<tr class="txtr2">
							<td>Forma de ingresso</td>
							<td><select name="form_cota" class="txtr" id="form_cota" <?=$edicao?>>							
								<?
											if ($vetCota){							
												while($lc=array_shift($vetCota)){
													$aux = ($lc->getCod()==$oBolsista->getCota()) ? "selected" : "";
													echo "<option value=\"".$lc->getCod()."\" $aux>".$lc->getDesc()."</option>";
												}
											}
								?>
							</td>
						</tr>	
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Banco</td>
							<td>
								<select name="form_banco" class="txtr" id="form_banco" <?=$edicao ?>>
									<option value="" selected></option>
									 <?
										while($lb=array_shift($vetBanco)){
											$aux = ($lb == $oBolsista->getBanco()) ? "selected" : "";
											echo "<option value=\"$lb\" $aux>$lb</option>";
										}
									
									?>
								</select>
							</td>
							<td>&nbsp;</td>
							<td>Ag&ecirc;ncia</td>
							<td><input name="form_agencia" type="text" class="txtr" id="form_agencia" size="30" value="<?=$oBolsista->getAgencia()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
							<td>Conta</td>
							<td colspan="4"><input name="form_conta" type="text" class="txtr" id="form_conta" size="20" maxlength="20" value="<?=$oBolsista->getConta()?>" <?=$edicao ?>></td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
							<input type="hidden" name="acao" value=<?=$acao?>>
							<input type="hidden" name="bolsaCod" value=<?=$this->getCodBolsa();?>>
							<input type="hidden" name="bolCod" value=<?=$oBolsista->getCod();?>>
							<input type="hidden" name="pesqId" value=<?=$codPesq?>>
							<input type="hidden" name="tpSelecao" value=<?=$tpSelecao?>>
						<tr class="txtr2">
                  			<td height="20" colspan="5" class="txtbr">
							  	<table width="100%" border="0" cellspacing="0">
                                	<tr bgcolor="#DBE7F4" class="spanbtn3" background="images/sub_barra_trans.gif">
                                  		<td width="69" height="20"> 
								  		<?
								  		if ($edicao==""){
								  			?> <div align="center"><a href="#"><img src="images/btn_salvar.gif" width="54" height="14" border="0" onclick="if(formulario.validaForm()==true) save();"></a> </div> <?
								  		} 
										?> 
										</td> 								  		
                                  		<td width="61" background="images/sub_barra_trans.gif" bgcolor="#DBE7F4" ></td>
                                  		<td class="txtbr"><?=$aviso;?></td>
								  	</tr>
                              	</table>
							</td>
                       	</tr>           
                 </table>
			</td>
     	</tr>
   	</table>
	</form>
		</center>
		<script language="javascript">
			formulario = new FormContext(document.form1);
			formulario.addCampo("form_dtRg","Data de emissão do RG",'data',false);
			formulario.addCampo("form_dtnasc","Data de Nascimento",'data',false);
            formulario.addRegra("(document.form1.form_nome.value)","Por Favor, informe o nome.");
			formulario.addRegra("(document.form1.form_rg.value)","Por Favor, informe o nº do RG.");
			formulario.addRegra("(document.form1.form_orgao.value)","Por Favor, informe o orgão emissor do RG.");			
            formulario.addRegra("(document.form1.form_cpf.value)","Por Favor, informe o cpf.");
			formulario.addRegra("(document.form1.form_origem.value)","Por Favor, informe o país de origem.");
			formulario.addRegra("(document.form1.form_endereco.value)","Por Favor, informe o endereco.");
            formulario.addRegra("(document.form1.form_fone.value)","Por Favor, informe o telefone.");
            formulario.addRegra("(document.form1.form_email.value)","Por Favor, informe o email.");	
			formulario.addRegra("(document.form1.form_matricula.value)","Por Favor, informe a matricula.");	
            formulario.addRegra("(document.form1.form_curso.value)","Por Favor, informe o curso do bolsista.");
			formulario.addRegra("(document.form1.form_conta.value)","Por Favor, informe a conta corrente.");
			formulario.addRegra("(document.form1.form_banco.value)","Por Favor, informe o banco.");
			formulario.addRegra("(document.form1.form_agencia.value)","Por Favor, informe a agência do banco.");
			formulario.addRegra("(instituicoes.document.form1.lstInstituicao.value)","Por Favor, informe a instituição de ensino.");
		</script>
		
		<?

	}//fim form_bolsista
	
	function form_buscabolsista($codPesq,$cpf,$acao2){
	
		$oFachada  = new fachada();
		if($cpf){		
			$oBolsista = $oFachada->getBolsistaCpf($cpf);
			if($oBolsista){
			
				$bolCod = $oBolsista->getCod();
			}
		}
		
		//echo $cpf;

		?>
		<br>  
		<center>
		<script language="javascript" src="javascript2.js"></script>
		<form action="?pagina=novo_bolsista" method="post" name="form1" onSubmit="return Verifica_campo_CPF(document.form1.form_cpf);">
		<table width="455"  border="0" align="center" cellpadding="0" cellspacing="2" class="tableforms">
			<tr>
            	<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="F5F6FB">
                    	<tr>
                        	<td height="31" background="images/barra_menuCad.gif" class="txtbr"> <div align="center">Cadastro de Bolsista</div></td>                                
	                	</tr>
											
						<TR class="txtr2"> 
							<TD height=1 bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<tr class="txtr2">
						  <td> 
						    <? if ($cpf=="") { ?>							
							<div align="center">
						    CPF:
							<input name="form_cpf" type="text" class="txtr" id="form_cpf" size="16" maxlength="14" value="<?=$cpf?>">
					        <span class="spanbtn"><a href="#" onclick="if(Verifica_campo_CPF(document.form1.form_cpf)){ form1.submit();}"><img src="images/btn_Pesquisar.gif" width="75" height="17" border="0" ></a></span></div>
							<? } else {
							 	?>
								CPF: <?=$cpf?> <span class="spanbtn"><a href="?pagina=novo_bolsista&pesqId=<?=$codPesq?>"><img src="images/btn_NovaBusca.gif" alt="Nova Busca" border="0"></a></span>
								<? }
						    ?>
						  </td>
						</tr>
						<TR class="txtr2"> 
							<TD height=1 bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
						<?
						if($oBolsista){
						?>
                        	<tr class="txtr2">							
                            	<td>Nome: <?=$oBolsista->getNome();?></td>
                        	</tr>
							<?
							if($oFachada->temBolsa($bolCod)){
							?>
						 		<tr class="txtr2">
                            		<td>Situa&ccedil;&atilde;o: Já possui bolsa. </td>
                        		</tr>
								<TR class="txtr2"> 
									<TD height=1 bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
							<?
							}
							else{ ?>
								<tr class="txtr2">
                            		<td>Situa&ccedil;&atilde;o: Disponível. <span class="spanbtn"><a href="#" onclick="form1.acao.value='incluir';form1.submit();"><img src="images/btn_Prosseguir.gif" width="80" height="14" border="0" ></a></span></td>
                        		</tr>
								<TR class="txtr2"> 
									<TD height=1 bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>							
							<? } 
							
						}
						elseif($cpf!=""){
						?>
							<tr class="txtr2">
                            		<td>Bolsista não cadastrado. <span class="spanbtn3"><a href="#" onclick="form1.acao.value='novo';form1.submit();"><img src="images/btn_Incluir.gif" border="0" ></a></span></td>
                        	</tr>
							<TR class="txtr2"> 
								<TD height=1 bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
							</TR>
						<? }  ?> 
						
						<tr class="txtr2">
                  			<td height="20" colspan="5" class="txtr">
							  	<table width="100%" border="0" cellspacing="0">
                                	<tr bgcolor="#DBE7F4" class="spanbtn3" background="images/sub_barra_trans.gif">
                                  		<td width="69" height="20"> </td> 								  		
                                  		<td width="61" background="images/sub_barra_trans.gif" bgcolor="#DBE7F4" ></td>
                                  		<td >&nbsp;</td>
								  	</tr>
                              	</table>
							</td>
                       	</tr>    
                 </table>
			</td>
     	</tr>
   	</table>
	<input type="hidden" name="acao"     value="buscar">
	<input type="hidden" name="acao2"    value="<?=$acao2?>">
	<input type="hidden" name="bolCod"   value="<?=$bolCod?>">
	<input type="hidden" name="cpf"  	 value="<?=$cpf?>">
	<input type="hidden" name="bolsaCod" value="<?=$this->getCodBolsa(); ?>">
	<input type="hidden" name="pesqId"   value="<?=$codPesq?>">
	</form>
		</center>
		<script language="javascript">
			if(document.form1.cpf.value == ""){
				formulario = new FormContext(document.form1);
		    	formulario.addCampo("form_cpf","CPF",'cpf',false);
			}
		</script>
		
		<?

	}//fim form_bolsista
	
	
}//fim classe


?>