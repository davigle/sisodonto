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
?>
<dl>
<dt><b>10/05/2009</b><br />
<dd><ul type="circle">
  <li>Adicionado o suporte a multi-idiomas;</li>
  <li>Adicionado o idioma inglês;</li>
  <li>Adicionado o suporte à Materiais Laboratoriais por pacientes com status de acompanhamento;</li>
  <li>Adicionada cor vermelha para pacientes em débito;</li>
  <li>Corrigido bug no orçamento para valores decimais;</li>
  <li>Adicionada caixa de texto para observações gerais em Fornecedores;</li>
  <li>Adicionados campos adicionais para correspondência em Contatos Úteis;</li>
  <li>Adicionada opção de impressão de etiquetas em Contatos Úteis;</li>
  <li>Adicionados campos bancários adicionais em Fornecedores;</li>
  <li>Adicionado módulo de cadastro de Convênios/Planos;</li>
  <li>Adicionado módulo de cadastro de Laboratórios;</li>
  <li>Corrigido bug inserção de logomarca da clínica;</li>
  <li>Adicionada possiblidade de editar a Evolução do Tratamento, em Pacientes;</li>
  <li>Adicionada opção de deletar lançamento do caixa;</li>
  <li>Adicionada opção de impressão de relatório do fluxo caixa;</li>
</ul><br /></dd>
<dt><b>28/02/2009</b><br />
<dd><ul type="circle">
  <li>Alterado o banco de dados de forma a desvincular os funcionários e profissionais do CPF, retirando sua obrigatoriedade;</li>
</ul><br /></dd>
<dt><b>25/06/2008</b><br />
<dd><ul type="circle">
  <li>Corrigido o Configurador: fontes e funcionamento de atualizações;</li>
  <li>Corrigido erro com o valor nulo (zero) na tabéla de honorários;</li>
  <li>Corrigida rotina de backup;</li>
  <li>Corrigidos os links para impressões;</li>
  <li>Corrigida a rotina de cheques da clínica, que não registrava as datas de compensação;</li>
</ul><br /></dd>
<dt><b>28/05/2008</b><br />
<dd><ul type="circle">
  <li>Corrigido bug de nova instalação;</li>
  <li>Corrigido bug no menu de contexto da agenda;</li>
  <li>Corrigido bug no menu de contexto do orçamento de pacientes;</li>
</ul><br /></dd>
<dt><b>17/05/2008</b><br />
<dd><ul type="circle">
  <li>Adicionada a primeira versão do Odontograma;</li>
  <li>Correção de alguns erros de português;</li>
</ul><br /></dd>
<dt><b>16/05/2008</b><br />
<dd><ul type="circle">
  <li>Adicionado módulo de tabela de honorários;</li>
  <li>Corrigido bug na paginação de relatórios de clientes;</li>
  <li>Corrigido bug de pagamento de parcelas de Orçamentos não confirmados;</li>
  <li>Corrigido bug que não permitia a impressão de Orçamentos não confirmados;</li>
  <li>Adicionada integração entre procedimentos do Orçamento e Tabela de Honorários;</li>
  <li>Corrigido bug de pagamentos de parcelas;</li>
  <li>Corrigido bug do CPF errado ou já existente;</li>
  <li>Corrigido bug que permitia Funcionários e Dentistas apagarem Pacientes;</li>
  <li>Adicionada área de Ortodontia;</li>
  <li>Adicionada área de Implantodontia;</li>
</ul><br /></dd>
<dt><b>15/05/2008</b><br />
<dd><ul type="circle">
  <li>Adicionado método de busca de Pacientes por Profissional a quem foram encaminhados;</li>
  <li>Adicionado método de busca de Pacientes por Profissional que Atendeu;</li>
  <li>Alterados links de impressão de Boleto e Orçamento para a página do Orçamento correspondente;</li>
  <li>Adicionada função de Dar Baixa/Cancelar em Parcelas de Orçamentos;</li>
  <li>Adicionado relatório no controle de Caixa da Clínica para separar pagamentos de Pacientes por Dentistas;</li>
  <li>Adicionados métodos de impressão Encaminhamento, Laudo/Parecer e Agradecimento pelo Encaminhamento;</li>
  <li>Adicionada versão para impressão das fichas de cadastro de Paciente, Profissinal e Funcionário;</li>
</ul><br /></dd>
<dt><b>14/05/2008</b><br />
<dd><ul type="circle">
  <li>Alterado o módulo de Dentistas para Profissionais;</li>
  <li>Adicionadas categorias de outras áreas profissionais (CRO, CRM, CRFa, CRP, CREFITO);</li>
  <li>Adicionadas áreas de tratamento do paciente na ficha de cadastro;</li>
  <li>Adicionado relatório de Pacientes pela área de tratamento;</li>
  <li>Adicionado relatório de Pacientes com parcelas a pagar vencidas;</li>
  <li>Adicionada geração de Recibo no pagamento de parcelas;</li>
  <li>Adicionada versão impressa de relatórios de pacientes;</li>
</ul></dd>
</dl>
