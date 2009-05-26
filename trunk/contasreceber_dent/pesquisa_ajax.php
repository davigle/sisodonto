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
	$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `cpf` = '".$_GET[cpf_dentista]."'"));
?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?
		$conta = new TContas('dentista', 'receber');
		$data = converte_data($_GET[pesquisa], 1);
		$cpf_dentista = $_SESSION[cpf];
		switch ($_GET[peri]) {
			case 'dia': {
				$lista = $conta->ListConta("SELECT * FROM `contasreceber_dent` WHERE `datavencimento` = '$data' AND `cpf_dentista` = '$cpf_dentista' ORDER BY `datavencimento` ASC, `codigo` ASC");
			} break;
			case 'mes': {
				$lista = $conta->ListConta("SELECT * FROM `contasreceber_dent` WHERE LEFT(`datavencimento`, 7) = '$data' AND `cpf_dentista` = '$cpf_dentista' ORDER BY `datavencimento` ASC, `codigo` ASC");
			} break;
			case 'mesatual': {
				$lista = $conta->ListConta("SELECT * FROM `contasreceber_dent` WHERE LEFT(`datavencimento`, 7) = '".date(Y.'-'.m)."' AND `cpf_dentista` = '$cpf_dentista' ORDER BY `datavencimento` ASC, `codigo` ASC");
			} break;
		}
		$par = "F0F0F0";
		$impar = "F8F8F8";
		$saldo = 0;
		for($i = 0; $i < count($lista); $i++) {
			if($i % 2 == 0) {
				$odev = $par;
			} else {
				$odev = $impar;
			}
			$conta->LoadConta($lista[$i][codigo]);
			$saldo += $conta->RetornaDados('valor');
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="11%" height="23" align="left"><?=converte_data($conta->RetornaDados('datavencimento'), 2)?></td>
      <td width="50%" align="left"><?=$conta->RetornaDados('descricao')?></td>
      <td width="13%" align="right">R$ <?=money_form($conta->RetornaDados('valor'))?></td>
      <td width="21%" align="right"><input type="text" size="13" name="datapagamento" id="datapagamento" value="<?=converte_data($conta->RetornaDados('datapagamento'), 2)?>" onblur="Ajax('contasreceber_dent/atualiza', 'conta_atualiza', 'codigo=<?=$conta->RetornaDados('codigo')?>&datapagamento='%2Bthis.value)" onKeypress="return Ajusta_Data(this, event);"></td>
      <td width="5%" align="center"><a href="javascript:Ajax('contasreceber_dent/extrato', 'conteudo', 'codigo=<?=$conta->RetornaDados('codigo')?>&cpf_dentista=<?=$_GET[cpf_dentista]?>&senha_dentista=<?=$_GET[senha_dentista]?>" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a></td>
    </tr>
<?
	}
	if($odev == $impar) {
		$odev = $par;
	} else {
		$odev = $impar;
	}	
?>
    <tr>
      <td height="23" align="left" colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="61%" colspan="2" height="23" align="center"><b>TOTAL</b></td></td>
      <td width="13%" align="right"><font color="#<?=$cor?>"><b>R$ <?=money_form($saldo)?></b></form></td>
      <td width="13%" colspan="2" align="right"></td>
    </tr>
  </table><div id="conta_atualiza"></div>
