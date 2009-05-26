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
	//header("Content-type: image/jpeg", true);
	if(!checklog()) {
		die($frase_log);
	}
	if(!empty($_FILES['arquivo']['name'])) {
		$codigo = next_autoindex('fotospacientes');
		//$caminho = "fotos/".$_GET[codigo]."/".$codigo.".jpg";
		$foto = imagecreatefromall($_FILES['arquivo']['tmp_name'], $_FILES['arquivo']['name']);
		if(imagesx($foto) < imagesy($foto)) {
			$siz_x = 222;
			$siz_y = 291;
		} else {
			$siz_x = 222;
			$siz_y = 169;
		}
		$imagem = imagecreatetruecolor($siz_x, $siz_y);
		$white = imagecolorallocate($imagem, 255, 255, 255);
		if(!imagecopyresized($imagem, $foto, 0, 0, 0, 0, $siz_x, $siz_y, imagesx($foto), imagesy($foto))) {
			echo '<script>alert("Favor enviar apenas fotos com\ntamanho menor que 1MB!")</script>'; die();
		}
		imagejpeg($imagem, 'teste.jpg');
        $img_data = addslashes(file_get_contents('teste.jpg'));
        $sql = "INSERT INTO `fotospacientes` (`codigo_paciente`, `foto`, `legenda`) VALUES ('".$_GET['codigo']."', '".$img_data."', '".htmlspecialchars(trim($_POST['legenda']), ENT_QUOTES)."')";
        unlink('teste.jpg');
        mysql_query($sql) or die(mysql_error());
	}
?>
<script language="javascript" type="text/javascript">
window.parent.location.href="javascript:Ajax('pacientes/fotos', 'conteudo', 'codigo=<?=$_GET[codigo]?>&acao=editar')";
</script>
