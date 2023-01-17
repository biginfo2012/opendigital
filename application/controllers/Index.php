<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
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
		if(isset($_SESSION['ID_VOLANTY'])){
			unset($_SESSION['ID_VOLANTY']);
		}
	}

	public function index()
	{
		//echo $this->mm->generatePermissionLink(APP_MOIP_CONNECT_ID,"http://192.168.15.101/projetos/minha_revisao/index/retorno","18"); die();
		$this->load->view('index');
	}



	public function retorno()
	{
		// $json = file_get_contents('php://input');
		//         //transforma de json para array
		//         $notificacao = json_decode($json, true);

		//         var_dump($notificacao); die();

		$permissionInfo['client_id'] = APP_MOIP_CONNECT_ID;
		$permissionInfo['client_secret'] = APP_MOIP_CONNECT_SECRET;
		$permissionInfo['redirect_uri'] = REDIRECT_URI_APP_MOIP;
		$permissionInfo['grant_type'] = "authorization_code";
		$permissionInfo['code'] = $this->input->get("code");

		// "client_id": "'.$permissionInfo['client_id'].'",
		// "client_secret": "'.$permissionInfo['client_secret'].'",
		// "redirect_uri": "'.$permissionInfo['redirect_uri'].'",
		// "grant_type": "'.$permissionInfo['grant_type'].'",
		// "code": "'.$permissionInfo['code'].'",


		$accessToken = $this->mm->createAccessToken($permissionInfo, ACCESS_TOKEN_MOIP);

		if (!(array_key_exists('error', $accessToken)) && $this->am->checkLojistaToConnect($this->input->get("seller"))) {
			$lojista['cod_lojista'] = $this->input->get("seller");
			$lojista['moip_access_token'] = $accessToken['access_token'];
			$lojista['moip_id'] = $accessToken['moipAccount']['id'];
			$this->am->updateLojista($lojista);
			redirect(base_url('index?vinculo=Vinculo%20realizado%20com%20sucesso'));
		} else {
			redirect(base_url('index?vinculo=Vinculo%20não%20foi%20realizado%20com%20sucesso'));
		}


		// $json = $accessToken;

		//header('Content-Type: application/json');
		//echo json_encode( $json );
	}

	public function contato()
	{
		$nome = $this->input->post('nome');
		$usr_email = $this->input->post('email');
		$telefone = $this->input->post('telefone');
		$msg = $this->input->post('msg');
		$result = $this->wm->contato($nome, $usr_email, $telefone, $msg);
		if ($result == true) {
			$json['resultado'] = 'sucesso';
		} else {
			$json['resultado'] = $result;
		}


		header('Content-Type: application/json');
		echo json_encode($json);
	}
}
