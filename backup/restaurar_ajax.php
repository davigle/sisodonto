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
	
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="74%">&nbsp;&nbsp;&nbsp;<img src="backup/img/backuprestaurar.png" alt="Sobre"> <span class="h3">RESTAURA��O DE BACKUP</span></td>
      <td width="7%" valign="bottom">&nbsp;</td>
      <td width="19%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br />
  <div class="sobre" id="sobre">
    <p>&nbsp;</p>
    <fieldset>
  <legend>Explicativo </legend>
  <p>Caro usu�rio, <br />
  <br />
  A �rea que voc� acessou, para restaurar um backup, n�o est� dispon�vel, e nem estar�. Explicamos:<br />
  <br />
  O que acontece � que o PHP, linguagem na qual o GCO foi programado, n�o suporta arquivos muito grandes e,
  dependendo do tamanho de seu banco, pode causar problemas no programa e nos dados nele arquivados.<br />
  <br />
  Por esse motivo, n�o nos atrevemos a fazer tal rotina e correr o risco de que possa perder os dados ou
  corromper seu banco de dados.<br />
  <br />
  No entanto, n�o � preciso se preocupar. Se vo� fez o backup, os dados est�o salvos e h� maneiras de se
  recuperar a c�pia de seguran�a. Existem, no mercado, v�rias ferramentas que realizam esta fun��o de
  maneira r�pida e segura. Um desses exemplos � o <b>MySQL-Front</b>.<br />
  <br />
  O MySQL-Front pode ser adquirido atrav�s do site: <a href="http://www.mysqlfront.de" target="_blank">www.mysqlfront.de</a>.
  No entanto, se trata de um programa pago, que possui uma licen�a de experi�ncia de 30 dias. Ainda assim,
  recomendados este programa, por satisfazer de forma ideal as necessidades do banco de dados quanto �
  restaura��o de dados. Todavia qualquer software que manipule um banco de dados do tipo MySQL pode ser usado.<br />
  <br />
  Para qualquer d�vida referente ao MySQL-Front, favor acessar o F�rum do GCO ou entrar em contato.<br />
  <br />
  Grato pela compreens�o.</p>
    </fieldset>
  </div>
</div>
