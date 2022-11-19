
<?php 
$z = "<ul class='list-unstyled'>";
include "../../config.php";
if (!isset($_GET['q'])) die("Error Nama-Kabs-AJAX-File :: q index hilang.");

$q = $_GET['q'];

$s = " SELECT * from tb_nik_kab where nama_kab like '%$q%' order by nama_kab ";
$q = mysqli_query($cn,$s) or die("Error Nama-Kabs-AJAX-File at Query. ".mysqli_error($cn));
// if(mysqli_num_rows($q)!=1) die("Error Nama-Kabs-AJAX-File, hasil query harus satu baris.");
while ($d = mysqli_fetch_array($q)) {
	$z.= "<li class='item_kab'>".ucwords(strtolower($d['nama_kab']))."</li>";
}
$z.= "</ul>";

echo "$z";
?>