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
		mysql_query("DELETE FROM `estoque_dent` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
	if(isset($_POST[Salvar])) {		
		$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `cpf` = '".$_SESSION[cpf]."'"));
		$obrigatorios[1] = 'descricao';
		$obrigatorios[] = 'quantidade';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
		if($j == 0) {
			$caixa = new TEstoque('dentista');
			$caixa->SetDados('descricao', $_POST[descricao]);
			$caixa->SetDados('quantidade', $_POST[quantidade]);
			$caixa->SetDados('cpf_dentista', $_SESSION[cpf]);
			$caixa->SalvarNovo();
			$caixa->Salvar();
		}
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="60%">&nbsp;&nbsp;&nbsp;<img src="estoque_dent/img/estoque.png" alt="Controle de Estoque do Dentista"> <span class="h3">Controle de Estoque do Dentista </span></td>
      <td width="38%" valign="bottom">
      	<table width="100%" border="0">
      	  <tr>
      	    <td>
      	      Pesquisar por descrição:
      	    </td>
      	    <td>
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('estoque_dent/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value)">
      	    </td>
      	  </tr>
      	</table>
	  </td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table><br />
  <form id="form2" name="form2" method="POST" action="estoque_dent/extrato_ajax.php" onsubmit="formSender(this, 'conteudo'); this.reset(); return false;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="4%">
      </td>
      <td width="60%">Descrição <br />
        <input type="text" size="80" name="descricao" id="descricao" class="forms">
      </td>
      <td width="19%">Quantidade <br />
        <input type="text" size="20" name="quantidade" id="quantidade" class="forms"">
      </td>
      <td width="14%" align="right"> <br />
        <input type="submit" name="Salvar" id="Salvar" value="Salvar" class="forms"> &nbsp;&nbsp;
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
      <td width="75%" height="23" align="left">Descrição</td>
      <td width="15%" align="center">Quantidade</td>
      <td width="10%" align="center">Apagar</td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('estoque_dent/pesquisa', 'pesquisa', 'pesquisa=');
  </script>
</div>
