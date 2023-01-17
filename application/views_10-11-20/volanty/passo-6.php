<div class="slide passo-6">
  <div class="container">
    <div class="conteudo">
      <div class="mobile_scroll">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div>
              <div>
                <h4>Pronto!</h4>
                <h6>Após a confirmação do pagamento as informações serão enviadas para o seu e-mail.</h6>
              </div>
              <div>
                <div >
                  <img src="<?php echo base_url('assets/img/done.png') ?>" alt="" class="img-fluid img-done" style="width:250px;" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 text-center">
            <div class="center">
              <div class="info-pagamento">
                <div>
                  <span>Modelo</span>
                  <div class="text modelo"><?= $desc['carro'] ?></div>
                </div>
                <div>
                  <span>Unidade</span>
                  <div class="text unidade"><?= $desc['local'] ?></div>
                </div>
                <div>
                  <span>Data</span>
                  <div class="text data"><?= $desc['data'] ?></div>
                </div>
                <div>
                  <span>Voucher</span>
                  <div class="text voucher"><?= $desc['voucher'] ?></div>
                </div>
              </div>
              <br /><br />
              <div>
                <button onclick="location.href='<?php echo base_url('agenda'); ?>';" type="submit" class="btn btn-enviar"> <span>Finalizar</span> &nbsp;&nbsp;<i class="fas fa-angle-right"></i></button>
              </div>
            </div>
          </div>
        </div> <!-- /CONFIRMAÇÃO -->
        <br />
      </div>
      <div class="text-center">
        <a data-toggle="modal" data-target="#lgpdModal" href="#" style="font-size: 0.8rem;">Política de Privacidade</a>
        <img class="assinatura-insignus img-fluid" src="<?php echo base_url('assets/img/poweredby_black.png') ?>" alt="">
      </div>
    </div>
  </div>
</div>