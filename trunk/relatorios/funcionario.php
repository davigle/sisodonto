<?
   /**
    * Gerenciador Clínico Odontológico
    * Copyright (C) 2006 - 2009
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
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endereço:
    *
    * Smile Odontolóogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=ISO-8859-15", true);
	if(!checklog()) {
		die($frase_log);
	}
	include "../timbre_head.php";
    $funcionario = new TFuncionarios();
    $funcionario->LoadFuncionario($_GET['codigo']);
?>
<p align="center"><font size="3"><b><?=$LANG['reports']['employee_sheet']?></b></font></p><br />
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <th align="left"><?=$LANG['reports']['personal_information']?>
    </th>
  </tr>
  <tr style="font-size: 12px">
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="51%">
            <?=$LANG['reports']['name']?>:<br />
            <b><?=$funcionario->RetornaDados('nome')?></b>&nbsp;
          </td>
          <td width="23%">
            <?=$LANG['reports']['document1']?>:<br />
            <b><?=$funcionario->RetornaDados('cpf')?></b>&nbsp;
          </td>
          <td width="26%" rowspan="8" valign="top" align="center">
<?
    if($funcionario->RetornaDados('foto') != '') {
		echo '<img src="../funcionarios/verfoto_p.php?codigo='.$funcionario->RetornaDados('codigo').'" border="0">';
	} else {
		echo '<img src="../funcionarios/verfoto_p.php?codigo='.$funcionario->RetornaDados('codigo').'&padrao=no_photo" border="0">';
	}
?>
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['document2']?>:<br />
            <b><?=$funcionario->RetornaDados('rg')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['relationship_status']?>:<br />
            <b>
<?php
    switch($funcionario->RetornaDados('estadocivil')) {
        case 'solteiro': echo $_LANG['reports']['single']; break;
        case 'casado': echo $_LANG['reports']['married']; break;
        case 'divorciado': echo $_LANG['reports']['divorced']; break;
        case 'viuvo': echo $_LANG['reports']['widowed']; break;
    }
?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$_LANG['reports']['address1']?>:<br />
            <b><?=$funcionario->RetornaDados('endereco')?></b>&nbsp;
          </td>
          <td>
            <?=$_LANG['reports']['address2']?>:<br />
            <b><?=$funcionario->RetornaDados('bairro')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$_LANG['reports']['city']?>:<br />
            <b><?=$funcionario->RetornaDados('cidade')?></b>&nbsp;
          </td>
          <td>
            <?=$_LANG['reports']['state']?>:<br />
            <b><?=$funcionario->RetornaDados('estado')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$_LANG['reports']['zip']?>:<br />
            <b><?=$funcionario->RetornaDados('cep')?></b>&nbsp;
          </td>
          <td>
            <?=$_LANG['reports']['birthdate']?>:<br />
            <b><?=converte_data($funcionario->RetornaDados('nascimento'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$_LANG['reports']['phone1']?>:<br />
            <b><?=$funcionario->RetornaDados('telefone1')?></b>&nbsp;
          </td>
          <td>
            <?=$_LANG['reports']['phone2']?>:<br />
            <b><?=$funcionario->RetornaDados('telefone2')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$_LANG['reports']['cellphone']?>:<br />
            <b><?=$funcionario->RetornaDados('celular')?></b>&nbsp;
          </td>
          <td>
            <?=$_LANG['reports']['gender']?>:<br />
            <b><?=(($funcionario->RetornaDados('sexo') == 'Masculino')?$LANG['reports']['male']:$LANG['reports']['female'])?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$_LANG['reports']['email']?>:<br />
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
    <th align="left"><?=$_LANG['reports']['familiar_information']?>
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td><?=$_LANG['reports']['mothers_name']?>:<br />
          <b><?=$funcionario->RetornaDados('nomemae')?></b>&nbsp;
          </td>
          <td><?=$_LANG['reports']['birthdate']?>:<br />
          <b><?=converte_data($funcionario->RetornaDados('nascimentomae'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td width="60%"><?=$_LANG['reports']['fathers_name']?>:<br />
          <b><?=$funcionario->RetornaDados('nomepai')?></b>&nbsp;
          </td>
          <td width="40%"><?=$_LANG['reports']['birthdate']?>:<br />
          <b><?=converte_data($funcionario->RetornaDados('nascimentopai'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2"><?=$_LANG['reports']['complete_address']?>:<br />
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
    <th align="left"><?=$LANG['reports']['professional_information']?>
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td width="50%"><?=$LANG['reports']['main_function']?>:<br />
          <b><?=$funcionario->RetornaDados('funcao1')?></b>&nbsp;
          </td>
          <td width="50%"><?=$LANG['reports']['secondary_function']?>:<br />
          <b><?=$funcionario->RetornaDados('funcao2')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><?=$LANG['reports']['admission_date']?>:<br />
          <b><?=converte_data($funcionario->RetornaDados('admissao'), 2)?></b>&nbsp;
          </td>
          <td><?=$LANG['reports']['resignation_date']?>:<br />
          <b><?=converte_data($funcionario->RetornaDados('demissao'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><?=$LANG['reports']['comments']?>:<br />
          <b><?=nl2br($funcionario->RetornaDados('observacoes'))?></b>&nbsp;
          </td>
          <td><?=$LANG['reports']['active_on_clinic']?><br />
          <b><?=nl2br($funcionario->RetornaDados('ativo'))?></b>&nbsp;
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<script>
window.print();
</script>
<?
    include "../timbre_foot.php";
?>
