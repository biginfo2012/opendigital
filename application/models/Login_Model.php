<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Login_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     *  Busca no banco de dados por um login com o user e senha informados
     *
     * @param       string  $user   Informações do login
     *
     * @param       string  $senha  Informações do login
     *
     * @return      array  Retorna o login caso ele exista
     */
    public function buscar($user, $senha)
    {

        $query = $this->db->get_where('LOGIN', array('email' => $user, "senha" => md5($senha)));

        $result = $query->row();

        return  $result;
    }

    /**
     *  Busca no banco de dados por um login com o user informado
     *
     * @param       string  $user   Informações do login
     *
     *
     * @return      array  Retorna o login caso ele exista
     */
    public function buscarSemSenha($user)
    {

        $query = $this->db->get_where('LOGIN', array('email' => $user));

        $result = $query->row();

        return  $result;
    }

    /**
     *  Busca no banco de dados pelo ID
     *
     * @param       string  $id   Id do cadastro
     *
     *
     * @return      array  Retorna o login caso ele exista
     */
    public function buscarPorId($id)
    {

        $query = $this->db->get_where('LOGIN', array('cod_login' => $id));

        $result = $query->row();

        return  $result;
    }

    /** ADIÇÃO DESSA FUNÇÃO
     ** PAULO FERREIRA
     ** 27/08/2019
     *
     *  Busca registro de usuário no banco a partir do cpf
     *
     * @param       string  $cpf   Cpf do cadastro
     *
     *
     * @return      array  Retorna o login caso ele exista
     */
    public function buscarPorCpf($cpf)
    {

        $query = $this->db->get_where('LOGIN', array('cpf' => $cpf));

        $result = $query->row();

        return  $result;
    }


    /**
     * Inseri um login
     *
     * @param       string  $login  Informações do login
     *
     * @return      int  Retorna o id do login inserido
     */
    public function inserir($login)
    {
        $result = $this->db->insert('LOGIN', $login);

        $id = $this->db->insert_id();

        return $id;
    }


    /**
     * Atualiza um login
     *
     * @param       string  $login  Informações do login
     *
     * @return      boolean  Resultado da operação
     */
    public function update($login)
    {
        $this->db->where('cod_login', $login['cod_login']);
        $return = $this->db->update('LOGIN',  $login);

        return $return;
    }

    /** ADIÇÃO DESSA FUNÇÃO
     ** PAULO FERREIRA
     ** 27/08/2019
     *
     *  Gera token para redefinição de senha
     *
     * @param       int  $cod_usuario  Id do usuário o qual realizará a redefinição
     *
     * @return     string $token_id Concomitação de token + id para acessar o token de redefinição
     */
    public function generateRecoveryToken($cod_usuario)
    {
        $token = bin2hex(random_bytes(10));
        $this->db->set('fk_usuario', $cod_usuario);
        $this->db->set('token', $token);
        $this->db->set('validade', 'ADDTIME(now(), "24:00:00")', false);
        $this->db->set('status', 0);

        $this->db->insert('REDEFINICAO');

        return $token . '_' . $cod_usuario;
    }

    /** ADIÇÃO DESSA FUNÇÃO
     ** PAULO FERREIRA
     ** 27/08/2019
     *
     *  Verifica se o token de redefinição inserido é válido
     *
     * @param       int  $cod_usuario  Id do usuário o qual realizará a redefinição
     *
     * @return     bool $result Token é válido ? Verdadeiro : Falso
     */
    public function checkRecoveryToken($token, $cod_usuario)
    {
        $this->db->select('*');
        $this->db->from('REDEFINICAO');
        $this->db->where('token', $token);
        $this->db->where('fk_usuario', $cod_usuario);
        $this->db->where('validade >=','NOW()', false);
        $this->db->where('status','0');

        $query = $this->db->get();
        
        $result = $query->num_rows();
    
        return  $result > 0 ? true : false;
    }


    /** ALTERAÇÃO DESSA FUNÇÃO
     ** PAULO FERREIRA
     ** 27/08/2019
     *
     *  Recebe o id do usuário e a nova senha para realizar a redefinição
     *
     * @param       int     $cod_usuario Id do usuário referente
     *
     * @param       string  $nova_senha Senha a ser redefinida
     *
     * @return    string  resultado da operação
     */
    public function redefinirSenha($cod_usuario, $nova_senha)
    {
        // Altera a senha
        $this->db->where('cod_login', $cod_usuario);
        $result_login = $this->db->update('LOGIN',  array('senha' => $nova_senha));
        
        // Atualiza o status da redefinição
        $this->db->where('fk_usuario', $cod_usuario);
        $this->db->where('status', '0');
        $result_revalidacao = $this->db->update('REDEFINICAO',  array('status' => '1'));

        return $result_login && $result_revalidacao;
    }

    /**
     *  Envia email com link para redefinição de senha
     *
     * @param      string  $emailto  O email que será enviado
     * @param      string  $token_id    A senha
     */
    public function sendEmailRedefinicao($emailto, $token_id)
    {

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.minharevisao.com.br',
            'smtp_port' => 587,
            'smtp_user' => 'envio@minharevisao.com.br',
            'smtp_pass' => 'Revisao2019@@'
        );


        $this->email->initialize($config);

        $this->email->set_newline("<br>");

        $this->email->subject(' Redefinição de senha Minha Revisão ');


        $body = "<h3> Redefinição de senha Minha Revisão </h3>";
        $body .= "<p> Clique <a href='" . base_url('login/redefinicao/') .  $token_id . "'>aqui</a> para acessar a página de redefinição de senha. </p>";
        $body .= "<p> Este link para redefinição expira em 24 horas. </p>";
        $body .= "<p> Atenciosamente. <br> Equipe Minha Revisão. </p>";


        $this->email->from('envio@minharevisao.com.br', 'Equipe Minha Revisão');
        $this->email->to($emailto);
        $this->email->set_mailtype("html");
        $this->email->message($body);
        $result = $this->email->send();


        $this->email->clear(TRUE);

        return  $result;
    }

    /*### VOLANTY ###*/

    /**
     *  Busca no banco de dados DE REGISTRO DE USÁRIO DA VOLANTY por um login com o user e senha informados
     *
     * @param       string  $user   Informações do login
     *
     * @param       string  $senha  Informações do login
     *
     * @return      array  Retorna o login caso ele exista
     */
    public function loginVolanty($user, $senha)
    {
        $query = $this->db->get_where('VOLANTY', array('usuario' => $user, "senha" => md5($senha)));

        $result = $query->row();

        return  $result;
    }

    public function getVolantyUserInfo($moip_id)
    {

        $query = $this->db->get_where('VOLANTY', array('moip_id' => $moip_id));

        $result = $query->result_array();

        return  $result[0];
    }
}
