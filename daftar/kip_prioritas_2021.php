<?php 
$jumlah_kip_prio = 0;

$rows_data = "
<tr>
	<td colspan='7' style='color:red'>Belum ada data.</td>
</tr>
"; 

$rows_data_deleted = ""; 

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";



include "config.php";




if(isset($_GET['res_id'])){
	$id = $_GET['res_id'];

	$s = "UPDATE kip_prio set status=1, alasan_hapus=NULL where id= $id";
	// echo "$s";
	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

	echo "<h3>Restore sukses.</h3><hr>
	<a href='kip_prioritas_2021.php'>Back to List</a>
	";
	exit();


}





$s = "SELECT * from kip_prio 
WHERE nama_siswa like '%$keyword%'
";
// echo "$s";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$jumlah_rows = mysqli_num_rows($q);

if($jumlah_rows>0){
	$i=0;
	$j=0;
	$rows_data = "";

	while ($d=mysqli_fetch_assoc($q)) {
		$id = $d['id'];
		$nama_siswa = $d['nama_siswa'];
		$program_studi = $d['program_studi'];
		$nik = $d['nik'];
		$nisn = $d['nisn'];
		$kabupaten_kota = $d['kabupaten_kota'];
		$tahun_lulus = $d['tahun_lulus'];
		$alasan_hapus = $d['alasan_hapus'];
		$status = $d['status'];

		$link_delete = "
		<a href='kip_prioritas_2021_delete.php?id=$id'>Hapus</a>
		";

		if($status){
			$jumlah_kip_prio++;
			$i++;
			$rows_data.="
			<tr>
				<td>$i</td>
				<td>$nama_siswa</td>
				<td>$program_studi</td>
				<td>$nik</td>
				<td>$nisn</td>
				<td>$kabupaten_kota</td>
				<td>$tahun_lulus</td>
				<td>$link_delete</td>
			</tr>

			";
		}else{
			$link_restore = "<a href='?res_id=$id' onclick=\"return confirm('Yakin untuk Restore?')\">Restore</a>";

			$j++;
			$rows_data_deleted.="
			<tr>
				<td>$j</td>
				<td>$nama_siswa</td>
				<td>$program_studi</td>
				<td>$alasan_hapus</td>
				<td>$link_restore</td>
			</tr>
			";
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>KIP Prioritas</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>KIP Prioritas :: <?=$jumlah_kip_prio ?> Mahasiswa</h1>

		<form>
			<input type="text" name="keyword"> <button>Cari</button>
		</form>

		<table class="table table-hover">
			<thead>
				<th>No</th>
				<th>Nama Siswa</th>
				<th>Program Studi</th>
				<th>NIK</th>
				<th>NISN</th>
				<th>Kabupaten/Kota</th>
				<th>Tahun Lulus</th>
				<th>Aksi</th>
			</thead>
			<?=$rows_data?>
		</table>

		<hr>
		<div>
			<h2 style="color: red;">Data yang dihapus</h2>
			<table class="table table-hover">
				<thead>
					<th>No</th>
					<th>Nama Siswa</th>
					<th>Program Studi</th>
					<th>Alasan Hapus</th>
					<th>Aksi</th>
				</thead>
				<?=$rows_data_deleted ?>
			</table>
		</div>
	</div>

</body>
</html>