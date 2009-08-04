<?
   /**
    * Gerenciador Clínico Odontológico
    * Copyright (C) 2006 - 2009
    * Autores: Ivis Silva Andrade - Engenharia e Design(ivis@expandweb.com)
    *          Pedro Henrique Braga Moreira - Engenharia e Programação(ikkinet@gmail.com)
    *
    * Este arquivo é parte do programa Gerenciador Clínico Odontológico
    *
    * Gerenciador Clínico Odontológico é um software livre; você pode
    * redistribuí-lo e/ou modificá-lo dentro dos termos da Licença
    * Pública Geral GNU como publicada pela Fundação do Software Livre
    * (FSF); na versão 2 da Licença invariavelmente.
    *
    * Este programa é distribuído na esperança que possa ser útil,
    * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÂO
    * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
    * Licença Pública Geral GNU para maiores detalhes.
    *
    * Você recebeu uma cópia da Licença Pública Geral GNU,
    * que está localizada na raíz do programa no arquivo COPYING ou COPYING.TXT
    * junto com este programa. Se não, visite o endereço para maiores informações:
    * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html (Inglês)
    * http://www.magnux.org/doc/GPL-pt_BR.txt (Português - Brasil)
    *
    * Em caso de dúvidas quanto ao software ou quanto à licença, visite o
    * endereço eletrônico ou envie-nos um e-mail:
    *
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endereço:
    *
    * Smile Odontolóogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `funcionarios` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
		@unlink('fotos/'.$_GET[codigo].'.jpg');
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="48%">&nbsp;&nbsp;&nbsp;<img src="funcionarios/img/funcionario.png" alt="<?=$LANG['employee']['manage_employee']?>" width="21" height="30"> <span class="h3"><?=$LANG['employee']['manage_employee']?> </span></td>
      <td width="21%" valign="bottom">
        <table width="100%" border="0">
      	  <tr>
      	    <td>
      	      <?=$LANG['employee']['search_for']?><br>
      	      <select name="campo" id="campo" class="forms">
      	        <option value="nome"><?=$LANG['employee']['name']?></option>
      	        <option value="nascimento"><?=$LANG['employee']['birthdate']?></option>
      	        <option value="cpf"><?=$LANG['employee']['document1']?></option>
      	      </select>
      	    </td>
      	    <td>
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('funcionarios/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	    </td>
      	  </tr>
      	</table>
      </td>
      <td width="27%" align="right" valign="bottom"><img src="imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax('funcionarios/incluir', 'conteudo', '')"><?=$LANG['employee']['include_new_employee']?> </a></td>
      <td width="2%" valign="bottom">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td colspan="5" bgcolor="#009BE6">&nbsp;</td>
    </tr>
    <tr>
      <td width="325" height="23" align="left"><?=$LANG['employee']['employee']?></td>
      <td width="150" align="left"><?=$LANG['employee']['telephone']?></td>
      <td width="150" align="left"><?=$LANG['employee']['main_function']?></td>
      <td width="59" align="center"><?=$LANG['employee']['edit_view']?></td>
      <td width="66" align="center"><?=$LANG['employee']['delete']?></td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('funcionarios/pesquisa', 'pesquisa', 'pesquisa=');
  </script>
</div>
