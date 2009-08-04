<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2009
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
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endere�o:
    *
    * Smile Odontol�ogia
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
	include "../timbre_head.php";
?>
<p align="center"><font size="3"><b><?=$LANG['reports']['fee_table_report']?></b></font></p><br />
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr style="font-size: 11px">
    <th width="7%" align="center" style="font-size: 11px"><?=$LANG['reports']['code']?>
    </th>
    <th width="45%" align="center" style="font-size: 11px"><?=$LANG['reports']['procedure']?>
    </th>
    <th width="12%" align="center" style="font-size: 11px"><?=$LANG['reports']['private_value']?>
    </th>
    <th width="12%" align="center" style="font-size: 11px"><?=$LANG['reports']['plan_value']?>
    </th>
    <th width="24%" align="center" style="font-size: 11px" colspan="2"><?=$LANG['reports']['differences']?>
    </th>
  </tr>
<?
    $i = 0;
	$sql = stripslashes($_GET['sql']);
	$query = mysql_query($sql) or die('Line 57: '.mysql_error());
    while($row = mysql_fetch_array($query)) {
        if($i % 2 === 0) {
            $td_class = 'td_even';
        } else {
            $td_class = 'td_odd';
        }
?>
  <tr class="<?=$td_class?>" style="font-size: 11px">
    <td><?=$row['codigo']?>
    </td>
    <td><?=$row['procedimento']?>
    </td>
    <td align="right"><?=$LANG['general']['currency'].' '.number_format($row['valor_particular'], 2, ',', '.')?>
    </td>
    <td align="right"><?=$LANG['general']['currency'].' '.number_format($row['valor_convenio'], 2, ',', '.')?>
    </td>
    <td align="right"><?=$LANG['general']['currency'].' '.number_format(($row['valor_particular']-$row['valor_convenio']), 2, ',', '.')?>
    </td>
    <td align="right"><?=@number_format((100-($row['valor_convenio']/$row['valor_particular']*100)), 2, ',', '.')?> %
    </td>
  </tr>
<?
        $i++;
    }
?>
</table>
<script>
window.print();
</script>
<?
    include "../timbre_foot.php";
?>
