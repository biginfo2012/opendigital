<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Admin</title>

  <?php $this->load->view('admin/admin_assetsinclude'); ?>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

      <?php $this->load->view('nav_admin', array("tipo" => "unidades")); ?>

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
          <h1 class="h2 mx-auto">Unidades</h1>

        </div>

        <div class="text-right">
          <a class="btn btn-lg btn-primary" href="<?php echo base_url('admin/unidade_cad') ?>"> Cadastrar</a>
        </div>
        <br />

        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>Unidade</th>
                <th>Responsável</th>
                <!--  <th>Telefone</th> -->
                <th>Email</th>
                <th class="text-center">Vincular</th>
                <th class="text-center">Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lista_unidades as $unidade) { ?>
                <tr>
                  <td><?php echo $unidade['cod_lojista'] ?></td>
                  <td><?php echo $unidade['nome_unidade'] ?></td>
                  <td><?php echo $unidade['nome_responsavel'] ?></td>
                  <!-- <td><?php echo $unidade['telefone'] ?></td> -->
                  <td><?php echo $unidade['email_contato'] ?></td>
                  <td class="text-center">
                    <?php if (empty($unidade['moip_id'])) : ?>
                      <a href="<?php echo $unidade['link_vincular'] ?>" target="_blank">
                        <i class="material-icons">redo</i>
                      </a>
                    <?php endif; ?>
                  </td>
                  <td class="text-center">
                    <a href="<?php echo base_url() . 'admin/EditarUnidade/' . $unidade['cod_lojista']; ?>">
                      <i class="material-icons">edit</i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div>
          <div aria-label="Page navigation example">
            <ul class="pagination justify-content-center col-md-10">
              <?php for ($x = 0; $x < (int) ceil($count / 10); $x++) : ?>
                <li class="page-item <?php echo $x == $offset ? "active" : "" ?>"><a class="page-link" href="<?php echo base_url("admin/index/$x"); ?>"><?php echo $x + 1; ?></a></li>
              <?php endfor; ?>
            </ul>
          </div>
        </div>
      </main>
    </div>
  </div>




  <footer class="my-5 pt-5 text-muted text-center text-small copryght">
    <p class="mb-1">&copy; 2017-<?php echo date('Y'); ?> Minha Revisão</p>

  </footer>








</body>


</html>
<?php
//$this->load->view(header);
?>