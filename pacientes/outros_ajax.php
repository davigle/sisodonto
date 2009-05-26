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
	$paciente = new TPacientes();
	if(isset($_POST[Salvar])) {	
		$obrigatorios[1] = 'codigo';
		$obrigatorios[] = 'nom';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
				$r[$i] = '<font color="#FF0000">';
			    $j++;
			}
		}
		if($_POST[cpf] != "" && !is_valid_cpf($_POST[cpf], 'pacientes') && ($_POST[cpf_ant] != $_POST[cpf])) {
			$j++;
			$r[3] = '<font color="#FF0000">';
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$paciente->LoadPaciente($_POST[codigo]);
				$strScrp = "Ajax('pacientes/gerenciar', 'conteudo', '')";
			}
			$paciente->SetDados('codigo', $_POST[codigo]);
			$paciente->SetDados('nome', htmlspecialchars($_POST[nom], ENT_QUOTES));
			$paciente->SetDados('cpf', $_POST[cpf]);
			$paciente->SetDados('rg', $_POST[rg]);
			$paciente->SetDados('estadocivil', $_POST[estadocivil]);
			$paciente->SetDados('sexo', $_POST[sexo]);
			$paciente->SetDados('etnia', $_POST[etnia]);
			$paciente->SetDados('profissao', $_POST[profissao]);
			$paciente->SetDados('naturalidade', $_POST[naturalidade]);
			$paciente->SetDados('nacionalidade', $_POST[nacionalidade]);
			$paciente->SetDados('nascimento', converte_data($_POST[nascimento], 1));
			$paciente->SetDados('endereco', $_POST[endereco]);
			$paciente->SetDados('bairro', $_POST[bairro]);
			$paciente->SetDados('cidade', $_POST[cidade]);
			$paciente->SetDados('estado', $_POST[estado]);
			$paciente->SetDados('cep', $_POST[cep]);
			$paciente->SetDados('celular', $_POST[celular]);
			$paciente->SetDados('telefone1', $_POST[telefone1]);
			$paciente->SetDados('telefone2', $_POST[telefone2]);
			$paciente->SetDados('hobby', $_POST[hobby]);
			$paciente->SetDados('indicadopor', $_POST[indicadopor]);
			$paciente->SetDados('email', $_POST[email]);
			$paciente->SetDados('cpf_dentistaprocurado', $_POST[cpf_dentistaprocurado]);
			$paciente->SetDados('cpf_dentistaatendido', $_POST[cpf_dentistaatendido]);
			$paciente->SetDados('cpf_dentistaencaminhado', $_POST[cpf_dentistaencaminhado]);
			$paciente->SetDados('nomemae', $_POST[nomemae]);
			$paciente->SetDados('nascimentomae', converte_data($_POST[nascimentomae], 1));
			$paciente->SetDados('profissaomae', $_POST[profissaomae]);
			$paciente->SetDados('nomepai', $_POST[nomepai]);
			$paciente->SetDados('nascimentopai', converte_data($_POST[nascimentopai], 1));
			$paciente->SetDados('profissaopai', $_POST[profissaopai]);
			$paciente->SetDados('telefone1pais', $_POST[telefone1pais]);
			$paciente->SetDados('telefone2pais', $_POST[telefone2pais]);
			$paciente->SetDados('enderecofamiliar', $_POST[enderecofamiliar]);
			$paciente->SetDados('datacadastro', converte_data($_POST[datacadastro], 1));
			$paciente->SetDados('dataatualizacao', date(Y.'-'.m.'-'.d));
			$paciente->SetDados('status', $_POST[status]);
			$paciente->SetDados('objetivo', $_POST[objetivo]);
			$paciente->SetDados('observacoes', $_POST[observacoes]);
			$paciente->SetDados('convenio', $_POST[convenio]);
			$paciente->SetDados('outros', $_POST[outros]);
			$paciente->SetDados('matricula', $_POST[matricula]);
			$paciente->SetDados('titular', $_POST[titular]);
			$paciente->SetDados('validadeconvenio', $_POST[validadeconvenio]);
			if($_GET[acao] != "editar") {
				$paciente->SalvarNovo();
				$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('pacientes/incluir', 'conteudo', 'codigo=".$_POST[codigo]."&acao=editar')";
			}
			$paciente->Salvar();
		}
	}
	$strUpCase = "ALTERAÇÂO";
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$paciente->LoadPaciente($_GET[codigo]);
	$row = $paciente->RetornaTodosDados();
	$row[nascimento] = converte_data($row[nascimento], 2);
	$row[nascimentomae] = converte_data($row[nascimentomae], 2);
	$row[nascimentopai] = converte_data($row[nascimentopai], 2);
	$row[datacadastro] = converte_data($row[datacadastro], 2);
	$acao = '&acao=editar';
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
      <td height="26">&nbsp;OUTROS</td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <p align="left">
          <br />
          <ul>
            <li><a href="relatorios/agenda.php?codigo=<?=$_GET['codigo']?>" target="_blank">Relatório de consultas agendadas</a><br />&nbsp;</li>
<?
	if(checknivel('Dentista')) {
?>
            <li><a href="relatorios/receita.php?codigo=<?=$_GET['codigo']?>&acao=editar" target="_blank">Imprimir Receita</a><br />&nbsp;</li>
            <li><a href="relatorios/atestado.php?codigo=<?=$_GET['codigo']?>&acao=editar" target="_blank">Imprimir Atestado</a><br />&nbsp;</li>
            <li><a href="relatorios/exame.php?codigo=<?=$_GET['codigo']?>&acao=editar" target="_blank">Imprimir Pedido de Exame(s)</a><br />&nbsp;</li>
            <li><a href="relatorios/encaminhamento.php?codigo=<?=$_GET['codigo']?>&acao=editar" target="_blank">Imprimir Encaminhamento</a><br />&nbsp;</li>
            <li><a href="relatorios/laudo.php?codigo=<?=$_GET['codigo']?>&acao=editar" target="_blank">Imprimir Laudo/Parecer Odontológico</a><br />&nbsp;</li>
            <li><a href="relatorios/agradecimento.php?codigo=<?=$_GET['codigo']?>&acao=editar" target="_blank">Imprimir Agradecimento pelo Encaminhamento</a><br />&nbsp;</li>
<?
	}
?>
          </ul>
  <br />
        </p>
        </fieldset>
        <br />
        <div align="center"></div>
      </form>      </td>
    </tr>
  </table>
