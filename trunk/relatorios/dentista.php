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
    <th align="left">Informa��es Pessoais
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
            Endere�o:<br />
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
            Nome da M�e ou do Pai:<br />
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
            Comiss�o:<br />
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
    <th align="left">Informa��es Profissionais
    </th>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td>�rea de atua��o - Especialidade 1<br />
          <b><?=$area1?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>�rea de atua��o - Especialidade 2<br />
          <b><?=$area2?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>�rea de atua��o - Especialidade 3<br />
          <b><?=$area3?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td><b><?=(($_GET['cpf_dentista'] != '')?$dentista->RetornaDados('conselho_tipo').'/'.$dentista->RetornaDados('conselho_estado').' '.$dentista->RetornaDados('conselho_numero'):'')?></b>&nbsp;
          </td>
        </tr>
        <tr>
          <td>Ativo na Cl�nica?<br />
          <b><?=$dentista->RetornaDados('ativo')?></b>&nbsp;
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
