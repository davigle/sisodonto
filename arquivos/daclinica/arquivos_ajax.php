<?
/**
 * Gerenciador Cl�nico Odontol�gico
 * Copyright (C) 2006  
 * Autores: Ivis Silva Andrade (ivis@expandweb.com)
 *          Pedro Henrique Braga Moreira (ikkinet@gmail.com)
 *
 * Este arquivo � parte do programa Gerenciador Cl�nico Odontol�gico
 * 
 * Gerenciador Cl�nico Odontol�gico � um software livre; voc� pode 
 * redistribu�-lo e/ou modific�-lo dentro dos termos da Licen�a  
 * P�blica Geral GNU como publicada pela Funda��o do Software Livre  
 * (FSF); na vers�o 2 da Licen�a ou suas pr�ximas vers�es.
 * 
 * Este programa � distribu�do na esperan�a que possa ser �til, 
 * mas SEM NENHUMA GARANTIA; sem uma garantia impl�cita de ADEQUA��O 
 * a qualquer MERCADO ou APLICA��O EM PARTICULAR. Veja a
 * Licen�a P�blica Geral GNU para maiores detalhes.
 * 
 * Voc� recebeu uma c�pia da Licen�a P�blica Geral GNU,
 * que est� localizada na ra�z do programa no arquivo
 * COPYING ou COPYING.TXT
 * junto com este programa, se n�o, escreva para:
 *
 * Funda��o do Software Livre(FSF) Inc.
 * 51 Franklin St, Fifth Floor
 * Boston - MA - 02110-1301
 * USA
 *
 */
	include "../../lib/config.inc.php";
	include "../../lib/func.inc.php";
	include "../../lib/classes.inc.php";
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
		die($frase_log);
	}
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `arquivos` WHERE `nome` = '".$_GET[codigo]."'") or die(mysql_error());
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="35%">&nbsp;&nbsp;&nbsp;<img src="arquivos/img/arquivos.png" alt="Arquivos da Cl�nica"> <span class="h3">Arquivos da Cl�nica </span></td>
      <td width="63%" colspan="2" valign="bottom" align="center"></td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table><br />
  <form id="form2" name="form2" method="POST" action="arquivos/daclinica/incluir_ajax.php" enctype="multipart/form-data" target="iframe_upload"> <?/*onsubmit="Ajax('arquivos/daclinica/arquivos', 'conteudo', '');">*/?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="4%">
      </td>
      <td width="37%">Arquivo <br />
        <input type="file" size="20" name="arquivo" id="arquivo" class="forms" onchange="getElementById('filename').value=this.value">
        <input type="hidden" value="" name="filename" id="filename">
      </td>
      <td width="43%">Descri��o <br />
        <input type="text" size="50" name="descricao" id="descricao" class="forms">
      </td>
      <td width="10%"> <br />
        <input type="submit" name="Salvar" id="Salvar" value="Salvar" class="forms">
      </td>
      <td width="3%">
      </td>
    </tr>
  </table>
  </form>
  <iframe name="iframe_upload" width="1" height="1" frameborder="0" scrolling="No"></iframe>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td width="52%" height="23" align="left">Arquivo</td>
      <td width="11%" align="center">Tipo</td>
      <td width="13%" align="center">Tamanho</td>
      <td width="13%" align="center">Visualizar</td>
      <td width="11%" align="center">Apagar</td>
    </tr>
  </table>  
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?
	$query = mysql_query("SELECT * FROM `arquivos` ORDER BY `descricao` ASC");
	$i = 0;
	$par = "F0F0F0";
	$impar = "F8F8F8";
	while($row = mysql_fetch_array($query)) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="52%" height="23" align="left"><?=$row[descricao]?></td>
      <td width="11%" align="center"><?=pega_tipo($row[nome])?></td>
      <td width="13%" align="center"><?=format_size($row[tamanho])?></td>
      <td width="13%" align="center"><a href="arquivos/daclinica/files/<?=$row[nome]?>" target="_blank"><img src="imagens/icones/visualizar.gif" alt="Ver arquivo" width="16" height="20" border="0" /></a></td>
      <td width="11%" align="center"><a href="javascript:Ajax('arquivos/daclinica/arquivos', 'conteudo', 'codigo=<?=$row[nome]?>" onclick="return confirmLink(this)"><img src="../imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a></td>
    </tr>
<?
		$i++;
	}
?>
  </table>
  <div id="pesquisa"></div>
</div>
