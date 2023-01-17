<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view(header);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Index</title>	

	<?php $this->load->view('assetsinclude'); ?>

  <style> 
  body {
  font-size: .875rem;
}

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

/*
 * Sidebar
 */

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 0;
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar-sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 48px; /* Height of navbar */
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.navbar{
  z-index: 999;
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

/*
 * Navbar
 */

.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .form-control {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, .1);
  border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}

/*
 * Utilities
 */

.border-top { border-top: 1px solid #e5e5e5; }
.border-bottom { border-bottom: 1px solid #e5e5e5; }

   </style>
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

       <?php $this->load->view('nav_admin',array("tipo"=>"pedidos")); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2 mx-auto">Pedidos</h1>
            
          </div>         
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <?php $url = base_url("admin/exportPedidos") ?>
              <button onclick="window.open('<?php echo $url ?>')" class="float-right btn btn-outline-success">Exportar</button>
              <br>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Data</th>
                  <th>Período</th>
                  <th>Voucher</th>
                  <th>Pagamento</th>
                  <th>Usuário</th>
                  <th>Lojista</th>
                  <th>Serviço</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach ($lista_pedidos as $pedido) {?>
                <tr>
                  <td><?php echo $pedido["cod_agenda"]; ?></td>
                  <td><?php echo $pedido["data"]; ?></td>
                  <td><?php echo $pedido["periodo"] == 1 ? "matutino" : "vespertino";; ?></td>
                  <td><?php echo $pedido["voucher"]; ?></td>
                  <td><?php echo $pedido["moip_order_id"]; ?></td>
                  <td><?php echo $pedido["nome_usuario"]; ?></td>
                  <td><?php echo $pedido["nome_responsavel"]; ?></td>
                  <td><?php echo $pedido["nome_servicos"]; ?></td>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div>
            <div aria-label="Page navigation example">
              <ul class="pagination justify-content-center col-md-10">
              <?php for($x = 0; $x<(int)ceil($count/10); $x++): ?>
                <li class="page-item <?php echo $x==$offset?"active":"" ?>"><a class="page-link" href="<?php  echo base_url("admin/pedidos/$x"); ?>"><?php echo $x+1; ?></a></li>
              <?php endfor; ?>
              </ul>
            </div>
          </div>
        </main>
      </div>
    </div>
	



      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017-2018 Minha Revisão</p>
        
      </footer>



  

   


</body>

	
</html>
<?php
//$this->load->view(header);
?>