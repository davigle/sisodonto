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
    <th align="left">Informa��es Pessoais
    </th>
  </tr>
  <tr style="font-size: 12px">
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="51%">
            N�mero do Paciente:<br />
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
            Profiss�o:<br />
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
            Endere�o:<br />
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
            Observa��es:<br />
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
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Dent�stica') !== false)?'checked':'')?>>Dent�stica
          </td>
          <td><input type="checkbox" disabled <?=((strpos($paciente->RetornaDados('tratamento'), 'Pr�tese') !== false)?'checked':'')?>>Pr�tese
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
    <th align="left">Informa��es do Dentista
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
    <th align="left">Informa��es Familiares
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
          <td>Profiss�o do Pai:<br />
          <b><?=$paciente->RetornaDados('profissaopai')?></b>&nbsp;
          </td>
          <td>Telefone:<br />
          <b><?=$paciente->RetornaDados('telefone1pais')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Nome da M�e:<br />
          <b><?=$paciente->RetornaDados('nomemae')?></b>&nbsp;
          </td>
          <td>Nascimento:<br />
          <b><?=converte_data($paciente->RetornaDados('nascimentomae'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Profiss�o da M�e:<br />
          <b><?=$paciente->RetornaDados('profissaomae')?></b><br />&nbsp;
          </td>
          <td>Telefone:<br />
          <b><?=$paciente->RetornaDados('telefone2pais')?></b><br />&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">Endere�o completo:<br />
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
    <th align="left">Informa��es Extras
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="50%">Data de Cadastro:<br />
          <b><?=converte_data($paciente->RetornaDados('datacadastro'), 2)?></b>&nbsp;
          </td>
          <td width="50%">�ltima Atualiza��o:<br />
          <b><?=converte_data($paciente->RetornaDados('dataatualizacao'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">Situa��o Atual do Paciente:<br />
          <b><?=$paciente->RetornaDados('status')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Objetivo Principal da Consulta:<br />
          <b><?=nl2br($paciente->RetornaDados('objetivo'))?></b>&nbsp;
          </td>
          <td>Observa��es:<br />
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
    <th align="left">Informa��es do Conv�nio/Plano
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="40%">Conv�nio/Plano:<br />
          <b><?=$paciente->RetornaDados('convenio')?></b>&nbsp;
          </td>
          <td width="60%">Outros:<br />
          <b><?=$paciente->RetornaDados('outros')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>N�mero do Cart�o (matr�cula):<br />
          <b><?=$paciente->RetornaDados('matricula')?></b>&nbsp;
          </td>
          <td>Titular:<br />
          <b><?=$paciente->RetornaDados('titular')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">Validade do Conv�nio/Plano:<br />
          <b><?=$paciente->RetornaDados('validadeconvenio')?></b>&nbsp;
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<script>
alert("Para imprimir o relat�rio, voc� deve configurar a p�gina no Internet Explorer\ncom margens superiores de 0 mil�metros.\nAs demais dever�o ser de 19,05 mil�metros cada.");
window.print();
</script>
<?
    include "../timbre_foot.php";
?>
