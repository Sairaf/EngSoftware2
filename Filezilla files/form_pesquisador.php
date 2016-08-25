<?
require_once('./fachada.php');

class form_pesquisador {

	var $pId;
	var $pPerfilLogado;
	
	function setId($a){
		$this->pId = $a;
	}
	
	function getId(){
		return $this->pId;
	}
	function setPerfilLogado($b){
		$this->pPerfilLogado = $b;
	}
	function getPerfilLogado(){
		return $this->pPerfilLogado ;
	}
	function busca_pesq($cpf){
		require_once('./lang/lang.class_pesquisador.php');
		require_once("./ads/style2.php");
		require_once("./ads/tema.php");
		$oFachada	  = new fachada();
		
		if($cpf!="")	$vPesquisador = $oFachada->getPesqNomeCpf($cpf);

		?>
			<script language="javascript" src="javascript2.js"></script>
			<script language="javascript"  src="javascript/FormContext.js"></script>
			<div class="sessao_portal">
		   		<div style="float:left;"><img src="images/seta_direita.gif" width="12" height="15" align="middle">&nbsp;Novo Pesquisador </div>
				<div align="right"><a href="index.php"><img src="images/casa.gif" height="14" width="14" border="0" align="top">&nbsp;Página&nbsp;Inicial</a></div>
		   	</div>

			 <form action="?pagina=cadpesq" method="post" name="formbuscap" onSubmit="return Verifica_campo_CPF(document.formbuscap.form_cpf);"><div align="center">
         <table width="453" height="2" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#F5F6FB">
	         <tr>
             	<td >
				  <table width="100%" border="0" cellpadding="0" cellspacing="6" bgcolor="F5F6FB" class="txtr">
					<tr class="txtr2" >
					  <td  >
					  	
						<? if ($cpf=="") { ?>
							<div align="center">
							Informe seu CPF: 
							<input name="form_cpf" type="text" class="txtr" id="form_cpf" size="16" maxlength="14"  value="<?=$cpf?>"> <span class="spanbtn"><a href="#" onClick="if(Verifica_campo_CPF(document.formbuscap.form_cpf)){ formbuscap.submit();}"><img src="images/btn_Pesquisar.gif" width="75" height="17" border="0" ></a>
					  		</div>
						<? } else { ?>
							<span class="txtbr">CPF: </span><?=$cpf?> <span class="spanbtn"><a href="?pagina=cadpesq"><img src="images/btn_NovaBusca.gif" alt="Nova Busca" border="0"></a></span>
						<? } ?>
					   </td>
					</tr>
					
					<?
					if ($cpf!="") { 
						if($vPesquisador){
							
						?>
							<tr>
                            	<td  class="txtbr">Nome: <?=$vPesquisador[nome];?></td>
                        	</tr>
							<tr>
								<td class="txtbr">Pesquisador já cadastrado como pesquisador no sistema.</td>
							</tr>
						<? 
						} elseif($oUsuarioPibic = $oFachada->getUsuarioCpf($cpf)){
							$usrId=$oUsuarioPibic->getId();
						?>
                        	<tr>
                            	<td ><span class="txtbr">Nome: <?=$oUsuarioPibic->getNome();?></span></td>
                        	</tr>
							<tr>
								<td ><span class="txtbr">Usuário já cadastrado no sistema. <br>Para se cadastrar como pesquisador clique em</span><span class="spanbtn"><a href="#" onClick="formbuscap.acao.value='incluir';formbuscap.submit();"><img src="images/btn_Prosseguir.gif" width="80" height="14" border="0" ></a></span></td>
							</tr>

						<?
						} elseif($oUsuarioPropesp = $oFachada->getUsuarioCpfPropesp($cpf)){ 
								$usrId=$oUsuarioPropesp->getId();
						?>
							<tr>
                            	<td ><span class="txtbr">Nome: <?=$oUsuarioPropesp->getNome();?></span></td>
                        	</tr>
							<tr>
								<td ><span class="txtbr">Usuário cadastrado na Propesp. </span><span class="spanbtn"><a href="#" onClick="formbuscap.acao.value='incluir';formbuscap.submit();"><img src="images/btn_Prosseguir.gif" width="80" height="14" border="0" ></a></span></td>
							</tr>
						<? 
							
						}//fim elseif
					
						else{
						?>
							<tr>
                            	<td ><span class="txtbr">Pesquisador não cadastrado. </span><span class="spanbtn3"><a href="#" onClick="formbuscap.acao.value='novo';formbuscap.submit();"><img src="images/btn_Incluir.gif" border="0" ></a></span></td>
                        	</tr>
						<? } 
					
					 }?>
					
						<TR class="txtr2"> 
							<TD height=1  bgColor="#C0D0E0"><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
						</TR>
				</table>
			</td>
		 </tr>
	  </table>
				<input type="hidden" name="acao" value="buscar">
				<input type="hidden" name="usrId" value="<?=$usrId?>">
				<input type="hidden" name="cpf" value="<?=$cpf?>">
	</div>
	</form>
			<script language="javascript">
			if(document.formbuscap.cpf.value == ""){
				formulario = new FormContext(document.formbuscap);
				formulario.addCampo("form_cpf","CPF",'cpf',false);
			}
			</script>
	<?
	}
		
	function form_cadpesq($cpf,$acao){
		require_once("ads/style2.php");
		require_once('./lang/lang.class_pesquisador.php');
		if($acao=="incluir"){
			$oFachada = new fachada();
            $oUsr 	 = $oFachada->getUsuarioId($this->getId());
            $nome	 = $oUsr->getNome();
            $email   = $oUsr->getEmail();
            $login   = $oUsr->getLogin();
               	
            if(strpos($email,",")!==false){
            	$email   = explode(",",$email);
            	$_email  = $email[0];
            	$_email2 = $email[1];
            }
            else $_email = $email;
			
			$read 	= "readonly";		
		}
				
	?>
			
			<div class="sessao_portal">
		   		<div style="float:left;"><img src="images/seta_direita.gif" width="12" height="15" align="middle">&nbsp;Cadastro de Pesquisadores</div>
				<div align="right"><a href="index.php"><img src="images/casa.gif" height="14" width="14" border="0" align="top">&nbsp;Página&nbsp;Inicial</a></div>
		   	</div>
		<script language="javascript" src="javascript2.js"></script>
		<form action="?pagina=novo_pesq" method="post" name="formpesq"><div align="center">
         <table width="431" height="2" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#F5F6FB">
		  <TBODY>
                <tr>
                  <td width="429">
				  	<table width="422" height="160" border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#F5F6FB">
                      <tr>
                        <td width="418">						
						 <table width="415" border="0" cellpadding="0" cellspacing="1" align="center">
                          <tr class="txt2">
                            <td valign="middle" bgcolor="F5F6FB" class="txtr">
                              <table width="100%" border="0" cellpadding="0" cellspacing="6" align="center">
                                <tr class="txtr2">
                                  <td width="39" align="left">Nome</td>
                                  <td colspan="4"><input name="form_nome" type="text" class="txtr" id="form_nome2" size="67" value="<?=$nome?>" <? echo $read; ?>></td>
                                </tr>
                                <tr class="txtr2">
                                  <td height=1 colspan="5" bgcolor="#C0D0E0"><img height=1 alt="" src="images/blank.gif" width=1 border=0></td>
                                </tr>
                                <tr class="txtr2">
                                  <td align="left">CPF</td>
                                  <td width="155"><input name="form_cpf" type="text" class="txtr" id="form_cpf" size="25" maxlength="14" value="<?=$cpf?>" readonly ></td>
                                  <td width="7">&nbsp;</td>
                                  <td width="56">Fone</td>
                                  <td width="120"><input name="form_fone" type="text" class="txtr" id="form_fone" size="20" value="<?=$fone?>"></td>
                                </tr>
                                <tr class="txtr2">
                                  <td height=1 colspan="5" bgcolor="#C0D0E0"><img height=1 alt="" src="images/blank.gif" width=1 border=0></td>
                                </tr>
                                <tr class="txtr2">
                                  <td>E&shy;mail</td>
                                  <td><input name="form_email" type="text" class="txtr" id="form_email" size="25" onBlur="isEmail(this)" value="<?=$_email?>" <? echo $read; ?>></td>
                                  <td>&nbsp;</td>
                                  <td>E&shy;mail Opcional</td>
                                  <td><input name="form_email2" type="text" class="txtr" id="form_email2" size="25" onBlur="isEmail(this)" value="<?=$_email2?>" <? echo $read; ?>></td>
                                </tr>
								 <tr class="txtr2">
                                  <td height=1 colspan="5" bgcolor="#C0D0E0"><img height=1 alt="" src="images/blank.gif" width=1 border=0></td>
                                </tr>
                                <tr class="txtr2">
                                  <td>Login</td>
                                  <td colspan="4"><input name="form_login" type="text" class="txtr" id="form_login" size="20" maxlength="20"  onKeyPress="return(noAcento('form_login',event))" value="<?=$login?>"></td>
                                </tr>
                                 <tr class="txt2">
                                  <td height="25" align="center" colspan="5"><input name="btnEnviar" type="button" class="button49x20" value="Enviar" onClick="if(formulario.validaForm()==true)formpesq.submit();"></td>
                                </tr>
                            </table>
						   </td>
                          </tr>
                        </table>
					    </td>
                      </tr>
                  </table>
				  </td>
		    </tr>
		   </TBODY>
		  </table>
				</div>
				<input type="hidden" name="acao" value="<?=$acao?>">
				<input type="hidden" name="usrId" value="<?=$this->getId();?>">
			  </form>
			<script language="javascript">
				formulario = new FormContext(document.formpesq);
				formulario.addRegra("(document.formpesq.form_nome.value)","Por Favor, informe o nome.");	
				formulario.addRegra("(document.formpesq.form_cpf.value)","Por Favor, informe o cpf.");
				formulario.addRegra("(document.formpesq.form_fone.value)","Por Favor, informe o telefone.");
				formulario.addRegra("(document.formpesq.form_email.value)","Por Favor, informe o email.");		
				formulario.addRegra("(document.formpesq.form_login.value)","Por Favor, informe o login.");
			</script>
		<p align="right" class="spanbtn"><a href="?pagina=cadpesq"><img src="images/seta_voltar.gif" border="0" width="50" height="14" align="absmiddle"></a></p>
	<? 
	}  //Fim form_cadpesq
		
	function form_ficha($acao){
    	$oFachada    = new fachada();
       	$oUsr        = $oFachada->getUsuarioId($this->getId());
       	$_nome       = $oUsr->getNome();
       	$_cpf        = $oUsr->getCpf();
       	$email       = $oUsr->getEmail();

        if(strpos($email,",")!==false){
			$email   = explode(",",$email);
			$_email  = $email[0];
			$_email2 = $email[1];
		}
	   	else $_email = $email;
      	
		$inscricao   = false;
		$tpSelecao   = 0;
		$selecao     = false;
		
		$oPesq       = $oFachada->getPesquisadorId($this->getId());
		$_sArea    	 = $oPesq->getSubArea();
       	$codArea     = $oPesq->getArea();
       	$_area       = substr($codArea,0,4);
       	$_gArea      = substr($_area,0,1);
            	  
	   	if($this->getPerfilLogado()=="Pesquisador"){
	   		$atendimento 	= "disabled";	
			
			$selEdital   = $oFachada->getSelecaoPorPesqAno($this->getId());
			if($selEdital){
				$sel = array_shift($selEdital);
				$tpSelecao = $sel->getTipo();		
			}
			// Testando se há algum periodo de incrição aberto
			$oPeriodoIn     = $oFachada->getInscricaoAberta();
			$tpSelecao  = $_SESSION['sEdital'];
			/*if($oPeriodoIn and $tpSelecao <= 0){
				//$tpSelecao  = $oPeriodoIn->getTpSelecao();				
							
			}
			*/
			// Testando se o pesquisador está concorrendo caso haja inscriçao aberta	
       		if ($tpSelecao>0){
	   			$oSelecao   = $oFachada->getSelecaoPorPesqAnoTp($this->getId(),$tpSelecao);
				
				$vetBolsaOfertada = $oFachada->getOfertasAnoEditalDesc($_SESSION['sAno'],$tpSelecao); 

	   		}
			

					
	   		if ($oSelecao == false){						
				$oSelecao   = $oFachada->getSelecaoPorPesqAnoTp($this->getId(),20);// GAMBIARRA
				$vetBolsaOfertada = $oFachada->getOfertasAnoEditalDesc($_SESSION['sAno'],20); //GAMBIARRA			
				if ($oSelecao == false){					
    	   		$edicao = "disabled";
				} elseif($oPeriodoIn == false and $oPesq->getStatus()!=1){
				$edicao = "disabled";
			}
	       	}
			elseif($oPeriodoIn == false and $oPesq->getStatus()!=1){
				$edicao = "disabled";
			}
       	}
		else{
			$tpSelecao     = $_SESSION['sEdital'];
			$oSelecao      = $oFachada->getSelecaoPorPesqAnoTp($this->getId(),$tpSelecao);
	
			$vetBolsaOfertada = $oFachada->getOfertasAnoEditalDesc($_SESSION['sAno'],$tpSelecao);
			
			$vetAtend      = $oFachada->getAtendPorPesqAno($this->getId());
       		$_numbolsaCnpq = 0;
			$_numbolsaUfpa = 0;
			$_numbolsaInt  = 0;
			
			if($vetAtend){
				while($at = array_shift($vetAtend)){
        			if($at->getCodTipoBolsa()==1){
        				 $_numbolsaCnpq = $at->getQtd();
        			}
					elseif($at->getCodTipoBolsa()==2){
        				 $_numbolsaUfpa = $at->getQtd();
        			}
        			else $_numbolsaInt  = $at->getQtd();
        		} // fim do while
       		} // fim do if($vetAtend)
		} // fim do else
				
		
		// Se o edital for do PIBIC INTERIOR (tipoSelecao=2), busca as unidades do interior (unidade.tipo=2)
		if ($tpSelecao==2){
			$vetUnidade = $oFachada->getUnidadeTipo(2);
		}
		else{
			$vetUnidade = $oFachada->getUnidades();
		}
		
		
		if($_POST['tipo_edital']){
			$editalSelec = $_POST['tipo_edital'];
		}else if($tpSelecao > 0){
			$editalSelec = $tpSelecao;
		}else{
			$editalSelec = $_SESSION['sEdital'];
		}

		
		//Função abaixo serve para o site escolher o edital correto
		$numEditaisParticipando = $oFachada->selecaoEdital($this->getId(), $editalSelec);
			
		//$oPub = $oFachada->getPubliCod('2');
        if($_SESSION['sEdital']) $descEdital =$oFachada->getTipoEditalCod($_SESSION['sEdital']);
		else $descEdital =$oFachada->getTipoEditalCod(1);
		
	    if($descEdital) $nomeEdital = $nomeEdital = $descEdital->getDescricao();
       	//if($this->getPerfilLogado()=="Pesquisador" and $oPub->getStatus()!=1 ){
		if($this->getPerfilLogado()=="Pesquisador"){
        	$view = "disabled";
       	}		
		
				?>	
		<br>
		<script language="javascript" src="javascript2.js"></script>
        <script language="javascript" src="javascript/jquery-1.4.2.min.js"></script>
        <script language="javascript" src="javascript/meu_jquery.js"></script>
		<center>
	   	<?
			$oFachada  = new fachada();
			$tipoUnidade = $oFachada->getTipoUnidade($oPesq->getUnidade());	
			
		?>
		</select>
        <html>
        <body>
		<table width="479" height="2" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#F5F6FB" class="tableforms">
		<tr><td>

			<form action="?pagina=ficha_pesquisador" method="post" name="form1">
			<?if($numEditaisParticipando > 0){?>
				<div align="center" class="txtbr"> Edital selecionado: <?echo $nomeEdital;?></div>
			<?}?>	
				<table width="100%" border="0" cellpadding="0" cellspacing="1">
					<tr>
                    	<td width="486" height="31"  background="images/barra_menuCad.gif" class="txtbr"> <div align="center"> Ficha de Inscri&ccedil;&atilde;o</div></td>
                    </tr>
					<tr class="txt2">
						<td valign="middle" class="txtr">
							<table width="100%" border="0" cellpadding="0" cellspacing="6">
								<tr class="txtr2">
									<td width="78">Nome</td>
								  	<td colspan="4"><div align="left"><input name="form_nome" type="text" class="txtr" id="form_nome" size="80" value="<?=$_nome?>" <?=$edicao ?>></div></td>
                                </tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
                                <tr class="txtr2">
									<td>CPF</td>
									<td width="115"><input name="form_cpf" type="text" class="txtr" id="form_cpf" size="26" maxlength="14" onKeyPress="return(FormataCpf(this,11,event))" onBlur="Verifica_campo_CPF(this)" value="<?=$_cpf?>" <?=$edicao ?> > </td>
									<td width="13">&nbsp;</td>
									<td width="73">Data Nascimento</td>
									<td width="149"><input name="form_dtnasc" type="text" class="txtr" id="form_dtnasc" size="12" maxlength="10" onBlur="isDate(this)" value="<?=$oPesq->getDtNasc();?>" <?=$edicao ?>> </td>
								</tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								 <tr class="txtr2">
									<td>Email</td>
									<td ><input name="form_email" type="text" class="txtr" id="form_email" size="26" onBlur="isEmail(this)" value="<?=$_email?>" <?=$edicao ?>> </td>
									<td >&nbsp;</td>
									<td w>Email Opcional</td>
									<td ><input name="form_email2" type="text" class="txtr" id="form_email2" size="26" onBlur="isEmail(this)" value="<?=$_email2?>" <?=$edicao ?>></td>
								</tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
									<td>Naturalidade</td>
								  <td><input name="form_naturalidade" type="text" class="txtr" id="form_naturalidade" size="26" value="<?=$oPesq->getNaturalidade();?>" <?=$edicao ?> > </td>
									<td>&nbsp;</td>
									<td>Nacionalidade</td>
									<td><input name="form_nacionalidade" type="text" class="txtr" id="form_nacionalidade" size="26" value="<?=$oPesq->getNacionalidade();?>" <?=$edicao ?> ></td>
							    </tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
                                  	<td>Pa&iacute;s de Origem</td>
                                  	<td width="115"><input name="form_origem" type="text" class="txtr" id="form_origem2" size="26" value="<?=$oPesq->getOrigem();?>" <?=$edicao ?> ></td>
                                  	<td width="13">&nbsp;</td>
                                  	<td width="73">Titula&ccedil;&atilde;o</td>
                                  	<td width="149"><select name="form_titulo" class="txtr" onChange="habilitaBolsas()" id="select" <?=$edicao ?>>
                                      <option value="" selected></option>
                                      <option value="1" <? if ($oPesq->getTitulo()==1)echo "selected"; ?>>Mestre</option>
                                      <option value="2" <? if ($oPesq->getTitulo()==2)echo "selected"; ?>>Doutor(a)</option>
                                      <option value="3" <? if ($oPesq->getTitulo()==3)echo "selected"; ?>>P&oacute;s-Doutor(a)</option>
                                    </select></td>
								</tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
								  	<td>Ano Titula&ccedil;&atilde;o</td>
								  	<td width="115">
										<select name="form_anoTitu" class="txtr" id="form_anoTitu" <?=$edicao ?>>
                                 			<option value="" selected></option>
											<?
											for($i=1940;$i<=date('Y');$i++){
												$aux = ($i==$oPesq->getAnoTitulo()) ? "selected" : "";
												echo "<option value=\"$i\" $aux>$i</option>";
											}
											?>
										</select>
									</td>
                                  	<td width="13">&nbsp;</td>
                                  	<td>Local Titula&ccedil;&atilde;o</td>
                                  	<td width="149"><input name="form_localTitu" type="text" class="txtr" id="form_localTitu" size="26" value="<?=$oPesq->getLocalTitulo();?>" <?=$edicao ?>></td>								 
								</tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
                                <tr class="txtr2">
								  	<td >IES da Titula&ccedil;&atilde;o </td>
                                  	<td colspan="4" ><div align="left"><input name="form_finanTitu" type="text" class="txtr" id="form_finanTitu" size="80" value="<?=$oPesq->getAgenciaTitulo();?>" <?=$edicao ?>></div></td>
                                </tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
                                  	<td>Unidade </td>
                                  	<td width="115">
										<select name="form_unid" class="txtr" id="form_unid" <?=$edicao ?>>
                                 			<option value="" selected></option>
											 <?
											if ($vetUnidade){							
												while($lc=array_shift($vetUnidade)){
													$aux = ($lc->getCod()==$oPesq->getUnidade()) ? "selected" : "";
													echo "<option value=\"".$lc->getCod()."\" $aux>".$lc->getDesc()."</option>";
												}
											}
											?>
										</select>
									</td>								 
                                  	<td width="13">&nbsp;</td>
                                  	<td width="73">Departamento </td>
                                  	<td width="149"><div align="left"><input name="form_depart" type="text" class="txtr" id="form_depart" size="26" value="<?=$oPesq->getDepart();?>" <?=$edicao ?>></div></td>
								</tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
                                  	<td>Categoria</td>
                                  	<td width="115">
								  		<select name="form_categoria" class="txtr" id="form_categoria" <?=$edicao ?>>
                                       <option value="" selected></option>
									   <?
        		  						$vetCategoria = $oFachada->getCategorias();
        								if ($vetCategoria){		
        		  							while($lc=array_shift($vetCategoria)){
        										$aux = ($lc->getCod()==$oPesq->getCategoria()) ? "selected" : "";
        										echo "<option value=\"".$lc->getCod()."\" $aux>".$lc->getDesc()."</option>\n";
        		  							}
        								}
                  						?>
                                  		</select>
								  	</td>
                                  	<td width="13">&nbsp;</td>
                                  	<td width="73">Telefone </td>
                                  	<td width="149"><div align="left"><input name="form_fone" type="text" class="txtr" id="form_fone" size="11" maxlength="24" value="<?=$oPesq->getTelefone();?>" <?=$edicao ?>></div></td>									
								</tr>
								<tr class="txtr2">
                                  	<td width="73">Celular </td>
                                  	<td width="49"><div align="left"><input name="form_celular" type="text" class="txtr" id="form_celular" size="11" maxlength="24" value="<?=$oPesq->getCelular();?>" <?=$edicao ?>></div></td>
								</tr>	
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
                                  	<td colspan="5">
								  		<iframe src="select_area.php?gArea=<?=$_gArea?>&area=<?=$_area?>&sArea=<?=$_sArea?>&edicao=<?=$edicao?>" name="areas"  width="100%" height="85" scrolling="no"  frameborder="0" marginwidth="0" marginheight="0" <?=$edicao ?>></iframe>
								  		<input type="hidden" name="lstGrandeArea" ><input type="hidden" name="lstArea"><input type="hidden" name="lstSubArea">
								  	</td>
                                </tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
								  	<td >Especialidade </td>
                                  	<td colspan="4" ><div align="left"><input name="form_esp" type="text" class="txtr" id="form_esp" size="80" value="<?=$oPesq->getEspecialidade();?>" <?=$edicao ?>></div></td>
                                </tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
                                  	<td>Orientador Pos-Grad. ? </td>
                                  	<td><select name="form_orientPos" class="txtr" id="form_orientPos" <?=$edicao ?>>
                                   		<option value=""></option>
                                    	<option value="1" <? if ($oPesq->getFlgPos()==1) echo "selected"; ?> >Sim</option>
                                    	<option value="2" <? if ($oPesq->getFlgPos()==2) echo "selected"; ?> >N&atilde;o</option>
                                  		</select>
									</td>
                                  	<td>&nbsp;</td>
                                  	<td>Programa</td>
                                  	<td><input name="form_localPos" type="text" class="txtr" id="form_localPos" size="26" value="<?=$oPesq->getPos();?>" <?=$edicao?> ></td>
                                </tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
                                  	<td>Pesquisador Produtividade? </td>
                                  	<td><select name="form_Prod" class="txtr" id="form_Prod" <?=$edicao ?>>
                                    	<option value=""></option>
                                    	<option value="1" <? if ($oPesq->getProd()==1) echo "selected"; ?>>Sim</option>
                                    	<option value="2" <? if ($oPesq->getProd()==2) echo "selected"; ?>>N&atilde;o</option>
                                  		</select>
									</td>
                                  	<td>&nbsp;</td>
                                  	<td>Foi Bolsista de IC? </td>
                                  	<td><select name="form_ic" class="txtr" id="form_ic" <?=$edicao ?>>
                                    	<option value=""></option>
                                    	<option value="1"<? if ($oPesq->getFlgIC()==1) echo "selected"; ?>>Sim</option>
                                    	<option value="2"<? if ($oPesq->getFlgIC()==2) echo "selected"; ?>>N&atilde;o</option>
                                  		</select>
									</td>
								</tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<tr class="txtr2">
                           		  	<td colspan="5">
								  		<iframe src="select_agencia.php?agCod=<?=$oPesq->getflgAgenciaIc();?>&edicao=<?=$edicao?>" name="agencias"  width="100%" height="55" scrolling="no"  frameborder="0" marginwidth="0" marginheight="0" <?=$edicao ?>></iframe>
                                        <input type="hidden" name="lstAgencia" >
									</td>
                                </tr>
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
                                
								<?

								if ( (($this->getPerfilLogado()=="Pesquisador") OR ($this->getPerfilLogado()=="Administrador")) AND $tpSelecao==1 AND $oSelecao){ 
									$vBolsaSolic = $oFachada->getBolsaSelecaoAsc($oSelecao->getCod());
									
									if ($vBolsaSolic){
										while($oNumBolsaSolic = array_shift($vBolsaSolic)) {
											switch ($oNumBolsaSolic->getTipoBolsa()){
												case 1:
												$numBolsa1 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa1 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa1 = $oNumBolsaSolic->getTipoBolsa();
												break;
												case 2:
												$numBolsa2 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa2 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa2 = $oNumBolsaSolic->getTipoBolsa();
												break;
												case 3:
												$numBolsa3 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa3 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa3 = $oNumBolsaSolic->getTipoBolsa();
												break;
												case 4:
												$numBolsa4 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa4 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa4 = $oNumBolsaSolic->getTipoBolsa();
												break;
												case 5:
												$numBolsa5 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa5 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa5 = $oNumBolsaSolic->getTipoBolsa();
												break;
												case 6:
												$numBolsa6 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa6 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa6 = $oNumBolsaSolic->getTipoBolsa();
												break;
												case 8:
												$numBolsa8 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa8 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa8 = $oNumBolsaSolic->getTipoBolsa();
												break;
												case 17:
												$numBolsa17 = $oNumBolsaSolic->getQtdBolsa();
												$prioridadBolsa17 = $oNumBolsaSolic->getPrioridadeBolsa();
												$tipoBolsa17 = $oNumBolsaSolic->getTipoBolsa();
												break;
        									} // FIM SWITCH
									 	} // FIM WHILE
									}					
								?>
                                <TR class="txtr2"> 
									<TD height=30 colspan="5" bgColor=#C0D0E0>Assinale as modalidades de bolsa que voc&ecirc; aceita receber e a quantidade para cada modalidade:</TD>
								</TR>	
                                <tr>
                                <td colspan="1" align="center"><strong>INTERESSE</strong></td>
                                <td colspan="2" align="center"><strong>TIPO DE BOLSA</strong></td>                                
                                <td colspan="1" align="center"><strong>QUANTIDADE DE BOLSAS</strong></td>
                                </tr>				
								<tr class="txtr2">
                                  	<td colspan="1" align="center"><input type="checkbox" name="form_aceitaBolsa1" id="form_aceitaBolsa1" value="aceitaBolsa" <? if ($tipoBolsa1==1){ echo "checked";} ?>/></td>
                                    <td colspan="2">PIBIC CNPq</td>                                	
                                    <td colspan="1" align="center"><input name="form_qtdBolsa1" type="text" class="txtr" id="form_qtdBolsa1" size="4" maxlength="1" onKeyPress="return(noStrMaxDuasBolsas('form_qtdBolsa1',event))" onBlur="isInteger(this)" onChange="MM_callJS('bolsaGeral()')" value="<?=$numBolsa1?>"></td>
                                </tr>
								<tr class="txtr2">
                                  	<td colspan="1" align="center"><input type="checkbox" name="form_aceitaBolsa2" id="form_aceitaBolsa2" value="aceitaBolsa" <? if ($tipoBolsa2==2){ echo "checked";} ?>/></td>
                                    <td colspan="2">PIBIC UFPA</td>                                	
                                    <td colspan="1" align="center"><input name="form_qtdBolsa2" type="text" class="txtr" id="form_qtdBolsa2" size="4" maxlength="1" onKeyPress="return(noStrMaxDuasBolsas('form_qtdBolsa2',event))" onBlur="isInteger(this)" onChange="MM_callJS('bolsaGeral()')" value="<?=$numBolsa2?>"></td>
								</tr>
								<tr class="txtr2">
                                  	<td colspan="1" align="center"><input type="checkbox" name="form_aceitaBolsa3" id="form_aceitaBolsa3" value="aceitaBolsa" <? if ($tipoBolsa3==3){ echo "checked";} ?>/></td>
                                    <td colspan="2">PIBIC INTERIOR</td>                                
                                    <td colspan="1" align="center"><input name="form_qtdBolsa3" type="text" class="txtr" id="form_qtdBolsa3" size="4" maxlength="1" onKeyPress="return(noStrMaxDuasBolsas('form_qtdBolsa3',event))" onBlur="isInteger(this)" onChange="MM_callJS('bolsaGeral()')" value="<?=$numBolsa3?>"></td>
                                                                             
								<tr class="txtr2">
                                  	<td colspan="1" align="center"><input type="checkbox" name="form_aceitaBolsa5" id="form_aceitaBolsa5" value="aceitaBolsa" <? if ($tipoBolsa5==5){ echo "checked";} ?>/></td>
                                    <td colspan="2">PIBIC CNPq - AF</td>                                	
                                    <td colspan="1" align="center"><input name="form_qtdBolsa5" type="text" class="txtr" id="form_qtdBolsa5" size="4" maxlength="1" onKeyPress="return(noStrMaxUmaBolsa('form_numBolsasPIBIT',event))" onBlur="isInteger(this)" onChange="MM_callJS('bolsaGeral()')" value="<?=$numBolsa5?>"></td>
                                </tr>
                                <tr class="txtr2">
                                  	<td colspan="1" align="center"><input type="checkbox" name="form_aceitaBolsa6" id="form_aceitaBolsa6" value="aceitaBolsa" <? if ($tipoBolsa6==6){ echo "checked";} ?>/></td>
                                    <td colspan="2">PIBIC UFPA - AF</td>                                	
                                    <td colspan="1" align="center"><input name="form_qtdBolsa6" type="text" class="txtr" id="form_qtdBolsa6" size="4" maxlength="1" onKeyPress="return(noStrMaxDuasBolsas('form_qtdBolsa6',event))" onBlur="isInteger(this)" onChange="MM_callJS('bolsaGeral()')" value="<?=$numBolsa6?>"></td>
                                </tr>                                                                      
								<tr class="txtr2">
                                  	<td colspan="1" align="center"><input type="checkbox" name="form_aceitaBolsa8" id="form_aceitaBolsa8" value="aceitaBolsa" <? if ($tipoBolsa8==8){ echo "checked";} ?>/></td>
                                    <td colspan="2">PIBITI CNPq</td>                                	
                                    <td colspan="1" align="center"><input name="form_qtdBolsa8" type="text" class="txtr" id="form_qtdBolsa8" size="4" maxlength="1" onKeyPress="return(noStrMaxUmaBolsa('form_qtdBolsa8',event))" onBlur="isInteger(this)" onChange="MM_callJS('bolsaGeral()')" value="<?=$numBolsa8?>"></td>
                                </tr>
								<tr class="txtr2">
                                  	<td colspan="1" align="center"><input type="checkbox" name="form_aceitaBolsa17" id="form_aceitaBolsa17" value="aceitaBolsa" <? if ($tipoBolsa17==17){ echo "checked";} ?>/></td>
                                    <td colspan="2">PIBIC EBTT</td>                                	
                                    <td colspan="1" align="center"><input name="form_qtdBolsa17" type="text" class="txtr" id="form_qtdBolsa17" size="4" maxlength="1" onKeyPress="return(noStrMaxUmaBolsa('form_qtdBolsa17',event))" onBlur="isInteger(this)" onChange="MM_callJS('bolsaGeral()')" value="<?=$numBolsa17?>"></td>
                                </tr>
                                
								                                                 
								<TR class="txtr2"> 
									<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
								</TR>
								<? } ?>
							</table>
						</td>
					</tr>
					<tr class="txt2">
                    	<td height="20" class="txtr">
							<table width="100%" border="0" cellspacing="0">
                     			<tr bgcolor="#DBE7F4" class="spanbtn3" background="images/sub_barra_trans.gif">
                                	<td width="61" height="20" > 
									<?
								   	if ($edicao==""){
								   		?>
								   		<div align="center"><a href="#"><img src="images/btn_salvar.gif" width="54" height="14" border="0" onClick="if(formulario.validaForm()==true)saveMe();"></a></div>
								   		<?
									}
									?>
									</td>
							  		<td background="images/sub_barra_trans.gif" >&nbsp;</td>
                               	</tr>
							</table>
						</td>
					</tr>
				</table>
                
				<input type="hidden" name="pesqId" value=<?=$this->getId();?>>
                <input type="hidden" name="tipounidade" id="tipounidade" value=<?=$tipoUnidade;?>>
		  	  	<input type="hidden" name="acao" value=<?=$acao?>>
			</form>
		</td></tr>
		
		<?

	 	if ($atendimento!="enabled"){					
			if ($vetBolsaOfertada){ 
				$numBolsasGeralSolic   = $oSelecao->getNumBolsa();
				$_numbolsaAt = $oSelecao->getNumBolsaAtend();								

				//O problema se encontra nos 2 if acima + no período de inscrição, que já passou. (linha 662 e 664 de "form_pesquisador")
				//Se ambos os if tiverem "$atendimento!="disabled"" e estiver noperíodo, o programa funcionrará.
				//O programa bloqueia que os pesquisadores editem o número de bolsas através de a) : fazendo uma verificação do tipo e b) : Neste laço ele não pega o editao e o tipo de bolsa. (linha 247)
				//Sem estes dois, o programa não entra na estrutura de seleção, consequentemente pulando o laço de solicitação de bolsas
				  if($_SESSION['sEdital'] != 1 or $this->getPerfilLogado()=="Administrador"){
			?>
			
				<tr><td>
					<form action="?pagina=atendimento" method="post" name="form2">
						<table width="100%" border="0" cellpadding="0" cellspacing="1">
							<tr>
								<td valign="middle" class="txtr">
									<table width="100%" border="0" cellpadding="0" cellspacing="6">
										
										<tr class="txtr2">
											<td colspan="5" class="txtbr"><div align="center">ATENDIMENTO</div></td>
										</tr>
										<TR class="txtr2"> 
											<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
										</TR>
									<?  if($_SESSION['sEdital'] == 17){?>
										<tr class="txtr2">
											<td colspan="3">N&ordm; de Bolsas Solicitadas e Atendidas:</td>
											<td colspan="2"><input name="form_numBolsas" type="text" class="txtr" id="form_numBolsas" size="4" maxlength="4" onKeyPress="return(noStr('form_numBolsas',event))" onBlur="isInteger(this)" value="<?=$numBolsasGeralSolic?>" ></td>
										</tr>									
									<? }else{ ?>	
										<tr class="txtr2">
											<td colspan="3">N&ordm; de Bolsas Solicitadas:</td>
											<td colspan="2"><input name="form_numBolsas" type="text" class="txtr" id="form_numBolsas" size="4" maxlength="4" onKeyPress="return(noStr('form_numBolsas',event))" onBlur="isInteger(this)" value="<?=$numBolsasGeralSolic?>" ></td>
										</tr>					
									<?} ?>	
										<TR class="txtr2"> 
											<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
										</TR>
										<? 
										if ($_SESSION['sEdital'] != 1){
													$_numbolsaAt = $numBolsasGeralSolic;
										}
										if($this->getPerfilLogado()!="Pesquisador"){?>
										<TR  class="txtr2">	
											<td colspan="3">N&ordm; de Bolsas Atendidas:</td>
											<td colspan="2"><input name="form_numBolsasAt" type="text" class="txtr" id="form_numBolsasAt" size="4" maxlength="4" onKeyPress="return(noStr('form_numBolsasAt',event))" onBlur="isInteger(this)" value="<?=$_numbolsaAt?>" ></td>
											<TR class="txtr2"> 
											<TD height=1 colspan="5" bgColor=#C0D0E0><IMG height=1 alt="" src="images/blank.gif" width=1 border=0></TD>
										</TR>
										</TR>																				
										<? 
										// Quando houver mais de uma modalidade de bolsa ofertada exibe a quantidade atendida 
										if (count($vetBolsaOfertada)>=1){
											for ($i=0; $i<count($vetBolsaOfertada); $i++){
												$qtdBolsaAt = 0; 
												$codTpBolsa = $vetBolsaOfertada[$i]['codTipoBolsa'];
												//verifica quantas bolsas foram atendidas para a modalidade
												$vetAtend = $oFachada->getAtendPorPesqAnoTp($this->getId(),$codTpBolsa);
												if ($vetAtend) $qtdBolsaAt = $vetAtend->getQtd();
												if ($_SESSION['sEdital'] != 1){

													$qtdBolsaAt = $_numbolsaAt;
												}
										?>
												<TR class="txtr2">
													<td colspan="2">Bolsas <?=$vetBolsaOfertada[$i]['desc']?> Recebidas:</td>
													<td colspan="3"><input name="form_numBolsas<?=$i?>" type="text" class="txtr" id="form_numBolsas<?=$i?>" size="4" maxlength="4" onKeyPress="return(noStr('form_numBolsas<?=$i?>',event))" onBlur="isInteger(this)" value="<?=$qtdBolsaAt?>" ><input name="form_codTpBolsa<?=$i?>" type="hidden" value="<?=$codTpBolsa?>" ></td>										
												</TR>
												
										<?		
												}
											}// fim for
										//fim if
									      
										 }else{  ?>
											<td colspan="2"><input type="hidden" name="form_numBolsasAt" type="text" class="txtr" id="form_numBolsasAt" size="4" maxlength="4" onKeyPress="return(noStr('form_numBolsasAt',event))" onBlur="isInteger(this)" value="<?=$_numbolsaAt?>" ></td>
									  <? } ?>
									</table>
								</td>
							</tr>
							<tr class="txt2">
								<td height="20" class="txtr">
									<table width="100%" border="0" cellspacing="0">
										<tr bgcolor="#DBE7F4" class="spanbtn3" background="images/sub_barra_trans.gif">
											<td width="61" height="20" ><div align="center"><a href="#"><img src="images/btn_salvar.gif" width="54" height="14" border="0" onClick="if(formulario2.validaForm()==true)form2.submit();"></a></div></td>
											<td background="images/sub_barra_trans.gif" bgcolor="#DBE7F4" >&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>

						<? } //fim if atendimento
						}
						?>
						</table>
							<input type="hidden" name="pesqId"   value=<?=$this->getId();?>>
					</form>
				</td></tr>
	   <? }
		
	   	 if($this->getPerfilLogado()=="Pesquisador" and $numEditaisParticipando > 0){?>
		 
			<form action="index.php" method="post" name="form3" class="txtr" id="form3" >
			<table width="100%" border="0" cellpadding="0" cellspacing="1">
			<span class="menuTitulo">Edital: </span>
			<select name="tipo_edital" class="txtr" onchange="form3.submit()">
				<?				
				$insercao=false;
				$today = date("Y-m-d");
				$restrito=true;
				$teste = 0;
				$vTpEditais = $oFachada->getTipoEdital();
				// Testando se há algum periodo aberto de cadastro				
				$oPeriodo     = $oFachada->getPeriodoTipoAnoEdital('2',Date('Y'),$_SESSION['sEdital']);				
				if(($oPeriodo->getDtFinal() >= $today and $oPeriodo->getDtInicial() <= $today))				
				{
					$teste = 1;
				}				
			// Testando se o pesquisador está na selecao de caso haja inscriçao aberta	
				if($vTpEditais){
					foreach($vTpEditais as $oTpEdital){							
					if($oFachada->getSelecaoPorPesqTpAno($this->getId(),$oTpEdital->getCod(),$oPeriodo->getAno()))
					{
						$edi = $oTpEdital->getCod();
						$aux = $oTpEdital->getCod()== $_SESSION['sEdital']? "selected" :"";
					 	echo "<option value=".$oTpEdital->getCod()." $aux>".$oTpEdital->getDescricao()."</option>\n";						
						if ($teste>0)
						{									
							$oSelecao   = $oFachada->getSelecaoPorPesqTpAno($this->getId(),$oTpEdital->getCod(),$oPeriodo->getAno());
							if ($oSelecao)
							{	
								$insercao=true;									
							}
						}
		        	}			
			}
		 }		

		}else
		 {
		  $insercao = true;
		  $restrito = false;
	 	 }	
		 		
		 ?>
		 </table>
		</table>
	</center><br>
    </body>
    </html>
			<script language="javascript">
			formulario = new FormContext(document.form1);
			formulario.addCampo("form_dtnasc","Data de Nascimento",'data',false);
			formulario.addRegra("(document.form1.form_nome.value)","Por Favor, informe o  nome.");	
			formulario.addRegra("(document.form1.form_cpf.value)","Por Favor, informe o  cpf.");
			formulario.addRegra("(document.form1.form_email.value)","Por Favor, informe o  email.");
			formulario.addRegra("(document.form1.form_nacionalidade.value)","Por Favor, informe a nacionalidade.");
			formulario.addRegra("(document.form1.form_naturalidade.value)","Por Favor, informe a naturalidade.");
			formulario.addRegra("(document.form1.form_origem.value)","Por Favor, informe o lugar de origem.");
			formulario.addRegra("(document.form1.form_titulo.value)","Por Favor, informe a sua titulação.");
			formulario.addRegra("(document.form1.form_anoTitu.value)","Por Favor, informe o  ano que obteve a titulação.");
			formulario.addRegra("(document.form1.form_localTitu.value)","Por Favor, informe o  local onde obteve a titulação.");
			formulario.addRegra("(document.form1.form_finanTitu.value)","Por Favor, informe a financiadora da titulação.");
			formulario.addRegra("(document.form1.form_unid.value)","Por Favor, informe a unidade.");
			formulario.addRegra("(document.form1.form_depart.value)","Por Favor, informe o departamento.");
			formulario.addRegra("(document.form1.form_categoria.value)","Por Favor, informe a categoria.");
			formulario.addRegra("(areas.document.form1.lstArea.value)","Por Favor, informe a área de conhecimento.");
			formulario.addRegra("(document.form1.form_orientPos.value)","Por Favor, informe se orienta em pós-graduação e local.");
			formulario.addRegra("(document.form1.form_Prod.value)","Por Favor, informe se é bolsista de produtividade.");
			formulario.addRegra("(document.form1.form_celular)","Por Favor, informe o numero de celular");	
			formulario.addRegra("(document.form1.form_ic.value)","Por Favor, informe se foi bolsista de ic.");					
			/*formulario.addRegra("(document.form1.form_numBolsas.value)","Por Favor, informe o número de bolsas desejado.");*/
			</script>
				<script language="javascript">
				formulario3 = new FormContext(document.form2);
				</script>
			<?
			if ($vetBolsaOfertada){  
			?>
				<script language="javascript">
				formulario2 = new FormContext(document.form2);
				formulario2.addRegra("(document.form2.form_numBolsas.value)","Por Favor, informe o número de bolsas pedidas.");
				formulario2.addRegra("(document.form2.form_numBolsasAt.value)","Por Favor, informe o número de bolsas atendidas.");
				</script>
			<? if (count($vetBolsaOfertada)>1) {
					for ($i=0; $i<count($vetBolsaOfertada); $i++){
			?>	
						<script language="javascript">
						formulario2.addRegra("(document.form2.form_numBolsas<?=$i?>.value)","Por Favor, informe o número de bolsas <?=$vetBolsaOfertada[$i]['desc']?>.");
						</script>
			<?
					}//fim for
				}//fim if
			}// fim if
					
			
		
	}
		
		
	function form_admin($fClassificado,$fColuna,$fConsulta,$pagina2){
	require_once("ads/style2.php");
		//$pagina2; //é usada para a paginação
		
		$total = 0;
		if(!isset($pagina2)or $pagina2=="") { // Especifica uma valor para variavel pagina caso a mesma não esteja setada
			$pagina2 = 1; 
		} 
		$oFachada  = new fachada();
		if ($fColuna==1){
			$vetDadosTodos = $oFachada->getPesqUsrNomeClass($fConsulta,$fClassificado);
		}
		elseif ($fColuna==2){
			$vetDadosTodos = $oFachada->getPesqUsrUnidadeClass($fConsulta,$fClassificado);
		}
		else{
			$vetDadosTodos = $oFachada->getPesqUsrClass($fClassificado);
		}
		
		if($vetDadosTodos){
			$lpp=10;
	    	$total = count($vetDadosTodos);// Esta função irá retornar o total de linhas na tabela
			$inicio    = ($pagina2-1) * $lpp; // Retorna qual será a primeira linha a ser mostrada da consulta
	    	$paginas = ceil($total / $lpp); // Retorna o total de páginas
			$vetDados  = array_slice($vetDadosTodos,$inicio,$lpp);
		}
		else $vetDados = false;
	    
		
	   
		
		
		$cLinha=1; //contador de linha para os campos
		//fim
		
		
	
	?>
	
	<center>
	<br>
	<form action="?pagina=pesquisador" method="post" name="form1">
	  <table width="670" height="2" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="4B6188">
    	<tbody>
      	<tr>
        <td width="668" >
			<table width="666"  border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
            	<tr>
              		<td width="662"  height="1"><table width="93%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF"valign="top">
                		 <tr>
                			<td height="31"  background="images/barra_menuCad.gif" class="txtbr"><div align="center">Pesquisador</div></td>
       			      	</tr>
                		<tr>
                			<td height="28" bgcolor="F5F6FB" class="txtbr"><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#DBE7F4">
                                <tr>
                                  <td bgcolor="#EAF3FB"><p class="txtbr">
									<select name="form_class" class="txtr" id="form_class">
  									<option selected value="">Todos</option>
  									<option value="1" <? if ($fClassificado==1) {echo "selected";}?> >Aprovados</option>
  									<option value="0" <? if ($fClassificado!="" and $fClassificado==0) {echo "selected";}?>>Reprovados</option>
									</select>
								Filtar por 
  									<select name="form_coluna" class="txtr" id="form_coluna">
  									<option value="1" selected>Nome</option>
   									<option value="2" <? if ($fColuna==2) echo "selected";?>>Unidade</option>
   									</select>
									:                                    
									<input name="form_consulta" type="text" class="txtr" id="form_consulta" size="40"  value=<?=$fConsulta?>>
 									<a href="#"><img src="images/btn_Filtrar.gif" alt="Filtrar" width="45" height="17" border="0" onClick="document.form1.pg.value=1;form1.submit();"></a> </p>
                                  </td>
                                </tr>
                              </table></td>
              			 </tr>
						<tr>
                			  <td height="19" bgcolor="F5F6FB" class="txtbr">&nbsp;</td>
              			</tr>
                  		<tr class="txt2">
                              <td  valign="top" bgcolor="#FFFFFF" class="txtr"><table width="660" border="1" cellpadding="2" cellspacing="0" bordercolor="#DBE7F4" class="txtr2" valign="top">
                                <tr>
                                  <td width="661"  colspan="5"><table width="100%" border="0" cellpadding="2" cellspacing="0" bordercolor="#DBE7F4" class="txtr2" valign="top">
                                 <tr bgcolor="#EAF3FB" class="txtbr" background="images/img_list/bg_coluna2.gif">
                                   <td width="20" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">&nbsp;</td>
                                  <td width="440" height="21" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">NOME</td>
                                  <td width="85" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr"><div align="left">UNIDADE</div></td>
                                  <td width="68" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr"><div align="center">N&ordm; BOLSAS</div></td>
                                  <td width="30" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr">&nbsp;</td>
                                  <td width="30" nowrap background="images/img_list/bg_coluna2.gif" class="txtbr"><div align="center"></div></td>
                                  </tr>
								  <?
								if ($vetDados){
								
									$l = array();
									while ($l=array_shift($vetDados)){
								  ?>
								  <tr onMouseOver="this.bgColor='#E3EEFE'" onMouseOut="this.bgColor='#FFFFFF'">
									  <td  class="txtbr"><input name=<?="form_check".$cLinha?> type="checkbox" class="txtr" id=<?="form_check".$cLinha?> value="1"></td>
									  <td  class="txtr2b"><input type="hidden" name=<?="form_id".$cLinha?> value=<?=$l[id]?>><a href=<?="?pagina=ficha_pesquisador&pesqId=$l[id]"?> class="txtr2b"><?= strtoupper($l[nome])?></a></td>
									  <td  class="txtr2"><?=$l[unidade]?></td>
									  <td  class="txtr2"> <div align="center"><?=$l[numBolsaAtend]?></div></td>
									  <? if ($l[status]==0){
									 
									    echo "<td  class=\"txtr2\"><div align=\"center\"><a href=\"#\"><img src=\"images/img_list/btn_inativo.gif\" width=\"14\" height=\"14\" border=\"0\" title=\"Ativar\" onClick=\"document.form1.acao.value='ativar';document.form1.pesqId.value='".$l[id]."';document.form1.pg.value=document.form1.selectpg.value;form1.submit();\"></a></div></td>";
									  
									  }
									  else {
									   
									    echo "<td  class=\"txtr2\"><div align=\"center\"><a href=\"#\"><img src=\"images/img_list/btn_ativo.gif\" width=\"14\" height=\"14\" border=\"0\" title=\"Desativar\" onClick=\"document.form1.acao.value='desativar';document.form1.pesqId.value='".$l[id]."';document.form1.pg.value=document.form1.selectpg.value;form1.submit();\"></a></div></td>";
									  
									  }
									  
									   if ($l[statusClass]==0){
									   
									   echo "<td  class=\"txtr2\"><div align=\"center\"><a href=\"#\"><img src=\"images/discordo.gif\" alt=\"Aprovar\" width=\"16\" height=\"16\" border=\"0\" title=\"Aprovar\" onClick=\"document.form1.acao.value='aprovar';document.form1.pesqId.value='".$l[id]."';document.form1.pg.value=document.form1.selectpg.value;form1.submit();\"></a></div></td>";
									  
									  }
									  else {
									   
									   echo "<td  class=\"txtr2\"><div align=\"center\"><a href=\"#\"><img src=\"images/concordo.gif\" alt=\"Reprovar\" width=\"16\" height=\"16\" border=\"0\" title=\"Reprovar\" onClick=\"document.form1.acao.value='reprovar';document.form1.pesqId.value='".$l[id]."';document.form1.pg.value=document.form1.selectpg.value;form1.submit();\"></a></div></td>";
									  
									  }
									   ?>
									</tr>
									<tr>
                                      <td height="1" colspan="6" bgcolor="DBE7F4"></td>
                                    </tr>
									
                                    <?
									$cLinha++;
									}//fim while
								}//fim if
									?>
                                  </table></td>
                                </tr>
								<tr>
								  <td height="20" valign="middle" bgcolor="F5F6FB" class="txtbr"> Com marcados : <a href="#" class="txtbr"><img src="images/concordo.gif" width="16" height="16" border="0" title="Aprovar" onClick="document.form1.acao.value='aprovar';form1.submit();"></a> <img src="images/img_divisor_modulo.gif" width="1" height="14">
								     <a href="#" class="txtbr"><img src="images/discordo.gif" width="16" height="16" border="0" title="Reprovar" onClick="document.form1.acao.value='reprovar';form1.submit();"></a> <img src="images/img_divisor_modulo.gif" width="1" height="14">
								     <a href="#"><img src="images/img_list/btn_ativo.gif" width="14" height="14" border="0" title="Ativar" onClick="document.form1.acao.value='ativar';form1.submit();"></a> <img src="images/img_divisor_modulo.gif" width="1" height="14">
									 <a href="#"><img src="images/img_list/btn_inativo.gif" width="14" height="14" border="0" title="Desativar" onClick="document.form1.acao.value='desativar';form1.submit();"></a></td>
								</tr>
                              </table></td> 
                  			</tr>
                  			<tr class="txt2">
                   				<td height="20" colspan="7" class="txtr"><table width="100%" border="0" cellspacing="0">
                       					<tr bgcolor="#DBE7F4" class="txt2b" background="images/sub_barra_trans.gif">
                          					<td width="194" height="20" ><div align="left"><span class="txtbr">P&aacute;gina:
											
                                                    <select name="selectpg" id="selectpg" class="txtr" onChange="document.form1.pg.value=this.value;form1.submit();">
													<?
														for($i=1;$i<=$paginas;$i++) { // Gera um loop com o link para as páginas
														$aux = ($i==$pagina2 ? "selected" : "");
														echo "<option value=\"".$i."\" ".$aux.">".$i."</option>\n";}//end for
													?>
                                                    </select>
                       					    </span> </div></td>
                         					<td width="29" background="images/sub_barra_trans.gif" bgcolor="#DBE7F4" >&nbsp;</td>
                          					<td width="144" bgcolor="#DBE7F4" class="txt2b">&nbsp;</td>
                          					<td width="285" ><div align="right"><span class="txtbr">Total de registros encontrados:
                                                <?=$total?>
                                          </span></div></td>
                       					</tr>
                    				</table></td>
                  			</tr>
              			</table></td>
       		  </tr>
        	</table></td>
      </tr> </tbody>
  	</table>
	 <input type="hidden" name="pg">
	 <input type="hidden" name="acao">
	 <input type="hidden" name="pesqId">
	 <input type="hidden" name="nLinhas" value=<?=$cLinha?>>
	</form>
	</center>
	
	<?

	}// fimformadmin
		
}
?>