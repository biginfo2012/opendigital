<div class="slide passo-5">
  <div class="container">
    <div class="conteudo">
      <div class="content">
        <div class="mobile_scroll">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xl-5 title text-left">
              <div class="informacoes-passo-5">
                <div>
                  <h5>Informações de Pagamento</h5>
                </div>
                <div class="row">
                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <span><b>Carro:</b></span> <span id="paymentVeiculo"><?php echo $desc['carro'] ?></span>
                  </div>
                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <span><b>Serviço:</b></span> <span id="paymentServico"><?php echo $desc['servico'] ?></span>
                  </div>
                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <span><b>Local:</b></span> <span id="paymentLocal"><?php echo $desc['local'] ?></span>
                  </div>
                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <span><b>Data:</b></span> <span id="paymentData"><?php echo $desc['data'] ?></span>
                  </div>
                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <span><b>Valor:</b></span> <span id="valorTotal"><?php echo $desc['valor'] ?></span>
                  </div>
                </div>
              </div>
              <div>
                <img src="<?php echo base_url('assets/img/passo_05_volanty.png') ?>" alt="" class="img-fluid img-responsive imagem-passo-5">
              </div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6 form">
              <form>
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12 col-xl-12">
                    <input type="text" value="" class="" id="pag-cc-name" placeholder="Nome como descrito no cartão" required="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6 row_2">
                    <input type="text" class=" " id="pag-cc-number" placeholder="Número do cartão" required="">
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3 col-xl-3">
                    <input type="text" class="  valMask" id="pag-cc-expiration" placeholder="Validade" required="">
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3 col-xl-3">
                    <input type="text" class=" " id="pag-cc-cvv" placeholder="CVC" required="">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6">
                    <input type="text" class="dataMask" id="pag-nasc" placeholder="Data de Nascimento" required="">
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6">
                    <input type="text" class="cpfMask" id="pag-cpf" placeholder="CPF" required="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6">
                    <select required class="form-control text-left" id="pag-installments" style="background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 4% no-repeat #fff;">
                      <option value="" class="text-left">Parcelamento</option>
                      <option value="1" class="text-left">À vista</option>
                      <option value="2" class="text-left">02 vezes</option>
                      <option value="3" class="text-left">03 vezes</option>
                    </select>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6 mx-auto processado-pelo-moip text-center">
                    <br />
                    <span>Pagamento processado por:</span>
                    <img src="<?php echo base_url('assets/img/logo_moip.png') ?>" alt="">
                  </div>
                </div>
                <div><br /><br /></div>
                <div class="row buttons">
                  <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 mx-auto">
                    <div class="text-center">
                      <button type="button" class="btn-voltar" onclick="$('.fullpage').fullpage.moveSlideLeft();return false;">
                        <i class="fas fa-angle-left"></i>
                        <span>Voltar</span>
                      </button>
                      <button type="submit" class="btn-enviar" onclick="Pagamento(); return false;">
                        <span>Continuar</span>
                        <i class="fas fa-angle-right"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
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