<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Index</title>

  <?php $this->load->view('admin/admin_assetsinclude'); ?>
</head>

<body class="bg-light">

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Minha Revisão</a>

    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#" onclick="LogoutAdmin();return false;">Logout</a>
      </li>
    </ul>
  </nav>
  <br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-6 mx-auto">
        <?php $this->load->view('nav_admin', array("tipo" => "regioes")); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
          </div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2 mx-auto">Regiões</h1>
  
          </div>
          <button class="btn btn-outline-info font-weight-bold float-right" onclick="insertRegion()"> Cadastrar</button>
          <div class="table-responsive ">
            <table class="table">
              <br>
              <thead>
                <tr>
                  <th>Região</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($regioes_list as $regiao) { ?>
                  <tr>
                    <td class="pt-3"><?= $regiao["regiao"] ?></td>
                    <td class="pt-3"><?= $regiao["status"]==1?'ativado':'desativado' ?></td>
                    <td class="text-center">
                      <?php if($regiao["status"]==1){ ?>
                        <button class="btn btn-primary p-1" onclick="updateRegion(<?= $regiao['cod_regiao'] ?>, '<?= $regiao['regiao'] ?>')">Editar</button>
                        <button class="btn btn-danger p-1 text-white" onclick="disableRegion(<?= $regiao['cod_regiao'] ?>)">Desativar</a>
                      <?php }else{ ?> 
                        <button class="btn btn-success p-1" onclick="enableRegion(<?= $regiao['cod_regiao'] ?>)">Ativar</button>
                      <?php } ?>
                    </td>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </main>
  
        <!-- Insert Modal -->
        <div class="modal fade" id="modalRegiao" tabindex="-1" role="dialog" aria-labelledby="veiculoModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Região</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="formRegiao">
                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="variação">Regiao</label>
                      <input type="hidden" class="form-control" name="cod_regiao" id="cod_regiao">
                      <input type="text" class="form-control" name="regiao" id="regiao" placeholder="" required="">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Adicionar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Error Modal -->
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
                  <h5 class="col-12 text-center mensagem-erro">Descrição do Erro</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small copryght">
  <p class="mb-1">&copy; 2017-<?php echo date('Y'); ?> Minha Revisão</p>

  </footer>

  <script>
    $(document).ready(function() {
      $("#formRegiao").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'admin/insertEditRegiao',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'json',
            error: function() {
                errorMessage("Não foi possível contatar o servidor");
            },
            success: function(data) {
              if(data.success){
                location.reload();
              }else{
                errorMessage("Não foi possível inserir");
              }
            }
        }); //Ajax
      });
    });
    function insertRegion(){
      $('#modalRegiao form').attr("id", "insertRegiao");
      $('#modalRegiao .btn').html("Adicionar");
      $('#modalRegiao #cod_regiao').val(null);
      $('#modalRegiao #regiao').val(null);
      $('#modalRegiao').modal('show');
    }
    function updateRegion(cod_region, region){
      $('#modalRegiao form').attr("id", "updateRegiao");
      $('#modalRegiao .btn').html("Editar");
      $('#modalRegiao #cod_regiao').val(cod_region);
      $('#modalRegiao #regiao').val(region);
      $('#modalRegiao').modal('show');
    }
    function disableRegion(id_region){
      $.ajax({
        type: 'GET',
        url: baseurl + 'admin/disableRegiao/'+id_region,
        cache: false,
        headers: { "cache-control": "no-cache" },
        data: $(this).serialize(), // it will serialize the form data
        dataType: 'json',
        error: function() {
            errorMessage("Não foi possível contatar o servidor");
        },
        success: function(data) {
          if(data.success){
            location.reload();
          }else{
            errorMessage("Não foi possível Desabilitar");
          }
        }
      });
    }
    function enableRegion(id_region){
      $.ajax({
        type: 'GET',
        url: baseurl + 'admin/enableRegiao/'+id_region,
        cache: false,
        headers: { "cache-control": "no-cache" },
        data: $(this).serialize(), // it will serialize the form data
        dataType: 'json',
        error: function() {
            errorMessage("Não foi possível contatar o servidor");
        },
        success: function(data) {
          if(data.success){
            location.reload();
          }else{
            errorMessage("Não foi possível Hbilitar");
          }
        }
      });
    }
  </script>

</body>

</html>