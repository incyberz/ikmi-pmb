<?php
date_default_timezone_set("Asia/Jakarta");


# ============================================================
# DATABASE CONNECTION
# ============================================================
include 'daftar/config.php';

$cn2 = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($cn2->connect_errno) {
    echo "Error Konfigurasi# Tidak dapat terhubung ke MySQL Server :: $db_name";
    exit();
}


$s = "SELECT * from tb_rekap_det WHERE kode_rekap='total_pmb'";
$q = mysqli_query($cn2, $s) or die(mysqli_error($cn));

$i=0;
while ($d = mysqli_fetch_assoc($q)) {
    $id_rekap_det = $d['id_rekap_det'];
    $label = $d['label'];
    $nilai = $d['nilai'];

    $labels[$i] = $label;
    $nilais[$i] = $nilai;
    $i++;
}


?>

<style type="text/css">
	#blok_step{
	  /*background-color: #afa;*/
	  /*background-image: url('img/alur_pmb.png');*/
	}

	#blok_steps{
	  width: 100%;
	  display: grid;
	  grid-template-columns: 25% 25% 25% 25%;
	}

	#blok_steps div{
	  /*border: solid 1px red;*/
	  text-align: center;
	  margin-bottom: 20px;
	}

	.jumlah_pmb{
	  font-family: verdana;
	  font-size: 25pt;
	}

	.blok_count{
		max-width: 800px;
		margin: auto;
	}
</style>


<section id="counts" class="counts section-bg">
	<div class="container">

		<div class="section-title text-center" style="margin-top:50px">
		  <!-- <h2>Total PMB</h2> -->
		  <p>Total PMB</p>
		  <span style="color:gray; word-spacing: 1px;">-- Total PMB hingga saat ini --</span>
		</div>
		
		<div class="blok_count">
			<div id="blok_step">
			  <img src="assets/img/alur_pmb.png" width="100%">
			</div>
			<div id="blok_steps">
			  <div>Pendaftar <br><span class="jumlah_pmb" data-toggle="counter-up"><?=$nilais[0] ?></span></div>
			  <div>Peserta <br><span class="jumlah_pmb" data-toggle="counter-up"><?=$nilais[1] ?></span></div>
			  <div>Lulus Tes<br><span class="jumlah_pmb" data-toggle="counter-up"><?=$nilais[2] ?></span></div>
			  <div>Registran <br><span class="jumlah_pmb" data-toggle="counter-up"><?=$nilais[3] ?></span></div>
			</div>
		</div>
		
	</div>
</section>