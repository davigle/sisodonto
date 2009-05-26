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
	if(!checklog()) {
		die($frase_log);
	}
	$telefones = new TTelefones();
	if(isset($_POST[Salvar])) { 
		$obrigatorios[1] = 'nom';
		$obrigatorios[] = 'telefone1';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
				$r[$i] = '<font color="#FF0000">';
			    $j++;
			}
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$telefones->LoadTelefones($_GET[codigo]);
			}
			$telefones->SetDados('nome', htmlspecialchars($_POST[nom], ENT_QUOTES));
			$telefones->SetDados('endereco', $_POST[endereco]);
			$telefones->SetDados('bairro', $_POST[bairro]);
			$telefones->SetDados('cidade', $_POST[cidade]);
			$telefones->SetDados('estado', $_POST[estado]);
			$telefones->SetDados('cep', $_POST[cep]);
			$telefones->SetDados('celular', $_POST[celular]);
			$telefones->SetDados('telefone1', $_POST[telefone1]);
			$telefones->SetDados('telefone2', $_POST[telefone2]);
			$telefones->SetDados('website', $_POST[website]);
			$telefones->SetDados('email', $_POST[email]);
			if($_GET[acao] != "editar") {
				$telefones->SalvarNovo();
				//$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('telefones/incluir', 'conteudo', '');";
			}
			$strScrp = "Ajax('telefones/gerenciar', 'conteudo', '');";
			$telefones->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strUpCase = "ALTERA��O";
		$strLoCase = "altera��o";
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$telefones->LoadTelefones($_GET[codigo]);
		$row = $telefones->RetornaTodosDados();
	} else {		
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strUpCase = "INCLUS�O";
		$strLoCase = "inclus�o";
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="telefones/img/telefones.png" alt="TELEFONES �TEIS"> <span class="h3">TELEFONES �TEIS [<?=$strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?=$strUpCase?> DE CONTATOS </td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="telefones/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1">Informa&ccedil;&otilde;es do Contato </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287"><?=$r[1]?>* Nome <br />
                <label>
                  <input name="nom" value="<?=$row[nome]?>" type="text" class="forms" id="nom" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"></td>
          </tr>
          <tr>
            <td>Endere&ccedil;o<br />
              <input name="endereco" value="<?=$row[endereco]?>" type="text" class="forms" id="endereco" size="50" maxlength="150" /></td>
            <td>Bairro<br />
              <input name="bairro" value="<?=$row[bairro]?>" type="text" class="forms" id="bairro" /></td>
          </tr>
          <tr>
            <td>Cidade<br />
                <input name="cidade" value="<?=$row[cidade]?>" type="text" class="forms" id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td>Estado<br /><select name="estado" class="forms" id="estado">
<?
	$estados = array('AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
	foreach($estados as $uf) {
		if($row[estado] == $uf || ($row[estado] == '' && $uf == 'MG')) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select>   </td>
          </tr>
          <tr>
            <td>CEP<br />
              <input name="cep" value="<?=$row[cep]?>" type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td>Celular<br />
              <input name="celular" value="<?=$row[celular]?>" type="text" class="forms" id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td><?=$r[8]?>* Telefone 1 <br />
              <input name="telefone1" value="<?=$row[telefone1]?>" type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td>Telefone 2 <br />
              <input name="telefone2" value="<?=$row[telefone2]?>" type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td>E-mail<br />
              <input name="email" value="<?=$row[email]?>" type="text" class="forms" id="email" size="40" /></td>
            <td>Web Site <br />
              <input name="website" value="<?=$row[website]?>" type="text" class="forms" id="site" size="40" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="Salvar" />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>
<script>
  document.getElementById('nom').focus();
</script>
