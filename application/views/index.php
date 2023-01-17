<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html>
<html lang="pt-br">
      

<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MR7H5XW');</script>
    <!-- End Google Tag Manager -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="description" content="Minha Revisão é o novo jeito de revisar seu carro sem dor de cabeça e zero de burocracia! - Revisão, Serviços Automotivos, Óleo de Motor, Anel de Vedação,  Filtro de Óleo, Filtro de Combustível, Filtro de Ar, Alinhamento, Balanceamento, Filtro Cabine, Higienização do AC e muito mais.">
  <meta name="keywords" content="Revisão, Carro, Serviços Automotivos, Automotivos, Óleo de Motor, Anel de Vedação, Filtro de Óleo, Filtro de Combustível, Filtro de Ar, Alinhamento, Balanceamento, Filtro Cabine, Higienização do AC, Manutenção de Carro">

  <link rel="canonical" href="http://www.minharevisao.com.br/" />

  <title>Minha Revisão - Revisão automotiva, Serviços Automotivos</title>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130784529-1"></script>

  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-130784529-1', {
      'optimize_id': 'GTM-P67HHXZ'
    });
  </script>

  <?php $this->load->view('assetsinclude'); ?>
  <script src="https://www.facebook.com/tr?id=539734989902263&ev=PageView"></script>
</head>

<body class="bg-light">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->




  <!-- BOTÃO FLUTUANTE -->
  <a href="#index">
    <div class="floating">
      <img src="<?php echo base_url('assets/img/arrow.png') ?>" alt="Seta de Movimentação">
    </div>
  </a>
  <!-- /BOTÃO FLUTUANTE -->

  <!-- BOTÃO FLUTUANTE WHATSAPP -->
  


  <a href="https://api.whatsapp.com/send/?phone=5511990128638&text=Ola%21+Gostaria+de+tirar+minhas+d%C3%BAvidas+sobre+os+servi%C3%A7os+da+Minha+Revis%C3%A3o." class="floatingwpp" target="_blank">
<i class="fab fa-whatsapp my-floatingwpp"></i>
</a>

  <!-- /BOTÃO FLUTUANTE -->

  <!-- AVISO COOKIES -->
  <div class="cookie-warning text-center">
    Utilizamos cookies essenciais e tecnologias semelhantes de acordo com a nossa 
    <a data-toggle="modal" data-target="#lgpdModal" href="#">Política de Privacidade</a> e, 
    ao continuar navegando você concorda com estas condições 
    <button class="ml-2 btn btn-warning text-center" onclick="$('.cookie-warning').addClass('d-none')">Ok</button>
  </div>
  <!-- /AVISO COOKIES -->

  <section style="overflow-x: hidden">
    <!-- SECTION INÍCIO -->
    <div class="index" id="index">
      <?php $this->load->view('nav', array("logado" => (isset($_SESSION['logado']) ? $_SESSION['logado'] : 0), "agenda" => 0)); ?>

      <div class="container-fluid  text">
        <div class="container mx-auto">
          <div class="row">
            <div class="page-text col-12">
              <div class="text-center col-12">
                <button class="play-button text-center" data-toggle="modal" data-target="#videoModal">
                  <i class="fas fa-play mx-auto p-0" style="padding-left: 4px!important;padding-top: 5px!important"></i>
                </button>
              </div>
              <br>
              <div class="col-md-8 mx-auto text-center col-12">
              <!--h3>Já imaginou revisar seu carro sem burocracias e perto da sua casa? Aperte o play e descubra!</!--h3-->
              <h3>Revisão de automóvel com tranquilidade e segurança.<br><br> Aperte o play e descubra!</h3>
              </div>
              <br>
              <div class="col-md-6 mx-auto text-center col-12">
                <h5>Minha Revisão é o novo jeito de revisar seu carro sem dor de cabeça!</h5>
              </div>
              <br>
              <div class="col-md-9 mx-auto text-center col-12">
                <a href="<?php echo base_url('agenda') ?>">
                  <div class="mx-auto btn-agenda" href="#"> Agende sua Revisão AQUI!</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <video autoplay loop muted class="col-12 h-100 p-0 m-0 background-video">
        <source src="<?= base_url('assets/vid/background.mp4') ?>" type="video/mp4">
      </video>

      <div class="icn_scroll col-12  text-center" style="position: absolute; bottom:-3px">
        <a href="#servicos">
          <img id="icn_scroll" src="<?php echo base_url('assets/img/separador_scroll.png') ?>" alt="Descer página">
        </a>
      </div>
    </div>

    <!-- SECTION SERVICOS -->
    <div class="servicos" id="servicos">
      <div class="container-fluid car-service-container text-center fullscreen">
        <div class="row first-row" style="height: 100%;">
          <div class="col-12" style="vertical-align: middle;">
            <div class="row text-center " style="margin-top: 60px" >
              <div class="col-12">
                <h2>Como comprar a sua Revisão?</h2>
                <br>
                <h5>Veja como realizar uma compra pela <b>Minha Revisão</b></h5>
              </div>
            </div>
          </div>
          
          <div class="col-12 passos mx-auto">
            <div class="row content">
              <div class="col-md-3 mx-auto col-sm-12 text-center item">
                <img src="<?php echo base_url('assets/img/passo1.png') ?>" alt="Primeiro Passo" class="img-fluid"> <br> <br>
                <div class="h5 text-center">Informe os dados básicos do seu veículo</div>
              </div>
              <img class="arrow" src="<?php echo base_url('assets/img/arrow.png') ?>" alt=">>>">
              <div class="col-md-4 mx-auto col-sm-12 text-center item">
                <img src="<?php echo base_url('assets/img/passo2.png') ?>" alt="Segundo Passo" class="img-fluid"><br> <br>
                <div class="h5 text-center">Escolha um dos nossos planos de revisão</div>
              </div>
              <img class="arrow" src="<?php echo base_url('assets/img/arrow.png') ?>" alt=">>>">
              <div class="col-md-3 mx-auto col-sm-12 text-center item">
                <img src="<?php echo base_url('assets/img/passo3.png') ?>" alt="Terceiro Passo" class="img-fluid"> <br> <br>
                <div class="h5 text-center">Encontre uma oficina perto de você</div>
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
            <a href="<?php echo base_url('agenda') ?>">
              <div class="btn-agenda" href="#">Agendar Minha Revisão</div>
            </a>
          </div>
          <div class="icn_scroll col-12  text-center">
            <a href="#pacotes">
              <img id="icn_scroll" src="<?php echo base_url('assets/img/separador_money.png') ?>" alt="Descer página">
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION PACOTES -->
    <div id="pacotes" class="pacotes">
      <div class="container-fluid fullscreen" style="height: auto !important;">
        <div class="row first-row" style="height:100%;">
          <div class="title col-12 text-center">
            <h2>Pacotes de serviços disponíveis</h2>
            <h5>Conheça nossos pacotes e escolha a melhor opção de revisão para seu carro</h5>
          </div>
          <div class="col-12">
            <div class="container text-center">
              <div class="card-deck mb-3 text-center">

              <div class="card">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal" style="font-size: 1.7rem;">Básico</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title" style="font-size: 2.0rem;"><small class="text-muted">A partir de:</small><br> R$285,00</h1>
                    <div style="text-align: center">
                    <ul class="list-unstyled mt-3 mb-4" style="text-align: left; display: inline-block;">
                      <li style="text-align: center; padding-bottom: 5px" ><b>Incluso</b></li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Anel de vedação</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de óleo</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de combustível</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de ar</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Revisão</li>
                      <li class='scratched'>Alinhamento</li>
                      <li class='scratched'>Balanceamento</li>
                      <li class='scratched'>Filtro cabine</li>
                      <li class='scratched'>Higienização do AC</li>
                    </ul>
                    </div>
                    </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal" style="font-size: 1.7rem;">Intermediário</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title" style="font-size: 2.0rem;"><small class="text-muted">A partir de:</small><br> R$335,00</h1>
                    <div style="text-align: center">
                    <ul class="list-unstyled mt-3 mb-4" style="text-align: left; display: inline-block;">
                      <li style="text-align: center; padding-bottom: 5px" ><b>Incluso</b></li>
                    <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Óleo de motor</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Anel de vedação</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de óleo</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de combustível</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de ar</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Revisão</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Alinhamento</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Balanceamento</li>
                      <li class='scratched'>Filtro cabine</li>
                      <li class='scratched'>Higienização do AC</li>
                    </ul>
                    </div></div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal" style="font-size: 1.7rem;">Premium</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title" style="font-size: 2.0rem;"><small class="text-muted">A partir de:</small><br> R$475,00</h1>
                    <div style="text-align: center">
                    <ul class="list-unstyled mt-3 mb-4" style="text-align: left; display: inline-block;">
                      <li style="text-align: center; padding-bottom: 5px" ><b>Incluso</b></li>
                      
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Óleo de motor</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Anel de vedação</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de óleo</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de combustível</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro de ar</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Revisão</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Alinhamento</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Balanceamento</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Filtro cabine</li>
                      <li><img src="https://www.minharevisao.com.br/assets/img/check.png" alt="" width="15">  Higienização do AC</li>
                    </ul>
                    </div></div>
                </div>

                
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
            <a href="<?php echo base_url('agenda') ?>">
              <div class="btn-agenda" href="#">Agendar Minha Revisão</div>
            </a>
          </div>
          <div class="icn_scroll col-12  text-center">
            
            <a href="#oficinas">
              <img id="icn_scroll" src="<?php echo base_url('assets/img/roda.png') ?>" alt="Descer página">
            </a>
          </div>
        </div>
      </div>
    </div>


    <!-- SECTION OFICINAS -->
    <div class="oficinas" id="oficinas">
      <div class="container-fluid  text-center fullscreen" style="height: auto !important;">
        <div class="row first-row" style="height: 100%; min-height: 100vh; text-align: center !important; vertical-align : middle" >
          <div class="col-12" style="vertical-align: middle;">
            <div class="row text-center " style="margin-top: 95px" >
              <div class="col-12">
                <h2>Oficinas Credenciadas</h2>
                <br>
                <h5>Todas as oficinas que prestam serviço pela Minha Revisão são credenciadas.</h5>
              </div>

              <div class="row col-12 " style="max-width: 1000px; margin: 0px  auto;">
              <div class=" col-md-3 mx-auto text-center item">
                <img class="img-fluid"  src="<?php echo base_url('assets/img/porto-logo2.png') ?>"  alt="PORTO SEGURO" width="100" height="100">  
              </div>
              
              <div class="col-md-3 mx-auto  text-center item">
                <img class="img-fluid"  src="<?php echo base_url('assets/img/bosch-logo.png') ?>" alt="BOSCH" width="100" height="100">
              </div>
             </div>
            </div>
          </div>

          <div class="row text-center mx-auto"  >
              <div class="col-12 mx-auto">
                
                <h2>Cidades Atendidas</h2>
              </div>

              <div class="row col-12 " style="max-width: 1000px; margin: 10px auto;">
              <div class=" col-md-4 mx-auto text-center item">
              Aracruz - ES <br>
              Atibaia <br>
              Barueri <br>
              Campinas <br>
              Campo Grande - MS <br>
              Canoas - RS <br>
              Cotia <br>
              Diadema <br>
              Guarulhos
              </div>
              
              <div class="col-md-4 mx-auto  text-center item">
              
              Indaiatuba<br> 
              João Pessoa - PB<br>
              Mauá<br>
              Mogi das Cruzes<br>
              Muriaé - MG<br>
              Osasco<br>
              Piracicaba<br> 
              Ribeirão Preto<br>
              Rio de Janeiro -RJ 
              </div>

              <div class="col-md-4 mx-auto  text-center item">
              
              Santo André<br>
São Bernardo do Campo<br>
São Caetano<br>
São José dos Campos<br>
São Leopoldo - RS<br>
São Paulo<br>
Taboão da Serra<br>
Vargem Grande Paulista

              </div>
             </div>
            </div>
          
          

          <!--div class="col-12 text-center" style="vertical-align : middle">
            <a href="<!?php echo base_url('agenda') ?>" style="vertical-align : middle">
              <div class="btn-agenda" href="#">Comprar Minha Revisão</div>
            </a>
          </!--div-->
          <div class="icn_scroll col-12  text-center">
          <a href="#contato">
              <img id="icn_scroll" src="<?php echo base_url('assets/img/separador_contato.png') ?>" alt="Descer página">
            </a>
          </div>
        </div>
      </div>
    </div>



    <!-- SECTION CONTATO -->
    <div class="contato" id="contato" style="background-color:#00887a; overflow: auto;  width: 100%; width: 100vw;" >
      <div class="container-fluid" style="background-image: url(<?php echo base_url('assets/img/preferencial_back.png') ?> );background-size: contain;background-position: center;background-repeat: no-repeat;">
        <div class="row" >
          <!--div class="col-md-6 col-sm-12 bg-contato" style=" height:100%;background-image: url(<?php echo base_url('assets/img/bg_index.png') ?>); background-position: bottom;">
          </!--div-->
          <div class="col-md-6 text-center">
            <div class="content " style="padding-top: 50px !important; padding-bottom: 50px !important">
              <div class="row text-center paragraph">
                <div class="col-12">
                  <h1 style="font-weight:bold; font-size: 35px !important;">Ficou com Dúvidas!?</h1>
                </div>
                <div class="col-12"  >
                  <h1 style="font-weight:bold; font-size: 35px !important;">Fale com a gente!</h1>
                </div>
                <div class="col-12">
                  <button href="#" type="button" class="btn" data-toggle="modal" data-target="#contatoModal" role="button" style="color: white; border:solid 1px #fff;">Clique para entrar em contato!</button>
                </div>
                <br><br>
                <div class="col-12">
                  <a href="https://www.facebook.com/minharevisao" target="_blank"><img src="<?php echo base_url('assets/img/facebook.png') ?>" alt="Facebook"></a>
                  <a href="https://www.instagram.com/minharevisao" target="_blank"><img src="<?php echo base_url('assets/img/instagram.png') ?>" alt="Instagram"></a>
                </div>
              </div>
              
            </div>
          </div>

          <div class="col-md-6  text-center">
            <div class="content" style="padding-top: 50px !important; padding-bottom: 50px !important">
              
              <div class="text-center footer">
                <div class="col-12">
                  <a href="https://transparencyreport.google.com/safe-browsing/search?url=minharevisao.com.br&hl=pt-PT" target="_blank">
                    <img src="<?php echo base_url("assets/img/selo-google-site-seguro_white.png") ?>" style="width:130px; height:46px;" alt="Selo Google de Segurança">
                  </a>
                </div>
                <br>
                <div class="col-12">
                  Minha Revisão - <?= date('Y') ?> |
                  Gabryel de Freitas Elias |
                  361.408.498-10
                </div>
                <br>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MODAL DE VÍDEO -->
  <div class="modal video-modal fade w-100 bd-example-modal-lg" id="videoModal" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg pt-0 mt-0" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close close-video" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body col-12 mx-auto text-center p-0">
          <video controls class="mx-auto" id="video">
            <source src="<?= base_url('assets/vid/full.mp4') ?>" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL DE MENSAGEM DE SUCESSO -->
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

  <!-- MODAL ERRO -->
  <div class="modal fade" id="errorModal" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true" style="z-index:1100;">
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

  <script type="text/javascript" src="<?php echo base_url('assets/js/fullpage_config_index.js') ?>"></script>

  <script>
    var passo1 = "<?php echo base_url('assets/img/passo1.png') ?>";
    var passo2 = "<?php echo base_url('assets/img/passo2.png') ?>";
    var passo3 = "<?php echo base_url('assets/img/passo3.png') ?>";
    var passo4 = "<?php echo base_url('assets/img/passo4.png') ?>";
    var passo5 = "<?php echo base_url('assets/img/passo5.png') ?>";
    var passo6 = "<?php echo base_url('assets/img/passo6.png') ?>";
  </script>

  <?php $this->load->view('modal_login'); ?>
  <?php $this->load->view('modal_cadastro'); ?>
  <?php $this->load->view('modal_perfil'); ?>
  <?php $this->load->view('modal_pedidos'); ?>
  <?php $this->load->view('modal_contato'); ?>
  <?php $this->load->view('modal_centralAjuda'); ?>
  <?php $this->load->view('modal_privacidade'); ?>

  <!-- BANNER MODAL ->
  <div-- class="modal image-modal fade w-100 bd-example-modal-lg" id="imageModal" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg pt-0 mt-0" role="document" style="position:relative; top:50%; transform:translateY(-60%);">
      <div class="modal-content" style="background:none; border:none; width:fit-content; margin:auto; max-width:fit-content;">
        <div class="modal-header" style="background:none; border:none; padding-top:0; padding-bottom:5px; padding-right:1.5rem">
          <button type="button" class="close close-video" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body col-12 mx-auto text-center p-0">
          <img class="img-responsive" style="max-width: 45%" src="<!?php echo base_url('assets/img/banner/banner1.jpg') ?>" alt=""-->
          <!--img class="img-responsive" style="max-width: 80%; max-height: 75vh" src="<!?php echo base_url('assets/img/banner/banner2.jpg') ?>" alt=""-->
        <!--/div>
      </div>
    </div>
  </div-->

</body>


</html>
<?php
//$this->load->view(header);
?>