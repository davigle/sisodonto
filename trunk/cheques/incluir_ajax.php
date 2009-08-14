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
	$cheque = new TCheques();
	if(isset($_POST[Salvar])) {
		$obrigatorios[1] = 'recebidode';
		$obrigatorios[] = 'valor';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$i] = '<font color="#FF0000">';
			}
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$cheque->LoadCheque($_GET[codigo]);
			}
			$cheque->SetDados('nometitular', $_POST[nometitular]);
			$cheque->SetDados('valor', $_POST[valor]);
			$cheque->SetDados('numero', $_POST[numero]);
			$cheque->SetDados('banco', $_POST[banco]);
			$cheque->SetDados('recebidode', $_POST[recebidode]);
			$cheque->SetDados('encaminhadopara', $_POST[encaminhadopara]);
			$cheque->SetDados('compensacao', converte_data($_POST[compensacao], 1));
			if($_GET[acao] != "editar") {
				$cheque->SalvarNovo();
			}
		$cheque->Salvar();
		echo "<script>Ajax('cheques/gerenciar', 'conteudo', '')</script>";
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['check_control']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$cheque->LoadCheque($_GET[codigo]);
		$row = $cheque->RetornaTodosDados();
	} else {
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strLoCase = $LANG['check_control']['including'];
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="cheques/img/cheques.png" alt="<?=$LANG['check_control']['clinic_check_control']?>"> <span class="h3"><?=$LANG['check_control']['clinic_check_control']?> [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?=$strLoCase.' '.$LANG['check_control']['check']?></td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="cheques/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?=$LANG['check_control']['check_information']?> </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287" height="40"><?=$LANG['check_control']['holder']?> <br />
                <label>
                  <input name="nometitular" value="<?=$row[nometitular]?>" type="text" class="forms" id="nometitular" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><?=$r[2]?>* <?=$LANG['check_control']['value']?><br />
              <input name="valor" value="<?=$row[valor]?>" type="text" class="forms" id="valor" onKeypress="return Ajusta_Valor(this, event);" /></td>
          </tr>
          <tr>
            <td height="40"><?=$LANG['check_control']['check_number']?><br />
              <input name="numero" value="<?=$row[numero]?>" type="text" class="forms" id="numero" size="20" maxlength="150" /></td>
            <td><?=$LANG['check_control']['bank']?><br />
              <input name="banco" value="<?=$row[banco]?>" type="text" class="forms" id="banco" /></td>
          </tr>
          <tr>
            <td height="40"><?=$LANG['check_control']['agency_number']?>:<br />
                <input name="agencia" value="<?=converte_data($row[agencia], 2)?>" type="text" class="forms" id="agencia" size="20" maxlength="20" />
              <br /></td>
            <td><?=$LANG['check_control']['compensation_date']?>:<br />
                <input name="compensacao" value="<?=converte_data($row[compensacao], 2)?>" type="text" class="forms" id="compensacao" size="14" maxlength="50" onKeypress="return Ajusta_Data(this, event);" />
              <br /></td>
          </tr>
          <tr>
            <td height="40"><?=$r[5]?>* <?=$LANG['check_control']['received_from']?>:<br />
                <input name="recebidode" value="<?=$row[recebidode]?>" type="text" class="forms" id="recebidode" size="40" maxlength="50" />
              <br /></td>
            <td><?=$LANG['check_control']['forwarded_to']?>:<br />
                <input name="encaminhadopara" value="<?=$row[encaminhadopara]?>" type="text" class="forms" id="encaminhadopara" size="40" maxlength="50" />
              <br /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="<?=$LANG['check_control']['save']?>" />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>
