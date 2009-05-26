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
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `pacientes` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
		mysql_query("DELETE FROM `exameobjetivo` WHERE `codigo_paciente` = '".$_GET[codigo]."'") or die(mysql_error());
		mysql_query("DELETE FROM `inquerito` WHERE `codigo_paciente` = '".$_GET[codigo]."'") or die(mysql_error());
		@unlink('fotos/'.$_GET[codigo].'.jpg');
	}
?>
<script>
function esconde(campo) {
    if(campo.selectedIndex == 4) {
        document.getElementById('procurar').style.display = 'none';
        document.getElementById('procurar1').style.display = '';
        document.getElementById('procurar2').style.display = 'none';
        document.getElementById('id_procurar').value = 'procurar1';
    } else if(campo.selectedIndex == 5) {
        document.getElementById('procurar').style.display = 'none';
        document.getElementById('procurar1').style.display = 'none';
        document.getElementById('procurar2').style.display = 'none';
        document.getElementById('id_procurar').value = 'procurar';
        Ajax('pacientes/pesquisa', 'pesquisa', 'campo=debito');
    } else if(campo.selectedIndex == 6 || campo.selectedIndex == 7) {
        document.getElementById('procurar').style.display = 'none';
        document.getElementById('procurar1').style.display = 'none';
        document.getElementById('procurar2').style.display = '';
        document.getElementById('procurar2').selectedIndex = 0;
        document.getElementById('id_procurar').value = 'procurar2';
    } else {
        document.getElementById('procurar').style.display = '';
        document.getElementById('procurar1').style.display = 'none';
        document.getElementById('procurar2').style.display = 'none';
        document.getElementById('id_procurar').value = 'procurar';
    }
}
</script>
<div class="conteudo" id="conteudo_central">
  <table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="38%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Pacientes"> <span class="h3">GERENCIAR PACIENTES</span></td>
      <td width="62%" valign="bottom">
      	<table width="98%" border="0" cellpadding="0" cellspacing="0">
      	  <tr>
      	    <td width="40%">
      	      Pesquisar por<br>
      	      <select name="campo" id="campo" class="forms" onchange="esconde(this)">
      	        <option value="nome">Nome</option>
      	        <option value="nascimento">Aniversariantes do m�s</option>
      	        <option value="matricula">Ficha cl�nica</option>
      	        <option value="cidade">Cidade</option>
      	        <option value="area">�rea de tratamento</option>
      	        <option value="debito">Pacientes em d�bito</option>
      	        <option value="procurado">Profissional procurado</option>
      	        <option value="atendido">Profissional que atendeu</option>
      	      </select>
      	      <input type="hidden" id="id_procurar" value="procurar">
      	    </td>
      	    <td width="60%">
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	      <select name="procurar1" id="procurar1" style="display:none" class="forms" onchange="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option value=""></option>
                <option value="Ortodontia">Ortodontia</option>
                <option value="Implantodontia">Implantodontia</option>
                <option value="Dent�stica">Dent�stica</option>
                <option value="Pr�tese">Pr�tese</option>
                <option value="Odontopediatria">Odontopediatria</option>
                <option value="Cirurgia">Cirurgia</option>
                <option value="Endodontia">Endodontia</option>
                <option value="Periodontia">Periodontia</option>
                <option value="Radiologia">Radiologia</option>
                <option value="DTM">DTM</option>
                <option value="Odontogeriatria">Odontogeriatria</option>
                <option value="Ortopedia">Ortopedia</option>
      	      </select>
      	      <select name="procurar2" id="procurar2" style="display:none" class="forms" onchange="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option></option>
<?
	$dentista = new TDentistas();
	$lista = $dentista->ListDentistas();
	for($i = 0; $i < count($lista); $i++) {
		if($row[cpf_dentistaprocurado] == $lista[$i][cpf]) {
			echo '<option value="'.$lista[$i][cpf].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].' ('.(($lista[$i][ativo] == 'Sim')?'Ativ':'Inativ').(($lista[$i][titulo] == 'Dr.')?'o':'a').')</option>';
		} else {
			echo '<option value="'.$lista[$i][cpf].'">'.$lista[$i][titulo].' '.$lista[$i][nome].' ('.(($lista[$i][ativo] == 'Sim')?'Ativ':'Inativ').(($lista[$i][titulo] == 'Dr.')?'o':'a').')</option>';
		}
	}
?>
			 </select>
      	    </td>
      	  </tr>
      	</table>
	  </td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="bottom">
        <img src="imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax('pacientes/incluir', 'conteudo', '')">Incluir novo paciente </a>
      </td>
    </tr>
</table>
<div class="conteudo" id="table dados"><br>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6">&nbsp;</td>
      <td bgcolor="#009BE6">&nbsp;</td>
      <td bgcolor="#009BE6">&nbsp;</td>
      <td bgcolor="#009BE6">&nbsp;</td>
    </tr>
    <tr>
      <td width="63%" height="23" align="left">Paciente</td>
      <td width="20%" align="left">Ficha Cl�nica</td>
      <td width="8%" align="center">Editar/Ver</td>
      <td width="9%" align="center">Excluir</td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa=&campo=nome');
  </script>
</div>
