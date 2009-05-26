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
	//Atualiza��o feita para atender o requisito de pesquisa
	if($_GET[campo] == 'procurado') {
		$sql = "SELECT * FROM `pacientes`,`dentista_procurado` WHERE ".$where." ORDER BY `nome` ASC";
	} else{
		$sql = "SELECT * FROM `pacientes` WHERE ".$where." ORDER BY `nome` ASC";
	}
	
    if($_GET['campo'] == 'debito') {
        $sql = "SELECT DISTINCT(vo.codigo_paciente), tp.* FROM pacientes tp INNER JOIN v_orcamento vo ON tp.codigo = vo.codigo_paciente WHERE data < '".date('Y-m-d')."' AND pago = 'N�o' AND confirmado = 'Sim' AND baixa = 'N�o' ORDER BY `nome` ASC";
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
        <img src="imagens/icones/imprimir.gif" border="0" weight="29" height="33"> <a href="relatorios/pacientes.php?sql=<?=ajaxurlencode($sql)?>" target="_blank">Imprimir relat�rio</a>
        <img src="imagens/icones/etiquetas.gif" border="0"> <a href="etiquetas/print_etiqueta.php?sql=<?=ajaxurlencode($sql)?>" target="_blank">Imprimir etiquetas</a>
      </td>
    </tr>
  </table>
