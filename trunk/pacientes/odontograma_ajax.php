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
	$acao = '&acao=editar';
	$paciente = new TPacientes();
    $query = mysql_query("SELECT * FROM odontograma WHERE codigo_paciente = ".$_GET['codigo']) or die('Line 39: '.mysql_error());
    while($row = mysql_fetch_assoc($query)) {
        $dente[$row['dente']] = $row['descricao'];
    }
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
?>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
  <tr>
    <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Dentistas"> <span class="h3">GERENCIAR PACIENTES &nbsp;[<?=$strLoCase?>] </span></td>
  </tr>
</table>
<div class="conteudo" id="table dados">
<br />
<?include('submenu.php')?>
<br />
<table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
  <tr>
    <td height="26">&nbsp;ODONTOGRAMA</td>
  </tr>
</table>
<table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
  <tr>
    <td>
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background: url('pacientes/img/odontograma.gif') center center no-repeat;">
        <tr>
          <td width="35%" align="right">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?
    for($i = 18; $i != 49; $i++) {
?>
              <tr>
                <td width="100%" align="right" style="height: 25px" valign="middle">
                  <input type="text" name="dente[<?=$i?>]" value="<?=$dente[$i]?>" class="forms"
                  onblur="Ajax('pacientes/atualiza', 'pacientes_atualiza', 'descricao='%2Bthis.value%2B'&codigo_paciente=<?=$_GET['codigo']?>&dente=<?=$i?>');" />
                </td>
              </tr>
<?
        if($i == 11) {
            $i = 40;
        }
        if($i < 40) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
          <td width="30%" align="center">

          </td>
          <td width="35%" align="center">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?
    for($i = 28; $i != 39; $i++) {
?>
              <tr>
                <td width="100%" align="left" style="height: 25px" valign="middle">
                  <input type="text" name="dente[<?=$i?>]" value="<?=$dente[$i]?>" class="forms"
                  onblur="Ajax('pacientes/atualiza', 'pacientes_atualiza', 'descricao='%2Bthis.value%2B'&codigo_paciente=<?=$_GET['codigo']?>&dente=<?=$i?>');" />
                </td>
              </tr>
<?
        if($i == 21) {
            $i = 30;
        }
        if($i < 30) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
    <tr>
      <td align="right"> <br />
        <img src="../imagens/icones/imprimir.gif"> <a href="../relatorios/odontograma.php?codigo=<?=$_GET['codigo']?>" target="_blank">Imprimir Odontograma</a>&nbsp;
      </td>
    </tr>
</table>
<div id="pacientes_atualiza"></div>
