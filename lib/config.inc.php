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
  // Windows
  //define('PATH_INCLUDE', 'C:\\apache\\htdocs\\gco\\');
  //
  // Linux
  //define('PATH_INCLUDE', '/var/www/htdocs/gco/');
  define('PATH_INCLUDE', '');
  
  // Versão desta liberação
  $version = '2.2';
  
  // Variáveis do conexão com o BD 
  $server = 'localhost';
  $user = 'root';
  $pass = 'root';
  $bd = 'sisodonto';
  
  // Quantidade de páginas exibidas nas paginações
  define('PG_MAX', 30);
  // Quantidade de páginas exibidas nas paginações menores
  define('PG_MAX_MEN', 10);
  // Quantidade de zeros para completar a numeração dos boletos
  define('ZEROS', 11);
  
  // Define a frase exibida para a pessoa não autenticada
  $frase_log = "&nbsp;&nbsp;Você precisa estar logado para acessar esta área!";
  
  // Define a frase exibida para acesso apenas de administradores
  $frase_adm = "&nbsp;&nbsp;Área restrita a administradores da clínica!";
  // Define a frase exibida para acesso apenas de administradores e dentistas
  $frase_dent_adm = "&nbsp;&nbsp;Área restrita a administradores e profissionais da clínica!";
  // Define a frase exibida para acesso apenas de administradores e funcionários
  $frase_adm_func = "&nbsp;&nbsp;Área restrita a administradores e funcionários da clínica!";
  
  // Define se está instalado ou não
  $install = true;

?>
