<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view(header);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Cadastro</title>

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
            <h1 class="h2 mx-auto">Cadastro Unidade</h1>

          </div>




          <form id="form_unidade_cad" novalidate>
            <div class="alert alert-danger col-md-4 mx-auto mensagem-erro d-none" role="alert">
              Erro
            </div>
            <div class="col-md-8 mx-auto">
              <div class="row">
                <div class="col-md-12 col-6 mb-3">
                    <label for="nome-unidade">Nome Unidade</label>
                    <input type="text" class="form-control" name="nome_unidade" id="nome-unidade" placeholder="" required="">
                    <div class="invalid-feedback">
                        Nome da unidade
                    </div>
                </div>
                <div class="col-md-6 col-6 mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="" required="">
                  <div class="invalid-feedback">
                    >Email
                  </div>
                </div>
                 <div class="col-md-6 col-6 mb-3">
                  <label for="limite">Limite por período</label>
                  <input type="limite" class="form-control" name="limite" id="limite" placeholder="" required="">
                  <div class="invalid-feedback">
                    >Limite
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-md-6 col-6 mb-3">
                      <label for="telefone">Telefone </label>
                      <input type="text" class="form-control" id="telefone" name="telefone" placeholder="" required="">
                      <div class="invalid-feedback">
                          Telefone para contato
                      </div>
                  </div>
                <div class="col-md-6 col-6 mb-3">
                  <label for="nome-responsavel">Responsável</label>
                  <input type="text" class="form-control" id="nome-responsavel" name="nome_responsavel" placeholder="" required="">
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
                      <input type="text" class="form-control" id="endereco" name="endereco" placeholder="" required="">
                      <div class="invalid-feedback">
                          Endereco
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-6 mb-3 text-center">
                    <select class="custom-select w-100" id="horario" name="horario" required>
                        <option value="" selected>HORÁRIO</option>
                        <option value="1">Matutino</option>
                        <option value="2">Vespertino</option>
                        <option value="3">Matutino + Vespertino</option>
                    </select>
                </div>

                <div class="col-md-6 col-6 mb-3 text-center">
                  <select class="custom-select w-100" id="regiao" name="regiao" required>
                    <option value="" selected>REGIÃO</option>
                    <option value="1">São Paulo - Norte</option>
                    <option value="2">São Paulo - Sul</option>
                    <option value="3">São Paulo - Leste</option>
                    <option value="4">São Paulo - Oeste</option>
                    <option value="5">São Paulo - Centro</option>
                    <option value="6">Santo André</option>
                    <option value="7">São Bernardo</option>
                    <option value="8">São Caetano</option>
                    <option value="9">Diadema</option>
                    <option value="10">Mauá</option>
                    <option value="11">Piracicaba</option>
                    <option value="12">Guarulhos</option>
                    <option value="13">Osasco</option>
                    <option value="14">Barueri</option>
                    <option value="15">Rio de Janeiro</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-6 mb-3 text-left">
                    <label class="form-check-label" for="endereco">Atendimento no sábado:</label>
                    <input type="checkbox" style="margin-left: 10px;" class="form-check-input" id="fds" name="atendimento_sabado" placeholder="" >
                </div>
              </div>

              <div class="form-check text-center">
                <input class="form-check-input" name="criarContaMoip" type="checkbox" value="1" id="contaMoipCheck">
                <label class="form-check-label" for="contaMoipCheck">
                  Criar conta moip
                </label>
              </div>

              <hr>


              <div class="contaMoipContainer">

                <br><br>
                <h3 class="text-center">Moip</h3>
                <br>
                <h5 class="text-center">Responsável</h5>
                <br><br>

                <div class="row">
                  <div class="col-md-6 col-6 mb-3">
                    <label for="nome-moip">Nome</label>
                    <input type="text" class="form-control" id="nome-moip" name="nomeM" placeholder="" required>
                    <div class="invalid-feedback">
                      Nome Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="sobrenome-moip">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome-moip" name="sobrenomeM" placeholder="" required>
                    <div class="invalid-feedback">
                      Sobrenome Moip
                    </div>
                  </div>

                  <div class="col-md-12 col-6 mb-3">
                    <label for="email-moip">Email</label>
                    <input type="email" class="form-control" id="email-moip" name="emailM" placeholder="" required>
                    <div class="invalid-feedback">
                      Email Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="cpf-moip">CPF</label>
                    <input type="text" class="form-control" id="cpf-moip" name="cpfM" placeholder="" required="">
                    <div class="invalid-feedback">
                      CPF Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="nascimento-moip"> Data de nascimento </label>
                    <input type="text" class="form-control" id="nascimento-moip" name="nascimentoM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Nascimento Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="telefone-moip">Telefone</label>
                    <input type="text" class="form-control" id="telefone-moip" name="telefoneM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Telefone Moip
                    </div>
                  </div>

                  <div class="col-md-12 col-6 mb-3">
                    <label for="logradouro-moip"> Logradouro </label>
                    <input type="text" class="form-control" id="logradouro-moip" name="logradouroM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Logradouro Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="numero-moip"> Número </label>
                    <input type="text" class="form-control" id="numero-moip" name="numeroM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Número Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="bairro-moip"> Bairro </label>
                    <input type="text" class="form-control" id="bairro-moip" name="bairroM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Bairro Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="cep-moip"> CEP </label>
                    <input type="text" class="form-control" id="cep-moip" name="cepM" placeholder="" required="">
                    <div class="invalid-feedback">
                          CEP Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="cidade"> Cidade </label>
                    <input type="text" class="form-control" id="cidade" name="cidadeM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Cidade Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="estado-moip"> Estado </label>
                    <input type="text" class="form-control" id="estado-moip" name="estadoM" placeholder="" required="">
                    <div class="invalid-feedback">
                        Estado Moip
                    </div>
                  </div>
                </div>

                <hr>
                <br>
                <h5 class="text-center">Empresa</h5>
                <br><br>
                <div class="row">
                  <div class="col-md-12 col-6 mb-3">
                    <label for="nome-empresa-moip"> Nome da empresa  </label>
                    <input type="text" class="form-control" id="nome-empresa-moip" name="nome_empresaM" placeholder="" required="">
                    <div class="invalid-feedback">
                         Nome da empresa Moip
                    </div>
                  </div>

                  <div class="col-md-12 col-6 mb-3">
                    <label for="razao-moip"> Razão social </label>
                    <input type="text" class="form-control" id="razao-moip" name="razaoM" placeholder="" required="">
                    <div class="invalid-feedback">

                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="cnpj-moip"> CNPJ </label>
                    <input type="text" class="form-control" id="cnpj-moip" name="cnpjM" placeholder="" required="">
                    <div class="invalid-feedback">
                          CNPJ Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="telefone-empresa-moip"> Telefone da empresa </label>
                    <input type="text" class="form-control" id="telefone-empresa-moip" name="telefone_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Telefone empresa Moip
                    </div>
                  </div>

                  <div class="col-md-12 col-6 mb-3">
                    <label for="logradouro-empresa-moip"> Logardouro  </label>
                    <input type="text" class="form-control" id="logradouro-empresa-moip" name="logradouro_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Logradouro empresa Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="numero-empresa-moip"> Número </label>
                    <input type="text" class="form-control" id="numero-empresa-moip" name="numero_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Numero empresa Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="bairro-empresa-moip"> Bairro </label>
                    <input type="text" class="form-control" id="bairro-empresa-moip" name="bairro_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Bairro emresa Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="cep-empresa-moip"> CEP </label>
                    <input type="text" class="form-control" id="cep-empresa-moip" name="cep_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          CEP empresa Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="cidade-empresa-moip"> Cidade </label>
                    <input type="text" class="form-control" id="cidade-empresa-moip" name="cidade_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Cidade empresa moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="estado-empresa-moip"> Estado </label>
                    <input type="text" class="form-control" id="estado-empresa-moip" name="estado_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Estado empresa Moip
                    </div>
                  </div>

                  <div class="col-md-6 col-6 mb-3">
                    <label for="pais-empresa-moip"> País </label>
                    <input type="text" class="form-control" id="pais-empresa-moip" name="pais_empM" placeholder="" required="">
                    <div class="invalid-feedback">
                          Páis empresa Moip
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <button class="btn btn-lg btn-primary mx-auto" type="submit" return "false;"> Cadastrar</button>
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
