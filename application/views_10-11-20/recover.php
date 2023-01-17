<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php $this->load->view('assetsinclude'); ?>
  <title>Recuperação de senha</title>
  <style>
    .logo {
      width: 100%;
      max-width: 400px;
      margin-bottom: 40px;
    }

    h3 {
      color: #4866B3;
      font-weight: bold;
      font-family: 'Verdana', sans-serif !important;
    }

    .form-group{
      width: fit-content !important;
    }

    label {
      color: #4866B3;
      font-weight: bold;
      font-family: 'Verdana', sans-serif !important;
    }

    input {
      max-width: 400px !important;
      height: 42px !important;
      padding-left: 15px !important;
      padding-right: 15px !important;
      cursor: pointer !important;
      border-radius: 20px !important;
      border: solid 1px #B2B2B2 !important;
      margin-bottom: 5px;
      font-size: 20px !important;
      color: #707070 !important;
      text-align-last: left;
      font-family: 'Verdana', sans-serif !important;
      background: none !important;
    }

    input::placeholder {
      font-size: 20px !important;
      color: #707070 !important;
      text-align-last: left;
    }

    input:hover {
      border-color: #83ff36 !important;
      outline: 0;
    }

    input:focus {
      border-color: #83ff36 !important;
      outline: 0;
    }

    form button {
      width: 100%;
      max-width: 250px !important;
      height: 40px !important;
      background-color: #83FF36 !important;
      border: none;
      border-radius: 20px !important;
      font-family: 'Verdana', sans-serif !important;
      text-transform: uppercase !important;
      color: #707070 !important;
      font-size: 19px !important;
      font-weight: bold !important;
      cursor: pointer;
    }

    /*SUCCESS PAGE*/
    h5 {
      font-family: 'Verdana', sans-serif !important;
      font-weight: bold;
    }
    h5 a{
      color: #4866B3;
    }
    h5 a:hover{
      text-decoration: none;
      color: #83ff36;
    }
  </style>
</head>

<body>
  <div class="container-fluid bg-white">
    <div class="container">
      <div class="row mt-3">
        <div class="col-10 text-center mx-auto mt-3">
          <img class="logo" src="<?php echo base_url('assets/img/horizontal.png') ?>">
          <br>
          <h3>Recuperação de senha</h3>
          <br>
          <form id="passwordRecover">
            <input type="hidden" name="cod_usuario" value="<?= $cod_usuario ?>">
            <div class="form-group text-left mx-auto">
              <label for="exampleInputPassword1">Nova senha:</label>
              <input type="password" name="password" class="form-control mx-auto" id="exampleInputPassword1">
            </div>
            <div class="form-group text-left mx-auto">
              <label for="exampleInputPassword1">Confirmação de nova senha:</label>
              <input type="password" name="password_confirm" class="form-control mx-auto" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn">Recuperar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<!-- MODAIS -->
<div class="modal fade" id="errorModal" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="dialog">
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

<div class="modal fade" id="successModal" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="dialog">
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