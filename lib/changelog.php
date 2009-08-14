<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2009
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
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endere�o:
    *
    * Smile Odontol�ogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
?>
<dl>
<dt><b>10/05/2009</b><br />
<dd><ul type="circle">
  <li>Adicionado o suporte a multi-idiomas;</li>
  <li>Adicionado o idioma ingl�s;</li>
  <li>Adicionado o suporte � Materiais Laboratoriais por pacientes com status de acompanhamento;</li>
  <li>Adicionada cor vermelha para pacientes em d�bito;</li>
  <li>Corrigido bug no or�amento para valores decimais;</li>
  <li>Adicionada caixa de texto para observa��es gerais em Fornecedores;</li>
  <li>Adicionados campos adicionais para correspond�ncia em Contatos �teis;</li>
  <li>Adicionada op��o de impress�o de etiquetas em Contatos �teis;</li>
  <li>Adicionados campos banc�rios adicionais em Fornecedores;</li>
  <li>Adicionado m�dulo de cadastro de Conv�nios/Planos;</li>
  <li>Adicionado m�dulo de cadastro de Laborat�rios;</li>
  <li>Corrigido bug inser��o de logomarca da cl�nica;</li>
  <li>Adicionada possiblidade de editar a Evolu��o do Tratamento, em Pacientes;</li>
  <li>Adicionada op��o de deletar lan�amento do caixa;</li>
  <li>Adicionada op��o de impress�o de relat�rio do fluxo caixa;</li>
</ul><br /></dd>
<dt><b>28/02/2009</b><br />
<dd><ul type="circle">
  <li>Alterado o banco de dados de forma a desvincular os funcion�rios e profissionais do CPF, retirando sua obrigatoriedade;</li>
</ul><br /></dd>
<dt><b>25/06/2008</b><br />
<dd><ul type="circle">
  <li>Corrigido o Configurador: fontes e funcionamento de atualiza��es;</li>
  <li>Corrigido erro com o valor nulo (zero) na tab�la de honor�rios;</li>
  <li>Corrigida rotina de backup;</li>
  <li>Corrigidos os links para impress�es;</li>
  <li>Corrigida a rotina de cheques da cl�nica, que n�o registrava as datas de compensa��o;</li>
</ul><br /></dd>
<dt><b>28/05/2008</b><br />
<dd><ul type="circle">
  <li>Corrigido bug de nova instala��o;</li>
  <li>Corrigido bug no menu de contexto da agenda;</li>
  <li>Corrigido bug no menu de contexto do or�amento de pacientes;</li>
</ul><br /></dd>
<dt><b>17/05/2008</b><br />
<dd><ul type="circle">
  <li>Adicionada a primeira vers�o do Odontograma;</li>
  <li>Corre��o de alguns erros de portugu�s;</li>
</ul><br /></dd>
<dt><b>16/05/2008</b><br />
<dd><ul type="circle">
  <li>Adicionado m�dulo de tabela de honor�rios;</li>
  <li>Corrigido bug na pagina��o de relat�rios de clientes;</li>
  <li>Corrigido bug de pagamento de parcelas de Or�amentos n�o confirmados;</li>
  <li>Corrigido bug que n�o permitia a impress�o de Or�amentos n�o confirmados;</li>
  <li>Adicionada integra��o entre procedimentos do Or�amento e Tabela de Honor�rios;</li>
  <li>Corrigido bug de pagamentos de parcelas;</li>
  <li>Corrigido bug do CPF errado ou j� existente;</li>
  <li>Corrigido bug que permitia Funcion�rios e Dentistas apagarem Pacientes;</li>
  <li>Adicionada �rea de Ortodontia;</li>
  <li>Adicionada �rea de Implantodontia;</li>
</ul><br /></dd>
<dt><b>15/05/2008</b><br />
<dd><ul type="circle">
  <li>Adicionado m�todo de busca de Pacientes por Profissional a quem foram encaminhados;</li>
  <li>Adicionado m�todo de busca de Pacientes por Profissional que Atendeu;</li>
  <li>Alterados links de impress�o de Boleto e Or�amento para a p�gina do Or�amento correspondente;</li>
  <li>Adicionada fun��o de Dar Baixa/Cancelar em Parcelas de Or�amentos;</li>
  <li>Adicionado relat�rio no controle de Caixa da Cl�nica para separar pagamentos de Pacientes por Dentistas;</li>
  <li>Adicionados m�todos de impress�o Encaminhamento, Laudo/Parecer e Agradecimento pelo Encaminhamento;</li>
  <li>Adicionada vers�o para impress�o das fichas de cadastro de Paciente, Profissinal e Funcion�rio;</li>
</ul><br /></dd>
<dt><b>14/05/2008</b><br />
<dd><ul type="circle">
  <li>Alterado o m�dulo de Dentistas para Profissionais;</li>
  <li>Adicionadas categorias de outras �reas profissionais (CRO, CRM, CRFa, CRP, CREFITO);</li>
  <li>Adicionadas �reas de tratamento do paciente na ficha de cadastro;</li>
  <li>Adicionado relat�rio de Pacientes pela �rea de tratamento;</li>
  <li>Adicionado relat�rio de Pacientes com parcelas a pagar vencidas;</li>
  <li>Adicionada gera��o de Recibo no pagamento de parcelas;</li>
  <li>Adicionada vers�o impressa de relat�rios de pacientes;</li>
</ul></dd>
</dl>
