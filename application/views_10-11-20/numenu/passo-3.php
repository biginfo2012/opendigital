<script>
  regiao_selected = <?php echo $regiao != null ? '\'' . $regiao . '\'' : 'null' ?>;
</script>

<div class="slide passo-3">

  <div class="container">

    <div class="conteudo">
      <div class="content">
        <div class="mobile_scroll">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xl-3 col-lg-6 title text-left">
              <div class="local_info">
                <h5>Local</h5>
                <h6>Selecione a melhor localização para agendar sua revisão.</h6>
                <div>
                  <div>
                    <div class="d-none d-lg-block d-xl-block"><br /></div>
                    <img src="<?php echo base_url('assets/img/minha_revisao/passo_03_minha_revisao.png') ?>" alt="" class="img-responsive img-fluid imagem-passo-3">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-12 offset-xl-4 text-center pt-2">
              <div class="content form">
                <select id="selectId" style="background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 4% no-repeat #fff;">
                  <option value="regiao">Selecione a Região</option>
                  <optgroup label="São Paulo">
                    <?php foreach($regioes_list as $regiao_item){ ?>
                      <?php if($regiao_item['cod_regiao'] <= 5){ ?>
                        <option value="<?= $regiao_item['cod_regiao'] ?>" <?= $regiao_item['cod_regiao']==$regiao?'selected':null ?>><?= $regiao_item['regiao'] ?></option>
                      <?php } ?>
                    <?php } ?>
                  </optgroup>
                  <optgroup label="Outras cidades">
                  <?php foreach($regioes_list as $regiao_item){ ?>
                    <?php if($regiao_item['cod_regiao'] > 5){ ?>
                      <option value="<?= $regiao_item['cod_regiao'] ?>" <?= $regiao_item['cod_regiao']==$regiao?'selected':null ?>><?= $regiao_item['regiao'] ?></option>
                    <?php } ?>
                  <?php } ?>
                  </optgroup>
                </select>
                <div><br /></div>
                <div class="mx-auto">
                  <button class="btn-voltar" onclick="$('.fullpage').fullpage.moveSlideLeft();return false;">
                    <i class="fas fa-angle-left"></i>&nbsp;
                    <span>Voltar</span>
                  </button>
                  <button class="btn-enviar" onclick="Regiao(regiao_selected); return false;">
                    <span>Comprar</span>&nbsp;
                    <i class="fas fa-angle-right"></i>
                  </button>
                </div>
              </div>
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