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
    if($_GET['confirm_baixa'] == "baixa") {
        mysql_query("UPDATE orcamento SET baixa = 'Sim' WHERE codigo = ".$_GET['codigo_orc']) or die('Line 39: '.mysql_error());
        echo '<script>alert("Parcelas restantes do or�amento canceladas com sucesso!")</script>';
    }
	$acao = '&acao=editar';
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$codigo_orc = $_GET[codigo_orc];
	if($_GET[subacao] != 'editar') {
		$codigo_orc = next_autoindex('orcamento');
		mysql_query("INSERT INTO `orcamento` (`codigo_paciente`, `data`) VALUE ('$_GET[codigo]', '".date(Y.'-'.m.'-'.d)."')") or die(mysql_error());
	} else {
        //echo '<pre>';
        //print_r($_POST);
        //echo '</pre>';
		//Altera��o de procedimentos
		if(is_array($_POST[codigoprocedimento])) {
			foreach($_POST[codigoprocedimento] as $codigo => $codigoprocedimento) {
				$dente = $_POST[dente][$codigo];
				$descricao = $_POST[descricao][$codigo];
				$particular = $_POST[particular][$codigo];
				$convenio = $_POST[convenio][$codigo];
				if(empty($codigoprocedimento) && empty($dente) && empty($descricao) && empty($particular) && empty($convenio)) {
					mysql_query("DELETE FROM `procedimentos_orcamento` WHERE `codigo` = '".$codigo."'") or die(mysql_error());
				} else {
					mysql_query("UPDATE `procedimentos_orcamento` SET `codigoprocedimento` = '".$codigoprocedimento."', `dente` = '".$dente."', `descricao` = '".$descricao."', `particular` = '".$particular."', `convenio` = '".$convenio."' WHERE `codigo` = '".$codigo."' ") or die(mysql_error());
				}
			}
		}
		//Novo procedimento
		if(!empty($_POST[descricao_new])) {
			if(empty($_POST[particular_new]))
				$_POST[particular_new] = 0;
			if(empty($_POST[convenio_new]))
				$_POST[convenio_new] = 0;
			mysql_query("INSERT INTO `procedimentos_orcamento` (`codigo_orcamento`, `codigoprocedimento`, `dente`, `descricao`, `particular`, `convenio`) VALUES ('".$codigo_orc."', '".$_POST[codigoprocedimento_new]."', '".$_POST[dente_new]."', '".$_POST[descricao_new]."', '".$_POST[particular_new]."', '".$_POST[convenio_new]."')") or die(mysql_error());
		}
		$row = mysql_fetch_array(mysql_query("SELECT * FROM `orcamento` WHERE `codigo` = '".$codigo_orc."'"));
		//Atualizando os dados gerais do or�amento
		if(isset($_POST[aserpago])) {
			if(empty($_POST[desconto]))
				$_POST[desconto] = 0;
			if(empty($_POST[entrada]))
				$_POST[entrada] = 0;
			mysql_query("UPDATE `orcamento` SET `aserpago` = '".$_POST[aserpago]."', `valortotal` = '".$_POST[valortotal]."', `formapagamento` = '".$_POST[formapagamento]."', `parcelas` = '".$_POST[parcelas]."', `desconto` = '".$_POST[desconto]."', `cpf_dentista` = '".$_POST[cpf_dentista]."', `entrada` = ".$_POST['entrada'].", `entrada_tipo` = '".$_POST['entrada_tipo']."' WHERE `codigo` = '".$codigo_orc."'") or die('Erro UPDATE orcamento: '.mysql_error());
		}
		//Apagando dados de parcelas
		if(isset($_POST[aserpago]) || isset($_POST['Salvar222'])) {
			mysql_query("DELETE FROM `parcelas_orcamento` WHERE `codigo_orcamento` = '".$codigo_orc."'") or die(mysql_error());
		}
		//Inserindo dados de parcelas
		if(is_array($_POST[datavencimento])) {
			foreach($_POST[datavencimento] as $chave => $datavencimento) {
				$valor = $_POST[parcela][$chave];
				mysql_query("INSERT INTO `parcelas_orcamento` (`codigo_orcamento`, `datavencimento`, `valor`) VALUES ('".$codigo_orc."', '".converte_data($datavencimento, 1)."', '".$valor."')") or die(mysql_error());
			}
		}
		//Confirmando or�amento
		if(isset($_POST['Salvar222'])) {
            //var_dump($_POST['confirmed']); die();
            if($_POST['confirmed'] != 'Sim') {
                $_POST['confirmed'] = 'N�o';
            }
    	    mysql_query("UPDATE orcamento SET confirmado = '".$_POST['confirmed']."' WHERE `codigo` = '".$codigo_orc."'") or die('Line 91: '.mysql_error());
        }
		//Recuperando os dados da tabela
		$row = mysql_fetch_array(mysql_query("SELECT * FROM `orcamento` WHERE `codigo` = '".$codigo_orc."'"));
		if($row[aserpago] == "Conv�nio") {
			$chk[aserpago]['Conv�nio'] = 'checked';
		} elseif($row[aserpago] == "Particular") {
			$chk[aserpago]['Particular'] = 'checked';
		}
		if(isset($_POST[Salvar222])) {
            echo "<script>Ajax('pacientes/orcamento', 'conteudo', 'codigo=".$_GET[codigo].$acao."')</script>"; die();
		}
	}
	if($row['confirmado'] == 'Sim') {
        $disable = 'disabled';
	}
?>
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Dentistas"> <span class="h3">GERENCIAR PACIENTES &nbsp;[<?=$strLoCase?>] </span></td>
    </tr>
</table>
<div class="conteudo" id="table dados">
<br />
<?include('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;OR&Ccedil;AMENTO DO PACIENTE </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form1" name="form1" method="POST" action="pacientes/orcamentofechar_ajax.php?codigo=<?=$_GET[codigo]?>&acao=editar&subacao=editar&codigo_orc=<?=$codigo_orc?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="12%" bgcolor="#0099CC"><div align="left" class="style4">C&Oacute;DIGO</div></td>
            <td width="13%" bgcolor="#0099CC"><div align="left" class="style4">DENTE</div></td>
            <td width="44%" height="20" bgcolor="#0099CC"><div align="left" class="style4">DESCRI&Ccedil;&Atilde;O DO PROCEDIMENTO </div></td>
            <td width="16%" bgcolor="#0099CC"><div align="center" class="style4">R$ PARTICULAR </div></td>
            <td width="15%" bgcolor="#0099CC"><div align="center" class="style4">R$ CONV&Ecirc;NIO</div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><div align="center"></div></td>
            <td><div align="center"></div></td>
            <td><div align="center"></div></td>
          </tr>
<?
	$total_convenio = $total_particular = 0;
	$query1 = mysql_query("SELECT * FROM `procedimentos_orcamento` WHERE `codigo_orcamento` = '".$codigo_orc."'");
	while($row1 = mysql_fetch_array($query1)) {
		$total_convenio += $row1[convenio];
		$total_particular += $row1[particular];
?>
          <tr>
            <td>
              <input <?=$disable?> name="codigoprocedimento[<?=$row1['codigo']?>]" id="codigoprocedimento<?=$row1['codigo']?>" value="<?=$row1['codigoprocedimento']?>" type="text" class="forms" size="10" />
            </div></td>
            <td>
              <input <?=$disable?> name="dente[<?=$row1['codigo']?>]" value="<?=$row1['dente']?>" type="text" class="forms" size="10" />
            </div></td>
            <td>
                <input <?=$disable?> name="descricao[<?=$row1['codigo']?>]" id="descricao<?=$row1['codigo']?>" value="<?=$row1['descricao']?>" type="text" class="forms" size="45"
                onkeyup="searchOrcSuggest(this, 'codigoprocedimento<?=$row1['codigo']?>', 'particular<?=$row1['codigo']?>', 'convenio<?=$row1['codigo']?>', 'search<?=$row1['codigo']?>');"
                autocomplete="off" onfocus="esconde_itens()" /><br />
                <div id='search<?=$row1['codigo']?>' name="search" style="position: absolute" align="center"></div>
            </td>
            <td><div align="center">
              <input <?=$disable?> name="particular[<?=$row1['codigo']?>]" id="particular<?=$row1['codigo']?>" value="<?=money_form($row1['particular'])?>" type="text" class="forms" size="12" maxlength="10" onKeypress="return Ajusta_Valor(this, event);" />
            </td>
            <td><div align="center">
              <input <?=$disable?> name="convenio[<?=$row1['codigo']?>]" id="convenio<?=$row1['codigo']?>" value="<?=money_form($row1['convenio'])?>" type="text" class="forms" size="12" maxlength="10" onKeypress="return Ajusta_Valor(this, event);" />
            </td>
          </tr>
<?
	}
?>
          <tr>
            <td>
              <input <?=$disable?> name="codigoprocedimento_new" id="codigoprocedimento_new" type="text" class="forms" size="10" />
            </div></td>
            <td>
              <input <?=$disable?> name="dente_new" id="dente_new" type="text" class="forms" size="10" />
            </div></td>
            <td>
              <input <?=$disable?> name="descricao_new" id="descricao_new" type="text" class="forms" size="45"
              onkeyup="searchOrcSuggest(this, 'codigoprocedimento_new', 'particular_new', 'convenio_new', 'search99');"
              autocomplete="off" onfocus="esconde_itens()" /> <br />
              <div id='search99' name="search" style="position: absolute" align="center">
            </td>
            <td><div align="center">
              <input <?=$disable?> name="particular_new" id="particular_new" type="text" class="forms" size="12" maxlength="10" onKeypress="return Ajusta_Valor(this, event);" />
            </div></td>
            <td><div align="center">
              <input <?=$disable?> name="convenio_new" id="convenio_new" type="text" class="forms" size="12" maxlength="10" onKeypress="return Ajusta_Valor(this, event);" />
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><div align="right"><strong>Valor Total: </strong></div></td>
            <td><div align="center">R$ <?=money_form($total_particular)?>
            	<input type="hidden" id="total_particular" value="<?=money_form($total_particular)?>"></div></td>
            <td><div align="center">R$ <?=money_form($total_convenio)?>
            	<input type="hidden" id="total_convenio" value="<?=money_form($total_convenio)?>"></div></td>
          </tr>
        </table>
        <div align="right">
          <p>
            <input <?=$disable?> name="Salvar2" type="submit" class="forms" value="Atualizar/Adicionar Procedimento">
          </p>
        </form>
        <form id="form2" name="form2" method="POST" action="pacientes/orcamentofechar_ajax.php?codigo=<?=$_GET[codigo]?>&acao=editar&subacao=editar&codigo_orc=<?=$codigo_orc?>" onsubmit="formSender(this, 'conteudo'); return false;"><br />
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="2" bgcolor="#0099CC"><div align="center" class="style4">VALOR A SERCOBRADO </div></td>
              <td width="34%" height="20" bgcolor="#0099CC"><div align="center" class="style4">VALOR TOTAL  </div></td>
              <td width="33%" bgcolor="#0099CC"><div align="center" class="style4">FORMA DE PAGAMENTO  </div></td>
            </tr>
            <tr>
              <td colspan="4"><div align="center" class="style4">&nbsp;</td>
            </tr>
            <tr>
              <td><div align="center"></div></td>
              <td>
                <div align="left">
                  <input <?=$disable?> name="aserpago" type="radio" value="Particular" <?=$chk[aserpago]['Particular']?> onclick="document.getElementById('valortotal').value = document.getElementById('total_particular').value; document.getElementById('valor__total').value = document.getElementById('total_particular').value;" />
                Particular
                <input <?=$disable?> name="aserpago" type="radio" value="Conv�nio" <?=$chk[aserpago]['Conv�nio']?> onclick="document.getElementById('valortotal').value = document.getElementById('total_convenio').value; document.getElementById('valor__total').value = document.getElementById('total_convenio').value;" />
              Conv&ecirc;nio</div></td>
              <td><div align="center">
                <input <?=$disable?> name="valor__total" disabled type="text" value="<?=money_form($row[valortotal])?>" class="forms" id="valor__total" size="15" />
                <input <?=$disable?> name="valortotal" type="hidden" value="<?=money_form($row[valortotal])?>" class="forms" id="valortotal" size="15" />
              </div></td>
              <td><div align="right">
                <select <?=$disable?> name="formapagamento" class="forms" id="formapagamento">
<?
	$estados = array('� vista', 'Cheque pr�-datado', 'Promiss�ria', 'Desconto em folha', 'Cart�o');
	foreach($estados as $uf) {
		if($row[formapagamento] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>       
			 </select>
                </div>              </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="5%">&nbsp;</td>
              <td width="28%"><div align="left">N� DE PARCELAS:&nbsp;&nbsp;
              <select <?=$disable?> name="parcelas" class="forms" id="parcelas">
<?
	$estados = array();
	for($i = 1; $i <= 20; $i++) {
		array_push($estados, $i);
	}
	foreach($estados as $uf) {
		if($row[parcelas] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>
			 </select></div></td>
              <td height="20" align="center">
                ENTRADA:
              <select <?=$disable?> name="entrada_tipo" class="forms" id="entrada_tipo">
<?
	$estados = array('R$', '%');
	foreach($estados as $uf) {
		if($row['entrada_tipo'] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>
			 </select>
             <input <?=$disable?> type="text" name="entrada" value="<?=$row['entrada']?>" class="forms" size="10">
              </td>
              <td><div align="right">DESCONTO:
                  <input <?=$disable?> name="desconto" type="text" value="<?=$row[desconto]?>" class="forms" id="desconto" size="5" />
              %</div></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div align="center"></div></td>
              <td colspan="2"><div align="left">DENTISTA:
                  <select <?=$disable?> name="cpf_dentista" class="forms">
                    <?
			$dentista = new TDentistas();
			$lista = $dentista->ListDentistas("SELECT * FROM `dentistas` WHERE `ativo` = 'Sim' ORDER BY `nome` ASC");
			for($i = 0; $i < count($lista); $i++) {
				$nome = explode(' ', $lista[$i][nome]);
				$nome = $nome[0].' '.$nome[count($nome) - 1];
				if($row[cpf_dentista] == $lista[$i][cpf] || ($row[cpf_dentista] == "" && $_SESSION[cpf] == $lista[$i][cpf])) {
					echo '<option value="'.$lista[$i][cpf].'" selected>'.$lista[$i][titulo].' '.$nome.'</option>';
				} else {
					echo '<option value="'.$lista[$i][cpf].'">'.$lista[$i][titulo].' '.$nome.'</option>';
				}
			}
?>
                    </select>
              </div></td>
              <td><div align="right">
                <input <?=$disable?> name="Salvar22" type="submit" class="forms" id="Salvar22" value="Calcular" />&nbsp;
              </div></td>
            </tr>
          </table>
		  <br />
        </form>
        <form id="form3" name="form3" method="POST" action="pacientes/orcamentofechar_ajax.php?codigo=<?=$_GET[codigo]?>&acao=editar&subacao=editar&codigo_orc=<?=$codigo_orc?>" onsubmit="formSender(this, 'conteudo'); return false;"> &nbsp;<br />
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td bgcolor="#0099CC"><div align="center" class="style4">PARCELAS</div></td>
              <td height="20" bgcolor="#0099CC"><div align="center" class="style4">DATA</div></td>
              <td bgcolor="#0099CC"><div align="center" class="style4">SITUA��O</div></td>
              <td bgcolor="#0099CC"><div align="center" class="style4">VALOR</div></td>
            </tr>
            <tr>
              <td colspan="3"><div align="center" class="style4">&nbsp;</td>
            </tr>
         </div>
<?
	if(empty($row[parcelas])) {
		$row[parcelas] = 1; 
	}
	$query1 = mysql_query("SELECT * FROM `parcelas_orcamento` WHERE `codigo_orcamento` = '".$codigo_orc."' ORDER BY `codigo`") or die(mysql_error());
    $parc = $row['parcelas'];
    $total = $row['valortotal'];
    $total_final = 0;
	for($i = 1; $i <= $parc; $i++) {
		$row1 = mysql_fetch_array($query1);
        $valor = $row1['valor'];
        if($row['entrada'] != '' && $row['entrada'] != 0 && $i === 1) {
            $row['parcelas']--;
            $row1['datavencimento'] = date('Y-m-d');
            if($row['entrada_tipo'] == 'R$') {
                $row['valortotal'] -= $row['entrada'];
                $valor = $row['entrada'];
            } elseif($row['entrada_tipo'] == '%') {
                $row['valortotal'] -= ($row['valortotal']*($row['entrada']/100));
                $valor = $total - $row['valortotal'];
            }
        } else {
            if(empty($row1[valor])) {
    			$valor = ($row['valortotal']-($total*($row[desconto]/100)))/$row[parcelas];
    		}
    		if(empty($row1[datavencimento])) {
    			$row1[datavencimento] = maismes($row[data], $i-1);
            }
        }
            if($row1['pago'] != 'Sim' && $disable == 'disabled') {
                //$efetuar = '<input type="submit" class="forms" name="efetuar['.$row1['codigo'].']" value="Efetuar pagamento">';
                $efetuar = '<a href="javascript:Ajax(\'pagamentos/parcelas\', \'conteudo\', \'codigo='.$row1['codigo'].'\')">Efetuar pagamento</a> ';
            } elseif($disable == 'disabled') {
                $efetuar = 'Pagamento j� realizado!';
            }
            $total_final += $valor;
?>
          <tr>
    		  <td><div align="center"><b>Parcela <?=$i?></b> <?=(($row1['codigo'] != '')?'(Boleto n� '.$row1['codigo'].')':'')?></div></td>
    		  <td><div align="center">
      		    <input <?=$disable?> name="datavencimento[<?=$i?>]" value="<?=(($row1['datavencimento'] == '-00-')?'00/00/0000':converte_data($row1['datavencimento'], 2))?>" type="text" class="forms" size="15" />
    		    </div></td>
    		  <td><div align="center"><?=(($row['baixa'] == 'N�o')?(($row1['pago'] == 'Sim')?'PAGO':'<a href="javascript:Ajax(\'pagamentos/parcelas\', \'conteudo\', \'codigo='.completa_zeros($row1['codigo'], ZEROS).'\')">ABERTO').((($row1['datavencimento'] < date('Y-m-d')) && ($row1['pago'] != 'Sim'))?' (VENCIDO)</a>':'</a>').(($row1['pago'] == 'Sim')?' ('.converte_data($row1['datapgto'], 2).')':''):(($row1['pago'] == 'Sim')?'PAGO ('.converte_data($row1['datapgto'], 2).')':'CANCELADO'))?></div></td>
    		  <td><div align="center">
      		   <input <?=$disable?> name="parcela[<?=$i?>]" value="<?=money_form($valor)?>" type="text" class="forms" size="15" />
    		  </div></td>
  			</tr>
<?
	}
?>
			<tr>
			  <td colspan="2">&nbsp;
			    
			  </td>
			</tr>
  			<tr>
              <td align="left"><input <?=$disable?> type="checkbox" <?=(($row['confirmado'] == 'Sim')?'checked':'')?> name="confirmed" id="confirmed" value="Sim"><label for="confirmed"> Or�amento confirmado</label></td>
    		  <td align="right"><strong>VALOR FINAL:</strong></td>
    		  <td><div align="center">
      		    <font size="2"><b>R$ <?=money_form($total_final)?></b>
    		    </div></td>
  			</tr>
		</table>
        <br />
        <div align="center">
          <p>
            <input <?=$disable?> name="Salvar222" type="submit" class="forms" value="Salvar Or&ccedil;amento" />
          </p>

      </form>
<table width="100%" align="center">
  <tr>
    <td width="33%" align="center">
      <a href="relatorios/orcamento.php?codigo=<?=$codigo_orc?>" target="_blank">Imprimir Or�amento</a>
    </td>
<?
    if($disable == 'disabled') {
        if($row['baixa'] == 'N�o') {
            if(!checknivel('Dentista')) {
?>
    <td width="33%" align="center">
      <a href="javascript:;" onclick="if(confirm('Deseja realmente cancelar o restante das parcelas deste or�amento?\n\nAs parcelas j� pagas n�o ser�o afetadas.')) { javascript:Ajax('pacientes/orcamentofechar', 'conteudo', 'codigo=<?=$_GET[codigo]?>&indice_orc=<?=($i+1)?>&acao=editar&subacao=editar&codigo_orc=<?=$row[codigo]?>&confirm_baixa=baixa') }">Dar Baixar no Or�amento</a>
    </td>
<?
            }
?>
    <td width="34%" align="center">
      <a href="relatorios/boleto.php?codigo=<?=$codigo_orc?>" target="_blank">Imprimir Boletos</a>
    </td>
<?
        }
    }
?>
  </tr>
</table>
        </div>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
      </fieldset>
<script>
document.getElementById('descricao_new').focus();
</script>
