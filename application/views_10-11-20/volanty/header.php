<div class="row login">
  <div class="col-6 text-left ">
    <img src="<?= base_url('assets/img/volanty/horizontal_logos.png') ?>" onclick="$('#confirmModal').modal('toggle')">
  </div>
  <div class="col-6 text-right ">
    <h4>
      <i class="fas fa-user-circle"></i>
      <!-- Logado -->
      <span class="logado nome <?= isset($_SESSION['nome']) ? null : 'd-none' ?>"> <?= isset($_SESSION['nome']) ? $_SESSION['nome'] : null ?> </span>
      <span class="logado <?= isset($_SESSION['nome']) ? null : 'd-none' ?>"><a href="<?= base_url('volanty/logout') ?>"> <i class="fas fa-sign-out-alt"></i></a></span>
      <!-- Não logado -->
      <a href="#" class="nao-logado <?= isset($_SESSION['nome'])?'d-none':null ?>" data-toggle="modal" data-target="#loginModal">Fazer Login</a>
    </h4>
  </div>
</div>