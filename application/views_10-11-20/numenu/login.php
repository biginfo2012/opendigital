<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Acesso - Numenu</title>
  <?php $this->load->view('numenu/assetsinclude') ?>
</head>

<body class="login-numenu bg-white">
  <section>
    <div class="container-fluid bg-white">
      <div class="container">
        <div class="row mt-3">
          <div class="col-md-8 col-xl-8 mx-auto text-center">
            <img class="logo img-fluid" src="<?php echo base_url("assets/img/horizontal.png") ?>">

            <form class="mx-auto mt-3" autocomplete="off" method="POST" action="<?php echo base_url('numenu/login') ?>" ><br>
              <div class="form-group mt-3">
                <label for="email" class="sr-only">Email</label>
                <input type="text" name="user" id="email" value="" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group mt-3">
                <label for="key" class="sr-only">Senha</label>
                <input type="password" name="senha" id="password" value="" class="form-control" placeholder="Senha" required>
              </div><br>
              <p><button type="submit" class="btn btn-login mx-auto btn-light bg-success btn-lg btn-block">EFETUAR LOGIN</button></p>
            </form>
            <br><br>
            <p>
              <div class="row text-center">
                <div class="mx-auto"> Não possui cadastro? <br> <a class="btn btn-block bg-secondary text-white" href="<?php echo base_url('numenu/cadastro') ?>">Cadastrar</a></div>
              </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>