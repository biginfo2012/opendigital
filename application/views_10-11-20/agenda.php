<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport" />
    <meta charset="utf-8">
    <title>Agenda</title>
    <script>
        if (<?= $passo ?> > 1) {
        passo = <?= $passo ?>;
        } else {
        passo = 0;
        }
    </script>
    <?php $this->load->view('assetsinclude'); ?>
    <style media="screen">
        .passo-1 select {
            background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 12px no-repeat #fff;
        }

        .consulta select {
            background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 4% no-repeat #fff;
        }

        .consulta #dataConsulta {
            background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 4% no-repeat #fff;
        }

        .passo-4 select {
            background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 4% no-repeat #fff;
        }
    </style>
</head>

<body class="bg-light" id="minharevisao">
    <div class="fullpage agenda">
        <?php $this->load->view('nav_agenda', array("logado" => (isset($_SESSION['logado']) ? $_SESSION['logado'] : 0), "agenda" => 1)); ?>
        <div id="loader" style="display: none;">
            <div class="loader"></div>
        </div>
        <div class="section" style="background-color: #fff;">
            <!-- PASSO 01 -->
            <?php $this->load->view('passo-1'); ?>

            <!-- SOB CONSULTA -->
            <?php $this->load->view('passo-consulta'); ?>

            <!-- PASSO 02 -->
            <?php $this->load->view('passo-2'); ?>

            <!-- PASSO 03 -->
            <?php $this->load->view('passo-3'); ?>

            <!-- PASSO 04 -->
            <?php $this->load->view('passo-4'); ?>

            <!-- PASSO 05 -->
            <?php $this->load->view('passo-5'); ?>

            <!-- PASSO 06 -->
            <?php $this->load->view('passo-6'); ?>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/js/fullpage_config_agenda.js') ?>"></script>
    <script>
        var agenda = 1;

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        $(document).ready(function() {
            $('.modal').detach().appendTo('body');
        });
    </script>

</body>

<div class="row poweredby d-none">
    <div class="col-12 text-center">
        <img class="mx-auto img-fluid" src="<?php echo base_url('assets/img/poweredby_black.png') ?>" alt="">
    </div>
</div>

<?php $this->load->view('modal_login'); ?>
<?php $this->load->view('modal_perfil'); ?>

<?php $this->load->view('modal_pedidos'); ?>



<div class="modal fade" id="errorModal" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center col-md-10 mx-auto">
                    <h5 class="col-12 text-center mensagem-erro">Descrição do Erro</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center col-md-10 mx-auto">
                    <h5 class="w-100 text-center">Gostaria de retornar a tela inicial?</h5>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a data-dismiss="modal" aria-label="Close">
                                Não
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?php echo base_url() ?>">
                                Sim
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lgpdModal" role="dialog" aria-labelledby="lgpdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Política de Privacidade</p>
                <p>
                    Este documento, denominado Política de Privacidade, possui finalidade de estabelecer 
                    as regras sobre o uso, armazenamento e tratamento dos dados e informações 
                    coletadas dos usuários no site minharevisao.com.br. <br>
                </p>
                <p>
                    1. Definições: para fins desta Política de Privacidade, aplicam-se as seguintes definições: 
                    designa o site minharevisao.com.br. Minha Revisão: Minha Revisão Tecnologia e Serviços Automotivos LTDA, 
                    pessoa jurídica de direito privado, com sede à Rua José Versolato, 111 Bloco B Sala 716 – Centro – São Bernardo do Campo – SP, 
                    CEP 09750-730 e inscrita no CNPJ sob o nº 37.581.120/0001-30. Cookies: arquivos enviados pelo servidor do site para o computador 
                    do Usuário, com a finalidade de identificar o computador e obter dados de acesso, como páginas navegadas ou links clicados, 
                    permitindo, desta forma, personalizar a utilização do site, de acordo com o seu perfil; IP: abreviatura de Internet Protocol. 
                    É um conjunto de números que identifica o computador do Usuário na Internet; Logs: registros de atividades do Usuário efetuadas no site; 
                    Session ID: identificação da sessão do Usuário no processo de inscrição ou quando utilizado de alguma forma o site. 
                    Usuário: todo aquele que passar a usar o site.
                </p>
                <p>
                    2. Obtenção dos dados e informações: os dados e informações serão obtidos quando o Usuário: 1. Passar a utilizar o site; 
                    2. Interagir com as diversas ferramentas existentes no site, fornecendo as informações voluntariamente; 
                    ou 3. Entrar em contato através dos canais de comunicação disponíveis no site.
                </p>
                <p>
                    3. Armazenamento dos Dados e Informações: todos os dados e informações coletados dos Usuários serão incorporados ao banco de dados do site, 
                    sendo seu responsável e proprietário o Minha Revisão. Os dados e informações coletados estarão armazenados em ambiente seguro, 
                    observado o estado da técnica disponível, e somente poderão ser acessados por pessoas qualificadas e autorizadas pelo Minha Revisão. 
                    Além disso, a Minha Revisão afirma que não compartilhará, venderá ou apresentará os dados dos Usuários para terceiros, 
                    que não sejam seus parceiros. Considerando que nenhum sistema de segurança é absolutamente seguro, a Minha Revisão se exime de quaisquer 
                    responsabilidades por eventuais danos e/ou prejuízos decorrentes de falhas, vírus ou invasões do banco de dados do site, salvo nos casos de 
                    dolo ou culpa pela mesma. O Usuário é o proprietário dos dados e está apto a adicionar, excluir ou modificar quaisquer informações que estiverem 
                    ligadas ao seu perfil de usuário na Minha Revisão, e por isso o Usuário declara estar ciente e concorda com a coleta, armazenamento, tratamento, 
                    processamento e uso das Informações enviadas e/ou transmitidas pelo Usuário nos termos estabelecidos nestes Termos de Uso e Política de Privacidade.
                </p>
                <p>
                    4. Uso dos Dados e Informações: os dados e informações coletados dos Usuários poderão ser utilizados para as seguintes finalidades: 
                    1. Efetuar qualquer comunicação resultante de atividade do próprio site ou a identificação do respectivo destinatário; 
                    2. Responder a eventuais dúvidas e solicitações do Usuário; 
                    3. Fornecer acesso à área restrita do site ou suas funcionalidades exclusivas; 
                    4. Cumprimento de ordem legal ou judicial; 
                    5. Constituir, defender ou exercer regularmente direitos em âmbito judicial ou administrativo; 
                    6. Elaborar estatísticas gerais, para identificação do perfil dos Usuários e desenvolvimento de campanhas da Minha Revisão; 
                    7. Garantir a segurança dos Usuários; 
                    8. Manter atualizados os cadastros dos Usuários para fins de contato autorizado a ser feito por telefone, correio eletrônico, 
                    SMS, mala-direta ou por outros meios de comunicação; 9. Informar a respeito de novidades, promoções e eventos da Minha Revisão e 
                    seus parceiros comerciais.
                    <br>
                    4.1. Sobre os e-mails: serão enviados e-mails diariamente com ofertas para os clientes cadastrados. Os e-mails enviados pela Minha Revisão 
                    não contêm anexos para serem baixados e tampouco solicitam dados dos usuários.
                    <br>
                    4.2. Caso o Cliente não queira mais receber e-mails da Minha Revisão, ele deve clicar no link de descadastramento presente em todos 
                    os e-mails enviados.
                </p>
                <p>
                    5. Do Registro de Atividades: a Minha Revisão poderá registrar as atividades efetuadas pelo Usuário no site, por meio de logs, incluindo: 
                    1. Endereço IP do Usuário; 2. Ações efetuadas pelo Usuário no site; 3. Páginas acessadas pelo Usuário; 4. Datas e horários de cada 
                    ação e de acesso a cada funcionalidade do site; 5. Session ID do Usuário, quando aplicável. Os registros mencionados poderão ser utilizados 
                    pela Minha Revisão em casos de investigação de fraudes ou de alterações indevidas em seus sistemas e cadastros.
                </p>
                <p>
                    6. Cookies: o site poderá fazer o uso de cookies, cabendo ao Usuário configurar o seu navegador de Internet, caso deseje bloqueá-los. 
                    Nesta hipótese, algumas funcionalidades do site poderão ser limitadas.
                </p>
                <p>
                    7. Recomendações: a partir do uso de um cookie que identifica a navegação do Usuário, o site faz a recomendação de produtos. 
                    Essa recomendação varia conforme o Usuário e seu comportamento dentro do site, sendo avaliado, por exemplo, se houve apenas navegação ou 
                    também compra, quais itens foram vistos, pesquisados ou comprados por ele e outros Usuários em situações de navegação semelhantes. 
                    Considerando que essa recomendação é gerada a partir de algoritmos, sua precisão pode não ser exata, porém visa sugerir produtos que 
                    sejam do interesse do Usuário, sem que este tenha qualquer obrigatoriedade de adquiri-los.
                </p>
                <p>
                    8. Disposições Gerais: as disposições constantes desta Política de Privacidade poderão ser atualizadas ou modificadas a qualquer momento, 
                    cabendo ao Usuário verificá-la sempre que efetuar o acesso ao site. O Usuário deverá entrar em contato em caso de qualquer dúvida com relação 
                    às disposições constantes desta Política de Privacidade e Uso, elegendo um destes meios de contato: telefone (011) 99012.8638 ou formulário 
                    de contato.
                </p>
                <p>
                    9. Lei Aplicável e Jurisdição: a presente Política de Privacidade será interpretada segundo a legislação brasileira, no idioma português, 
                    sendo eleito o Foro da Comarca de São Paulo para dirimir qualquer litígio, questão ou dúvida superveniente, com expressa renúncia de qualquer outro, 
                    por mais privilegiado que seja.
                </p>
                <p>
                    10. Cadastro: para participar e usufruir do site, além de ter a idade mínima de 18 (dezoito) anos, o Cliente deverá fornecer na ocasião do cadastro as 
                    seguintes informações: nome completo, apelido, CPF, RG, endereço completo, telefone fixo, data de nascimento, e-mail, além de escolher uma senha.
                </p>

                <p>
                    Atualização: 15 de setembro de 2020.
                </p>
                <p>
                    Minha Revisão Tecnologia e Serviços Automotivos LTDA
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center col-md-10 mx-auto">
                    <h5 class="col-12 text-center mensagem-sucesso">Mensagem de retorno</h5>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
<?php
//$this->load->view(header);
?>