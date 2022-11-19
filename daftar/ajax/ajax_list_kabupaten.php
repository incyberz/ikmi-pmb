<?php 
if(!isset($_GET['k'])) die("Keyword not defined.");
$k = $_GET['k'];

include '../config.php';
$s = "SELECT id_kab, nama_kab from tb_kab where nama_kab like '%$k%' order by nama_kab limit 10";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

$o = "<ul>";
if (mysqli_num_rows($q)==0) {
	// die("Nama kab tidak ditemukan dan akan disimpan pada database.");
	die("0__");
}else{
	while ($d = mysqli_fetch_assoc($q)) {
		$id_kab = $d['id_kab'];
		$nama_kab = $d['nama_kab'];

		$o.= "<li id='li__$id_kab' class='li_kab'>$nama_kab</li>";

	}
}

$o.= "
</ul>
<hr>
Silahkan pilih salah satu Kabupaten/Kota berikut!
";

echo "$o";


?>