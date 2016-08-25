<?php
require_once(dirname(__FILE__).'/../classes/class_conexao_bd.php');
require_once(dirname(__FILE__).'/../fachada.php');
//cor da tabela
$bgcolor1 = "#E4E5E4";//cor do fundo das tabelas secundarias
$bgcolor2 = "#cccccc";//cor das bordas das tabelas
$bgcolor3 = "#E4E5E4";//cor do fundo da tabela principal
$bgcolor4 = "#E4E5E4";//cor de fundo da pagina principal
//--
$lnkcolor = "#000000"; //cor do link


function OpenTable() {
	require_once('config.php');
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\""._BGCOLOR2."\"><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\""._BGCOLOR1."\"><tr><td>\n";
}

function CloseTable() {
    echo "</td></tr></table></td></tr></table>\n";
}

function OpenTable2() {
    require_once('config.php');
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\""._BGCOLOR2."\" align=\"center\"><tr><td>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\""._BGCOLOR1."\"><tr><td>\n";
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

/************************************************************/
/* Função themeheader()                                   */
/************************************************************/

function themeheader($tipo=null,$id=null) {
    require_once('lang/lang.globals.php');
	require_once("config.php");
	$tpEdital = ($_SESSION['sEdital']==2)?" - INTERIOR":"";
	?>
	<html>
	<head>
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">	
    <title>PIBIC</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<?
	include_once(dirname(__FILE__)."/style.php");
	include_once(dirname(__FILE__)."/style2.php");
	?>
	<script language="JavaScript" src="javascript/FormContext.js"></script>
	<script language="JavaScript" src="javascript/drop_down.js"></script>
	<script language="JavaScript" src="javascript/ajax.js"></script>
	<script language="JavaScript" src="javascript/ajax2.js"></script>
	</head>
	<body >
	<center>
		<div class="wrapper">
			<div id="header">
				<div id="header1" ></div>
				<div id="header2">Programa Integrado de Bolsas de Inicia&ccedil;&atilde;o Cient&iacute;fica<i><?=$tpEdital?></i></div>
				<?
					thememenu($tipo,$id);
				?>
			</div>
			<?
			if($tipo=="Login"){
				require_once(dirname(__FILE__).'/../menu.php');
				$oMenu = new menu;
				?>
				 <div class="outer">
     			   <div class="inner">
             			<div class="left">
							<? $oMenu->esquerdaportal(); ?>
						</div>
							<div class="center" id="divcentral"><?
			}
			else {
				?><div id="semcoluna"><?
			}

    require_once("main.php");
	$oMain = new main();
	$oMain->setAutenticado($_SESSION['sAutenticado']);
	$oMain->setLogin($_SESSION['sLogin']);
	$oMain->setPerfil($_SESSION['sPerfil']);
}

function thememenu($tipo=null,$id=null) {
	require_once('lang/lang.globals.php');
	require_once("config.php");
	$oFachada = new fachada();
	if ($tipo=="Login"){
		 $vetPerfil=$oFachada->getPerfis();
		?>
		 <div class="header3">
	 		<div class="parte1">
				<p valign="bottom" id="link">
					<a href="?pagina=fale_conosco" class="link"><img src="images/icon_carta.gif" border="0" width="16" height="16" align="absmiddle">&nbsp;FALE CONOSCO</a>&nbsp;|
					<a href="?pagina=recupera_senha" class="link"><img src="images/icon_security.gif" border="0" width="12" height="12" align="absmiddle">&nbsp;RECUPERE SUA SENHA</a>
 	    		</p>
			</div>
			<div class="parte2" align="right">
		  		<table width="100%"  border="0" cellspacing="0" cellpadding="0" >
                	<form name="form_logar" method="post" action="logar.php" >
						<tr>
                    		<td height="27" align="right">
								<p align="right">
								Login:
				                <input type="text" name="login" class="inputtext" value="" size="15" maxlength="20">
 								Perfil:
 								<select name="perfil" class="txtr">
								<?
								 if ($vetPerfil){
		  							while($l=array_shift($vetPerfil)){
										$aux = $l->getCod()==5?"selected":"" ;
										echo "<option value=\"".$l->getCod()."\" $aux>".$l->getDesc()."</option>\n";
								 	}//fim while
								}
								?>
      				  			</select>
								Senha:
								<input type="password" name="senha" class="inputtext" value="" size="10" maxlength="6">
								<input name="form_button" type="submit" class="button" value="OK" >
								<input type="hidden" name="logar" value="true">
  			                	</p>
							</td>
						</tr>
					</form>
          		</table>
			</div>
  		</div> 
				
		<?
	}
	elseif($tipo=="pesquisador"){
		echo"<div class=\"thememenu\" id=\"menubar\"> 
			<ul id=\"nav\">";
		
		$ano=$_SESSION['sAno'];
		if ($_SESSION['sPerfil']!="Pesquisador"){
			$pesqId=$id;
			echo"
				<li><a href=\"index.php\"><img src=\""._IMGHOME."\"  height=\"14\" border=\"0\"></a></li>
				<li ><a href=\"?pagina=pesquisador\"><img src=\""._IMGPESQS."\"  height=\"14\" border=\"0\"></a></li>
				";
			$oSelecao   = true ;
		}
		else {
			$pesqId=$_SESSION['sId'];
			$oInscricao   = $oFachada->getInscricaoAberta();
			$oSelecao     = false;
			$oPesquisador = $oFachada->getPesquisadorId($pesqId);
			if($oInscricao){
				$oSelecao = $oFachada->getSelecaoPorPesqAnoTp($pesqId,$oInscricao->getTpSelecao());
			}
			else{
				$vetPeriodo     = $oFachada->getPeriodoAberto('2');
				if($vetPeriodo){
					$oPeriodo   = array_shift($vetPeriodo);
					$tpSelecao  = $oPeriodo->getTpSelecao();				
					$oSelecao   = $oFachada->getSelecaoPorPesqAnoTp($pesqId,$tpSelecao);
				}
			}
			echo "
				<li><a href=\"?pagina=muda_senha&usrId=$pesqId\"><img src=\""._IMGSENHA."\"  height=\"14\" border=\"0\"></a></li>";
			if ($oInscricao and $oSelecao==false ){
				//Recolocar assim que aparecer um período de inscrição
			//	echo "<li><a href=\"?pagina=selecao&pesqId=$pesqId\"><img src=images/btn_Inscricao.gif height=\"14\" border=\"0\"></a></li>";
			}
		}
		echo"
	 			<li><a href=\"#\"><img src=\""._IMGPESQ."\"  height=\"14\" border=\"0\"></a>
					<ul>
						<li><a href=\"?pagina=ficha_pesquisador&pesqId=$pesqId\"><img src=\""._IMGFICHA."\"  height=\"14\" border=\"0\"></a></li>
						<li><a href=\"?pagina=planilha&pesqId=$pesqId\"><img src=\""._IMGPLANILHA."\"  height=\"14\" border=\"0\"></a></li>
						<li><a href=\"?pagina=curriculo&pesqId=$pesqId\"><img src=\""._IMGCURRICULO."\"  height=\"14\" border=\"0\"></a></li>";
						if ( $_SESSION['sAno']>2004){
						echo"
						<li><a href=\"?pagina=plano&pesqId=$pesqId\"><img src=\""._IMGPLANO."\"  border=\"0\"></a></li>";
						}
						?><!--<li><a href="#" onclick="window.location='comprovanteBolsistaPdf.php/?pesqId=<?//=$pesqId;?>'"><img src="images/btn_Declaracao.gif" border="0"></a></li>--><?
		echo "     </ul>

				</li>
				<li><a href=\"?pagina=bolsista&pesqId=$pesqId\"><img src=\""._IMGBOLSISTA."\"  height=\"14\" border=\"0\"></a></li>
				<li><a href=\"?pagina=comprovante&pesqId=$pesqId\"><img src=\""._IMGCOMPROVANTE."\"  height=\"14\" border=\"0\"></a></li>
				
				<li><a href=\"?pagina=termo_bolsa&pesqId=$pesqId\"><img src=\""._IMGTERMO."\"  height=\"12\" border=\"0\"></a></li>
				<li><a href=\"?pagina=logoff\"><img src=\""._IMGSAIR."\"  height=\"14\" border=\"0\"></a></li>
			</ul>
		</div>";
	}
	//<li><a href=\"?pagina=certificado&pesqId=$pesqId\"><img src=\""._IMGCERTIFICADO."\"  height=\"12\" border=\"0\"></a></li>
	else{
		$usrId=$_SESSION['sId'];
	?>
		<div class="thememenu" id="menubar"> 
			<ul id="nav">
    			<li><a href="index.php"><img src="<?=_IMGHOME?>"  height="14" border="0"></a></li>
				<?
				if($tipo=="dpq"){
					echo"
	 				<li><a href=\"#\"><img src=\"images/btn_Portal.gif\"  border=\"0\"></a>
						<ul>
							<li><a href=\"?pagina=calendario\">Calendário</a></li>
							<li><a href=\"?pagina=docportal&tipo=1\">Documentos e Modelos</a></li>
							<li><a href=\"?pagina=edital\">Editais</a></li>
							<li><a href=\"?pagina=docportal&tipo=2\">Estatísticas</a></li>
							<li><a href=\"?pagina=noticia\">Noticias</a></li>
						</ul>
					</li>";
				}
				if($tipo=="listabolsistas"){
					echo"<li><a href=\"?pagina=listabolsistas\"><img src=\""._IMGBOLSISTA."\"  height=\"14\" border=\"0\">Bolsistas</a></li>";
				}
				?>
				<li><a href="?pagina=muda_senha&usrId=<?=$usrId?>"><img src="<?=_IMGSENHA?>"  height="14" border="0"></a></li>
    			<li ><a href="?pagina=logoff"><img src="<?=_IMGSAIR?>"  height="14" border="0"></a></li>
    		</ul>
		</div>
	<?
	}
	?>
			
	<?
}//fim
	



/************************************************************/
/* Função themefooter()                                     */
/*                                                          */
/************************************************************/

function themefooter($tipo=null) {
    //global $sAutenticado; //variavel de sessão
	require_once('lang/lang.globals.php');
	require_once("config.php");
	//fecha a div do centro
	?>
		 </div> 	
	<?
	if($tipo=="Login"){
		require_once(dirname(__FILE__).'/../menu.php');
		$oMenu = new menu;
	?>			 
				  <div class="right">
				  	<? $oMenu->direitaportal(); ?>
				  </div>
				   <div class="clear"></div> 
        		</div>
    		</div>
				  
	<?
	}
	?>				
			<div class="footer"><p>Pró-reitoria de Pesquisa e Pós-Graduação - PROPESP</p></div> 
		</div>
		</center>
	</body>
	</html>
	<?
	/*
    require_once("main.php");
	$oMain = new main();
	$oMain->setAutenticado($sAutenticado);*/
}
function themesidebox($title, $conteudo) {
    require_once("config.php");
	
	echo
	 "<table border=\"0\" align=\"center\" width=\"138\" cellpadding=\"0\" cellspacing=\"0\">"
	."<tr><td background=\"images/"._IMGMENU."\" width=\"138\" height=\"20\">"
	."&nbsp;<font color=\"#000000\"><b>$title</b></font>"
	."</td></tr><tr><td><img src=\"images/pixel.png\" width=\"100%\" height=\"3\"></td></tr></table>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"138\">\n"
	."<tr><td width=\"138\" bgcolor=\""._BGCOLOR2."\">\n"
	."<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"138\">\n"
	."<tr><td width=\"138\" bgcolor=\""._BGCOLOR1."\">\n"
	."$conteudo"
	."</td></tr></table></td></tr></table><br>";
}
function title($text) {
    OpenTable();
    echo "<center><font class=\"title\"><b>$text</b></font></center>";
    CloseTable();
    echo "<br>";
}
?>