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
	$caminho = "logo.jpg";
	if($_GET[confirm_del] == "delete\')") {
        $sql = "UPDATE `dados_clinica` SET `logomarca` = ''";
        mysql_query($sql) or die(mysql_error());
        echo '<script>alert("Foto excluída com sucesso!")</script>';
	}
	if(isset($_POST[send])) {
		if($_FILES['foto']['name'] != "") {
			$foto = imagecreatefromall($_FILES['foto']['tmp_name'], $_FILES['foto']['name']);
			$factor = imagesx($foto)/imagesy($foto);
            $siz_x = 100;
			$siz_y = round($siz_x/$factor);
			$imagem = imagecreate($siz_x, $siz_y);
			$white = imagecolorallocatealpha($imagem, 255, 255, 255, 127);
			imagecopyresized($imagem, $foto, 0, 0, 0, 0, $siz_x, $siz_y, imagesx($foto), imagesy($foto));
            imagejpeg($imagem, 'logo.jpg');
            $img_data = addslashes(file_get_contents('logo.jpg'));
            $sql = "UPDATE `dados_clinica` SET `logomarca` = '".$img_data."'";
            unlink('logo.jpg');
            mysql_query($sql) or die(mysql_error());
		}
	}
	$disable = '';
	$href = 'href=';
	$onclick = 'onclick=';
	if(checknivel('Dentista') || checknivel('Funcionario') || $_GET['disabled'] == 'yes') {
		$disable = 'disabled';
		$href = '';
		$onclick = '';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerenciador Clínico SmilePrev - Administração Odontológica Em Suas Mãos</title>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../lib/script.js"></script>
</head>
<body style="background-color: #F0F0F0"><center>
<?
    $sql = "SELECT `logomarca` FROM `dados_clinica`";
    $query = mysql_query($sql) or die('Erro: '. mysql_error());
    $row = mysql_fetch_array($query);
	if($row['logomarca'] != '') {
		echo '<img src="verfoto_p.php" border="0">';
	}
?><br><br>
<form action="logo.php" method="POST" enctype="multipart/form-data" target="_self">
<input type="file" <?=$disable?> name="foto" size="8" class="forms"><br>
<input type="submit" <?=$disable?> class="forms" value="Enviar" name="send"><BR><BR>
<a <?=$href?>"logo.php?" <?=$onclick?>"return confirmLink(this)">Excluir foto</a>
</form>
</body>
</html>
