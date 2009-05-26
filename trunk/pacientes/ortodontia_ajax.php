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
	$paciente = new TOrtodontia();
	if(isset($_POST['Salvar'])) {
		$paciente->LoadOrtodontia($_GET['codigo']);
		foreach($_POST as $chave => $valor) {
            if($chave != 'Salvar') {
                $paciente->SetDados($chave, $valor);
            }
		}
		$paciente->Salvar();
	}
	$frmActEdt = "?acao=editar&codigo=".$_GET['codigo'];
	$paciente->LoadOrtodontia($_GET['codigo']);
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET['codigo'], 'nome').' - '.$_GET['codigo'];
	$row = $paciente->RetornaTodosDados();
	$check = array('tratamento');
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
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Pacientes"> <span class="h3">GERENCIAR PACIENTES &nbsp;[<?=$strLoCase?>] </span></td>
    </tr>
  </table>
<div class="conteudo" id="table dados">
<br />
<?include('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">

    <tr>
      <td height="26">&nbsp;ORTODONTIA </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/ortodontia_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="texto">
          <tr>
            <td width="50%">&nbsp;</td>
            <td width="50%">&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Já esteve sob tratamento ortodôntico anterior?
            </td>
            <td>
              <input name="tratamento" <?=$chk['tratamento']['Sim']?> type="radio" value="Sim" /> Sim
              <input name="tratamento" <?=$chk['tratamento']['Não']?> type="radio" value="Não" /> Não
            </td>
          </tr>
          <tr>
            <td>
              Previsão para o tratamento ortodôntico:
            </td>
            <td>
              <input name="previsao" value="<?=$row['previsao']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Quais as razões para o tratamento ortodôntico:
            </td>
            <td>
              <input name="razoes" value="<?=$row['razoes']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Grau de motivação do paciente:
            </td>
            <td>
              <input name="motivacao" value="<?=$row['motivacao']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Avaliação de perfil:
            </td>
            <td>
              <input name="perfil" value="<?=$row['perfil']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Simetria facial:
            </td>
            <td>
              <input name="simetria" value="<?=$row['simetria']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Qual a tipologia facial do paciente:
            </td>
            <td>
              <input name="tipologia" value="<?=$row['tipologia']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Qual a classe dentária:
            </td>
            <td>
              <input name="classe" value="<?=$row['classe']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Mordida cruzada:
            </td>
            <td>
              <input name="mordida" value="<?=$row['mordida']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Curva Spee:
            </td>
            <td>
              <input name="spee" value="<?=$row['spee']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Overbite:
            </td>
            <td>
              <input name="overbite" value="<?=$row['overbite']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Overjet:
            </td>
            <td>
              <input name="overjet" value="<?=$row['overjet']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Linha média:
            </td>
            <td>
              <input name="media" value="<?=$row['media']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Situação da ATM:
            </td>
            <td>
              <input name="atm" value="<?=$row['atm']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Análise Radiográfica:
            </td>
            <td colspan="3">
              <textarea name="radio" cols="40" rows="5" class="forms"><?=$row['radio']?></textarea>
            </td>
          </tr>
          <tr>
            <td>
              Análise de Modelo:
            </td>
            <td colspan="3">
              <textarea name="modelo" cols="40" rows="5" class="forms"><?=$row['modelo']?></textarea>
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Observações Gerais:
            </td>
            <td colspan="3">
              <textarea name="observacoes" cols="40" rows="5" class="forms"><?=$row['observacoes']?></textarea>
            </td>
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
