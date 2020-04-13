<?php


class Crud extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('area');
		$this->load->model('photo');
		$this->load->helper('url');
		$this->load->library('upload');

	}

	function index(){
		echo "hello";
	}

	function new_geo(){
		$this->load->view('management/v_upload_geo');
	}
	function new_photo(){
		$this->load->view('management/v_upload_photo');
	}

	function add_geo(){

		$location = $_FILES['geojson_data']['tmp_name'];
		$geojson_data  = file_get_contents($location);

		$data = array(
			'area_name'  => $this->input->post('area_name'),
			'id_category' => $this->input->post('area_code'),
			'geojson_data' => $geojson_data,
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
