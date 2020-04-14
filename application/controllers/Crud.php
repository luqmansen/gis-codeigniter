<?php


class Crud extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('area');
		$this->load->model('photo');
		$this->load->model('category');
		$this->load->helper('url');
		$this->load->library('upload');

	}

	function index()
	{
		$model = array('area', 'photo', 'category');
		$data = array();
		foreach ($model as $m) {
			$data[$m] = $this->$m->get_all();
		}
		foreach ($data["photo"] as $i) {
			$area = $this->area->get_row_by_id($i->area_id);
			$i->area_id = $area->area_name;
		}

		foreach ($data["area"] as $i) {
			$area = $this->category->get_row_by_id($i->id_category);
			$i->id_category = $area->category_name;
		}

		$this->load->view('management/v_show_data', $data);
	}

	function new_geo()
	{
		$category = $this->category->get_all();
		$data = array('category' => $category);
		$this->load->view('management/v_upload_geo', $data);
	}
	function new_photo()
	{
		$area = $this->area->get_all();
		$data = array('area' => $area);
		$this->load->view('management/v_upload_photo', $data);
	}

	function add_geo(){

		$location = $_FILES['geojson_data']['tmp_name'];
		$geojson_data  = file_get_contents($location);

		$data = array(
			'area_name' => $this->input->post('area_name'),
			'area_description' => $this->input->post('area_name'),
			'id_category' => $this->input->post('id_category'),
			'geojson_data' => $geojson_data
		);

		$this->area->insert_data($data,'area');
		redirect('/home');

	}

	function add_photo(){
		$location = $_FILES['photo_data']['tmp_name'];
		$photo_data  = file_get_contents($location);

		$encoded = base64_encode($photo_data);

		$data = array(
			'area_id'  => $this->input->post('area_id'),
			'photo_data' => $encoded,
		);

		$this->photo->insert_data($data,'photo');
		redirect('/home');

	}
}
