<?
   /**
    * Gerenciador Clínico Odontológico
    * Copyright (C) 2006 - 2009
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
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endereço:
    *
    * Smile Odontolóogia
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
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
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
      <td width="55%">&nbsp;&nbsp;&nbsp;<img src="honorarios/img/honorarios.png" alt="<?=$LANG['fee_table']['fee_table']?>"> <span class="h3"><?=$LANG['fee_table']['fee_table']?> </span></td>
      <td width="45%" valign="bottom">
      	<table width="98%" border="0" cellpadding="0" cellspacing="0" align="right">
      	  <tr>
      	    <td width="50%">
      	      <?=$LANG['fee_table']['search_for']?><br>
      	      <select name="campo" id="campo" class="forms" onchange="esconde(this)">
      	        <option value="procedimento"><?=$LANG['fee_table']['procedure']?></option>
      	        <option value="codigo"><?=$LANG['fee_table']['code']?></option>
      	        <option value="area"><?=$LANG['fee_table']['area']?></option>
      	      </select>
      	      <input type="hidden" id="id_procurar" value="procurar">
      	    </td>
      	    <td width="50%" align="right">&nbsp;
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="40" maxlength="40" onkeyup="javascript:Ajax('honorarios/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	      <select name="procurar1" id="procurar1" style="display:none" class="forms" onchange="javascript:Ajax('honorarios/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option></option>
                <option value="CO"><?=$LANG['fee_table']['oral_surgery']?></option>
                <option value="DE"><?=$LANG['fee_table']['dentistic']?></option>
                <option value="EN"><?=$LANG['fee_table']['endodonty']?></option>
                <option value="EX"><?=$LANG['fee_table']['clinic_examination']?></option>
                <option value="IM"><?=$LANG['fee_table']['implantodonty']?></option>
                <option value="OD"><?=$LANG['fee_table']['odontopediatry']?></option>
                <option value="OR"><?=$LANG['fee_table']['orthodonty']?></option>
                <option value="RA"><?=$LANG['fee_table']['radiology']?></option>
                <option value="PE"><?=$LANG['fee_table']['periodonty']?></option>
                <option value="PR"><?=$LANG['fee_table']['prevention']?></option>
                <option value="PO"><?=$LANG['fee_table']['prosthesis']?></option>
                <option value="TE"><?=$LANG['fee_table']['laboratory_test_and_examination']?></option>
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
          <option value="CO"><?=$LANG['fee_table']['oral_surgery']?></option>
          <option value="DE"><?=$LANG['fee_table']['dentistic']?></option>
          <option value="EN"><?=$LANG['fee_table']['endodonty']?></option>
          <option value="EX"><?=$LANG['fee_table']['clinic_examination']?></option>
          <option value="IM"><?=$LANG['fee_table']['implantodonty']?></option>
          <option value="OD"><?=$LANG['fee_table']['odontopediatry']?></option>
          <option value="OR"><?=$LANG['fee_table']['orthodonty']?></option>
          <option value="RA"><?=$LANG['fee_table']['radiology']?></option>
          <option value="PE"><?=$LANG['fee_table']['periodonty']?></option>
          <option value="PR"><?=$LANG['fee_table']['prevention']?></option>
          <option value="PO"><?=$LANG['fee_table']['prosthesis']?></option>
          <option value="TE"><?=$LANG['fee_table']['laboratory_test_and_examination']?></option>
        </select>
      </td>
      <td width="37%"><?=$LANG['fee_table']['procedure']?> <br />
        <input type="text" size="50" name="procedimento" id="procedimento" class="forms" <?=$disabled?>>
      </td>
      <td width="13%"><?=$LANG['fee_table']['private_value']?><br />
        <input type="text" size="15" name="valor_particular" id="valor_particular" class="forms" <?=$disabled?> onKeypress="return Ajusta_Valor(this, event);">
      </td>
      <td width="13%"><?=$LANG['fee_table']['plan_value']?> <br />
        <input type="text" size="15" name="valor_convenio" id="valor_convenio" class="forms" <?=$disabled?> onKeypress="return Ajusta_Valor(this, event);">
      </td>
      <td width="8%" align="right">&nbsp; <br />
        <input type="submit" name="Salvar" id="Salvar" value="<?=$LANG['fee_table']['save']?>" class="forms" <?=$disabled?>>
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
      <td width="7%" height="23" align="left"><?=$LANG['fee_table']['code']?></td>
      <td width="50%" align="center"><?=$LANG['fee_table']['procedure']?></td>
      <td width="9%" align="center"><?=$LANG['fee_table']['private']?></td>
      <td width="9%" align="center"><?=$LANG['fee_table']['plan']?></td>
      <td width="18%" colspan="2" align="center"><?=$LANG['fee_table']['difference']?></td>
      <td width="7%" align="center"><?=$LANG['fee_table']['delete']?></td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('honorarios/pesquisa', 'pesquisa', 'campo=procedimento&pesquisa=');
  </script>
</div>
