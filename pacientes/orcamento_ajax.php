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
	$strUpCase = "ALTERA��O";
    $strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$acao = '&acao=editar';
?>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td>&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Dentistas"> <span class="h3">GERENCIAR PACIENTES &nbsp;[<?=$strLoCase?>] </span></td>
    </tr>
</table>
<div class="conteudo" id="table dados">
<br />
<?include('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;OR&Ccedil;AMENTO DO PACIENTE </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;">
        <div align="center"><br /><a href="javascript:Ajax('pacientes/orcamentofechar', 'conteudo', 'codigo=<?=$_GET[codigo].$acao?>')">
          + Incluir Novo Or&ccedil;amento</a><br />
          <br />
        </div>
        <fieldset>
      <table width="588" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
        <tr>
          <td bgcolor="#009BE6" colspan="8">&nbsp;</td>
        </tr>
        <tr>
          <td width="15%" height="23" align="left">OR&Ccedil;AMENTO</td>
          <td width="34%" align="left">PROFISSIONAL</td>
          <td width="13%" align="left">DATA</td>
          <td width="14%" align="center">VALOR</td>
          <td width="11%" align="center">Editar</td>
          <td width="14%" align="center">Confirmado</td>
        </tr>
      </table>
      <table width="588" border="0" align="center" cellpadding="0" cellspacing="0">
<?
    limpa_orcamentos();
	$i = 0;
	$query = mysql_query("SELECT * FROM `orcamento` WHERE `codigo_paciente` = '$_GET[codigo]' ORDER BY `codigo` ASC");
	while($row = mysql_fetch_array($query)) {
		if($i%2 === 0) {
			$td_class = 'td_even';
		} else {
			$td_class = 'td_odd';
		}
		$dentista = new TDentistas();
		$lista = $dentista->LoadDentista($row[cpf_dentista]);
		$nome = explode(' ', $dentista->RetornaDados('nome'));
		$nome = $nome[0].' '.$nome[count($nome) - 1];
?>
      <tr class="<?=$td_class?>">
          <td width="15%">Or�amento <?=$i+1?></td>
          <td width="34%"><?=$dentista->RetornaDados('titulo').' '.$nome;?></td>
          <td width="13%"><?=converte_data($row[data], 2)?></td>
          <td width="14%" align="right">R$ <?=money_form($row[valortotal]-($row[valortotal]*($row[desconto]/100)))?></td>
          <td width="11%"><div align="center"><a href="javascript:Ajax('pacientes/orcamentofechar', 'conteudo', 'codigo=<?=$_GET[codigo]?>&indice_orc=<?=($i+1)?>&acao=editar&subacao=editar&codigo_orc=<?=$row[codigo]?>')"><img src="imagens/icones/editar.gif" border="0" alt="Editar" width="16" height="18" /></div></td>
          <td width="14%"><div align="center"><?=(($row['confirmado'] == 'N�o')?'':'<img src="imagens/icones/ok.gif" border="0" alt="Confirmado" width="19" height="19" />')?></div></td>
        </tr>
<?
		$i++;
	}
?>
      </table>
      </fieldset>
        <br />
        <div align="center"></div>
      </form>      </td>
    </tr>
</table>
