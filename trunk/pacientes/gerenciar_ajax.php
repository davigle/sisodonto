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
      	        <option value="nascimento">Aniversariantes do mês</option>
      	        <option value="matricula">Ficha clínica</option>
      	        <option value="cidade">Cidade</option>
      	        <option value="area">Área de tratamento</option>
      	        <option value="debito">Pacientes em débito</option>
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
                <option value="Dentística">Dentística</option>
                <option value="Prótese">Prótese</option>
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
      <td width="20%" align="left">Ficha Clínica</td>
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
