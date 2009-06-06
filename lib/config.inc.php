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
  // Windows
  //define('PATH_INCLUDE', 'C:\\apache\\htdocs\\gco\\');
  //
  // Linux
  //define('PATH_INCLUDE', '/var/www/htdocs/gco/');
  define('PATH_INCLUDE', '');
  
  // Vers�o desta libera��o
  $version = '2.2';
  
  // Vari�veis do conex�o com o BD 
  $server = 'localhost';
  $user = 'root';
  $pass = 'root';
  $bd = 'sisodonto';
  
  // Quantidade de p�ginas exibidas nas pagina��es
  define('PG_MAX', 30);
  // Quantidade de p�ginas exibidas nas pagina��es menores
  define('PG_MAX_MEN', 10);
  // Quantidade de zeros para completar a numera��o dos boletos
  define('ZEROS', 11);
  
  // Define a frase exibida para a pessoa n�o autenticada
  $frase_log = "&nbsp;&nbsp;Voc� precisa estar logado para acessar esta �rea!";
  
  // Define a frase exibida para acesso apenas de administradores
  $frase_adm = "&nbsp;&nbsp;�rea restrita a administradores da cl�nica!";
  // Define a frase exibida para acesso apenas de administradores e dentistas
  $frase_dent_adm = "&nbsp;&nbsp;�rea restrita a administradores e profissionais da cl�nica!";
  // Define a frase exibida para acesso apenas de administradores e funcion�rios
  $frase_adm_func = "&nbsp;&nbsp;�rea restrita a administradores e funcion�rios da cl�nica!";
  
  // Define se est� instalado ou n�o
  $install = true;

?>
