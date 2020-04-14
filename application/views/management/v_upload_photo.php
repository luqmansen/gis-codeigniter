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

<h2>Upload Photo</h2>
<form action="<?php echo base_url() . 'crud/add_photo'; ?>" method="post" enctype="multipart/form-data">
	<fieldset>
		<table>
			<tr>
				<td><label for="area_id">Area name:</label></td>
				<td><select name="area_id" style="width: 100px">
						<?php
						foreach ($area as $e) {
							echo '<option value="' . $e->id . '">' . $e->area_name . '</option>';
						}
						?>
					</select></td>
			</tr>
			<tr>
				<td><label for="photo_data">Photo File:</label></td>
				<td><input class="inputfile" type="file" name="photo_data"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit"></td>
			</tr>
		</table>
	</fieldset>
</form>
</body>
</html>

