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
?>
<script language="JavaScript1.2" type="text/javascript">
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<script language="JavaScript1.2" type="text/javascript" src="mm_css_menu.js"></script>
<style type="text/css" media="screen">
	@import url("css/menu.css");
</style>
<script type="text/JavaScript">
<!--
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body onLoad="MM_preloadImages('imagens/menu/inicio_f2.jpg','imagens/menu/arquivo_f2.jpg','imagens/menu/financeiro_f2.jpg','imagens/menu/atualizacoes_f2.jpg','imagens/menu/utilitarios_f2.jpg','imagens/menu/configuracoes_f2.jpg','imagens/menu/ajuda_f2.jpg','imagens/menu/sair_f2.jpg','imagens/menu/pacientes_f2.jpg','imagens/menu/dentistas_f2.jpg','imagens/menu/funcionarios_f2.jpg','imagens/menu/fornecedores_f2.jpg','imagens/menu/caixa_f2.jpg','imagens/menu/agenda_f2.jpg','imagens/menu/patrimonio_f2.jpg','imagens/menu/telefones_f2.jpg')"><div id="FWTableContainer190501884">
  <table border="0" cellpadding="0" cellspacing="0" width="770">
    <tr>
      <td><img src="imagens/menu/spacer.gif" width="9" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="45" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="44" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="6" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="7" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="77" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="5" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="7" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="75" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="14" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="6" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="52" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="37" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="7" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="55" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="35" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="5" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="14" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="45" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="30" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="7" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="89" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="6" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="89" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="4" height="1" border="0" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="25"><img name="menu_r1_c1" src="imagens/menu/menu_r1_c1.jpg" width="770" height="8" border="0" id="menu_r1_c1" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="1" height="8" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="2"><a href="javascript:Ajax('wallpapers/index', 'conteudo', '')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('inicio','','imagens/menu/inicio_f2.jpg',1);"><img name="inicio" src="imagens/menu/inicio.jpg" width="54" height="16" border="0" id="inicio" alt="" /></a></td>
      <td colspan="3"><a href="javascript:;" onMouseOut="MM_swapImgRestore();MM_menuStartTimeout(60)" onMouseOver="MM_menuShowMenu('MMMenuContainer0009002858_0', 'MMMenu0009002858_0',0,16,'arquivo');MM_swapImage('arquivo','','imagens/menu/arquivo_f2.jpg',1);"><img name="arquivo" src="imagens/menu/arquivo.jpg" width="57" height="16" border="0" id="arquivo" alt="" /></a></td>
      <td><a href="javascript:;" onMouseOut="MM_swapImgRestore();MM_menuStartTimeout(60)" onMouseOver="MM_menuShowMenu('MMMenuContainer0009003253_1', 'MMMenu0009003253_1',0,16,'financeiro');MM_swapImage('financeiro','','imagens/menu/financeiro_f2.jpg',1);"><img name="financeiro" src="imagens/menu/financeiro.jpg" width="77" height="16" border="0" id="financeiro" alt="" /></a></td>
      <td colspan="3"><a href="javascript:;" onMouseOut="MM_swapImgRestore();MM_menuStartTimeout(60)" onMouseOver="MM_menuShowMenu('MMMenuContainer0009004027_2', 'MMMenu0009004027_2',0,16,'atualizacoes');MM_swapImage('atualizacoes','','imagens/menu/atualizacoes_f2.jpg',1);"><img name="atualizacoes" src="imagens/menu/atualizacoes.jpg" width="87" height="16" border="0" id="atualizacoes" alt="" /></a></td>
      <td colspan="3"><a href="javascript:;" onMouseOut="MM_swapImgRestore();MM_menuStartTimeout(60)" onMouseOver="MM_menuShowMenu('MMMenuContainer0009003937_3', 'MMMenu0009003937_3',0,16,'utilitarios');MM_swapImage('utilitarios','','imagens/menu/utilitarios_f2.jpg',1);"><img name="utilitarios" src="imagens/menu/utilitarios.jpg" width="72" height="16" border="0" id="utilitarios" alt="" /></a></td>
      <td colspan="3"><a href="javascript:;" onMouseOut="MM_swapImgRestore();MM_menuStartTimeout(60)" onMouseOver="MM_menuShowMenu('MMMenuContainer0009003732_4', 'MMMenu0009003732_4',0,16,'configuracoes');MM_swapImage('configuracoes','','imagens/menu/configuracoes_f2.jpg',1);"><img name="configuracoes" src="imagens/menu/configuracoes.jpg" width="99" height="16" border="0" id="configuracoes" alt="" /></a></td>
      <td colspan="3"><a href="javascript:Ajax('wallpapers/index', 'conteudo', '')" onMouseOut="MM_swapImgRestore();MM_menuStartTimeout(60)" onMouseOver="MM_menuShowMenu('MMMenuContainer0009003819_5', 'MMMenu0009003819_5',0,16,'ajuda');MM_swapImage('ajuda','','imagens/menu/ajuda_f2.jpg',1);"><img name="ajuda" src="imagens/menu/ajuda.jpg" width="54" height="16" border="0" id="ajuda" alt="" /></a></td>
      <td><a href="javascript:Ajax('wallpapers/sair', 'conteudo', '')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('sair','','imagens/menu/sair_f2.jpg',1);"><img name="sair" src="imagens/menu/sair.jpg" width="45" height="16" border="0" id="sair" alt="" /></a></td>
      <td colspan="6" rowspan="2" valign="top" background="imagens/menu/menu_r2_c20.jpg"><div id="saudacao" align="right">&nbsp;&nbsp;</div></td>
      <td><img src="imagens/menu/spacer.gif" width="1" height="16" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="19"><img name="menu_r3_c1" src="imagens/menu/menu_r3_c1.jpg" width="545" height="14" border="0" id="menu_r3_c1" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="1" height="14" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img name="menu_r4_c1" src="imagens/menu/menu_r4_c1.jpg" width="9" height="73" border="0" id="menu_r4_c1" alt="" /></td>
      <td colspan="2"><a href="javascript:Ajax('pacientes/gerenciar','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('pacientes','','imagens/menu/pacientes_f2.jpg',1);"><img name="pacientes" src="imagens/menu/pacientes.jpg" width="89" height="73" border="0" id="pacientes" alt="Gerenciar Pacientes" /></a></td>
      <td><img name="menu_r4_c4" src="imagens/menu/menu_r4_c4.jpg" width="6" height="73" border="0" id="menu_r4_c4" alt="" /></td>
      <td colspan="3"><a href="javascript:Ajax('dentistas/gerenciar','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('profissionais','','imagens/menu/profissionais_f2.jpg',1);"><img name="profissionais" src="imagens/menu/profissionais.jpg" width="89" height="73" border="0" id="profissionais" alt="Gerenciar Profissionais" /></a></td>
      <td><img name="menu_r4_c8" src="imagens/menu/menu_r4_c8.jpg" width="7" height="73" border="0" id="menu_r4_c8" alt="" /></td>
      <td colspan="2"><a href="javascript:Ajax('pagamentos/parcelas','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('pagamentos','','imagens/menu/pagamentos_f2.jpg',1);"><img name="funcionarios" src="imagens/menu/pagamentos.jpg" width="89" height="73" border="0" id="pagamentos" alt="Gerenciar Pagamentos" /></a></td>
      <td><img name="menu_r4_c11" src="imagens/menu/menu_r4_c11.jpg" width="6" height="73" border="0" id="menu_r4_c11" alt="" /></td>
      <td colspan="2"><a href="javascript:Ajax('fornecedores/gerenciar','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('fornecedores','','imagens/menu/fornecedores_f2.jpg',1);"><img name="fornecedores" src="imagens/menu/fornecedores.jpg" width="89" height="73" border="0" id="fornecedores" alt="Gerenciar Fornecedores" /></a></td>
      <td><img name="menu_r4_c14" src="imagens/menu/menu_r4_c14.jpg" width="7" height="73" border="0" id="menu_r4_c14" alt="" /></td>
      <td colspan="2"><a href="javascript:Ajax('caixa/caixa','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('caixa','','imagens/menu/caixa_f2.jpg',1);"><img name="caixa" src="imagens/menu/caixa.jpg" width="90" height="73" border="0" id="caixa" alt="Gerenciar Caixa" /></a></td>
      <td><img name="menu_r4_c17" src="imagens/menu/menu_r4_c17.jpg" width="5" height="73" border="0" id="menu_r4_c17" alt="" /></td>
      <td colspan="3"><a href="javascript:Ajax('agenda/agenda','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('agenda','','imagens/menu/agenda_f2.jpg',1);"><img name="agenda" src="imagens/menu/agenda.jpg" width="89" height="73" border="0" id="agenda" alt="Gerenciar Agenda" /></a></td>
      <td><img name="menu_r4_c21" src="imagens/menu/menu_r4_c21.jpg" width="7" height="73" border="0" id="menu_r4_c21" alt="" /></td>
      <td><a href="javascript:Ajax('estoque/estoque','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('estoque','','imagens/menu/estoque_f2.jpg',1);"><img name="patrimonio" src="imagens/menu/estoque.jpg" width="89" height="73" border="0" id="estoque" alt="Gerenciar Estoque" /></a></td>
      <td><img name="menu_r4_c23" src="imagens/menu/menu_r4_c23.jpg" width="6" height="73" border="0" id="menu_r4_c23" alt="" /></td>
      <td><a href="javascript:Ajax('telefones/gerenciar','conteudo','')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('telefones','','imagens/menu/telefones_f2.jpg',1);"><img name="telefones" src="imagens/menu/telefones.jpg" width="89" height="73" border="0" id="telefones" alt="Telefones &Uacute;teis" /></a></td>
      <td><img name="menu_r4_c25" src="imagens/menu/menu_r4_c25.jpg" width="4" height="73" border="0" id="menu_r4_c25" alt="" /></td>
      <td><img src="imagens/menu/spacer.gif" width="1" height="73" border="0" alt="" /></td>
    </tr>
  </table>
  <div id="MMMenuContainer0009002858_0">
    <div id="MMMenu0009002858_0" onMouseOut="MM_menuStartTimeout(60);" onMouseOver="MM_menuResetTimeout();"> <a href="javascript:Ajax('dentistas/gerenciar','conteudo','')" id="MMMenu0009002858_0_Item_0" class="MMMIFVStyleMMMenu0009002858_0" onMouseOver="MM_menuOverMenuItem('MMMenu0009002858_0');"> <img src="imagens/icons_menupop/dentista.gif" />&nbsp;&nbsp;Profissionais </a> <a href="javascript:Ajax('pacientes/gerenciar','conteudo','')" id="MMMenu0009002858_0_Item_1" class="MMMIVStyleMMMenu0009002858_0" onMouseOver="MM_menuOverMenuItem('MMMenu0009002858_0');"> <img src="imagens/icons_menupop/paciente.gif" />&nbsp;&nbsp;Pacientes </a> <a href="javascript:Ajax('funcionarios/gerenciar','conteudo','')" id="MMMenu0009002858_0_Item_2" class="MMMIVStyleMMMenu0009002858_0" onMouseOver="MM_menuOverMenuItem('MMMenu0009002858_0');"> <img src="imagens/icons_menupop/funcionario.gif" />&nbsp;&nbsp;Funcion&aacute;rios </a> <a href="javascript:Ajax('fornecedores/gerenciar','conteudo','')" id="MMMenu0009002858_0_Item_3" class="MMMIVStyleMMMenu0009002858_0" onMouseOver="MM_menuOverMenuItem('MMMenu0009002858_0');"> <img src="imagens/icons_menupop/fornecedor.gif" />&nbsp;&nbsp;Fornecedores </a> <a href="javascript:Ajax('agenda/agenda','conteudo','')" id="MMMenu0009002858_0_Item_4" class="MMMIVStyleMMMenu0009002858_0" onMouseOver="MM_menuOverMenuItem('MMMenu0009002858_0');"> <img src="imagens/icons_menupop/agenda.gif" />&nbsp;&nbsp;Agenda </a> <a href="javascript:Ajax('patrimonio/gerenciar','conteudo','')" id="MMMenu0009002858_0_Item_5" class="MMMIVStyleMMMenu0009002858_0" onMouseOver="MM_menuOverMenuItem('MMMenu0009002858_0');"> <img src="imagens/icons_menupop/patrimonio.gif" />&nbsp;&nbsp;Patrim&ocirc;nio </a> <a href="javascript:Ajax('estoque/estoque','conteudo','')" id="MMMenu0009002858_0_Item_6" class="MMMIVStyleMMMenu0009002858_0" onMouseOver="MM_menuOverMenuItem('MMMenu0009002858_0');"> <img src="imagens/icons_menupop/estoque.gif" />&nbsp;&nbsp;Controle de Estoque </a> </div>
  </div>
  <div id="MMMenuContainer0009003253_1">
    <div id="MMMenu0009003253_1" onMouseOut="MM_menuStartTimeout(60);" onMouseOver="MM_menuResetTimeout();"> <a href="javascript:Ajax('contaspagar/contaspagar','conteudo','')" id="MMMenu0009003253_1_Item_0" class="MMMIFVStyleMMMenu0009003253_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003253_1');"> <img src="imagens/icons_menupop/contaspagar.gif" />&nbsp;&nbsp;Contas&nbsp;a&nbsp;Pagar </a> <a href="javascript:Ajax('contasreceber/contasreceber','conteudo','')" id="MMMenu0009003253_1_Item_1" class="MMMIVStyleMMMenu0009003253_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003253_1');"> <img src="imagens/icons_menupop/contasreceber.gif" />&nbsp;&nbsp;Contas&nbsp;a&nbsp;Receber </a> <a href="javascript:Ajax('caixa/caixa','conteudo','')" id="MMMenu0009003253_1_Item_2" class="MMMIVStyleMMMenu0009003253_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003253_1');"> <img src="imagens/icons_menupop/caixa.gif" />&nbsp;&nbsp;Fluxo&nbsp;Caixa </a> <a href="javascript:Ajax('cheques/cheques','conteudo','')" id="MMMenu0009003253_1_Item_3" class="MMMIVStyleMMMenu0009003253_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003253_1');"> <img src="imagens/icons_menupop/cheques.gif" />&nbsp;&nbsp;Controle de Cheques </a> <a href="javascript:Ajax('honorarios/honorarios','conteudo','')" id="MMMenu0009003253_1_Item_4" class="MMMIVStyleMMMenu0009003253_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003253_1');"> <img src="imagens/icons_menupop/honorarios.gif" />&nbsp;&nbsp;Tabela de Honorários </a> <a href="javascript:Ajax('pagamentos/parcelas','conteudo','')" id="MMMenu0009003253_1_Item_5" class="MMMIVStyleMMMenu0009003253_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003253_1');"> <img src="imagens/icons_menupop/parcelas.gif" />&nbsp;&nbsp;Efetuar Pagamentos </a> </div>
  </div>
  <div id="MMMenuContainer0009004027_2">
    <div id="MMMenu0009004027_2" onMouseOut="MM_menuStartTimeout(60);" onMouseOver="MM_menuResetTimeout();"> <a href="http://www.smileprev.com/gco/" target="_blank" id="MMMenu0009004027_2_Item_0" class="MMMIFVStyleMMMenu0009004027_2" onMouseOver="MM_menuOverMenuItem('MMMenu0009004027_2');"> <img src="imagens/icons_menupop/atualizacoes_buscar.gif" />&nbsp;&nbsp;Buscar&nbsp;atualiza&ccedil;&otilde;es&nbsp;no&nbsp;site </a> </div>
  </div>
  <div id="MMMenuContainer0009003937_3">
    <div id="MMMenu0009003937_3" onMouseOut="MM_menuStartTimeout(60);" onMouseOver="MM_menuResetTimeout();"> <a href="javascript:;" id="MMMenu0009003937_3_Item_0" class="MMMIFVStyleMMMenu0009003937_3" onMouseOver="MM_menuOverMenuItem('MMMenu0009003937_3','1');"> <span class="MMMenuItemSpanMMMenu0009003937_3"><img src="imagens/icons_menupop/arquivo.gif" />Arquivos</span> <img src="imagens/menu/arrows.gif" alt="" class="MMArrowStyleMMMenu0009003937_3" /> </a> <a href="javascript:Ajax('telefones/gerenciar','conteudo','')" id="MMMenu0009003937_3_Item_1" class="MMMIVStyleMMMenu0009003937_3" onMouseOver="MM_menuOverMenuItem('MMMenu0009003937_3');"> <img src="imagens/icons_menupop/telefone.gif" />&nbsp;&nbsp;Telefones&nbsp;&Uacute;teis </a> <a href="javascript:Ajax('backup/backupfazer','conteudo','')" id="MMMenu0009003937_3_Item_2" class="MMMIVStyleMMMenu0009003937_3" onMouseOver="MM_menuOverMenuItem('MMMenu0009003937_3');"> <img src="imagens/icons_menupop/gerarbackup.gif" />&nbsp;&nbsp;Gerar&nbsp;Backup </a> <a href="javascript:Ajax('backup/restaurar','conteudo','')" id="MMMenu0009003937_3_Item_3" class="MMMIVStyleMMMenu0009003937_3" onMouseOver="MM_menuOverMenuItem('MMMenu0009003937_3');"> <img src="imagens/icons_menupop/restaurarbackup.gif" />&nbsp;&nbsp;Restaurar&nbsp;Backup </a> </div>
    <div id="MMMenu0009003937_3_1" onMouseOut="MM_menuStartTimeout(60);" onMouseOver="MM_menuResetTimeout();"> <a href="javascript:Ajax('arquivos/daclinica/arquivos','conteudo','')" id="MMMenu0009003937_3_1_Item_0" class="MMMIFVStyleMMMenu0009003937_3_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003937_3_1');"> <img src="imagens/icons_menupop/arquivo.gif" />&nbsp;&nbsp;Da&nbsp;cl&iacute;nica </a> <a href="javascript:Ajax('arquivos/manuais_codigos/manuais','conteudo','')" id="MMMenu0009003937_3_1_Item_1" class="MMMIVStyleMMMenu0009003937_3_1" onMouseOver="MM_menuOverMenuItem('MMMenu0009003937_3_1');"> <img src="imagens/icons_menupop/arquivo.gif" />&nbsp;&nbsp;Manuais&nbsp;e&nbsp;C&oacute;digos </a> </div>
  </div>
  <div id="MMMenuContainer0009003732_4">
    <div id="MMMenu0009003732_4" onMouseOut="MM_menuStartTimeout(60);" onMouseOver="MM_menuResetTimeout();"> <a href="javascript:Ajax('configuracoes/senhaadm','conteudo','')" id="MMMenu0009003732_4_Item_0" class="MMMIFVStyleMMMenu0009003732_4" onMouseOver="MM_menuOverMenuItem('MMMenu0009003732_4');"> <img src="imagens/icons_menupop/usuarios.gif" />&nbsp;&nbsp;Senha&nbsp;do&nbsp;Administrador </a> <a href="javascript:Ajax('configuracoes/dadosclinica','conteudo','')" id="MMMenu0009003732_4_Item_1" class="MMMIFVStyleMMMenu0009003732_4" onMouseOver="MM_menuOverMenuItem('MMMenu0009003732_4');"> <img src="imagens/icons_menupop/clinica.gif" />&nbsp;&nbsp;Dados&nbsp;da&nbsp;Cl&iacute;nica </a> </div>
  </div>
  <div id="MMMenuContainer0009003819_5">
    <div id="MMMenu0009003819_5" onMouseOut="MM_menuStartTimeout(60);" onMouseOver="MM_menuResetTimeout();"> <a href="javascript:;" id="MMMenu0009003819_5_Item_0" class="MMMIFVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/ajuda.gif" />&nbsp;&nbsp;Ajuda&nbsp;do&nbsp;Gerenciador </a> <a href="javascript:Ajax('sobre/notas','conteudo','')" id="MMMenu0009003819_5_Item_1" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/notas.gif" />&nbsp;&nbsp;Notas&nbsp;da&nbsp;vers&atilde;o </a> <a href="javascript:Ajax('sobre/treinamento','conteudo','')" id="MMMenu0009003819_5_Item_2" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/treinamento.gif" />&nbsp;&nbsp;Treinamentos&nbsp;e&nbsp;Suporte </a> <a href="javascript:Ajax('sobre/gpl','conteudo','')" id="MMMenu0009003819_5_Item_3" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/gnu.gif" />&nbsp;&nbsp;Licen&ccedil;a&nbsp;GPL </a> <a href="javascript:Ajax('sobre/feedback','conteudo','')" id="MMMenu0009003819_5_Item_4" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/reportar.gif" />&nbsp;&nbsp;Reportar&nbsp;erros </a> <a href="javascript:Ajax('sobre/feedback','conteudo','')" id="MMMenu0009003819_5_Item_5" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/reportar.gif" />&nbsp;&nbsp;Enviar&nbsp;sugest&otilde;es </a> <a href="http://www.smileprev.com/gco" target="_blank" id="MMMenu0009003819_5_Item_6" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/site.gif" />&nbsp;&nbsp;Site&nbsp;do&nbsp;Gerenciador&nbsp;Cl&iacute;nico </a> <a href="http://www.smileprev.com" target="_blank" id="MMMenu0009003819_5_Item_7" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/site.gif" />&nbsp;&nbsp;Site&nbsp;da&nbsp;SmilePrev </a> <a href="javascript:Ajax('sobre/sobre','conteudo','')" id="MMMenu0009003819_5_Item_8" class="MMMIVStyleMMMenu0009003819_5" onMouseOver="MM_menuOverMenuItem('MMMenu0009003819_5');"> <img src="imagens/icons_menupop/icon.gif" />&nbsp;&nbsp;Sobre&nbsp;o&nbsp;Gerenciador </a> </div>
  </div>
</div>
