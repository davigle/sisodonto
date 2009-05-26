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
	$caixa = new TCaixa();
	if(isset($_POST[Salvar])) {	
		$obrigatorios[1] = 'data';
		$obrigatorios[] = 'descricao';
		$obrigatorios[] = 'dc';
		$obrigatorios[] = 'valor';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
		if($j == 0) {
			$caixa->SalvarNovo();
			$caixa->SetDados('data', converte_data($_POST[data], 1));
			$caixa->SetDados('descricao', $_POST[descricao]);
			$caixa->SetDados('dc', $_POST[dc]);
			$caixa->SetDados('valor', $_POST[valor]);
			$caixa->Salvar();
		}
	}
?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?
	$lista = $caixa->ListCaixa("SELECT * FROM `caixa` ORDER BY `data` DESC,  `codigo` DESC LIMIT 9");
	$par = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < 9; $i++) {
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
			$saldo = $caixa->SaldoTotal();
			for($j = $i-1; $j >= 0; $j--) {
				if($lista[$j][dc] == '-') {
					$saldo += $lista[$j][valor];
				} else {
					$saldo -= $lista[$j][valor];
				}
			}
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="11%" height="23" align="left"><?=converte_data($lista[$i][data], 2)?></td>
      <td width="50%" align="left"><?=$lista[$i][descricao]?></td>
      <td width="13%" align="right"><?=$debito?></td>
      <td width="13%" align="right"><?=$credito?></td>
      <td width="13%" align="right"></td>
    </tr>
<?
		}
	}
?>
  </table>
