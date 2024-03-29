<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2009
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
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endere�o:
    *
    * Smile Odontol�ogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
    header("Content-type: text/html; charset=ISO-8859-1", true);
    if(!checklog()) {
        die($frase_log);
    }
    include "../timbre_head.php";
    $paciente = new TPacientes();
	$clinica = new TClinica();
	$agradecimento = new TAgradecimento();
	$agradecimento->Codigo_Paciente = $_GET['codigo'];
	$agradecimento->LoadInfo();
	if($agradecimento->Agradecimento == '') {
        $agradecimento->SalvarNovo();
	}
	if(isset($_POST['send'])) {
        $agradecimento->Agradecimento = htmlspecialchars(trim($_POST['agradecimento']), ENT_QUOTES);
        $agradecimento->Salvar();
	}
    $paciente->LoadPaciente($_GET['codigo']);
	$clinica->LoadInfo();
	$agradecimento->LoadInfo();
?>
<br />
<div align="center"><font size="4"><b><?=$LANG['reports']['thanks']?></b></font></div><br /><br />
<font size="2"><?=$LANG['reports']['patient']?>:<br />
<b><?=$paciente->RetornaDados('nome')?></b><br /></font><br /><br />
<br />
<?
    if($_GET['acao'] == 'editar') {
?>
<div align="center">
<form action="agradecimento.php?codigo=<?=$_GET['codigo']?>" method="POST">
<textarea name="agradecimento" class="forms" cols="130" rows="30"><?=$agradecimento->Agradecimento?></textarea><br />
<br />
<input type="submit" name="send" value="<?=$LANG['reports']['send']?>" class="forms">
</form>
</div>
<?
    } else {
?>
<div align="justify">
<?=nl2br($agradecimento->Agradecimento)?>
</div>
<script>
window.print();
</script>
<?
    }
?>
<div align="center">
<br /><br /><br /><br /><br /><br /><br /><br />
<?=$clinica->Cidade.'/'.$clinica->Estado.', '.date('d').' '.$LANG['reports']['of'].' '.nome_mes(date('m')).' '.$LANG['reports']['of'].' '.date('Y')?>
<br /><br /><br /><br /><br /><br />
<?=(($_SESSION['sexo'] == 'Masculino')?'Dr.':'Dra.').' '.$_SESSION['nome']?><br />
<?=$_SESSION['conselho_tipo'].'/'.$_SESSION['conselho_estado'].' '.$_SESSION['conselho_numero']?>
</div>
<?
    include "../timbre_foot.php";
?>
