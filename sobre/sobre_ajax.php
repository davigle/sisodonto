<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2009
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
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endere�o:
    *
    * Smile Odontol�ogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=ISO-8859-1", true);
?>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="74%">&nbsp;&nbsp;&nbsp;<img src="sobre/img/sobre.png" alt="Sobre"> <span class="h3"><?=$LANG['about']['about']?></span></td>
      <td width="7%" valign="bottom">&nbsp;</td>
      <td width="19%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br />
  <div class="sobre" id="sobre">
    <p>&nbsp;</p>
    <fieldset>
  <legend><?=$LANG['about']['copyright']?></legend>
  <p><?=$LANG['about']['all_rights_reserved']?></p>
  <p><?=$LANG['about']['gco_is_protected']?><br />
  </p>
  </fieldset><br />
  <legend><fieldset><legend><?=$LANG['about']['general']?></legend>
  <p><?=$LANG['about']['gco_is_developed']?></p>
  <p>- <?=$LANG['about']['html']?><br />
     <br />
     - <?=$LANG['about']['php']?><br />
     <br />
     - <?=$LANG['about']['mysql']?><br />
     <br />
     - <?=$LANG['about']['css']?><br />
     <br />
     - <?=$LANG['about']['ajax']?><br />
     <br />
     - <?=$LANG['about']['javascript']?></p>
  <p align="center">    <br />
    <strong><?=$LANG['about']['smile_supports']?></strong><br />
    </p>
  </fieldset>
  </div>
</div>
