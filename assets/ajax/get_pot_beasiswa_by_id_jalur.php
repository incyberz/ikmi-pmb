<?php 

$id_jalur = $_GET['id_jalur'];
$id_jalur = filter_var($id_jalur, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


include "../../config.php";

$s = "
	SELECT * from tb_daftar_jalur a 
	join tb_daftar_jalur_kuota b ON a.id_kuota = b.id_kuota  
	where a.id_jalur = '$id_jalur';
	";

$msg= '';
$q = mysqli_query($cn,$s) or die("AjaxGetPotBea# ".mysqli_error($cn));

$d = mysqli_fetch_array($q);
$pot_bpp = $d['persen_pot_bpp'];
$pot_spp = $d['persen_pot_spp'];
$ket_beasiswa = $d['ket_beasiswa'];

echo "Potongan: BPP $pot_bpp% + SPP $pot_spp%
<br>
$ket_beasiswa

";
 ?>