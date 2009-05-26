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
	$funcionario = new TFuncionarios();
	if(isset($_POST[Salvar])) {	
        $_POST['cpf'] = ajusta_cpf($_POST['cpf'], 1);
		if($_POST[sosenha] == 'true') {
			if($_POST[senha] != '') {
				if($_POST[senha] != $_POST[confsenha]) {
					$j++;
					$r[29] = '<font color="#FF0000">';
					$r[30] = '<font color="#FF0000">';
				}
				$senha = mysql_fetch_array(mysql_query("SELECT * FROM `funcionarios` WHERE `cpf` = '".$_POST[cpf]."'"));
				if(md5($_POST[senhaatual]) != $senha[senha]) {
					$j++;
					$r[28] = '<font color="#FF0000">';
				}
			}
			if($j == 0) {
				$funcionario->LoadFuncionario($_GET[cpf]);
				$strScrp = "Ajax('funcionarios/gerenciar', 'conteudo', '');";	
				if($_POST[senha] != "") {
					$funcionario->SetDados('senha', md5($_POST[senha]));
				}
				$funcionario->Salvar();
			}
		} else {
			$obrigatorios[1] = 'nom';
			$obrigatorios[] = 'cpf';
			$obrigatorios[] = 'funcao1';
			$obrigatorios[] = 'login';
			$i = $j = 0;
			foreach($_POST as $post => $valor) {
				$i++;
				if(array_search($post, $obrigatorios) && $valor == "") {
				    $j++;
					$r[$i] = '<font color="#FF0000">';
				}
			}
			if($_GET[acao] != "editar" && !is_valid_cpf($_POST[cpf], 'funcionarios')) {
				$j++;
				$r[2] = '<font color="#FF0000">';
			}
			if($_POST[senha] != $_POST[confsenha] || $_POST[senha] == "" && $_GET[acao] != "editar") {
				$j++;
				$r[28] = '<font color="#FF0000"> *';
				$r[29] = '<font color="#FF0000"> *';
			}
			if($_POST[senha] != '' && $_GET[acao] == 'editar') {
				if($_POST[senha] != $_POST[confsenha]) {
					$j++;
					$r[29] = '<font color="#FF0000">';
					$r[30] = '<font color="#FF0000">';
				}
				$senha = mysql_fetch_array(mysql_query("SELECT * FROM `funcionarios` WHERE `cpf` = '".$_POST[cpf]."'"));
				if(md5($_POST[senhaatual]) != $senha[senha]) {
					$j++;
					$r[28] = '<font color="#FF0000">';
				}
			}
			if($j == 0) {
				if($_GET[acao] == "editar") {
					$funcionario->LoadFuncionario($_GET['cpf']);
					$strScrp = "Ajax('funcionarios/gerenciar', 'conteudo', '');";
				}
				$funcionario->SetDados('nome', htmlspecialchars($_POST[nom], ENT_QUOTES));
				$funcionario->SetDados('cpf', $_POST[cpf]);
				if($_POST[senha] != "") {
					$funcionario->SetDados('senha', md5($_POST[senha]));
				}
				$funcionario->SetDados('login', $_POST[login]);
				$funcionario->SetDados('rg', $_POST[rg]);
				$funcionario->SetDados('estadocivil', $_POST[estadocivil]);
				$funcionario->SetDados('endereco', $_POST[endereco]);
				$funcionario->SetDados('bairro', $_POST[bairro]);
				$funcionario->SetDados('cidade', $_POST[cidade]);
				$funcionario->SetDados('estado', $_POST[estado]);
				$funcionario->SetDados('cep', $_POST[cep]);
				$funcionario->SetDados('nascimento', converte_data($_POST[nascimento], 1));
				$funcionario->SetDados('telefone1', $_POST[telefone1]);
				$funcionario->SetDados('telefone2', $_POST[telefone2]);
				$funcionario->SetDados('celular', $_POST[celular]);
				$funcionario->SetDados('sexo', $_POST[sexo]);
				$funcionario->SetDados('email', $_POST[email]);
				$funcionario->SetDados('nomemae', $_POST[nomemae]);
				$funcionario->SetDados('nascimentomae', converte_data($_POST[nascimentomae], 1));
				$funcionario->SetDados('nomepai', $_POST[nomepai]);
				$funcionario->SetDados('nascimentopai', converte_data($_POST[nascimentopai], 1));
				$funcionario->SetDados('enderecofamiliar', $_POST[enderecofamiliar]);
				$funcionario->SetDados('funcao1', $_POST[funcao1]);
				$funcionario->SetDados('funcao2', $_POST[funcao2]);
				$funcionario->SetDados('admissao', converte_data($_POST[admissao], 1));
				$funcionario->SetDados('demissao', converte_data($_POST[demissao], 1));
				$funcionario->SetDados('observacoes', $_POST[observacoes]);
				$funcionario->SetDados('ativo', $_POST[ativo]);
				$funcionario->SetDados('usuario', $_POST[usuario]);
				if($_GET[acao] != "editar") {
					$funcionario->SalvarNovo();
					$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('funcionarios/gerenciar', 'conteudo', 'cpf=".$_POST['cpf']."&acao=editar');";
				}
				$funcionario->Salvar();
			}
		}
	}
	if($_GET[acao] == "editar") {
		$strUpCase = "ALTERAÇÂO";
		$strLoCase = "alteração";
		$frmActEdt = "?acao=editar&cpf=".$_GET[cpf];
		$funcionario->LoadFuncionario($_GET[cpf]);
		$row = $funcionario->RetornaTodosDados();
		$row[nascimento] = converte_data($row[nascimento], 2);
		$row[nascimentomae] = converte_data($row[nascimentomae], 2);
		$row[nascimentopai] = converte_data($row[nascimentopai], 2);
		$row[admissao] = converte_data($row[admissao], 2);
		$row[demissao] = converte_data($row[demissao], 2);
	} else {
		if(checknivel('Dentista') || checknivel('Funcionario')) {
			die('<script>alert(\''.substr($frase_adm, 12).'\'); Ajax(\'funcionarios/gerenciar\', \'conteudo\', \'\')</script>');
		}
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strUpCase = "INCLUSÂO";
		$strLoCase = "inclusão";
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
	if(checknivel('Dentista') || checknivel('Funcionario')) {
		$disable = 'disabled';
		$disable2 = $disable;
		if($row[cpf] == $_SESSION[cpf]) {
			$disable2 = '';
		}
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="funcionarios/img/funcionario.png" alt="Gerenciar Funcionários" width="21" height="31"> <span class="h3">GERENCIAR FUNCION&Aacute;RIOS [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?=$strUpCase?> DE FUNCION&Aacute;RIOS </td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="funcionarios/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es Pessoais</span></legend>
        <table width="592" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="280"><?=$r[1]?>* Nome<br />
                <label>
                  <input name="nom" value="<?=$row[nome]?>" <?=$disable?> type="text" class="forms" id="nom" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="156"><?=$r[2]?>* CPF<br />
<?
	if($_GET[acao] == "editar") {
?>
              <input name="cpf_anterior" disabled value="<?=ajusta_cpf($row[cpf], 2)?>" type="text" class="forms" id="cpf_anterior" maxlength="14"/>
              <input name="cpf" value="<?=ajusta_cpf($row[cpf], 2)?>" <?=$disable?> type="hidden" class="forms" id="cpf" maxlength="14"/>
<?
	} else {
?>
			  <input name="cpf" value="<?=ajusta_cpf($row[cpf], 2)?>" type="text" class="forms" id="cpf" maxlength="14" onKeypress="return Ajusta_CPF(this, event);" />
<?
	}
?>
            </td>
            <td width="156" rowspan="10" valign="top"><br />
    		<iframe height="300" scrolling="No" name="foto_frame" id="foto_frame" width="150" src="funcionarios/fotos.php?cpf=<?=$row[cpf]?><?=(($_GET[acao] != "editar")?'&disabled=yes':'')?>" frameborder="0"></iframe>
            </td>
   		  </tr>
          <tr>
            <td>RG<br />
              <input name="rg" value="<?=$row[rg]?>" <?=$disable?> type="text" class="forms" id="rg" /></td>
            <td>Estado Civil<br /><select name="estadocivil" <?=$disable?> class="forms" id="estadocivil">
<?
	$estados = array('Solteiro(a)', 'Casado(a)', 'Separado(a)', 'Divorciado(a)', 'Amasiado(a)', 'Viúvo(a)');
	foreach($estados as $uf) {
		if($row[estadocivil] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select></td>
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
			 </select>  </td>
          </tr>
          <tr>
            <td>CEP<br />
              <input name="cep" value="<?=$row[cep]?>" <?=$disable?> type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td>Nascimento<br />
              <input name="nascimento" value="<?=$row[nascimento]?>" <?=$disable?> type="text" class="forms" id="nascimento" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td>Telefone 1<br />
              <input name="telefone1" value="<?=$row[telefone1]?>" <?=$disable?> type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Telefone 2<br />
              <input name="telefone2" value="<?=$row[telefone2]?>" <?=$disable?> type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>Celular<br />
              <input name="celular" value="<?=$row[celular]?>" <?=$disable?> type="text" class="forms" id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Sexo<br /><select name="sexo" <?=$disable?> class="forms" id="sexo">
<?
	$estados = array('Masculino', 'Feminino');
	foreach($estados as $uf) {
		if($row[sexo] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select></td>
          </tr>
          <tr>
            <td>E-mail<br />
              <input name="email" value="<?=$row[email]?>" <?=$disable?> type="text" class="forms" id="email" size="50" /></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <br />
         <fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es Familiares </span></legend>

        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287">Nome da M&atilde;e <br />
                <label>
                <input name="nomemae" value="<?=$row[nomemae]?>" <?=$disable?> type="text" class="forms" id="nome_mae" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210">Nascimento<br />
                <input name="nascimentomae" value="<?=$row[nascimentomae]?>" <?=$disable?> type="text" class="forms" id="nascimento_mae" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td>Nome do Pai <br />
              <input name="nomepai" value="<?=$row[nomepai]?>" <?=$disable?> type="text" class="forms" id="nome_pai" size="50" maxlength="80" /></td>
            <td>Nascimento<br />
                <input name="nascimentopai" value="<?=$row[nascimentopai]?>" <?=$disable?> type="text" class="forms" id="nascimento_pai" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td colspan="2">Endere&ccedil;o Completo (caso seja diferente do pessoal) <br />
                <input name="enderecofamiliar" value="<?=$row[enderecofamiliar]?>" <?=$disable?> type="text" class="forms" id="endereco_familiar" size="78" maxlength="220" />                <br /></td>
            </tr>
        </table>
        </fieldset>

         <fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es Profissionais </span></legend>

        <table width="519" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="264"><?=$r[21]?>* Fun&ccedil;&atilde;o Exercida - Principal <br />
                <label>
                <input name="funcao1" value="<?=$row[funcao1]?>" <?=$disable?> type="text" class="forms" id="funcao1" size="40" maxlength="80" />
                </label>
                <br />
                <br />
                <label></label></td>
            <td width="255">Fun&ccedil;&atilde;o Exercida - Secund&aacute;ria <br />
              <label>
              <input name="funcao2" value="<?=$row[funcao2]?>" <?=$disable?> type="text" class="forms" id="funcao2" size="40" maxlength="80" />
              <br />
              <br />
              </label></td>
          </tr>
          <tr>
            <td><label>Data da Admiss&atilde;o <br />
                <input name="admissao" value="<?=$row[admissao]?>" <?=$disable?> type="text" class="forms" id="data_admissao" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />
                <br />
              </label></td>
            <td>Data da Demiss&atilde;o<br />
              <input name="demissao" value="<?=$row[demissao]?>" <?=$disable?> type="text" class="forms" id="data_demissao" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td><br />Observações<br />
              <label>
              <textarea name="observacoes" <?=$disable?> cols="25" rows="4"><?=$row[observacoes]?></textarea>
              </label></td>
            <td valign="top"><br />Ativo na clínica?<br />
              <label>
              <select name="ativo" <?=$disable?> class="forms" id="ativo">
<?
	$estados = array('Sim', 'Não');
	foreach($estados as $uf) {
		if($row[ativo] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select>
              </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>	
	    <br />
        <fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es de Acesso Pessoal </span></legend>
        <table width="287" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td><?=$r[27]?>Login <br />
              <input name="usuario" value="<?=$row[usuario]?>" <?=$disable?> type="text" class="forms" id="usuario" maxlength="15" />
              <br />
              <br /></td>
          </tr>
<?	
	$x = 28;
	if($disable == 'disabled' && $disable2 == '') {
		echo '<input type="hidden" name="sosenha" value="true">';
	}
	if($_GET[acao] == 'editar') {
		$nova = "Nova ";
?>
          <tr>
            <td width="287"><?=$r[28]?>Senha atual <br />
              <input name="senhaatual" value="" <?=$disable2?> type="password" class="forms" id="senhaatual" maxlength="32" /> 
              <br />
              <br />              </td>
          </tr>
<?
		$x++;
	}
?>
          <tr>
            <td><?=$r[$x]?><?=$nova?>Senha <br />
              <input name="senha" value="" <?=$disable2?> type="password" class="forms" id="senha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td><?=$r[($x+1)]?>Confirmação da <?=$nova?>Senha<br />
              <input name="confsenha" value="" <?=$disable2?> type="password" class="forms" id="confsenha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <div align="center"><br />
          <input name="Salvar" type="submit" <?=$disable2?> class="forms" id="Salvar" value="Salvar" />
        </div>
      </form>      </td>
    </tr>
    <tr>
      <td align="right">
        <img src="imagens/icones/imprimir.gif"> <a href="relatorios/funcionario.php?cpf=<?=$row['cpf']?>" target="_blank">Imprimir Ficha</a>&nbsp;
      </td>
    </tr>
  </table>
</div>
<script>
  document.getElementById('nom').focus();
</script>
