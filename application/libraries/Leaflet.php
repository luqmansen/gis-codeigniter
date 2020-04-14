<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter leaflet Js Class
 *
 *
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		anggriyulio (Anggri Yulio P)
 * @link		http://anggriyulio.com/
 */

class Leaflet
{
	protected $ci;
	var $tileLayer = "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=";
	var $attribution = '© <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>';
	var $map_type = 'mapbox/satellite-v9';

// Map State Options
	var $center = "-0.959, 100.39716";
	var $zoom = "13";
	var $layers = "";
	var $map_name = "map";
	var $minZoom = "";
	var $maxZoom = "";
	var $user = "";
	var $crs = "L.CRS.EPSG3857";

	// Interaction options
	var $dragging = TRUE;
	var $touchZoom = TRUE;
	var $scrollWheelZoom = TRUE;
	var $doubleClickZoom = TRUE;
	var $boxZoom = TRUE;
	var $tap = TRUE;
	var $tapTolerance = 15;
	var $trackResize = TRUE;
	var $worldCopyJump = FALSE;
	var $closePopupOnClick = TRUE;
	var $bounceAtZoomLimits = TRUE;

	// Control options
	var $zoomControl = TRUE;
	var $attributionControl = TRUE;

	// Events
	var $click = '';
	var $dblclick = '';
	var $mousedown = '';
	var $mouseup = '';
	var $mouseover = '';
	var $mouseout = '';
	var $mousemove = '';
	var $press = '';
	var $focus = '';
	var $blur = '';
	var $existing = '';
	var $load = '';
	var $unload = '';
	var $creating = '';
	var $movestart = '';
	var $move = '';
	var $moveend = '';
	var $dragstart = '';
	var $drag = '';
	var $dragend = '';
	var $zoomstart = '';
	var $zoomend = '';
	var $zoomlevelschange = '';
	var $resize = '';
	var $autopanstart = '';
	var $layeradd = '';
	var $layerremove = '';
	var $baselayerchange = '';
	var $overlayadd = '';
	var $overlayremove = '';
	var $locationfound = '';
	var $locationerror = '';
	var $popupopen = '';
	var $popupclose = '';
	var $customFunction = '';

	var $markers = array();
	var $geojson = array();
	var $output_html;
	var $output_js_contents;


	public function __construct()
	{
		$this->ci =& get_instance();
		$this->tileLayer .= getenv('mapbox_api_key');
	}

	function leaflet($config = array())
	{
		if (count($config) > 0) {
			$this->initialize($config);
		}
	}

	function initialize($config = array())
	{
		foreach ($config as $key => $val) {
			if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
	}

	function add_geojson($params = array())
	{
		$geojson = array();
		$geojson['file'] = array();
		$geojson['fillOpacity'] = '0.3';
		$geojson['weight'] = '0.5';
		$geojson['opacity'] = '0.5';
		$geojson['color'] = '#11f43F';
		$geojson['colorOuter'] = '#8934eb';
		$geojson['customCategory'] = TRUE;
		$geojson['categories'] = '';
		$geojson['labeled'] = TRUE;

		$geojson_output = '';
		foreach ($params as $key => $value) {
			if (isset($geojson[$key])) {
				$geojson[$key] = $value;
			}
		}
		$geojson_output .= '
		
			function AddPolygon(data) {
					var geojson = JSON.parse(data["geojson_data"]);
					var area_name = data[\'area_name\']
					var image = data[\'photo\'][0]
					var category_name = data[\'category_name\']
					var color = data[\'color\']
					
					L.geoJson(geojson, {
						style: function (feature){';

						if ($geojson['customCategory'] == TRUE) {

							$geojson_output .= '
										return {
											fillOpacity: ' . $geojson['fillOpacity'] . ',
											fillColor : color,
											dashArray: "30 8",	
											lineCap : "square",
											weight : 0.5,
											"color": color,
											"opacity": ' . $geojson['opacity'] . '
										}},
										';
							$geojson_output .='
								onEachFeature : function (data, layer) {
									var info = "<p>"+  area_name + "</p>"
									info += "<p>type: "+ category_name  + "</p>"
									var img = "data:image/png;base64,"
									img +=  image[\'photo_data\']
									info += "<img src="
									info += img 
									info += " class=\'ppcont\'>"
									layer.bindPopup(info);
									layer.on(\'click\', function () {
										layer.openPopup()
									})
								}}).addTo(map)}
								';
		}

		foreach ($geojson['file']['polygon'] as $e){
			$geojson_output .='
			AddPolygon('.json_encode($e).');
			';
		}

		array_push($this->geojson, $geojson_output);
	}


	function add_marker($params = array())
	{

		$marker = array();
		//$this->markersInfo['marker_'.count($this->markers)] = array();

		$marker['latlng'] = "-0.9583407792361563,100.3982162475586";
		$marker['icon'] = "";
		$marker['clickable'] = TRUE;
		$marker['draggable'] = FALSE;
		$marker['keyboard'] = TRUE;
		$marker['title'] = "";
		$marker['alt'] = "";
		$marker['zIndexOffset'] = 0;
		$marker['opacity'] = 1.0;
		$marker['riseOnHover'] = FALSE;
		$marker['riseOffset'] = 250;

		// Marker Event
		$marker['dragend'] = "";
		$marker['customFunction'] = "";
		$marker['iconColor'] = "";
		$marker['spin'] = FALSE;
		$marker['extraClasses'] = "";
		$marker['popupContent'] = "";

		// Marker Icon
		$marker['customicon'] = FALSE;
		$marker['iconUrl'] = "";
		$marker['iconRetinaUrl'] = "";
		$marker['iconSize'] = "[20,20]";
		$marker['iconAnchor'] = "";
		$marker['popupAnchor'] = "";
		$marker['shadowUrl'] = "";
		$marker['shadowRetinaUrl'] = "";
		$marker['shadowSize'] = "";
		$marker['shadowAnchor'] = "";
		$marker['className'] = "icon-marker";

		$marker_output = '';
		foreach ($params as $key => $value) {
			if (isset($marker[$key])) {
				$marker[$key] = $value;
			}
		}

		// Create the marker
		$marker_output .= 'marker = new L.marker([' . $marker['latlng'] . '],({';

		// Start of marker options
		if (!$marker['clickable']) {
			$marker_output .= 'clickable: false,';
		}
		if (!$marker['draggable'] == false) {
			$marker_output .= 'draggable: true,';
		}

		if (!$marker['keyboard']) {
			$marker_output .= '"keyboard":false,';
		}
		if ($marker['title']) {
			$marker_output .= '"title":"' . $marker['title'] . '",';
		}
		if ($marker['alt']) {
			$marker_output .= '"alt":"' . $marker['alt'] . '",';
		}
		if ($marker['zIndexOffset']) {
			$marker_output .= '"zIndexOffset":' . $marker['zIndexOffset'] . ',';
		}
		if (!$marker['opacity']) {
			$marker_output .= '"opacity":' . $marker['opacity'] . ',';
		}
		if ($marker['riseOnHover']) {
			$marker_output .= '"riseOnHover":true,';
		}
		if (!$marker['riseOffset']) {
			$marker_output .= '"riseOffset":' . $marker['riseOffset'] . ',';
		}
		if ($marker['extraClasses']) {
			$marker_output .= '"extraClasses" : "' . $marker['extraClasses'] . '",';
		}

		// Custom Marker Icon
		if ($marker['customicon'] == TRUE) {
			$marker_output .= 'icon: L.icon({';

			$marker_output .= 'iconUrl: "' . $marker['iconUrl'] . '",';

			if (!$marker['iconRetinaUrl'] == "") {
				$marker_output .= 'iconRetinaUrl: "' . $marker['iconRetinaUrl'] . '",';
			}
			if (!$marker['iconSize'] == "") {
				$marker_output .= 'iconSize: ' . $marker['iconSize'] . ',';
			}
			if (!$marker['iconAnchor'] == "") {
				$marker_output .= 'iconAnchor: ' . $marker['iconAnchor'] . ',';
			}
			if (!$marker['popupAnchor'] == "") {
				$marker_output .= 'popupAnchor: ' . $marker['popupAnchor'] . ',';
			}
			if (!$marker['shadowUrl'] == "") {
				$marker_output .= 'shadowUrl: "' . $marker['shadowUrl'] . '",';
			}
			if (!$marker['shadowRetinaUrl'] == "") {
				$marker_output .= 'shadowRetinaUrl: "' . $marker['shadowRetinaUrl'] . '",';
			}
			if (!$marker['shadowSize'] == "") {
				$marker_output .= 'shadowSize: ' . $marker['shadowSize'] . ',';
			}
			if (!$marker['shadowAnchor'] == "") {
				$marker_output .= 'shadowAnchor: ' . $marker['shadowAnchor'] . ',';
			}
			if (!$marker['className'] == "") {
				$marker_output .= 'className: "' . $marker['className'] . '",';
			}
			$marker_output .= '}),';
		}
		// End of Custom icon


		// End of marker options
		$marker_output .= '}))';


		if ($marker['popupContent'] != "") {
			$marker_output .= '.bindPopup("' . $marker['popupContent'] . '")';
		}
		$marker_output .= '.addTo(map);';

		if ($marker['dragend'] != "") {
			$marker_output .= 'marker.on("dragend", ' . $marker['dragend'] . ');';
		}

		if ($marker['customFunction'] != "") {
			$marker_output .= $marker['customFunction'];
		}

		array_push($this->markers, $marker_output);
	}


	function create_map()
	{
		$this->output_js = '';
		$this->output_js_contents = '';
		$this->output_html = '';
		$this->output_html .= '<div id="map" style="width:100%; height:500px;"></div>';

		$this->output_js_contents .= '
			var map = L.map("map",{
				center: [' . $this->center . '],
				zoom: ' . $this->zoom . ',
				dragging: ' . $this->dragging . '
			})
			';

		$this->output_js_contents .= '
			L.tileLayer("' . $this->tileLayer . '", {';

		$this->output_js_contents .= "id: '$this->map_type'";

		$this->output_js_contents .= '
			}).addTo(map)
			';

		if ($this->customFunction != "") {
			$this->output_js_contents .= $this->customFunction;
		}

		if ($this->click != "") {
			$this->output_js_contents .= '
			 ' . $this->map_name . '.on("click",' . $this->click . ');
			';
		}


		/*
		* Add marker.
		* @uses add_marker
		*/
		if (count($this->markers)) {
			foreach ($this->markers as $marker) {
				$this->output_js_contents .= $marker;
			}
		}

		if (count($this->geojson)) {
			foreach ($this->geojson as $geojson) {
				$this->output_js_contents .= $geojson;
			}
		}


		$this->output_js .= '
			<script type="text/javascript">';
		$this->output_js .= '
			$(document).ready(function() {' . $this->output_js_contents . '})';
		$this->output_js .= '
			</script>';

		return array('js' => $this->output_js, 'html' => $this->output_html);
	}
}
