<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'PHPMailer.php';
require_once 'Exception.php';
require 'SMTP.php';
class Workflow_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


    /**
     *  Envia um email workflow avisando o fluxo dos formulários
     *
     * @param        $nome                Título do email
     *
     * @param        $solicitante           Solicitante do form atual
     *
     * @param        $responsavel_atual     Responsavel do form atual
     *
     * @param        $proximo               Próximo responsável pelo próximo form
     *
     */


	public function contato($nome,$usr_email,$telefone,$msg)
	{
        
        $config = array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.minharevisao.com.br', //smtp.minharevisao.com.br
          'smtp_port' => 587,
          'smtp_user' => 'envio@minharevisao.com.br', //envio@minharevisao.com.br
          'smtp_pass' => 'Revisao2019@@', //Revisao2018@@###
        );

        $this->email->initialize($config);
        $data["nome"] = $nome;
        $data["email"] = $usr_email;
        $data["telefone"] = $telefone;
        $data["msg"] = $msg;
        $body = $this->load->view('email/contato.php',$data,TRUE);

        $this->email->subject('Nova mensagem de contato');

        $this->email->from('envio@minharevisao.com.br', 'Contato');
        $this->email->to('contato@minharevisao.com.br');
        $this->email->set_mailtype("html");
        $this->email->message($body);
        $result = $this->email->send();

        $this->email->clear(TRUE);
        return $result;

	 }

}
