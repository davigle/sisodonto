<?
/**
 * Gerenciador Cl�nico Odontol�gico
 * Copyright (C) 2006  
 * Autores: Ivis Silva Andrade (ivis@expandweb.com)
 *          Pedro Henrique Braga Moreira (ikkinet@gmail.com)
 *
 * Este arquivo � parte do programa Gerenciador Cl�nico Odontol�gico
 * 
 * Gerenciador Cl�nico Odontol�gico � um software livre; voc� pode 
 * redistribu�-lo e/ou modific�-lo dentro dos termos da Licen�a  
 * P�blica Geral GNU como publicada pela Funda��o do Software Livre  
 * (FSF); na vers�o 2 da Licen�a ou suas pr�ximas vers�es.
 * 
 * Este programa � distribu�do na esperan�a que possa ser �til, 
 * mas SEM NENHUMA GARANTIA; sem uma garantia impl�cita de ADEQUA��O 
 * a qualquer MERCADO ou APLICA��O EM PARTICULAR. Veja a
 * Licen�a P�blica Geral GNU para maiores detalhes.
 * 
 * Voc� recebeu uma c�pia da Licen�a P�blica Geral GNU,
 * que est� localizada na ra�z do programa no arquivo
 * COPYING ou COPYING.TXT
 * junto com este programa, se n�o, escreva para:
 *
 * Funda��o do Software Livre(FSF) Inc.
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
		echo '<script language="javascript" type="text/javascript">window.parent.alert(\'Este formato de arquivo n�o � permitido!\');</script>';
		die();
	}
	mysql_query("INSERT INTO `arquivos` (`codigo`, `nome`, `descricao`, `tamanho`) VALUES ('$codigo', '$name', '$descricao', '$size')") or die(mysql_error());
?>
<script language="javascript" type="text/javascript">
window.parent.location.href="javascript:Ajax('arquivos/daclinica/arquivos', 'conteudo', '')";
</script>