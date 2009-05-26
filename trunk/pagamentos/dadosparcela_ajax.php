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
	if($_GET['parcela'] == '') {
        die();
	}
	$_GET['parcela'] = substr($_GET['parcela'], 0, 11);
	$query = mysql_query("SELECT * FROM v_orcamento WHERE codigo_parcela = ".$_GET['parcela']) or die('Line 42: '.mysql_error());
	$row = mysql_fetch_array($query);
?>
<script>
function atualiza_valor() {
    var dc = document.getElementById('dc');
    var dc_valor = document.getElementById('dc_valor');
    var valor_total = document.getElementById('valor_total');
    var valor = document.getElementById('valor');
    if(dc.value== '%2B') {
        valor.value = <?=$row['valor']?> %2B parseFloat(dc_valor.value);
    } else {
        valor.value = <?=$row['valor']?> - parseFloat(dc_valor.value);
    }
    valor_total.innerHTML = 'R$ '%2Bvalor.value;
}
</script>
  <br />
  <table width="58%" border="0" cellpadding="0" cellspacing="0">
    <tr align="left">
      <td width="40%">
        Paciente:
      </td>
      <td width="60%">
        <b><?=$row['paciente']?></b>
      </td>
    </tr>
    <tr align="left">
      <td>
        Profissional:
      </td>
      <td>
        <b><?=$row['dentista']?></b>
      </td>
    </tr>
    <tr align="left">
      <td>
        Valor da Parcela:
      </td>
      <td>
        <b>R$ <?=money_form($row['valor'])?></b>
      </td>
    </tr>
<?
    if($row['pago'] == 'Não') {
?>
    <tr align="left">
      <td colspan="2">
        <input type="radio" id="dc_p" name="dcc" value="%2B" checked onclick="document.getElementById('dc').value=this.value; javascript:atualiza_valor();" /> Acréscimo
        <input type="radio" id="dc_m" name="dcc" value="-" onclick="document.getElementById('dc').value=this.value; javascript:atualiza_valor();" /> Desconto
        <input type="hidden" id="dc" name="dc" value="%2B" />
        <input type="text" id="dc_valor" name="dc_valor" value="0" class="forms" size="8" onKeypress="return Ajusta_Valor(this, event);"
        onblur="if(this.value=='') { this.value='0' }; javascript:atualiza_valor()" />
      </td>
    </tr>
    <tr align="left">
      <td>
        Total a Pagar:
      </td>
      <td>
        <b><div id="valor_total">R$ <?=money_form($row['valor'])?></div></b>
        <input type="hidden" name="valor" id="valor" value="<?=$row['valor']?>">
      </td>
    </tr>
<?
    }
?>
    <tr align="left">
      <td>
        Data:
      </td>
      <td>
        <b><?=converte_data($row['data'], 2)?></b>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        &nbsp;
      </td>
    </tr>
<?
    if($row['baixa'] == 'Sim') {
?>
    <tr>
      <td colspan="2" align="center">
        <b><font color="#CC0000">PARCELA CANCELADA</font></b>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        &nbsp;
      </td>
    </tr>
<?
    } elseif($row['confirmado'] == 'Não') {
?>
    <tr>
      <td colspan="2" align="center">
        <b><font color="#CC0000">ORÇAMENTO NÃO CONFIRMADO</font></b>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        &nbsp;
      </td>
    </tr>

<?
    }
?>
    <tr>
      <td colspan="2" align="center">
        <input <?=(($row['pago'] == 'Sim' || $row['baixa'] == 'Sim' || $row['confirmado'] == 'Não')?'disabled':'')?> type="submit" name="Salvar" value="Confirmar pagamento" class="forms">
      </td>
    </tr>
<?
    if($row['pago'] == 'Sim') {
?>
    <tr>
      <td colspan="2" align="center">
        &nbsp;
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <a href="javascript:;" onclick="window.open('relatorios/recibo.php?codigo_parcela=<?=$_GET['parcela']?>', 'Recibo', 'height=350,width=320,status=yes,toolbar=no,menubar=no,location=no')">Imprimir 2ª via do Recibo</a>
      </td>
    </tr>
<?
    }
?>
  </table>
