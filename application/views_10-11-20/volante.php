<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Acesso Volante</title>
  <?php $this->load->view('assetsinclude') ?>
</head>

<body>
  <section>
    <div class="container-fluid">
      <div class="container">
        <div class="row text-center mt-3">
          <h2 class="text-center mx-auto text-success">Acesso Volante - Minha Revisão</h2>
        </div>
        <?php if (isset($volante)) { ?>
          <div class="row">
            <div class=" text-center col-8 mx-auto">
              <a href="<?= base_url() ?>">
                <img class="logo" src="<?php echo base_url('assets/img/logo_login.png') ?>">
              </a>
              <div class="col-12 mx-auto text-center">
                <p class="h4 mt-3 mb-3">
                  Bem vindo <?= $volante['usuario'] ?>! <br>
                  Você está conectado com a Minha Revisão. <br>
                </p>

                <a href="<?= base_url('login/logoutVolante') ?>" class="btn btn-light bg-danger">Desconectar</a>
              </div>
              <hr>
            </div>
          </div>
        <?php } else { ?>
          <div class="row">
            <div class=" text-center col-4 mx-auto">
              <a href="<?= base_url() ?>">
                <img class="logo" src="<?php echo base_url('assets/img/logo_login.png') ?>">
              </a>
              <form autocomplete="off" method="POST" action="<?= base_url('login/loginVolante') ?>">
                <div class="form-group mt-3">
                  <label for="email" class="sr-only">Usuário</label>
                  <input type="text" name="user" id="user" value="" class="form-control" placeholder="Usuário">
                </div>
                <div class="form-group mt-3">
                  <label for="key" class="sr-only">Password</label>
                  <input type="password" name="senha" id="password" value="" class="form-control" placeholder="Senha">
                </div>

                <button type="submit" class="btn btn-light bg-success btn-lg btn-block">LOGIN</button>

              </form>

              <hr>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</body>

</html>