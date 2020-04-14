<?php

require_once(APPPATH . 'models/BaseModelClass.php');
require_once(APPPATH . 'models/BaseModelInterface.php');

class Category extends BaseModelClass implements BaseModelInterface
{

	public function get_all()
	{
		return $this->db->get('category')->result();
	}

	function get_row_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

}
