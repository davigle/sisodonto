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
	$paciente = new TExObjetivo();
	if(isset($_POST[Salvar])) {	
		$paciente->LoadExObjetivo($_GET[codigo]);
		//$strScrp = "Ajax('pacientes/objetivos', 'conteudo', '')";
		$paciente->SetDados('pressao', $_POST[pressao]);
		$paciente->SetDados('peso', $_POST[peso]);
		$paciente->SetDados('altura', $_POST[altura]);
		$paciente->SetDados('edema', $_POST[edema]);
		$paciente->SetDados('face', $_POST[face]);
		$paciente->SetDados('atm', $_POST[atm]);
		$paciente->SetDados('linfonodos', $_POST[linfonodos]);
		$paciente->SetDados('labio', $_POST[labio]);
		$paciente->SetDados('mucosa', $_POST[mucosa]);
		$paciente->SetDados('soalhobucal', $_POST[soalhobucal]);
		$paciente->SetDados('palato', $_POST[palato]);
		$paciente->SetDados('orofaringe', $_POST[orofaringe]);
		$paciente->SetDados('lingua', $_POST[lingua]);
		$paciente->SetDados('gengiva', $_POST[gengiva]);
		$paciente->SetDados('higienebucal', $_POST[higienebucal]);
		$paciente->SetDados('habitosnocivos', $_POST[habitosnocivos]);
		$paciente->SetDados('aparelho', $_POST[aparelho]);
		$paciente->SetDados('lesaointra', $_POST[lesaointra]);
		$paciente->SetDados('observacoes', $_POST[observacoes]);
		$paciente->Salvar();
	}
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$paciente->LoadExObjetivo($_GET[codigo]);
	$row = $paciente->RetornaTodosDados();
	if($row[aparelho] == 'Sim') {
		$chk[aparelho][sim] = 'checked';
	} else {
		$chk[aparelho][nao] = 'checked';
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
      <td height="26">&nbsp;EXAME OBJETIVO </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/objetivo_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td width="118">&nbsp;</td>
            <td width="184">&nbsp;</td>
            <td width="159">&nbsp;</td>
            <td width="145"><div align="right"></div></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="24">Press&atilde;o            </td>
            <td><input name="pressao" value="<?=$row[pressao]?>" type="text" class="forms" /></td>
            <td>Soalho Bucal </td>
            <td><input name="soalhobucal" value="<?=$row[soalhobucal]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td height="24">Peso            </td>
            <td><input name="peso" value="<?=$row[peso]?>" type="text" class="forms" /></td>
            <td>Palato</td>
            <td><input name="palato" value="<?=$row[palato]?>" type="text" class="forms" /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="24">Altura</td>
            <td><input name="altura" value="<?=$row[altura]?>" type="text" class="forms" /></td>
            <td>Orofaringe</td>
            <td><input name="orofaringe" value="<?=$row[orofaringe]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td height="24">Edema</td>
            <td><input name="edema" value="<?=$row[edema]?>" type="text" class="forms" /></td>
            <td>L&iacute;ngua</td>
            <td><input name="lingua" value="<?=$row[lingua]?>" type="text" class="forms" /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="23">Face</td>
            <td><input name="face" value="<?=$row[face]?>" type="text" class="forms" /></td>
            <td>Gengiva</td>
            <td><input name="gengiva" value="<?=$row[gengiva]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td height="28">ATM</td>
            <td><input name="atm" value="<?=$row[atm]?>" type="text" class="forms" /></td>
            <td>Higiene Bucal </td>
            <td><input name="higienebucal" value="<?=$row[higienebucal]?>" type="text" class="forms" /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="23">Linfonodos</td>
            <td><input name="linfonodos" value="<?=$row[linfonodos]?>" type="text" class="forms" /></td>
            <td>H&aacute;bitos Nocivos </td>
            <td><input name="habitosnocivos" value="<?=$row[habitosnocivos]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td>L&aacute;bio</td>
            <td><input name="labio" value="<?=$row[labio]?>" type="text" class="forms" /></td>
            <td>Portador de aparelho prot&eacute;tico ou ortod&ocirc;ntico? </td>
            <td><input name="aparelho" type="radio" <?=$chk[aparelho][sim]?> value="Sim" />
Sim
  <input name="aparelho" type="radio" <?=$chk[aparelho][nao]?> value="Não" />
N&atilde;o</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="23">Mucosa</td>
            <td><input name="mucosa" value="<?=$row[mucosa]?>" type="text" class="forms" /></td>
            <td>Les&atilde;o intra-oral </td>
            <td><input name="lesaointra" value="<?=$row[lesaointra]?>" type="text" class="forms" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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
