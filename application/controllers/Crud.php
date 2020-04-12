<?php


class Crud extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('area');
		$this->load->helper('url');
		$this->load->library('upload');

	}

	function index(){
		echo "hello";
	}

	function new_geo(){
		$this->load->view('v_upload_geo');
	}

	function add_geo(){

		$location = $_FILES['geojson_data']['tmp_name'];
		$geojson_data  = file_get_contents($location);

		$data = array(
			'area_name'  => $this->input->post('area_name'),
			'area_code' => $this->input->post('area_code'),
			'geojson_data' => $geojson_data,
		);

		$this->area->insert_data($data,'area');
		redirect('/home');

	}
}
