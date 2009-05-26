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
    include "../timbre_head.php";
    $paciente = new TPacientes();
	$clinica = new TClinica();
	$exame = new TExame();
	$exame->Codigo_Paciente = $_GET['codigo'];
	$exame->LoadInfo();
	if($exame->Exame == '') {
        $exame->SalvarNovo();
	}
    if(isset($_POST['send'])) {
        $exame->Exame = htmlspecialchars(trim($_POST['exame']), ENT_QUOTES);
        $exame->Salvar();
	}
    $paciente->LoadPaciente($_GET['codigo']);
	$clinica->LoadInfo();
	$exame->LoadInfo();
?>
<br />
<div align="center"><font size="4"><b>P E D I D O &nbsp; D E &nbsp; E X A M E (S)</b></font></div><br /><br />
<font size="2">Paciente:<br />
<b><?=$paciente->RetornaDados('nome')?></b><br /></font><br /><br />
<br />
<?
    if($_GET['acao'] == 'editar') {
?>
<div align="center">
<form action="exame.php?codigo=<?=$_GET['codigo']?>" method="POST">
<textarea name="exame" class="forms" cols="130" rows="30"><?=$exame->Exame?></textarea><br />
<br />
<input type="submit" name="send" value="Enviar" class="forms">
</form>
</div>
<?
    } else {
?>
<div align="justify">
<?=nl2br($exame->Exame)?>
</div>
<script>
alert("Para imprimir o exame, voc� deve configurar a p�gina no Internet Explorer\ncom margens superiores de 0 mil�metros.\nAs demais dever�o ser de 19,05 mil�metros cada.");
window.print();
</script>
<?
    }
?>
<div align="center">
<br /><br /><br /><br /><br /><br /><br /><br />
<?=$clinica->Cidade.'/'.$clinica->Estado.', '.date('d').' de '.nome_mes(date('m')).' de '.date('Y')?>
<br /><br /><br /><br /><br /><br />
<?=(($_SESSION['sexo'] == 'Masculino')?'Dr.':'Dra.').' '.$_SESSION['nome']?><br />
<?=$_SESSION['conselho_tipo'].'/'.$_SESSION['conselho_estado'].' '.$_SESSION['conselho_numero']?>
</div>
<?
    include "../timbre_foot.php";
?>
