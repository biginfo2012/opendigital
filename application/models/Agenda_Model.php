<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Agenda_Model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  /**
   *  SCRIPT DE INSERÇÃO DOS DADOS DA PLANILHA NO BANCO
   */
  public function databasePopulation()
  {
    $row = 1;
    if (($handle = fopen(base_url("assets/files/precos.csv"), "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, "/")) !== FALSE) {
        $num = count($data);
        // echo "<p> [$num] campos na linha $row: <br /></p>\n";
        $row++;

        for ($c = 0; $c < $num; $c++) {
          // var_dump($data[$c]);
          // echo "<br> [OBJ]: == ";
          $values = explode(";", $data[$c]);

          /*Criando MODELOS*/
          $modelo = array();
          $modelo['montadora'] = $values[0];
          $modelo['modelo'] = $values[1];
          $modelo['motor'] = strlen($values[2]) < 1 ? 'Sob Consulta' : $values[2];
          $modelo['customizado'] = $values[3] == "Plataforma" ? 0 : 1;

          $select = $this->db->get_where('MODELOS', array(
            'modelo' => $modelo['modelo'],
            'montadora' => $modelo['montadora'],
            'motor' => $modelo['motor']
          ));
          $select_result = $select->result_array();

          if (sizeof($select_result) == 0) {
            echo "<b>" . $data[$c] . "</b>  ";
            var_dump($select_result);
            echo "<br>";
          }


          if ($modelo['customizado'] == 0) {
            //   if(sizeof($select_result) == 0){
            //     $result = $this->db->insert('MODELOS', $modelo);
            //     $fk_modelo = $this->db->insert_id();
            //     $servico_basico = array('nome'=>'Servico Básico', 'fk_modelo'=>$fk_modelo,'preco' => explode("$", $values[4])[1] * 100);
            //     $servico_inter = array('nome'=>'Servico Intermediário', 'fk_modelo'=>$fk_modelo,'preco' => explode("$", $values[5])[1] * 100);
            //     $servico_premium = array('nome'=>'Servico Premium', 'fk_modelo'=>$fk_modelo,'preco' => explode("$", $values[6])[1] * 100);
            //     $result = $this->db->insert('SERVICOS', $servico_basico);
            //     $result = $this->db->insert('SERVICOS', $servico_inter);
            //     $result = $this->db->insert('SERVICOS', $servico_premium);

            //     echo("RESULTADO: NOVO ".$fk_modelo);
            //   }else{

            //     $this->db->where('cod_modelo', $select_result[0]['cod_modelo']);
            //     $this->db->update('MODELOS',  array(
            //       'motor' => $modelo['motor'],
            //       'customizado' => $modelo['customizado']
            //     ));

            //     $services = $this->db->get_where('SERVICOS', array('fk_modelo' => $select_result[0]['cod_modelo']));
            //     if($services->num_rows() > 0){
            //       //BÁSICO
            //       $this->db->where(array(
            //         'fk_modelo' => $select_result[0]['cod_modelo'], 
            //         'nome'=>'Servico Básico'
            //       ));
            //       $this->db->update('SERVICOS',  array('preco' => (explode("$", $values[4])[1] * 100) ));

            //       //INTER
            //       $this->db->where(array(
            //         'fk_modelo' => $select_result[0]['cod_modelo'], 
            //         'nome'=>'Servico Intermediário'
            //       ));
            //       $this->db->update('SERVICOS',  array('preco' => (explode("$", $values[5])[1] * 100) ));

            //       //PREMIUM
            //       $this->db->where(array(
            //         'fk_modelo' => $select_result[0]['cod_modelo'], 
            //         'nome'=>'Servico Premium'
            //       ));
            //       $this->db->update('SERVICOS',  array('preco' => (explode("$", $values[6])[1] * 100) ));

            //     }else{

            //       $servico_basico = array('nome'=>'Servico Básico', 'fk_modelo'=>$select_result[0]['cod_modelo'],'preco' => explode("$", $values[4])[1] * 100);
            //       $servico_inter = array('nome'=>'Servico Intermediário', 'fk_modelo'=>$select_result[0]['cod_modelo'],'preco' => explode("$", $values[5])[1] * 100);
            //       $servico_premium = array('nome'=>'Servico Premium', 'fk_modelo'=>$select_result[0]['cod_modelo'],'preco' => explode("$", $values[6])[1] * 100);
            //       $result = $this->db->insert('SERVICOS', $servico_basico);
            //       $result = $this->db->insert('SERVICOS', $servico_inter);
            //       $result = $this->db->insert('SERVICOS', $servico_premium);

            //     }

            //     echo("RESULTADO: NOVO ".$select_result[0]['cod_modelo']);
            //   }

          } else {
            if (sizeof($select_result) == 0) {
              $modelo['motor'] = empty($modelo['motor']) ? "Sob Consulta" : $modelo['motor'];
              $result = $this->db->insert('MODELOS', $modelo);
              var_dump($result);
              echo ("<br>");
            }
          }
        }
      }
      fclose($handle);
    }
  }

  /**
   *  Busca no banco todos os  pedidos
   *
   *
   * @return     array   As informações dos pedidos
   */
  public function listaGeral($cod_usuario, $offset = 0)
  {
    $rows = $this->db->get_where('AGENDA', array('fk_usuario' => $cod_usuario));
    $num = $rows->num_rows();

    if ($num != 0) {
      $this->db->limit(5, $offset * 5);
      $query = $this->db->get_where('AGENDA', array('fk_usuario' => $cod_usuario));

      $result = $query->result_array();

      foreach ($result as $key => $value) {
        $query2 = $this->db->get_where('LOJISTA', array('cod_lojista' => $value['fk_lojista']));
        $result[$key]['unidade'] =  $query2->result_array()[0]['nome_unidade'];
      }
    }

    $result[0]['num_rows'] = $num;
    return  $result;
  }

  /**
   *  Busca no banco um pedido por ID
   *
   *
   * @return     array   As informações dos pedidos
   */
  public function buscarPedido($cod_agenda)
  {
    //$this->db->order_by('cod_log', 'DESC');
    $query = $this->db->get_where('AGENDA', array('cod_agenda' => $cod_agenda));

    $result = $query->result_array()[0];

    $query2 = $this->db->get_where('LOJISTA', array('cod_lojista' => $result['fk_lojista']));
    $result['unidade'] =  $query2->result_array()[0]['nome_unidade'];

    return  $result;
  }



  /**
   *  Verifica se existe o lojista informado e se seu if moip está em branco e aberto a vinculação
   *
   * @param     $cod_lojista  código do lista a verificar
   *
   *
   * @return     array   As informações dos lojistas
   */
  public function checkLojistaToConnect($cod_lojista)
  {
    $query = $this->db->get_where('LOJISTA', array('cod_lojista' => $cod_lojista, 'moip_id =' => NULL));
    if ($query->num_rows() != 0) {
      return true;
    } else {
      return false;
    }
  }


  /**
   *  Busca no banco todos os lojistas por região
   *
   *
   * @return     array   As informações dos lojistas
   */
  public function listaGeralLojistaRegiaoComContaMoip($regiao)
  {

    $query = $this->db->get_where('LOJISTA', array('regiao' => $regiao, 'moip_id !=' => NULL));

    $result = $query->result_array();


    return  $result;
  }

  /**
   *  Busca no banco todos os lojistas por região
   *
   *
   * @return     array   As informações dos lojistas
   */
  public function listaGeralLojistaRegiao($regiao)
  {

    $query = $this->db->get_where('LOJISTA', array('regiao' => $regiao));

    $result = $query->result_array();


    return  $result;
  }

  /**
   *  Busca no banco de dados por uma agenda com o pagamento informado
   *
   * @param       string  $moip_ultimo_payment_id   Informações doa agenda
   *
   *
   * @return      array  Retorna oa agenda caso ele exista
   */
  public function buscarAgendaPorPagamento($moip_ultimo_payment_id)
  {

    $query = $this->db->get_where('AGENDA', array('moip_ultimo_payment_id' => $moip_ultimo_payment_id));

    $result = $query->row_array();

    return  $result;
  }

  /**
   *  Busca no banco de dados todos pedidos de uma unidade em um periodo e data e verifica se
   *  está disponível para mais agendamento
   *
   * @param       int  $unidade   unidade a verificar a disponibilidade
   *
   * @param       int  $data      data a verificar disponibilidade
   *
   * @param       int  $periodo   periodo a verificar a disponibilidade
   *
   * @return      bool  Retorna  se há disponibilidade
   */
  public function verificarDisponibilidadeDaUnidade($unidade, $data, $periodo)
  {

    $query = $this->db->get_where('AGENDA', array('fk_lojista' => $unidade, 'periodo' => $periodo, 'data' => $data));

    $result = $query->result_array();

    $disponibilidade = 0;

    if (count($result) < $this->buscarLojista($unidade)['limite_periodo'])
      $disponibilidade = 1;

    return  $disponibilidade;
  }

  /**
   *  Busca no banco de dados por uma agenda com o pedido informado
   *
   * @param       string  $moip_ultimo_order_id   Informações doa agenda
   *
   *
   * @return      array  Retorna oa agenda caso ele exista
   */
  public function buscarAgendaPorPedido($moip_ultimo_order_id)
  {

    $query = $this->db->get_where('AGENDA', array('moip_order_id' => $moip_ultimo_order_id));

    $result = $query->row_array();

    return  $result;
  }


  /**
   *  Busca no banco de dados por um veiculo com o id informado
   *
   * @param       string  $cod_modelo   Informações do veiculo
   *
   *
   * @return      array  Retorna o veiculo caso ele exista
   */
  public function buscarVeiculo($cod_modelo)
  {

    $query = $this->db->get_where('MODELOS', array('cod_modelo' => $cod_modelo));

    $result = $query->row_array();

    return  $result;
  }

  /**
   *  Busca no banco de dados por um Lojista com o id informado
   *
   * @param       string  $cod_lojista   Informações do Lojista
   *
   *
   * @return      array  Retorna o Lojista caso ele exista
   */
  public function buscarLojista($cod_lojista)
  {

    $query = $this->db->get_where('LOJISTA', array('cod_lojista' => $cod_lojista));

    $result = $query->row_array();

    return  $result;
  }
  

  /**
   *  Busca no banco de dados por um usuario com o id informado
   *
   * @param       string  $cod_usuario   Informações do usuario
   *
   *
   * @return      array  Retorna o usuario caso ele exista
   */
  public function buscarUsuario($cod_usuario)
  {

    $query = $this->db->get_where('LOGIN', array('cod_login' => $cod_usuario));

    $result = $query->row_array();

    return  $result;
  }




  /**
   *  Busca no banco de dados pelos serviços de um modelo
   *
   * @param       string  $cod_modelo   Informações do veiculo
   *
   *
   * @return      array  Retorna os serviços de um modelo
   */
  public function buscarModeloServicos($cod_modelo)
  {

    $query = $this->db->get_where('SERVICOS', array('fk_modelo' => $cod_modelo));

    $result = $query->result_array();

    return  $result;
  }

  /**
   *  Busca no banco de dados pelos serviço
   *
   * @param       string  $cod_servico   Informações do serviço
   *
   *
   * @return      array  Retorna o serviço
   */
  public function buscarServico($cod_servico)
  {

    $query = $this->db->get_where('SERVICOS', array('cod_servicos' => $cod_servico));

    $result = $query->row_array();

    return  $result;
  }


  /**
   *  Busca no banco todos os lojistas
   *
   *
   * @return     array   As informações dos lojistas
   */
  public function listaGeralLojista()
  {

    $query = $this->db->get('LOJISTA');

    $result = $query->result_array();


    return  $result;
  }



  /**
   *  Busca no banco todos as montadoras
   *
   *
   * @return     array   As informações dos montadoras
   */
  public function listaGeralMontadoras()
  {
    $this->db->order_by('montadora');
    $this->db->where('customizado', '0');
    $this->db->group_by('montadora');
    $query = $this->db->select('montadora')->get('MODELOS');

    $result = $query->result_array();

    $result = array_map(function ($value) {
      return $value['montadora'];
    }, $result);

    return  $result;
  }


  /**
   *  Busca no banco todos veiculos cadastrados de um usuário
   *
   *
   * @return     array   As informações dos veiculos
   */
  public function listaVeiculosCadastrados($cod_usuario)
  {
    //$this->db->order_by('montadora', 'DESC');
    $this->db->join('MODELOS', 'VEICULOS_USUARIO.fk_modelo = MODELOS.cod_modelo');
    $query = $this->db->get_where('VEICULOS_USUARIO', array('fk_usuario' => $cod_usuario, 'customizado' => '0'));

    $result = $query->result_array();

    return  $result;
  }


  /**
   *  Busca no banco todos os  modelos de uma montadora
   *
   *
   * @return     array   As informações dos modelos
   */
  public function listaGeralModelo($montadora)
  {
    $this->db->order_by('modelo', 'DESC');
    $this->db->group_by('modelo');
    $query = $this->db->select('modelo')->get_where('MODELOS', array('montadora' => $montadora, 'customizado' => '0'));

    $result = $query->result_array();

    $result = array_map(function ($value) {
      return $value['modelo'];
    }, $result);

    return  $result;
  }


  /**
   *  Busca no banco todos os  motores de um modelo
   *
   *
   * @return     array   As informações dos motores
   */
  public function listaGeralMotor($modelo)
  {
    $this->db->order_by('motor', 'DESC');
    $query = $this->db->select('cod_modelo,motor')->get_where('MODELOS', array('modelo' => $modelo, 'customizado' => '0'));

    $result = $query->result_array();

    return  $result;
  }


  /**
   *  Envia email informando pedido de consulta de um usuário
   *
   * @param      string  $email  O email de contato para retornar
   * @param      string  $desc    A descrição
   */
  public function EnviarEmailConsulta($data)
  {
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.minharevisao.com.br',
      'smtp_port' => 587,
      'smtp_user' => 'envio@minharevisao.com.br',
      'smtp_pass' => 'Revisao2019@@',
    );

    $this->email->initialize($config);
    $this->email->set_newline("<br>");

    $body = $this->load->view('emailConsulta.php', $data, TRUE);
    $this->email->subject('Solicitação de serviço sob consulta');

    $this->email->from('envio@minharevisao.com.br', 'Serviço sob consulta');
    $this->email->to('agendamento@minharevisao.com.br');
    $this->email->set_mailtype("html");
    $this->email->message($body);
    $result = $this->email->send();

    $this->email->clear(TRUE);
    return  $result;
  }

  /**
   *  Envia email informando as informações do pedido após pagamento
   *
   * @param      string  $pedido    Informações do pedido
   */
  public function EnviarEmailPagamento($pedido, $emailLojista, $emailUsuario, $emails = [])
  {
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.minharevisao.com.br', //smtp.minharevisao.com.br
      'smtp_port' => 587,
      'smtp_user' => 'envio@minharevisao.com.br', //envio@minharevisao.com.br
      'smtp_pass' => 'Revisao2019@@', //Revisao2018@@###
    );

    $this->email->initialize($config);
    $this->email->set_newline("<br>");

    /*
       *
       *  Tratamento dos dados para disposição das informações no email
       *
       */

    $periodo = $pedido['periodo'] == 1 ? "Matutino" : "Vespertino";
    $dados['periodo_desc'] = $pedido['periodo'] == 1 ? "Entregar o carro até as 10:00, carro pronto até as 13:00" : "Entregar o carro até as 14:00, carro pronto até as 18:00";

    $usuario = $this->buscarUsuario($pedido['fk_usuario']);
    $unidade = $this->buscarLojista($pedido['fk_lojista']);
    $servico = $this->buscarServico($pedido['fk_servico']);
    $veiculo = $this->buscarVeiculo($servico['fk_modelo']);
    $data = date("d/m/Y", strtotime(str_replace('/', '-', $pedido['data'])));

    $dados["usuario"] = $usuario['nome'];
    $dados["usuario_telefone"] = $usuario['telefone_contato'];
    $dados["unidade"] = $unidade['nome_unidade'] . " - " . $unidade['endereco'];
    $dados["data"] = $data;
    $dados["periodo"] = $periodo;
    $dados["servico"] = explode(' ', $servico['nome'])[1];
    $dados["preco"] = ($servico['preco'] / 100);
    $dados["veiculo"] = $veiculo['montadora'] . " " . $veiculo['modelo'] . " " . $veiculo['motor'] . " - " . $pedido['ano_carro'] . " - " . $pedido['km_carro'] . " Km rodados";
    $dados["status_pagamento"] = $this->mm->traduzirStatus($pedido['moip_ultimo_status_payment']);
    $dados["voucher"] = $pedido['voucher'];
    $dados['operation_system'] = $pedido['operation_system'];


    $body = $this->load->view('emailPagamento.php', $dados, TRUE);

    $this->email->subject('Agendamento Minha Revisão, status: ' . $this->mm->traduzirStatus($pedido['moip_ultimo_status_payment']));

    $this->email->from('envio@minharevisao.com.br', 'Minha Revisão');
    $this->email->to(array_merge(array($emailLojista, $emailUsuario, 'agendamento@minharevisao.com.br'), $emails));
    $this->email->set_mailtype("html");
    $this->email->message($body);
    $result = $this->email->send();

    $this->email->clear(TRUE);

    return  $result;
  }



  /**
   *  Gera um GerarVoucher randomicamente
   *
   * @return    string  voucher com 8 caracteres
   */
  function GerarVoucher()
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  /**
   * Insere uma agenda
   *
   * @param       string  $agenda  Informações da agenda
   *
   * @return      int  Retorna o id da agenda inserida
   */
  public function inserir($agenda)
  {
    $result = $this->db->insert('AGENDA', $agenda);

    $id = $this->db->insert_id();

    return $id;
  }

  /**
   * Inseri uma lojista
   *
   * @param       string  $lojista  Informações da lojista
   *
   * @return      int  Retorna o id da lojista inserida
   */
  public function inserirLojista($lojista)
  {
    $result = $this->db->insert('LOJISTA', $lojista);

    $id = $this->db->insert_id();

    return $id;
  }

  /**
   * Atualiza uma lojista
   *
   * @param       array  $lojista  Informações da lojista
   *
   * @return      boolean  Resultado da operação
   */
  public function updateLojista($lojista)
  {
    $this->db->where('cod_lojista', $lojista['cod_lojista']);
    $return = $this->db->update('LOJISTA',  $lojista);

    return $return;
  }

  /**
   * Atualiza uma agenda
   *
   * @param       string  $agenda  Informações da agenda
   *
   * @return      boolean  Resultado da operação
   */
  public function update($agenda)
  {
    $this->db->where('cod_agenda', $agenda['cod_agenda']);
    $return = $this->db->update('AGENDA',  $agenda);

    return $return;
  }

  /**
   * Verifica a existência de um veiculo na tabela VEICULOS
   *
   * @param       integer  $cod_modelo  identificador do veiculo
   *
   * @return      bool     booleano da existencia do registro
   */
  public function checkVeiculo($cod_modelo)
  {
    $query = $this->db->get_where('MODELOS', array('cod_modelo' => $cod_modelo));
    if ($query->num_rows() == 1) {
      return true; //Caso exista o veículo
    } else {
      return false; //Caso não exista
    }
  }

  /**
   * Verifica a existência de um lojista na tabela lojista
   *
   * @param       integer  $cod_modelo  identificador do lojista
   *
   * @return      bool     booleano da existencia do registro
   */
  public function checkLojista($cod_lojista)
  {
    $query = $this->db->get_where('LOJISTA', array('cod_lojista' => $cod_lojista, 'moip_id !=' => NULL));
    if ($query->num_rows() == 1) {
      return true; //Caso exista o veículo
    } else {
      return false; //Caso não exista
    }
  }

  /**
   * Verifica moip_id do lojista para split
   *
   * @param       integer  $cod_modelo  identificador do lojista
   *
   * @return      bool     booleano da existencia do registro
   */
  public function checkMoipIDLojista($cod_lojista)
  {
    $query = $this->db->get_where('LOJISTA', array('cod_lojista' => $cod_lojista));
    if ($query->num_rows() == 1) {
      if ($query->row_array()['moip_id'] == '' or $query->row_array()['moip_id'] == null) {
        // return '<br /><div class="text-center alert alert-warning">Lojista - <b>' . $query->row_array()['nome_unidade'] . '</b> não possui nenhuma conta Wirecard - Moip vinculada.</div>';
      } else {
        return $query->row_array()['moip_id']; //Caso exista o lojista vinculado
      }
    } else {
      return false; //Caso não exista
    }
  }

  /**
   * Verifica a existência de um lojista de uma regiao na tabela lojista
   *
   * @param       integer  $cod_modelo  identificador do lojista
   *
   * @param       integer  $regiao  identificador da regiao
   *
   * @return      bool     booleano da existencia do registro
   */
  public function checkLojistaRegiao($cod_lojista, $regiao)
  {
    $query = $this->db->get_where('LOJISTA', array('cod_lojista' => $cod_lojista, 'regiao' => $regiao));
    if ($query->num_rows() == 1) {
      return true; //Caso exista o lojista
    } else {
      return false; //Caso não exista
    }
  }

  /**
   * Busaca um registro na tabela VEICULOS_USUARIO
   *
   * @param       int      $codVeiculoUsuario identificador do registro
   *
   * @return      array    $result Informações do registro
   */
  public function verificarVeiculoUsuario($codVeiculoUsuario)
  {
    $query = $this->db->get_where('VEICULOS_USUARIO', $codVeiculoUsuario);
    if ($query->num_rows() == 1) {
      return true; //Caso já exista o veículo
    } else {
      return false; //Caso não exista
    }
  }

  /**
   * Verifica a existência de um registro na tabela VEICULOS_USUARIO
   *
   * @param       array  $veiculoUsuario  infos para busca
   *
   * @return      bool     booleano da existencia do registro
   */
  public function buscarVeiculoUsuario($veiculoUsuario)
  {
    $query = $this->db->get_where('VEICULOS_USUARIO', array('cod_veiculo_usuario' => $veiculoUsuario));
    $result = $query->row_array();
    return $result; //Caso exista o veícul
  }

  /**
   * Insere na tabela VEICULOS_USUARIO
   *
   * @param       array  $veiculoUsuario inormações para inserção
   *
   * @return      integer  Retorna o id do registro inserido
   */
  public function inserirVeiculoUsuario($veiculoUsuario)
  {
    $this->db->insert('VEICULOS_USUARIO', $veiculoUsuario);

    $id = $this->db->insert_id();

    return $id;
  }

  /**
   *  Envia email informando as informações do pedido 
   *
   * @param      array  $data    Informações a serem enviadas por email
   */
  public function sendLogEmailInsignus($data)
  {
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.minharevisao.com.br', //smtp.minharevisao.com.br
      'smtp_port' => 587,
      'smtp_user' => 'envio@minharevisao.com.br', //envio@minharevisao.com.br
      'smtp_pass' => 'Revisao2019@@' //Revisao2018@@###
    );
    $this->email->initialize($config);
    $this->email->set_newline("<br>");
    $dados['data'] = $data;
    $body = $this->load->view('emailLog.php', $dados, TRUE);
    $this->email->subject('LOG MINHA REVISAO');
    $this->email->from('envio@minharevisao.com.br', 'Minha Revisão');
    $this->email->to(array('logs@insignus.com.br'));
    $this->email->set_mailtype("html");
    $this->email->message($body);
    $result = $this->email->send();
    $this->email->clear(TRUE);
    return $result;
  }
}
