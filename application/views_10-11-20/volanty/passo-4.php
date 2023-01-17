<div class="slide passo-4">
  <div class="container">
    <div class="conteudo">
      <div class="content">
        <div class="mobile_scroll">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-xl-6">
              <div class="title text-left">
                <h5>Unidade</h5>
                <h6>Agora escolha a unidade de atendimento, a data e o período que melhor lhe atendem.</h6>
                <img src="<?php echo base_url('assets/img/minha_revisao/passo_04_minha_revisao.png') ?>" alt="" class="img-fluid imagem-passo-4" />
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-xl-6">
              <div>
                <form class="needs-validation">
                  <div class="row">
                    <div class="text-center col-md-5 col-xl-5 mx-auto">
                      <select id="unidadeSelecionada" style="background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 4% no-repeat #fff;">
                        <option value="">Unidade</option>
                        <?php foreach ($listaLojista as $lojista) : ?>
                          <option <?php echo $lojista['cod_lojista'] == $cod_lojista ? 'selected' : '' ?> value="<?php echo $lojista['cod_lojista'] ?>"><?php echo $lojista['nome_unidade'] . " - " . $lojista['endereco'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <!-- exibicao mobile -->
                  <div class="row datepicker_mobile">
                    <div class="col-md-5 col-xl-5 mb-3 mx-auto text-center">
                      
                    </div>
                  </div>
                  <!-- exibicao mobile -->
                  <!-- exibicao desktop -->
                  <div class="row datepicker_desktop">
                    <div class="col-md-5 col-xl-5 mb-3 mx-auto text-center">
                      
                    </div>
                  </div>
                  <!-- exibicao desktop -->
                  <input type="hidden" id="dataPeriodo" class="datepicker" value="<?php echo date('d/m/Y'); ?>" />
                  <br />
                  <div class="row botoes_periodo">
                    <div class="col-xl-4 col-md-6 periodoItem text-right">
                      <a id="periodo-1" class="card  <?= $periodo == null ? 'disabled' : '' ?>" href="#" onclick="<?= $periodo == null ? '' : 'selecionaPeriodo(1)' ?>">
                        <span class="card-title text-center">Manhã</span>
                      </a>
                    </div>
                    <div class="col-xl-4 col-md-6 periodoItem text-left">
                      <a id="periodo-2" class="card  <?= $periodo == null ? 'disabled' : '' ?>" href="#" onclick="<?= $periodo == null ? '' : 'selecionaPeriodo(2)' ?>">
                        <span class="card-title text-center">Tarde</span>
                      </a>
                    </div>
                  </div>
                  <br>
                  <div class="row text-center buttons">
                    <input type="hidden" value="0" name="periodo" id="periodoSelecionado">
                    <div class="mx-auto">
                      <div class="botoes_controle">
                        <button class="btn-voltar" onclick="$('.fullpage').fullpage.moveSlideLeft();return false;">
                          <i class="fas fa-angle-left"></i>&nbsp;
                          <span>Voltar</span>
                        </button>
                        <button class="btn-enviar" onclick="Periodo(); return false;">
                          <span>Comprar</span>&nbsp;
                          <i class="fas fa-angle-right"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
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
</div>