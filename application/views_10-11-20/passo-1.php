<div class="slide passo-1">
  <div class="container p-0">
    <div class="conteudo">
      <div class="mobile_scroll">
        <div class="row">
          <div class="col-md-4 col-sm-12 col-xl-4">
            <div class="title p-3">
              <h4>DADOS DO VEÍCULO</h4>
              <h6>Selecione os dados do veículo no qual deseja realizar a revisão.</h6>
            </div>
            <div>
              <div>
                <img src="<?php echo base_url('assets/img/minha_revisao/passo_01_minha_revisao.gif'); ?>" class="minha_revisao_passo_01_img img-fluid" />
              </div>
            </div>
          </div>
          <div class="col-md-7 col-sm-12 col-xl-6 offset-xl-2 offset-md-0 page-form mx-auto">
            <div class="md btn-sob-consulta">
              <span class="tooltip-top">Não achou seu carro na lista?<strong onclick="toConsulta(); return false;">Clique aqui!</strong></span>
              <i class="fas fa-car" onclick="toConsulta(); return false;"></i>
            </div>
            <form class="needs-validation" novalidate="">

              <div class="cadastrados">
                <?php if ($this->session->logado) { ?>
                  <div class="row">
                    <div class="col-md-8 mx-auto col-10 mx-auto">
                      <select id="SelectCadastrado" required="">
                        <option value="">CADASTRADOS</option>
                        <?php foreach ($listaCadastrados as $cadastrado) : ?>
                          <option value="<?php echo $cadastrado['cod_veiculo_usuario'] ?>"><?php echo ($cadastrado['modelo'] . " - " . $cadastrado['motor'] . " - " . $cadastrado['ano_carro_cadastro']) ?></option>
                        <?php endforeach; ?>
                      </select>
                      <div class="invalid-feedback">
                        Please select a valid montadora.
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="row d-none">
                    <div class="col-md-12 col-10 mx-auto">
                      <select id="SelectCadastrado" required="">
                        <option value="">CADASTRADOS</option>
                      </select>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-md-6 col-10 mx-auto">
                  <select id="SelectMontadora" required="">
                    <option value="">Montadora</option>
                    <?php foreach ($listaMontadoras as $montadora) : ?>
                      <option <?= $montadora == $veiculo['montadora'] ? 'selected' : null ?> value="<?php echo $montadora ?>"><?php echo $montadora ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">
                    Por favor, selecione um montadora.
                  </div>
                </div>

                <div class="col-md-6 col-10 mx-auto">
                  <select id="SelectModelo" required="">
                    <option value="">Modelo</option>
                    <?php
                    if (isset($lista_modelos)) {
                      foreach ($lista_modelos as $modelo) {
                        ?>
                        <option <?= $modelo == $veiculo['modelo'] ? 'selected' : null ?> value="<?php echo $modelo ?>"><?php echo $modelo ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <div class="invalid-feedback">
                    Por favor, selecione um modelo.
                  </div>
                </div>

                <div class="col-md-6 col-10 mx-auto">
                  <select id="SelectMotor" required="">
                    <option value="">Motor</option>
                    <?php
                    if (isset($lista_motores)) {
                      foreach ($lista_motores as $motor) {
                        ?>
                        <option <?= $motor['motor'] == $veiculo['motor'] ? 'selected' : null ?> value="<?php echo $veiculo['cod_modelo'] ?>"><?php echo ($motor['motor']) ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <div class="invalid-feedback">
                    Por favor, selecione um motor.
                  </div>
                </div>

                <div class="col-md-6 col-10 mx-auto">
                  <select id="ano-veiculo" required="">
                    <option value="">Ano</option>
                    <?php
                    $i = date("Y");
                    while ($i >= 1900) {
                      ?>
                      <option <?= $i == $veiculo['ano'] ? 'selected' : null ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php $i--;
                    }  ?>
                  </select>
                  <div class="invalid-feedback">
                    Por favor, selecione um Ano.
                  </div>
                </div>

                <div class="col-md-6 col-10 mx-auto">
                  <div>
                    <input type="number" id="km-veiculo" placeholder="Quilometragem" value="<?= isset($veiculo['km']) ? $veiculo['km'] : null ?>">
                    <div class="invalid-feedback">
                      Por favor, digite a quilometragem.
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center">
                <br />
                <button onclick="Veiculo();return false;" type="submit" class="btn btn-enviar"> <span>Continuar</span> &nbsp;&nbsp;<i class="fas fa-angle-right"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="powered-by text-center">
        <a data-toggle="modal" data-target="#lgpdModal" href="#" style="font-size: 0.8rem;">Política de Privacidade</a>
        <img class="assinatura-insignus img-fluid" src="<?php echo base_url('assets/img/poweredby_black.png') ?>" alt="">
      </div>
    </div>
  </div>
</div>