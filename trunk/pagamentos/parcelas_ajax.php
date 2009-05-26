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
	if(isset($_POST['Salvar'])) {
        $row = mysql_fetch_array(mysql_query("SELECT * FROM v_orcamento WHERE pago = 'N�o' AND codigo_parcela = ".$_POST['parcela']));
        mysql_query("UPDATE parcelas_orcamento SET pago = 'Sim', datapgto = '".date('Y-m-d')."', valor = '".$_POST['valor']."' WHERE codigo = ".$_POST['parcela']);
        mysql_query("INSERT INTO caixa (data, dc, valor, descricao) VALUES ('".date('Y-m-d')."', '+', '".$_POST['valor']."', 'Pagamento da parcela ".$row['codigo_parcela']." - Paciente: ".$row['paciente']." - Dentista: ".$row['dentista']."')");
        echo '<script>if(confirm("Pagamento efetuado com sucesso!\n\nPaciente: '.$row['paciente'].'\n\nDentista: '.(($row['sexo_dentista'] == 'Masculino')?'Dr. ':'Dra. ').$row['dentista'].'\n\nValor: R$ '.money_form($_POST['valor']).'\n\nData de vencimento: '.converte_data($row['data'], 2).'\n\nData de pagamento: '.date('d/m/Y').'\n\nDeseja imprimir o recibo?")) { window.open("relatorios/recibo.php?codigo_parcela='.$_POST['parcela'].'", "Recibo",  "height=350,width=320,status=yes,toolbar=no,menubar=no,location=no") }</script>';
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="pagamentos/img/parcelas.png" alt="Pagamentos de Parcelas"> <span class="h3">PAGAMENTOS DE PARCELAS </span></td>
      <td width="6%" valign="bottom"></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26">PAGAMENTO DE PARCELAS </td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pagamentos/parcelas_ajax.php" onsubmit="formSender(this, 'conteudo'); return false;">
      <fieldset>
        <legend><span class="style1">Informa��es da parcela </span></legend>
        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center">PASSE O LEITOR �TICO OU<BR>INFORME O C�DIGO DE BARRAS<BR><br />
                  <input autocomplete="off" name="parcela" value="<?=$_GET['codigo']?>" <?=$disable?> type="text" class="forms" id="parcela" size="50" maxlength="11" onkeypress="return Bloqueia_Caracteres(event);" onkeyup="javascript:Ajax('pagamentos/dadosparcela', 'pagamento', 'parcela='%2Bthis.value)" />
            </td>
          </tr>
          <tr>
            <td align="center"><div id="pagamento"></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
      </fieldset>
      </form>
      </td>
    </tr>
  </table>
</div>
<script>
document.getElementById('parcela').focus();
Ajax('pagamentos/dadosparcela', 'pagamento', 'parcela=<?=$_GET['codigo']?>');
</script>
