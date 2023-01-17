<script>
  <?php if (isset($servicos[0]['cod_servicos'])) { ?>
    servico_basico = <?php echo $servicos[0]['cod_servicos'] ?>;
  <?php } ?>
  <?php if (isset($servicos[1]['cod_servicos'])) { ?>
    servico_inter = <?php echo $servicos[1]['cod_servicos'] ?>;
  <?php } ?>
  <?php if (isset($servicos[2]['cod_servicos'])) { ?>
    servico_premium = <?php echo $servicos[2]['cod_servicos'] ?>;
  <?php } ?>
  servico_selected = <?php echo $cod_servico != null ? '\'' . $cod_servico . '\'' : 'null' ?>;
</script>


<div class="slide passo-2">
  <div class="container">
    <div class="conteudo">
      <div class="content">
        <div class="mobile_scroll">
          <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xl-3 title text-left">
              <h5>Plano</h5>
              <h6>Selecione o plano que atende melhor suas necessidades e em seguida clique em "comprar".</h6>
              <div class="d-none d-lg-none d-md-none d-xl-block d-sm-none">
                <br /><br />
                <div>
                  <div>
                    <img src="<?php echo base_url('assets/img/minha_revisao/passo_02_minha_revisao.png') ?>" alt="" class="img-fluid imagem-passo-2">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xl-7 offset-xl-2 text-center">

              <div class="card-deck text-center radio">
                <div class="card basico<?php echo preg_match('/Básico/', $desc['servico']) ? ' selected' : null ?>">
                  <div class="card-header">
                    <i class="fas fa-star mb-2"></i> <br>
                    <span>Básico</span>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled mt-3 mb-4">
                      <li>Óleo de motor</li>
                      <li>Anel de vedação</li>
                      <li>Filtro de óleo</li>
                      <li>Filtro de combustível</li>
                      <li>Filtro de ar</li>
                      <li>Revisão</li>
                      <li class='scratched'>Alinhamento</li>
                      <li class='scratched'>Balanceamento</li>
                      <li class='scratched'>Filtro cabine</li>
                      <li class='scratched'>Higienização do AC</li>
                    </ul>
                    <div class="price price-value">
                      <span>R$<?php echo isset($servicos[0]) ? $servicos[0]['preco'] / 100 : null ?></span>
                    </div>
                  </div>
                </div>

                <div class="card inter<?php echo preg_match('/Intermediário/', $desc['servico']) ? ' selected' : null ?>">
                  <div class="card-header">
                    <i class="fas fa-star mb-2"></i> <i class="fas fa-star"></i> <br>
                    <span>Intermediário</span>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled mt-3 mb-4">
                      <li>Óleo de motor</li>
                      <li>Anel de vedação</li>
                      <li>Filtro de óleo</li>
                      <li>Filtro de combustível</li>
                      <li>Filtro de ar</li>
                      <li>Revisão</li>
                      <li>Alinhamento</li>
                      <li>Balanceamento</li>
                      <li class='scratched'>Filtro cabine</li>
                      <li class='scratched'>Higienização do AC</li>
                    </ul>
                    <div class="price price-value">
                      <span>R$<?php echo isset($servicos[1]) ? $servicos[1]['preco'] / 100 : null ?></span>
                    </div>
                  </div>
                </div>

                <div class="card premium<?php echo preg_match('/Premium/', $desc['servico']) ? ' selected' : null ?>">
                  <div class="card-header">
                    <i class="fas fa-star mb-2"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i><br>
                    <span>Premium</span>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled mt-3 mb-4">
                      <li>Óleo de motor</li>
                      <li>Anel de vedação</li>
                      <li>Filtro de óleo</li>
                      <li>Filtro de combustível</li>
                      <li>Filtro de ar</li>
                      <li>Revisão</li>
                      <li>Alinhamento</li>
                      <li>Balanceamento</li>
                      <li>Filtro cabine</li>
                      <li>Higienização do AC</li>
                    </ul>
                    <div class="price price-value">
                      <span>R$<?php echo isset($servicos[2]) ? $servicos[2]['preco'] / 100 : null ?></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mx-auto">
                <div><br /></div>
                <button class="btn-voltar" onclick="$('.fullpage').fullpage.moveTo(1,0);return false;">
                  <i class="fas fa-angle-left"></i>&nbsp;
                  <span>Voltar</span>
                </button>
                <button class="btn-enviar" onclick="Servico(servico_selected);return false;">
                  <span>Comprar</span>&nbsp;
                  <i class="fas fa-angle-right"></i>
                </button>
              </div>

            </div>
          </div>
          <br />

        </div>
        <div class="powered-by text-center">
          <a data-toggle="modal" data-target="#lgpdModal" href="#" style="font-size: 0.8rem;">Política de Privacidade</a>
          <img class="assinatura-insignus img-fluid" src="<?php echo base_url('assets/img/poweredby_black.png') ?>" alt="">
        </div>
      </div>
    </div>
  </div>
</div>