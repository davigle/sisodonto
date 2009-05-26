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
	$conta = new THonorarios();
	$conta->LoadInfo($_GET['codigo']);
    if(isset($_GET['procedimento'])) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            $conta->SetDados('procedimento', $_GET['procedimento']);
            //echo $_GET['procedimento'];
        } else {
            $conta->SetDados('procedimento', utf8_decode($_GET['procedimento']));
            //echo utf8_decode($_GET['procedimento']);
        }
    } elseif(isset($_GET['valor_particular'])) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            $conta->SetDados('valor_particular', $_GET['valor_particular']);
            //echo $_GET['valor_particular'];
        } else {
            $conta->SetDados('valor_particular', utf8_decode($_GET['valor_particular']));
            //echo utf8_decode($_GET['valor_particular']);
        }
    } elseif(isset($_GET['valor_convenio'])) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            $conta->SetDados('valor_convenio', $_GET['valor_convenio']);
            //echo $_GET['valor_convenio'];
        } else {
            $conta->SetDados('valor_convenio', utf8_decode($_GET['valor_convenio']));
            //echo utf8_decode($_GET['valor_convenio']);
        }
    }
	$conta->Salvar();
?>
