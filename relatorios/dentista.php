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
    $dentista = new TDentistas();
    $dentista->LoadDentista($_GET['codigo_dentista']);
    $especialidades = new TEspecialidades($dentista->RetornaDados('codigo_areaatuacao1'));
    $area1 = $especialidades->GetDescricao();
    $especialidades = new TEspecialidades($dentista->RetornaDados('codigo_areaatuacao2'));
    $area2 = $especialidades->GetDescricao();
    $especialidades = new TEspecialidades($dentista->RetornaDados('codigo_areaatuacao3'));
    $area3 = $especialidades->GetDescricao();
?>
<p align="center"><font size="3"><b><?=$LANG['reports']['professional_sheet']?></b></font></p><br />
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
            <b><?=$dentista->RetornaDados('nome')?></b>&nbsp;
          </td>
          <td width="23%">
            <?=$LANG['reports']['document1']?>:<br />
            <b><?=$dentista->RetornaDados('cpf')?></b>&nbsp;
          </td>
          <td width="26%" rowspan="8" valign="top" align="center">
<?
    if($dentista->RetornaDados('foto') != '') {
		echo '<img src="../dentistas/verfoto_p.php?codigo='.$dentista->RetornaDados('codigo').'" border="0">';
	} else {
		echo '<img src="../dentistas/verfoto_p.php?codigo='.$dentista->RetornaDados('codigo').'&padrao=no_photo" border="0">';
	}
?>
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['address1']?>:<br />
            <b><?=$dentista->RetornaDados('endereco')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['address2']?>:<br />
            <b><?=$dentista->RetornaDados('bairro')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['city']?>:<br />
            <b><?=$dentista->RetornaDados('cidade')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['state']?>:<br />
            <b><?=$dentista->RetornaDados('estado')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['zip']?>:<br />
            <b><?=$dentista->RetornaDados('cep')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['birthdate']?>:<br />
            <b><?=converte_data($dentista->RetornaDados('nascimento'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['phone1']?>:<br />
            <b><?=$dentista->RetornaDados('telefone1')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['cellphone']?>:<br />
            <b><?=$dentista->RetornaDados('celular')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['phone2']?>:<br />
            <b><?=$dentista->RetornaDados('telefone2')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['gender']?>:<br />
            <b><?=(($dentista->RetornaDados('sexo') == 'Masculino')?$LANG['reports']['male']:$LANG['reports']['female'])?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['parents_name']?>:<br />
            <b><?=$dentista->RetornaDados('nomemae')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['document2']?>:<br />
            <b><?=$dentista->RetornaDados('rg')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            <?=$LANG['reports']['email']?>:<br />
            <b><?=$dentista->RetornaDados('email')?></b>&nbsp;
          </td>
          <td>
            <?=$LANG['reports']['comission']?>:<br />
            <b><?=(($_GET['codigo_dentista'] != '')?$dentista->RetornaDados('comissao').' %':'')?></b>&nbsp;
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
          <td><?=$LANG['reports']['acting_area1']?><br />
          <b><?=$area1?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><?=$LANG['reports']['acting_area2']?><br />
          <b><?=$area2?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><?=$LANG['reports']['acting_area3']?><br />
          <b><?=$area3?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><b><?=(($_GET['codigo_dentista'] != '')?$dentista->RetornaDados('conselho_tipo').'/'.$dentista->RetornaDados('conselho_estado').' '.$dentista->RetornaDados('conselho_numero'):'')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><?=$LANG['reports']['active_on_clinic']?><br />
          <b><?=(($dentista->RetornaDados('ativo') == 'Sim')?$LANG['reports']['yes']:$LANG['reports']['no'])?></b>&nbsp;
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
