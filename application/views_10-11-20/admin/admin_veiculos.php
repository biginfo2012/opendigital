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
        <?php $this->load->view('nav_admin', array("tipo" => "veiculos")); ?>
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
            <h1 class="h2 mx-auto">Veículos</h1>
  
          </div>
          <button class="btn btn-outline-info font-weight-bold float-right" data-toggle="modal" data-target="#modalVeiculo"> Cadastrar</button>
          <div class="table-responsive ">
            <table class="table">
              <br>
              <thead>
                <tr>
                  <th>Montadora</th>
                  <th>Modelo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lista_veiculos as $veiculo) { ?>
                  <tr>
                    <td><?= $veiculo["montadora"] ?></td>
                    <td><?= $veiculo["modelo"] ?></td>
                    <td class="text-center">
                      <a href="<?php echo base_url() . 'admin/editarVeiculo/' . $veiculo['cod_modelo']; ?>">
                        <i class="material-icons">edit</i>
                      </a>
                    </td>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          <div>
            <div aria-label="Page navigation example">
              <ul class="pagination justify-content-center col-md-10">
                <?php for ($x = 0; $x < (int) ceil($count / 20); $x++) : ?>
                  <li class="page-item <?php echo $x == $offset ? "active" : "" ?>"><a class="page-link" href="<?php echo base_url("admin/veiculos/$x"); ?>"><?php echo $x + 1; ?></a></li>
                <?php endfor; ?>
              </ul>
            </div>
          </div>
        </main>
  
        <!-- Insert Modal -->
        <div class="modal fade" id="modalVeiculo" tabindex="-1" role="dialog" aria-labelledby="veiculoModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar veículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="insertVeiculo">
                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="variação">Montadora</label>
                      <input type="text" class="form-control" name="montadora" id="montadora" placeholder="" required="">
                    </div>
                    <div class="col-6">
                      <label for="variação">Modelo</label>
                      <input type="text" class="form-control" name="modelo" id="modelo" placeholder="" required="">
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

</body>

</html>