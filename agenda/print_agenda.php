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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerenciador Cl�nico SmilePrev - Administra��o Odontol�gica Em Suas M�os</title>
<link rel="SHORTCUT ICON" href="favicon.ico">
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../lib/script.js"></script>
</head>
<body style="background-color: #FFFFFF">
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">

  </table>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
	<tr>
      <td bgcolor="#009BE6" colspan="6"><img src="../imagens/top_gerenciador_smileprev.jpg" alt="SmilePrev" /></td>
    </tr> 
    <tr>
      <td bgcolor="#009BE6" colspan="6">&nbsp;</td>
    </tr>
    <tr class="tabela_titulo">
      <td width="8%" align="left" height="23">&nbsp;Horario</td>
      <td width="30%" align="left">Nome do paciente</td>
      <td width="12%" align="left" style="border-right: 1px; border-right-color=: #000000; border-right-style: solid">Procedimento</td>
      <td width="8%" align="left" style="border-left: 1px; border-left-color=: #000000; border-left-style: solid">&nbsp;Horario</td>
      <td width="30%" align="left">Nome do paciente</td>
      <td width="12%" align="left">Procedimento</td>
    </tr>
    <tr bgcolor="#F0F0F0" onmouseout="style.background='#F0F0F0'" onmouseover="style.background='#DDE1E6'">
<?
	if(is_date($_GET[data]) && $_GET[cpf_dentista] != "") {
		$agenda = new TAgendas();
		$par = "F0F0F0";
		$impar = "F8F8F8";
		for($i = 7; $i <= 21; $i++) {
			if(strlen($i) < 2) {
				$horas[] = "0".$i.":";
			} else {
				$horas[] = $i.":";
			}
		}
		$minutos = array('00', '15', '30', '45');
		foreach($horas as $hora) {
			foreach($minutos as $minuto) {
				$horario[] = $hora.$minuto;
			}
		}
		$j = 0;
		for($i = 0; $i < count($horario); $i++) {
			if($j % 2 == 0) {
				$odev = $par;
			} else {
				$odev = $impar;
			}
			if($i % 2 == 0) {
				if($i !== 0) {
					echo '</tr> <tr bgcolor="#'.$odev.'" onmouseout="style.background=\'#'.$odev.'\'" onmouseover="style.background=\'#DDE1E6\'">';
				}
				$j++;
				$style = '';
			} else {
				$style = '';
			}
			$agenda->LoadAgenda($_GET[data], $horario[$i], $_GET[cpf_dentista]);
			if(!$agenda->ExistHorario()) {
				$agenda->SalvarNovo();
			}
?>
      <td width="8%" align="left" height="23"style="border-left: 1px; border-left-color=: #CCCCCC; border-left-style: solid; border-bottom: 1px; border-bottom-color=: #CCCCCC; border-bottom-style: solid">&nbsp;<?=$horario[$i]?></td>
      <td width="30%" align="left" style="border-bottom: 1px; border-bottom-color=: #CCCCCC; border-bottom-style: solid"><?=$agenda->RetornaDados('descricao')?>&nbsp;</td>
      <td width="12%" align="left" style="border-right: 1px; border-right-color=: #CCCCCC; border-right-style: solid; border-bottom: 1px; border-bottom-color=: #CCCCCC; border-bottom-style: solid"><?=$agenda->RetornaDados('procedimento')?>&nbsp;</td>
<?
		}
	}
?>
	</tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr bgcolor="#<?=$odev?>">
      <td width="500" align="left" colspan="3">
      Agenda do(a) Dr(a). <b><?=encontra_valor('dentistas', 'cpf', $_GET[cpf_dentista], 'nome')?></b> para o dia
      <b><?=converte_data($_GET[data], 2)?></b>
      </td>
      <td width="250" align="right" colspan="3"><img src="../imagens/icones/imprimir.gif" valign="middle" border="0"> <a href="javascript:window.print()">Clique aqui para imprimir</a></td>
    </tr> 
    <tr bgcolor="#<?=$odev?>">
      <td colspan="6" align="center"><font size="1">
      <br>Rede SmilePrev&reg; - Valorizando seu sorriso - <a href="http://www.smileprev.com" target="_blank">www.smileprev.com </a>
      </td>
    </tr>
  </table>
</body>
</html>
