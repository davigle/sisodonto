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
	if($_GET[confirm_del] == "delete')") {
        $sql = "UPDATE `pacientes` SET `foto` = '' WHERE `codigo` = '".$_GET['codigo']."'";
        mysql_query($sql) or die(mysql_error());
	}
	if(isset($_POST['send'])) {
		if($_FILES['foto']['name'] != "") {
            //$caminho = $_FILES['foto']['name'];
			//move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);
			$foto = imagecreatefromall($_FILES['foto']['tmp_name'], $_FILES['foto']['name']);
			if(imagesx($foto) < imagesy($foto)) {
				$siz_x = 106;
				$siz_y = 140;
			} else {
				$siz_x = 106;
				$siz_y = 80;
			}
			$imagem = imagecreatetruecolor($siz_x, $siz_y);
			$white = imagecolorallocate($imagem, 255, 255, 255);
			if(!imagecopyresized($imagem, $foto, 0, 0, 0, 0, $siz_x, $siz_y, imagesx($foto), imagesy($foto))) {
				echo '<script>alert("Favor enviar apenas fotos com\ntamanho menor que 1MB!")</script>'; die();
			}
            imagejpeg($imagem, 'teste.jpg');
            $img_data = addslashes(file_get_contents('teste.jpg'));
            $check = mysql_num_rows(mysql_query("SELECT * FROM `pacientes` WHERE `codigo` = '".$_GET['codigo']."'"));
            if($check > 0) {
                $sql = "UPDATE `pacientes` SET `foto` = '".$img_data."' WHERE `codigo` = '".$_GET['codigo']."'";
            } else {
                $sql = "INSERT INTO `pacientes` (`codigo`, `foto`) VALUES ('".$_GET['codigo']."', '".$img_data."')";
            }
            unlink('teste.jpg');
            mysql_query($sql) or die(mysql_error());
		}
	}
	$disable = '';
	$href = 'href=';
	$onclick = 'onclick=';
	if($_GET['disabled'] == 'yes') { //if(checknivel('Dentista') || checknivel('Funcionario')) {
		$disable = 'disabled';
		$href = '';
		$onclick = '';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerenciador Cl�nico SmilePrev - Administra��o Odontol�gica Em Suas M�os</title>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../lib/script.js"></script>
</head>
<body style="background-color: #F0F0F0"><center>
<?
    $sql = "SELECT `foto` FROM `pacientes` WHERE `codigo` = '".$_GET['codigo']."'";
    $query = mysql_query($sql) or die('Erro: '. mysql_error());
    $row = mysql_fetch_array($query);
	if($row['foto'] != '') {
		echo '<img src="verfoto_p.php?codigo='.$_GET['codigo'].'" border="0">';
	} else {
		echo '<img src="verfoto_p.php?codigo='.$_GET['codigo'].'&padrao=no_photo" border="0">';
	}
?><br><br>
<form action="fotos.php?codigo=<?=$_GET['codigo']?>" method="POST" enctype="multipart/form-data" target="_self">
<input type="file" <?=$disable?> name="foto" size="5" class="forms"><br>
<input type="submit" <?=$disable?> class="forms" value="Enviar" name="send">
</form>
<br>
<a <?=$href?>"fotos.php?codigo=<?=$_GET['codigo']?>" <?=$onclick?>"return confirmLink(this)">Excluir foto</a>
</body>
</html>
