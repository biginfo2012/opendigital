<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('admin_Model', 'adm');
		$this->load->model('Moip_Model', 'mm');
		$this->load->model('Agenda_Model', 'am');
		$this->load->model('Regiao_Model', 'rm');
	}

	public function index($offset = 0)
	{
		if ($this->session->admin == 1) {
			$dados = array();
			$dados = $this->adm->listaUnidades($offset);
			$dados['offset'] = $offset;
			$link_redirect = REDIRECT_URI_APP_MOIP;

			foreach ($dados['lista_unidades'] as $key => $value) {
				$dados['lista_unidades'][$key]['link_vincular'] = $this->mm->generatePermissionLink(APP_MOIP_CONNECT_ID, REDIRECT_URI_APP_MOIP, $value['cod_lojista']);
			}

			$this->load->view('admin/admin', $dados);
		} else {
			redirect(base_url('admin/login'));
		}
	}

	public function unidade_cad()
	{
		if ($this->session->logado == 1) {
			$dados = ['regioes_list' => $this->rm->getAll(true)];
			$this->load->view('admin/admin_unidade_cad', $dados);
		} else {
			redirect(base_url('admin/login'));
		}
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function loginInput()
	{

		$user = $this->input->post("user");
		$senha = $this->input->post("senha");

		$resultado = $this->adm->login($user, $senha);

		if ($resultado == null) {
			$json['msg']  = 'Não foi possível realizar o login';
		} else {
			$_SESSION['userId'] = $resultado->cod_login;
			//$_SESSION['nome'] = $resultado->nome;
			$_SESSION['admin'] = $resultado->tipo;
			$_SESSION['logado'] = 1;

			$_SESSION['nome'] =  $resultado->nome;
			$_SESSION['email'] =  $resultado->email;
			$_SESSION['telefone'] =  $resultado->telefone_contato;

			$json['resultado'] = "sucesso";
			$json['msg']  = 'Login realizado com sucesso';
		}

		header('Content-Type: application/json');
		echo json_encode($json);
	}

	public function logout()
	{
		$_SESSION = array();
		if (session_destroy()) {
			$json['resultado'] = "sucesso";
			$json['msg']  = 'Logout realizado com sucesso';

			header('Content-Type: application/json');
			echo json_encode($json);
		}
	}

	public function pedidos($offset = 0, $fk_lojista = 0)
	{
		if ($this->session->logado == 1) {
			$dados = array();
			// TRATAMENTO fk_lojista
			if (is_int($fk_lojista)) { //Verificando se o valor inserido é inteiro
				if ($this->adm->verificarLojista($fk_lojista)) { //Verificando a existência do registro com esse id
				}
			} else {
				$fk_lojista = 0;
			}
			$dados = $this->adm->listaPedidos($offset, $fk_lojista);
			$dados['offset'] = $offset;

			$this->load->view('admin/admin_pedidos', $dados);
		} else {
			redirect(base_url('admin/login'));
		}
	}

	public function usuarios($offset = 0)
	{
		if ($this->session->logado == 1) {
			$dados = array();
			$dados = $this->adm->listaUsuarios($offset);
			$dados['offset'] = $offset;
			$this->load->view('admin/admin_usuarios', $dados);
		} else {
			redirect(base_url('admin/login'));
		}
	}


	public function EditarUnidade($cod_lojista)
	{
		if ($this->session->logado == 1) {
			$unidade = $this->am->buscarLojista($cod_lojista);
			$unidade['regioes_list'] =  $this->rm->getAll(true);
			$this->load->view('admin/admin_unidade_edit', $unidade);
		} else {
			redirect(base_url('admin/login'));
		}
	}


	/**
	 *
	 *  Recebe os dados de inserção via post, valida e edita no banco.
	 *
	 */

	public function update()
	{
		if ($this->session->logado != 1) {
			redirect(base_url('admin/login'));
		}


		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		//Configuração de validação
		$this->form_validation->set_rules('cod_lojista', 'cod_lojista', 'is_natural|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('nome_unidade', 'Nome', 'trim|required');
		$this->form_validation->set_rules('horario', 'Horario', 'is_natural|trim|required');
		$this->form_validation->set_rules('limite', 'Limite', 'is_natural|trim|required');
		$this->form_validation->set_rules('nome_responsavel', 'Nome Responsavel', 'trim|required');
		$this->form_validation->set_rules('atendimento_sabado', 'Sabado', 'trim');
		$this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
		$this->form_validation->set_rules('regiao', 'Região', 'is_natural|trim|required');
		$this->form_validation->set_rules('endereco', 'Endereço', 'trim|required');

		$json = array();


		//Se os dados estiverem incorretos enviar json informando os erros
		if ($this->form_validation->run() == FALSE) {

			$json['resultado'] = "erro";
			$json['erros'] = $this->form_validation->error_array();
			// $json['erros'][0] = "erro1";

		}
		//Se os dados estiverem corretos, inserir informações no banco e enviar json com resultado
		else {
			$data = array();

			$data['cod_lojista'] = $this->input->post('cod_lojista');
			$data['email_contato'] = $this->input->post('email');
			$data['nome_unidade'] = $this->input->post('nome_unidade');
			$data['horario'] = $this->input->post('horario');
			$data['limite_periodo'] = $this->input->post('limite');

			$sabado = $this->input->post('atendimento_sabado');
			$data['atendimento_sabado'] = isset($sabado) == 1 ? 1 : 0;

			$data['nome_responsavel'] = $this->input->post('nome_responsavel');
			$data['telefone'] = $this->input->post('telefone');
			$data['regiao'] = $this->input->post('regiao');
			$data['endereco'] = $this->input->post('endereco');

			$this->am->updateLojista($data);



			$json['resultado'] = "sucesso";
		}


		header('Content-Type: application/json');
		echo json_encode($json);
	}


	/**
	 *
	 *  Recebe os dados de inserção via post, valida e inseri no banco.
	 *
	 */

	// NOVA UNIDADE
	public function insert()
	{
		if ($this->session->logado != 1) {
			redirect(base_url('admin/login'));
		}
		//$acess_token_app = "a01379614fc144a29b14f685219e537f_v2";

		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		//FORM VALIDATION
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('nome_unidade', 'Nome', 'trim|required|is_unique[LOJISTA.nome_unidade]');
		$this->form_validation->set_rules('horario', 'Horario', 'is_natural|trim|required');
		$this->form_validation->set_rules('limite', 'Limite', 'is_natural|trim|required');
		$this->form_validation->set_rules('nome_responsavel', 'Nome Responsavel', 'trim|required');
		$this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
		$this->form_validation->set_rules('regiao', 'Região', 'is_natural|trim|required');
		$this->form_validation->set_rules('endereco', 'Endereço', 'trim|required');
		$this->form_validation->set_rules('atendimento_sabado', 'Sabado', 'trim');
		if ($this->input->post('criarContaMoip') != null) {
			$this->form_validation->set_rules('emailM', 'Email Moip', 'trim|required|valid_email');
			$this->form_validation->set_rules('nomeM', 'Nome Moip', 'trim|required');
			$this->form_validation->set_rules('sobrenomeM', 'Sobrenome Moip', 'trim|required');
			$this->form_validation->set_rules('cpfM', 'cpf  Moip', 'trim|required');
			$this->form_validation->set_rules('nascimentoM', 'Nascimento  Moip', 'trim|required');
			$this->form_validation->set_rules('telefoneM', 'Telefone  Moip', 'trim|required');
			$this->form_validation->set_rules('logradouroM', 'Logradouro  Moip', 'trim|required');
			$this->form_validation->set_rules('numeroM', 'Numero  Moip', 'trim|required');
			$this->form_validation->set_rules('bairroM', 'Bairro  Moip', 'trim|required');
			$this->form_validation->set_rules('cepM', 'Cep  Moip', 'trim|required');
			$this->form_validation->set_rules('cidadeM', 'Cidade  Moip', 'trim|required');
			$this->form_validation->set_rules('estadoM', 'Estado  Moip', 'trim|required');
			$this->form_validation->set_rules('nome_empresaM', 'Nome da empresa  Moip', 'trim|required');
			$this->form_validation->set_rules('razaoM', 'Razao  Moip', 'trim|required');
			$this->form_validation->set_rules('cnpjM', 'Cnpj  Moip', 'trim|required');
			$this->form_validation->set_rules('telefone_empM', 'Telefone da empresa  Moip', 'trim|required');
			$this->form_validation->set_rules('logradouro_empM', 'Logradouro da empresa   Moip', 'trim|required');
			$this->form_validation->set_rules('numero_empM', 'Numero da empresa   Moip', 'trim|required');
			$this->form_validation->set_rules('bairro_empM', 'Bairro da empresa   Moip', 'trim|required');
			$this->form_validation->set_rules('cep_empM', 'Cep da empresa   Moip', 'trim|required');
			$this->form_validation->set_rules('cidade_empM', 'Cidade da empresa   Moip', 'trim|required');
			$this->form_validation->set_rules('estado_empM', 'Estado da empresa   Moip', 'trim|required');
			$this->form_validation->set_rules('pais_empM', 'País da empresa   Moip', 'trim|required');
		}

		$json = array();
		//Se os dados estiverem incorretos enviar json informando os erros
		if ($this->form_validation->run() == FALSE) {
			$json['resultado'] = "erro";
			$json['erros'] = $this->form_validation->error_array();
		}
		//Se os dados estiverem corretos, inserir informações no banco e enviar json com resultado
		else {
			$resultMoip = array();
			if ($this->input->post('criarContaMoip') != null) {
				$contaMoip = array();
				$contaMoip['email'] = $this->input->post('emailM');
				$contaMoip['nome'] = $this->input->post('nomeM');
				$contaMoip['sobrenome'] = $this->input->post('sobrenomeM');
				$contaMoip['cpf'] = $this->input->post('cpfM');

				$contaMoip['nascimento'] = empty($this->input->post('nascimentoM')) ? NULL : date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('nascimentoM')))); //$this->input->post('nascimentoM');

				$telefone = explode(" ", $this->input->post('telefoneM'));
				$contaMoip['tel']['ddd'] = str_replace("(", "", $telefone[0]);
				$contaMoip['tel']['ddd'] = str_replace(")", "", $contaMoip['tel']['ddd']);
				$contaMoip['tel']['numero'] = $telefone[1];

				$contaMoip['end']['logradouro'] = $this->input->post('logradouroM');
				$contaMoip['end']['numero'] = $this->input->post('numeroM');
				$contaMoip['end']['bairro'] = $this->input->post('bairroM');
				$contaMoip['end']['cep'] = $this->input->post('cepM');
				$contaMoip['end']['cidade'] = $this->input->post('cidadeM');
				$contaMoip['end']['estado'] = $this->input->post('estadoM');

				$contaMoip['nome_empresa'] = $this->input->post('nome_empresaM');
				$contaMoip['razao'] = $this->input->post('razaoM');
				$contaMoip['cnpj'] = $this->input->post('cnpjM');

				$telefone_emp = explode(" ", $this->input->post('telefone_empM'));
				$contaMoip['tel_emp']['ddd'] = str_replace("(", "", $telefone_emp[0]);
				$contaMoip['tel_emp']['ddd'] = str_replace(")", "", $contaMoip['tel_emp']['ddd']);
				$contaMoip['tel_emp']['numero'] = $telefone_emp[1];


				$contaMoip['end_emp']['logradouro'] = $this->input->post('logradouro_empM');
				$contaMoip['end_emp']['numero'] = $this->input->post('numero_empM');
				$contaMoip['end_emp']['bairro'] = $this->input->post('bairro_empM');
				$contaMoip['end_emp']['cep'] = $this->input->post('cep_empM');
				$contaMoip['end_emp']['cidade'] = $this->input->post('cidade_empM');
				$contaMoip['end_emp']['estado'] = $this->input->post('estado_empM');
				//$contaMoip['end_emp']['pais'] = $this->input->post('pais_empM');

				$resultMoip = $this->mm->createAccount($contaMoip, ACCESS_TOKEN_MOIP);
			}
			if (!(array_key_exists('errors', $resultMoip))) {
				$data = array();

				$data['email_contato'] = $this->input->post('email');
				$data['nome_unidade'] = $this->input->post('nome_unidade');
				$data['horario'] = $this->input->post('horario');
				$data['limite_periodo'] = $this->input->post('limite');
				$data['nome_responsavel'] = $this->input->post('nome_responsavel');
				$data['telefone'] = $this->input->post('telefone');
				$data['regiao'] = $this->input->post('regiao');
				$data['endereco'] = $this->input->post('endereco');
				//Verificação atendimento sábado
				$sabado = $this->input->post('atendimento_sabado');
				$data['atendimento_sabado'] = isset($sabado) == 1 ? 1 : 0;
				//Verificação existência conta MOIP
				if ($this->input->post('criarContaMoip') != null) {
					$json['setPassword'] = $resultMoip['_links']['setPassword']['href'];
					$data['moip_id'] =  $resultMoip['id'];
					$data['moip_access_token'] =  $resultMoip['accessToken'];
				}
				$this->am->inserirLojista($data);

				$json['resultado'] = "sucesso";
				$json['criarContaMoip'] = $this->input->post('criarContaMoip') != null;
			} else {
				// Tratamento de erros cadastro MOIP
				$json['resultado'] = "erro";
				if ($this->input->post('criarContaMoip') != null) {
					foreach ($resultMoip['errors'] as $key => $value) {
						$i = 1;

						$value['description'] = $value['description'] == "Has already been taken" ? "já está em uso." : $value['description'];
						$value['description'] = $value['description'] == "Value is invalid" ? "com valor inválido." : $value['description'];

						$value['path'] = $value['path'] == "email[address]" ? "E-mail " : $value['path'];
						$value['path'] = strpos($value['path'], "[taxDocument]") ? "CPF ou CNPJ " : $value['path'];
						$value['path'] = strpos($value['path'], "[address][zipCode]") ? "CEP " : $value['path'];

						$json['erros'][$i] = "Wirecard: " . $value['path'] . $value['description'];

						$i++;
					}
				}
			}
		}

		header('Content-Type: application/json');
		echo json_encode($json);
	}

	/*
     * Exportar para svg a lista de pedidos
     */
	public function exportPedidos()
	{
		header('Content-Encoding: UTF-8');
		header("Content-type: text/csv; charset=UTF-8");
		header('Content-Disposition: attachment; filename=LISTAGEM_PEDIDOS.csv');
		header("Pragma: no-cache");
		header("Expires: 0");
		echo "\xEF\xBB\xBF";


		$delimiter = ";";
		$f = fopen('php://memory', 'w');
		$head = [
			'COD_AGENDA', 'DATA', 'PERIODO', 'VOUCHER', 'ORDEM DE PAGAMENTO', 'STATUS PAGAMENTO',
			'UNIDADE', 'REGIÃO UNIADADE', 'ENDEREÇO UNIDADE',
			'SERVIÇO', 'PRECO SERVIÇO',
			'VEICULO MONTADORA', 'VEICULO MODELO', 'VEICULO MOTOR', 'VEICULO ANO',
			'USUÁRIO', 'EMAIL USUÁRIO', 'TELEFONE USUÁRIO', 'CEP USUÁRIO', 'CIDADE USUÁRIO', 'BAIRRO USUÁRIO', 'RUA USUÁRIO', 'NÚMERO USUÁRIO', 'COMPLEMENTO USUÁRIO' 
		];

		$lista_pedidos = $this->adm->listaGeralPedidos();
		fputcsv($f, $head, $delimiter);
		foreach ($lista_pedidos as $pedido) {
			foreach ($pedido as $value) {
				fputcsv($f, $value, $delimiter);
			}
		}
		fseek($f, 0);
		fpassthru($f);
	}

	/*
     * Exportar para svg a lista de usuários
     */
	public function exportUsuarios()
	{
		header('Content-Encoding: UTF-8');
		header("Content-type: text/csv; charset=UTF-8");
		header('Content-Disposition: attachment; filename=LISTAGEM_USUARIOS.csv');
		header("Pragma: no-cache");
		header("Expires: 0");
		echo "\xEF\xBB\xBF";

		$delimiter = ";";
		$f = fopen('php://memory', 'w');
		$head = [
			'CÓDIGO', 'NOME', 'EMAIL', 'TELEFONE', 'CEP', 'CIDADE', 'BAIRRO', 'RUA', 'NÚMERO', 'COMPLEMENTO'
		];
		fputcsv($f, $head, $delimiter);

		$lista_usuarios = $this->adm->listaGeralUsuarios();
		foreach ($lista_usuarios as $usuario) {
			foreach ($usuario as $value) {
				fputcsv($f, $value, $delimiter);
			}
		}
		fseek($f, 0);
		fpassthru($f);
	}



	/* ALTERAÇÃO 25/09/2019
	 * Paulo Ferreira
	 * ADIÇÃO DA FEATURE DE CONTROLE DE VEÍCULOS
	 *
	*/

	// Load tabela com veículos
	public function veiculos($offset = 0, $fk_veiculo = 0)
	{
		if ($this->session->logado == 1) {
			$dados = array();
			// TRATAMENTO fk_veiculo
			if (is_int($fk_veiculo)) { //Verificando se o valor inserido é inteiro
				if ($this->adm->verificarLojista($fk_veiculo)) { //Verificando a existência do registro com esse id
				}
			} else {
				$fk_veiculo = 0;
			}
			$dados = $this->adm->listaVeiculos($offset, $fk_veiculo);
			$dados['offset'] = $offset;

			$this->load->view('admin/admin_veiculos', $dados);
		} else {
			redirect(base_url('admin/login'));
		}
	}

	public function insertVeiculo(){
		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		//FORM VALIDATION
		$this->form_validation->set_rules('montadora', 'Montadora', 'trim|required');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$json['resultado'] = "erro";
			$json['msg'] = $this->form_validation->error_array();
		} else {
			$veiculo = array(
				'montadora' => $this->input->post('montadora'),
				'modelo' => $this->input->post('modelo'),
				'motor' => null,
				'customizado' => 1,
				'ano' => null
			);

			if ($this->adm->checkVeiculo($veiculo) == 0) {
				$this->adm->insertVeiculo($veiculo);
				$json['resultado'] = "sucesso";
			}else{
				$json['resultado'] = "erro";
				$json['msg'] = array($veiculo['montadora'].' '.$veiculo['modelo'].' já está cadastrado no sistema.');
			}
		}

		header('Content-Type: application/json');
		echo json_encode($json);
	}

	public function editVeiculo(){
		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		//FORM VALIDATION
		$this->form_validation->set_rules('cod_modelo', 'Código Modelo', 'trim|required');
		$this->form_validation->set_rules('montadora', 'Montadora', 'trim|required');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$json['resultado'] = "erro";
			$json['msg'] = $this->form_validation->error_array();
		} else {
			$veiculo = $this->adm->getVeiculoById($this->input->post('cod_modelo'));
			$edit_veiculo = array(
				'montadora' => $this->input->post('montadora'),
				'modelo' => $this->input->post('modelo'),
			);

			if ($this->adm->checkVeiculo($edit_veiculo) == 0) {
				$this->adm->editVeiculo($veiculo, $edit_veiculo);
				$json['resultado'] = "sucesso";
			}else{
				$json['resultado'] = "erro";
				$json['msg'] = array($edit_veiculo['montadora'].' '.$edit_veiculo['modelo'].' já está cadastrado no sistema.');
			}
		}

		header('Content-Type: application/json');
		echo json_encode($json);
	}
	

	// Load página de edição de veículo
	public function editarVeiculo($cod_veiculo = 0)
	{
		if ($this->session->logado == 1) {
			$data['veiculo'] = $this->adm->getVeiculoById($cod_veiculo);
			$data['variacoes'] = $this->adm->getVariacoesVeiculo($cod_veiculo);
			$this->load->view('admin/admin_veiculos_edit', $data);
		} else {
			redirect(base_url('admin/login'));
		}
	}

	// Inserção ajax de nova variação de veículo
	public function insertVariacao()
	{
		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		//FORM VALIDATION
		$this->form_validation->set_rules('montadora', 'Montadora', 'trim|required');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
		$this->form_validation->set_rules('variacao', 'Variacao', 'trim|required');
		$this->form_validation->set_rules('basico', 'Serviço Básico', 'trim|numeric|required');
		$this->form_validation->set_rules('inter', 'Serviço Intermediário', 'trim|numeric|required');
		$this->form_validation->set_rules('premium', 'Serviço Premium', 'trim|numeric|required');

		if ($this->form_validation->run() == FALSE) {
			$json['resultado'] = "erro";
			$json['msg'] = $this->form_validation->error_array();
		} else {
			$variacao['veiculo'] = array(
				'montadora' => $this->input->post('montadora'),
				'modelo' => $this->input->post('modelo'),
				'motor' => $this->input->post('variacao'),
				'customizado' => $this->input->post('custom') == "on" ? 0 : 1,
				'ano' => null
			);

			$variacao['servicos'] = array(
				$this->input->post('basico') * 100,
				$this->input->post('inter') * 100,
				$this->input->post('premium') * 100
			);

			if ($this->adm->checkVariacao($variacao['veiculo']) == 0) {
				if ($this->adm->insertVariacao($variacao)) {
					$json['resultado'] = "sucesso";
				} else {
					$json['resultado'] = "erro";
					$json['msg'] = array('Não foi possível inserir');
				}
			} else {
				$json['resultado'] = "erro";
				$json['msg'] = array($variacao['veiculo']['montadora'] . ' ' . $variacao['veiculo']['modelo'] . ' ' . $variacao['veiculo']['motor'] . ' já está cadastrado no sistema.');
			}
		}

		header('Content-Type: application/json');
		echo json_encode($json);
	}

	public function getInfoVariacao()
	{
		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cod_variacao', 'Código da variação', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$json['resultado'] = "erro";
			$json['msg'] = $this->form_validation->error_array();
		} else {
			$veiculo = $this->adm->getVeiculoById($this->input->post('cod_variacao'));
			$servicos = $this->adm->getServicosByVeiculo($this->input->post('cod_variacao'));
			$response = array(
				'cod_variacao' => $veiculo['cod_modelo'],
				'variacao' => $veiculo['motor'],
				'status' => $veiculo['customizado'],
				'cod_basico' => $servicos[0]['cod_servicos'],
				'basico' => $servicos[0]['preco']/100,
				'cod_inter' => $servicos[1]['cod_servicos'],
				'inter' => $servicos[1]['preco']/100,
				'cod_premium' => $servicos[2]['cod_servicos'],
				'premium' => $servicos[2]['preco']/100,
			);
			$json['resultado'] = "sucesso";
			$json['response'] = $response;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	public function updateVariacao()
	{
		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		//FORM VALIDATION
		$this->form_validation->set_rules('montadora', 'Montadora', 'trim|required');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
		$this->form_validation->set_rules('cod_variacao', 'Código da Variacao', 'trim|required');
		$this->form_validation->set_rules('variacao', 'Variacao', 'trim|required');
		$this->form_validation->set_rules('cod_basico', 'Serviço Básico', 'trim|numeric|required');
		$this->form_validation->set_rules('basico', 'Serviço Básico', 'trim|numeric|required');
		$this->form_validation->set_rules('cod_inter', 'Serviço Intermediário', 'trim|numeric|required');
		$this->form_validation->set_rules('inter', 'Serviço Intermediário', 'trim|numeric|required');
		$this->form_validation->set_rules('cod_premium', 'Serviço Premium', 'trim|numeric|required');
		$this->form_validation->set_rules('premium', 'Serviço Premium', 'trim|numeric|required');

		if ($this->form_validation->run() == FALSE) {
			$json['resultado'] = "erro";
			$json['msg'] = $this->form_validation->error_array();
		} else {
			$variacao = array(
				'cod_modelo' => $this->input->post('cod_variacao'),
				'montadora' => $this->input->post('montadora'),
				'modelo' => $this->input->post('modelo'),
				'motor' => $this->input->post('variacao'),
				'customizado' => $this->input->post('custom') == "on" ? 0 : 1,
				'ano' => null
			);

			$servicos = array(
				array('cod_servico' => $this->input->post('cod_basico'), 'preco' => $this->input->post('basico') * 100),
				array('cod_servico' => $this->input->post('cod_inter'), 'preco' => $this->input->post('inter') * 100),
				array('cod_servico' => $this->input->post('cod_premium'), 'preco' => $this->input->post('premium') * 100),
			);

			$check_exsitencia = false;
			$variacao_check = $this->adm->getVeiculoById($variacao['cod_modelo']);
			if ($variacao_check['motor'] != $variacao['motor']) {
				$check_exsitencia = $this->adm->checkVariacao(array(
					'montadora'=>$variacao_check['montadora'], 
					'modelo'=>$variacao_check['modelo'], 
					'motor'=>$variacao['motor'])) == 0;
			} else {
				$check_exsitencia = true;
			}
			if ($check_exsitencia) {
				if ($this->adm->updateVariacao($variacao)) {
					$response = true;
					$contador = 0;
					while ($response != false && $contador <= 2) {
						$response = $this->adm->updateServico($servicos[$contador]);
						$contador++;
					}
					if ($contador != false) {
						$json['resultado'] = "sucesso";
					} else {
						$json['resultado'] = "erro";
						$json['msg'] = array('Não foi possível alterar os serviços');
					}
				} else {
					$json['resultado'] = "erro";
					$json['msg'] = array('Não foi possível alterar a varaiação');
				}
			} else {
				$json['resultado'] = "erro";
				$json['msg'] = array($variacao_check['montadora'] . ' ' . $variacao_check['modelo'] . ' ' . $variacao['motor'] . ' já está cadastrado no sistema.');
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	public function regioes(){
		if ($this->session->logado == 1) {
			$data = ['regioes_list'=>$this->rm->getAll(true)];

			$this->load->view('admin/admin_regioes', $data);
		}else{
			echo '404';
		}
	}

	public function getRegiao($id_regiao){
		$regiao =$this->rm->getById($id_regiao);
		echo json_encode(['regiao'=> $regiao]);
	}
	
	public function insertEditRegiao(){
		$regiao = ['regiao' => $this->input->post('regiao')];
		$success = false;
		if($this->input->post('cod_regiao') != null){
			$success = $this->rm->update($regiao, $this->input->post('cod_regiao')) != false;
		}else{
			$success = $this->rm->insert($regiao) != 0;
		}
		echo json_encode(['success'=> $success]);
	}

	public function disableRegiao($cod_regiao){
		$regiao = ['status' => 0];
		$result = $this->rm->update($regiao, $cod_regiao);
		echo json_encode(['success'=> $result != false]);
	}

	public function enableRegiao($cod_regiao){
		$regiao = ['status' => 1];
		$result = $this->rm->update($regiao, $cod_regiao);
		echo json_encode(['success'=> $result != false]);
	}
}
