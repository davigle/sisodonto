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
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `contasreceber_dent` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
		$_POST[cpf_dentista] = $_GET[cpf_dentista];
		$_POST[senha_dentista] = $_GET[senha_dentista];
	}
	if(isset($_POST[Salvar])) {		
		$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `cpf` = '".$_POST[cpf_dentista]."'"));
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
			$caixa = new TContas('dentista', 'receber');
			$caixa->SetDados('datavencimento', converte_data($_POST[datavencimento], 1));
			$caixa->SetDados('descricao', $_POST[descricao]);
			$caixa->SetDados('valor', $_POST[valor]);
			$caixa->SetDados('cpf_dentista', $_SESSION[cpf]);
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
      <td width="46%">&nbsp;&nbsp;&nbsp;<img src="contasreceber_dent/img/contas.png" alt="Contas a receber da Clínica"> <span class="h3">Contas a receber do Dentista </span></td>
      <td colspan="2" valign="bottom" align="center">
      <input type="hidden" name="peri" id="peri" value="">
      <input type="radio" name="pesq" id="pesqdia" value="dia" onclick="document.getElementById('peri').value='dia'"><label for="pesqdia"> Dia/Mês/Ano</label>&nbsp;&nbsp;&nbsp;
      <input type="radio" name="pesq" id="pesqmes" value="mes" onclick="document.getElementById('peri').value='mes'"><label for="pesqmes"> Mês/Ano</label>&nbsp;&nbsp;&nbsp;
	  Pesquisar <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('contasreceber_dent/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&peri='%2Bdocument.getElementById('peri').value%2B'&cpf_dentista=<?=$_SESSION[cpf]?>')"
				onKeypress="return Ajusta_DMA(this, event, document.getElementById('peri').value);"
      onclick="if(document.getElementById('pesqdia').checked) {abreCalendario(this);}">
	  <br>
	  <input type="radio" name="pesq" id="pesqmesatual" value="mesatual" onclick="javascript:Ajax('contasreceber_dent/pesquisa', 'pesquisa', 'peri=mesatual')"><label for="pesqmesatual"> Mês atual</label>&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table><br />
  <form id="form2" name="form2" method="POST" action="contasreceber_dent/extrato_ajax.php" onsubmit="formSender(this, 'conteudo'); this.reset(); return false;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="4%">
      </td>
      <td width="12%">Vencimento <br />
        <input type="text" size="13" value="<?=converte_data(hoje(), 2)?>" name="datavencimento" id="datavencimento" class="forms">
      </td>
      <td width="58%">Descrição <br />
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
      <td width="21%" align="center">Data Pagamento</td>
      <td width="5%" align="center">Apagar</td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  Ajax('contasreceber_dent/pesquisa', 'pesquisa', 'cpf_dentista=<?=$_SESSION[cpf]?>&pesquisa=');
  </script>
</div>
