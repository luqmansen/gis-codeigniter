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
	<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/css/jquerysctipttop.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link href="<?=base_url()?>assets/css/BootSideMenu.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/MarkerCluster.css" rel="stylesheet">

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

	<style type="text/css">
		.user{
			padding:5px;
			margin-bottom: 5px;
		}
		#map { height: 500px; }
	</style>
</head>
<body>

<div id="test">
	<h2>Menu</h2>
	<div class="list-group">
		<a href="<?=base_url()?>crud/new_geo/" class="list-group-item active">Upload GeoJson</a>
	</div>

</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Sistem Pemetaan Wilayah</h1>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php echo $map['html']; ?>
			<?php echo $map['js']; ?>

		</div>
	</div>



</div>
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/BootSideMenu.js"></script>
<!--<script src="--><?//=base_url()?><!--assets/js/MarkerClusterGroup.js"></script>-->
<script type="text/javascript">
	var base_url = "<?=base_url()?>"
	$('#test').BootSideMenu({side:"left", autoClose:false});
</script>
</body>
</html>
