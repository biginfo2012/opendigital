<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view(header);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Minha Revisão</title>

  <?php $this->load->view('assetsinclude'); ?>
</head>
<body class="bg-light">

  <!-- NAV LATERAL -->
  <!-- <div id="fp-nav" class="fp-responsive right marcador-sessao" class="align-middle">
  <ul id="myMenu" class="align-middle">
  <li><a data-menuanchor="index" class="active" href="#index"><span></span></a></li>
  <li><a data-menuanchor="servicos" href="#servicos"><span></span></a></li>
  <li><a data-menuanchor="servicos-2" href="#servicos-2"><span></span></a></li>
  <li><a data-menuanchor="servicos-3" href="#servicos-3"><span></span></a></li>
  <li><a data-menuanchor="servicos-4" href="#servicos-4"><span></span></a></li>
  <li><a data-menuanchor="servicos-5" href="#servicos-5"><span></span></a></li>
  <li><a data-menuanchor="servicos-6" href="#servicos-6"><span></span></a></li>
  <li><a data-menuanchor="pricing" href="#pricing"><span></span></a></li>
  <li><a data-menuanchor="contato" href="#contato"><span></span></a></li>
</ul>
</div> -->
<!-- /NAV LATERAL -->

<!-- REDES SOCIAIS -->
<div class="redes-sociais">
  <ul>
    <li class="icn-social"><a href="https://www.facebook.com/minharevisao"><img src="<?php echo base_url("assets/img/icn_facebook.png"); ?>"></a></li>
    <li class="icn-social"><a href="https://www.instagram.com/minharevisao"><img src="<?php echo base_url("assets/img/icn_instagram.png"); ?>"></a></li>
  </ul>
</div>
<!-- /REDES SOCIAIS -->

<!-- BOTÃO FLUTUANTE -->
<a href="#index">
  <div class="floating">
    <img src="<?php echo base_url('assets/img/arrow.png') ?>" alt="">
  </div>
</a>
<!-- /BOTÃO FLUTUANTE -->


<section>

  <!-- SECTION INÍCIO -->
  <div class="index" id="index">
    <?php $this->load->view('nav',array("logado"=>(isset($_SESSION['logado'])?$_SESSION['logado']:0), "agenda"=>0)); ?>
    <div class="container-fluid fullscreen index-page text-center">
      <div class="row align-items-center content"  style="height: 100% !important;text-align: initial;">
        <div class="col-sm-12 col-md-5 fadeInLeft animated">
          <div class="page-text">
            <div class="col-md-12 ">
              <h3>Já imaginou revisar seu carro sem burocracias e perto da sua casa?</h3>
            </div>
            <br>
            <div class="col-md-10">
              <h5>Minha Revisão é o novo jeito de revisar seu carro sem dor de cabeça !</h5>
            </div>
            <br>
            <div class="col-md-9 agenda">
              <a href="<?php echo base_url('agenda') ?>">
                <div class="btn-agenda" href="#">Agendar a Minha Revisão</div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 offset-md-1 img-bg-encanador fadeIn animated" style="animation-duration: 2.4s !important; height: 100% !important; background-image:url(<?php echo base_url('assets/img/bg_index.png') ?>);"></div>
      </div>
    </div>
    <div class="icn_scroll col-12  text-center" style="position: absolute; bottom:-3px;">
      <a href="#servicos">
        <img id="icn_scroll"  src="<?php echo base_url('assets/img/separador_scroll.png') ?>">
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
              <h2>Como funciona?</h2>
              <h5>Como realizar um agendamento pela <b>Minha Revisão</b></h5>
            </div>
          </div>
        </div>
        <br>
        <div class="col-12 passos mx-auto">
          <div class="row content">
            <div class="col-md-3 mx-auto col-sm-12 text-center item">
              <img src="<?php echo base_url('assets/img/passo1.png') ?>"> <br> <br>
              <div class="h5 text-center">Informe os dados básicos do seu veículo</div>
            </div>
            <img class="arrow" src="<?php echo base_url('assets/img/arrow.png') ?>">
            <div class="col-md-4 mx-auto col-sm-12 text-center item">
              <img src="<?php echo base_url('assets/img/passo2.png') ?>"><br> <br>
              <div class="h5 text-center">Escolha um dos nossos planos de revisão</div>
            </div>
            <img class="arrow" src="<?php echo base_url('assets/img/arrow.png') ?>">
            <div class="col-md-3 mx-auto col-sm-12 text-center item">
              <img src="<?php echo base_url('assets/img/passo3.png') ?>"> <br> <br>
              <div class="h5 text-center">Encontre uma oficina perto de você</div>
            </div>
          </div>
        </div>
        <div class="col-12 text-center">
          <a href="<?php echo base_url('agenda') ?>">
            <div class="btn-agenda" href="#">Agendar a Minha Revisão</div>
          </a>
        </div>
        <div class="icn_scroll col-12  text-center">
          <a href="#pacotes">
            <img id="icn_scroll"  src="<?php echo base_url('assets/img/separador_money.png') ?>">
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
          <h2>Pacotes de serviços</h2>
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
            <div class="btn-agenda" href="#">Agendar a Minha Revisão</div>
          </a>
        </div>
        <div class="icn_scroll col-12  text-center">
          <a href="#contato">
            <img id="icn_scroll"  src="<?php echo base_url('assets/img/separador_contato.png') ?>">
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
        <div class="col-md-6 col-sm-12 bg-contato" style=" height:100%;background-image: url(<?php echo base_url('assets/img/contato_bg.png') ?>);">
        </div>
        <div class="col-md-6 col-sm-12 text-center">
          <div class="content">
            <div class="row text-center paragraph" >
              <div class="col-12">
                <h1 style="font-weight:bold;">Dúvidas?</h1>
              </div>
              <div class="col-12">
                <h1>Fale com a gente!</h1>
              </div>
              <div class="col-12">
                <button href="#" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#contatoModal" role="button" style="color: white; border:solid 1px #fff;">Clique para entrar em contato!</button>
              </div>
              <br><br>
              <div class="col-12">
                <a href="https://www.facebook.com/minharevisao"><img src="<?php echo base_url('assets/img/facebook.png') ?>" alt=""></a>
                <a href="https://www.instagram.com/minharevisao"><img src="<?php echo base_url('assets/img/instagram.png') ?>" alt=""></a>
              </div>
            </div>
            <div class="text-center footer">
              <div class="col-12">
                <a href="https://transparencyreport.google.com/safe-browsing/search?url=minharevisao.com.br&hl=pt-PT" target="_blank">
                  <img src="<?php echo base_url("assets/img/selo-google-site-seguro_white.png") ?>" style="width:130px; height:46px;">
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
                  <img src="<?php echo base_url("assets/img/poweredby_insignus_branco.png") ?>" style="width:160px; height:80px;">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



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

</body>


</html>
<?php
//$this->load->view(header);
?>
