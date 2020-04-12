<?php


class Area extends CI_Model
{

	public function get_area(){
		$q = $this->db->get('area');
		return $q->result();
	}

	function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

}
