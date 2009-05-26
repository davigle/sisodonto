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
	$paciente = new TPacientes();
	if(isset($_POST['Salvar'])) {
        $_POST['tratamento'] = @implode(',', $_POST['tratamento']);
        $_POST['cpf'] = ajusta_cpf($_POST['cpf'], 1);
        $_POST['cpf_ant'] = ajusta_cpf($_POST['cpf_ant'], 1);
		$obrigatorios[1] = 'codigo';
		$obrigatorios[] = 'nom';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
				$r[$i] = '<font color="#FF0000">';
			    $j++;
			}
		}
		if(!is_valid_codigo($_POST[codigo]) && $_GET[acao] != "editar") {
			$j++;
			$r[1] = '<font color="#FF0000">';
        }
		if($_POST[cpf] != "" && !is_valid_cpf($_POST[cpf], 'pacientes') && $_POST[cpf_ant] != $_POST[cpf]) {
			$j++;
			$r[3] = '<font color="#FF0000">';
		}
		if($j === 0) {
			if($_GET[acao] == "editar") {
				$paciente->LoadPaciente($_POST[codigo]);
				$paciente->SalvarDentistaProcurado($_POST[codigo],$_POST[cpf_dentistaprocurado]);
				$strScrp = "Ajax('pacientes/gerenciar', 'conteudo', '')";
			}
			$paciente->SetDados('codigo', $_POST[codigo]);
			$paciente->SetDados('nome', htmlspecialchars(trim($_POST[nom]), ENT_QUOTES));
			$paciente->SetDados('cpf', $_POST[cpf]);
			$paciente->SetDados('rg', $_POST[rg]);
			$paciente->SetDados('estadocivil', $_POST[estadocivil]);
			$paciente->SetDados('sexo', $_POST[sexo]);
			$paciente->SetDados('etnia', $_POST[etnia]);
			$paciente->SetDados('profissao', $_POST[profissao]);
			$paciente->SetDados('naturalidade', $_POST[naturalidade]);
			$paciente->SetDados('nacionalidade', $_POST[nacionalidade]);
			$paciente->SetDados('nascimento', converte_data($_POST[nascimento], 1));
			$paciente->SetDados('endereco', $_POST[endereco]);
			$paciente->SetDados('bairro', $_POST[bairro]);
			$paciente->SetDados('cidade', $_POST[cidade]);
			$paciente->SetDados('estado', $_POST[estado]);
			$paciente->SetDados('cep', $_POST[cep]);
			$paciente->SetDados('celular', $_POST[celular]);
			$paciente->SetDados('telefone1', $_POST[telefone1]);
			$paciente->SetDados('telefone2', $_POST[telefone2]);
			$paciente->SetDados('hobby', $_POST[hobby]);
			$paciente->SetDados('indicadopor', $_POST[indicadopor]);
			$paciente->SetDados('email', $_POST[email]);
			$paciente->SetDados('obs_etiqueta', $_POST[obs_etiqueta]);
			$paciente->SetDados('tratamento', $_POST[tratamento]);
			$paciente->SetDados('cpf_dentistaprocurado', $_POST[cpf_dentistaprocurado]);
			$paciente->SetDados('cpf_dentistaatendido', $_POST[cpf_dentistaatendido]);
			$paciente->SetDados('cpf_dentistaencaminhado', $_POST[cpf_dentistaencaminhado]);
			$paciente->SetDados('nomemae', $_POST[nomemae]);
			$paciente->SetDados('nascimentomae', converte_data($_POST[nascimentomae], 1));
			$paciente->SetDados('profissaomae', $_POST[profissaomae]);
			$paciente->SetDados('nomepai', $_POST[nomepai]);
			$paciente->SetDados('nascimentopai', converte_data($_POST[nascimentopai], 1));
			$paciente->SetDados('profissaopai', $_POST[profissaopai]);
			$paciente->SetDados('telefone1pais', $_POST[telefone1pais]);
			$paciente->SetDados('telefone2pais', $_POST[telefone2pais]);
			$paciente->SetDados('enderecofamiliar', $_POST[enderecofamiliar]);
			$paciente->SetDados('datacadastro', converte_data($_POST[datacadastro], 1));
			$paciente->SetDados('dataatualizacao', date(Y.'-'.m.'-'.d));
			$paciente->SetDados('status', $_POST[status]);
			$paciente->SetDados('objetivo', $_POST[objetivo]);
			$paciente->SetDados('observacoes', $_POST[observacoes]);
			$paciente->SetDados('convenio', $_POST[convenio]);
			$paciente->SetDados('outros', $_POST[outros]);
			$paciente->SetDados('matricula', $_POST[matricula]);
			$paciente->SetDados('titular', $_POST[titular]);
			$paciente->SetDados('validadeconvenio', $_POST[validadeconvenio]);
			if($_GET[acao] != "editar") {
                $paciente->SalvarNovo();
				$objetivo = new TExObjetivo();
				$objetivo->SetDados('codigo_paciente', $_POST['codigo']);
				$objetivo->SalvarNovo();
				$objetivo = new TInquerito();
				$objetivo->SetDados('codigo_paciente', $_POST['codigo']);
				$objetivo->SalvarNovo();
				$objetivo = new TAtestado();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TReceita();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TExame();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TEncaminhamento();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TLaudo();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TAgradecimento();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('pacientes/gerenciar', 'conteudo', 'codigo=".$_POST[codigo]."&acao=editar')";
			}
			$paciente->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strUpCase = "ALTERAÇÂO";
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$paciente->LoadPaciente($_GET[codigo]);
		$row = $paciente->RetornaTodosDados();
		$row[nascimento] = converte_data($row[nascimento], 2);
		$row[nascimentomae] = converte_data($row[nascimentomae], 2);
		$row[nascimentopai] = converte_data($row[nascimentopai], 2);
		$row[datacadastro] = converte_data($row[datacadastro], 2);
		$row[cpf_ant] = $row[cpf];
		$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
		$acao = '&acao=editar';
	} else {
		$strUpCase = "INCLUSÂO";
		$strLoCase = "inclusão";
		$row = $_POST;
		$row[nome] = $_POST[nom];
		if(!isset($_POST[codigo]) || $j == 0) {
			$row = "";
			$row[codigo] = $paciente->ProximoCodigo();
		} else {
			$row[codigo] = $_POST[codigo];
		}
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />

  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Dentistas"> <span class="h3">GERENCIAR PACIENTES &nbsp;[<?=$strLoCase?>] </span></td>
    </tr>
  </table>
<div class="conteudo" id="table dados">
<br />
<?include('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26"><?=$strUpCase?> DE PACIENTES </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td width="602">
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend>Informa&ccedil;&otilde;es Pessoais</legend>
        <table width="570" border="0" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td><?=$r[1]?>* N&uacute;mero do Paciente (ficha cl&iacute;nica)<br />
<?
	if($_GET[acao] == "editar") {
?>
              <input disabled value="<?=$row[codigo]?>" type="text" class="forms" id="codigo"<?/* onblur="javascript:foto_frame.location.href='pacientes/fotos.php?codigo='%2Bthis.value"*/?> />
              <input name="codigo" value="<?=$row[codigo]?>" type="hidden" class="forms" id="codigo"<?/* onblur="javascript:foto_frame.location.href='pacientes/fotos.php?codigo='%2Bthis.value"*/?> />
<?
    } else {
?>
              <input name="codigo" value="<?=$row[codigo]?>" type="text" class="forms" id="codigo"<?/* onblur="javascript:foto_frame.location.href='pacientes/fotos.php?codigo='%2Bthis.value"*/?> />
<?
    }
?>
            </td>
            <td>&nbsp;</td>
            <td width="150" rowspan="13" valign="top"><br />
            <iframe height="300" scrolling="No" width="150" name="foto_frame" id="foto_frame" src="pacientes/fotos.php?codigo=<?=$row[codigo]?><?=(($_GET[acao] != "editar")?'&disabled=yes':'')?>" frameborder="0"></iframe>
            </td>
          </tr>
          <tr>
            <td width="290"><?=$r[2]?>* Nome<br />
                <label>
                  <input name="nom" value="<?=$row[nome]?>" type="text" class="forms" id="nom" size="50" maxlength="80" />
                </label>
                <br />
            <label></label></td>
            <td width="130"><?=$r[3]?>CPF<br />
              <input name="cpf" value="<?=ajusta_cpf($row['cpf'], 2)?>" type="text" class="forms" id="cpf" maxlength="14" onKeypress="return Ajusta_CPF(this, event);" />
            <input name="cpf_ant" value="<?=ajusta_cpf($row['cpf_ant'], 2)?>" type="hidden" class="forms" id="cpf_ant" /></td>
          </tr>
          <tr>
            <td>RG<br />
              <input name="rg" value="<?=$row[rg]?>" type="text" class="forms" id="rg" /></td>
            <td>Estado Civil<br /><select name="estadocivil" class="forms" id="estadocivil">
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
			 </select>            </td>
          </tr>
          <tr>
            <td>Sexo<br />
                <select name="sexo" class="forms" id="sexo">
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
			 </select> </td>
            <td>Etnia<br /><select name="etnia" class="forms" id="etnia">
<?
	$estados = array('Branco', 'Moreno', 'Negro', 'Pardo', 'Amarelo');
	foreach($estados as $uf) {
		if($row[etnia] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select>            </td>
          </tr>
          <tr>
            <td>Profiss&atilde;o<br />
              <input name="profissao" value="<?=$row[profissao]?>" type="text" class="forms" id="profissao" /></td>
            <td>Naturalidade<br />
              <input name="naturalidade" value="<?=$row[naturalidade]?>" type="text" class="forms" id="naturalidade" /></td>
          </tr>
          <tr>
            <td>Nacionalidade<br />
              <input name="nacionalidade" value="<?=$row[nacionalidade]?>" type="text" class="forms" id="nacionalidade" /></td>
            <td>Nascimento<br />
              <input name="nascimento" value="<?=$row[nascimento]?>" type="text" class="forms" id="nascimento" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td>Endere&ccedil;o<br />
              <input name="endereco" value="<?=$row[endereco]?>" type="text" class="forms" id="endereco" size="50" maxlength="150" /></td>
            <td>Bairro<br />
              <input name="bairro" value="<?=$row[bairro]?>" type="text" class="forms" id="bairro" /></td>
          </tr>
          <tr>
            <td>Cidade<br />
                <input name="cidade" value="<?=$row[cidade]?>" type="text" class="forms" id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td>Estado<br /><select name="estado" class="forms" id="estado">
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
			 </select>		    </td>
          </tr>
          <tr>
            <td>CEP<br />
              <input name="cep" value="<?=$row[cep]?>" type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td>Celular<br />
              <input name="celular" value="<?=$row[celular]?>" type="text" class="forms" id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>Telefone Residencial <br />
              <input name="telefone1" value="<?=$row[telefone1]?>" type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Telefone Comercial <br />
              <input name="telefone2" value="<?=$row[telefone2]?>" type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>Hobby<br />
              <input name="hobby" value="<?=$row[hobby]?>" type="text" class="forms" id="hobby" size="50" /></td>
            <td>Indicado por <br />
              <input name="indicadopor" value="<?=$row[indicadopor]?>" type="text" class="forms" id="indicacao" /></td>
          </tr>
          <tr>
            <td>E-mail<br />
              <input name="email" value="<?=$row[email]?>" type="text" class="forms" id="email" size="50" /></td>
            <td>Observações <br />
              <input name="obs_etiqueta" value="<?=$row[obs_etiqueta]?>" type="text" class="forms" id="obs_etiqueta" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <br /> <fieldset>
        <legend><span class="style1">Tratamentos a executar / executados </span></legend>

        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input name="tratamento[]" value="Ortodontia" <?=((strpos($row[tratamento], 'Ortodontia')!== false)?'checked':'')?> type="checkbox" id="tra1" /><label for="tra1"> Ortodontia</label></td>
            <td><input name="tratamento[]" value="Implantodontia" <?=((strpos($row[tratamento], 'Implantodontia')!== false)?'checked':'')?> type="checkbox" id="tra2" /><label for="tra2"> Implantodontia</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="Dentística" <?=((strpos($row[tratamento], 'Dentística')!== false)?'checked':'')?> type="checkbox" id="tra3" /><label for="tra3"> Dentística</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="Prótese" <?=((strpos($row[tratamento], 'Prótese')!== false)?'checked':'')?> type="checkbox" id="tra4" /><label for="tra4"> Prótese</label><br /></td>
          </tr>
          <tr>
            <td><input name="tratamento[]" value="Odontopediatria" <?=((strpos($row[tratamento], 'Odontopediatria')!== false)?'checked':'')?> type="checkbox" id="tra5" /><label for="tra5"> Odontopediatria</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="Cirurgia" <?=((strpos($row[tratamento], 'Cirurgia')!== false)?'checked':'')?> type="checkbox" id="tra6" /><label for="tra6"> Cirurgia</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="Endodontia" <?=((strpos($row[tratamento], 'Endodontia')!== false)?'checked':'')?> type="checkbox" id="tra7" /><label for="tra7"> Endodontia</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="Periodontia" <?=((strpos($row[tratamento], 'Periodontia')!== false)?'checked':'')?> type="checkbox" id="tra8" /><label for="tra8"> Periodontia</label>&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td><input name="tratamento[]" value="Radiologia" <?=((strpos($row[tratamento], 'Radiologia')!== false)?'checked':'')?> type="checkbox" id="tra9" /><label for="tra9"> Radiologia</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="DTM" <?=((strpos($row[tratamento], 'DTM')!== false)?'checked':'')?> type="checkbox" id="tra10" /><label for="tra10"> DTM</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="Odontogeriatria" <?=((strpos($row[tratamento], 'Odontogeriatria')!== false)?'checked':'')?> type="checkbox" id="tra11" /><label for="tra11"> Odontogeriatria</label>&nbsp;&nbsp;</td>
            <td><input name="tratamento[]" value="Ortopedia" <?=((strpos($row[tratamento], 'Ortopedia')!== false)?'checked':'')?> type="checkbox" id="tra12" /><label for="tra12"> Ortopedia</label>&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
         <br />
        <fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es do Dentista </span></legend>

        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="486">Dentista procurado <br />
                <label><select name="cpf_dentistaprocurado" class="forms" id="cpf_dentistaprocurado">
                <option>Selecionar...</option>
<?
	$dentista = new TDentistas();
	$lista = $dentista->ListDentistas();
	for($i = 0; $i < count($lista); $i++) {
		/*if($row[cpf_dentistaprocurado] == $lista[$i][cpf]) {
			echo '<option value="'.$lista[$i][cpf].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].' ('.(($lista[$i][ativo] == 'Sim')?'Ativ':'Inativ').(($lista[$i][titulo] == 'Dr.')?'o':'a').')</option>';
		} else {*/
			echo '<option value="'.$lista[$i][cpf].'">'.$lista[$i][titulo].' '.$lista[$i][nome].' ('.(($lista[$i][ativo] == 'Sim')?'Ativ':'Inativ').(($lista[$i][titulo] == 'Dr.')?'o':'a').')</option>';
		//}
	}
?>
			 </select>
                </label>
                <br />
                <br />
                <ul>
               	<? if ($_GET[codigo] <> "") {	
                    $sql = "SELECT cod_paciente, nome FROM dentista_procurado dp, dentistas d where d.cpf = dp.cpf_dentista and dp.cod_paciente = ".$_GET[codigo];

			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				?>
                <li><?=$row[nome]?></li><?
			}
			}
                ?>   
			</td>
            <td width="11">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><br /></td>
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
            <td>Nome do Pai <br />
                <input name="nomepai" value="<?=$row[nomepai]?>" type="text" class="forms" id="nomepai" size="50" maxlength="80" /></td>
            <td>Nascimento<br />
                <input name="nascimentopai" value="<?=$row[nascimentopai]?>" type="text" class="forms" id="nascimentopai" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td>Profissão do Pai <br />
                <input name="profissaopai" value="<?=$row[profissaopai]?>" type="text" class="forms" id="profissaopai" size="50" maxlength="80" /></td>
            <td>Telefone<br />
                <input name="telefone1pais" value="<?=$row[telefone1pais]?>" type="text" class="forms" id="telefone1pais" size="20" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td width="287"><br />Nome da M&atilde;e <br />
                <label>
                <input name="nomemae" value="<?=$row[nomemae]?>" type="text" class="forms" id="nomemae" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><br />Nascimento<br />
                <input name="nascimentomae" value="<?=$row[nascimentomae]?>" type="text" class="forms" id="nascimentomae" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td>Profissão da Mãe <br />
                <input name="profissaomae" value="<?=$row[profissaomae]?>" type="text" class="forms" id="profissaomae" size="50" maxlength="80" /></td>
            <td>Telefone<br />
                <input name="telefone2pais" value="<?=$row[telefone2pais]?>" type="text" class="forms" id="telefone2pais" size="20" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td colspan="2"><br />Endere&ccedil;o Completo (caso seja diferente do pessoal) <br />
                <input name="enderecofamiliar" value="<?=$row[enderecofamiliar]?>" type="text" class="forms" id="endereco_familiar" size="78" maxlength="220" />                <br /></td>
          </tr>
        </table>
        </fieldset>
        <br />
        <fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es Extras </span></legend>

        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>

          <tr>
            <td width="287">Data de cadastro  <br />
                <label></label>
<?
	if($_GET[acao] == "editar") {
?>
                <input name="datacad" disabled value="<?=$row[datacadastro]?>" type="text" class="forms" id="datacad" size="20" maxlength="10" />
                <input name="datacadastro" value="<?=$row[datacadastro]?>" type="hidden" id="datacadastro" />
<?
	} else {
?>
                <input name="datacadastro" value="<?=date(d.'/'.m.'/'.Y)?>" type="text" class="forms" id="datacadastro" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />
                <input name="datacad" value="" type="hidden" id="datacad" />
<?
	}
?>
                <br />
                <br />
                <label></label></td>
            <td width="210">Última atualização  <br />
                <label></label>
                <input name="dataatua" disabled value="<?=converte_data($row[dataatualizacao], 2)?>" type="text" class="forms" id="dataatua" size="20" />
                <input name="dataatualizacao" value="<?=converte_data($row[dataatualizacao], 2)?>" type="hidden" id="dataatualizacao" />
                <br />
                <br />
                <label></label></td>
          </tr>
          <tr>
            <td width="287">Situa&ccedil;&atilde;o atual do paciente <br />
              <label><select name="status" class="forms" id="status">
<?
	$estados = array('Avaliação', 'Em tratamento', 'Em revisão', 'Concluído');
	foreach($estados as $uf) {
		if($row[status] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select> 
              <br />
              <br />
              </label></td>
            <td width="210"></td>
          </tr>
          <tr>
            <td>Objetivo Principal da consulta<br />
              <label>
              <textarea name="objetivo" cols="25" rows="4"><?=$row[objetivo]?></textarea>
              </label></td>
            <td>Observações<br />
              <label>
              <textarea name="observacoes" cols="25" rows="4"><?=$row[observacoes]?></textarea>
              </label></td>
          </tr>
          <tr>
            <td><label></label></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>

         <fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es do Conv&ecirc;nio/Plano </span></legend>

        <table width="519" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="264">Convênio/Plano <br />
                <label></label><select name="convenio" class="forms" id="convenio">
<?
	$estados = array('Rede SmilePrev', 'Particular', 'Outros');
	foreach($estados as $uf) {
		if($row[convenio] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select> 
              <label><br />
              <br />
              </label></td>
            <td width="255">Outros - especificar <br />
              <label>
              <input name="outros" value="<?=$row[outros]?>" type="text" class="forms" id="outros" size="40" maxlength="80" />
              <br />
              <br />
              </label></td>
          </tr>
          <tr>
            <td><label>N&uacute;mero do cart&atilde;o (matr&iacute;cula) <br />
                <input name="matricula" value="<?=$row[matricula]?>" type="text" class="forms" id="matricula" size="20" />
                <br />
              </label></td>
            <td>Titular<br />
              <input name="titular" value="<?=$row[titular]?>" type="text" class="forms" id="titular" size="40" /></td>
          </tr>
          <tr>
            <td><br />Validade do Convênio/Plano <br />
                <input name="validadeconvenio" value="<?=$row[validadeconvenio]?>" type="text" class="forms" id="validadeconvenio" size="20" />
                <br /></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>	
	
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="Salvar" />
        </div>
      </form>      </td>
    </tr>
    <tr>
      <td align="right">
        <img src="imagens/icones/imprimir.gif"> <a href="relatorios/paciente.php?codigo=<?=$row['codigo']?>" target="_blank">Imprimir Ficha</a>&nbsp;
      </td>
    </tr>
  </table>
<script>
document.getElementById('nom').focus();
</script>
