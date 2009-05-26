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
	
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="74%">&nbsp;&nbsp;&nbsp;<img src="backup/img/backuprestaurar.png" alt="Sobre"> <span class="h3">RESTAURAÇÃO DE BACKUP</span></td>
      <td width="7%" valign="bottom">&nbsp;</td>
      <td width="19%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br />
  <div class="sobre" id="sobre">
    <p>&nbsp;</p>
    <fieldset>
  <legend>Explicativo </legend>
  <p>Caro usuário, <br />
  <br />
  A área que você acessou, para restaurar um backup, não está disponível, e nem estará. Explicamos:<br />
  <br />
  O que acontece é que o PHP, linguagem na qual o GCO foi programado, não suporta arquivos muito grandes e,
  dependendo do tamanho de seu banco, pode causar problemas no programa e nos dados nele arquivados.<br />
  <br />
  Por esse motivo, não nos atrevemos a fazer tal rotina e correr o risco de que possa perder os dados ou
  corromper seu banco de dados.<br />
  <br />
  No entanto, não é preciso se preocupar. Se voê fez o backup, os dados estão salvos e há maneiras de se
  recuperar a cópia de segurança. Existem, no mercado, várias ferramentas que realizam esta função de
  maneira rápida e segura. Um desses exemplos é o <b>MySQL-Front</b>.<br />
  <br />
  O MySQL-Front pode ser adquirido através do site: <a href="http://www.mysqlfront.de" target="_blank">www.mysqlfront.de</a>.
  No entanto, se trata de um programa pago, que possui uma licença de experiência de 30 dias. Ainda assim,
  recomendados este programa, por satisfazer de forma ideal as necessidades do banco de dados quanto à
  restauração de dados. Todavia qualquer software que manipule um banco de dados do tipo MySQL pode ser usado.<br />
  <br />
  Para qualquer dúvida referente ao MySQL-Front, favor acessar o Fórum do GCO ou entrar em contato.<br />
  <br />
  Grato pela compreensão.</p>
    </fieldset>
  </div>
</div>
