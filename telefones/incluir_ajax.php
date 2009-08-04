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
		die($frase_log);
	}
	$telefones = new TTelefones();
	if(isset($_POST[Salvar])) { 
		$obrigatorios[1] = 'nom';
		$obrigatorios[] = 'telefone1';
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
				$telefones->LoadTelefones($_GET[codigo]);
			}
			$telefones->SetDados('nome', htmlspecialchars($_POST[nom], ENT_QUOTES));
			$telefones->SetDados('endereco', $_POST[endereco]);
			$telefones->SetDados('bairro', $_POST[bairro]);
			$telefones->SetDados('cidade', $_POST[cidade]);
			$telefones->SetDados('estado', $_POST[estado]);
			$telefones->SetDados('pais', $_POST[pais]);
			$telefones->SetDados('cep', $_POST[cep]);
			$telefones->SetDados('celular', $_POST[celular]);
			$telefones->SetDados('telefone1', $_POST[telefone1]);
			$telefones->SetDados('telefone2', $_POST[telefone2]);
			$telefones->SetDados('website', $_POST[website]);
			$telefones->SetDados('email', $_POST[email]);
			if($_GET[acao] != "editar") {
				$telefones->SalvarNovo();
				//$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('telefones/incluir', 'conteudo', '');";
			}
			$strScrp = "Ajax('telefones/gerenciar', 'conteudo', '');";
			$telefones->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['useful_telephones']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$telefones->LoadTelefones($_GET[codigo]);
		$row = $telefones->RetornaTodosDados();
	} else {		
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strLoCase = $LANG['useful_telephones']['including'];
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="telefones/img/telefones.png" alt="TELEFONES ÚTEIS"> <span class="h3"><?=$LANG['useful_telephones']['useful_telephones']?> [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?=$strLoCase.' '.$LANG['useful_telephones']['contatc']?> </td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="telefones/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?=$LANG['useful_telephones']['contact_information']?></span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287"><?=$r[1]?>* <?=$LANG['useful_telephones']['name']?> <br />
                <label>
                  <input name="nom" value="<?=$row[nome]?>" type="text" class="forms" id="nom" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"></td>
          </tr>
          <tr>
            <td><?=$LANG['useful_telephones']['address1']?><br />
              <input name="endereco" value="<?=$row[endereco]?>" type="text" class="forms" id="endereco" size="50" maxlength="150" /></td>
            <td><?=$LANG['useful_telephones']['address2']?><br />
              <input name="bairro" value="<?=$row[bairro]?>" type="text" class="forms" id="bairro" /></td>
          </tr>
          <tr>
            <td><?=$LANG['useful_telephones']['city']?><br />
                <input name="cidade" value="<?=$row[cidade]?>" <?=$disable?> type="text" class="forms" id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td><?=$LANG['useful_telephones']['state']?><br />
                <input name="estado" value="<?=$row[estado]?>" <?=$disable?> type="text" class="forms" id="estado" maxlength="50" />
            </td>
          </tr>
          <tr>
            <td><?=$LANG['useful_telephones']['country']?><br />
                <input name="pais" value="<?=$row[pais]?>" <?=$disable?> type="text" class="forms" id="pais" size="30" maxlength="50" />
              <br /></td>
            <td>&nbsp;
            </td>
          </tr>
          <tr>
            <td><?=$LANG['useful_telephones']['zip']?><br />
              <input name="cep" value="<?=$row[cep]?>" type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td><?=$LANG['useful_telephones']['cellphone']?><br />
              <input name="celular" value="<?=$row[celular]?>" type="text" class="forms" id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td><?=$r[8]?>* <?=$LANG['useful_telephones']['phone1']?><br />
              <input name="telefone1" value="<?=$row[telefone1]?>" type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td><?=$LANG['useful_telephones']['phone2']?><br />
              <input name="telefone2" value="<?=$row[telefone2]?>" type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td><?=$LANG['useful_telephones']['email']?><br />
              <input name="email" value="<?=$row[email]?>" type="text" class="forms" id="email" size="40" /></td>
            <td><?=$LANG['useful_telephones']['website']?> <br />
              <input name="website" value="<?=$row[website]?>" type="text" class="forms" id="site" size="40" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="<?=$LANG['useful_telephones']['save']?>" />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>
<script>
  document.getElementById('nom').focus();
</script>
