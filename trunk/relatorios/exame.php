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
alert("Para imprimir o exame, você deve configurar a página no Internet Explorer\ncom margens superiores de 0 milímetros.\nAs demais deverão ser de 19,05 milímetros cada.");
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
