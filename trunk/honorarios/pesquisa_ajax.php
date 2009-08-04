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
		die($frase_log);
	}
    $disabled = 'disabled';
	if(checknivel('Administrador')) {
        $disabled = '';
        $href = 'href';
        $onclick = 'onclick';
	}
?>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<?	
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX_MEN;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
    switch($_GET['campo']) {
        case 'area' : $sql = "SELECT * FROM `honorarios` WHERE LEFT(`codigo`, 2) = '".$_GET['pesquisa']."' ORDER BY `codigo` ASC";
            break;
        case 'codigo' : $sql = "SELECT * FROM `honorarios` WHERE `".$_GET['campo']."` = '".$_GET['pesquisa']."' ORDER BY `codigo` ASC";
            break;
        default : $sql = "SELECT * FROM `honorarios` WHERE `".$_GET['campo']."` LIKE '%".$_GET['pesquisa']."%' ORDER BY `codigo` ASC";
            break;
    }

	$conta = new THonorarios('clinica');
	$lista = $conta->Consulta($sql.' LIMIT '.$limit.', '.PG_MAX_MEN);
	$total_regs = $conta->Consulta($sql);
	$par = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
		$conta->LoadInfo($lista[$i]['codigo']);
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="7%" align="left"><?=$conta->RetornaDados('codigo')?></td>
      <td width="50%" align="center"><input type="text" <?=$disabled?> class="forms" size="70" name="procedimento" id="procedimento" value="<?=$conta->RetornaDados('procedimento')?>" onblur="Ajax('honorarios/atualiza', 'conta_atualiza', 'codigo=<?=$conta->RetornaDados('codigo')?>&procedimento='%2Bthis.value)"></td>
      <td width="9%" align="center"><input type="text" <?=$disabled?> class="forms" size="8" name="valor_particular" id="valor_particular" value="<?=number_format($conta->RetornaDados('valor_particular'), 2, '.', '')?>" onblur="Ajax('honorarios/atualiza', 'conta_atualiza', 'codigo=<?=$conta->RetornaDados('codigo')?>&valor_particular='%2Bthis.value)" onKeypress="return Ajusta_Valor(this, event);"></td>
      <td width="9%" align="center"><input type="text" <?=$disabled?> class="forms" size="8" name="valor_convenio" id="valor_convenio" value="<?=number_format($conta->RetornaDados('valor_convenio'), 2, '.', '')?>" onblur="Ajax('honorarios/atualiza', 'conta_atualiza', 'codigo=<?=$conta->RetornaDados('codigo')?>&valor_convenio='%2Bthis.value)" onKeypress="return Ajusta_Valor(this, event);"></td>
      <td width="9%" align="right"> <?=$LANG['general']['currency'].' '.@number_format($conta->RetornaDados('valor_particular')-$conta->RetornaDados('valor_convenio'), 2, ',', '.')?></td>
      <td width="9%" align="right"><?=@number_format(round(100-($conta->RetornaDados('valor_convenio')/$conta->RetornaDados('valor_particular')*100), 2), 2, ',', '.')?> %</td>
      <td width="7%" align="center"><a <?=$href?>="javascript:Ajax('honorarios/honorarios', 'conteudo', 'codigo=<?=$conta->RetornaDados('codigo')?>" <?=$onclick?>="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a></td>
    </tr>
<?
	}
?>
  </table>
  <br>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="25%">
      <?=$LANG['fee_table']['total_procedures']?>: <b><?=count($total_regs)?></b>
      </td>
      <td width="56%" align="center">
<?
	$pg_total = ceil(count($total_regs)/PG_MAX_MEN);
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
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'honorarios/pesquisa\', \'pesquisa\', \'pesquisa=\'%2Bdocument.getElementById(document.getElementById(\'id_procurar\').value).value%2B\'&campo=\'%2BgetElementById(\'campo\').options[getElementById(\'campo\').selectedIndex].value%2B\'&pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="19%" align="right"><img src="imagens/icones/imprimir.gif" border="0"> <a href="relatorios/honorarios.php?sql=<?=$sql?>" target="_blank"><?=$LANG['fee_table']['print_report']?></a></td>
    </tr>
  </table>
  <div id="conta_atualiza"></div>
