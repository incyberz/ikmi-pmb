<?php 
if(!isset($_GET['k'])) die("Keyword not defined.");
$k = $_GET['k'];

include '../config.php';
$s = "SELECT * from tb_sekolah where nama_sekolah like '%$k%' order by nama_sekolah limit 10";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

$o = "<ul>";
if (mysqli_num_rows($q)==0) {
	// die("Nama Sekolah tidak ditemukan dan akan disimpan pada database.");
	die("0__");
}else{
	while ($d = mysqli_fetch_assoc($q)) {
		$id_sekolah = $d['id_sekolah'];
		$nama_sekolah = $d['nama_sekolah'];

		$o.= "<li id='li__$id_sekolah' class='li_sekolah_asal'>$nama_sekolah</li>";

	}
}

$o.= "
</ul>
<hr>
Silahkan pilih salah satu sekolah berikut!
";

echo "$o";


?>