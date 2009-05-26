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
