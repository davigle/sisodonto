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
	header("Content-type: text/html; charset=ISO-8859-15", true);
	if(!checklog()) {
		die($frase_log);
	}
	include "../timbre_head.php";
    if($_GET['codigo'] != '') {
        $paciente = new TPacientes();
        $paciente->LoadPaciente($_GET['codigo']);
        $dentista = new TDentistas();
        $dentista->LoadDentista($paciente->RetornaDados('cpf_dentistaprocurado'));
        $dentista_procurado = (($dentista->RetornaDados('nome') != '')?$dentista->RetornaDados('titulo').' '.$dentista->RetornaDados('nome'):'');
        $dentista->LoadDentista($paciente->RetornaDados('cpf_dentistaatendido'));
        $dentista_atendido = (($dentista->RetornaDados('nome') != '')?'<b>'.$dentista->RetornaDados('titulo').' '.$dentista->RetornaDados('nome'):'');
        $dentista->LoadDentista($paciente->RetornaDados('cpf_dentistaencaminhado'));
        $dentista_encaminhado = (($dentista->RetornaDados('nome') != '')?'<b>'.$dentista->RetornaDados('titulo').' '.$dentista->RetornaDados('nome'):'');
    }
?>
<p align="center"><font size="3"><b>FICHA DE CADASTRO DE PACIENTE</b></font></p><br />
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <th align="left">Informações Pessoais
    </th>
  </tr>
  <tr style="font-size: 12px">
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="51%">
            Número do Paciente:<br />
            <b><?=$paciente->RetornaDados('codigo')?></b>&nbsp;
          </td>
          <td width="23%">
            &nbsp;
          </td>
          <td width="26%" rowspan="12" valign="top" align="center">
<?
    if($paciente->RetornaDados('foto') != '') {
		echo '<img src="../pacientes/verfoto_p.php?codigo='.$paciente->RetornaDados('codigo').'" border="0">';
	} else {
		echo '<img src="../pacientes/verfoto_p.php?codigo='.$paciente->RetornaDados('codigo').'&padrao=no_photo" border="0">';
	}
?>
          </td>
        </tr>
        <tr>
          <td>
            Nome:<br />
            <b><?=$paciente->RetornaDados('nome')?></b>&nbsp;
          </td>
          <td>
            CPF:<br />
            <b><?=$paciente->RetornaDados('cpf')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            RG:<br />
            <b><?=$paciente->RetornaDados('rg')?></b>&nbsp;
          </td>
          <td>
            Estado Civil:<br />
            <b><?=$paciente->RetornaDados('estadocivil')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Sexo:<br />
            <b><?=$paciente->RetornaDados('sexo')?></b>&nbsp;
          </td>
          <td>
            Etnia:<br />
            <b><?=$paciente->RetornaDados('etnia')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Profissão:<br />
            <b><?=$paciente->RetornaDados('profissao')?></b>&nbsp;
          </td>
          <td>
            Naturalidade:<br />
            <b><?=$paciente->RetornaDados('naturalidade')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Nacionalidade:<br />
            <b><?=$paciente->RetornaDados('nacionalidade')?></b>&nbsp;
          </td>
          <td>
            Nascimento:<br />
            <b><?=converte_data($paciente->RetornaDados('nascimento'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Endereço:<br />
            <b><?=$paciente->RetornaDados('endereco')?></b>&nbsp;
          </td>
          <td>
            Bairro:<br />
            <b><?=$paciente->RetornaDados('bairro')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Cidade:<br />
            <b><?=$paciente->RetornaDados('cidade')?></b>&nbsp;
          </td>
          <td>
            Estado:<br />
            <b><?=$paciente->RetornaDados('estado')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            CEP:<br />
            <b><?=$paciente->RetornaDados('cep')?></b>&nbsp;
          </td>
          <td>
            Celular:<br />
            <b><?=$paciente->RetornaDados('celular')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Telefone Residencial:<br />
            <b><?=$paciente->RetornaDados('telefone1')?></b>&nbsp;
          </td>
          <td>
            Telefone Comercial:<br />
            <b><?=$paciente->RetornaDados('telefone2')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Hobby:<br />
            <b><?=$paciente->RetornaDados('hobby')?></b>&nbsp;
          </td>
          <td>
            Indicado por:<br />
            <b><?=$paciente->RetornaDados('indicadopor')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            E-mail:<br />
            <b><?=$paciente->RetornaDados('email')?></b>&nbsp;
          </td>
          <td>
            Observações:<br />
            <b><?=$paciente->RetornaDados('obs_etiqueta')?></b>&nbsp;
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;
    </td>
  </tr>
  <tr>
    <th align="left">Tratamento a Executar / Executados
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Ortodontia') !== false)?'checked':'')?>>Ortodontia
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Implantodontia') !== false)?'checked':'')?>>Implantodontia
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Dentística') !== false)?'checked':'')?>>Dentística
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Prótese') !== false)?'checked':'')?>>Prótese
          </td>
        </tr>
        <tr>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Odontopediatria') !== false)?'checked':'')?>>Odontopediatria
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Cirurgia') !== false)?'checked':'')?>>Cirurgia
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Endodontia') !== false)?'checked':'')?>>Endodontia
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Periodontia') !== false)?'checked':'')?>>Periodontia
          </td>
        </tr>
        <tr>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Radiologia') !== false)?'checked':'')?>>Radiologia
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'DTM') !== false)?'checked':'')?>>DTM
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Odontogeriatria') !== false)?'checked':'')?>>Odontogeriatria
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Ortopedia') !== false)?'checked':'')?>>Ortopedia
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;
    </td>
  </tr>
  <tr>
    <th align="left">Informações do Dentista
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td>Dentista Procurado:<br />
          <b><?=$dentista_procurado?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Atendido por:<br />
          <b><?=$dentista_atendido?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Encaminhado para:<br />
          <b><?=$dentista_encaminhado?></b>&nbsp;
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;
    </td>
  </tr>
  <tr>
    <th align="left">Informações Familiares
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="60%">Nome do Pai:<br />
          <b><?=$paciente->RetornaDados('nomepai')?></b>&nbsp;
          </td>
          <td width="40%">Nascimento:<br />
          <b><?=converte_data($paciente->RetornaDados('nascimentopai'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Profissão do Pai:<br />
          <b><?=$paciente->RetornaDados('profissaopai')?></b>&nbsp;
          </td>
          <td>Telefone:<br />
          <b><?=$paciente->RetornaDados('telefone1pais')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Nome da Mãe:<br />
          <b><?=$paciente->RetornaDados('nomemae')?></b>&nbsp;
          </td>
          <td>Nascimento:<br />
          <b><?=converte_data($paciente->RetornaDados('nascimentomae'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Profissão da Mãe:<br />
          <b><?=$paciente->RetornaDados('profissaomae')?></b><br />&nbsp;
          </td>
          <td>Telefone:<br />
          <b><?=$paciente->RetornaDados('telefone2pais')?></b><br />&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">Endereço completo:<br />
          <b><?=$paciente->RetornaDados('enderecofamiliar')?></b>&nbsp;
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;
    </td>
  </tr>
  <tr>
    <th align="left">Informações Extras
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="50%">Data de Cadastro:<br />
          <b><?=converte_data($paciente->RetornaDados('datacadastro'), 2)?></b>&nbsp;
          </td>
          <td width="50%">Última Atualização:<br />
          <b><?=converte_data($paciente->RetornaDados('dataatualizacao'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">Situação Atual do Paciente:<br />
          <b><?=$paciente->RetornaDados('status')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Objetivo Principal da Consulta:<br />
          <b><?=nl2br($paciente->RetornaDados('objetivo'))?></b>&nbsp;
          </td>
          <td>Observações:<br />
          <b><?=nl2br($paciente->RetornaDados('observacoes'))?></b>&nbsp;
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;
    </td>
  </tr>
  <tr>
    <th align="left">Informações do Convênio/Plano
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="40%">Convênio/Plano:<br />
          <b><?=$paciente->RetornaDados('convenio')?></b>&nbsp;
          </td>
          <td width="60%">Outros:<br />
          <b><?=$paciente->RetornaDados('outros')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Número do Cartão (matrícula):<br />
          <b><?=$paciente->RetornaDados('matricula')?></b>&nbsp;
          </td>
          <td>Titular:<br />
          <b><?=$paciente->RetornaDados('titular')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">Validade do Convênio/Plano:<br />
          <b><?=$paciente->RetornaDados('validadeconvenio')?></b>&nbsp;
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<script>
alert("Para imprimir o relatório, você deve configurar a página no Internet Explorer\ncom margens superiores de 0 milímetros.\nAs demais deverão ser de 19,05 milímetros cada.");
window.print();
</script>
<?
    include "../timbre_foot.php";
?>
