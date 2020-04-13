<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('leaflet');
		$this->load->model('area');
	}

	public function index()
	{

		$config = array(
			'center' => '-7.551138838214100,110.335972309112', // Center of the map
			'zoom' => 18, // Map zoom
		);
		$this->leaflet->initialize($config);

		$marker = array(
			'latlng' => '-0.959, 100.39716', // Marker Location
			'popupContent' => 'Hi, iam a popup!!', // Popup Content
		);

		$polygon = array();
		$area = $this->area->get_area();

		foreach ($area as $a) {
			$photo =
			array_push($polygon, $a);
		}


		$files = array(
			"polygon" => $polygon,
			"polyline" => array(),
			"point" => array()
		);

		$categories = array(
			'100' => '#3471eb'
		);
		$layerName = array();

		$geojson = array(
			'file' => $files,
			'categories' => $categories,
			'layerName' => $layerName,
			'fillOpacity' => '0.6'

		);
		$this->leaflet->add_geojson($geojson);

//		$this->leaflet->add_marker($marker);

		$data['map'] = $this->leaflet->create_map();

		$this->load->view('v_home', $data);
	}
}

