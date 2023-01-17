<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_Model', 'lm');
		$this->load->model('Agenda_Model', 'am');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->database();
		$this->load->helper('url');
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
	}

	/**
	 *
	 * Desloga o usuário destruindo a sessão e redireciona para o "login"
	 *
	 */

	public function logout()
	{
		$volanty = isset($_SESSION['ID_VOLANTY'])?$_SESSION['ID_VOLANTY']:null;

		$this->session->sess_destroy();
		
		if ($volanty != null) {
			session_start();
			session_regenerate_id();
			$_SESSION['ID_VOLANTY'] = $volanty;
		}

		// redirect(base_url('login'));

		$json = array('msg' => 'Logout realizado', 'resultado' => 'sucesso');


		header('Content-Type: application/json');
		echo json_encode($json);
	}

	/**
	 * Loga o usuário instanciando "userId" e "usuario" na sessão
	 * retorna um json informando o resultado
	 *
	 */

	public function login()
	{ 
		// Login
		$user =  $this->input->post('user');
		$senha = $this->input->post('senha');

		// Valida no banco
		$resultado = $this->lm->buscar($user, $senha);

		$json = array('msg' => 'Não foi possível realizar a operação');
		$json['resultado'] = "erro";

		if ($resultado == null) {
			$json['msg']  = 'Não foi possível realizar o login';
			$json['ifo'] = $user . " e " . $senha;
		} else {
			$_SESSION['userId'] = $resultado->cod_login;

			$_SESSION['admin'] = $resultado->tipo;
			$_SESSION['logado'] = 1;

			$_SESSION['nome'] =  $resultado->nome;
			$_SESSION['email'] =  $resultado->email;
			$_SESSION['telefone'] =  $resultado->telefone_contato;

			$json['usuario']  =  $resultado->email;
			$json['nome']  =  $resultado->nome;
			$json['telefone']  =  $resultado->telefone_contato;
			//$json['nome']  = $resultado->nome;
			$json['admin'] = $resultado->tipo;

			$json['listaCadastrados'] = $this->am->listaVeiculosCadastrados($_SESSION['userId']);

			$json['resultado'] = "sucesso";
			$json['msg']  = 'Login realizado com sucesso';
		}

		header('Content-Type: application/json');
		echo json_encode($json);
	}



	/**
	 * Solicita envio de e-mail com link de redefinição baseado no cpf informado
	 *
	 */
	public function requestRecover()
	{
		$json = array();
		$cpf = $this->input->post('cpf');
		$user = $this->lm->buscarPorCpf($cpf);

		if ($user != null) {
			$token_id = $this->lm->generateRecoveryToken($user->cod_login);
			$this->lm->sendEmailRedefinicao($user->email, $token_id);
			
			$json['resultado'] = 'sucesso';
		}else{
			$json['resultado'] = 'erro';
			$json['erro'] = 'CPF não cadastrado.';
 		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	/*
	* Carrega página de recuperação de senha
	*/
	public function redefinicao($token_id)
	{
		$token = explode("_", $token_id);
		if ($this->lm->checkRecoveryToken($token[0], $token[1])) {
			$data['cod_usuario'] = $token[1];
			$this->load->view('recover', $data);
		}else{
			header("location:" . base_url());
		}
	}

	/*
	* Realiza a redefinição com a nova senha inserida
	*/
	public function passwordRecover(){
		$json = array();
		$cod_usuario = $this->input->post('cod_usuario');
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		if ($password == $password_confirm) {
			$new_password = md5($password);
			if($this->lm->redefinirSenha($cod_usuario, $new_password)){
				$json['resultado'] = 'sucesso';
			}else{
				$json['resultado'] = 'erro';
				$json['erro'] = 'Não foi possível realizar a alteração.';
			}
		}else{
			$json['resultado'] = 'erro';
			$json['erro'] = 'As senhas não conferem.';
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	/**
	 *Carregar formulário de cadastro de usuário
	 *
	 */

	public function insertPage()
	{
		$dados['title'] = 'Cadastrar';
		$dados['button'] = 'Cadastrar';
		$dados['form'] = 'mainCadastro';
		$dados['senha'] = 'required';

		$dados['user'] = new Login_Model;
		$dados['user']->nome = null;
		$dados['user']->cpf = null;
		$dados['user']->email = null;
		$dados['user']->telefone_contato = null;
		$dados['user']->estado = null;
		$dados['user']->cidade = null;
		$dados['user']->cep = null;
		$dados['user']->bairro = null;
		$dados['user']->rua = null;
		$dados['user']->numero_casa = null;
		$dados['user']->data_nascimento = null;
		$dados['user']->complemento = null;

		$this->load->view('usuarioEditInsert', $dados);
	}

	/**
	 *Carregar formulário de edição de usuário
	 *
	 */
	public function editPage()
	{
		$dados['title'] = 'Editar';
		$dados['button'] = 'Salvar';
		$dados['form'] = 'mainPerfil';
		$dados['senha'] = null;

		$dados['user'] = $this->lm->buscarPorId($_SESSION['userId']);
		if ($dados['user'] != null) {
			$this->load->view('usuarioEditInsert', $dados);
		} else {
			header("location:" . base_url());
		}
	}

	/**
	 *Inserir usuário
	 *
	 */

	public function inserir()
	{

		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_message('is_unique', 'O email já existe na nossa base, tente outro, por favor');

		//Configuração de validação
		$this->form_validation->set_rules('user', 'Email', 'valid_email|trim|required|valid_email|is_unique[LOGIN.email]');
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required');
		$this->form_validation->set_rules('confirm_senha', 'confirmar senha', 'trim|required|matches[senha]');
		$this->form_validation->set_rules('telefone', 'Telefone', 'trim');
		$this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
		$this->form_validation->set_rules('data_nascimento', 'Data de nascimento', 'trim|required');
		$this->form_validation->set_rules('rua', 'Rua', 'trim|required');
		$this->form_validation->set_rules('numero_casa', 'Numero', 'trim|required');
		$this->form_validation->set_rules('bairro', 'Bairro', 'trim|required');
		$this->form_validation->set_rules(
			'cidade',
			'Cidade',
			'trim|required|regex_match[/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/]'
		);
		$this->form_validation->set_rules(
			'estado',
			'Estado',
			'trim|required|regex_match[/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/]'
		);
		$this->form_validation->set_rules('cep', 'CEP', 'trim|required');

		$json = array();

		//Se os dados estiverem incorretos enviar json informando os erros
		if ($this->form_validation->run() == FALSE) {
			$json['resultado'] = "erro";
			$json['erros'] = $this->form_validation->error_array();
		}
		//Se os dados estiverem corretos, inserir informações no banco e enviar json com resultado
		else {

			$login['email'] = $this->input->post('user');
			$login['nome'] = $this->input->post('nome');
			$login['senha'] = md5($this->input->post('senha'));
			$login['telefone_contato'] = $this->input->post('telefone');
			$login['tipo'] = 0;
			$login['cpf'] = $this->input->post('cpf');
			$login['rua'] = $this->input->post('rua');
			$login['numero_casa'] = $this->input->post('numero_casa');
			$login['bairro'] = $this->input->post('bairro');
			$login['cidade'] = $this->input->post('cidade');
			$login['estado'] = $this->input->post('estado');
			$login['cep'] = $this->input->post('cep');
			$login['data_nascimento'] = $this->input->post('data_nascimento');
			$login['complemento'] = $this->input->post('complemento');

			$result = $this->lm->inserir($login);

			$json = null;

			if ($result)
				$json['resultado'] = "sucesso";
			else
				$json['resultado'] = "erro";
		}


		header('Content-Type: application/json');
		echo json_encode($json);
	}

	/**
	 *Inserir usuário
	 *
	 */

	public function editar()
	{

		//Load de validação
		$this->load->helper('form');
		$this->load->library('form_validation');

		//Configuração de validação
		$cadastro = $this->lm->buscarPorId($_SESSION['userId']);
		if ($cadastro->email == $this->input->post('user')) {
			$this->form_validation->set_rules('user', 'Email', 'valid_email|trim');
		} else {
			$this->form_validation->set_rules('user', 'Email', 'valid_email|trim|valid_email|is_unique[LOGIN.email]');
		}
		$this->form_validation->set_rules('nome', 'Nome', 'trim');
		$this->form_validation->set_rules('senha', 'Senha', 'trim');

		if ($this->input->post('senha') != "" || !empty($this->input->post('senha')))
			$this->form_validation->set_rules('confirm_senha', 'Confirmar senha', 'trim|required|matches[senha]');

		$this->form_validation->set_rules('telefone', 'Telefone', 'trim');
		$this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
		$this->form_validation->set_rules('rua', 'Rua', 'trim|required');
		$this->form_validation->set_rules('numero_casa', 'Numero', 'trim|required');
		$this->form_validation->set_rules('bairro', 'Bairro', 'trim|required');
		$this->form_validation->set_rules('cidade', 'Cidade', 'trim|required');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|required');
		$this->form_validation->set_rules('cep', 'CEP', 'trim|required');
		$this->form_validation->set_rules('data_nascimento', 'Data de nascimento', 'trim|required');

		$json = array();

		//Se os dados estiverem incorretos enviar json informando os erros
		if ($this->form_validation->run() == FALSE || $this->session->logado != 1) {

			$json['resultado'] = "erro";
			$json['erros'] = $this->form_validation->error_array();

			if ($this->session->logado != 1)
				$json['erros']['login'] = "Necessário estar logado para realizar essa ação";
		}
		//Se os dados estiverem corretos, inserir informações no banco e enviar json com resultado
		else {
			$login['cod_login'] =   $_SESSION['userId'];

			if ($this->input->post('user'))
				$login['email'] = $this->input->post('user');

			if ($this->input->post('nome'))
				$login['nome'] = $this->input->post('nome');

			if ($this->input->post('senha'))
				$login['senha'] = md5($this->input->post('senha'));

			if ($this->input->post('telefone'))
				$login['telefone_contato'] = $this->input->post('telefone');
			//$login['tipo'] = 0;

			if ($this->input->post('cpf'))
				$login['cpf'] = $this->input->post('cpf');

			if ($this->input->post('rua'))
				$login['rua'] = $this->input->post('rua');

			if ($this->input->post('numero_casa'))
				$login['numero_casa'] = $this->input->post('numero_casa');

			if ($this->input->post('bairro'))
				$login['bairro'] = $this->input->post('bairro');

			if ($this->input->post('cidade'))
				$login['cidade'] = $this->input->post('cidade');

			if ($this->input->post('estado'))
				$login['estado'] = $this->input->post('estado');

			if ($this->input->post('cep'))
				$login['cep'] = $this->input->post('cep');

			if ($this->input->post('data_nascimento'))
				$login['data_nascimento'] = $this->input->post('data_nascimento');
			
			if ($this->input->post('complemento'))
				$login['complemento'] = $this->input->post('complemento');

			$result = $this->lm->update($login);

			if ($result) {

				// Valida no banco
				$resultado = $this->lm->buscarPorId($_SESSION['userId']);

				if ($resultado != null) {

					$_SESSION['userId'] = $resultado->cod_login;
					//$_SESSION['nome'] = $resultado->nome;
					$_SESSION['admin'] = $resultado->tipo;
					$_SESSION['logado'] = 1;

					$_SESSION['nome'] =  $resultado->nome;
					$_SESSION['email'] =  $resultado->email;
					$_SESSION['telefone'] =  $resultado->telefone_contato;

					$json['nome'] = $resultado->nome;
					$json['email'] =  $resultado->email;
					$json['telefone'] = $resultado->telefone_contato;
					$json['resultado'] = "sucesso";
				}
			} else
				$json['resultado'] = "erro";
		}


		header('Content-Type: application/json');
		echo json_encode($json);
	}


	/*## ACESSO VOLANTY ##*/

	/**
	 *
	 * Página de acesso volanty
	 *
	 */
	public function volanty()
	{
		$data = array();
		if (isset($_SESSION['ID_VOLANTY'])) {
			$volanty = $this->lm->getVolantyUserInfo($_SESSION['ID_VOLANTY']);
			if ($volanty != null) {
				$data['volanty'] = $volanty;
			}
		}
		$this->load->view('volanty', $data);
	}

	/**
	 *
	 * Acessar usuário volanty
	 *
	 */
	public function loginVolanty()
	{
		// Login
		$user =  $this->input->post('user');
		$senha = $this->input->post('senha');

		// Valida no banco
		$resultado = $this->lm->loginVolanty($user, $senha);

		if ($resultado == null) {
			header("location:" . base_url('volanty'));
		} else {
			$_SESSION['ID_VOLANTY'] = $resultado->moip_id;
			header("location:" . base_url('volanty'));
		}
	}

	/**
	 *
	 * Desconecta usuário volanty
	 *
	 */
	public function logoutVolanty()
	{
		if (isset($_SESSION['ID_VOLANTY'])) {
			unset($_SESSION['ID_VOLANTY']);
			header("location:" . base_url('login/volanty'));
		} else {
			header("location:" . base_url('login/volanty'));
		}
	}
}
