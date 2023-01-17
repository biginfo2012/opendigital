<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Volantyrevisao extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->library('email');
    $this->load->database();
    $this->load->model('Moip_Model', 'mm');
    $this->load->model('Agenda_Model', 'am');
    $this->load->model('Workflow_Model', 'wm');
    $this->load->model('login_Model', 'lm');
    
  }

  public function index()
  {
    $_SESSION['ID_VOLANTY'] = 'MPA-69FADAC7DD3F';
    $this->load->view('volantyrevisao/index');
  }

  public function agenda()
  {
    $dado['listaMontadoras'] = $this->am->listaGeralMontadoras();
    $dado['listaLojista'] = $this->am->listaGeralLojista();
    $_passo = '1';
    $_desc = array('carro' => null, 'servico' => null, 'local' => null, 'data' => null, 'valor' => null, 'voucher' => null);
    $dado['servicos'] = null;
    $dado['veiculo'] = null;
    $dado['cod_servico'] = null;
    $dado['regiao'] =  null;
    $dado['cod_lojista'] =  null;
    $dado['data'] = null;
    $dado['periodo'] = null;
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
        $dado['listaLojista'] = $this->am->listaGeralLojistaRegiaoComContaMoip($_SESSION['regiao']);
      }
      if (isset($_SESSION['data']) && isset($_SESSION['unidade']) && isset($_SESSION['periodo'])) {
        $_passo = '5';
        $dado['cod_lojista'] =  $_SESSION['unidade'];
        $dado['data'] = $_SESSION['data'];
        $dado['periodo'] = $_SESSION['periodo'];

        $_desc['data'] = Date('d/m/Y', strtotime($_SESSION['data'])) . ' - ' . ($_SESSION['periodo'] == 1 ? 'Matutino' : 'Vespertino');
        $_desc['local'] = $this->am->buscarLojista($_SESSION['unidade'])['endereco'];
      }
      if (isset($_SESSION['voucher'])) {
        $_passo = '6';
        $_desc['voucher'] = $_SESSION['voucher'];
      }
    }

    $dado['passo'] = $_passo;
    $dado['desc'] = $_desc;
    $this->load->view('volanty/agenda', $dado);
  }

  public function cadastro()
  {
    $this->load->view('volanty/cadastro');
  }

  public function acessar()
  {
    $this->load->view('volanty/login');
  }


  public function perfil()
  {
    if ($this->session->logado == 1) {
      $resultado = $this->lm->buscarPorId($_SESSION['userId']);
      if ($resultado != null) {
        $data['usuario'] = $resultado;
        $this->load->view('volanty/perfil', $data);
      } else {
        header('Location: ' . base_url('volanty/acessar'));
      }
    } else {
      header('Location: ' . base_url('volanty/acessar'));
    }
  }

  public function login()
  {
    // Login
    $user =  $this->input->post('user');
    $senha = $this->input->post('senha');

    // Valida no banco
    $resultado = $this->lm->buscar($user, $senha);

    if ($resultado == null) {
      header('Location: ' . base_url('volanty/acessar'));
    } else {
      $_SESSION['userId'] = $resultado->cod_login;
      $_SESSION['admin'] = $resultado->tipo;
      $_SESSION['logado'] = 1;
      $_SESSION['ID_VOLANTY'] = 'MPA-69FADAC7DD3F';
      
      $_SESSION['nome'] =  $resultado->nome;
      $_SESSION['email'] =  $resultado->email;
      $_SESSION['telefone'] =  $resultado->telefone_contato;

      if ($this->input->post('ajax') == 1) {
        $json['resultado'] = 'sucesso';
        header('Content-Type: application/json');
        echo json_encode($json);
      } else {
        header('Location: ' . base_url('volanty/agenda'));
      }
    }
  }

  public function logout()
  {
    $volanty = isset($_SESSION['ID_VOLANTY']) ? $_SESSION['ID_VOLANTY'] : null;

    $this->session->sess_destroy();

    if ($volanty != null) {
      session_start();
      session_regenerate_id();
      $_SESSION['ID_VOLANTY'] = $volanty;
    }

    // redirect(base_url('login'));

    $json = array('msg' => 'Logout realizado', 'resultado' => 'sucesso');


    header('Location: ' . base_url('volanty'));
  }
}
