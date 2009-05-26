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
	$fornecedor = new TFornecedores();
	if(isset($_POST[Salvar])) {
        $_POST['cpf'] = ajusta_cnpj($_POST['cpf'], 1);
        //echo $_POST['cpf']; die();
		$obrigatorios[1] = 'nomefantasia';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
		if(strlen($_POST[cpf]) <= 11) {
			$cpfbool = true;
		}
		if(strlen($_POST[cpf]) > 11 && strlen($_POST[cpf]) <= 14) {
			$cpfbool = false;
		}
		if($_POST[cpf] != "" && $cpfbool && !is_valid_cpf($_POST[cpf], 'fornecedores')) {
			$j++;
			$r[2] = '<font color="#FF0000">';
		}
		if($_POST[cpf] != "" && !$cpfbool && !is_valid_cnpj($_POST[cpf], 'fornecedores')) {
			$j++;
			$r[2] = '<font color="#FF0000">';
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$fornecedor->LoadFornecedores($_GET[codigo]);
				$strScrp = "Ajax('fornecedores/gerenciar', 'conteudo', '');";
			}
			$fornecedor->SetDados('nomefantasia', htmlspecialchars($_POST[nomefantasia], ENT_QUOTES));
			$fornecedor->SetDados('cpf', $_POST[cpf]);
			$fornecedor->SetDados('razaosocial', $_POST[razaosocial]);
			$fornecedor->SetDados('atuacao', $_POST[atuacao]);
			$fornecedor->SetDados('endereco', $_POST[endereco]);
			$fornecedor->SetDados('bairro', $_POST[bairro]);
			$fornecedor->SetDados('cidade', $_POST[cidade]);
			$fornecedor->SetDados('estado', $_POST[estado]);
			$fornecedor->SetDados('cep', $_POST[cep]);
			$fornecedor->SetDados('celular', $_POST[celular]);
			$fornecedor->SetDados('telefone1', $_POST[telefone1]);
			$fornecedor->SetDados('telefone2', $_POST[telefone2]);
			$fornecedor->SetDados('inscricaoestadual', $_POST[inscricaoestadual]);
			$fornecedor->SetDados('website', $_POST[website]);
			$fornecedor->SetDados('email', $_POST[email]);
			$fornecedor->SetDados('nomerepresentante', $_POST[nomerepresentante]);
			$fornecedor->SetDados('apelidorepresentante', $_POST[apelidorepresentante]);
			$fornecedor->SetDados('emailrepresentante', $_POST[emailrepresentante]);
			$fornecedor->SetDados('celularrepresentante', $_POST[celularrepresentante]);
			$fornecedor->SetDados('telefone1representante', $_POST[telefone1representante]);
			$fornecedor->SetDados('telefone2representante', $_POST[telefone2representante]);
			$fornecedor->SetDados('banco', $_POST[banco]);
			$fornecedor->SetDados('agencia', $_POST[agencia]);
			$fornecedor->SetDados('conta', $_POST[conta]);
			$fornecedor->SetDados('favorecido', $_POST[favorecido]);
			if($_GET[acao] != "editar") {
				$fornecedor->SalvarNovo();
				$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('fornecedores/gerenciar', 'conteudo', '');";
			}
			$fornecedor->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strUpCase = "ALTERAÇÂO";
		$strLoCase = "alteração";
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$fornecedor->LoadFornecedores($_GET[codigo]);
		$row = $fornecedor->RetornaTodosDados();
		$row[nascimento] = converte_data($row[nascimento], 2);
		$row[nascimentomae] = converte_data($row[nascimentomae], 2);
		$row[nascimentopai] = converte_data($row[nascimentopai], 2);
		$row[admissao] = converte_data($row[admissao], 2);
		$row[demissao] = converte_data($row[demissao], 2);
		if(strlen($row['cpf']) == 11 || $row['cpf'] == '') {
            $cpf_cnpj = 'cpf';
            $row['cpf'] = ajusta_cpf($row['cpf'], 2);
            $chk['cpfcnpj']['cpf'] = 'checked';
		} elseif(strlen($row['cpf']) == 14) {
            $cpf_cnpj = 'cnpj';
            $row['cpf'] = ajusta_cnpj($row['cpf'], 2);
            $chk['cpfcnpj']['cnpj'] = 'checked';
		}
	} else {
		/*if(checknivel('Dentista') || checknivel('Funcionario')) {
			die('<script>alert(\''.substr($frase_adm, 12).'\'); Ajax(\'fornecedores/gerenciar\', \'conteudo\', \'\')</script>');
		}*/
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
		}
		$strUpCase = "INCLUSÂO";
		$strLoCase = "inclusão";
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
	/*if(checknivel('Dentista') || checknivel('Funcionario')) {
		$disable = 'disabled';
	}*/
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="fornecedores/img/fornecedores.png" alt="Gerenciar Dentistas"> <span class="h3">GERENCIAR FORNECEDORES [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?=$strUpCase?> DE FORNECEDORES </td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="fornecedores/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es do Fornecedor </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287"><?=$r[1]?>* Nome Fantasia <br />
                <label>
                  <input name="nomefantasia" value="<?=$row[nomefantasia]?>" <?=$disable?> type="text" class="forms" id="nomefantasia" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><?=$r[2]?><input type="radio" name="cpfcnpj" value="cpf" <?=$chk['cpfcnpj']['cpf']?> onclick="document.getElementById('cpf_cnpj').value=this.value"> CPF&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="radio" name="cpfcnpj" value="cnpj" <?=$chk['cpfcnpj']['cnpj']?> onclick="document.getElementById('cpf_cnpj').value=this.value"> CNPJ
              <input type="hidden" name="cpf_cnpj" id="cpf_cnpj" value="<?=$cpf_cnpj?>"><br />
              <input name="cpf" value="<?=$row[cpf]?>" <?=$disable?> type="text" class="forms" id="cpf" size="30" maxlength="18" onKeypress="return Ajusta_CPFCNPJ(this, event, document.getElementById('cpf_cnpj').value);" /></td>
          </tr>
          <tr>
            <td>Raz&atilde;o Social <br />
              <input name="razaosocial" value="<?=$row[razaosocial]?>" <?=$disable?> type="text" class="forms" id="razaosocial" size="50" /></td>
            <td>Atua&ccedil;&atilde;o<br />
              <input name="atuacao" value="<?=$row[atuacao]?>" <?=$disable?> type="text" class="forms" id="atuacao" size="40" /></td>
          </tr>
          <tr>
            <td>Endere&ccedil;o<br />
              <input name="endereco" value="<?=$row[endereco]?>" <?=$disable?> type="text" class="forms" id="endereco" size="50" maxlength="150" /></td>
            <td>Bairro<br />
              <input name="bairro" value="<?=$row[bairro]?>" <?=$disable?> type="text" class="forms" id="bairro" /></td>
          </tr>
          <tr>
            <td>Cidade<br />
                <input name="cidade" value="<?=$row[cidade]?>" <?=$disable?> type="text" class="forms" id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td>Estado<br /><select name="estado" <?=$disable?> class="forms" id="estado">
<?
	$estados = array('AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
	foreach($estados as $uf) {
		if($row[estado] == $uf || ($row[estado] == '' && $uf == 'MG')) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select>   </td>
          </tr>
          <tr>
            <td>CEP<br />
              <input name="cep" value="<?=$row[cep]?>" <?=$disable?> type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td>Celular<br />
              <input name="celular" value="<?=$row[celular]?>" <?=$disable?> type="text" class="forms" id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>Telefone 1 <br />
              <input name="telefone1" value="<?=$row[telefone1]?>" <?=$disable?> type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Telefone 2 <br />
              <input name="telefone2" value="<?=$row[telefone2]?>" <?=$disable?> type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>Inscri&ccedil;&atilde;o Estadual <br />
              <input name="inscricaoestadual" value="<?=$row[inscricaoestadual]?>" <?=$disable?> type="text" class="forms" id="ie" size="25" /></td>
            <td>Web Site <br />
              <input name="website" value="<?=$row[website]?>" <?=$disable?> type="text" class="forms" id="site" size="40" /></td>
          </tr>
          <tr>
            <td>E-mail<br />
              <input name="email" value="<?=$row[email]?>" <?=$disable?> type="text" class="forms" id="email" size="40" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <br />
		<fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es do Representante / Pessoa de Contato </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287">Nome do Representante / Pessoa de Contato <br />
                <label>
                  <input name="nomerepresentante" value="<?=$row[nomerepresentante]?>" <?=$disable?> type="text" class="forms" id="nome" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210">Apelido<br />
              <input name="apelidorepresentante" value="<?=$row[apelidorepresentante]?>" <?=$disable?> type="text" class="forms" id="apelido" /></td>
          </tr>
          <tr>
            <td>E-mail<br />
                <input name="emailrepresentante" value="<?=$row[emailrepresentante]?>" <?=$disable?> type="text" class="forms" id="email" size="50" maxlength="100" /></td>
            <td>Celular<br />
                <input name="celularrepresentante" value="<?=$row[celularrepresentante]?>" <?=$disable?> type="text" class="forms" id="celularrep" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>Telefone 1 <br />
                <input name="telefone1representante" value="<?=$row[telefone1representante]?>" <?=$disable?> type="text" class="forms" id="telefonerep" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Telefone 2 <br />
                <input name="telefone2representante" value="<?=$row[telefone2representante]?>" <?=$disable?> type="text" class="forms" id="telefone1rep" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <br />
		<fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es Bancárias </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287">Banco <br />
                <label>
                  <input name="banco" value="<?=$row['banco']?>" <?=$disable?> type="text" class="forms" id="banco" size="50" maxlength="50" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><br />
              </td>
          </tr>
          <tr>
            <td>Agência<br />
                <input name="agencia" value="<?=$row['agencia']?>" <?=$disable?> type="text" class="forms" id="agencia" size="50" maxlength="15" /></td>
            <td>Conta<br />
                <input name="conta" value="<?=$row['conta']?>" <?=$disable?> type="text" class="forms" id="conta" maxlength="15" /></td>
          </tr>
          <tr>
            <td width="287">Nome do favorecido <br />
                <label>
                  <input name="favorecido" value="<?=$row['favorecido']?>" <?=$disable?> type="text" class="forms" id="favorecido" size="50" maxlength="50" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><br />
              </td>
          </tr>

          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" <?=$disable?> class="forms" id="Salvar" value="Salvar" />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>
<script>
  document.getElementById('nomefantasia').focus();
</script>
