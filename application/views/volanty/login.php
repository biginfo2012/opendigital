<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MR7H5XW');</script>
<!-- End Google Tag Manager -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Acesso Volante</title>
  <?php $this->load->view('volanty/assetsinclude') ?>
</head>

<body class="login-volante bg-white">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  <section>
    <div class="container-fluid bg-white">
      <div class="container">
        <div class="row text-center mt-3">
          <!--<h2 class="text-center mx-auto text-success">Acesso <br> Volanty - Minha Revisão</h2>-->
        </div>
        <div class="row mt-3">
          <div class="col-8 mx-auto text-center">
            <img class="logo" src="<?php echo base_url("assets/img/horizontal.png") ?>">

            <form class="mx-auto mt-3" autocomplete="off" method="POST" action="<?= base_url('volanty/login') ?>"><br>
              <div class="form-group mt-3">
                <label for="email" class="sr-only">Email</label>
                <input type="text" name="user" id="email" value="" class="form-control" placeholder="Email">
              </div>
              <div class="form-group mt-3">
                <label for="key" class="sr-only">Senha</label>
                <input type="password" name="senha" id="password" value="" class="form-control" placeholder="Senha">
              </div><br>
              <p><button type="submit" class="btn mx-auto btn-light bg-success btn-lg btn-block">EFETUAR LOGIN</button></p>
            </form>
            <br><br>
            <p>
              <div class="row text-center">

                <div class="mx-auto"> Não possui cadastro? <br> <a class="btn btn-block bg-secondary text-white" href="<?= base_url('volanty/cadastro') ?>">Cadastrar</a></div>
              </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>