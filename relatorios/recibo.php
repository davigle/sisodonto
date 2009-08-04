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
?><html>
<head></head>
<body topmargin="0" leftmargin="0">
<?
    $query = mysql_query("SELECT * FROM v_orcamento WHERE codigo_parcela = ".$_GET['codigo_parcela']) or die('Line 42: '.mysql_error());
	$row = mysql_fetch_array($query);
?>
<br />
<font size="3" face="Courier New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b><?=$LANG['reports']['receipt']?></b></u></font><br />
<font size="1" face="Courier New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$LANG['reports']['no_fiscal_validity']?></font><br /><br />
<font size="2" face="Courier New">&nbsp;&nbsp;<?=$LANG['reports']['patient']?>: <b><?=$row['paciente']?></b><br />
&nbsp;&nbsp;<?=$LANG['reports']['professional']?>: <b><?=(($row['sexo_dentista'] == 'Masculino')?'Dr. ':'Dra. ').$row['dentista']?></b><br />
&nbsp;&nbsp;<?=$LANG['reports']['value']?>: <b><?=$LANG['general']['currency'].' '.money_form($row['valor'])?></b><br />
&nbsp;&nbsp;<?=$LANG['reports']['due_date']?>: <b><?=converte_data($row['data'], 2)?></b><br />
&nbsp;&nbsp;<?=$LANG['reports']['payment_date']?>: <b><?=converte_data($row['datapgto'], 2)?></b><br /><br /><br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;______________________________</font><br />
<font size="1" face="Courier New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$LANG['reports']['employee_signature']?></font><br />

<script>
window.print();
</script>
</body>
</html>
