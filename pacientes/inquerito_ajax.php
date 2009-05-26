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
	$paciente = new TInquerito();
	if(isset($_POST[Salvar])) {	
		$paciente->LoadInquerito($_GET[codigo]);
		//$strScrp = "Ajax('pacientes/gerenciar', 'conteudo', '')";
		$paciente->SetDados('tratamento', $_POST[tratamento]);
		$paciente->SetDados('motivotrat', $_POST[motivotrat]);
		$paciente->SetDados('hospitalizado', $_POST[hospitalizado]);
		$paciente->SetDados('motivohosp', $_POST[motivohosp]);
		$paciente->SetDados('cardiovasculares', $_POST[cardiovasculares]);
		$paciente->SetDados('sanguineo', $_POST[sanguineo]);
		$paciente->SetDados('reumatico', $_POST[reumatico]);
		$paciente->SetDados('respiratorio', $_POST[respiratorio]);
		$paciente->SetDados('qualresp', $_POST[qualresp]);
		$paciente->SetDados('gastro', $_POST[gastro]);
		$paciente->SetDados('qualgastro', $_POST[qualgastro]);
		$paciente->SetDados('renal', $_POST[renal]);
		$paciente->SetDados('diabetico', $_POST[diabetico]);
		$paciente->SetDados('contagiosa', $_POST[contagiosa]);
		$paciente->SetDados('qualcont', $_POST[qualcont]);
		$paciente->SetDados('anestesia', $_POST[anestesia]);
		$paciente->SetDados('complicacoesanest', $_POST[complicacoesanest]);
		$paciente->SetDados('alergico', $_POST[alergico]);
		$paciente->SetDados('qualalergico', $_POST[qualalergico]);
		$paciente->SetDados('observacoes', $_POST[observacoes]);
		$paciente->Salvar();
	}
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$paciente->LoadInquerito($_GET[codigo]);
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$row = $paciente->RetornaTodosDados();
	$check = array('tratamento', 'hospitalizado', 'cardiovasculares', 'sanguineo', 'reumatico', 'respiratorio', 'gastro', 'renal', 'diabetico', 'contagiosa', 'anestesia', 'alergico');
	foreach($check as $campo) {
		if($row[$campo] == 'Sim') {
			$chk[$campo]['Sim'] = 'checked';
		} else {
			$chk[$campo]['Não'] = 'checked';
		}
	}
	$acao = '&acao=editar';
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
      <td height="26">&nbsp;INQU&Eacute;RITO DE SA&Uacute;DE </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/inquerito_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td width="282">&nbsp;</td>
            <td width="112">&nbsp;</td>
            <td width="86"><div align="right"></div></td>
            <td width="126">&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>Est&aacute; ou esteve sob tratamento m&eacute;dico ou cir&uacute;rgico?</td>
            <td><input name="tratamento" <?=$chk[tratamento]['Sim']?> type="radio" value="Sim" />
              Sim
                <input name="tratamento" <?=$chk[tratamento]['Não']?> type="radio" value="Não" />
            N&atilde;o</td>
            <td><div align="right">Motivo:&nbsp; </div></td>
            <td><input name="motivotrat" value="<?=$row[motivotrat]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td height="21">Esteve hospitalizado? </td>
            <td><input name="hospitalizado" <?=$chk[hospitalizado]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="hospitalizado" <?=$chk[hospitalizado]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right">Motivo:&nbsp; </div></td>
            <td><input name="motivohosp" value="<?=$row[motivohosp]?>" type="text" class="forms" /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>Sofre de dist&uacute;rbios cardiovasculares?</td>
            <td><input name="cardiovasculares" <?=$chk[cardiovasculares]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="cardiovasculares" <?=$chk[cardiovasculares]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Sofre de algum dist&uacute;rbio sangu&iacute;neo? </td>
            <td><input name="sanguineo" <?=$chk[sanguineo]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="sanguineo" <?=$chk[sanguineo]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>Apresenta hist&oacute;ria de febre reum&aacute;tica? </td>
            <td><input name="reumatico" <?=$chk[reumatico]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="reumatico" <?=$chk[reumatico]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Sofre de algum dist&uacute;rbio respirat&oacute;rio? </td>
            <td><input name="respiratorio" <?=$chk[respiratorio]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="respiratorio" <?=$chk[respiratorio]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right">Qual?&nbsp;</div></td>
            <td><input name="qualresp" value="<?=$row[qualresp]?>" type="text" class="forms" /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>Sofre de algum dist&uacute;rbio gastroinstestinal? </td>
            <td><input name="gastro" <?=$chk[gastro]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="gastro" <?=$chk[gastro]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right">Qual?&nbsp;</div></td>
            <td><input name="qualgastro" value="<?=$row[qualgastro]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td>Sofre de algum dist&uacute;rbio renal? </td>
            <td><input name="renal" <?=$chk[renal]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="renal" <?=$chk[renal]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>Diab&eacute;tico?</td>
            <td><input name="diabetico" <?=$chk[diabetico]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="diabetico" <?=$chk[diabetico]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Tem ou teve doen&ccedil;a infecto-contagiosa? </td>
            <td><input name="contagiosa" <?=$chk[contagiosa]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="contagiosa" <?=$chk[contagiosa]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right">Qual?&nbsp;</div></td>
            <td><input name="qualcont" value="<?=$row[qualcont]?>" type="text" class="forms" /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>Tomou anestesia dent&aacute;ria? </td>
            <td><input name="anestesia" <?=$chk[anestesia]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="anestesia" <?=$chk[anestesia]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right">Complica&ccedil;&otilde;es?&nbsp;</div></td>
            <td><input name="complicacoesanest" value="<?=$row[complicacoesanest]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td>&Eacute; al&eacute;rgico a algum medicamento? </td>
            <td><input name="alergico" <?=$chk[alergico]['Sim']?> type="radio" value="Sim" />
Sim
  <input name="alergico" <?=$chk[alergico]['Não']?> type="radio" value="Não" />
N&atilde;o</td>
            <td><div align="right">Qual?&nbsp;</div></td>
            <td><input name="qualalergico" value="<?=$row[qualalergico]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td>Outros/Observa&ccedil;&otilde;es:</td>
            <td colspan="3"><textarea name="observacoes" cols="40" rows="5" class="forms"><?=$row[observacoes]?></textarea></td>
          </tr>
        </table>
        </fieldset>
        <br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="Salvar" />
        </div>
      </form>      </td>
    </tr>
  </table>
