<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2008
    * Autores: Ivis Silva Andrade - Engenharia e Design(ivis@expandweb.com)
    *          Pedro Henrique Braga Moreira - Engenharia e Programa��o(ikkinet@gmail.com)
    *
    * Este arquivo � parte do programa Gerenciador Cl�nico Odontol�gico
    *
    * Gerenciador Cl�nico Odontol�gico � um software livre; voc� pode
    * redistribu�-lo e/ou modific�-lo dentro dos termos da Licen�a
    * P�blica Geral GNU como publicada pela Funda��o do Software Livre
    * (FSF); na vers�o 2 da Licen�a invariavelmente.
    *
    * Este programa � distribu�do na esperan�a que possa ser �til,
    * mas SEM NENHUMA GARANTIA; sem uma garantia impl�cita de ADEQUA��O
    * a qualquer MERCADO ou APLICA��O EM PARTICULAR. Veja a
    * Licen�a P�blica Geral GNU para maiores detalhes.
    *
    * Voc� recebeu uma c�pia da Licen�a P�blica Geral GNU,
    * que est� localizada na ra�z do programa no arquivo COPYING ou COPYING.TXT
    * junto com este programa. Se n�o, visite o endere�o para maiores informa��es:
    * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html (Ingl�s)
    * http://www.magnux.org/doc/GPL-pt_BR.txt (Portugu�s - Brasil)
    *
    * Em caso de d�vidas quanto ao software ou quanto � licen�a, visite o
    * endere�o eletr�nico ou envie-nos um e-mail:
    *
    * http://www.smileprev.com/gco
    * smileprev@smileprev.com
    *
    * Ou envie sua carta para o endere�o:
    *
    * SmilePrev Cl�nicas Odontol�gicas
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    * Ou nos contate pelo telefone:
    *
    * Tel.: 0800-285-8787
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
		die($frase_log);
	}
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `cheques_dent` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
?>
<div id='calendario' name='calendario' style='display:none;position:absolute;'>
<?
	include "../lib/calendario.inc.php";
?>
</div>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="46%">&nbsp;&nbsp;&nbsp;<img src="cheques_dent/img/cheques.png" alt="Controle de Cheques"> <span class="h3">Controle de Cheques</span></td>
      <td width="27%" valign="bottom">
        <table width="100%" border="0">
      	  <tr>
      	    <td>
      	      Pesquisar por<br>
      	      <select name="campo" id="campo" class="forms">
      	        <option value="nometitular">Titular do cheque</option>
      	        <option value="recebidode">Recebido de</option>
      	        <option value="encaminhadopara">Encaminhado para</option>
      	        <option value="compensacao">Data de compensa��o</option>
      	      </select>
      	    </td>
      	    <td>
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('cheques_dent/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)" onKeypress="if(document.getElementById('campo').selectedIndex==3) {return Ajusta_Data(this, event);}"
                onclick="if(document.getElementById('campo').selectedIndex==3) {abreCalendario(this);}">
      	    </td>
      	  </tr>
      	</table>
      </td>
      <td width="23%" align="right" valign="bottom"><img src="../imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax('cheques_dent/incluir', 'conteudo', 'cpf_dentista=<?=$_SESSION[cpf]?>')">Incluir novo cheque </a></td>
      <td width="2%" valign="bottom">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td colspan="6" bgcolor="#009BE6">&nbsp;</td>
    </tr>
    <tr>
      <td width="164" height="23" align="left">Titular do cheque</td>
      <td width="164" height="23" align="left">Recebido de</td>
      <td width="164" height="23" align="left">Encaminhado para</td>
      <td width="80" align="center">Valor</td>
      <td width="66" align="center">Editar</td>
      <td width="66" align="center">Excluir</td>
    </tr>
  </table>  
  <div id="pesquisa"></div>
  <script>
  Ajax('cheques_dent/pesquisa', 'pesquisa', 'cpf_dentista=<?=$_SESSION[cpf]?>&pesquisa=&campo=nometitular');
  </script>
</div>
