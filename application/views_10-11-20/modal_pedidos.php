<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>




<div class="modal fade" id="pedidosModal" tabindex="-1" role="dialog" aria-labelledby="pedidosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <!-- icone colocado com font awesome dia 23/08/19 Iago k. -->
          <h1 class="h3 mb-3 font-weight-normal text-center"><i class="fas fa-list-alt"></i>Pedidos</h1>
          <br>

          <div class="pedidosList" >
            <div id="listaPedidos">

            </div>
            <div class="pagination text-center">
              <ul class="text-center">
                
              </ul>
            </div>
          </div>

          <div id="pedido" class="animated fadeIn">
            <div class="row text-center">
              <div class="col-12 id h4"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-12 ">
                <div class="title">Unidade:</div><div class="text unidade"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="title">Endereço:</div><div class="text endereco"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="title">Data:</div><div class="text data"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 ">
                <div class="title">Modelo:</div><div class="text modelo"></div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12">
                <div class="title">Serviço:</div> <div class="text servico"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 ">
                <div class="title">Preço:</div> <div class="text preco"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 ">
                <div class="title">Voucher:</div> <div class="text voucher"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 ">
                <div class="title">Status:</div> <div class="text status"></div>
              </div>
            </div>
            <br>
            <div class="row text-center">
              <div class="col-12 ">
                <a href="#" onclick="voltarListaPedidos(); return false;"> Voltar</a>
              </div>
            </div>
          </div>

        </div>
    </div>

        </div>
    </div>
  </div>
</div>

    <!-- Modal -->
     <div class="modal fade" id="pleaseWaitDialog" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header mx-auto">
                    <h3 class="loading">CARREGANDO</h3>
                </div>
                <br>
                <br>
                <div class="modal-body text-center loading-body">
                     <div id="loader" style="display:block; position:relative; z-index:1;"></div>
                </div>
            </div>
       <!-- /Modal content-->
        </div>
    </div>
    <!-- Modal -->
