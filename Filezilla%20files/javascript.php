<?php
class javascript{
   /**
    * javascript::mensagem()
    * 
    * @param $msg
    * @return 
    */
   function mensagem($msg){
   	echo "<script language=\"JavaScript\"><!--\n";
    echo "alert('$msg');\n";
    echo '--></script>'; 
   }
     /**
	 * javascript::openwindow()
	 * 
	 * @param $pagina
	 * @param $nomejanela
	 * @param $dimensao
	 * @return 
	 */
	function openwindow($pagina,$nomejanela,$dimensao){
		echo "<script language=JavaScript>";
    	echo "window.open('$pagina','$nomejanela','$dimensao');\n";
    	echo "</script>";
	}
	/**
	 * javascript::setstatus()
	 * 
	 * @param $msg
	 * @return 
	 */
	function setstatus($msg){
	echo "\n onMouseOver = \"status='$msg';";
	echo "return document.MM_returnValue = 'true';\" \n";
	}
	
	/**
	 * javascript::redireciona()
	 * 
	 * @param $pagina
	 * @param $target
	 * @param $msg
	 * @param $tam_fonte
	 * @param $cor_fonte
	 * @return 
	 */
	function redireciona($pagina,$target,$msg,$tam_fonte,$cor_fonte){
	echo "<a href=\"$pagina \" target=\"$target\" ><font color=\"$cor_fonte\" size=\"$tam_fonte\"><b>$msg</b></font></a>";
	}
	
	function redireciona2($pagina){
	echo "onclick=\"window.location='$pagina';\"";
	}
	
	function redireciona3($pagina){
	echo "<script language=JavaScript>";
    echo "window.location.href= '$pagina';\n";
    echo "</script>";
	}
	
	
	function submit(){
	echo "onclick=\"this.form.submit();\"\n";
	}
	
	function voltar(){
	echo "onclick=\"window.history.go(-1);\"\n";
	}
	
	function voltar2(){
	echo "<script language=JavaScript>";
	echo "window.history.go(-1);\n";
	echo "</script>";
	}
	
	function button_voltar(){
	echo "<div align=\"center\">
            <input type=\"button\" name=\"Submit\" value=\"Voltar\" onclick=\"window.history.go(-1);\"\n>
          </div>";
	}
	/**
	 * javascript::hint_dhtml_implement()
	 * 
	 * @param $ident
	 * @param $pagina
	 * @param $tam
	 * @param $texto1
	 * @param $texto2
	 * @param $cor1
	 * @param $cor2
	 * @param $border
	 * @param $cellspacing
	 * @return 
	 */
	function hint_dhtml_implement($ident,$pagina,$tam,$texto1,$texto2,$cor1,$cor2,$border,$cellspacing){
	 //position:absolute
	 // echo "\n.fl {position:center; left:264; top:275; width:200; height:50; z-index:1; visibility: hidden}\n";
	 echo "\n<style>";
     echo "\n.fl {position:center; z-index:1; visibility: hidden}\n";
     echo "\n.xs{font-size:xx-small}\n";
     echo "</style>\n";
	 
	 echo "<script language=\"JavaScript\">\n";
	 echo "function eIn(o) {if (document.all && document.all[o]!=null) document.all[o].style.visibility='visible';\n}\n";
     echo "function eOut(o) {if (document.all && document.all[o]!=null) document.all[o].style.visibility='hidden';\n}\n";
	 echo "</script>\n";
	 $id = "x" . $ident;
     $id2 = "y" . $ident;
	 if ($pagina!=''){
	 $script="<td valign=\"middle\" width=\"0%\" bgcolor=$cor1 ><a href=\"$pagina\" onMouseOver=\"eIn('$id');\" onMouseOut=\"eOut('$id');\">$texto1</a>\n";}
	 else{
	 $script="<td valign=\"middle\" width=\"0%\" bgcolor=$cor1 ><a  style='CURSOR: hand;' onMouseOver=\"eIn('$id');\" onMouseOut=\"eOut('$id');\">$texto1</a>\n";}
     $script=$script."<div id=\"$id\" class=\"fl\"><table width=$tam border=\"$border\" cellspacing=\"$cellspacing\" class=\"opacity\" bgcolor=$cor2 cellspacing=\"$cellspacing\" border=$border ><tr><td border=\"$border\" bgcolor=\"$cor1\" class=\"txtw\" style=\"PADDING:0px\">\n";
     $script=$script."$texto2\n";//border="0" cellspacing="1" class="opacity" bgcolor="#316CA8"
     $script=$script."</td></table></div></td>\n";
	return $script;
	}
	function alert($text){
	echo "<script language=JavaScript>";
    echo "alert(\"$text\");\n";
    echo "window.location.href= '\index.php';\n";
    echo "</script>";
	}
	
	function confirmacao(){
	echo "<script language=\"JavaScript\">
	<!--
	function confirmsg(theLink,msg) { //v1.0
   		if (msg == '' || typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(msg);
    if (is_confirmed) {
        theLink.href += '&is_js_confirmed=1';
    }

    return is_confirmed;

	}
	//-->
	</script>";

	}
	function getConfirmacao($theLink,$msg){
	
	echo "onClick=\"return confirmsg('$theLink','$msg')\"";
	}
	
	
	function confirmacao2(){
	echo "<script language=\"JavaScript\">
	<!--
	function confirmsg(theLink,msg) { //v1.0
   		if (msg == '' || typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(msg);
	 if (!is_confirmed) {
		window.history.go(-1);  
    }
	}
	//-->
	</script>";

	}
	function getConfirmacao2($theLink,$msg){
	echo "<script language=\"JavaScript\">";
	echo "confirmsg('$theLink','$msg');";
	echo "</script>";
	}
	
	

	
	
	
	
	
	
	
}
?>