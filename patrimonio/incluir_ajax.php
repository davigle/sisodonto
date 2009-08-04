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
	$patrimonio = new TPatrimonios();
	if(isset($_POST[Salvar])) {	
		$obrigatorios[1] = 'codigo';
		$obrigatorios[] = 'descricao';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
				$r[$i] = '<font color="#FF0000">';
			    $j++;
			}
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$patrimonio->LoadPatrimonio($_GET[codigo]);
				$strScrp = "Ajax('patrimonio/gerenciar', 'conteudo', '');";
			}
			$patrimonio->SetDados('codigo', $_POST[codigo]);
			$patrimonio->SetDados('setor', $_POST[setor]);
			$patrimonio->SetDados('descricao', $_POST[descricao]);
			$patrimonio->SetDados('valor', $_POST[valor]);
			$patrimonio->SetDados('dataaquisicao', $_POST[dataaquisicao]);
			$patrimonio->SetDados('tempogarantia', $_POST[tempogarantia]);
			$patrimonio->SetDados('cor', $_POST[cor]);
			$patrimonio->SetDados('quantidade', $_POST[quantidade]);
			$patrimonio->SetDados('fornecedor', $_POST[fornecedor]);
			$patrimonio->SetDados('numeronotafiscal', $_POST[numeronotafiscal]);
			$patrimonio->SetDados('dimensoes', $_POST[dimensoes]);
			$patrimonio->SetDados('observacoes', $_POST[observacoes]);
			if($_GET[acao] != "editar") {
				$patrimonio->SalvarNovo();
				$strScrp = "Ajax('patrimonio/gerenciar', 'conteudo', '');";
			}
			$patrimonio->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['patrimony']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$patrimonio->LoadPatrimonio($_GET[codigo]);
		$row = $patrimonio->RetornaTodosDados();
	} else {
		$strLoCase = $LANG['patrimony']['including'];
		$row = $_POST;
		$row[nome] = $_POST[nom];
		if(!isset($_POST[codigo]) || $j == 0) {
			$row = "";
			$row[codigo] = next_autoindex('patrimonio');
		} else {
			$row[codigo] = $_POST[codigo];
		}
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="patrimonio/img/patrimonio.png" alt="<?=$LANG['patrimony']['manage_patrimony']?>"> <span class="h3"><?=$LANG['parimony']['manage_patrimony']?> [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?=$strLoCase?></td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="patrimonio/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?=$LANG['patrimony']['patrimony_information']?></span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?=$r[1]?>* <?=$LANG['patrimony']['code']?><br />
              <input name="codigo" value="<?=$row[codigo]?>" type="text" class="forms" id="codigo" /></td>
            <td><?=$LANG['patrimony']['sector']?><br />
              <input name="setor" value="<?=$row[setor]?>" type="text" class="forms" id="setor" /></td>
          </tr>
          <tr>
            <td width="287"><?=$r[3]?>* <?=$LANG['patrimony']['description']?><br />
                <label>
                  <input name="descricao" value="<?=$row[descricao]?>" type="text" class="forms" id="descricao" size="45" maxlength="150" />
                </label>
                <label></label></td>
            <td width="210"><?=$LANG['patrimony']['value']?><br />
              <input name="valor" type="text" class="forms" id="valor" value="<?=$row[valor]?>" onKeypress="return Ajusta_Valor(this, event);" /></td>
          </tr>
          <tr>
            <td><?=$LANG['patrimony']['acquisition_date']?> <br />
              <input name="dataaquisicao" value="<?=$row[dataaquisicao]?>" type="text" class="forms" id="dataaquisicao" maxlength="150" onKeypress="return Ajusta_Data(this, event);" /></td>
            <td><?=$LANG['patrimony']['warranty_time']?><br />
              <input name="tempogarantia" type="text" class="forms" id="tempogarantia" value="<?=$row[tempogarantia]?>" /></td>
          </tr>
          <tr>
            <td><?=$LANG['patrimony']['color']?><br />
                <input name="cor" value="<?=$row[cor]?>" type="text" class="forms" id="cor" size="15" maxlength="50" /></td>
            <td><?=$LANG['patrimony']['quantity']?><br />
                <input name="quantidade" value="<?=$row[quantidade]?>" type="text" class="forms" id="quantidade" /></td>
          </tr>
          <tr>
            <td><?=$LANG['patrimony']['supplier']?><br />
                <input name="fornecedor" value="<?=$row[fornecedor]?>" type="text" class="forms" id="fornecedor" size="30" maxlength="50" />
              <br /></td>
            <td><?=$LANG['patrimony']['legal_document']?> <br />
              <input name="numeronotafiscal" value="<?=$row[numeronotafiscal]?>" type="text" class="forms" id="numeronotafiscal" /></td>
          </tr>
          <tr>
            <td valign="top"><?=$LANG['patrimony']['dimensions']?><br />
              <input name="dimensoes" value="<?=$row[dimensoes]?>" type="text" class="forms" id="dimensoes" /></td>
            <td><?=$LANG['patrimony']['comments']?><br />
              <textarea name="observacoes" cols="25" rows="5" class="forms" id="observacoes"><?=$row[observacoes]?></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="<?=$LANG['patrimony']['save']?>" />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>