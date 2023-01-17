<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<nav class="navbar navbar-expand-lgt">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   <a id="logo-servicos" class="navbar-brand left" href="<?php echo base_url() ?>"><div class="logo"></div></a>
  <div class="collapse navbar-collapse " id="navbarTogglerDemo01">

    <!-- <ul class="nav flex-column nav-serv">
        <li class="nav-item active">
          <a class="nav-link" href="#index">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#servicos">Como funciona?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contato">Fale com a gente</a>
        </li>
        <hr>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('agenda') ?>">Agendar Revisão</a>
        </li>
    </ul> -->

    <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="#servicos">Como funciona?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('agenda') ?>">Agendar Revisão</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contato">Contato</a>
        </li>
    </ul>
  </div>
</nav>
