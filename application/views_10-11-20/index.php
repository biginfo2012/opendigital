<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
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

  <!-- REDES SOCIAIS -->
  <div class="redes-sociais">
    <ul>
      <li class="icn-social"><a href="https://www.facebook.com/minharevisao" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
      <li class="icn-social"><a href="https://www.instagram.com/minharevisao" target="_blank"><i class="fab fa-instagram"></i></a></li>
    </ul>
  </div>
  <!-- /REDES SOCIAIS -->

  <!-- BOTÃO FLUTUANTE -->
  <a href="#index">
    <div class="floating">
      <img src="<?php echo base_url('assets/img/arrow.png') ?>" alt="Seta de Movimentação">
    </div>
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

  <section>
    <!-- SECTION INÍCIO -->
    <div class="index" id="index">
      <?php $this->load->view('nav', array("logado" => (isset($_SESSION['logado']) ? $_SESSION['logado'] : 0), "agenda" => 0)); ?>

      <div class="container-fluid  text">
        <div class="container mx-auto">
          <div class="row">
            <div class="page-text col-12">
              <div class="text-center col-12">
                <button class="play-button text-center" data-toggle="modal" data-target="#videoModal">
                  <i class="fas fa-play mx-auto p-0"></i>
                </button>
              </div>
              <br>
              <div class="col-md-8 mx-auto text-center col-12">
                <h3>Já imaginou revisar seu carro sem burocracias e perto da sua casa? Aperte o play e descubra!</h3>
              </div>
              <br>
              <div class="col-md-6 mx-auto text-center col-12">
                <h5>Minha Revisão é o novo jeito de revisar seu carro sem dor de cabeça!</h5>
              </div>
              <br>
              <div class="col-md-9 mx-auto text-center col-12">
                <a href="<?php echo base_url('agenda') ?>">
                  <div class="mx-auto btn-agenda" href="#">Compre a sua Revisão</div>
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
          <div class="col-12">
            <div class="row text-center">
              <div class="col-12">
                <h2>Como comprar a sua Revisão?</h2>
                <h5>Veja como realizar uma compra pela <b>Minha Revisão</b></h5>
              </div>
            </div>
          </div>
          <br>
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
              <div class="btn-agenda" href="#">Comprar a Minha Revisão</div>
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
            <h5>Conheça nossos planos e escolha a melhor opção de revisão para seu carro</h5>
          </div>
          <div class="col-12">
            <div class="container text-center">
              <div class="card-deck mb-3 text-center">
                <div class="card">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Premium</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title"><small class="text-muted">A partir de:</small><br> R$475,00</h1>
                    <ul class="list-unstyled mt-3 mb-4">
                      <li><b>Incluso:</b></li>
                      <li>Óleo de motor</li>
                      <li>Anel de vedação</li>
                      <li>Filtro de óleo</li>
                      <li>Filtro de combustível</li>
                      <li>Filtro de ar</li>
                      <li>Revisão</li>
                      <li>Alinhamento</li>
                      <li>Balanceamento</li>
                      <li>Filtro cabine</li>
                      <li>Higienização do AC</li>
                    </ul>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Intermediário</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title"><small class="text-muted">A partir de:</small><br> R$335,00</h1>
                    <ul class="list-unstyled mt-3 mb-4">
                      <li><b>Incluso:</b></li>
                      <li>Óleo de motor</li>
                      <li>Anel de vedação</li>
                      <li>Filtro de óleo</li>
                      <li>Filtro de combustível</li>
                      <li>Filtro de ar</li>
                      <li>Revisão</li>
                      <li>Alinhamento</li>
                      <li>Balanceamento</li>
                      <li class='scratched'>Filtro cabine</li>
                      <li class='scratched'>Higienização do AC</li>
                    </ul>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Básico</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title"><small class="text-muted">A partir de:</small><br> R$285,00</h1>
                    <ul class="list-unstyled mt-3 mb-4">
                      <li><b>Incluso:</b></li>
                      <li>Óleo de motor</li>
                      <li>Anel de vedação</li>
                      <li>Filtro de óleo</li>
                      <li>Filtro de combustível</li>
                      <li>Filtro de ar</li>
                      <li>Revisão</li>
                      <li class='scratched'>Alinhamento</li>
                      <li class='scratched'>Balanceamento</li>
                      <li class='scratched'>Filtro cabine</li>
                      <li class='scratched'>Higienização do AC</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
            <a href="<?php echo base_url('agenda') ?>">
              <div class="btn-agenda" href="#">Comprar a Minha Revisão</div>
            </a>
          </div>
          <div class="icn_scroll col-12  text-center">
            <a href="#contato">
              <img id="icn_scroll" src="<?php echo base_url('assets/img/separador_contato.png') ?>" alt="Descer página">
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION CONTATO -->
    <div class="contato" id="contato" style="background-color:#00887a;">
      <div class="container-fluid fullscreen" style="background-image: url(<?php echo base_url('assets/img/preferencial_back.png') ?> );background-size: contain;background-position: center;background-repeat: no-repeat;
    ">
        <div class="row" style="height:100%;">
          <div class="col-md-6 col-sm-12 bg-contato" style=" height:100%;background-image: url(<?php echo base_url('assets/img/bg_index.png') ?>); background-position: bottom;">
          </div>
          <div class="col-md-6 col-sm-12 text-center">
            <div class="content">
              <div class="row text-center paragraph">
                <div class="col-12">
                  <h1 style="font-weight:bold;">Ficou com Dúvidas!?</h1>
                </div>
                <div class="col-12">
                  <h1>Fale com a gente!</h1>
                </div>
                <div class="col-12">
                  <button href="#" type="button" class="btn" data-toggle="modal" data-target="#contatoModal" role="button" style="color: white; border:solid 1px #fff;">Clique para entrar em contato!</button>
                </div>
                <br><br>
                <div class="col-12">
                  <a href="https://www.facebook.com/minharevisao" target="_blank"><img src="<?php echo base_url('assets/img/facebook.png') ?>" alt="Facebook"></a>
                  <a href="https://www.instagram.com/minharevisao" target="_blank"><img src="<?php echo base_url('assets/img/instagram.png') ?>" alt="Instagram"></a>
                  <a href="https://api.whatsapp.com/send?phone=5511990128638" target="_blank"><img src="<?php echo base_url('assets/img/whatsapp.png') ?>" alt="WhatsApp"></a>
                </div>
              </div>
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
                <div class="col-12">
                  <a href="https://www.insignus.com.br" target="_blank">
                    <img src="<?php echo base_url("assets/img/poweredby_insignus_branco.png") ?>" style="width:160px; height:80px;" alt="Powered by Insignus">
                  </a>
                </div>
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

  <!-- BANNER MODAL -->
  <div class="modal image-modal fade w-100 bd-example-modal-lg" id="imageModal" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg pt-0 mt-0" role="document" style="position:relative; top:50%; transform:translateY(-60%);">
      <div class="modal-content" style="background:none; border:none; width:fit-content; margin:auto; max-width:fit-content;">
        <div class="modal-header" style="background:none; border:none; padding-top:0; padding-bottom:5px; padding-right:1.5rem">
          <button type="button" class="close close-video" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body col-12 mx-auto text-center p-0">
          <img class="img-responsive" style="max-width: 45%" src="<?php echo base_url('assets/img/banner/banner1.jpg') ?>" alt="">
          <img class="img-responsive" style="max-width: 45%" src="<?php echo base_url('assets/img/banner/banner2.jpg') ?>" alt="">
        </div>
      </div>
    </div>
  </div>

</body>


</html>
<?php
//$this->load->view(header);
?>