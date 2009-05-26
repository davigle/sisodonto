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
	if($_GET['confirm_del'] == "delete") {
		mysql_query("DELETE FROM `honorarios` WHERE `codigo` = '".$_GET['codigo']."'") or die(mysql_error());
	}
	if(isset($_POST['Salvar'])) {
		$obrigatorios[1] = 'codigo';
		$obrigatorios[] = 'procedimento';
		$obrigatorios[] = 'valor_particular';
		$obrigatorios[] = 'valor_convenio';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
        if($j == 0) {
            $codigo = mysql_fetch_assoc(mysql_query("SELECT RIGHT( codigo, 3 ) AS autoindex FROM `honorarios` WHERE codigo LIKE '".$_POST['area']."%' ORDER BY codigo DESC LIMIT 1"));
            $codigo = $_POST['area'].completa_zeros($codigo['autoindex']+1, 3);
            $caixa = new THonorarios();
            $caixa->SetDados('codigo', $codigo);
            $caixa->SetDados('procedimento', $_POST['procedimento']);
            $caixa->SetDados('valor_particular', $_POST['valor_particular']);
            $caixa->SetDados('valor_convenio', $_POST['valor_convenio']);
            $caixa->SalvarNovo();
            $caixa->Salvar();
            echo '<script>alert("Procedimento cadastrado com sucesso!")</script>';
        }
    }
    $disabled = 'disabled';
    if(checknivel('Administrador')) {
        $disabled = '';
	}
?>
<script>
function esconde(campo) {
    if(campo.selectedIndex == 2) {
        document.getElementById('procurar').style.display = 'none';
        document.getElementById('procurar1').style.display = '';
        document.getElementById('procurar1').selectedIndex = 0;
        document.getElementById('id_procurar').value = 'procurar1';
    } else {
        document.getElementById('procurar').style.display = '';
        document.getElementById('procurar').value = '';
        document.getElementById('procurar').focus();
        document.getElementById('procurar1').style.display = 'none';
        document.getElementById('id_procurar').value = 'procurar';
    }
}
</script>
<div class="conteudo" id="conteudo_central">
  <table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="55%">&nbsp;&nbsp;&nbsp;<img src="honorarios/img/honorarios.png" alt="Tabela de Honorários"> <span class="h3">Tabela de Honorários </span></td>
      <td width="45%" valign="bottom">
      	<table width="98%" border="0" cellpadding="0" cellspacing="0" align="right">
      	  <tr>
      	    <td width="50%">
      	      Pesquisar por<br>
      	      <select name="campo" id="campo" class="forms" onchange="esconde(this)">
      	        <option value="procedimento">Procedimento</option>
      	        <option value="codigo">Código</option>
      	        <option value="area">Área</option>
      	      </select>
      	      <input type="hidden" id="id_procurar" value="procurar">
      	    </td>
      	    <td width="50%" align="right">&nbsp;
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="40" maxlength="40" onkeyup="javascript:Ajax('honorarios/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	      <select name="procurar1" id="procurar1" style="display:none" class="forms" onchange="javascript:Ajax('honorarios/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option></option>
                <option value="CO">Cirurgia Oral</option>
                <option value="DE">Dentística</option>
                <option value="EN">Endodontia</option>
                <option value="EX">Exame Clínico</option>
                <option value="IM">Implantodontia</option>
                <option value="OD">Odontopediatria</option>
                <option value="OR">Ortodontia</option>
                <option value="RA">Radiologia</option>
                <option value="PE">Periodontia</option>
                <option value="PR">Prevenção</option>
                <option value="PO">Prótese</option>
                <option value="TE">Testes e Exames de Laboratório</option>
      	      </select>
      	    </td>
      	  </tr>
      	</table>
	  </td>
    </tr>
  </table><br />
  <form id="form2" name="form2" method="POST" action="honorarios/honorarios_ajax.php" onsubmit="formSender(this, 'conteudo'); this.reset(); return false;">
  <table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="29%">Área <br />
        <select name="area" class="forms" id="area" <?=$disabled?>>
          <option value="CO">Cirurgia Oral</option>
          <option value="DE">Dentística</option>
          <option value="EN">Endodontia</option>
          <option value="EX">Exame Clínico</option>
          <option value="IM">Implantodontia</option>
          <option value="OD">Odontopediatria</option>
          <option value="OR">Ortodontia</option>
          <option value="RA">Radiologia</option>
          <option value="PE">Periodontia</option>
          <option value="PR">Prevenção</option>
          <option value="PO">Prótese</option>
          <option value="TE">Testes e Exames de Laboratório</option>
        </select>
      </td>
      <td width="37%">Procedimento <br />
        <input type="text" size="50" name="procedimento" id="procedimento" class="forms" <?=$disabled?>>
      </td>
      <td width="13%">Valor Particular <br />
        <input type="text" size="15" name="valor_particular" id="valor_particular" class="forms" <?=$disabled?> onKeypress="return Ajusta_Valor(this, event);">
      </td>
      <td width="13%">Valor Convênio <br />
        <input type="text" size="15" name="valor_convenio" id="valor_convenio" class="forms" <?=$disabled?> onKeypress="return Ajusta_Valor(this, event);">
      </td>
      <td width="8%" align="right">&nbsp; <br />
        <input type="submit" name="Salvar" id="Salvar" value="Salvar" class="forms" <?=$disabled?>>
      </td>
    </tr>
  </table>
  </form>
<div class="conteudo" id="table dados"><br>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td width="7%" height="23" align="left">Código</td>
      <td width="50%" align="center">Procedimento</td>
      <td width="9%" align="center">Particular</td>
      <td width="9%" align="center">Convênio</td>
      <td width="9%" align="center">Diferença</td>
      <td width="9%" align="center">Diferença</td>
      <td width="7%" align="center">Apagar</td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('honorarios/pesquisa', 'pesquisa', 'campo=procedimento&pesquisa=');
  </script>
</div>
