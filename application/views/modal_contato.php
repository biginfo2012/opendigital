<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal fade" id="contatoModal" tabindex="-1" role="dialog" aria-labelledby="contatoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center col-md-10 col-xs-12  mx-auto">
           <form class="form-signin" id="mainContato">
              <h1 class="h3 mb-3 font-weight-normal">Contato</h1>
              <div class="form-group">
                  <label for="inputNomeCtt">Nome*:</label>
                  <input name="nome" type="text" id="inputNomeCtt"  required>
              </div>
              <div class="form-group">
                  <label for="inputEmailCtt">Email*:</label>
                  <input name="email" type="email" id="inputEmailCtt"   required>
              </div>
              <div class="form-group">
                  <label for="inputTelefone">Telefone:</label>
                  <input name="telefone" type="text" id="inputTelefone"  >
              </div>
              <div class="form-group">
                  <label for="inputMensagem">Mensagem*:</label>
                  <textarea required style="resize: none;" name="msg" rows="3" id="inputMensagem" ></textarea>
              </div>
              <button class="btn-enviar" type="submit" name="inputMensagemCtt">Enviar</button>
              <!-- <p class="mt-5 mb-3 text-muted">© MINHA_REVISÃO 2018</p> -->
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
