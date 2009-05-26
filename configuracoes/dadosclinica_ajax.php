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
	$clinica = new TClinica();
    $clinica->LoadInfo();
	if(isset($_POST['Salvar'])) {
        $_POST['cnpj'] = ajusta_cnpj($_POST['cnpj'], 1);
		$obrigatorios[1] = 'nomefantasia';
		$obrigatorios[] = 'proprietario';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
		if(strlen($_POST['cnpj']) <= 11) {
			$cpfbool = true;
		}
		if(strlen($_POST['cnpj']) > 11 && strlen($_POST['cnpj']) <= 14) {
			$cpfbool = false;
		}
		if($_POST['cnpj'] != "" && $cpfbool && !is_valid_cpf($_POST['cnpj'])) {
			$j++;
			$r[3] = '<font color="#FF0000">';
		}
		if($$_POST['cnpj'] != "" && !$cpfbool && !is_valid_cnpj($_POST['cnpj'])) {
			$j++;
			$r[3] = '<font color="#FF0000">';
		}
		if($j == 0) {
            $clinica->LoadInfo();
			$clinica->CNPJ = $_POST['cnpj'];
            $clinica->RazaoSocial = htmlspecialchars($_POST['razaosocial'], ENT_QUOTES);
            $clinica->Fantasia = htmlspecialchars($_POST['fantasia'], ENT_QUOTES);
            $clinica->Proprietario = htmlspecialchars($_POST['proprietario'], ENT_QUOTES);
            $clinica->Endereco = $_POST['endereco'];
            $clinica->Bairro = $_POST['bairro'];
            $clinica->Cidade = $_POST['cidade'];
            $clinica->Estado = $_POST['estado'];
            $clinica->Cep = $_POST['cep'];
            $clinica->Fundacao = $_POST['fundacao'];
            $clinica->Telefone1 = $_POST['telefone1'];
            $clinica->Telefone2 = $_POST['telefone2'];
            $clinica->Fax = $_POST['fax'];
            $clinica->Email = $_POST['email'];
            $clinica->Web = $_POST['web'];
            $clinica->Banco1 = $_POST['banco1'];
            $clinica->Agencia1 = $_POST['agencia1'];
            $clinica->Conta1 = $_POST['conta1'];
            $clinica->Banco2 = $_POST['banco2'];
            $clinica->Agencia2 = $_POST['agencia2'];
            $clinica->Conta2 = $_POST['conta2'];
			$clinica->Salvar();
			$strScrp = 'alert("Dados alterados com sucesso!"); Ajax(\'wallpapers/index\', \'conteudo\', \'\')';
		}
    }
	$strUpCase = "ALTERAÇÂO";
	$strLoCase = "alteração";
    if($j == 0) {
        $row = "";
    } else {
        $row = $_POST;
    }
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
	if(checknivel('Dentista') || checknivel('Funcionario')) {
		$disable = 'disabled';
	}
    if(strlen($clinica->CNPJ) == 11 || $clinica->CNPJ == '') {
        $cpf_cnpj = 'cpf';
        $clinica->CNPJ = ajusta_cpf($clinica->CNPJ, 2);
        $chk['cpfcnpj']['cpf'] = 'checked';
    } elseif(strlen($clinica->CNPJ) == 14) {
        $cpf_cnpj = 'cnpj';
        $clinica->CNPJ = ajusta_cnpj($clinica->CNPJ, 2);
        $chk['cpfcnpj']['cnpj'] = 'checked';
    }
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="configuracoes/img/clinica.png" alt="Dados da clínica"> <span class="h3">DADOS DA CLÍNICA [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?=$strUpCase?> DE DADOS </td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="configuracoes/dadosclinica_ajax.php" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es da Clínica </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287"><?=$r[1]?>* Nome Fantasia <br />
                <label>
                  <input name="fantasia" value="<?=$clinica->Fantasia?>" <?=$disable?> type="text" class="forms" id="fantasia" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><?=$r[3]?><input type="radio" name="cpfcnpj" <?=$disable?> value="cpf" <?=$chk['cpfcnpj']['cpf']?> onclick="document.getElementById('cpf_cnpj').value=this.value"> CPF&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="radio" name="cpfcnpj" <?=$disable?> value="cnpj" <?=$chk['cpfcnpj']['cnpj']?> onclick="document.getElementById('cpf_cnpj').value=this.value"> CNPJ
              <input type="hidden" name="cpf_cnpj" id="cpf_cnpj" value="<?=$cpf_cnpj?>"><br />
              <input name="cnpj" value="<?=$clinica->CNPJ?>" <?=$disable?> type="text" class="forms" id="cnpj" size="30" maxlength="18" onKeypress="return Ajusta_CPFCNPJ(this, event, document.getElementById('cpf_cnpj').value);" />
            </td>
          </tr>
          <tr>
            <td>Raz&atilde;o Social <br />
              <input name="razaosocial" value="<?=$clinica->RazaoSocial?>" <?=$disable?> type="text" class="forms" id="razaosocial" size="50" /></td>
            <td><?=$r[2]?>* Proprietário<br />
              <input name="proprietario" value="<?=$clinica->Proprietario?>" <?=$disable?> type="text" class="forms" id="proprietario" size="40" /></td>
          </tr>
          <tr>
            <td>Endere&ccedil;o<br />
              <input name="endereco" value="<?=$clinica->Endereco?>" <?=$disable?> type="text" class="forms" id="endereco" size="50" maxlength="150" /></td>
            <td>Bairro<br />
              <input name="bairro" value="<?=$clinica->Bairro?>" <?=$disable?> type="text" class="forms" id="bairro" /></td>
          </tr>
          <tr>
            <td>Cidade<br />
                <input name="cidade" value="<?=$clinica->Cidade?>" <?=$disable?> type="text" class="forms" id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td>Estado<br /><select name="estado" <?=$disable?> class="forms" id="estado">
<?
	$estados = array('AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
	foreach($estados as $uf) {
		if($clinica->Estado == $uf || ($clinica->Estado == '' && $uf == 'MG')) {
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
              <input name="cep" value="<?=$clinica->Cep?>" <?=$disable?> type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td>Ano de fundação<br />
              <input name="fundacao" value="<?=$clinica->Fundacao?>" <?=$disable?> type="text" class="forms" id="fundacao" maxlength="4" /></td>
          </tr>
          <tr>
            <td>Telefone 1 <br />
              <input name="telefone1" value="<?=$clinica->Telefone1?>" <?=$disable?> type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Telefone 2 <br />
              <input name="telefone2" value="<?=$clinica->Telefone2?>" <?=$disable?> type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>Fax <br />
              <input name="fax" value="<?=$clinica->Fax?>" <?=$disable?> type="text" class="forms" id="fax" size="25" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Web Site <br />
              <input name="web" value="<?=$clinica->Web?>" <?=$disable?> type="text" class="forms" id="web" size="40" /></td>
          </tr>
          <tr>
            <td>E-mail<br />
              <input name="email" value="<?=$clinica->Email?>" <?=$disable?> type="text" class="forms" id="email" size="40" /></td>
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
        <legend><span class="style1">Informa&ccedil;&otilde;es Bancárias </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287">Banco <br />
                <label>
                  <input name="banco1" value="<?=$clinica->Banco1?>" <?=$disable?> type="text" class="forms" id="banco1" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><br />
              </td>
          </tr>
          <tr>
            <td>Agência<br />
                <input name="agencia1" value="<?=$clinica->Agencia1?>" <?=$disable?> type="text" class="forms" id="agencia1" size="50" maxlength="100" /></td>
            <td>Conta<br />
                <input name="conta1" value="<?=$clinica->Conta1?>" <?=$disable?> type="text" class="forms" id="conta1" /></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287">Banco <br />
                <label>
                  <input name="banco2" value="<?=$clinica->Banco2?>" <?=$disable?> type="text" class="forms" id="banco2" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><br />
              </td>
          </tr>
          <tr>
            <td>Agência<br />
                <input name="agencia2" value="<?=$clinica->Agencia2?>" <?=$disable?> type="text" class="forms" id="agencia2" size="50" maxlength="100" /></td>
            <td>Conta<br />
                <input name="conta2" value="<?=$clinica->Conta2?>" <?=$disable?> type="text" class="forms" id="conta2" /></td>
          </tr>

          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <br />
		<fieldset>
        <legend><span class="style1">Logomarca da clínica </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="497" align="center">
                <iframe height="200" width="150" scrolling="No" name="foto_frame" id="foto_frame" src="configuracoes/logo.php" frameborder="0"></iframe>
            </td>
          </tr>
          <tr>
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
document.getElementById('fantasia').focus();
</script>
