<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
  @media (max-width: 991px) {
    .navbar .whatsapp{
      float:none !important;
      text-align: center; 
      font-size: 2.5rem;
    }
    .navbar .whatsapp a{
      margin-right: auto !important;
      margin-left: auto !important;
    }
  }

  @media (min-width: 992px) {
    .navbar-expand-lg .navbar-collapse {
      position: absolute;
      width: 100%;
      left: 0;
    }

    .servicos .navbar-expand-lgt .navbar-toggler {
      margin-right: 40px !important;
    }

    .logo {
      width: 200px;
      height: 50px;
    }

    .logo {
      margin-left: 5px;
    }

    .navbar-nav .nav-link {
      font-size: 12px;
      font-weight: bold;
    }

    .top-nav li a span {
      font-size: 12px;
    }

    .top-nav li {
      margin-left: 5px;
      margin-right: 5px;
    }

    .navbar {
      padding-top: 15px;
    }

    .div_cadastrar {
      right: 4rem;
      margin-right: 65px;
      position: absolute;
    }

    .servicos .navbar-collapse {
      width: auto;
      right: 82px;
      margin-top: 44px;
      border-radius: 5px;
      text-align: right !important;
    }

    .servicos .navbar-collapse {
      background-color: #1c50a3 !important;
      position: absolute !important;
      top: 0 !important;
    }

    .nav-link {
      text-transform: capitalize;
    }

    .flex-column {
      flex-direction: column !important;
      display: -webkit-inline-box;
    }

    .div_perfil {
      font-style: verdana;
      font-size: 18px;
      color: #4866b3;

    }

    .div_perfil a {
      font-style: verdana;
      font-size: 18px;
      color: #4866b3;
    }

    .div_perfil a:hover {
      text-decoration: none;
      color: #6afe6f;
    }

    .div_perfil img {
      width: 30px;
      height: 30px;
      margin-right: 15px;
      margin-bottom: 10px;
    }
  }

  @media (min-width: 1300px) {
    .logo {
      margin-left: 60px;
    }

    .navbar-nav .nav-link {
      font-size: 12px;
      font-weight: bold;
    }

    .top-nav li {
      margin-left: 20px;
      margin-right: 20px;
    }

    .top-nav li a span {
      font-size: 12px;
    }
  }

  @media (min-width: 1920px) {
    .logo {
      width: 300px;
      height: 75px;
    }

    .logo {
      margin-left: 80px;
    }

    .navbar-nav .nav-link {
      font-size: 13px;
      font-weight: bold;
    }

    .top-nav li a span {
      font-size: 13px;
    }

    .servicos .navbar-collapse {
      margin-top: 55px;
    }
  }

  /* MENU SUPERIOR */
  #navbarSupportedContent {
    background-color: none;
  }

  .navbar {
    position: fixed;
    z-index: 1000;
    border: 0;
    border-radius: 0;
    box-shadow: none;
    top: 0;
  }

  .index .navbar {
    background-color: #ffffff;
  }

  /* .logo{
  background-image: url(<?php echo base_url("assets/img/horizontal.png") ?>);
  background-repeat: no-repeat;
  background-size: contain;
  background-position: center;
} */
  .top-nav {
    margin: auto;
    list-style: none;
    font-family: verdana;
  }

  .top-nav li a {
    display: inline-block;
    text-transform: lowercase;
  }

  .btn_cadastrar {
    font-family: verdana;
    text-decoration: none;
    text-align: center;
    border: solid 2px;
    background-color: #fff;
    background-color: #fff;
    color: #6383c3;
    border-radius: 7px;
    text-transform: uppercase;
  }

  .btn_cadastrar:hover {
    background-color: #83ff36;
    color: #fff;
  }

  .btn_cadastrar:focus {
    background-color: #83ff36 !important;
    color: #fff !important;
  }

  .menu-open {
    display: none;
  }

  /*OPÇÕES MENU SUPERIOR*/
  .navbar .navbar-brand {
    position: relative;
    z-index: 9;
  }

  .navbar-light .navbar-nav .nav-link {
    color: #4866b3;
  }

  .navbar-light .navbar-nav .nav-link:hover {
    color: #83ff36;
  }

  .navbar-light .navbar-nav .nav-link:focus {
    color: #83ff36;
  }

  .navbar-toggler-icon {
    background-image: url(<?php echo base_url("assets/img/menu_azul.png") ?>) !important;
    width: 40px !important;
    height: 40px !important;
  }

  .navbar-toggler {
    border: 0;
  }

  .navbar .whatsapp{
    float:left; 
    font-size: 2.5rem;
  }
  .navbar .whatsapp a{
    color:#4866b3; 
    margin-right: 5px;
  }


  /* -- PÁGINAS DE INSERT/EDIT USUÁRIO  */
  .usuarioForm .navbar {
    background-color: #fff;
  }

  .usuarioForm .div_cadastrar {
    display: none;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light menu-superior">
  <a class="navbar-brand left" href="<?php echo base_url() ?>">
    <img class="logo" src="<?php echo base_url("assets/img/horizontal.png") ?>">
  </a>
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav top-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?= isset($outfromindex) ? base_url() : null ?>#servicos"><span>•</span> como funciona</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#ajudaModal" href="#"><span>•</span> central de ajuda </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= isset($outfromindex) ? base_url() : null ?>#contato"><span>•</span> fale com a gente</a>
      </li>
    </ul>
    <div class="div_cadastrar ">
      <div class="div_perfil">
        <img src="<?php echo base_url("assets/img/sis_prof.png") ?>" alt="">
        <span class="info">
          Olá, <?php echo $logado ? (explode(" ", $_SESSION['nome'])[0]) : 'visitante'; ?>
          
          <?php echo $logado ? '| <a  href="#"  data-toggle="modal" data-target="#perfilModal">Perfil</a>' : '| <a  href="#"  data-toggle="modal" data-target="#loginModal">Login</a>' ?>
        </span>
      </div>
    </div>
    <div class="whatsapp">
      <a href="https://api.whatsapp.com/send?phone=5511990128638" target="_blank">
        <i class="fab fa-whatsapp"> </i>
      </a>
    </div>
  </div>
</nav>