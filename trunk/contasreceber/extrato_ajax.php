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
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `contasreceber` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
	if(isset($_POST[Salvar])) {
		$obrigatorios[1] = 'datavencimento';
		$obrigatorios[] = 'descricao';
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
			$caixa = new TContas('clinica', 'receber');
			$caixa->SetDados('datavencimento', converte_data($_POST[datavencimento], 1));
			$caixa->SetDados('descricao', $_POST[descricao]);
			$caixa->SetDados('valor', $_POST[valor]);
			$caixa->SalvarNovo();
			$caixa->Salvar();
		}
	}
?>
<div id='calendario' name='calendario' style='display:none;position:absolute;'>
<?
	include "../lib/calendario.inc.php";
?>
</div>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="45%">&nbsp;&nbsp;&nbsp;<img src="contasreceber/img/contas.png" alt="Contas a receber da Cl�nica"> <span class="h3">Contas a receber da Cl�nica </span></td>
      <td colspan="2" valign="bottom" align="center">
      <input type="hidden" name="peri" id="peri" value="">
      <input type="radio" name="pesq" id="pesqdia" value="dia" onclick="document.getElementById('peri').value='dia'"><label for="pesqdia"> Dia/M�s/Ano</label>&nbsp;&nbsp;&nbsp;
      <input type="radio" name="pesq" id="pesqmes" value="mes" onclick="document.getElementById('peri').value='mes'"><label for="pesqmes"> M�s/Ano</label>&nbsp;&nbsp;&nbsp;
	  Pesquisar <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('contasreceber/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&peri='%2Bdocument.getElementById('peri').value)" onKeypress="return Ajusta_DMA(this, event, document.getElementById('peri').value);"
      onclick="if(document.getElementById('pesqdia').checked) {abreCalendario(this);}">
	  <br>
	  <input type="radio" name="pesq" id="pesqmesatual" value="mesatual" onclick="javascript:Ajax('contasreceber/pesquisa', 'pesquisa', 'peri=mesatual')"><label for="pesqmesatual"> M�s atual</label>&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table><br />
  <form id="form2" name="form2" method="POST" action="contasreceber/extrato_ajax.php" onsubmit="formSender(this, 'conteudo'); this.reset(); return false;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="4%">
      </td>
      <td width="12%">Vencimento <br />
        <input type="text" size="13" value="<?=converte_data(hoje(), 2)?>" name="datavencimento" id="datavencimento" class="forms">
      </td>
      <td width="58%">Descri��o <br />
        <input type="text" size="80" name="descricao" id="descricao" class="forms">
      </td>
      <td width="16%">Valor <br />
        <input type="text" size="20" name="valor" id="valor" class="forms" onKeypress="return Ajusta_Valor(this, event);">
      </td>
      <td width="10%"> <br />
        <input type="submit" name="Salvar" id="Salvar" value="Salvar" class="forms">
      </td>
      <td width="3%">
      </td>
    </tr>
  </table>
  </form>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td width="11%" height="23" align="left">Vencimento</td>
      <td width="50%" align="left">Descricao</td>
      <td width="13%" align="center">Valor</td>
      <td width="21%" align="center">Data Recebimento</td>
      <td width="5%" align="center">Apagar</td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  Ajax('contasreceber/pesquisa', 'pesquisa', 'pesquisa=');
  </script>
</div>
