<?php


class BaseModelClass extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}
}
