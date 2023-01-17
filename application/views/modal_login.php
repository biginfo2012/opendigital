<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center col-md-10 mx-auto">
          <form class="form-signin animated fadeIn" id="mainLogin">
            <div class="row text-center icon">
              <div class="mb-2 mx-auto"><i class="fas fa-user-circle"></i></div>
            </div>
            <div style="color:red; display:none;" id="loginException">*É necessário realizar o login para continuar.</div>
            <div class="alert alert-danger col-12 mx-auto mensagem-erro d-none" role="alert">
              Erro
            </div>
            <div class="form-group">
              <input name="user" placeholder="E-mail" type="email" id="inputEmail" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <input name="senha" placeholder="Senha" type="password" id="inputPassword" required="" autocomplete="off">
            </div>
            <div class="row mb-3">
              <div class="col-6 recover text-left"><a onclick="loginModalChange('recover'); return false;">Recuperar Senha <i class="fas fa-angle-right"></i></a></div>
              <div class="col-6 text-right mt-2"><button class="btn-enviar" type="submit">Logar &nbsp;<i class="fas fa-angle-right"></i></button></div>
            </div>
            <br>
            <div class="row mt-3 mb-3 text-center cadastrar">
              <a href="<?php echo base_url('login/insertPage') ?>">
                <div class="btn-enviar mx-auto">
                  <span> novo cadastro</span>&nbsp;
                  <i class="fas fa-angle-right"></i>
                </div>
              </a>
            </div>
          </form>
          <form class="form-recover d-none animated fadeIn" id="mainRecover">
            <div class="row text-center icon"><i class="fas fa-user-circle"></i></div>

            <div class="form-group">
              <input name="cpf" class="cpfMask" placeholder="CPF" type="text" id="inputCpf" required="" autocomplete="off">
            </div>
            <br />
            <div class="row">
              <div class="col-lg-6 col-xl-6 col-md-6">
                <button class="btn-enviar mx-auto" type="button" onclick="loginModalChange('login'); return false;"><i class="fas fa-angle-left"></i>&nbsp; Voltar</button>
              </div>
              <div class="col-lg-6 col-xl-6 col-md-6">
                <button class="btn-enviar mx-auto" type="submit">Recuperar senha &nbsp;<i class="fas fa-angle-right"></i></button>
              </div>
            </div>
          </form>

          <!-- PASSWORD RECOVERY SENT -->
          <div class="recovery-sent text-center d-none animated fadeIn" id="recoverySent">
            <div class="row text-center icon"><i class="fas fa-paper-plane"></i></div>
            <p>Uma mensagem para redefinição de senha foi enviada para <br> o seu endereço de e-mail cadastrado.</p>
            <p>Após recuperar sua senha volte à esse dispositivo e faça login.</p>
            <br>
            <div class="row mt-3 mb-3 text-center"><button class="btn-enviar mx-auto" onclick="loginModalChange('login'); return false;">Logar <i class="fas fa-angle-right"></i></button></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>