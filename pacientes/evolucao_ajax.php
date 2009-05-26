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
	$paciente = new TEvolucao();
	if(isset($_POST[Salvar])) {
		/*if(is_array($_POST[procexecutado])) {
			foreach($_POST[procexecutado] as $codigo => $procexecutado) {
				$procprevisto = $_POST[procprevisto][$codigo];
				$cpf_dentista = $_POST[cpf_dentista][$codigo];
				$data = converte_data($_POST[data][$codigo], 1);
				$paciente->LoadEvolucao($codigo);
				$paciente->SetDados('procexecutado', $procexecutado);
				$paciente->SetDados('procprevisto', $procprevisto);
				$paciente->SetDados('cpf_dentista', $cpf_dentista);
				$paciente->SetDados('data', $data);
				$paciente->Salvar();
			}
		}*/
		if(!empty($_POST[procexecutado_new]) && !empty($_POST[procprevisto_new]) && !empty($_POST[data_new])) {
			$paciente->SetDados('codigo_paciente', $_GET[codigo]);
			$paciente->SetDados('procexecutado', $_POST[procexecutado_new]);
			$paciente->SetDados('procprevisto', $_POST[procprevisto_new]);
			$paciente->SetDados('cpf_dentista', $_POST[cpf_dentista_new]);
			$paciente->SetDados('data', converte_data($_POST[data_new], 1));
			$paciente->SalvarNovo();
			$paciente->Salvar();
		}
	}
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$acao = '&acao=editar';
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Dentistas"> <span class="h3">GERENCIAR PACIENTES &nbsp;[<?=$strLoCase?>] </span></td>
    </tr>
  </table>
<div class="conteudo" id="table dados">
<br />
<?include('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;EVOLU&Ccedil;&Atilde;O DO TRATAMENTO </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/evolucao_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td width="26%" height="20" bgcolor="#0099CC"><div align="center" class="style4">PROCEDIMENTO EXECUTADO </div></td>
            <td width="2%" bgcolor="#0099CC"><div align="center" class="style4">&nbsp;</div></td>
            <td width="26%" bgcolor="#0099CC"><div align="center" class="style4">PROCEDIMENTO PREVISTO </div></td>
            <td width="23%" bgcolor="#0099CC"><div align="center" class="style4">DENTISTA </div></td>
            <td width="14%" bgcolor="#0099CC"><div align="center" class="style4">DATA</div></td>
          </tr>
<?
	$paciente->SetDados('codigo_paciente', $_GET[codigo]);
	$lista = $paciente->ListEvolucao();
	if(is_array($lista)) {
		foreach($lista as $chave => $codigo) {
			$paciente->LoadEvolucao($codigo);
			if($chave % 2 == 0) {
				$td = 'td_even';
			} else {
				$td = 'td_odd';
			}
?>
          <tr class="<?=$td?>">
            <td height="23"><div align="left"><?=$paciente->RetornaDados('procexecutado')?></div></td>
            <td></td>
            <td><div align="left"><?=$paciente->RetornaDados('procprevisto')?></div></td>
            <td><div align="left">
<?
			$dentista = new TDentistas();
			$lista = $dentista->LoadDentista($paciente->RetornaDados('cpf_dentista'));
			$nome = explode(' ', $dentista->RetornaDados('nome'));
			$nome = $nome[0].' '.$nome[count($nome) - 1];
			echo $dentista->RetornaDados('titulo').' '.$nome;
?>       </td>
            <td><div align="center"><?=converte_data($paciente->RetornaDados('data'), 2)?></div></td>
          </tr>
<?
		}
	}
	if($td == "td_odd") {
		$td = 'td_even';
	} else {
		$td = 'td_odd';
	}
?>
          <tr class="<?=$td?>">
            <td><div align="left">
              <input name="procexecutado_new" id="procexecutado_new" type="text" class="forms" size="31" />
            </div></td>
            <td></td>
            <td><div align="left">
              <input name="procprevisto_new" type="text" class="forms" size="31" />
            </div></td>
            <td><div align="left"><select name="cpf_dentista_new" class="forms">
                <option></option>
<?
			$dentista = new TDentistas();
			$lista = $dentista->ListDentistas("SELECT * FROM `dentistas` WHERE `ativo` = 'Sim' ORDER BY `nome` ASC");
			for($i = 0; $i < count($lista); $i++) {
				$nome = explode(' ', $lista[$i][nome]);
				$nome = $nome[0].' '.$nome[count($nome) - 1];
				echo '<option value="'.$lista[$i][cpf].'">'.$lista[$i][titulo].' '.$nome.'</option>';
			}
?>       
			 </select></td>
            <td><div align="center">
              <input name="data_new" type="text" class="forms" value="<?=date(d.'/'.m.'/'.Y)?>" size="12" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />
            </div></td>
          </tr>
        </table>
        <br />
      </fieldset>
        <br />
        <div align="center">
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="Salvar" />
      </form>
       </div>
       <p align="center"><a href="relatorios/evolucao.php?codigo=<?=$_GET['codigo']?>" target="_blank">Imprimir Evolução</a></p>
      &nbsp;
      </td>
    </tr>
  </table>
<script>
document.getElementById('procexecutado_new').focus();
</script>
