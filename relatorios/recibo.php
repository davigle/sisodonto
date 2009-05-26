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
?><html>
<head></head>
<body topmargin="0" leftmargin="0">
<?
    $query = mysql_query("SELECT * FROM v_orcamento WHERE codigo_parcela = ".$_GET['codigo_parcela']) or die('Line 42: '.mysql_error());
	$row = mysql_fetch_array($query);
?>
<br />
<font size="3" face="Courier New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b>R E C I B O</b></u></font><br />
<font size="1" face="Courier New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SEM VALIDADE FISCAL</font><br /><br />
<font size="2" face="Courier New">&nbsp;&nbsp;Paciente: <b><?=$row['paciente']?></b><br />
&nbsp;&nbsp;Profissional: <b><?=(($row['sexo_dentista'] == 'Masculino')?'Dr. ':'Dra. ').$row['dentista']?></b><br />
&nbsp;&nbsp;Valor: <b>R$ <?=money_form($row['valor'])?></b><br />
&nbsp;&nbsp;Data de vencimento: <b><?=converte_data($row['data'], 2)?></b><br />
&nbsp;&nbsp;Data de Pagamento: <b><?=converte_data($row['datapgto'], 2)?></b><br /><br /><br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;______________________________</font><br />
<font size="1" face="Courier New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Assinatura do Funcionário/Dentista</font><br />

<script>
alert("Para imprimir o recibo, você deve configurar a página no Internet Explorer\ncom margens superiores de 0 milímetros.\nAs demais deverão ser de 19,05 milímetros cada.");
window.print();
</script>
</body>
</html>
