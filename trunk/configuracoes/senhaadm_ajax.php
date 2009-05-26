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
	header("Content-type: text/html; charset=ISO-8859-1", true);	
	if(checknivel('Dentista') || checknivel('Funcionario')) {
		die($frase_adm);
	}
	if(isset($_POST[login])) {
		$funcionario = new TFuncionarios();
		if($_POST[senha] != '') {
			if($_POST[senha] != $_POST[confsenha]) {
				$j++;
				$r[2] = '<font color="#FF0000">';
				$r[3] = '<font color="#FF0000">';
			}
			$senha = mysql_fetch_array(mysql_query("SELECT * FROM `funcionarios` WHERE `cpf` = '11111111111'"));
			if(md5($_POST[senhaatual]) != $senha[senha]) {
				$j++;
				$r[1] = '<font color="#FF0000">';
			}
			if($j == 0) {
				$funcionario->LoadFuncionario('11111111111');
				$strScrp = "alert('Senha do administrador atualizada com sucesso!'); Ajax('wallpapers/index', 'conteudo', '');";	
				if($_POST[senha] != "") {
					$funcionario->SetDados('senha', md5($_POST[senha]));
				}
				$funcionario->Salvar();
			}
		}
	}
?>
<script>
<?=$strScrp?>
</script>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="wallpapers/img/login.png" alt="Altera��o de senha"> <span class="h3">ALTERAR SENHA </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td height="23">ALTERA��O DE SENHA DO ADMININSTRADOR </td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="configuracoes/senhaadm_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;">
        <fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es de Acesso Pessoal </span></legend>
        <table width="287" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?=$r[1]?>Senha atual:<br />
              <input name="senhaatual" value="" type="password" class="forms" id="senhaatual" maxlength="11" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td><?=$r[2]?>Nova senha<br />
              <input name="senha" value="" type="password" class="forms" id="senha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td><?=$r[3]?>Confirma��o de nova senha<br />
              <input name="confsenha" value="" type="password" class="forms" id="confsenha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <div align="center"><br>
          <input name="login" type="submit" class="forms" id="login" value="Entrar" />
        </div>
      </form>
      </td>
    </tr>
  </table>
<script>
document.getElementById('senhaatual').focus();
</script>
