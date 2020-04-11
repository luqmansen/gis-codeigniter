<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GIS Application</title>
	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

	<link href="<?=base_url()?>assets/css/BootSideMenu.css" rel="stylesheet">
	<script src="<?=base_url()?>assets/js/html5shiv.min.js"></script>
	<script src="<?=base_url()?>assets/js/respond.min.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />

	<style type="text/css">
		.user{
			padding:5px;
			margin-bottom: 5px;
		}
		#mapid { height: 500px; }
	</style>
</head>
<body>

<!--Test -->
<div id="test">
	<h2>GIS Menu</h2>
	<div class="list-group">
		<a href="#" class="list-group-item active">Cras justo odio</a>
		<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
	</div>

</div>
<!--/Test -->


<!--Normale contenuto di pagina-->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>GIS Application</h1>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="mapid"></div>
		</div>
	</div>



</div>

<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/BootSideMenu.js"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

<script type="text/javascript">
	$('#test').BootSideMenu({side:"left", autoClose:false});
</script>
<script type="text/javascript">

	var map = L.map('mapid').setView([51.505, -0.09], 13);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	L.marker([51.5, -0.09]).addTo(map)
		.bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
		.openPopup();

</script>
</body>
</html>
