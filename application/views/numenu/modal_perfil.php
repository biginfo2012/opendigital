<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>




<div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="perfilModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center col-md-12 mx-auto">
          <form class="form-signin" id="mainPerfil">
            <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-address-book"></i> Perfil</h1>
            <div class="row">
              <div class="col-12" style="padding:0;">
                <div class="content">
                  <div class="field text-left">
                    <div class="text">
                      <img src="<?php echo base_url("assets/img/icn_user.png") ?>" alt="">
                      <span id="NomeEditContent"><?php echo $this->session->nome ?></span>
                    </div>
                  </div>
                  <div class="field text-left">
                    <div class="text">
                      <img src="<?php echo base_url("assets/img/icn_mail.png") ?>" alt="">
                      <span id="EmailEditContent"><?php echo $this->session->email ?></span>
                    </div>
                  </div>
                  <div class="field text-left">
                    <div class="text">
                      <img src="<?php echo base_url("assets/img/icn_phone.png") ?>" alt="">
                      <span id="TelefoneEditContent"><?php echo $this->session->telefone ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12" style="padding:0;">
                <div class="row">
                  <div class="col-6">
                    <button href="#" onclick="Pedido(); return false;" class="btn-pedidos" type="button">
                      <i class="fas fa-list"></i> <span>Pedidos</span></button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 text-center">
                    <a href="<?php echo base_url('login/editPage') ?>">
                      <div id="btnPermitirEditarPerfil" class="btn-editar col-12"><i class="fas fa-edit"></i> <span>Editar</span> </div>
                    </a>
                  </div>
                  <div class="col-6 text-center">
                    <button id="btnLogout" onclick="Logout();return false;" class="btn-logout" type="button"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="col-md-6 col-xs-12 mx-auto">
                <img style="display:none;"  class="inputEdit img-fluid profile-pic"   src="<?php echo base_url('assets/img/prof.jpg') ?>" alt="profile pick" />
              </div> -->

            <!-- <input style="display:none;" class="inputEdit form-control-file" type='file' id="imgInp" /> -->

            <!-- <input style="display:none;" name="nome" type="text" id="inputNomeEdit" class="form-control inputEdit pt-3" placeholder=" Nome"  autofocus="" value="<?php echo $this->session->nome ?>"> -->

            <!-- <input style="display:none;" name="email" type="text" id="inputEmailEdit" class="form-control inputEdit pt-3" placeholder=" Email"  autofocus="" value="<?php echo $this->session->email ?>">
              <input style="display:none;" name="senha" type="text" id="inputSenhaEdit" class="form-control inputEdit pt-3" placeholder="Alterar Senha"  autofocus="">
              <input style="display:none;" name="confirm_senha" type="text" id="inputConfirmSenhaEdit" class="form-control inputEdit pt-3" placeholder="Confirmar alterar Senha" autofocus=""> -->

            <!-- <input style="display:none;" name="telefone" type="text" id="inputTelefoneEdit" class="form-control inputEdit pt-3 mb-3" placeholder=" Telefone"  autofocus="" value="<?php echo $this->session->telefone ?>"> -->
            <br>

            <!-- <p class="mt-5 mb-3 text-muted">© MINHA_REVISÃO 2018</p> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>