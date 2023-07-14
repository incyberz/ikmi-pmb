<?php 
# =====================================================
# HITUNG JUMLAH HARI COUNTDOWN
# =====================================================
// $cnama_gel = "1"; //zzz
// $cid_angkatan = "2021";
// $ctanggal_akhir_gel = "24 April 2021";
$ctanggal_penutupan = date("d M Y",strtotime($ctanggal_akhir_gel));


$a = date("Y-m-d");
// $b = "2021-04-24";
$durasi_hari = durasi_hari($a,$ctanggal_akhir_gel);



$get_id_angkatan = "2021";
if(isset($_GET['id_angkatan']))$get_id_angkatan=$_GET['id_angkatan'];
# =====================================================
# PMB INI CONFIGURATION
# =====================================================
//$pmb = parse_ini_file("pmb.ini");
//$last_update_pmb = $pmb['last_update_pmb'];

//die($pmb['last_update_pmb']);






# =====================================================
# HITUNG PMB PER PRODI
# =====================================================
$jumlah_daftar_total=0;
$jumlah_daftar_ti=0;
$jumlah_daftar_rpl=0;
$jumlah_daftar_si=0;
$jumlah_daftar_mi=0;
$jumlah_daftar_ka=0;



$s = "SELECT c.id_prodi from tb_daftar a 
join tb_biaya b on a.id_biaya=b.id_biaya 
join tb_prodi c on b.id_prodi=c.id_prodi 
where b.id_angkatan = $get_id_angkatan  
and a.is_lengkap_data = 1 
and a.status_daftar < 6 
and a.status_daftar >= 0 
";

$q = mysqli_query($cn,$s) or die("Error #t5t6t6t5t5 Can't Get Prodi Data. $s");
while ($d = mysqli_fetch_array($q)) {
	if($d['id_prodi']==1) $jumlah_daftar_ti++;
	if($d['id_prodi']==2) $jumlah_daftar_rpl++;
	if($d['id_prodi']==3) $jumlah_daftar_si++;
	if($d['id_prodi']==4) $jumlah_daftar_ka++;
	if($d['id_prodi']==5) $jumlah_daftar_mi++;
	$jumlah_daftar_total++;
}



# =====================================================
# HITUNG STATUS PMB
# =====================================================
$s = "SELECT a.id_jndaftar from tb_daftar a 
join tb_daftar_gel b on a.id_gel=b.id_gel 
join tb_daftar_syarat c on a.id_syarat = c.id_syarat 
where b.id_angkatan = '$id_angkatan' 
and a.status_daftar != -1 
";
//if($dm)echo "<hr>$s<hr>";
//$q = mysqli_query($cn,$s) or die("Error dashboard #1 Can't Get Data.");
//$jumlah_status_daftar_all = mysqli_num_rows($q);

for ($i=0; $i <=9 ; $i++) { 
	$rule = "1";
	if($i==0) $rule = "a.status_daftar<6";
	if($i==1) $rule = "a.is_lengkap_data=1";
	if($i==2) $rule = "c.bukti_bayar=1 or (is_lengkap_syarat=1 and (id_jndaftar=3 or id_jndaftar=4 or id_jndaftar=5))";
	if($i==3) $rule = "a.is_lengkap_data=1 and a.is_lengkap_syarat=1";
	if($i==4) $rule = "a.is_lulus_tes=1";
	if($i>=5) $rule = "a.status_daftar=$i";
	$s2 = "$s and $rule";
	if($i<5 and $i!=0) $s2 .= " and a.status_daftar<6";
	//echo "<hr>i = $i, SQL: $s2<hr>";
	// die("<hr><hr><hr><hr><hr>".$s2);
	$q = mysqli_query($cn,$s2) or die("Error count(PMB) Looping #$i");

	$jumlah_status_daftar[$i] = mysqli_num_rows($q);
}

$s2 = "
SELECT a.id_jndaftar from tb_daftar a 
join tb_daftar_gel b on a.id_gel=b.id_gel 
join tb_daftar_syarat c on a.id_syarat = c.id_syarat 
join tb_biaya d on a.id_biaya=d.id_biaya 
join tb_prodi e on d.id_prodi= e.id_prodi 
where b.id_angkatan = '$id_angkatan' 
and a.status_daftar<6 
";
$q = mysqli_query($cn,$s2) or die("Error count(PMB) Jumlah Pilih Prodi");
$jumlah_memilih_prodi = mysqli_num_rows($q);




$jumlah_jalur_reguler = 0;
$jumlah_jalur_transfer = 0;
$jumlah_jalur_kip = 0;
$jumlah_jalur_kipsm = 0;

$q = mysqli_query($cn,$s) or die("Error dashboard #2 Can't Count Data.");
while ($d = mysqli_fetch_array($q)) {
	$id_jndaftar_db = $d['id_jndaftar'];
	if($id_jndaftar_db==1)$jumlah_jalur_reguler++;
	if($id_jndaftar_db==2)$jumlah_jalur_transfer++;
	if($id_jndaftar_db==3)$jumlah_jalur_kip++;
	if($id_jndaftar_db==4)$jumlah_jalur_kipsm++;
}

$jumlah_daftar_total2 = $jumlah_status_daftar[0];
$jumlah_masih_proses = $jumlah_daftar_total2-$jumlah_daftar_total;
?>
 



















			<?php if (!isset($is_webadmin)): ?>
	<section id="counts" class="counts section-bg">
		<div class="container">
			<hr>
			<b style="color: darkred"><center>Gelombang <?=$cnama_gel?> s.d <?=$ctanggal_penutupan?> :: <span style="color: red; font-size: 30px"><?=$durasi_hari?></span> <small><i>hari lagi</i></small></center></b>
			<hr>

			<div class="row counters">
				<div class="col-lg-3 col-6 text-center">
					<span data-toggle="counter-up"><?=$jumlah_daftar_total2?></span>
					<p>Total Pendaftar</p>
				</div>

<!-- 				<div class="col-lg-3 col-6 text-center">
					<span data-toggle="counter-up"><?=$jumlah_masih_proses ?></span>
					<p>Sedang Proses</p>
				</div>

				<div class="col-lg-3 col-6 text-center">
					<span data-toggle="counter-up"><?=$jumlah_daftar_ti?></span>
					<p>Prodi TI</p>
				</div>

				<div class="col-lg-3 col-6 text-center">
					<span data-toggle="counter-up"><?=$jumlah_daftar_rpl?></span>
					<p>Prodi RPL</p>
				</div>

				<div class="col-lg-3 col-6 text-center">
					<span data-toggle="counter-up"><?=$jumlah_daftar_si?></span>
					<p>Prodi SI</p>
				</div>

				<div class="col-lg-3 col-6 text-center">
					<span data-toggle="counter-up"><?=$jumlah_daftar_ka?></span>
					<p>Prodi MI</p>
				</div>

				<div class="col-lg-3 col-6 text-center">
					<span data-toggle="counter-up"><?=$jumlah_daftar_mi?></span>
					<p>Prodi KA</p>
				</div>
 -->
			</div>
			
			
		</div>
	</section>
			<?php endif ?>

