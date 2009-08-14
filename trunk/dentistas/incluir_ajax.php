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
	$dentista = new TDentistas();
	if(isset($_POST[Salvar])) {
		if ($_POST[sosenha] == 'true') {
			if($_POST[senha] != '') {
				if($_POST[senha] != $_POST[confsenha]) {
					$j++;
					$r[23] = '<font color="#FF0000">';
					$r[24] = '<font color="#FF0000">';
				}
				$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `codigo` = '".$_GET[codigo]."'"));
				if(md5($_POST[senhaatual]) != $senha[senha] && (checknivel('Dentista') || checknivel('Funcionario'))) {
					$j++;
					$r[22] = '<font color="#FF0000">';
				}
			}
			if($j == 0) {
				$dentista->LoadDentista($_GET[codigo]);
				$strScrp = "Ajax('dentistas/gerenciar', 'conteudo', '');";
				if($_POST[senha] != "") {
					$dentista->SetDados('senha', md5($_POST[senha]));
				}
				$dentista->Salvar();
			}
		} else {
			$obrigatorios[1] = 'nom';
			$i = $j = 0;
			foreach($_POST as $post => $valor) {
				$i++;
				if(array_search($post, $obrigatorios) && $valor == "") {
				    $j++;
					$r[$i] = '<font color="#FF0000">';
				}
			}
			if($_POST[senha] != $_POST[confsenha] || $_POST[senha] == "" && $_GET[acao] != "editar") {
				$j++;
				$r[22] = '<font color="#FF0000"> *';
				$r[23] = '<font color="#FF0000"> *';
			}
			if($_POST[senha] != '' && $_GET[acao] == 'editar') {
				if($_POST[senha] != $_POST[confsenha]) {
					$j++;
					$r[23] = '<font color="#FF0000">';
					$r[24] = '<font color="#FF0000">';
				}
				$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `codigo` = '".$_GET[codigo]."'"));
				if(md5($_POST[senhaatual]) != $senha[senha] && (checknivel('Dentista') || checknivel('Funcionario'))) {
					$j++;
					$r[22] = '<font color="#FF0000">';
				}
			}
			if($j == 0) {
				if($_GET[acao] == "editar") {
					$dentista->LoadDentista($_GET[codigo]);
					$strScrp = "Ajax('dentistas/gerenciar', 'conteudo', '');";
				}
				$dentista->SetDados('nome', htmlspecialchars($_POST[nom], ENT_QUOTES));
				$dentista->SetDados('cpf', $_POST[cpf]);
				if($_POST[senha] != "") {
					$dentista->SetDados('senha', md5($_POST[senha]));
				}
				$dentista->SetDados('endereco', $_POST[endereco]);
				$dentista->SetDados('bairro', $_POST[bairro]);
				$dentista->SetDados('cidade', $_POST[cidade]);
				$dentista->SetDados('estado', $_POST[estado]);
				$dentista->SetDados('pais', $_POST[pais]);
				$dentista->SetDados('cep', $_POST[cep]);
				$dentista->SetDados('nascimento', converte_data($_POST[nascimento], 1));
				$dentista->SetDados('telefone1', $_POST[telefone1]);
				$dentista->SetDados('celular', $_POST[celular]);
				$dentista->SetDados('telefone2', $_POST[telefone2]);
				$dentista->SetDados('sexo', $_POST[sexo]);
				$dentista->SetDados('nomemae', htmlspecialchars($_POST[nomemae], ENT_QUOTES));
				$dentista->SetDados('rg', $_POST[rg]);
				$dentista->SetDados('email', $_POST[email]);
				$dentista->SetDados('comissao', $_POST[comissao]);
				$dentista->SetDados('codigo_areaatuacao1', $_POST[codigo_areaatuacao1]);
				$dentista->SetDados('codigo_areaatuacao2', $_POST[codigo_areaatuacao2]);
				$dentista->SetDados('codigo_areaatuacao3', $_POST[codigo_areaatuacao3]);
				$dentista->SetDados('conselho_tipo', $_POST[conselho_tipo]);
				$dentista->SetDados('conselho_estado', $_POST[conselho_estado]);
				$dentista->SetDados('conselho_numero', $_POST[conselho_numero]);
				$dentista->SetDados('ativo', $_POST[ativo]);
				$dentista->SetDados('usuario', $_POST[usuario]);
				if($_GET[acao] != "editar") {
					$dentista->SalvarNovo();
					$_GET['codigo'] = mysql_insert_id();
				}
				$dentista->Salvar(); echo mysql_error();
                $strScrp = "Ajax('dentistas/gerenciar', 'conteudo', 'codigo=".$_GET['codigo']."&acao=editar');";
			}
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['professionals']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$dentista->LoadDentista($_GET[codigo]);
		$row = $dentista->RetornaTodosDados();
		$row[nascimento] = converte_data($row[nascimento], 2);
	} else {
		if(checknivel('Dentista') || checknivel('Funcionario')) {
			die('<script>alert(\''.substr($frase_adm, 12).'\'); Ajax(\'dentistas/gerenciar\', \'conteudo\', \'\')</script>');
		}
		if($j == 0) {
			$row = "";
			$r[21] = '*';
			$r[22] = '*';
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strLoCase = $LANG['professionals']['including'];
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
	if(checknivel('Dentista') || checknivel('Funcionario')) {
		$disable = 'disabled';
		$disable2 = $disable;
		if($row[codigo] == $_SESSION[codigo]) {
			$disable2 = '';
		}
	}
?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="dentistas/img/dentista.png" alt="<?=$LANG['professionals']['manage_professionals']?>" width="21" height="31"> <span class="h3"><?=$LANG['professionals']['manage_professionals']?> [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td height="23"><?=$strLoCase.' '.$LANG['professionals']['professional']?></td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="dentistas/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?=$LANG['professionals']['personal_information']?></span></legend>
        <table width="592" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="287"><?=$r[1]?>* <?=$LANG['professionals']['name']?><br />
                <label>
                  <input name="nom" value="<?=$row[nome]?>" <?=$disable?> type="text" class="forms" id="nom" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="156"><?=$r[2]?><?=$LANG['professionals']['document1']?><br />
              <input name="cpf" <?=$disable?> value="<?=$row[cpf]?>" type="text" class="forms" id="cpf" maxlength="50"/>
			</td>
            <td width="156" rowspan="10" valign="top"><br />
    		<iframe height="300" scrolling="No" width="150" name="foto_frame" id="foto_frame" src="dentistas/fotos.php?codigo=<?=$row[codigo]?><?=(($_GET[acao] != "editar")?'&disabled=yes':'')?>" frameborder="0"></iframe>
            </td>
          </tr>
<?
	if($_GET[acao] == "editar") {
		$msg = '<i>Preencher somente se for alterar</i>';
	}
?>
          <tr>
            <td><?=$LANG['professionals']['address1']?><br />
              <input name="endereco" value="<?=$row[endereco]?>" <?=$disable?> type="text" class="forms" id="endereco" size="50" maxlength="150" /></td>
            <td><?=$LANG['professionals']['address2']?><br />
              <input name="bairro" value="<?=$row[bairro]?>" <?=$disable?> type="text" class="forms" id="bairro" /></td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['city']?><br />
                <input name="cidade" value="<?=$row[cidade]?>" <?=$disable?> type="text" class="forms" id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td><?=$LANG['professionals']['state']?><br />
                <input name="estado" value="<?=$row[estado]?>" <?=$disable?> type="text" class="forms" id="estado" maxlength="50" />
            </td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['country']?><br />
                <input name="pais" value="<?=$row[pais]?>" <?=$disable?> type="text" class="forms" id="pais" size="30" maxlength="50" />
              <br /></td>
            <td>&nbsp;
            </td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['zip']?><br />
              <input name="cep" value="<?=$row[cep]?>" <?=$disable?> type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td><?=$LANG['professionals']['birthdate']?><br />
              <input name="nascimento" value="<?=$row[nascimento]?>" <?=$disable?> type="text" class="forms" id="nascimento" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['phone1']?><br />
              <input name="telefone1" value="<?=$row[telefone1]?>" <?=$disable?> type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td><?=$LANG['professionals']['cellphone']?><br />
              <input name="celular" value="<?=$row[celular]?>" <?=$disable?> type="text" class="forms" id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['phone2']?><br />
              <input name="telefone2" value="<?=$row[telefone2]?>" <?=$disable?> type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td><?=$LANG['professionals']['gender']?><br />
              <select name="sexo" <?=$disable?> class="forms" id="sexo">
<?
	$valores = array('Masculino' => $LANG['professionals']['male'], 'Feminino' => $LANG['professionals']['female']);
	foreach($valores as $chave => $valor) {
		if($row[sexo] == $chave) {
			echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
		} else {
			echo '<option value="'.$chave.'">'.$valor.'</option>';
		}
	}
?>       
			 </select></td>
          </tr>
          <tr>
            <td width="287"><?=$LANG['professionals']['parents_name']?><br />
                <label>
                  <input name="nomemae" value="<?=$row[nomemae]?>" <?=$disable?> type="text" class="forms" id="nomemae" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><?=$LANG['professionals']['document2']?><br />
              <input name="rg" value="<?=$row[rg]?>" <?=$disable?> type="text" class="forms" id="rg" maxlength="15"/></td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['email']?><br />
              <input name="email" value="<?=$row[email]?>" <?=$disable?> type="text" class="forms" id="email" size="50" /></td>
            <td><?=$LANG['professionals']['comission']?> (%)<br />
              <input name="comissao" value="<?=$row[comissao]?>" <?=$disable?> type="text" class="forms" id="comissao" onKeypress="return Ajusta_Valor(this, event);" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <br />
         <fieldset>
        <legend><span class="style1"><?=$LANG['professionals']['professional_informations']?></span></legend>
        <table width="287" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td width="287"><?=$LANG['professionals']['area_of_expertise_specialty_1']?><br />
                 <select name="codigo_areaatuacao1" <?=$disable?> class="forms" id="codigo_areaatuacao1">
                 <option></option>
<?
	$especialidades = new TEspecialidades();
	$lista = $especialidades->ListEspecialidades();
	for($i = 0; $i < count($lista); $i++) {
		if($lista[$i][codigo] == $row[codigo_areaatuacao1]) {
			echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][descricao].'</option>';
		} else {
			echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][descricao].'</option>';
		}
	}
?>
                 </select>
                 <br />
              <br />              </td>
            </tr>
          <tr>
            <td><?=$LANG['professionals']['area_of_expertise_specialty_2']?><br />
              <select name="codigo_areaatuacao2" <?=$disable?> class="forms" id="codigo_areaatuacao2">
                 <option></option>
<?
	$especialidades = new TEspecialidades();
	$lista = $especialidades->ListEspecialidades();
	for($i = 0; $i < count($lista); $i++) {
		if($lista[$i][codigo] == $row[codigo_areaatuacao2]) {
			echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][descricao].'</option>';
		} else {
			echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][descricao].'</option>';
		}
	}
?>
              </select>
              <br />
              <br /></td>
            </tr>
          <tr>
            <td><?=$LANG['professionals']['area_of_expertise_specialty_3']?><br />
              <select name="codigo_areaatuacao3" <?=$disable?> class="forms" id="codigo_areaatuacao3">
                 <option></option>
<?
	$especialidades = new TEspecialidades();
	$lista = $especialidades->ListEspecialidades();
	for($i = 0; $i < count($lista); $i++) {
		if($lista[$i][codigo] == $row[codigo_areaatuacao3]) {
			echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][descricao].'</option>';
		} else {
			echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][descricao].'</option>';
		}
	}
?>
              </select>
              <br />
              <br /></td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['professional_document']?><br />
                             <input name="conselho_tipo" value="<?=$row[conselho_tipo]?>" <?=$disable?> type="text" class="forms" size="5" maxlength="10" />&nbsp;
                             <input name="conselho_estado" value="<?=$row[conselho_estado]?>" <?=$disable?> type="text" class="forms" size="5" maxlength="2" />&nbsp;
                             <input name="conselho_numero" value="<?=$row[conselho_numero]?>" <?=$disable?> type="text" class="forms" size="15" maxlength="30" />
                             <br />
                             <br />
            </td>
          </tr>
          <tr>
            <td><?=$LANG['professionals']['professional_active_on_clinic']?><br />
                <select name="ativo" <?=$disable?> class="forms" id="ativo">
<?
	$valores = array('Sim' => $LANG['professionals']['yes'], 'Não' => $LANG['professionals']['no']);
	foreach($valores as $chave => $valor) {
		if($row[ativo] == $chave) {
			echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
		} else {
			echo '<option value="'.$chave.'">'.$valor.'</option>';
		}
	}
?>       
			 </select></tr>
          <tr>
            <td>&nbsp;</td>
            </tr>
        </table>
        </fieldset>
        <br />
         <fieldset>
        <legend><span class="style1"><?=$LANG['professionals']['persoanl_access_information']?> </span></legend>
        <table width="287" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td><?=$r[27]?>* <?=$LANG['professionals']['login']?> <br />
              <input name="usuario" value="<?=$row[usuario]?>" <?=$disable?> type="text" class="forms" id="usuario" maxlength="15" />
              <br />
              <br /></td>
          </tr>
<?	
	$x = 22;
	if($disable == 'disabled' && $disable2 == '') {
		echo '<input type="hidden" name="sosenha" value="true">';
	}
	if($_GET[acao] == 'editar' && (checknivel('Dentista') || checknivel('Funcionario'))) {
		$nova = "Nova ";
?>
          <tr>
            <td width="287"><?=$r[22]?><?=$LANG['professionals']['current_password']?> <br />
              <input name="senhaatual" value="" <?=$disable2?> type="password" class="forms" id="senhaatual" maxlength="32" /> 
              <br />
              <br />              </td>
          </tr>
<?
		$x++;
	}
?>
          <tr>
            <td><?=$r[$x]?><?=$LANG['professionals']['new_password']?> <br />
              <input name="senha" value="" <?=$disable2?> type="password" class="forms" id="senha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td><?=$r[($x+1)]?><?=$LANG['professionals']['retype_new_password']?><br />
              <input name="confsenha" value="" <?=$disable2?> type="password" class="forms" id="confsenha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <div align="center"><br>
          <input name="Salvar" type="submit" <?=$disable2?> class="forms" id="Salvar" value="<?=$LANG['professionals']['save']?>" />
        </div>
      </form>
      </td>
    </tr>
    <tr>
      <td align="right">
        <img src="imagens/icones/imprimir.gif"> <a href="relatorios/dentista.php?cpf_dentista=<?=$row['cpf']?>" target="_blank"><?=$LANG['professionals']['print_sheet']?></a>&nbsp;
      </td>
    </tr>
  </table>
<script>
document.getElementById('nom').focus();
</script>
