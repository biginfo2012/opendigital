<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUDAR O NOME !!!!!!!!!! extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Base_Model');
		$this->load->model('Base_Model','apelido');
		$this->load->helper('url');
	}

	public function index()
	{
		//$dados['Ex1'] = 'Ex';
		//$dados['Ex2'] = 2;
		//$dados['titulo'] = 'Usado no header do view, Ex: <title> $title</title>';
		//$this->load->view('welcome_message',$dados);//Chamar $Ex1 e $Ex2 na view
	}

	public function ex()
	{
		$this->Base_Model->Ex();//chamada de metodo da model
		$this->apelido_model->Ex();//chamada de metodo da model apelidada
		$this->uri->segment(3);//primeiro param
	}

	//Metodo chamada pela view com um <a href> Exemplo: base_url('outraview')
	//Dessa forma ao clickar no link o link chamará 
	//localhost/raiz/aplicação/controler/metodo sendo o controller o Index e o metodo outraView

	public function chamadaDaView()
	{
		$dados['titulo'] = "Exemplo de chamada da view";
		$this->load->view('outraView',$dados);
		$this->load->helper('form');
	}

	//https://www.codeigniter.com/user_guide/libraries/email.html
	//http://www.universidadecodeigniter.com.br/enviando-emails-com-a-library-nativa-do-codeigniter/
	/*public function send_mail() 
	{
	    $this->load->library( 'email' );
	    $this->email->from( 'jdoe@gmail.com', 'John Doe' );
	    $this->email->to( 'jane_doe@gmail.com' );
	    $this->email->subject( 'Some subject' );
	    $this->email->message( $this->load->view( 'emails/message', $data, true ) );
	    $this->email->send();
    } */


	
}
