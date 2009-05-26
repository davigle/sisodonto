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
    $dentista = new TDentistas();
    $dentista->LoadDentista($_GET['cpf_dentista']);
    $especialidades = new TEspecialidades($dentista->RetornaDados('codigo_areaatuacao1'));
    $area1 = $especialidades->GetDescricao();
    $especialidades = new TEspecialidades($dentista->RetornaDados('codigo_areaatuacao2'));
    $area2 = $especialidades->GetDescricao();
    $especialidades = new TEspecialidades($dentista->RetornaDados('codigo_areaatuacao3'));
    $area3 = $especialidades->GetDescricao();
?>
<p align="center"><font size="3"><b>FICHA DE CADASTRO DE PROFISSIONAL</b></font></p><br />
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
            <b><?=$dentista->RetornaDados('nome')?></b>&nbsp;
          </td>
          <td width="23%">
            CPF:<br />
            <b><?=$dentista->RetornaDados('cpf')?></b>&nbsp;
          </td>
          <td width="26%" rowspan="8" valign="top" align="center">
<?
    if($dentista->RetornaDados('foto') != '') {
		echo '<img src="../dentistas/verfoto_p.php?cpf='.$dentista->RetornaDados('cpf').'" border="0">';
	} else {
		echo '<img src="../dentistas/verfoto_p.php?cpf='.$dentista->RetornaDados('cpf').'&padrao=no_photo" border="0">';
	}
?>
          </td>
        </tr>
        <tr>
          <td>
            Endereço:<br />
            <b><?=$dentista->RetornaDados('endereco')?></b>&nbsp;
          </td>
          <td>
            Bairro:<br />
            <b><?=$dentista->RetornaDados('bairro')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Cidade:<br />
            <b><?=$dentista->RetornaDados('cidade')?></b>&nbsp;
          </td>
          <td>
            Estado:<br />
            <b><?=$dentista->RetornaDados('estado')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            CEP:<br />
            <b><?=$dentista->RetornaDados('cep')?></b>&nbsp;
          </td>
          <td>
            Nascimento:<br />
            <b><?=converte_data($dentista->RetornaDados('nascimento'), 2)?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Telefone 1:<br />
            <b><?=$dentista->RetornaDados('telefone1')?></b>&nbsp;
          </td>
          <td>
            Celular:<br />
            <b><?=$dentista->RetornaDados('celular')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Telefone 2:<br />
            <b><?=$dentista->RetornaDados('telefone2')?></b>&nbsp;
          </td>
          <td>
            Sexo:<br />
            <b><?=$dentista->RetornaDados('sexo')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            Nome da Mãe ou do Pai:<br />
            <b><?=$dentista->RetornaDados('nomemae')?></b>&nbsp;
          </td>
          <td>
            RG:<br />
            <b><?=$dentista->RetornaDados('rg')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>
            E-mail:<br />
            <b><?=$dentista->RetornaDados('email')?></b>&nbsp;
          </td>
          <td>
            Comissão:<br />
            <b><?=(($_GET['cpf_dentista'] != '')?$dentista->RetornaDados('comissao').' %':'')?></b>&nbsp;
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
          <td>Área de atuação - Especialidade 1<br />
          <b><?=$area1?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Área de atuação - Especialidade 2<br />
          <b><?=$area2?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Área de atuação - Especialidade 3<br />
          <b><?=$area3?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><b><?=(($_GET['cpf_dentista'] != '')?$dentista->RetornaDados('conselho_tipo').'/'.$dentista->RetornaDados('conselho_estado').' '.$dentista->RetornaDados('conselho_numero'):'')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Ativo na Clínica?<br />
          <b><?=$dentista->RetornaDados('ativo')?></b>&nbsp;
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
