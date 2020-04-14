<?php

require_once(APPPATH . 'models/BaseModelClass.php');
require_once(APPPATH . 'models/BaseModelInterface.php');

class Area extends BaseModelClass implements BaseModelInterface
{
	public function get_all()
	{
		$q = $this->db->get('area');
		return $q->result();
	}

	function get_row_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('area');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
}
