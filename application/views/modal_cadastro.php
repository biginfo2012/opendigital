<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">  
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>     
      <div class="modal-body"> 
        <div class="text-center col-md-10 col-xs-12  mx-auto">
           <form class="form-signin" id="mainCadastro">
              <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
              <h1 class="h3 mb-3 font-weight-normal">Cadastro</h1>
            <!--   <label for="inputEmail" class="sr-only">Email</label> -->
              <input name="nome" type="text" id="inputNomeCad" class="form-control pt-3" placeholder="Nome"  autofocus="" required>
              <input name="user" type="text" id="inputEmailCad" class="form-control pt-3" placeholder="Email"  autofocus="" required>
            <!--   <label for="inputPassword" class="sr-only">Senha</label> -->
              <input name="senha" type="password" id="inputPasswordCad" class="form-control pt-3" placeholder="Senha"  required>
              <input name="confirm_senha" type="password" id="inputConfirmPassword" class="form-control pt-3" placeholder="Confirmar Senha"  required>
              <input name="telefone" type="text" id="inputTelefone" class="form-control pt-3 mb-3" placeholder="Telefone" >
              
              <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
              <p class="mt-5 mb-3 text-muted">© MINHA_REVISÃO 2018</p>
            </form>
        </div>
      </div>     
    </div>
  </div>
</div>