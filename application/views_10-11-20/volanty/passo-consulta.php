<div class="slide consulta d-none">
  <div class="container-fluid">
    <div class="mobile_scroll">
      <div class="conteudo">
        <h4>Serviço sob consulta</h4>
        <br>
        <!-- <h3>Informe os dados solicitados para receber o orçametno.</h3> -->
        <div class="w-100 mt-3">
          <div class="row">
            <div class="form-group col-12 col-md-4">

              <input type="text" placeholder="Nome" class="form-control" id="nomeConsulta" required>
            </div>
            <div class="form-group col-12 col-md-4">
              <input type="email" placeholder="Email" class="form-control" id="emailConsulta" required>
            </div>
            <div class="form-group col-12 col-md-4">
              <input type="text" placeholder="Telefone" class="form-control telMask" id="telefoneConsulta" required>
            </div>
          </div>
          <br>
          <h6>Informações do veículo:</h6>
          <hr>
          <br>
          <div class="row">
            <div class="form-group col-6 col-md-3">
              <input type="text" placeholder="Montadora" class="form-control" id="montadoraConsulta" required>
            </div>
            <div class="form-group col-6 col-md-3">
              <input type="email" placeholder="Modelo" class="form-control" id="modeloConsulta" required>
            </div>
            <div class="form-group col-4 col-md-2">
              <input type="text" placeholder="Motor" class="form-control" id="motorConsulta" required>
            </div>
            <div class="form-group col-4 col-md-2">
              <input type="text" placeholder="Ano" class="form-control numberMask" id="anoConsulta" required>
            </div>
            <div class="form-group col-4 col-md-2">
              <input type="text" placeholder="Quilometragem" class="form-control numberMask" id="quilometragemConsulta" required>
            </div>
          </div>
          <br>
          <h6>Informações da revisão:</h6>
          <hr>
          <br>
          <div class="row">
            <div class="form-group col-12 col-md-6 text-xl-right text-center">
              <select name="regioes" id="regioesSobConsulta">
                <option value="regiao">Selecione a Região</option>
                <optgroup label="São Paulo">
                  <option value="1">Zona Norte</option>
                  <option value="2">Zona Sul</option>
                  <option value="3">Zona Leste</option>
                  <option value="4">Zona Oeste</option>
                  <option value="5">Centro</option>
                </optgroup>
                <optgroup label="Outras cidades">
                  <option value="6">Santo André</option>
                  <option value="7">São Bernardo</option>
                  <option value="8">São Caetano</option>
                  <option value="9">Diadema</option>
                  <option value="10">Mauá</option>
                  <option value="11">Priacicaba</option>
                  <option value="12">Guarulhos</option>
                  <option value="13">Osasco</option>
                  <option value="14">Barueri</option>
                  <option value="15">Rio de Janeiro</option>
                </optgroup>
              </select>
            </div>
            <div class="form-group col-12 col-md-6 text-xl-left text-center">
              <select name="unidade" id="unidadesConsulta">
                <option value="">Selecione a unidade</option>
              </select>
            </div>
          </div>
        </div>
        <br>
        <h6>Data de agendamento:</h6>
        <hr>
        <br>
        <div class="form-group col-12 col-md-12">
          <input type="date" class="form-control" id="dataConsulta">
        </div>
        <br>
        <div class="mx-auto text-center">
          <button class="btn-voltar" onclick="$('.fullpage').fullpage.moveTo(1,0);return false;">
            <i class="fas fa-angle-left"></i>&nbsp;
            <span>Voltar</span>
          </button>
          <button class="btn-enviar" onclick="Consulta();return false;">
            <span>Enviar</span>&nbsp;
            <i class="fas fa-angle-right"></i>
          </button>
        </div>
      </div>
      <br /><br><br><br><br>
      <div class="powered-by text-center">
        <a data-toggle="modal" data-target="#lgpdModal" href="#" style="font-size: 0.8rem;">Política de Privacidade</a>
        <img class="assinatura-insignus img-fluid" src="<?php echo base_url('assets/img/poweredby_black.png') ?>" alt="">
      </div>
    </div>
    <br /><br />
  </div>
</div>