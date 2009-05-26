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
    include "../timbre_head.php";
    $paciente = new TPacientes();
    $paciente->LoadPaciente($_GET['codigo']);
    $query = mysql_query("SELECT * FROM odontograma WHERE codigo_paciente = ".$_GET['codigo']) or die('Line 39: '.mysql_error());
    while($row = mysql_fetch_assoc($query)) {
        $dente[$row['dente']] = $row['descricao'];
    }
?>
<br />
<div align="center"><font size="4"><b>ODONTOGRAMA</b></font></div><br /><br />
<font size="2">Paciente:<br />
<b><?=$paciente->RetornaDados('nome').' ['.$paciente->RetornaDados('codigo').']'?></b><br />
<br />
Data de Impress�o:<br />
<b><?=date('d/m/Y')?></b></font><br /><br />
<br />
<div align="center">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background: url('../pacientes/img/odontograma.gif') center center no-repeat;">
        <tr>
          <td width="38%" align="right">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
<?
    $height = ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))?'21':'23');
    for($i = 18; $i != 49; $i++) {
?>
              <tr>
                <td width="100%" align="right" valign="middle" style="height: <?=$height?>px; border: 1px dashed #000000">
                  &nbsp;<?=$dente[$i]?>
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
          <td width="24%" align="center">

          </td>
          <td width="38%" align="center">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
<?
    for($i = 28; $i != 39; $i++) {
?>
              <tr>
                <td width="100%" align="left" valign="middle" style="height: <?=$height?>px; border: 1px dashed #000000">
                  <?=$dente[$i]?>&nbsp;
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
</div>
<script>
alert("Para imprimir o odontograma, voc� deve configurar a p�gina no Internet Explorer\ncom margens superiores de 0 mil�metros.\nAs demais dever�o ser de 19,05 mil�metros cada.");
window.print();
</script>
<?
    include "../timbre_foot.php";
?>