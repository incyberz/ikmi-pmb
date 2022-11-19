<?php 
include "config.php";


if(isset($_POST['id'])){

	$id = $_POST['id'];
	$alasan_hapus = $_POST['alasan_hapus'];

	$s = "UPDATE kip_prio set status=0, alasan_hapus='$alasan_hapus' where id= $id";
	// echo "$s";
	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));


	echo "<h3>Data telah dihapus.</h3><hr>
	<a href='kip_prioritas_2021.php'>Back to List</a>
	";
	exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : die("id not set.");

$s = "SELECT * from kip_prio 
where id= $id
";
// echo "$s";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

if(mysqli_num_rows($q)==0) die("Data tidak ada.");

$d = mysqli_fetch_assoc($q);

$nama_siswa = $d['nama_siswa'];





?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Hapus KIP Prio</title>
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>Hapus Data</h1>

		<form method="post">
			<div class="form-group">
				<h5>Yakin untuk menghapus Data KIP Prioritas atas nama <?=$nama_siswa ?> ?</h5>
				<input type="hidden" name="id" value="<?=$id?>">
				<p>Alasan dihapus:</p>
				<textarea rows="5" required="" class="form-control" name="alasan_hapus"></textarea>
			</div>
			<div class="form-group" style="margin-top:10px">
				<a class="btn btn-success" href='kip_prioritas_2021.php'>Back to List</a>  
				<button class="btn btn-danger">Yakin. Hapus !</button>
			</div>
		</form>
	</div>

</body>
</html>