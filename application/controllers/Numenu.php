<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Numenu extends CI_Controller
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
    $this->load->model('Regiao_Model', 'rm');
    $this->load->model('Workflow_Model', 'wm');
    $this->load->model('login_Model', 'lm');
  }

  public function index()
  {
    /*
      Quando a pessoa é redirecionada para o vídeo da página (pagina principal)
      de fato ela quis ir para lá pois é ha uma alert box pedindo confirmação para tal ação.
      Todos as sessões e cookies são apagados para uma melhor renovação de sessão para possíveis novos usuários.

      ---
      Caso isso seja absurdo ou fuja do que foi projetado, por favor desconsiderar tal ação e apagar as linhas abaixo até: 
      "session_destroy();"

    */
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
      );
    }

    session_destroy();
    $this->load->view('numenu/index');
  }

  public function agenda()
  {

    /* captura o id do moip na tabela do numenu */
    $_SESSION['ID_NUMENU'] = 'MPA-4FD01BD268C1';

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
    $dado['titulo_website'] = 'Numenu - Agenda';
    $this->load->view('numenu/agenda', $dado);
  }

  public function cadastro()
  {
    $dados['titulo_website'] = 'Cadastro - Numenu';
    $this->load->view('numenu/cadastro', $dados);
  }

  public function acessar()
  {
    $this->load->view('numenu/login');
  }

  public function login()
  {
    // Login
    $user =  $this->input->post('user');
    $senha = $this->input->post('senha');

    // Valida no banco
    $resultado = $this->lm->buscar($user, $senha);

    if ($resultado == null) {
      header('Location: ' . base_url('numenu/acessar'));
    } else {
      $_SESSION['userId'] = $resultado->cod_login;
      $_SESSION['admin'] = $resultado->tipo;
      $_SESSION['logado'] = 1;

      $_SESSION['nome'] =  $resultado->nome;
      $_SESSION['email'] =  $resultado->email;
      $_SESSION['telefone'] =  $resultado->telefone_contato;

      if ($this->input->post('ajax') == 1) {
        $json['resultado'] = 'sucesso';
        header('Content-Type: application/json');
        echo json_encode($json);
      } else {
        header('Location: ' . base_url('numenu/agenda'));
      }
    }
  }

  public function logout()
  {
    $numenu = isset($_SESSION['ID_NUMENU']) ? $_SESSION['ID_NUMENU'] : null;

    $this->session->sess_destroy();

    if ($numenu != null) {
      session_start();
      session_regenerate_id();
      $_SESSION['ID_NUMENU'] = $numenu;
    }

    // redirect(base_url('login'));

    $json = array('msg' => 'Logout realizado', 'resultado' => 'sucesso');


    header('Location: ' . base_url('numenu'));
  }

  /* Exibe os pedidos cadastrados para o usuário logado */
  public function pedidos($offset = 0)
  {
    if (isset($_SESSION['userId'])) {
      if ($_POST['consulta_ajax']) {
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
      } else {
        $json['resultado'] = "metodo_incorreto";
      }
    } else {
      $json['resultado'] = "usuario_nao_logado";
    }
    header('Content-Type: application/json');
    echo json_encode($json);
  }
  public function detalhesPedido($cod_pedido)
  {
    $json['pedido'] = $this->am->buscarPedido($cod_pedido);

    $json['pedido']['status'] = $this->mm->traduzirStatus($json['pedido']['moip_ultimo_status_payment']);
    $json['pedido']['servico'] = $this->am->buscarServico($json['pedido']['fk_servico']);
    $json['pedido']['modelo'] = $this->am->buscarVeiculo($json['pedido']['servico']['fk_modelo']);
    $json['pedido']['endereco'] = $this->am->buscarLojista($json['pedido']['fk_lojista'])['endereco'];

    $json['resultado'] = "sucesso";

    header('Content-Type: application/json');
    echo json_encode($json);
  }

  public function finalizaSolicitacao()
  {
    $this->session->unset_userdata('ID_NUMENU');
    $this->session->unset_userdata('voucher');
    $json['resultado'] = "sucesso";

    header('Content-Type: application/json');
    echo json_encode($json);
  }
}
