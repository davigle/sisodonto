<?
   /**
    * Gerenciador Clínico Odontológico
    * Copyright (C) 2006 - 2008
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
    * http://www.smileprev.com/gco
    * smileprev@smileprev.com
    *
    * Ou envie sua carta para o endereço:
    *
    * SmilePrev Clínicas Odontológicas
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
		die('Você precisa estar logado para acessar esta área');
	}
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `patrimonio` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
	if(checknivel('Dentista') || checknivel('Funcionario')) {
		die($frase_adm);
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="46%">&nbsp;&nbsp;&nbsp;<img src="patrimonio/img/patrimonio.png" alt="Patrim&ocirc;nio"> <span class="h3">PATRIM&Ocirc;NIO</span></td>
      <td width="27%" valign="bottom">
Pesquisar 
  <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('patrimonio/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value)">
</td>
      <td width="23%" align="right" valign="bottom"><img src="imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax('patrimonio/incluir', 'conteudo', '')">Incluir novo patrim&ocirc;nio </a></td>
      <td width="2%" valign="bottom">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr bgcolor="#009BE6">
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td width="50" height="23" align="left">C&oacute;digo</td>
      <td width="338" align="left">Descri&ccedil;&atilde;o do Patrim&ocirc;nio </td>
      <td width="130" align="left">Setor</td>
      <td width="107" align="center">Valor</td>
      <td width="59" align="center">Editar/Ver</td>
      <td width="66" align="center">Excluir</td>
    </tr>
  </table>  
  <div id="pesquisa"></div>
  <script>
  Ajax('patrimonio/pesquisa', 'pesquisa', 'pesquisa=');
  </script>
</div>
