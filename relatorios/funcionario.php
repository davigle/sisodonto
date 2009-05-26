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
    $funcionario = new TFuncionarios();
    $funcionario->LoadFuncionario($_GET['cpf']);
?>
<p align="center"><font size="3"><b>FICHA DE CADASTRO DE FUNCIONÁRIO</b></font></p><br />
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
            Nome:<br />
            <b><?=$funcionario->RetornaDados('nome')?></b>&nbsp;
          </td>
          <td width="23%">
            CPF:<br />
            <b><?=$funcionario->RetornaDados('cpf')?></b>&nbsp;
          </td>
          <td width="26%" rowspan="8" valign="top" align="center">
<?
    if($funcionario->RetornaDados('foto') != '') {
		echo '<img src="../funcionarios/verfoto_p.php?cpf='.$funcionario->RetornaDados('cpf').'" border="0">';
	} else {
		echo '<img src="../funcionarios/verfoto_p.php?cpf='.$funcionario->RetornaDados('cpf').'&padrao=no_photo" border="0">';
	}
?>
          </td>
        </tr>
        <tr>
          <td>
            RG:<br />
            <b><?=$funcionario->RetornaDados('rg')?></b>&nbsp;
          </td>
          <td>
            Estado Civil:<br />
            <b><?=$funcionario->RetornaDados('estadocivil')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Endereço:<br />
            <b><?=$funcionario->RetornaDados('endereco')?></b>&nbsp;
          </td>
          <td>
            Bairro:<br />
            <b><?=$funcionario->RetornaDados('bairro')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Cidade:<br />
            <b><?=$funcionario->RetornaDados('cidade')?></b>&nbsp;
          </td>
          <td>
            Estado:<br />
            <b><?=$funcionario->RetornaDados('estado')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            CEP:<br />
            <b><?=$funcionario->RetornaDados('cep')?></b>&nbsp;
          </td>
          <td>
            Nascimento:<br />
            <b><?=converte_data($funcionario->RetornaDados('nascimento'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Telefone 1:<br />
            <b><?=$funcionario->RetornaDados('telefone1')?></b>&nbsp;
          </td>
          <td>
            Telefone 2:<br />
            <b><?=$funcionario->RetornaDados('telefone2')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Celular:<br />
            <b><?=$funcionario->RetornaDados('celular')?></b>&nbsp;
          </td>
          <td>
            Sexo:<br />
            <b><?=$funcionario->RetornaDados('sexo')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            E-mail:<br />
            <b><?=$funcionario->RetornaDados('email')?></b>&nbsp;
          </td>
          <td>
            <br />
            &nbsp;
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
          <td>Nome da Mâe:<br />
          <b><?=$funcionario->RetornaDados('nomemae')?></b>&nbsp;
          </td>
          <td>Nascimento:<br />
          <b><?=converte_data($funcionario->RetornaDados('nascimentomae'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td width="60%">Nome do Pai:<br />
          <b><?=$funcionario->RetornaDados('nomepai')?></b>&nbsp;
          </td>
          <td width="40%">Nascimento:<br />
          <b><?=converte_data($funcionario->RetornaDados('nascimentopai'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">Endereço completo:<br />
          <?=$funcionario->RetornaDados('enderecofamiliar')?>&nbsp;
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
    <th align="left">Informações Profissionais
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="50%">Função Exercida - Principal:<br />
          <b><?=$funcionario->RetornaDados('funcao1')?></b>&nbsp;
          </td>
          <td width="50%">Função Exercida - Secundária:<br />
          <b><?=$funcionario->RetornaDados('funcao2')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Data de Admissão:<br />
          <b><?=converte_data($funcionario->RetornaDados('admissao'), 2)?></b>&nbsp;
          </td>
          <td>Data de Demissão:<br />
          <b><?=converte_data($funcionario->RetornaDados('demissao'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Observações:<br />
          <b><?=nl2br($funcionario->RetornaDados('observacoes'))?></b>&nbsp;
          </td>
          <td>Ativo na Clínica?<br />
          <b><?=nl2br($funcionario->RetornaDados('ativo'))?></b>&nbsp;
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
