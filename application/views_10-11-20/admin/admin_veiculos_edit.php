<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Edição</title>

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

      <?php $this->load->view('nav_admin', array("tipo" => "veiculos")); ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2 mx-auto">Editar Veículo</h1>
        </div>
        <form id="form_veiculo_edit" class="mb-3">
          <div class="row">
            <input type="hidden" name="cod_modelo" value="<?= $variacoes[0]["cod_modelo"] ?>">
            <div class="col-md-4 col-4 mb-3">
              <label for="montadora">Montadora</label>
              <input type="text" class="form-control" name="montadora" id="montadora" placeholder="" required="" value="<?php echo $veiculo['montadora'] ?>">
            </div>
            <div class="col-md-4 col-4 mb-3">
              <label for="modelo">Modelo</label>
              <input type="text" class="form-control" name="modelo" id="modelo" placeholder="" required="" value="<?php echo $veiculo['modelo'] ?>">
            </div>
            <div class="col-md-4 col-4 mb-3">
              <button type="submit" class="btn btn-outline-success font-weight-bold position-absolute" style="bottom:0;">Alterar Veículo</button>
            </div>
          </div>
        </form>

        <div class="card">
          <div class="card-header border-bottom">
            <div class="row">
              <div class="col-6 text-left">
                <h6>Variações do veículo</h6>
              </div>
              <div class="col-6 text-right">
                <button type="button" class="btn btn-outline-info font-weight-bold" data-toggle="modal" data-target="#modalVariacao">Adicionar</button>
              </div>
            </div>
          </div>
          <div class="card-body p-0 pb-3">
            <div class="table-responsive">
              <table class="table" id="variacoesTable">
                <thead class="bg-light">
                  <tr class="text-center">
                    <th scope="col" class="text-center">Variação</th>
                    <th scope="col" class="text-center">Serviço Básico</th>
                    <th scope="col" class="text-center">Serviço Intermediário</th>
                    <th scope="col" class="text-center">Serviço Premium</th>
                    <th scope="col" class="text-left">Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($variacoes as $variacao) { ?>
                    <?php if (isset($variacao["servicos"][0]['preco'])) { ?>
                      <tr>
                        <input type="hidden" name="cod_modelo" value="<?= $variacao["cod_modelo"] ?>">
                        <td class="text-center"><?= $variacao["motor"] ?></td>
                        <td class="text-center">R$ <?= number_format($variacao["servicos"][0]['preco'] / 100, 2, ',', '') ?></td>
                        <td class="text-center">R$ <?= number_format($variacao["servicos"][1]['preco'] / 100, 2, ',', '') ?></td>
                        <td class="text-center">R$ <?= number_format($variacao["servicos"][2]['preco'] / 100, 2, ',', '') ?></td>
                        <td class="text-left">
                          <div class="custom-control custom-toggle custom-toggle-sm mx-auto">
                            <input type="checkbox" id="custom_<?= $variacao['cod_modelo'] ?>" name="custom_<?= $variacao['cod_modelo'] ?>" class="custom-control-input" <?= $variacao["customizado"] == 0 ? "checked='checked'" : null ?>>
                            <label class="custom-control-label"></label>
                          </div>
                        </td>
                        <td><a onclick="getVariacao(<?= $variacao['cod_modelo'] ?>); return false;">Editar</a></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small copryght">
    <p class="mb-1">&copy; 2017-<?php echo date('Y'); ?> Minha Revisão</p>
  </footer>

</body>


<!-- Insert Modal -->
<div class="modal fade" id="modalVariacao" tabindex="-1" role="dialog" aria-labelledby="variacaoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar variação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>
          <b><?= $veiculo['montadora'] ?> <?= $veiculo['modelo'] ?></b>
        </h6>
        <form id="insertVariacao">
          <input type="hidden" name="montadora" value="<?= $veiculo['montadora'] ?>">
          <input type="hidden" name="modelo" value="<?= $veiculo['modelo'] ?>">
          <div class="row mb-3">
            <div class="col-12">
              <label for="variação">Variação</label>
              <input type="text" class="form-control" name="variacao" id="variacao" placeholder="" required="">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-4">
              <label for="basico">Preço Básico</label>
              <input type="number" class="form-control" name="basico" id="basico" placeholder="" required="">
            </div>
            <div class="col-4">
              <label for="inter">Preço Intermediário</label>
              <input type="number" class="form-control" name="inter" id="inter" placeholder="" required="">
            </div>
            <div class="col-4">
              <label for="premium">Preço Premium</label>
              <input type="number" class="form-control" name="premium" id="premium" placeholder="" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label>Status</label>
              <div class="custom-control custom-toggle custom-toggle-sm">
                <input type="checkbox" id="custom" name="custom" class="custom-control-input">
                <label class="custom-control-label" for="custom"></label>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="modalUpdateVariacao" tabindex="-1" role="dialog" aria-labelledby="variacaoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar variação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>
          <b><?= $veiculo['montadora'] ?> <?= $veiculo['modelo'] ?></b>
        </h6>
        <form id="updateVariacao">
          <input type="hidden" name="montadora" value="<?= $veiculo['montadora'] ?>">
          <input type="hidden" name="modelo" value="<?= $veiculo['modelo'] ?>">
          <div class="row mb-3">
            <div class="col-12">
              <label for="variação">Variação</label>
              <input type="hidden" name="cod_variacao" id="cod_variacao">
              <input type="text" class="form-control" name="variacao" id="variacao" placeholder="" required="">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-4">
              <label for="basico">Preço Básico</label>
              <input type="hidden" name="cod_basico" id="cod_basico" placeholder="" required="">
              <input type="number" class="form-control" name="basico" id="basico" placeholder="" required="">
            </div>
            <div class="col-4">
              <label for="inter">Preço Intermediário</label>
              <input type="hidden" name="cod_inter" id="cod_inter" placeholder="" required="">
              <input type="number" class="form-control" name="inter" id="inter" placeholder="" required="">
            </div>
            <div class="col-4">
              <label for="premium">Preço Premium</label>
              <input type="hidden" name="cod_premium" id="cod_premium" placeholder="" required="">
              <input type="number" class="form-control" name="premium" id="premium" placeholder="" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label>Status</label>
              <div class="custom-control custom-toggle custom-toggle-sm">
                <input type="checkbox" id="custom_update" name="custom" class="custom-control-input">
                <label class="custom-control-label" for="custom_update"></label>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
      </div>
      </form>
    </div>
  </div>
</div>


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


<div class="modal fade" id="successModal" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center col-md-10 mx-auto">
          <h5 class="col-12 text-center mensagem-sucesso">Mensagem de retorno</h5>
        </div>
      </div>
    </div>
  </div>
</div>

</html>