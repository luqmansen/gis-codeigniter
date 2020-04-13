<?php

require_once(APPPATH.'models/BaseModel.php');
class Photo extends BaseModel
{
	function get_photo_by_area($area_id){
		$this->db->select('photo_data');
		$this->db->from('photo');
		$this->db->where('area_id', $area_id);
		return $this->db->get()->result();
}
}
