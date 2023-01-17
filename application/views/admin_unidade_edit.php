<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view(header);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Edição</title>

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

       <?php $this->load->view('nav_admin',array("tipo"=>"unidades")); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2 mx-auto">Editar Unidade</h1>

          </div>




          <form id="form_unidade_edit">
            <div class="alert alert-danger col-md-4 mx-auto mensagem-erro d-none" role="alert">
              Erro
            </div>
            <div class="col-md-8 mx-auto">
              <!-- <div class="row">
                    <div class="col-md-12 col-12 mb-3">
                      <label for="cc-name">Propriedade 1</label>
                      <input type="text" class="form-control" id="pag-cc-name" placeholder="" required="">
                      <small class="text-muted">Nome completo como descrito no cartão</small>
                      <div class="invalid-feedback">
                        Nome
                      </div>
                    </div>
   -->
                   <!--  <div class="col-md-6 col-6 mb-3">
                      <label for="cc-number">CPF</label>
                      <input type="text" class="form-control" id="pag-cpf" placeholder="" required="">
                      <div class="invalid-feedback">
                        Credit card number is required
                      </div>
                    </div>  -->
                <!-- </div> -->

              <div class="row">
                <div class="col-md-12 col-6 mb-3">
                    <label for="nome-unidade">Nome Unidade</label>
                    <input type="text" class="form-control" name="nome_unidade" id="nome-unidade" placeholder="" required="" value="<?php echo $nome_unidade?>">
                    <div class="invalid-feedback">
                        Nome da unidade
                    </div>
                </div>
                <div class="col-md-6 col-6 mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="" required="" value="<?php echo $email_contato?>">
                  <div class="invalid-feedback">
                    >Email
                  </div>
                </div>
                <div class="col-md-6 col-6 mb-3">
                  <label for="limite">Limite por período</label>
                  <input type="limite" class="form-control" name="limite" id="limite" placeholder="" required="" value="<?php echo $limite_periodo?>">
                  <div class="invalid-feedback">
                    >Limite
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-md-6 col-6 mb-3">
                      <label for="telefone">Telefone </label>
                      <input type="text" class="form-control" id="telefone" name="telefone" placeholder="" required="" value="<?php echo $telefone?>">
                      <div class="invalid-feedback">
                          Telefone para contato
                      </div>
                  </div>
                <div class="col-md-6 col-6 mb-3">
                  <label for="nome-responsavel">Responsável</label>
                  <input type="text" class="form-control" id="nome-responsavel" name="nome_responsavel" placeholder="" required="" value="<?php echo $nome_responsavel?>">
                  <div class="invalid-feedback">
                      Nome do responsável
                  </div>
                </div>

              </div>

             <!-- <div class="row">
                <div class="col-md-12 col-12 mb-3">

                </div>
              </div> -->

              <div class="row">
                  <div class="col-md-12 col-6 mb-3">
                      <label for="endereco">Endereço </label>
                      <input type="text" class="form-control" id="endereco" name="endereco" placeholder="" required="" value="<?php echo $endereco?>">
                      <div class="invalid-feedback">
                          Endereco
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-6 mb-3 text-center">
                    <select class="custom-select w-100" id="horario" name="horario" required>
                        <option <?php echo empty($horario)?"selected":"";?> value="" selected>HORÁRIO</option>
                        <option  <?php echo $horario == 1?"selected":"";?>  value="1">Matutino</option>
                        <option  <?php echo $horario == 2?"selected":"";?>  value="2">Vespertino</option>
                        <option  <?php echo $horario == 3?"selected":"";?>  value="3">Matutino + Vespertino</option>
                    </select>
                </div>

                <div class="col-md-6 col-6 mb-3 text-center">
                  <select class="custom-select w-100" id="regiao" name="regiao" required>
                    <option <?php echo empty($regiao)?"selected":"";?> value="">REGIÃO</option>
                    <option  <?php echo $regiao == 1?"selected":"";?>  value="1">São Paulo - Norte</option>
                    <option  <?php echo $regiao == 2?"selected":"";?>  value="2">São Pauol - Sul</option>
                    <option  <?php echo $regiao == 3?"selected":"";?>  value="3">São Paulo - Leste</option>
                    <option  <?php echo $regiao == 4?"selected":"";?>  value="4">São Paulo - Oeste</option>
                    <option  <?php echo $regiao == 5?"selected":"";?>  value="5">São Paulo - Centro</option>
                    <option  <?php echo $regiao == 6?"selected":"";?>  value="6">Santo André</option>
                    <option  <?php echo $regiao == 7?"selected":"";?>  value="7">São Bernardo</option>
                    <option  <?php echo $regiao == 8?"selected":"";?>  value="8">São Caetano</option>
                    <option  <?php echo $regiao == 9?"selected":"";?>  value="9">Diadema</option>
                    <option  <?php echo $regiao == 10?"selected":"";?> value="10">Mauá</option>
                    <option  <?php echo $regiao == 11?"selected":"";?> value="11">Piracicaba</option>
                    <option  <?php echo $regiao == 12?"selected":"";?> value="12">Guarulhos</option>
                    <option  <?php echo $regiao == 13?"selected":"";?> value="13">Osasco</option>
                    <option  <?php echo $regiao == 14?"selected":"";?> value="14">Barueri</option>
                    <option  <?php echo $regiao == 15?"selected":"";?> value="15">Rio de Janeiro</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-6 mb-3 text-left">
                    <label class="form-check-label" for="endereco">Atendimento no sábado:</label>
                    <input type="checkbox" <?php echo $atendimento_sabado==1?"Checked":"" ?> style="margin-left: 10px;" class="form-check-input" id="fds" name="atendimento_sabado" placeholder="">
                </div>
              </div>

              <hr>





              <input type="hidden" value="<?php echo $cod_lojista ?>" name="cod_lojista">
              <div class="row">
                <button class="btn btn-lg btn-primary mx-auto" type="submit" return "false;"> Editar</button>
              </div>
           </div>
          </form>

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
