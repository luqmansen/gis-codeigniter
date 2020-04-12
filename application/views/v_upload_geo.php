<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload GeoJson</title>
</head>
<body>
	<div style="text-align: center;">
		<h1>Upload GeoJSON file</h1>
		<h3>Tambah data baru</h3>
	</div>

	<form action="<?php echo base_url(). 'crud/add_geo'; ?>" method="post" enctype="multipart/form-data">
		<table style="margin:20px auto;">
			<tr>
				<td>Area Name</td>
				<td><input type="text" name="area_name"></td>
			</tr>
			<tr>
				<td>Area Code</td>
				<td><input type="text" name="area_code"></td>
			</tr>
			<tr>
				<td>GeoJSON File</td>
				<td><input type="file" name="geojson_data" id="geojson_data"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Submit"></td>
			</tr>
		</table>
	</form>

</body>
</html>
