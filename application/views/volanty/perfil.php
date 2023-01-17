<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Index</title>

  <?php $this->load->view('volanty/assetsinclude'); ?>
</head>

<body class="usuarioForm">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  <div class="container" style="">
    <div class="row">
      <div class="mx-auto text-center">
        <a class="navbar-brand left" href="<?php echo base_url('volanty') ?>">
          <img class="logo" src="<?php echo base_url("assets/img/horizontal.png") ?>">
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1> Perfil </h1>
        <h5>Bem vindo,  <?= $usuario->nome ?></h5>
        <a href="<?= base_url('volanty/logout') ?>" class="btn text-white bg-danger">Desconectar <i class="fas fa-sign-out-alt"></i></a>
      </div>
    </div>
    <hr class="mt-3 mb-3">
    <div class="row">
      <div class=" mx-auto text-center">
        <h3> <?php echo "Editar Perfil" ?></h3>
      </div>
    </div>
    <br>
    <form class="form-signin" id="" method="post">
      <div class="row">
        <div class=" col-6 text-left">
          <div class="form-group mb-3">
            <label for="nome">Nome:</label>
            <input class="form-control letterMask" name="nome" type="text" id="inputNomeCad" value="<?php  echo $usuario->nome  ?>" required="">
            <div class="invalid-feedback">Nome</div>
          </div>

          <div class="form-group mb-3">
            <label for="cc-name">CPF:</label>
            <input class="form-control cpfMask" name="cpf" type="text" id="inputCpfCad" value="<?php  echo $usuario->cpf  ?>" required="">
            <div class="invalid-feedback">CPF</div>
          </div>

          <div class="form-group mb-3">
            <label for="user">Email:</label>
            <input class="form-control" name="user" type="email" id="inputEmailCad" value="<?php  echo $usuario->email   ?>" required="">
            <div class="invalid-feedback">Email</div>
          </div>

          <div class="form-group mb-3">
            <label for="telefone">Telefone:</label>
            <input class="form-control telMask" name="telefone" type="text" id="inputTelefone" value="<?php  echo $usuario->telefone_contato ?>" required="">
            <div class="invalid-feedback">Telefone</div>
          </div>

          <div class="form-group mb-3">
            <label for="senha">Senha:</label>
            <input class="form-control" name="senha" type="password" id="inputPasswordCad" >
            <div class="invalid-feedback">CPF</div>
          </div>

          <div class="form-group mb-3">
            <label for="confirm_senha">Confirmação de senha:</label>
            <input class="form-control" name="confirm_senha" type="password" id="inputConfirmPassword">
            <div class="invalid-feedback">CPF</div>
          </div>

          <div class="form-group mb-3">
            <label for="confirm_senha">Data de nascimento: </label>
            <input class="form-control" name="data_nascimento" type="date" id="inputDtNasc" value="<?php  echo $usuario->data_nascimento?>">
            <div class="invalid-feedback">Data de nascimento</div>
          </div>
        </div>

        <div class="col-6 text-left address">
          <div class="form-group mb-3">
            <label for="cc-name">CEP:</label>
            <input class="form-control cepMask" name="cep" type="text" id="inputCepCad" value="<?php echo $usuario->cep ?>" required="">
            <div class="invalid-feedback">CEP</div>
          </div>
          <div class="form-group mb-3">
            <label for="cc-name">Estado:</label>
            <select class="form-control requested" name="estado" id="inputEstadoCad" required style="background: url(<?php echo base_url('assets/img/seta-select.png')  ?>) 94% / 4% no-repeat #fff0;">
              <option value="">Selecione um estado</option>
              <option value="AC" <?= $usuario->estado == 'AC' ? 'selected' : null ?>>Acre</option>
              <option value="AL" <?= $usuario->estado == 'AL' ? 'selected' : null ?>>Alagoas</option>
              <option value="AP" <?= $usuario->estado == 'AP' ? 'selected' : null ?>>Amapá</option>
              <option value="AM" <?= $usuario->estado == 'AM' ? 'selected' : null ?>>Amazonas</option>
              <option value="BA" <?= $usuario->estado == 'BA' ? 'selected' : null ?>>Bahia</option>
              <option value="CE" <?= $usuario->estado == 'CE' ? 'selected' : null ?>>Ceará</option>
              <option value="DF" <?= $usuario->estado == 'DF' ? 'selected' : null ?>>Destrito Federal</option>
              <option value="ES" <?= $usuario->estado == 'ES' ? 'selected' : null ?>>Espírito Santo</option>
              <option value="GO" <?= $usuario->estado == 'GO' ? 'selected' : null ?>>Goiás</option>
              <option value="MA" <?= $usuario->estado == 'MA' ? 'selected' : null ?>>Maranhão</option>
              <option value="MT" <?= $usuario->estado == 'MT' ? 'selected' : null ?>>Mato Grosso</option>
              <option value="MS" <?= $usuario->estado == 'MS' ? 'selected' : null ?>>Mato Grosso do Sul</option>
              <option value="MG" <?= $usuario->estado == 'MG' ? 'selected' : null ?>>Minas Gerais</option>
              <option value="PA" <?= $usuario->estado == 'PA' ? 'selected' : null ?>>Pará</option>
              <option value="PB" <?= $usuario->estado == 'PB' ? 'selected' : null ?>>Paraíba</option>
              <option value="PR" <?= $usuario->estado == 'PR' ? 'selected' : null ?>>Paraná</option>
              <option value="PE" <?= $usuario->estado == 'PE' ? 'selected' : null ?>>Pernambuco</option>
              <option value="PI" <?= $usuario->estado == 'PI' ? 'selected' : null ?>>Piauí</option>
              <option value="RJ" <?= $usuario->estado == 'RJ' ? 'selected' : null ?>>Rio de Janeiro</option>
              <option value="RN" <?= $usuario->estado == 'RN' ? 'selected' : null ?>>Rio Grande do Norte</option>
              <option value="RS" <?= $usuario->estado == 'RS' ? 'selected' : null ?>>Rio Grande do Sul</option>
              <option value="RO" <?= $usuario->estado == 'RO' ? 'selected' : null ?>>Rondôdia</option>
              <option value="RR" <?= $usuario->estado == 'RR' ? 'selected' : null ?>>Roraima</option>
              <option value="SC" <?= $usuario->estado == 'SC' ? 'selected' : null ?>>Santa Catarina</option>
              <option value="SP" <?= $usuario->estado == 'SP' ? 'selected' : null ?>>São Paulo</option>
              <option value="SE" <?= $usuario->estado == 'SE' ? 'selected' : null ?>>Sergipe</option>
              <option value="TO" <?= $usuario->estado == 'TO' ? 'selected' : null ?>>Tocantins</option>
            </select>
            <div class="invalid-feedback">Estado</div>
          </div>
          <div class="form-group mb-3">
            <label for="cc-name">Cidade:</label>
            <input class="form-control letterMask requested" name="cidade" type="text" id="inputCidadeCad" value="<?php  echo $usuario->cidade?>" required="">
            <div class="invalid-feedback">Cidade</div>
          </div>
          <div class="form-group mb-3">
            <label for="cc-name">Bairro:</label>
            <input class="form-control requested" name="bairro" type="text" id="inputBairroCad" value="<?php  echo $usuario->bairro?>" required="">
            <div class="invalid-feedback">Bairro</div>
          </div>
          <div class="form-group mb-3">
            <label for="cc-name">Rua:</label>
            <input class="form-control requested" name="rua" type="text" id="inputRuaCad" value="<?php  echo $usuario->rua?>" required="">
            <div class="invalid-feedback">Rua</div>
          </div>
          <div class="form-group mb-3">
            <label for="cc-name">Número:</label>
            <input class="form-control addressNumMask" name="numero_casa" type="text" id="inputNumeroCad" value="<?php echo $usuario->numero_casa?>" required="">
            <div class="invalid-feedback">Número</div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-5 mx-auto text-center">
          <button type="submit" name="button" class="btn-enviar">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</body>

<!-- LOADING MODAL -->
<div class="modal fade" id="pleaseWaitDialog" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header mx-auto text-center">
        <h3 class="loading">CARREGANDO</h3>
      </div>
    </div>
  </div>
</div>

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
          <h5 class="col-6 text-center mensagem-erro">Descrição do Erro</h5>
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
          <h5 class="col-6 text-center mensagem-sucesso">Mensagem de retorno</h5>
        </div>
      </div>
    </div>
  </div>
</div>
</html>