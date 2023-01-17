<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regiao_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
    }
    
    public function getAll($admin = false){
        if(!$admin){$this->db->where('status', 1);}
        $query = $this->db->get('REGIAO');
        return $query->result_array();
    }
    public function getById($id_regiao){
        $query = $this->db->get_where('REGIAO', ['cod_regiao'=>$id_regiao, 'status'=>1]);
        return $query->row_array();
    }
    public function insert($regiao){
        $this->db->insert('REGIAO', $regiao);
        return $this->db->insert_id();
    }
    public function update($set, $id){
        $query = $this->db->update('REGIAO' ,$set, ['cod_regiao'=>$id]);
        return $query;
    }
}
?>