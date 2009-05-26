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
    $nome_dentista = encontra_valor('dentistas', 'cpf', $_GET['cpf_dentista'], 'nome');
    $sexo_dentista = encontra_valor('dentistas', 'cpf', $_GET['cpf_dentista'], 'sexo');
?>
<font size="3">Agenda <?=(($sexo_dentista == 'Masculino')?'do <b>Dr.':'da <b>Dra.').' '.$nome_dentista?></b> para o dia <b><?=converte_data($_GET['data'], 2).' ('.ucwords(nome_semana($_GET['data'])).')'?></font><br /><br />
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr style="font-size: 11px">
      <th width="8%" align="left" style="font-size: 11px">&nbsp;Horario</td>
      <th width="30%" align="left" style="font-size: 11px">Nome do paciente</td>
      <th width="12%" align="left" style="font-size: 11px; border-right: 1px; border-right-color=: #000000; border-right-style: solid">Procedimento</td>
      <th width="8%" align="left" style="font-size: 11px; border-left: 1px; border-left-color=: #000000; border-left-style: solid">&nbsp;Horario</td>
      <th width="30%" align="left" style="font-size: 11px">Nome do paciente</td>
      <th width="12%" align="left" style="font-size: 11px">Procedimento</td>
    </tr>
    <tr class="td_even">
<?
	if(is_date($_GET[data]) && $_GET[cpf_dentista] != "") {
		$agenda = new TAgendas();
		for($i = 7; $i <= 22; $i++) {
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
				$td_class = 'td_even';
			} else {
				$td_class = 'td_odd';
			}
			if($i % 2 == 0) {
				if($i !== 0) {
					echo '</tr> <tr class="'.$td_class.'">';
				}
				$j++;
                $styles = 'style="border-right: 1px; border-right-color=: #CCCCCC; border-right-style: solid"';
			} else {
                $styles = '';
			}
			$agenda->LoadAgenda($_GET[data], $horario[$i], $_GET[cpf_dentista]);
			if(!$agenda->ExistHorario()) {
				$agenda->SalvarNovo();
			}
?>
      <td align="center" height="23">&nbsp;<?=$horario[$i]?></td>
      <td align="left"><?=$agenda->RetornaDados('descricao')?>&nbsp;</td>
      <td align="left" <?=$styles?>><?=$agenda->RetornaDados('procedimento')?>&nbsp;</td>
<?
            $j++;
		}
	}
?>
  </tr>
</table>
<script>
alert("Para imprimir o relat�rio, voc� deve configurar a p�gina no Internet Explorer\ncom margens superiores de 0 mil�metros.\nAs demais dever�o ser de 19,05 mil�metros cada.");
window.print();
</script>
<?
    include "../timbre_foot.php";
?>
