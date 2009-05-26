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
?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?
	$caixa = new TCaixa();
	$data = converte_data($_GET[pesquisa], 1);
	switch ($_GET[peri]) {
		case 'dia': {
			$lista = $caixa->ListCaixa("SELECT * FROM `caixa` WHERE `data` = '$data' ORDER BY `data` ASC, `codigo` ASC");
		} break;
		case 'mes': {
			$lista = $caixa->ListCaixa("SELECT * FROM `caixa` WHERE LEFT(`data`, 7) = '$data' ORDER BY `data` ASC, `codigo` ASC");
		} break;
		case 'ano': {
			$lista = $caixa->ListCaixa("SELECT * FROM `caixa` WHERE LEFT(`data`, 4) = '$data' ORDER BY `data` ASC, `codigo` ASC");
		} break;
		case 'mesatual': {
			$lista = $caixa->ListCaixa("SELECT * FROM `caixa` WHERE LEFT(`data`, 7) = '".date(Y.'-'.m)."' ORDER BY `data` ASC, `codigo` ASC");
		} break;
	}
	$par = "F0F0F0";
	$impar = "F8F8F8";
	$saldo = 0;
	$saldoc = 0;
	$saldod = 0;
	for($i = 0; $i < count($lista); $i++) {
        if($_GET['cpf_dentista'] != 0) {
            $codigo_parcela = explode(' - ', $lista[$i]['descricao']);
       	    $codigo_parcela = explode(' ', $codigo_parcela[0]);
            $codigo_parcela = ((strpos($lista[$i]['descricao'], 'Pagamento da parcela') !== false)?$codigo_parcela[(count($codigo_parcela)-1)]:'');
            $sql1 = "SELECT tor.cpf_dentista FROM orcamento tor INNER JOIN parcelas_orcamento tpo ON tor.codigo = tpo.codigo_orcamento WHERE tpo.codigo = ".$codigo_parcela;
            $query1 = @mysql_query($sql1);
            $row1 = @mysql_fetch_assoc($query1);
            if($_GET['cpf_dentista'] != $row1['cpf_dentista'] || !is_numeric($codigo_parcela)){
                continue;
            }
        }
        if($lista[$i][dc] != '') {
			if($i % 2 == 0) {
				$odev = $par;
			} else {
				$odev = $impar;
			}
			if($lista[$i][dc] == "-") {
				$debito = 'R$ '.money_form($lista[$i][valor]);
				$credito = '';
			} else {
				$debito = '';
				$credito = 'R$ '.money_form($lista[$i][valor]);
			}
			if($lista[$i][dc] == '-') {
				$saldo -= $lista[$i][valor];
				$saldod += $lista[$i][valor];
			} else {
				$saldo += $lista[$i][valor];
				$saldoc += $lista[$i][valor];
			}
			if($saldo < 0) {
				$cor = "FF0000";
			} else {
				$cor = "000000";
			}
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="11%" height="23" align="left"><?=converte_data($lista[$i][data], 2)?></td>
      <td width="50%" align="left"><?=$lista[$i][descricao]?></td>
      <td width="13%" align="right"><?=$debito?></td>
      <td width="13%" align="right"><?=$credito?></td>
      <td width="13%" align="right"><font color="#<?=$cor?>">R$ <?=money_form($saldo)?></form></td>
    </tr>
<?
		}
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
      <td width="61%" colspan="2" height="23" align="left"><b>TOTAL</b></td>
      <td width="13%" align="right"><b>R$ <?=money_form($saldod)?></b></td>
      <td width="13%" align="right"><b>R$ <?=money_form($saldoc)?></b></td>
      <td width="13%" align="right"><font color="#<?=$cor?>"><b>R$ <?=money_form($saldo)?></b></form></td>
    </tr>
  </table>
