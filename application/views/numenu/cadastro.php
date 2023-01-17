<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

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
  <title><?php echo $titulo_website; ?></title>

  <?php $this->load->view('numenu/assetsinclude'); ?>
</head>

<div id="loader" style="display: none;">
  <div class="loader"></div>
</div>

<body class="usuarioForm" style="background-image: url('<?php echo base_url('assets/img/bg.png') ?>')">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  <div class="container">
    <div>
      <div>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3">
            <a class="navbar-brand left" href="<?php echo base_url('numenu'); ?>">
              <img class="logo img-fluid" src="<?php echo base_url("assets/img/horizontal.png"); ?>">
            </a>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xl-9">
            <a class="float-right close" href="<?php echo base_url('numenu/agenda'); ?>"><i class="far fa-window-close"></i></a>
          </div>
        </div>
      </div>
    </div>
    <br> <br>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 text-left">
        <h3> <?php echo "Cadastro" ?> </h3>
      </div>
    </div>
    <br>
    <form class="form-cadastro" id="<?php echo "mainCadastro" ?>" method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control letterMask" name="nome" type="text" id="inputNomeCad" required="" placeholder="Nome">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control dataMask" name="data_nascimento" type="text" id="inputDtNasc" placeholder="Data de nascimento">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control cpfMask" name="cpf" type="text" id="inputCpfCad" required="" placeholder="CPF">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control" name="user" type="email" id="inputEmailCad" required="" placeholder="E-mail">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control" name="senha" type="password" id="inputPasswordCad" placeholder="Senha">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control" name="confirm_senha" type="password" id="inputConfirmPassword" placeholder="Confirmação de senha">
          </div>
        </div>

        <div class="col-md-2">
          <div class="cep-input">
            <div class="form-group">
              <input class="form-control cepMask" name="cep" type="text" id="inputCepCad" required="" placeholder="Cep">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="">
            <div class="form-group">
              <input class="form-control requested" name="rua" type="text" id="inputRuaCad" required="" placeholder="Rua">
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="numero-input">
            <div class="form-group">
              <input class="form-control addressNumMask" name="numero_casa" type="text" id="inputNumeroCad" required="" placeholder="Nº">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control requested" name="bairro" type="text" id="inputBairroCad" required="" placeholder="Bairro">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control letterMask requested" name="cidade" type="text" id="inputCidadeCad" required="" placeholder="Cidade">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <select class="form-control requested" name="estado" id="inputEstadoCad" required style="background: url(<?php echo base_url('assets/img/seta-select.png');  ?>) 94% / 4% no-repeat #fff0;">
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
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input class="form-control telMask" name="telefone" type="text" id="inputTelefone" required="" placeholder="Telefone">
          </div>
        </div>

      </div>
      <br>
      <div class="row">
        <div class="col-md-md-5 mx-auto text-center">

          <button type="button" class="btn-voltar" onclick="location.href='<?php echo base_url('numenu/agenda'); ?>'">
            <i class="fas fa-angle-left"></i>&nbsp;
            <span>Voltar</span>
          </button>
          &nbsp;&nbsp;
          <button type="submit" name="button" class="btn-enviar">
            Cadastrar &nbsp;<i class="fas fa-angle-right"></i>
          </button>
          <br /><br />
        </div>
      </div>
    </form>
    <div class="row poweredby">
      <div class="col-md-12 text-center">
        <img class="mx-auto" src="<?php echo base_url('assets/img/poweredby_black.png'); ?>" alt="">
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
        <div class="text-center col-md-md-10 mx-auto">
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
        <div class="text-center col-md-md-10 mx-auto">
          <h5 class="text-center mensagem-sucesso">Mensagem de retorno</h5>
        </div>
      </div>
    </div>
  </div>
</div>

</html>