<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends CI_Model
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
	public function login($user, $senha)
	{

		$query = $this->db->get_where('LOGIN', array('email' => $user, "senha" => md5($senha), "tipo" => 1));

		$result = $query->row();

		return  $result;
	}


	/**
	 *  Retorna a lista de unidades cadastradas no sistema
	 *
	 * @param       INT  $offset  numeração para paginação
	 *
	 *
	 * @return      array  Retorna lista de unidades
	 */
	public function listaUnidades($offset = 0)
	{
		$result = array();
		$this->db->order_by('cod_lojista', 'DESC');

		if (!filter_var($offset, FILTER_VALIDATE_INT))
			$offset = 0;

		//Contagem de linhas antes do limit
		$result['count'] = $this->db->count_all_results('LOJISTA', false);

		$this->db->limit(10, $offset * 10);

		$query = $this->db->get();
		$result['lista_unidades'] = $query->result_array();
		return  $result;
	}

	public function listaPedidos($offset = 0, $fk_lojista = 0)
	{
		$result = array();
		$this->db->order_by('cod_agenda', 'DESC');

		if (!filter_var($offset, FILTER_VALIDATE_INT))
			$offset = 0;

		//Contagem de linhas antes do limit
		$result['count'] = $this->db->count_all_results('AGENDA', false);

		$this->db->limit(10, $offset * 10);

		if ($fk_lojista != 0) {
			$this->db->where(array('fk_lojista' => $fk_lojista));
		}
		$this->db->select("*, LOGIN.nome as nome_usuario, SERVICOS.nome as nome_servicos");

		$this->db->join('LOGIN', 'AGENDA.fk_usuario = LOGIN.cod_login');
		$this->db->join('LOJISTA', 'AGENDA.fk_lojista = LOJISTA.cod_lojista');
		$this->db->join('SERVICOS', 'AGENDA.fk_servico = SERVICOS.cod_servicos');

		$query = $this->db->get();
		$result['lista_pedidos'] = $query->result_array();

		return  $result;
	}

	// LISTA GERAL PARA EXPORTAR TODOS OS PEDIDOS
	public function listaGeralPedidos()
	{
		$result = array();
		$this->db->order_by('cod_agenda', 'DESC');
		$this->db->select("
				AGENDA.cod_agenda, AGENDA.data, AGENDA.periodo, AGENDA.voucher, AGENDA.moip_order_id,  AGENDA.moip_ultimo_status_payment,

				LOJISTA.nome_unidade, LOJISTA.regiao, LOJISTA.endereco,
				
				SERVICOS.nome as nome_servicos, SERVICOS.preco,
				
				MODELOS.montadora, MODELOS.modelo, MODELOS.motor, AGENDA.ano_carro, 

				LOGIN.nome as nome_usuario, LOGIN.email, LOGIN.telefone_contato, LOGIN.cep, LOGIN.cidade, LOGIN.bairro, LOGIN.rua, LOGIN.numero_casa, LOGIN.complemento
			");

		$this->db->join('LOGIN', 'AGENDA.fk_usuario = LOGIN.cod_login');
		$this->db->join('LOJISTA', 'AGENDA.fk_lojista = LOJISTA.cod_lojista');
		$this->db->join('SERVICOS', 'AGENDA.fk_servico = SERVICOS.cod_servicos');
		$this->db->join('MODELOS', 'SERVICOS.fk_modelo = MODELOS.cod_modelo');

		$query = $this->db->get('AGENDA');
		$result['lista_pedidos'] = $query->result_array();

		$i = 0;
		foreach ($result['lista_pedidos'] as $pedido) {
			$result['lista_pedidos'][$i]['periodo'] = $pedido['periodo'] == 1 ? "Matutino" : "Vespertino";

			switch ($pedido['regiao']) {
				case '1':
					$result['lista_pedidos'][$i]['regiao'] = 'São Paulo - Norte';
					break;
				case '2':
					$result['lista_pedidos'][$i]['regiao'] = 'São Paulo - Sul';
					break;
				case '3':
					$result['lista_pedidos'][$i]['regiao'] = 'São Paulo - Leste';
					break;
				case '4':
					$result['lista_pedidos'][$i]['regiao'] = 'São Paulo - Oeste';
					break;
				case '5':
					$result['lista_pedidos'][$i]['regiao'] = 'São Paulo - Centro';
					break;
				case '6':
					$result['lista_pedidos'][$i]['regiao'] = 'Santo André';
					break;
				case '7':
					$result['lista_pedidos'][$i]['regiao'] = 'São Bernardo';
					break;
				case '8':
					$result['lista_pedidos'][$i]['regiao'] = 'São Caetano';
					break;
				case '9':
					$result['lista_pedidos'][$i]['regiao'] = 'Diadema';
					break;
				case '10':
					$result['lista_pedidos'][$i]['regiao'] = 'Mauá';
					break;
				case '11':
					$result['lista_pedidos'][$i]['regiao'] = 'Piracicaba';
					break;
				case '12':
					$result['lista_pedidos'][$i]['regiao'] = 'Guarulhos';
					break;
				case '13':
					$result['lista_pedidos'][$i]['regiao'] = 'Osasco';
					break;
				case '14':
					$result['lista_pedidos'][$i]['regiao'] = 'Barueri';
					break;
				case '15':
					$result['lista_pedidos'][$i]['regiao'] = 'Rio de Janeiro';
					break;
				case '16':
					$result['lista_pedidos'][$i]['regiao'] = 'Porto Alegre';
					break;
				case '17':
					$result['lista_pedidos'][$i]['regiao'] = 'Belo Horizonte';
					break;
				case '18':
					$result['lista_pedidos'][$i]['regiao'] = 'Mato Grosso do Sul';
					break;
				case '19':
					$result['lista_pedidos'][$i]['regiao'] = 'Mogi das Cruzes';
					break;	
				case '20':
					$result['lista_pedidos'][$i]['regiao'] = 'São José dos Campos';
					break;
				case '21':
					$result['lista_pedidos'][$i]['regiao'] = 'Ribeirão Preto';
					break;
			}
			$i++;
		}
		return  $result;
	}

	// LISTA GERAL PARA EXPORTAR TODOS OS USUÁRIOS
	public function listaGeralUsuarios()
	{
		$result = array();
		$this->db->order_by('cod_login', 'DESC');

		$this->db->select("
				LOGIN.cod_login, 
				LOGIN.nome as nome_usuario, 
				LOGIN.email, 
				LOGIN.telefone_contato, 
				LOGIN.cep, 
				LOGIN.cidade, 
				LOGIN.bairro, 
				LOGIN.rua, 
				LOGIN.numero_casa,
				LOGIN.complemento
			");

		$query = $this->db->get('LOGIN');
		$result['lista_usuarios'] = $query->result_array();

		return  $result;
	}

	public function listaUsuarios($offset = 0)
	{
		$result = array();
		$this->db->order_by('cod_login', 'DESC');

		if (!filter_var($offset, FILTER_VALIDATE_INT))
			$offset = 0;

		//Contagem de linhas antes do limit
		$result['count'] = $this->db->count_all_results('LOGIN', false);

		$this->db->limit(10, $offset * 10);
		$this->db->where(array('tipo' => 0));
		$query = $this->db->get();
		$result['lista_usuarios'] = $query->result_array();
		return  $result;
	}

	public function verificarLojista($fk_lojista)
	{
		$query = $this->db->get_where('LOJISTA', array('cod_lojista' => $fk_lojista));
		if ($query->num_rows() != 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 *  Retorna a lista de veículos cadastrados no sistema
	 *
	 * @param       INT  $offset  numeração para paginação
	 *
	 *
	 * @return      array  Retorna lista de veículos
	 */
	public function listaVeiculos($offset = 0)
	{
		$result = array();
		$this->db->order_by('cod_modelo', 'DESC');
		$this->db->group_by('montadora');
		$this->db->group_by('modelo');

		if (!filter_var($offset, FILTER_VALIDATE_INT)) {
			$offset = 0;
		}

		$result['count'] = $this->db->count_all_results('MODELOS', false);

		$this->db->limit(20, $offset * 20);

		$query = $this->db->get();
		$result['lista_veiculos'] = $query->result_array();

		return  $result;
	}

	/**
	 * VEÍCULOS
	 */
	public function checkVeiculo($veiculo)
	{
		$this->db->where(array(
			'montadora' => $veiculo['montadora'],
			'modelo' => $veiculo['modelo'],
		));
		return $this->db->count_all_results('MODELOS', TRUE);
	}

	public function insertVeiculo($veiculo)
	{
		$this->db->insert('MODELOS', $veiculo);

		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	public function editVeiculo($old, $new)
	{
		 $this->db->where(array('montadora'=>$old['montadora'], 'modelo'=>$old['modelo']));
		 $query = $this->db->get('MODELOS');
		 $result = $query->result_array();
		foreach ($result as $veiculo) {
			$sql = "UPDATE MODELOS SET montadora = '".$new['montadora']."', modelo = '".$new['modelo']."' WHERE cod_modelo = '".$veiculo['cod_modelo']."'";
			$this->db->query($sql);
		}
	}


	/**
	 *  Retorna os motores e os serviços dos veículos cadastrados de acordo com a sua montadora e seu modelo
	 *  Veiculo = montadora, modelo, motores, servicos
	 *
	 * @param       INT  $cod_veiculo código de um dos veiculos com montadora e modelo desejados
	 *
	 *
	 * @return      array  Retorna lista de motores e serviços
	 */
	public function getVariacoesVeiculo($cod_veiculo)
	{
		$veiculo = $this->getVeiculoById($cod_veiculo);

		$this->db->select('cod_modelo, motor, customizado');
		$query = $this->db->get_where('MODELOS', array('montadora' => $veiculo['montadora'], 'modelo' => $veiculo['modelo']));
		$lista_variacoes = $query->result_array();

		for ($i = 0; $i < sizeof($lista_variacoes); $i++) {
			$lista_variacoes[$i]['servicos'] = $this->getServicosByVeiculo($lista_variacoes[$i]['cod_modelo']);
		}

		return $lista_variacoes;
	}

	/**
	 *  Retorna o registro do veículo de acordo com o seu id
	 *
	 * @param       INT  $cod_veiculo  Id do veículo
	 *
	 *
	 * @return      array  Informações do vículo
	 */
	public function getVeiculoById($cod_veiculo)
	{
		$query = $this->db->get_where('MODELOS', array('cod_modelo' => $cod_veiculo));

		$result = $query->row_array();

		return  $result;
	}

	/**
	 *  Retorna os servicos de acordo com o veiculo 
	 *
	 * @param       INT  $cod_veiculo  Id do veículo
	 *
	 *
	 * @return      array  lista de servicos
	 */
	public function getServicosByVeiculo($cod_veiculo)
	{
		$query = $this->db->get_where('SERVICOS', array('fk_modelo' => $cod_veiculo));

		$result = $query->result_array();

		return  $result;
	}

	/**
	 *  Insere uma nova variação para um veículo
	 *
	 * @param       array  $variacao dados da inserção e dos serviços
	 *
	 *
	 * @return      INT  	Número e linhas inseridas ou false
	 */
	public function insertVariacao($variacao)
	{
		$this->db->insert('MODELOS', $variacao['veiculo']);

		$insert_id = $this->db->insert_id();

		$return = $this->insertServicos($insert_id, $variacao['servicos']);

		return  $return != false ? $insert_id : false;
	}

	public function checkVariacao($variacao)
	{
		$this->db->where(array(
			'montadora' => $variacao['montadora'],
			'modelo' => $variacao['modelo'],
			'motor' => $variacao['motor']
		));
		return $this->db->count_all_results('MODELOS', true);
	}

	public function insertServicos($cod_modelo, $servicos)
	{

		$insert_data = array(
			array('nome' => 'Servico Basico', 'preco' => $servicos[0], 'consulta' => null, 'fk_modelo' => $cod_modelo),
			array('nome' => 'Servico Intermediario', 'preco' => $servicos[1], 'consulta' => null, 'fk_modelo' => $cod_modelo),
			array('nome' => 'Servico Preium', 'preco' => $servicos[2], 'consulta' => null, 'fk_modelo' => $cod_modelo),
		);

		return $this->db->insert_batch('SERVICOS', $insert_data);
	}

	public function updateVariacao($variacao)
	{
		$sql = "UPDATE MODELOS SET montadora = '".$variacao['montadora']."', modelo = '".$variacao['modelo']."', motor = '".$variacao['motor']."', customizado = '".$variacao['customizado']."' WHERE cod_modelo = '".$variacao['cod_modelo']."'";
		return $this->db->query($sql);
	}

	public function updateServico($servico)
	{
		$this->db->where('cod_servicos', $servico['cod_servico']);
		$this->db->set(array('preco' => $servico['preco']));
		return $this->db->update('SERVICOS');
	}
}
