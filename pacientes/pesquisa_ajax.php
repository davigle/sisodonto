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
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<?
    $_GET['pesquisa'] = htmlspecialchars($_GET['pesquisa'], ENT_QUOTES);
	$pacientes = new TPacientes();
	if($_GET[campo] == 'nascimento') {
		$where = "MONTH(nascimento) = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'nome') {
		$where = "nome LIKE '%".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'matricula') {
		$where = "codigo = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'cidade') {
		$where = "cidade LIKE '".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'area') {
		$where = "tratamento LIKE '%".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'procurado') {
		$where = "pacientes.codigo = dentista_procurado.cod_paciente and dentista_procurado.cpf_dentista = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'atendido') {
		$where = "cpf_dentistaatendido = '".$_GET[pesquisa]."'";
	}
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
	$href = 'href=';
	$onclick = 'onclick=';
	if(checknivel('Dentista') || checknivel('Funcionario')) {
		$href = '';
		$onclick = '';
	}
	//Atualização feita para atender o requisito de pesquisa
	if($_GET[campo] == 'procurado') {
		$sql = "SELECT * FROM `pacientes`,`dentista_procurado` WHERE ".$where." ORDER BY `nome` ASC";
	} else{
		$sql = "SELECT * FROM `pacientes` WHERE ".$where." ORDER BY `nome` ASC";
	}
	
    if($_GET['campo'] == 'debito') {
        $sql = "SELECT DISTINCT(vo.codigo_paciente), tp.* FROM pacientes tp INNER JOIN v_orcamento vo ON tp.codigo = vo.codigo_paciente WHERE data < '".date('Y-m-d')."' AND pago = 'Não' AND confirmado = 'Sim' AND baixa = 'Não' ORDER BY `nome` ASC";
    }
	$lista = $pacientes->ListPacientes($sql.' LIMIT '.$limit.', '.PG_MAX);
	$total_regs = $pacientes->ListPacientes($sql);
	$par = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="63%"><?=$lista[$i][nome]?></td>
      <td width="20%"><?=$lista[$i][codigo]?></td>
      <td width="8%" align="center"><a href="javascript:Ajax('pacientes/incluir', 'conteudo', 'codigo=<?=$lista[$i][codigo]?>&acao=editar')"><img src="imagens/icones/editar.gif" alt="Editar" width="16" height="18" border="0"></a></td>
      <td width="9%" align="center"><a <?=$href?>"javascript:Ajax('pacientes/gerenciar', 'conteudo', 'codigo=<?=$lista[$i][codigo]?>" <?=$onclick?>"return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a></td>
    </tr>
<?
	}
?>
  </table>
  <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="20%">
      Total de pacientes: <b><?=count($total_regs)?></b>
      </td>
      <td width="40%" align="center">
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
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'pacientes/pesquisa\', \'pesquisa\', \'pesquisa=\'%2BgetElementById(getElementById(\'id_procurar\').value).value%2B\'&campo=\'%2BgetElementById(\'campo\').options[getElementById(\'campo\').selectedIndex].value%2B\'&pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="43%" align="right">
        <img src="imagens/icones/imprimir.gif" border="0" weight="29" height="33"> <a href="relatorios/pacientes.php?sql=<?=ajaxurlencode($sql)?>" target="_blank">Imprimir relatório</a>
        <img src="imagens/icones/etiquetas.gif" border="0"> <a href="etiquetas/print_etiqueta.php?sql=<?=ajaxurlencode($sql)?>" target="_blank">Imprimir etiquetas</a>
      </td>
    </tr>
  </table>
