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
	include "../timbre_head.php";
	$sql = "SELECT * FROM v_orcamento WHERE codigo_orcamento = ".$_GET['codigo'];
	$query = mysql_query($sql) or die('Line 40: '.mysql_error());
	$row = mysql_fetch_array($query);
?>
<font size="3">Paciente: <b><?=$row['paciente'].' ['.$row['codigo_paciente'].']'?></b><br /></font><font style="font-size: 3px;">&nbsp;<br /></font>
<font size="2">Parcelas para o pagamento do tratamento odontol�gico com <b><?=(($row['sexo_dentista'] == 'Masculino')?'Dr.':'Dra.').' '.$row['dentista']?></b></font><br /><br />
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse">
<?
    $i = 1;
	$sql = "SELECT * FROM v_orcamento WHERE codigo_orcamento = ".$_GET['codigo']." ORDER BY codigo_parcela LIMIT ".$row['parcelas'];
    $query = mysql_query($sql) or die('Line 48: '.mysql_error());
    while($row = mysql_fetch_array($query)) {
?>
  <tr style="font-size: 12px">
    <td width="38%" align="center" valign="middle">
      <font size="5"><?=$i?></font>&nbsp;&nbsp;<img align="middle" src="codigo_barra.php?codigo=<?=(completa_zeros($row['codigo_parcela'], ZEROS))?>" border="0">
    </td>
    <td width="32%" align="center" valign="middle">
      <table width="95%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td width="38%" valign="top" align="left" height="20"><font style="font-size: 11px;">
            Valor: </font>
          </td>
          <td width="62%" valign="top" align="left"><font style="font-size: 11px;">
            <b>R$ <?=money_form($row['valor'])?></b>
          </td>
        </tr>
        <tr>
          <td align="left"><font style="font-size: 11px;">
            Vencimento: </font>
          </td>
          <td align="left"><font style="font-size: 11px;">
            <b><?=converte_data($row['data'], 2)?></b>
          </td>
        </tr>
      </table>
    </td>
    <td width="30%" align="center" valign="top">
      <font style="font-size: 8px;">Assinatura do funcion�rio e carimbo</font>
    </td>
  </tr>
<?
        flush();
        $i++;
    }
?>
</table>
<script>
alert("Para imprimir o boleto, voc� deve configurar a p�gina no Internet Explorer\ncom margens superiores de 0 mil�metros.\nAs demais dever�o ser de 19,05 mil�metros cada.");
window.print();
</script>
<?
    include "../timbre_foot.php";
?>
