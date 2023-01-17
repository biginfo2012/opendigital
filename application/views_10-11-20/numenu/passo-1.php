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
                <img src="<?php echo base_url('assets/img/minha_revisao/passo_01_minha_revisao.gif'); ?>" class="numenu_passo_01_img img-fluid" />
              </div>
            </div>
          </div>
          <div class="col-md-7 col-sm-12 col-xl-6 offset-xl-2 offset-md-0 page-form mx-auto">
            <form class="needs-validation" novalidate="">
              <div class="row">
                <div class="col-md-6 col-10 mx-auto">
                  <select id="SelectMontadora" required="">
                    <option value="">Montadora</option>
                    <?php foreach ($listaMontadoras as $montadora) : ?>
                      <option <?php echo $montadora == $veiculo['montadora'] ? 'selected' : null ?> value="<?php echo $montadora ?>"><?php echo $montadora ?></option>
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
                        <option <?php echo $modelo == $veiculo['modelo'] ? 'selected' : null ?> value="<?php echo $modelo ?>"><?php echo $modelo ?></option>
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
                        <option <?php echo $motor['motor'] == $veiculo['motor'] ? 'selected' : null ?> value="<?php echo $veiculo['cod_modelo'] ?>"><?php echo ($motor['motor']) ?></option>
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
                    <?php for ($i = intval(date('Y')); $i > 1900; $i--) { ?>
                      <option <?php echo $i == $veiculo['ano'] ? 'selected' : null ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback">
                    Por favor, selecione um Ano.
                  </div>
                </div>

                <div class="col-md-6 col-10 mx-auto">
                  <div>
                    <input type="number" id="km-veiculo" placeholder="Quilometragem" value="<?php echo isset($veiculo['km']) ? $veiculo['km'] : null ?>">
                    <div class=" invalid-feedback">
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