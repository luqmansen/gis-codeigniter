<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload GeoJson</title>
	<link href="<?= base_url() ?>assets/css/uploadPhoto.css" rel="stylesheet">
	<style>
		td {
			text-align: left
		}
	</style>
</head>
<body>

<h2>Upload GeoJSON</h2>
<form action="<?php echo base_url() . 'crud/add_geo'; ?>" method="post" enctype="multipart/form-data">
	<fieldset>
		<table>
			<tr>
				<td><label for="area_name">Name:</label></
				>
				<td><input style="width: 211px" type="text" name="area_name"></td>
			</tr>
			<tr>
				<td><label for="id_category">Category:</label></td>
				<td><select name="id_category" style="width: 211px">
						<?php
						foreach ($category as $e) {
							echo '<option value="' . $e->id . '">' . $e->category_name . '</option>';
						}
						?>
					</select></td>
			</tr>
			<tr>
				<td><label for="area_description">Description:</label></td>
				<td><textarea type="text" name="area_description"></textarea></td>
			</tr>
			<tr>
				<td><label for="geojson_data">GeoJSON File:</label></td>
				<td><input class="inputfile" type="file" name="geojson_data"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Submit"></td>
			</tr>
		</table>
	</fieldset>
</form>
</body>
</html>

