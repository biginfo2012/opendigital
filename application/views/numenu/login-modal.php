<div class="modal fade bd-example-modal-lg" id="loginModal" role="document" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-window-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center col-md-12 col-xl-12 col-lg-12 col-sm-12 mx-auto">
          <!-- LOGIN -->
          <form class="form-signin animated fadeIn" id="mainLogin">
            <div class="row text-center icon"><i class="fas fa-user-circle"></i></div>
            <div style="color:red; display:none;" id="loginException">*É necessário realizar o login para continuar.</div>
            <div class="alert alert-danger col-md-12 col-xl-12 col-lg-12 col-sm-12 mx-auto mensagem-erro d-none" role="alert">
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
              <div class="col-6 text-right"><button class="btn-enviar" type="submit">Logar <i class="fas fa-angle-right"></i></button></div>
            </div>
            <br>
            <div class="row mt-3 mb-3 text-center cadastrar">
              <a  href="<?= base_url('numenu/cadastro') ?>">
                <div class="btn-enviar mx-auto">
                  <span> novo cadastro</span> 
                  <i class="fas fa-angle-right"></i>
                </div>
              </a>
            </div>
          </form>

          <!-- PASSWORD RECOVER -->
          <form class="form-recover d-none animated fadeIn" id="mainRecover">
            <div class="row text-center icon"><i class="fas fa-user-circle"></i></div>

            <div class="form-group">
              <input name="cpf" class="cpfMask" placeholder="CPF" type="text" id="inputCpf" required="" autocomplete="off">
            </div>
            <br>
            <div class="row mt-3 mb-3 text-center"><button class="btn-enviar mx-auto" type="submit">Recuperar senha <i class="fas fa-angle-right"></i></button></div>
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