
<?php 
include "../../config.php";
if (!isset($_GET['q'])) die("Error Get-Nama-Kab-AJAX-File :: q index hilang.");

$q = $_GET['q'];

$s = " SELECT * from tb_nik_kab where nama_kab = '$q'";
$q = mysqli_query($cn,$s) or die("Error Get-Nama-Kab-AJAX-File at Query. ".mysqli_error($cn));
if(mysqli_num_rows($q)>0) {echo "1";}else{die("Error. Nama Kab tidak ada dalam database.")}
?>