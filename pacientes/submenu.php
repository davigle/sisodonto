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
	if($_GET[acao] == 'editar') {
		$odontograma = "<a href=\"javascript:Ajax('pacientes/odontograma','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$orcamento = "<a href=\"javascript:Ajax('pacientes/orcamento','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$objetivo = "<a href=\"javascript:Ajax('pacientes/objetivo','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$evolucao = "<a href=\"javascript:Ajax('pacientes/evolucao','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$inquerito = "<a href=\"javascript:Ajax('pacientes/inquerito','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$ortodontia = "<a href=\"javascript:Ajax('pacientes/ortodontia','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$implantodontia = "<a href=\"javascript:Ajax('pacientes/implantodontia','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$fotos = "<a href=\"javascript:Ajax('pacientes/fotos','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$outros = "<a href=\"javascript:Ajax('pacientes/outros','conteudo','codigo=".$_GET[codigo].$acao."')\">";
	}
?><table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="javascript:Ajax('pacientes/incluir','conteudo','codigo=<?=$_GET[codigo].$acao?>')"><img name="cadastro" src="pacientes/img/submenu/cadastro.png" width="98" height="20" border="0" id="cadastro" alt="" /></a><?=$odontograma?><img name="odontograma" src="pacientes/img/submenu/odontograma.png" width="115" height="20" border="0" id="odontograma" alt="" /></a><?=$orcamento?><img name="orcamento" src="pacientes/img/submenu/orcamento.png" width="96" height="20" border="0" id="orcamento" alt="" /></a><?=$objetivo?><img name="objetivo" src="pacientes/img/submenu/objetivo.png" width="138" height="20" border="0" id="objetivo" alt="" /></a><?=$evolucao?><img name="evolucao" src="pacientes/img/submenu/evolucao.png" width="173" height="20" border="0" id="evolucao" alt="" /></a></td>
  </tr>
  <tr>
    <td><img name="submenu_r2_c1" src="pacientes/img/submenu/submenu_r2_c1.png" width="48" height="21" border="0" id="submenu_r2_c1" alt="" /><?=$inquerito?><img name="inquerito" src="pacientes/img/submenu/inquerito.png" width="145" height="21" border="0" id="inquerito" alt="" /></a><?=$ortodontia?><img name="ortodontia" src="pacientes/img/submenu/ortodontia.png" width="103" height="21" border="0" id="ortodontia" alt="" /></a><?=$implantodontia?><img name="implantodontia" src="pacientes/img/submenu/implantodontia.png" width="128" height="21" border="0" id="implantodontia" alt="" /></a><?=$fotos?><img name="fotos" src="pacientes/img/submenu/fotos.png" width="64" height="21" border="0" id="fotos" alt="" /></a><?=$outros?><img name="outros" src="pacientes/img/submenu/outros.png" width="70" height="21" border="0" id="outros" alt="" /><img name="submenu_r2_c11" src="pacientes/img/submenu/submenu_r2_c11.png" width="62" height="21" border="0" id="submenu_r2_c11" alt="" /></a></td>
  </tr>
</table>
