<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <div class="text-center col-md-10 mx-auto">
           <form class="form-signin" id="mainPerfil">
              <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
              <h1 class="h3 mb-3 font-weight-normal">Perfil</h1>
             <!--  <div class="row">
                <label  >Email</label>
              </div> -->
              <div class="row align-items-center h-100">

                <div class="col-md-6 col-xs-12 labelEdit">
                  <img class="img-fluid profile-pic" src="<?php echo base_url('assets/img/prof.jpg')?>">
                </div>

                <div class="col-md-6 col-xs-12 text-left">

                  <div class="">
                    <label class="labelEdit">Nome: </label> <label  class="labelEdit" id="NomeEditContent"><?php echo $this->session->nome?></label>
                  </div> 

                  <div class="">
                    <label class="labelEdit">Email: </label> <label  class="labelEdit" id="EmailEditContent"><?php echo $this->session->email?></label>
                  </div>     

                  <div class="">             
                    <label class="labelEdit">Telefone: </label> <label  class="labelEdit" id="TelefoneEditContent"><?php echo $this->session->telefone?></label>
                  </div>   

                </div>   
              </div>

              <div class="col-md-6 col-xs-12 mx-auto">
                <img style="display:none;"  class="inputEdit img-fluid profile-pic"   src="<?php echo base_url('assets/img/prof.jpg')?>" alt="profile pick" />
              </div>
   
                <input style="display:none;" class="inputEdit form-control-file" type='file' id="imgInp" />

         

              <input style="display:none;" name="nome" type="text" id="inputNomeEdit" class="form-control inputEdit pt-3" placeholder=" Nome"  autofocus="" value="<?php echo $this->session->nome?>">
                        
              <input style="display:none;" name="email" type="text" id="inputEmailEdit" class="form-control inputEdit pt-3" placeholder=" Email"  autofocus="" value="<?php echo $this->session->email?>">                           
              <input style="display:none;" name="senha" type="text" id="inputSenhaEdit" class="form-control inputEdit pt-3" placeholder="Alterar Senha"  autofocus="">
              <input style="display:none;" name="confirm_senha" type="text" id="inputConfirmSenhaEdit" class="form-control inputEdit pt-3" placeholder="Confirmar alterar Senha" autofocus="">
                         
              <input style="display:none;" name="telefone" type="text" id="inputTelefoneEdit" class="form-control inputEdit pt-3 mb-3" placeholder=" Telefone"  autofocus="" value="<?php echo $this->session->telefone?>">
              
              <div class="row">
                <button id="btnPermitirEditarPerfil"   onclick="Editar();return false;"  class="btn btn-lg btn-primary btn-block btn-block-half" type="button">Editar</button>
                <button id="btnSalvarPerfil" style="display:none;" class="btn btn-lg btn-primary btn-block btn-block-half" type="submit">Salvar</button>
                <button id="btnLogout"  onclick="Logout();return false;"  class="btn btn-lg btn-danger btn-block btn-block-half" type="button">Logout</button>
              </div>
              <p class="mt-5 mb-3 text-muted">© MINHA_REVISÃO 2018</p>
            </form>
        </div>
      </div>     
    </div>
  </div>
</div>