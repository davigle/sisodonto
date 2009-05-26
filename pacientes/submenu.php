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
