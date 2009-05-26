<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2008
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
    * http://www.smileprev.com/gco
    * smileprev@smileprev.com
    *
    * Ou envie sua carta para o endere�o:
    *
    * SmilePrev Cl�nicas Odontol�gicas
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
	$paciente = new TImplantodontia();
	if(isset($_POST['Salvar'])) {
		$paciente->LoadImplantodontia($_GET['codigo']);
		foreach($_POST as $chave => $valor) {
            if($chave != 'Salvar') {
                $paciente->SetDados($chave, $valor);
            }
		}
		$paciente->Salvar();
	}
	$frmActEdt = "?acao=editar&codigo=".$_GET['codigo'];
	$paciente->LoadImplantodontia($_GET['codigo']);
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET['codigo'], 'nome').' - '.$_GET['codigo'];
	$row = $paciente->RetornaTodosDados();
	$check = array('tratamento', 'enxerto');
	foreach($check as $campo) {
		if($row[$campo] == 'Sim') {
			$chk[$campo]['Sim'] = 'checked';
		} else {
			$chk[$campo]['N�o'] = 'checked';
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
      <td height="26">&nbsp;IMPLANTODONTIA </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/implantodontia_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="texto">
          <tr>
            <td width="50%">&nbsp;</td>
            <td width="50%">&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Paciente j� possui implante?
            </td>
            <td>
              <input name="tratamento" <?=$chk['tratamento']['Sim']?> type="radio" value="Sim" /> Sim
              <input name="tratamento" <?=$chk['tratamento']['N�o']?> type="radio" value="N�o" /> N�o
            </td>
          </tr>
          <tr>
            <td>
              Se j� possui, em quais regi�es:
            </td>
            <td>
              <input name="regioes" value="<?=$row['regioes']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Expectativa do paciente quanto ao tratamento de implante:
            </td>
            <td>
              <input name="expectativa" value="<?=$row['expectativa']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Quais as �reas que dever�o ser feitos os implantes:
            </td>
            <td>
              <input name="areas" value="<?=$row['areas']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Qual a marca e dimens�es dos implantes a serem utilizados:
            </td>
            <td>
              <input name="marca" value="<?=$row['marca']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              H� necessidade de enxerto na regi�o a ser implantada?
            </td>
            <td>
              <input name="enxerto" <?=$chk['enxerto']['Sim']?> type="radio" value="Sim" /> Sim
              <input name="enxerto" <?=$chk['enxerto']['N�o']?> type="radio" value="N�o" /> N�o
            </td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td>
              Qual o tipo de enxerto a ser realizado:
            </td>
            <td>
              <input name="tipoenxerto" value="<?=$row['tipoenxerto']?>" size="40" type="text" class="forms" />
            </td>
          </tr>
          <tr>
            <td>
              Observa��es Gerais:
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
