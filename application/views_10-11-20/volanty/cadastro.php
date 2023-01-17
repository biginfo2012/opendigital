<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Index</title>

  <?php $this->load->view('volanty/assetsinclude'); ?>
</head>

<div id="loader" style="display: none;">
  <div class="loader"></div>
</div>

<body class="usuarioForm" style="background-image: url('<?= base_url('assets/img/bg.png') ?>')">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a class="navbar-brand left" href="<?php echo base_url('volanty') ?>">
          <img class="logo" src="<?php echo base_url("assets/img/horizontal.png") ?>" style="max-width: 220px;">
        </a>
        <a class="float-right close" href="<?= base_url('volanty/agenda') ?>"><i class="far fa-window-close"></i></a>
      </div>
    </div>
    <br> <br>
    <div class="row">
      <div class="col-12 text-left">
        <h3> <?php echo "Cadastro" ?> </h3>
      </div>
    </div>
    <br>
    <form class="form-cadastro" id="<?= "mainCadastro" ?>" method="post">
      <div class="row">
        <div class="form-group  col-4">
          <input class="form-control letterMask" name="nome" type="text" id="inputNomeCad" required="" placeholder="Nome">
        </div>
        <div class="form-group  col-4">
          <input class="form-control dataMask" name="data_nascimento" type="text" id="inputDtNasc" placeholder="Data de nascimento">
        </div>
        <div class="form-group  col-4">
          <input class="form-control cpfMask" name="cpf" type="text" id="inputCpfCad" required="" placeholder="CPF">
        </div>
        <div class="form-group  col-4">
          <input class="form-control" name="user" type="email" id="inputEmailCad" required="" placeholder="E-mail">
        </div>
        <div class="form-group  col-4">
          <input class="form-control" name="senha" type="password" id="inputPasswordCad" placeholder="Senha">
        </div>
        <div class="form-group  col-4">
          <input class="form-control" name="confirm_senha" type="password" id="inputConfirmPassword" placeholder="Confirmação de senha">
        </div>

        <div class="col-8">
          <div class="form-group float-left mr-3 cep-input">
            <input class="form-control cepMask" name="cep" type="text" id="inputCepCad" required="" placeholder="Cep">
          </div>
          <div class="form-group float-left mr-3">
            <input class="form-control requested" name="rua" type="text" id="inputRuaCad" required="" placeholder="Rua">
          </div>
          <div class="form-group float-left numero-input">
            <input class="form-control addressNumMask" name="numero_casa" type="text" id="inputNumeroCad" required="" placeholder="Nº">
          </div>
        </div>
        <div class="form-group  col-4">
          <input class="form-control requested" name="bairro" type="text" id="inputBairroCad" required="" placeholder="Bairro">
        </div>

        <div class="form-group  col-4">
          <input class="form-control letterMask requested" name="cidade" type="text" id="inputCidadeCad" required="" placeholder="Cidade">
        </div>
        <div class="form-group  col-4">
          <select class="form-control requested" name="estado" id="inputEstadoCad" required style="background: url(<?php echo base_url('assets/img/seta-select.png')  ?>) 94% / 4% no-repeat #fff0;">
            <option value="">Estado</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Destrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondôdia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
          </select>
        </div>
        <div class="form-group  col-4">
          <input class="form-control telMask" name="telefone" type="text" id="inputTelefone" required="" placeholder="Telefone">
        </div>

      </div>
      <br>
      <div class="row">
        <div class="col-md-5 mx-auto text-center">
          <button type="submit" name="button" class="btn-enviar">Cadastrar <i class="fas fa-angle-right"></i></button>
        </div>
      </div>
    </form>
    <div class="row poweredby">
      <div class="col-12 text-center">
        <img class="mx-auto" src="<?= base_url('assets/img/poweredby_black.png') ?>" alt="">
      </div>
    </div>
  </div>
</body>

<!-- LOADING MODAL -->
<!-- <div class="modal fade" id="pleaseWaitDialog" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header mx-auto text-center">
        <h3 class="loading">CARREGANDO</h3>
      </div>
    </div>
  </div>
</div> -->

<!-- ERROR MODAL -->
<div class="modal fade" id="errorModal" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center col-md-10 mx-auto">
          <h5 class="text-center mensagem-erro">Descrição do Erro</h5>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SUCCESS MODAL -->
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
          <h5 class="text-center mensagem-sucesso">Mensagem de retorno</h5>
        </div>
      </div>
    </div>
  </div>
</div>

</html>