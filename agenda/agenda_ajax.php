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
<div id='calendario' name='calendario' style='display:none;position:absolute;'>
<?
	include "../lib/calendario.inc.php";
?>
</div>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="43%">&nbsp;&nbsp;&nbsp;<img src="agenda/img/agenda.png" alt="Agenda"> <span class="h3">GERENCIAR AGENDA</span></td>
      <td width="28%" valign="bottom">
      <select name="cpf_dentista" class="forms" id="cpf_dentista" onchange="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2BgetElementById('procurar').value%2B'&cpf_dentista='%2Bthis.options[this.selectedIndex].value)">
      <option></option>
<?
		$dentista = new TDentistas();
		$lista = $dentista->ListDentistas("SELECT * FROM `dentistas` WHERE `ativo` = 'Sim' ORDER BY `nome` ASC");
		for($i = 0; $i < count($lista); $i++) {
			if($_SESSION[cpf] == $lista[$i][cpf]) {
				echo '<option value="'.$lista[$i][cpf].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
			} else {
				echo '<option value="'.$lista[$i][cpf].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
			}
		}
?>     
			 </select></td>
      <td width="27%" align="right" valign="bottom">
Data <input name="procurar" id="procurar" value="<?=converte_data(hoje(), 2)?>" type="text" class="forms" size="20" maxlength="40"
		onkeyup="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&cpf_dentista='%2BgetElementById('cpf_dentista').options[getElementById('cpf_dentista').selectedIndex].value)"
		onfocus="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&cpf_dentista='%2BgetElementById('cpf_dentista').options[getElementById('cpf_dentista').selectedIndex].value)"
		onKeypress="return Ajusta_Data(this, event);"
		onclick="abreCalendario(this)"
		<?/*onblur="fechaCalendario(this)"*/?>></td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
</table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="8">&nbsp;</td>
    </tr>
    <tr>
      <td width="7%" align="left" height="23">&nbsp;Horário</td>
      <td width="24%" align="left">Nome do paciente</td>
      <td width="13%" align="left">Procedimento</td>
      <td width="6%" align="left" style="border-right: 1px; border-right-color=: #000000; border-right-style: solid">&nbsp;Faltou</td>
      <td width="7%" align="left">&nbsp;Horário</td>
      <td width="24%" align="left">Nome do paciente</td>
      <td width="13%" align="left">Procedimento</td>
      <td width="6%" align="left">&nbsp;Faltou</td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  	function atualizaData() {
  		Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa=<?=converte_data(hoje(), 2)?>&cpf_dentista=<?=$_SESSION[cpf]?>');
  	}
<?
  	if($_SESSION[nivel] == 'Dentista') {
  		echo 'atualizaData();';
  	}
?>
  </script>
</div>
