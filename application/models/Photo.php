<?php

require_once(APPPATH . 'models/BaseModelClass.php');
require_once(APPPATH . 'models/BaseModelInterface.php');

class Photo extends BaseModelClass implements BaseModelInterface
{
	function get_all()
	{
		return $this->db->get('photo')->result();
	}

	function get_row_by_id($id)
	{
		$this->db->select('photo_data');
		$this->db->from('photo');
		$this->db->where('id', $id);
		return $this->db->get()->result();
	}

	function get_photo_by_area_id($area_id)
	{
		$this->db->select('photo_data');
		$this->db->from('photo');
		$this->db->where('area_id', $area_id);
		return $this->db->get()->result();
	}

}
