<?
/**
 * Gerenciador Clínico Odontológico
 * Copyright (C) 2006  
 * Autores: Ivis Silva Andrade (ivis@expandweb.com)
 *          Pedro Henrique Braga Moreira (ikkinet@gmail.com)
 *
 * Este arquivo é parte do programa Gerenciador Clínico Odontológico
 * 
 * Gerenciador Clínico Odontológico é um software livre; você pode 
 * redistribuí-lo e/ou modificá-lo dentro dos termos da Licença  
 * Pública Geral GNU como publicada pela Fundação do Software Livre  
 * (FSF); na versão 2 da Licença ou suas próximas versões.
 * 
 * Este programa é distribuído na esperança que possa ser útil, 
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÂO 
 * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * 
 * Você recebeu uma cópia da Licença Pública Geral GNU,
 * que está localizada na raíz do programa no arquivo
 * COPYING ou COPYING.TXT
 * junto com este programa, se não, escreva para:
 *
 * Fundação do Software Livre(FSF) Inc.
 * 51 Franklin St, Fifth Floor
 * Boston - MA - 02110-1301
 * USA
 *
 */
	include "../../lib/config.inc.php";
	include "../../lib/func.inc.php";
	include "../../lib/classes.inc.php";
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
		die($frase_log);
	}
	$name = $_FILES[arquivo][name];
	$tipo = explode('.', $name);
	$tipo = array_reverse($tipo);
	$tipo = strtolower($tipo[0]);
	$codigo = next_autoindex('arquivos');
	$name = "arquivo".$codigo.'.'.$tipo;
	$descricao = $_POST[descricao];
	$file = './files/'.$name;
	$size = $_FILES[arquivo][size];
	if(!move_uploaded_file($_FILES['arquivo']['tmp_name'], $file)) {
		echo '<script language="javascript" type="text/javascript">window.parent.alert(\'Este formato de arquivo não é permitido!\');</script>';
		die();
	}
	mysql_query("INSERT INTO `arquivos` (`codigo`, `nome`, `descricao`, `tamanho`) VALUES ('$codigo', '$name', '$descricao', '$size')") or die(mysql_error());
?>
<script language="javascript" type="text/javascript">
window.parent.location.href="javascript:Ajax('arquivos/daclinica/arquivos', 'conteudo', '')";
</script>