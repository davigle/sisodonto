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
	<tr bgcolor="#F0F0F0" onmouseout="style.background='#F0F0F0'" onmouseover="style.background='#DDE1E6'">
<?
	if(is_date(converte_data($_GET[pesquisa], 1)) && $_GET[cpf_dentista] != "") {
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
				$style = 'style="border-right: 1px; border-right-color=: #CCCCCC; border-right-style: solid"';
			} else {
				$style = '';
			}
			$agenda->LoadAgenda(converte_data($_GET[pesquisa], 1), $horario[$i], $_GET[cpf_dentista]);
			if(!$agenda->ExistHorario()) {
				$agenda->SalvarNovo();
			}
			if((converte_data($_GET[pesquisa], 1) < date(Y.'-'.m.'-'.d)) || ($_GET[cpf_dentista] != $_SESSION[cpf] && $_SESSION[nivel] == 'Dentista')) {
				$blur = 'onblur';
				$disable = 'disabled';
			} else {
				$blur = '';
				$disable = '';
			}
?>
      <td width="8%" align="left" height="23">&nbsp;<?=$horario[$i]?></td>
      <td width="30%" align="left"><input type="text" size="40" maxlength="30" name="descricao" id="descricao" value="<?=$agenda->RetornaDados('descricao')?>" <?=$disable?> onblur="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?=$agenda->RetornaDados('data')?>&hora=<?=$agenda->RetornaDados('hora')?>:00&descricao='%2Bthis.value%2B'&cpf_dentista=<?=$agenda->RetornaDados('cpf_dentista')?>')" class="forms"></td>
      <td width="12%" align="left" <?=$style?>><input type="text" size="13" maxlength="15" name="procedimento" id="procedimento" value="<?=$agenda->RetornaDados('procedimento')?>" <?=$disable?> onblur="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?=$agenda->RetornaDados('data')?>&hora=<?=$agenda->RetornaDados('hora')?>:00&procedimento='%2Bthis.value%2B'&cpf_dentista=<?=$agenda->RetornaDados('cpf_dentista')?>')" class="forms"></td>
<?
		}
	}
?>
	</tr>
  </table>
    <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="610" align="center"></td>
      <td width="140" align="right"><img src="imagens/icones/imprimir.gif" border=""> <a href="agenda/print_agenda.php?data=<?=converte_data($_GET[pesquisa], 1)?>&cpf_dentista=<?=$_GET[cpf_dentista]?>" target="_blank">Imprimir agenda</a></td>
    </tr>
  </table>
  <div id="agenda_atualiza"></div>
