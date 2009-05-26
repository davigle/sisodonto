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
	include "../timbre_head.php";
	$query_orcamento = mysql_query("SELECT * FROM orcamento WHERE codigo = ".$_GET['codigo']) or die('Line 39: '.mysql_error());
    $row_orcamento = mysql_fetch_assoc($query_orcamento);
    $query_paciente = mysql_query("SELECT * FROM pacientes WHERE codigo = ".$row_orcamento['codigo_paciente']) or die('Line 41: '.mysql_error());
    $row_paciente = mysql_fetch_assoc($query_paciente);
    $query_dentista = mysql_query("SELECT * FROM dentistas WHERE cpf = ".$row_orcamento['cpf_dentista']) or die('Line 43: '.mysql_error());
    $row_dentista = mysql_fetch_assoc($query_dentista);
?>
<font size="3">Orçamento para: <b><?=$row_paciente['nome'].' ['.$row_paciente['codigo'].']'?></b><br /></font><font style="font-size: 3px;">&nbsp;<br /></font>
<font size="2">Orçamento para o tratamento odontológico com <b><?=(($row_dentista['sexo'] == 'Masculino')?'Dr.':'Dra.').' '.$row_dentista['nome']?></b></font><br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <th width="11%">Código</th>
        <th width="11%">Dente</th>
        <th width="45%">Descrição do Procedimento</th>
        <th width="16%" colspan="2">R$ Particular</th>
        <th width="15%">R$ Convênio</th>
      </tr>
<?
    $i = 0;
    $total_particular = $total_convenio = 0;
    $query_procedimentos = mysql_query("SELECT * FROM procedimentos_orcamento WHERE codigo_orcamento = ".$_GET['codigo']) or die('Line 61: '.mysql_error());
    while($row_procedimentos = mysql_fetch_assoc($query_procedimentos)) {
        if($i % 2 === 0) {
            $td_class = 'td_even';
        } else {
            $td_class = 'td_odd';
        }
?>
      <tr class="<?=$td_class?>" style="font-size: 12px">
        <td><?=$row_procedimentos['codigoprocedimento']?></td>
        <td><?=$row_procedimentos['dente']?></td>
        <td><?=$row_procedimentos['descricao']?></td>
        <td align="right"><?=money_form($row_procedimentos['particular'])?></td>
        <td width="2%">&nbsp;</td>
        <td align="right"><?=money_form($row_procedimentos['convenio'])?></td>
      </tr>
<?
        $total_particular += $row_procedimentos['particular'];
        $total_convenio += $row_procedimentos['convenio'];
        $i++;
    }
?>
      <tr style="font-size: 12px">
        <td colspan="3" align="center"><b>TOTAL:</b></td>
        <td align="right"><b>R$ <?=money_form($total_particular)?></b></td>
        <td>&nbsp;</td>
        <td align="right"><b>R$ <?=money_form($total_convenio)?></b></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><br /><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <th width="33%" align="center">Valor a ser cobrado</th>
        <th width="33%" align="center">Valor Total</th>
        <th width="33%" align="center">Forma de Pagamento</th>
      </tr>
      <tr style="font-size: 12px" height="20" class="td_even">
        <td align="center"><?=$row_orcamento['aserpago']?></td>
        <td align="center">R$ <?=money_form($row_orcamento['valortotal'])?></td>
        <td align="center"><?=$row_orcamento['formapagamento']?></td>
      </tr>
      <tr style="font-size: 12px" height="20" class="td_odd">
        <td align="center">Nº Parcelas: <?=$row_orcamento['parcelas']?></td>
        <td align="center">Entrada: <?=(($row_orcamento['entrada_tipo'] == '%')?$row_orcamento['entrada'].'%':'R$ '.$row_orcamento['entrada'])?></td>
        <td align="center">Desconto: <?=$row_orcamento['desconto']?>%</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><br /><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <th align="center">Parcelas</th>
        <th align="center">Data</th>
        <th align="center">Situação</th>
        <th align="center">Valor</th>
      </tr>
<?
    $i = $total = 0;
    $query_parcelas = mysql_query("SELECT tor.baixa, tpo.* FROM parcelas_orcamento tpo INNER JOIN orcamento tor ON tpo.codigo_orcamento = tor.codigo WHERE codigo_orcamento = ".$_GET['codigo']." ORDER BY codigo LIMIT ".$row_orcamento['parcelas']) or die('Line 119: '.mysql_error());
    while($row_parcelas = mysql_fetch_assoc($query_parcelas)) {
        if($i % 2 === 0) {
            $td_class = 'td_even';
        } else {
            $td_class = 'td_odd';
        }
        $total += $row_parcelas['valor'];

?>
      <tr style="font-size: 12px" class="<?=$td_class?>">
        <td align="center">Parcela <?=($i+1)?> (Boleto nº <?=$row_parcelas['codigo']?>)</td>
        <td align="center"><?=converte_data($row_parcelas['datavencimento'], 2)?></td>
        <td align="center"><?=(($row_parcelas['baixa'] == 'Não')?(($row_parcelas['pago'] == 'Sim')?'PAGO':'ABERTO').((($row_parcelas['datavencimento'] < date('Y-m-d')) && ($row_parcelas['pago'] != 'Sim'))?' (VENCIDO)</a>':'</a>').(($row_parcelas['pago'] == 'Sim')?' ('.converte_data($row_parcelas['datapgto'], 2).')':''):(($row_parcelas['pago'] == 'Sim')?'PAGO ('.converte_data($row_parcelas['datapgto'], 2).')':'CANCELADO'))?></td>
        <td align="right">R$ <?=money_form($row_parcelas['valor'])?></td>
      </tr>
<?
        $i++;
    }
?>
      <tr>
        <td colspan="3" align="center"><b>TOTAL:</b></td>
        <td align="right"><b>R$ <?=money_form($total)?></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<?
    include "../timbre_foot.php";
?>
<script>
alert("Para imprimir o orçamento, você deve configurar a página no Internet Explorer\ncom margens superiores de 0 milímetros.\nAs demais deverão ser de 19,05 milímetros cada.");
window.print();
</script>
