<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<title>Data Barang</title>
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
	<style>
		.ppcont {
			width: 200px;
		}

		a {
			text-decoration: none;
			display: inline-block;
			padding: 8px 16px;
		}

		a:hover {
			background-color: #ddd;
			color: black;
		}

		.previous {
			background-color: #f1f1f1;
			color: black;
		}
	</style>
</head>
<body>
<a href="<?= base_url() ?>" class="previous">&laquo; Back</a>
<div class="container">
	<h1>Data <small>Area </small></h1>
	<table class="table table-bordered table-striped" id="area">
		<thead>
		<tr>
			<td>id</td>
			<td>Nama Area</td>
			<td>Deskripsi Area</td>
			<td>Jenis Kategori</td>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($area as $a):
			?>
			<tr>
				<td><?php echo $a->id; ?> </td>
				<td><?php echo $a->area_name; ?> </td>
				<td><?php echo $a->area_description; ?> </td>
				<td><?php echo $a->id_category; ?> </td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<h1>Data <small>Category </small></h1>
	<table class="table table-bordered table-striped" id="category">
		<thead>
		<tr>
			<td>id</td>
			<td>Nama Kategori</td>
			<td>Warna</td>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($category as $a):
			?>
			<tr>
				<td><?php echo $a->id; ?> </td>
				<td><?php echo $a->category_name; ?> </td>
				<td bgcolor=<?php echo $a->color; ?>></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<h1>Data <small>Photo</small></h1>
	<table class="table table-bordered table-striped" id="photo">
		<thead>
		<tr>
			<td>id</td>
			<td>Nama Area</td>
			<td>Photo</td>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($photo as $a):
			?>
			<tr>
				<td><?php echo $a->id; ?> </td>
				<td><?php echo $a->area_id; ?> </td>
				<td><img class="ppcont" src="data:image/png;base64,<?php echo $a->photo_data; ?>"></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<h4> <a href="<?= base_url() ?>crud/export_category/">Download Data</h4>
</div>


<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script>
	$(document).ready(function () {
		$('.table').DataTable();
	});
</script>
</body>
</html>
