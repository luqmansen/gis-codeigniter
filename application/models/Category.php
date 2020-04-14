<?php

require_once(APPPATH.'models/BaseModel.php');
class Category extends BaseModel
{
	function get_category_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
}
