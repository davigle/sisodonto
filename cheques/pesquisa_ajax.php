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
		die($frase_log);
	}
?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?
	$cheque = new TCheques();
	if($_GET[campo] == 'nometitular') {
		$where = "`nometitular` LIKE '%".$_GET['pesquisa']."%'";
	} elseif($_GET[campo] == 'recebidode') {
		$where = "`recebidode` LIKE '%".$_GET['pesquisa']."%'";
	}elseif($_GET[campo] == 'encaminhadopara') {
		$where = "`encaminhadopara` LIKE '%".$_GET['pesquisa']."%'";
	}elseif($_GET[campo] == 'compensacao') {
		$where = "`compensacao` = '".converte_data($_GET['pesquisa'], 1)."'";
	}
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}	
	$sql = "SELECT * FROM `cheques` WHERE $where ORDER BY `$_GET[campo]` ASC";
	$lista = $cheque->ListCheque($sql.' LIMIT '.$limit.', '.PG_MAX);
	$total_regs = $cheque->ListCheque($sql);
	$par = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
		$cheque->LoadCheque($lista[$i][codigo]);
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="164" height="23" align="left""><?=$cheque->RetornaDados('nometitular')?></td>
      <td width="164" height="23" align="left"><?=$cheque->RetornaDados('recebidode')?></td>
      <td width="164" height="23" align="left"><?=$cheque->RetornaDados('encaminhadopara')?></td>
      <td width="80" height="23" align="right">R$ <?=money_form($cheque->RetornaDados('valor'))?></td>
      <td width="66" align="center"><a href="javascript:Ajax('cheques/incluir', 'conteudo', 'codigo=<?=$cheque->RetornaDados('codigo')?>&acao=editar')"><img src="../imagens/icones/editar.gif" alt="Editar" width="16" height="18" border="0"></a></td>
      <td width="66" align="center"><a href="javascript:Ajax('cheques/gerenciar', 'conteudo', 'codigo=<?=$cheque->RetornaDados('codigo')?>" onclick="return confirmLink(this)"><img src="../imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a></td>
    </tr>
<?
	}
?>
  </table>
  <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="100%" align="center">
<?
	$pg_total = ceil(count($total_regs)/PG_MAX);
	$i = $_GET[pg] - 5;
	if($i <= 1) {
		$i = 1;
		$reti = '';
	} else {
		$reti = '...&nbsp;&nbsp;';
	}
	$j = $_GET[pg] + 5;
	if($j >= $pg_total) {
		$j = $pg_total;
		$retf = '';
	} else {
		$retf = '...';
	}
	echo $reti;
	while($i <= $j) {
		if($i == $_GET[pg]) {
			echo $i.'&nbsp;&nbsp;';
		} else {
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'cheques/pesquisa\', \'pesquisa\', \'pesquisa=\'%2BgetElementById(\'procurar\').value%2B\'&campo=\'%2BgetElementById(\'campo\').options[getElementById(\'campo\').selectedIndex].value%2B\'&pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
    </tr>
  </table>
