<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('email');


        // if ($this->session->logado != 1){
        // 	$json['resultado'] = "erro";
        // 	$json['msg'] = "Necessário realizar o login";
        //        header('Content-Type: application/json');
        //        echo json_encode( $json );
        //        die();
        // redirect(base_url('index'));
        // }

        $this->load->database();
        $this->load->model('Moip_Model', 'mm');
        $this->load->model('Pagseguro_Model', 'ps');
        $this->load->model('Agenda_Model', 'am');
        $this->load->model('Regiao_Model', 'rm');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
    }

    /* public function databasePopulation()
      {
      $this->am->databasePopulation();
      } */

    public function index() {
        $dado['listaMontadoras'] = $this->am->listaGeralMontadoras();
        $dado['listaLojista'] = $this->am->listaGeralLojista();

        if ($this->session->logado == 1) {
            $dado['listaCadastrados'] = $this->am->listaVeiculosCadastrados($_SESSION['userId']); //die();
        }

        $_passo = '1';
        $_desc = array('carro' => null, 'servico' => null, 'local' => null, 'data' => null, 'valor' => null, 'voucher' => null);
        $dado['servicos'] = null;
        $dado['veiculo'] = null;
        $dado['cod_servico'] = null;
        $dado['regiao'] = null;
        $dado['cod_lojista'] = null;
        $dado['data'] = null;
        $dado['periodo'] = null;
        $dado['regioes_list'] = $this->rm->getAll();
        if (isset($_SESSION['veiculo']) && isset($_SESSION['ano']) && isset($_SESSION['km'])) {
            $dado['servicos'] = $this->am->buscarModeloServicos($_SESSION['veiculo']);
            $dado['veiculo'] = $this->am->buscarVeiculo($_SESSION['veiculo']);
            $dado['veiculo']['ano'] = $_SESSION['ano'];
            $dado['veiculo']['km'] = $_SESSION['km'];
            $dado['lista_modelos'] = $this->am->listaGeralModelo($dado['veiculo']['montadora']);
            $dado['lista_motores'] = $this->am->listaGeralMotor($dado['veiculo']['modelo']);
            $_passo = '2';
            $_desc['carro'] = $dado['veiculo']['montadora'] . ' '
                    . $dado['veiculo']['modelo'] . ' '
                    . $dado['veiculo']['motor'] . ' '
                    . '(' . $dado['veiculo']['ano'] . ')';
        }
        if ($this->session->logado == 1) {
            $dado['listaCadastrados'] = $this->am->listaVeiculosCadastrados($_SESSION['userId']); //die();

            if (isset($_SESSION['servico'])) {
                $_passo = '3';
                $dado['cod_servico'] = $_SESSION['servico']['cod_servicos'];
                $_desc['servico'] = $_SESSION['servico']['nome'];
                $_desc['valor'] = 'R$ ' . ($_SESSION['servico']['preco'] / 100) . ',00';
            }
            if (isset($_SESSION['regiao'])) {
                $_passo = '4';
                $dado['regiao'] = $_SESSION['regiao'];
                $dado['listaLojista'] = $this->am->listaGeralLojistaRegiao($_SESSION['regiao']);
                /* echo '<pre>';
                  var_dump($_SESSION);
                  echo '</pre>'; */
            }
            if (isset($_SESSION['data']) && isset($_SESSION['unidade']) && isset($_SESSION['periodo'])) {
                $_passo = '5';
                $dado['cod_lojista'] = $_SESSION['unidade'];
                $dado['data'] = $_SESSION['data'];
                $dado['periodo'] = $_SESSION['periodo'];

                $_desc['data'] = Date('d/m/Y', strtotime($_SESSION['data'])) . ' - ' . ($_SESSION['periodo'] == 1 ? 'Matutino' : 'Vespertino');
                $_desc['local'] = $this->am->buscarLojista($_SESSION['unidade'])['endereco'];
                /* echo '<pre>';
                  var_dump($_SESSION);
                  echo '</pre>'; */
            }
            if (isset($_SESSION['voucher'])) {
                $_passo = '6';
                $_desc['voucher'] = $_SESSION['voucher'];
            }
        }

        $dado['passo'] = $_passo;
        $dado['desc'] = $_desc;
        if (isset($_SESSION['servico']['preco'])) {
            $dado['preco_servico'] = $this->formatoReal($_SESSION['servico']['preco']);
            $_SESSION['preco_servico'] = $this->formatoReal($_SESSION['servico']['preco']);
        }
        /* echo '<pre>';
          var_dump($_SESSION);
          echo '</pre>'; */
        $this->load->view('agenda', $dado);
    }

    function recupera_valor() {

        $dado['preco_servico'] = $this->formatoReal($_SESSION['servico']['preco']);
        $_SESSION['preco_servico'] = $this->formatoReal($_SESSION['servico']['preco']);
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
        echo json_encode(array('valor' => $_SESSION['preco_servico']));
    }

    function transformaMoeda($valor) {

        $novoValor = number_format($valor / 100, 2, ".", "");

        return $novoValor;
    }

    function inteiro_decimal_br($numero) {
        $numero = number_format($numero, 2, '.', '');
        return $numero;
    }

    function colocaPonto($valor) {
        return substr_replace($valor, '.', -2, -2);
    }

    function formatoReal($valor) {
        $valor = $this->colocaPonto($valor);
        return number_format($valor, 2, '.', ',');
    }

    public function AutorizarSplit() {
        $this->ps->Authorizations();
    }

    public function criarSessaoPagSeguro() {
        $this->ps->getSession();
    }
    public function redirectAutoriza() {
        $this->ps->redirectAutoriza($this->input->post('code'));
    }

    /**
     *
     * Envia listagem de pedidos do usuário logado
     *
     */
    public function pedidos($offset = 0) {
        $json['lista'] = $this->am->listaGeral($_SESSION['userId'], $offset);
        if ($json['lista'][0]['num_rows'] != 0) {
            foreach ($json['lista'] as $key => $value) {
                $json['lista'][$key]['status'] = $this->mm->traduzirStatus($value['moip_ultimo_status_payment']);
                $json['lista'][$key]['servico'] = $this->am->buscarServico($json['lista'][$key]['fk_servico']);
            }
            $json['resultado'] = "sucesso";
        } else {
            $json['resultado'] = "nenhum_pedido";
        }


        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * ENvia os dados de um pedido
     *
     */
    public function detalhesPedido($cod_pedido) {
        $json['pedido'] = $this->am->buscarPedido($cod_pedido);

        $json['pedido']['status'] = $this->mm->traduzirStatus($json['pedido']['moip_ultimo_status_payment']);
        $json['pedido']['servico'] = $this->am->buscarServico($json['pedido']['fk_servico']);
        $json['pedido']['modelo'] = $this->am->buscarVeiculo($json['pedido']['servico']['fk_modelo']);
        $json['pedido']['endereco'] = $this->am->buscarLojista($json['pedido']['fk_lojista'])['endereco'];

        $json['resultado'] = "sucesso";

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Salva o veículo
     *
     */
    public function Veiculo() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        //Configuração de validação
        $this->form_validation->set_rules('cod_modelo', 'Código Modelo', 'is_natural|trim|required');
        $this->form_validation->set_rules('ano_carro', 'Ano', 'is_natural|trim|required');
        $this->form_validation->set_rules('km_carro', 'Quilometragem', 'is_natural|trim|required');

        if ($this->form_validation->run() == FALSE) {
            $json['resultado'] = "erro";
            $json['erros'] = $this->form_validation->error_array();
        } else {
            // Verificando se exite um modelo com esse id
            if ($this->am->checkVeiculo($this->input->post('cod_modelo'))) {
                unset($_SESSION['servico']);
                unset($_SESSION['regiao']);
                unset($_SESSION['data']);
                unset($_SESSION['unidade']);
                unset($_SESSION['periodo']);
                unset($_SESSION['voucher']);
                $_SESSION['veiculo'] = $this->input->post('cod_modelo');
                $_SESSION['ano'] = $this->input->post('ano_carro');
                $_SESSION['km'] = $this->input->post('km_carro');
                $veiculo = $this->am->buscarVeiculo($this->input->post('cod_modelo'));

                // INSERIR NA TABELA VEICULOS USUARIO
                if ($this->session->logado) { //Verificando se há um usuario logado
                    // verificando se o modelo selecionado já está relacionado ao usuario
                    $veiculoUsuario = array(
                        'fk_modelo' => $this->input->post('cod_modelo'),
                        'fk_usuario' => $_SESSION['userId'],
                        'ano_carro_cadastro' => $_SESSION['ano']
                    );
                    if (!$this->am->verificarVeiculoUsuario($veiculoUsuario)) {
                        $this->am->inserirVeiculoUsuario($veiculoUsuario);
                    }
                }

                $json['lista'] = $this->am->buscarModeloServicos($this->input->post('cod_modelo'));
                $json['customizado'] = $veiculo['customizado'];
                $_SESSION['servico_consulta'] = $veiculo['customizado'];
                //$json['lista'] = $this->am->listaGeral($_SESSION['userId']);buscarModeloServicos
                $json['resultado'] = "sucesso";
            } else {
                $json['resultado'] = "erro";
                $json['erros'] = array('Registro de veículo inexistente');
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Salva o serviço
     *
     */
    public function Servico() {
        // verificando se o cod do serviço é integer
        if (strval($this->input->post('cod_servico')) === strval(intval($this->input->post('cod_servico')))) {
            // VERIFICANDO SE O USUÁRIO ESTÁ LOGADO
            if ($this->input->post('cod_servico') == 0) {
                $_SESSION['servicoConsulta'] = $this->input->post('servico_consulta_tipo');
                $json['servicoConsulta'] = true;
                $json['servicotipo'] = $_SESSION['servicoConsulta'];
                $json['resultado'] = "sucesso";
            } else {
                $servico = $this->am->buscarServico($this->input->post('cod_servico'));
                unset($_SESSION['regiao']);
                unset($_SESSION['data']);
                unset($_SESSION['unidade']);
                unset($_SESSION['periodo']);
                unset($_SESSION['voucher']);
                $_SESSION['servico'] = $servico;
                $json['servicoConsulta'] = false;
                $json['servico'] = $_SESSION['servico'];
                $json['resultado'] = "sucesso";
            }
        } else {
            $json['resultado'] = "erro";
            $json['msg'] = "Código do serviço não possui valor válido.";
        }

        if ($this->session->logado != 1) {
            $json['resultado'] = "erro";
            $json['errType'] = "login";
            $json['msg'] = "Necessário realizar o login";

            header('Content-Type: application/json');
            echo json_encode($json);

            die();
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Salva a regiao
     *
     */
    public function Regiao() {
        // VERIFICANDO SE O USUÁRIO ESTÁ LOGADO
        if ($this->session->logado != 1) {
            $json['resultado'] = "erro";
            $json['errType'] = "login";
            $json['msg'] = "Necessário realizar o login";

            header('Content-Type: application/json');
            echo json_encode($json);

            die();
        }
        $regiao = $this->rm->getById($this->input->post('regiao'));
        if ($regiao == null) {
            $json['resultado'] = "erro";
            $json['errType'] = "regiao";
            $json['msg'] = "Região não existente";

            header('Content-Type: application/json');
            echo json_encode($json);

            die();
        }
        unset($_SESSION['data']);
        unset($_SESSION['unidade']);
        unset($_SESSION['periodo']);
        unset($_SESSION['voucher']);
        $_SESSION['regiao'] = $regiao['cod_regiao'];

        //POR REGIAO
        $json['listaLojista'] = $this->am->listaGeralLojistaRegiaoComContaMoip($regiao['cod_regiao']);

        $json['regiao'] = $_SESSION['regiao'];
        $json['resultado'] = "sucesso";

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Verifica quais são os períodos permitidos pela unidade
     *
     */
    public function UnidadeRegiao() {

        $existeUnidade = 0;

        //Se unidade for int, verificar se existe no banco
        if (strval($this->input->post('unidade')) === strval(intval($this->input->post('unidade')))) {
            $existeUnidade = $this->am->checkLojista($this->input->post('unidade'));
        }



        if ($existeUnidade) { //POR REGIAO
            $json['periodo'] = $this->am->buscarLojista($this->input->post('unidade'))['horario'];

            $json['resultado'] = "sucesso";
        } else {

            $json['resultado'] = "erro";

            $json['msg'] = "Unidade inexistente";
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /** Criada em: 14/11/2018
     * UTLIZADA PARA TRADUZIR AS ABREVIATURAS DOS MESES, EX: SEP->SET, DEC->DEZ
     * Pois a função date_format() retorna a abreviatura no formato inglês(dec) e o excel insere no formato português(dez)
     * Inspirada na função str_replace_assoc()
     */
    function str_replace_abrev_mes($subject) {
        $replace = array('feb' => 'fev', 'apr' => 'abr', 'may' => 'mai', 'aug' => 'ago', 'sep' => 'set', 'oct' => 'out', 'dec' => 'dez');
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }

    /**
     *
     * Salva o periodo
     *
     */
    public function periodo() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        // VERIFICANDO SE O USUARIO ESTA LOGADO
        if ($this->session->logado != 1) {
            $json['resultado'] = "erro";
            $json['errType'] = "login";
            $json['msg'] = "Necessário realizar o login";
            header('Content-Type: application/json');
            echo json_encode($json);
            die();
        }

        //Configuração de validação
        $this->form_validation->set_rules('data', 'Data do agendamento', 'trim|required');
        $this->form_validation->set_rules('unidade', 'Unidade', 'trim|required');
        $this->form_validation->set_rules('periodo', 'Período', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $json['resultado'] = "erro";
            $json['erros'] = $this->form_validation->error_array();
        } else {
            $inputed_date = $this->input->post('data');
            //Configuração das datas para comparar posteriormente
            setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            $dataAgendamento = DateTime::createFromFormat('Y-m-d', $inputed_date, new DateTimeZone('America/Sao_Paulo'));
            if (!$dataAgendamento) {
                $dataAgendamento = DateTime::createFromFormat('d/m/Y', $inputed_date, new DateTimeZone('America/Sao_Paulo'));
                $var_aux = str_replace('/', '-', $this->input->post('data'));
                $inputed_date = date('Y-m-d', strtotime($var_aux));
            }
            $dataAgora = DateTime::createFromFormat('Y-m-d', date('Y-m-d'), new DateTimeZone('America/Sao_Paulo'));
            $d = DateTime::createFromFormat('Y-m-d', $inputed_date);

            // VERIFICAR DIA DA SEMANA DA AGENDA
            if ($dataAgendamento && $dataAgendamento->format('Y-m-d') === $inputed_date) {
                $diaSemana = $dataAgendamento->format('D');
                $diaUtil = $diaSemana == 'Sun' ? false : true;
                $existeUnidade = 0;
            } else {
                $diaSemana = false;
                $diaUtil = $diaSemana == 'Sun' ? false : true;
                $existeUnidade = 0;
            }

            // VERIFICANDO SE DIA DO AGENDAMENTO É FERIADO COM BASE NA PLANILHA DE FERIADOS
            $isFeriado = false;
            $diaMesAgendamento = $this->str_replace_abrev_mes(strtolower(date_format($dataAgendamento, 'd/M'))); //Formatando data, ex: 02/11/2018 -> 02/nov
            $planilhaFeriados = fopen(base_url("assets/files/feriados.csv"), 'r'); //Lendo planilha com feriados(assets/files/feriados.csv)
            while (($line = fgetcsv($planilhaFeriados)) !== false) {
                $feriado = $line[0];
                if ($diaMesAgendamento == $feriado) {
                    $isFeriado = true;
                }
            }
            fclose($planilhaFeriados); //Fechando planilha com feriados(assets/files/feriados.csv)
            //Se unidade for int, verificar se existe no banco
            if (strval($this->input->post('unidade')) === strval(intval($this->input->post('unidade')))) {
                $existeUnidade = $this->am->checkLojista($this->input->post('unidade'));
            }

            $regiaoEspecificada = 0;
            $checkPeriodo = 0;

            //Se existe unidade, verificar se é da região especificada
            if ($existeUnidade) {
                if ($this->input->post('periodo') == 1 || $this->input->post('periodo') == 2)
                    $checkPeriodo = ($this->am->buscarLojista($this->input->post('unidade'))['horario'] == 3 || $this->am->buscarLojista($this->input->post('unidade'))['horario'] == $this->input->post('periodo')) ? true : false;

                // Verificando se a agenda é no sábado e se a unidade recebe agendamentos no sábado
                $atendimento_sabado = $this->am->buscarLojista($this->input->post('unidade'))['atendimento_sabado'];
                if ($diaUtil and ( $diaSemana == 'Sat')) {
                    if ($atendimento_sabado == 1) {
                        $agenda_sabado = true;
                        if ($this->input->post('periodo') == 1) {
                            $sabado_manha = true;
                            $diaUtil = true;
                        } else {
                            $sabado_manha = false;
                            $diaUtil = false;
                        }
                    } else {
                        $sabado_manha = true; /* <- apenas para apresentação da mensagem */
                        $agenda_sabado = false;
                        $diaUtil = false;
                    }
                } else {
                    $agenda_sabado = true;
                    $sabado_manha = true; /* <- apenas para apresentação da mensagem */
                }

                $regiaoEspecificada = $this->am->checkLojistaRegiao($this->input->post('unidade'), $_SESSION['regiao']);
            }
            $possivelAgendar = 0;
            //Se for uma data válida e posterior a data de hoje
            if ($d && $d->format('Y-m-d') === $inputed_date && $dataAgendamento >= $dataAgora && $existeUnidade && $regiaoEspecificada && $checkPeriodo && $diaUtil && (!$isFeriado)) {
                $dataFormatada = empty($inputed_date) ? NULL : $inputed_date;

                //Verifica se há disponibilidade daquela unidade no periodo e data especificado
                if ($this->am->verificarDisponibilidadeDaUnidade($this->input->post('unidade'), $dataFormatada, $this->input->post('periodo')))
                    $possivelAgendar = 1;
            }

            //Se for uma data válida e posterior a data de hoje
            if ($possivelAgendar) {
                unset($_SESSION['voucher']);

                //Salvar as informações na session
                $_SESSION['data'] = $inputed_date;
                $_SESSION['unidade'] = $this->input->post('unidade');
                $_SESSION['periodo'] = $this->input->post('periodo');

                //Salvar as informações de envio
                $json['servico'] = $_SESSION['servico'];
                $json['unidade'] = $this->am->buscarLojista($_SESSION['unidade']);
                $json['modelo'] = $this->am->buscarVeiculo($_SESSION['servico']['fk_modelo']);
                $json['modelo']['ano'] = $_SESSION['ano'];
                $json['data'] = $_SESSION['data'];
                $json['periodo'] = $_SESSION['periodo'];
                $json['resultado'] = "sucesso";
            } else {
                $json['resultado'] = "erro";

                if (!($d && $d->format('Y-m-d') === $inputed_date))
                    $json['msg'] = "Formato de data errado"; //"Não é possível agendar para uma data anterior a hoje";
                else if (!($dataAgendamento >= $dataAgora))
                    $json['msg'] = "Não é possível agendar para uma data anterior a hoje";
                else if (!$existeUnidade)
                    $json['msg'] = "Unidade inexistente";
                else if (!$regiaoEspecificada)
                    $json['msg'] = "Unidade inexistente na regiao";
                else if (!$checkPeriodo)
                    $json['msg'] = "Período inválido";
                else if ($isFeriado)
                    $json['msg'] = "Agendamentos não disponíveis em feriados.";
                else if (!$sabado_manha)
                    $json['msg'] = "Agendamentos aos sábados apenas no período da manhã.";
                else if (!$agenda_sabado)
                    $json['msg'] = "Não é possível realizar agendamento para o sábado nessa unidade.";
                else if (!$diaUtil)
                    $json['msg'] = "Não é possível realizar agendamento para o domingo.";
                else if (!$possivelAgendar)
                    $json['msg'] = "Agenda cheia para esse período, selecione outro ou mude a data";
            }
        }

        header('Content-Type: application/json');
        //echo '<script>window.location.reload()</script>';
        echo json_encode($json);
    }

    /**
     *
     * Pesquisa Modelos listaCadastrados
     *
     */
    public function Cadastrado() {
        $veiculoUsuario = $this->am->buscarVeiculoUsuario($this->input->post("cadastrado"));
        $cadastrado = $this->am->buscarVeiculo($veiculoUsuario['fk_modelo']);
        $cadastrado['ano_cadastrado'] = $veiculoUsuario['ano_carro_cadastro'];

        $json['cadastrado'] = $cadastrado;
        $json['lista_montadoras'] = $this->am->listaGeralMontadoras();
        $json['lista_modelos'] = $this->am->listaGeralModelo($cadastrado['montadora']);
        $json['lista_motores'] = $this->am->listaGeralMotor($cadastrado['modelo']);
        $json['resultado'] = "sucesso";

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Pesquisa Montadoras
     *
     */
    public function Montadora() {


        $json['lista'] = $this->am->listaGeralMontadoras();
        $json['resultado'] = "sucesso";

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Pesquisa Montadoras
     *
     */
    public function Consulta() {

        $this->load->helper('form');
        $this->load->library('form_validation');

        //Configuração de validação
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
        $this->form_validation->set_rules('unidade', 'Unidade', 'trim|required|is_natural');
        $this->form_validation->set_rules('data', 'Data', 'trim|required');
        $this->form_validation->set_rules('montadora', 'Montadora', 'trim|required');
        $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
        $this->form_validation->set_rules('motor', 'Motor', 'trim|required');
        $this->form_validation->set_rules('ano', 'Ano', 'trim|required');
        $this->form_validation->set_rules('quilometragem', 'Quilometragem', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $json['resultado'] = "erro";
            $json['erros'] = $this->form_validation->error_array();
        } else {
            $email_data = array();
            $email_data['usuario'] = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'telefone' => $this->input->post('telefone')
            );
            $email_data['veiculo'] = array(
                'montadora' => $this->input->post('montadora'),
                'modelo' => $this->input->post('modelo'),
                'motor' => $this->input->post('motor'),
                'ano' => $this->input->post('ano'),
                'quilometragem' => $this->input->post('quilometragem')
            );
            $email_data['unidade'] = $this->am->buscarLojista($this->input->post('unidade'));
            $email_data['data'] = date('d/m/Y', strtotime($this->input->post('data')));
            $email_data['operation_system'] = $this->input->post('os');

            $result = $this->am->EnviarEmailConsulta($email_data);

            if ($result) {
                $json['resultado'] = "sucesso";
            } else {
                $json['resultado'] = "erro";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Pesquisa Modelos
     *
     */
    public function Modelo() {

        $json['lista'] = $this->am->listaGeralModelo($this->input->post('montadora'));
        $json['resultado'] = "sucesso";

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Pesquisa Motores
     *
     */
    public function Motor() {


        $json['lista'] = $this->am->listaGeralMotor($this->input->post('modelo'));
        $json['resultado'] = "sucesso";

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Pesquisa Modelos
     *
     */
    public function Data($Data) {
        $this->Format = explode(' ', $Data);
        $this->Data = explode('/', $this->Format[0]);

        if (empty($this->Format[1])):
            $this->Format[1] = date('H:i:s');
        endif;

        $this->Data = $this->Data[2] . '-' . $this->Data[1] . '-' . $this->Data[0];
        return $this->Data;
    }

    public function checkout() {
        //$_POST['nascimento'] = $this->Data($_POST['nascimento']);
        $user = $this->am->buscarUsuario($this->session->userId);

        $agenda['data'] = empty($_SESSION['data']) ? NULL : date("Y-m-d", strtotime(str_replace('/', '-', $_SESSION['data'])));
        $agenda['periodo'] = $_SESSION['periodo'];

        $voucher = $this->am->GerarVoucher();
        $_SESSION['voucher'] = $voucher;

        $servico = $_SESSION['servico'];

        // Criando registro de novo agendamento
        $agenda['fk_usuario'] = $_SESSION['userId'];
        $agenda['fk_servico'] = $servico['cod_servicos'];
        $agenda['fk_lojista'] = $_SESSION['unidade'];
        $agenda['ano_carro'] = $_SESSION['ano'];
        $agenda['km_carro'] = $_SESSION['km'];
        $agenda['voucher'] = $voucher;
        $cod_agenda = $this->am->inserir($agenda);
        $agenda['cod_agenda'] = $cod_agenda;



        $datas['token'] = '';
        $datas['currency'] = 'BRL';

        $datas['payment.mode'] = 'default';
        $datas['payment.method'] = 'creditCard';



        $datas['item[1].id'] = $_SESSION['servico']['cod_servicos'];
        $datas['item[1].description'] = $_SESSION['servico']['nome'];
        $datas['item[1].amount'] = $this->colocaPonto($_SESSION['servico']['preco']);
        $datas['item[1].quantity'] = 1;

        $datas['reference'] = time() . '_' . $agenda['cod_agenda'];


        $datas['sender.name'] = $this->session->nome;
        $datas['sender.CPF'] = $this->PT_limpaCPF_CNPJ($this->input->post('cpf'));
        $datas['sender.areaCode'] = $this->DDD($this->session->telefone);
        $datas['sender.phone'] = $this->FONE($this->session->telefone);
        $datas['sender.email'] = $this->session->email;
        $datas['sender.hash'] = $this->input->post('hashCard');

        $datas['shipping.address.street'] = $user['rua'];
        $datas['shipping.address.number'] = $user['numero_casa'];
        $datas['shipping.address.complement'] = $user['complemento'];
        $datas['shipping.address.district'] = $user['bairro'];
        $datas['shipping.address.postalCode'] = $this->PT_limpaCPF_CNPJ($user['cep']);
        $datas['shipping.address.city'] = $user['cidade'];
        $datas['shipping.address.state'] = $user['estado'];
        $datas['shipping.address.country'] = 'BRA';

        $datas['shipping.type'] = 3;
        $datas['shipping.cost'] = (float) 0;
        $datas['installment.quantity'] = $this->input->post('installments');
        $datas['installment.value'] = $this->input->post('valor_installments');
        $datas['installment.noInterestInstallmentQuantity'] = 3;

        $datas['creditCard.token'] = $this->input->post('token_cartao');
        $datas['creditCard.holder.name'] = (!$this->input->post('holder_name')) ? 'jose a m maciel' : $this->input->post('holder_name');
        $datas['creditCard.holder.CPF'] = $this->input->post('cpf');
        $datas['creditCard.holder.birthDate'] = $this->input->post('nascimento');
        $datas['creditCard.holder.areaCode'] = $this->DDD($_SESSION['telefone']);
        $datas['creditCard.holder.phone'] = $this->FONE($_SESSION['telefone']);

        $datas['billingAddress.street'] = $user['rua'];
        $datas['billingAddress.number'] = $user['numero_casa'];
        $datas['billingAddress.complement'] = $user['complemento'];
        $datas['billingAddress.district'] = $user['bairro'];
        $datas['billingAddress.postalCode'] = $this->PT_limpaCPF_CNPJ($user['cep']);
        $datas['billingAddress.city'] = $user['cidade'];
        $datas['billingAddress.state'] = $user['estado'];
        $datas['billingAddress.country'] = 'BRA';

        if (isset($_SESSION['ID_VOLANTY'])) {
            $datas['primaryReceiver.publicKey'] = 'PUB5AEC2CD7637B48D78D04CD731574AE29';
            $datas['receiver[1].publicKey'] = 'PUB5AEC2CD7637B48D78D04CD731574AE29';
            $datas['receiver[1].split.amount'] = ($servico['preco'] * 15) / 100;

            $datas['receiver[2].publicKey'] = '';
            $datas['receiver[2].split.amount'] = ($servico['preco'] * 10) / 100;
            /* $pedido['volanty_id'] = $_SESSION['ID_VOLANTY'];
              $pedido['volanty_valor_a_receber'] = ($servico['preco'] * 10) / 100;
              $pedido['marketplace_valor_a_receber'] = ($servico['preco'] * 15) / 100; */
        } elseif (isset($_SESSION['ID_NUMENU'])) {

            $datas['primaryReceiver.publicKey'] = 'PUB5AEC2CD7637B48D78D04CD731574AE29';
            $datas['receiver[1].publicKey'] = 'PUB5AEC2CD7637B48D78D04CD731574AE29';
            $datas['receiver[1].split.amount'] = ($servico['preco'] * 15) / 100;

            $datas['receiver[2].publicKey'] = 'PUB8616322D08C6469ABA54F4EDC4FECFA7';
            $datas['receiver[2].split.amount'] = ($servico['preco'] * 10) / 100;
            /* $pedido['numenu_id'] = $_SESSION['ID_NUMENU'];
              $pedido['numenu_valor_a_receber'] = ($servico['preco'] * 10) / 100;
              $pedido['marketplace_valor_a_receber'] = ($servico['preco'] * 15) / 100; */
        } else {
            /* volanty */
            /* $pedido['volanty_id'] = null;
              $pedido['volanty_valor_a_receber'] = 0;

              /* numenu */
            /* $pedido['numenu_id'] = null;
              $pedido['numenu_valor_a_receber'] = 0;
              $pedido['marketplace_valor_a_receber'] = ($servico['preco'] * 25) / 100; */

            /* a unidade recebe 75%, a plataforma recebe 25% */
            /* a unidade recebe 75%, volanty recebe 10%, plataforma recebe 15% */
            /* a unidade recebe 75%, nomenu recebe 7%, plataforma recebe 18% */

            $datas['primaryReceiver.publicKey'] = 'PUB5AEC2CD7637B48D78D04CD731574AE29';
            $datas['receiver[1].publicKey'] = 'PUB8616322D08C6469ABA54F4EDC4FECFA7';
            $datas['receiver[1].split.amount'] = ($servico['preco'] * 25) / 100;

            /* $datas['receiver[2].publicKey'] = 'PUB8616322D08C6469ABA54F4EDC4FECFA7';
              $datas['receiver[2].split.amount'] = ($servico['preco'] * 25) / 100; */
        }



        $datas['redirectURL'] = '';
        $datas['notificationURL'] = '';

        $buildQuery = http_build_query($datas);
        $result = $this->ps->Transaction($buildQuery);

        echo '<pre>';
        var_dump($_POST, $_SESSION, $datas, $result);
        echo '</pre>';
    }

    function DDD($fone) {
        $explode = explode(")", $fone);
        $dedede = $explode[0];
        return $this->PT_limpaCPF_CNPJ($dedede);
    }

    function FONE($fone) {
        $explode = explode(")", $fone);
        $fone = $explode[1];
        return $this->PT_limpaCPF_CNPJ($fone);
    }

    function PT_limpaCPF_CNPJ($valor) {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("_", "", $valor);
        $valor = str_replace("/", "", $valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace(" ", "", $valor);
        return $valor;
    }

    function notification() {
        
    }

    public function Pagamento() {
        //Load de validação
        $this->load->helper('form');
        $this->load->helper('validation_custom_helper');
        $this->load->library('form_validation');

        if ($this->session->logado != 1) {
            $json['resultado'] = "erro";
            $json['errType'] = "login";
            $json['msg'] = "Necessário realizar o login";

            header('Content-Type: application/json');
            echo json_encode($json);

            die();
        }
        $json = array();


        //Configuração de validação
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('hash', 'Cartão de crédito', 'trim|required');
        $this->form_validation->set_rules('installments', 'Parcelamento', 'integer|trim|required');
        $this->form_validation->set_rules('nascimento', 'Nascimento', 'trim|required|validateDate');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|validateCPF');

        //Se os dados estiverem incorretos enviar json informando os erros
        if ($this->form_validation->run() == FALSE) {
            $json['resultado'] = "erro";
            $json['erros'] = $this->form_validation->error_array();
        } else {
            //Se os dados estiverem corretos, inserir informações no banco e enviar json com resultado
            //gerado no sandbox com a conta insignus


            $agenda['data'] = empty($_SESSION['data']) ? NULL : date("Y-m-d", strtotime(str_replace('/', '-', $_SESSION['data'])));
            $agenda['periodo'] = $_SESSION['periodo'];

            $voucher = $this->am->GerarVoucher();
            $_SESSION['voucher'] = $voucher;

            $servico = $_SESSION['servico'];

            // Criando registro de novo agendamento
            $agenda['fk_usuario'] = $_SESSION['userId'];
            $agenda['fk_servico'] = $servico['cod_servicos'];
            $agenda['fk_lojista'] = $_SESSION['unidade'];
            $agenda['ano_carro'] = $_SESSION['ano'];
            $agenda['km_carro'] = $_SESSION['km'];
            $agenda['voucher'] = $voucher;
            $cod_agenda = $this->am->inserir($agenda);
            $agenda['cod_agenda'] = $cod_agenda;

            $usuarioLogado = $this->am->buscarUsuario($this->session->userId);

            // Criando ORDER para a MOIP
            $pedido['cod_agenda'] = $agenda['cod_agenda'];
            $pedido['servico_nome'] = $servico['nome'];
            $pedido['servico_preco'] = $servico['preco'];
            $pedido['usuario_nome'] = $_SESSION['nome'];
            $pedido['usuario_email'] = $_SESSION['email'];
            $pedido['cpf'] = $usuarioLogado['cpf'];
            $pedido['street'] = $usuarioLogado['rua'];
            $pedido['streetNumber'] = $usuarioLogado['numero_casa'];
            $pedido['district'] = $usuarioLogado['bairro'];
            $pedido['city'] = $usuarioLogado['cidade'];
            $pedido['state'] = $usuarioLogado['estado'];
            $pedido['zipCode'] = $usuarioLogado['cep'];
            $pedido['marketplace_id'] = MARKETPLACE_ID;
            if (isset($_SESSION['ID_VOLANTY'])) {
                $pedido['volanty_id'] = $_SESSION['ID_VOLANTY'];
                $pedido['volanty_valor_a_receber'] = ($servico['preco'] * 10) / 100;
                $pedido['marketplace_valor_a_receber'] = ($servico['preco'] * 15) / 100;
            } elseif (isset($_SESSION['ID_NUMENU'])) {
                $pedido['numenu_id'] = $_SESSION['ID_NUMENU'];
                $pedido['numenu_valor_a_receber'] = ($servico['preco'] * 10) / 100;
                $pedido['marketplace_valor_a_receber'] = ($servico['preco'] * 15) / 100;
            } else {
                /* volanty */
                $pedido['volanty_id'] = null;
                $pedido['volanty_valor_a_receber'] = 0;

                /* numenu */
                $pedido['numenu_id'] = null;
                $pedido['numenu_valor_a_receber'] = 0;
                $pedido['marketplace_valor_a_receber'] = ($servico['preco'] * 25) / 100;
            }
            $pedido['seller_id'] = $this->am->buscarLojista($_SESSION['unidade'])['moip_id'];
            $pedido['seller_valor_a_receber'] = ($servico['preco'] * 75) / 100;
            $orderMoip = $this->mm->createOrder($pedido, ACCESS_TOKEN_MOIP);

            // Envia e-mail de log com a ORDER gerada
            $this->am->sendLogEmailInsignus($orderMoip);

            //Se o moip não retornar erro, criar pagamento
            if (array_key_exists('errors', $orderMoip)) {

                $json['resultado'] = "erro";
                $json['erros'] = array_map(function ($value) {
                    return $value['description'];
                }, $orderMoip['errors']);

                header('Content-Type: application/json');
                echo json_encode($json);
                die();
            }

            // Adiciona informações da ORDER ao registro da agenda
            $agenda['moip_order_id'] = $orderMoip['id'];
            $agenda['moip_ultimo_status_order'] = $orderMoip['status'];
            $this->am->update($agenda);

            // Cria o PAYMENT para a moip
            $pagamento['order_id'] = $agenda['moip_order_id'];
            $pagamento['parcelas'] = $this->input->post('installments');
            $pagamento['hash_cc'] = $this->input->post('hash');
            $pagamento['nome_cc'] = $this->input->post('nome');
            $pagamento['nasc_cc'] = empty($this->input->post('nascimento')) ? NULL : date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('nascimento')))); //$this->input->post('nascimento');
            $pagamento['cpf'] = $this->input->post('cpf');
            $paymentMoip = $this->mm->createPayment($pagamento, ACCESS_TOKEN_MOIP);

            // Envia email de log com PAYMENT gerado
            $this->am->sendLogEmailInsignus($paymentMoip);

            //Se o moip não retornar erro, salvar informações do pedido criado
            if (array_key_exists('errors', $paymentMoip)) {
                $json['resultado'] = "erro";
                $json['erros'] = array_map(function ($value) {
                    return $value['description'];
                }, $paymentMoip['errors']);
            } else {

                // Adiciona informações do PAYMENT ao registro da agenda
                $agenda['moip_ultimo_payment_id'] = $paymentMoip['id'];
                $agenda['moip_ultimo_status_payment'] = $paymentMoip['status'];
                $result = $this->am->update($agenda);

                $emailLojista = $this->am->buscarLojista($agenda['fk_lojista'])['email_contato'];
                $emailUsuario = $this->am->buscarUsuario($agenda['fk_usuario'])['email'];

                if ($result) {
                    // Recebe o sistema operacional onde foi realizada a compra
                    $agenda['operation_system'] = $this->input->post('os');

                    //envia email com voucher
                    $emails_adicionais = [];
                    if (isset($_SESSION['ID_VOLANTE'])) {
                        $emails_adicionais = ['ricardo@volanty.com', 'joao@volanty.com'];
                    } elseif (isset($_SESSION['ID_NUMENU'])) {
                        $emails_adicionais = ['bruno@minharevisao.com.br'];
                    }
                    $this->am->EnviarEmailPagamento($agenda, $emailLojista, $emailUsuario, $emails_adicionais);

                    // Retorna as informações da agenda para o ajax
                    $json['usuario'] = $this->am->buscarUsuario($agenda['fk_usuario']);
                    $json['unidade'] = $this->am->buscarLojista($agenda['fk_lojista']);
                    $json['servico'] = $this->am->buscarServico($agenda['fk_servico']);
                    $json['voucher'] = $_SESSION['voucher'];
                    $json['data_agenda'] = date('d/m/Y', strtotime($_SESSION['data']));
                    $veiculo = $this->am->buscarVeiculo($servico['fk_modelo']);
                    $veiculo['ano'] = $_SESSION['ano'];
                    $json['veiculo'] = $veiculo;
                    $json['resultado'] = "sucesso";
                } else {
                    $json['resultado'] = "erro";
                }
            }
        }


        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function buscarUnidadePorRegiao() {
        $json = array();
        $regiao = $this->input->post('regiao');
        $lista_lojistas = $this->am->listaGeralLojistaRegiaoComContaMoip($regiao);
        if (sizeof($lista_lojistas) > 0) {
            $json['resultado'] = 'sucesso';
            $json['lista_lojistas'] = $lista_lojistas;
        } else {
            $json['resultado'] = 'erro';
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /**
     *
     * Salva evento
     *
     */
    public function moipWebhook() {
        //$server1 = "";
        //foreach ($_SERVER as $name => $value) {
        //    $server1 .= "$name: $value\n";
        // }

        $header = getallheaders();

        //foreach (getallheaders() as $name => $value) {
        //    $header .= "$name: $value\n";
        // }

        $tokenAuthorization = $header['Authorization'];

        //Se for um alerta assinado com o mesmo token da preferencia de notificações salva
        if (WEBHOOK_TOKEN_MOIP == $tokenAuthorization) {

            //Recebe o corpo da notificação
            $json = file_get_contents('php://input');
            //transforma de json para array
            $notificacao = json_decode($json, true);

            //Separa o tipo de notificação, order ou paymente, e o tipo de status
            $eventType = explode(".", $notificacao['event'])[0];
            $eventStatus = explode(".", $notificacao['event'])[1];

            //Se for pedido
            if ($eventType == "ORDER") {

                //pega o moip id
                $orderId = $notificacao['resource']['order']['id'];
                //pega a agenda baseada no id do pedido
                $agenda = $this->am->buscarAgendaPorPedido($orderId);

                //Se o tipo de status tiver prioridade(baseado no valor das constantes com o mesmo nome do status) maior, salvar.
                if (constant($eventStatus) >= constant($agenda['moip_ultimo_status_order'])) {
                    $agenda['moip_ultimo_status_order'] = $eventStatus;
                    $this->am->update($agenda);
                }

                //Verifica token 059a3fafdbef46e8a6847d2afea11eaf
                $atualizacao['descricao'] = "ORDER ID " . $orderId . " STATUS " . $eventStatus;
            }

            //Se for pagamento
            if ($eventType == "PAYMENT") {

                //pega o moip id
                $paymentId = $notificacao['resource']['payment']['id'];
                //pega a agenda baseada no id do pagamento
                $agenda = $this->am->buscarAgendaPorPagamento($paymentId);

                //Se o tipo de status tiver prioridade(baseado no valor das constantes com o mesmo nome do status) maior, salvar.
                if (constant($eventStatus) >= constant($agenda['moip_ultimo_status_payment'])) {
                    $agenda['moip_ultimo_status_payment'] = $eventStatus;
                    $this->am->update($agenda);
                }

                //Se o pagamento tiver sido realizado, enviar email
                if ($eventStatus == "AUTHORIZED") {

                    $emailLojista = $this->am->buscarLojista($agenda['fk_lojista'])['email_contato'];
                    $emailUsuario = $this->am->buscarUsuario($agenda['fk_usuario'])['email'];

                    $this->am->EnviarEmailPagamento($agenda, $emailLojista, $emailUsuario);
                }

                //Verifica token 059a3fafdbef46e8a6847d2afea11eaf
                $atualizacao['descricao'] = "PAYMENT ID " . $paymentId . " STATUS " . $eventStatus;
            }


            $this->db->insert('teste_log', $atualizacao);

            http_response_code(200);
        }
    }

}
