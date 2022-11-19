<?php 
if(!isset($_GET['k'])) die("Keyword not defined.");
if(!isset($_GET['id'])) die("Keyword id not defined.");
$k = $_GET['k'];
$id = $_GET['id'];

include '../config.php';
$s = "SELECT a.id_kec, a.nama_kec, b.nama_kab  
from tb_kec a join tb_kab b on a.id_kab=b.id_kab 
where a.nama_kec like '%$k%' order by a.nama_kec limit 10";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

$o = "<ul>";
if (mysqli_num_rows($q)==0) {
	// die("Nama kec tidak ditemukan dan akan disimpan pada database.");
	die("0__");
}else{
	while ($d = mysqli_fetch_assoc($q)) {
		$id_kec = $d['id_kec'];
		$nama_kec = strtoupper($d['nama_kec']);
		$nama_kab = strtoupper($d['nama_kab']);

		$o.= "<li id='$id"."__$id_kec' class='li_kec'>KEC $nama_kec $nama_kab</li>";

	}
}

$o.= "
</ul>
<hr>
Silahkan pilih salah satu nama kecamatan/kab berikut!
";

echo "$o";


?>