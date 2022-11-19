<?php
# ============================================================
# CONFIG PHP v.2 
# ============================================================
# - add fungsi artikan_field(nama_field, value)
# ============================================================


// Header =============================================
$nama_si 	= "PMB ONLINE STMIK IKMI"; 
$judul_menu = "PMB IKMI"; 
$lembaga 	= "STMIK IKMI";
$title 		= "$judul_menu :: $lembaga";
$id_gel = 5; // Gelombang I 2022 
$cid_gel = $id_gel;


// footer info =============================================
$nama_author = "Iin Sholihin";
$tahun_release = 2020; 
$dev_kontak = ""; 
$dev_name = "Iin Sholihin, M.Kom"; 
// footer info =============================================







// koneksi db =============================================
$online_version = 1;
if ($_SERVER['SERVER_NAME'] == "localhost") $online_version = 0;


if ($online_version) {
	$db_server = "localhost";
	$db_user = "pmbikmiac_admin_akademik";
	$db_pass = "pmbikmicirebon2020";
	$db_name = "pmbikmiac_akademik";
}else{
	$db_server = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "db_siakad";
}

$cn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($cn -> connect_errno) {
  echo "Error Config# Failed to connect to MySQL";
  exit();
}


// penanggalan =============================================
date_default_timezone_set("Asia/Jakarta");
$tanggal_skg = date("Y-m-d");
$tanggaljam_skg = date("Y-m-d H:i:sa");
$jam_skg = date("H:i:sa");
$tahun_skg = date("Y");
$thn_skg = date("y");
$waktu = "Pagi";
if(date("H")>=9) $waktu = "Siang";
if(date("H")>=15) $waktu = "Sore";
if(date("H")>=18) $waktu = "Malam";
// penanggalan =============================================


$link_back = "<a href='javascript:history.go(-1)'>Kembali</a>";
$btn_back = "<a href='javascript:history.go(-1)'><button class='btn btn-primary' style='margin-top:5px;margin-bottom:5px'>Kembali</button></a>";

$bm = '<span style="color: red;font-weight: bold">*</span>';
$stver = '<small style="color: green;font-weight: bold">Terverifikasi.</small>';
$stnover = '<small style="color: purple;font-weight: bold">Belum Diverifikasi</small>';
function strej($a){
	echo  "<small style='color: red;font-weight: bold'>Rejected: $a</small>";
} 

function artif($nama_field,$nilai){
  return artikan_field($nama_field,$nilai);
}

function artikan_field($nama_field,$nilai){
  switch ($nama_field) {
    case 'status_menikah':
      if($nilai==1) return "Belum Menikah";
      if($nilai==2) return "Menikah";
      if($nilai==3) return "Janda/Duda";
      break;
    case 'jenis_kelamin':
      if(strtoupper($nilai)=="L") return "Laki-laki";
      if(strtoupper($nilai)=="P") return "Perempuan";
      break;
    case 'agama':
      if($nilai==1) return "Islam";
      if($nilai==2) return "Katolik";
      if($nilai==3) return "Protestan";
      if($nilai==4) return "Hindu";
      if($nilai==5) return "Budha";
      if($nilai==6) return "Konghucu";
      if($nilai==7) return "Lainnya";
      break;
    case 'warga_negara':
      if($nilai==1) return "WNI";
      if($nilai==2) return "WNA";
      break;
    case 'pekerjaan_ayah':
    case 'pekerjaan_ibu':
      if($nilai==1) return 'PNS Dosen/Guru';
      if($nilai==2) return 'PNS Non Kependidikan';
      if($nilai==3) return 'Dosen/Guru Swasta';
      if($nilai==4) return 'TNI/Polri';
      if($nilai==5) return 'BUMN';
      if($nilai==6) return 'Swasta';
      if($nilai==7) return 'Pedagang';
      if($nilai==8) return 'Petani/Peternak';
      if($nilai==9) return 'Nelayan';
      if($nilai==10) return 'Wirausaha Lainnya';
      if($nilai==11) return 'Anggota Dewan';
      if($nilai==12) return 'TKI';
      if($nilai==90) return 'Ibu Rumah Tangga';
      if($nilai==98) return 'Tidak bekerja';
      if($nilai==99) return 'Lainnya';
      break;
    case 'lulusan':
      if($nilai==1) return 'SMA Negeri';
      if($nilai==2) return 'SMA Swasta';
      if($nilai==3) return 'SMK Negeri';
      if($nilai==4) return 'SMK Swasta';
      if($nilai==5) return 'MA Negeri';
      if($nilai==6) return 'MA Swasta';
      if($nilai==7) return 'Akademi';
      if($nilai==8) return 'Institute';
      if($nilai==9) return 'Sekolah Tinggi';
      if($nilai==10) return 'Universitas';
      if($nilai==11) return 'Paket C (biasa)';
      if($nilai==12) return 'Paket C Homeschooling';
      if($nilai==13) return 'SMA Luar Negeri';
      break;
    case 'status_daftar':
      if($nilai==0) return 'Registrasi via Gmail';
      if($nilai==1) return 'Sudah melengkapi data saja';
      if($nilai==2) return 'Sudah bayar atau syarat KIP Lengkap';
      if($nilai==3) return 'Sudah Lengkap - Belum Tes';
      if($nilai==4) return 'Sudah Lengkap - Lulus Seleksi';
      if($nilai==5) return 'Sudah Registrasi Ulang';
      if($nilai==6) return "-";
      if($nilai==7) return 'Test Only (Whitebox Testing)';
      if($nilai==8) return 'Mengundurkan Diri';
      if($nilai==9) return 'Tidak Lulus Seleksi PMB';
      break;
    case 'tanggal': return date("d M Y",strtotime($nilai));
      break;
    
    default:
      # code...
      break;
  }
}

function opsi2angka($a){
  switch (strtolower($a)) {
    case 'a': return 1;break;
    case 'b': return 2;break;
    case 'c': return 3;break;
    case 'd': return 4;break;
    case 'e': return 5;break;
  }
}

function angka2opsi($a){
  switch (strtolower($a)) {
    case '1': return "A";break;
    case '2': return "B";break;
    case '3': return "C";break;
    case '4': return "D";break;
    case '5': return "E";break;
  }
}


function durasi_hari($a,$b){
  if (intval($a) == 0 || intval($b) == 0) {
    return "-";
    
  } 
  $dStart = new DateTime($a);
  $dEnd  = new DateTime($b);
  $dDiff = $dStart->diff($dEnd);
  return $dDiff->format('%r%a'); 

}


function frp($x){
  return "Rp ".fnum($x).",-";
}

function fnum($x){
  switch (strlen($x)) {
    case 1: 
    case 2: 
    case 3: $y = $x; break;

    case 4: $y = substr($x,0,1).".".substr($x,1,3); break;
    case 5: $y = substr($x,0,2).".".substr($x,2,3); break;
    case 6: $y = substr($x,0,3).".".substr($x,3,3); break;

    case 7: $y = substr($x,0,1).".".substr($x,1,3).".".substr($x,4,3); break;
    case 8: $y = substr($x,0,2).".".substr($x,2,3).".".substr($x,5,3); break;
    case 9: $y = substr($x,0,3).".".substr($x,3,3).".".substr($x,6,3); break;
    
    default: $y = "Out of length digit.";break;
  }
  
  if ($y == 0) {
    return "-";
  }else{return "$y";}
  
}

function ftgl($t){
  return date("d M Y",strtotime($t));
}



function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
  }     
  return $temp;
}

function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "minus ". trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }         
  return $hasil;
}











$s = "SELECT * 
from tb_daftar_gel a 
join tb_angkatan b on a.id_angkatan = b.id_angkatan 
where a.id_gel = $cid_gel ";
$q = mysqli_query($cn,$s) or die("Error Config# Set Angkatan Failed. ");
if (mysqli_num_rows($q)==1) {
  $d = mysqli_fetch_array($q);

  $id_angkatan = $d['id_angkatan'];
  $tahun_angkatan = $d['id_angkatan'];
  $nama_gel = $d['nama_gel'];
  $tanggal_awal_gel = $d['tanggal_awal_gel'];
  $tanggal_akhir_gel = $d['tanggal_akhir_gel'];
  $tanggal_tes_gel = $d['tanggal_tes_gel'];
  $durasi_pukul = $d['durasi_pukul'];
  $tempat_tes = $d['tempat_tes'];
  $ruang_tes = $d['ruang_tes'];

  $cid_angkatan = $d['id_angkatan'];
  $ctahun_angkatan = $d['id_angkatan'];
  $cnama_gel = $d['nama_gel'];
  $ctanggal_awal_gel = $d['tanggal_awal_gel'];
  $ctanggal_akhir_gel = $d['tanggal_akhir_gel'];
  $ctanggal_tes_gel = $d['tanggal_tes_gel'];
  $cdurasi_pukul = $d['durasi_pukul'];
  $ctempat_tes = $d['tempat_tes'];
  $cruang_tes = $d['ruang_tes'];

  $tanggal_awal_gel = date("d M Y",strtotime($tanggal_awal_gel));
  $tanggal_akhir_gel = date("d M Y",strtotime($tanggal_akhir_gel));
  $tanggal_tes_gel = date("d M Y",strtotime($tanggal_tes_gel));

  $biaya_daftar_reg = $d['biaya_daftar_reg'];
  $biaya_daftar_trans = $d['biaya_daftar_trans'];
  $biaya_almamater = $d['biaya_almamater'];
  $biaya_pkkmb = $d['biaya_pkkmb'];
  $biaya_perpus = $d['biaya_perpus'];
  $biaya_ktm = $d['biaya_ktm'];
  $biaya_kmhs = $d['biaya_kmhs'];
  $tgl_pembukaan = $d['tgl_pembukaan'];
  $tgl_penutupan = $d['tgl_penutupan'];

}else{
  die("Error Config# Rows Angkatan Failed.");
}
?>