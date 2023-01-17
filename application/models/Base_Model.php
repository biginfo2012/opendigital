<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'models/objetos/EX_objeto.php';

class Index_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	
	//https://www.codeigniter.com/userguide3/database/query_builder.html
	public function Ex()
	{
		//$query = $this->db->get('mytable');  // Produces: SELECT * FROM mytable
		
		
		
		//$query = $this->db->get('mytable', 10, 20);
		// Executes: SELECT * FROM mytable LIMIT 20, 10
		// (in MySQL. Other databases have slightly different syntax)
		
		
		//$this->db->where('name', $name); // Produces: WHERE name = 'Joe'
		
		//$this->db->like('title', 'match');
		// Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
		
		
		
		
		
		/*
		$data = array(
        'title' => 'My title',
        'name' => 'My Name',
        'date' => 'My date'
		);

		$this->db->insert('mytable', $data);
		// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
		*/
		
		
		
		
		
		
		
		
		
		/*
		$data = array(
        'title' => $title,
        'name' => $name,
		'date' => $date
		);

		$this->db->where('id', $id);
		$this->db->update('mytable', $data);
		// Produces:
		//
		//      UPDATE mytable
		//      SET title = '{$title}', name = '{$name}', date = '{$date}'
		//      WHERE id = $id
		*/
		
		
		
		
		
		
		
		
		
		
		
		/*
		$this->db->where('id', $id);
		$this->db->delete('mytable');

		// Produces:
		// DELETE FROM mytable
		// WHERE id = $id
		*/
	}
	
	/* 
	    public function inserir($ponto) {
        $sql = "INSERT INTO TB_PONTO ( cod_pessoa, cod_cliente, hr_entrada, hr_saida, ip_entrada, "
                . " ip_saida, tp_atendimento, ds_atendimento, ds_motivo, "
                . "hr_almoco_saida, hr_almoco_volta, "
                . "hr_pausa_saida, hr_pausa_volta) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($sql,array(
            $ponto->cod_pessoa,
            $ponto->cod_cliente,
            $ponto->hr_entrada,
            $ponto->hr_saida,
            $ponto->ip_entrada,
            $ponto->ip_saida,
            $ponto->tp_atendimento,
            $ponto->ds_atendimento,
            $ponto->ds_motivo,
            $ponto->hr_almoco_saida,
            $ponto->hr_almoco_volta,
            $ponto->hr_pausa_saida,
            $ponto->hr_pausa_volta
            ));

        return $query; 
       
    }	
	*/
}