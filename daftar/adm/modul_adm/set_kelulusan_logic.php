<?php 
$id_jadwal_tes = $_GET['id_jadwal_tes'];
echo "<input type='hidden' id='id_jadwal_tes' value='$id_jadwal_tes'>";




# ===========================================
# GET PROPERTI THIS JADWAL
# ===========================================
$s = "SELECT * from tb_jadwal_tes where id_jadwal_tes = '$id_jadwal_tes'";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
if(mysqli_num_rows($q)!=1)die("Data Jadwal Tes tidak ditemukan.");

$d=mysqli_fetch_assoc($q);

$tanggal_tes = $d['tanggal_tes'];
$nama_tes = $d['nama_tes'];

$tanggal_lulus_tes = date("Y-m-d",strtotime($tanggal_tes.'+ 3 days'));








# ===========================================
# GET PESERTA THIS JADWAL
# ===========================================
$s = "SELECT 
*,
(SELECT singkatan_prodi from tb_prodi where id_prodi=b.id_prodi1) as singkatan_prodi,
(SELECT singkatan_jalur from tb_jalur where id_jalur=b.id_jalur) as singkatan_jalur

from tb_peserta_tes a 
join tb_daftar b on a.id_daftar=b.id_daftar 
join tb_akun c on b.email=c.email 
where a.id_jadwal_tes = '$id_jadwal_tes'

AND b.tanggal_lulus_tes is null 

";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
$rows_peserta_ikut_tes = "<tr><td colspan='7' style='color:red'>Jadwal ini belum punya peserta tes.</td></tr>";
if(mysqli_num_rows($q)){
  $rows_peserta_ikut_tes = '';
  while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $id_daftar = $d['id_daftar'];
    $id_gelombang = $d['id_gelombang'];
    $nama_calon = $d['nama_calon'];
    $id_jalur = $d['id_jalur'];
    $id_prodi = $d['id_prodi1'];
    $folder_uploads = $d['folder_uploads'];

    $singkatan_prodi = $d['singkatan_prodi'];
    $singkatan_jalur = $d['singkatan_jalur'];

    $btn_lulus = "<button class='btn btn-success btn-sm btn_lulus' id='btn_lulus__$id_daftar'>Lulus</button>";

    $btn_tidak = "<button class='btn btn-danger btn-sm btn_lulus' id='btn_tidak__$id_daftar'>Tidak</button>";






    # ===========================================
    # CEK PERSYARATAN
    # ===========================================
    $link_img_syarat[1] = $img_not_exist;
    $link_img_syarat[2] = $img_not_exist;
    $link_img_syarat[3] = $img_not_exist;



    $file_profil_calon = "../uploads/profile_na.jpg";


    if($id_jalur==3){
      $link_img_syarat[2] = $img_un;
    }else{
      $link_img_syarat[3] = $img_un;
    }

    $s2 = "SELECT * from tb_verifikasi_upload a 
    join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
    where id_daftar=$id_daftar";
    $q2 = mysqli_query($cn,$s2) or die("This jadwal :: Tidak dapat mengakses data upload. ".mysqli_error($cn));
    if(mysqli_num_rows($q2)){
      while ($d2=mysqli_fetch_assoc($q2)) {

        $id_verifikasi = $d2['id_verifikasi'];
        $id_persyaratan = $d2['id_persyaratan'];
        $ekstensi_file = $d2['ekstensi_file'];
        $status_upload = $d2['status_upload'];
        $link_img_syarat[$id_persyaratan] = $img_warning;

        $tanggal_verifikasi_upload = $d2['tanggal_verifikasi_upload'];
        if($tanggal_verifikasi_upload!=""){
          if($status_upload){
            $link_img_syarat[$id_persyaratan] = $img_check;
          }else{
            $link_img_syarat[$id_persyaratan] = $img_reject;
          }
        }

        if($id_persyaratan==1) $file_profil_calon = "../uploads/$folder_uploads/img_profile__$id_daftar.$ekstensi_file";

        $link_img_syarat[$id_persyaratan] = "<a href='?verif_upload&id_verifikasi=$id_verifikasi'>$link_img_syarat[$id_persyaratan]</a>";

      }
    }

    $img_profil_calon = "<img src='$file_profil_calon' class='img-rounded' width='50px' style='margin: 0 10px'>";


    $persyaratan = " $link_img_syarat[1] $link_img_syarat[2] $link_img_syarat[3]  ";
    $nama_calon_show = "$img_profil_calon <a href='?pendaftar&id_daftar=$id_daftar'>$nama_calon</a>";





    $rows_peserta_ikut_tes .= "
    <tr id='rows_peserta_ikut_tes__$id_daftar'>
      <td>$i</td>
      <td>$id_gelombang</td>
      <td>$singkatan_prodi</td>
      <td>$singkatan_jalur</td>
      <td style='text-align:left'>$nama_calon_show</td>
      <td>$id_daftar
        <input type='hidden' id='id_jalur__$id_daftar' value='$id_jalur'>
      </td>
      <td>$btn_lulus $btn_tidak</td>
    </tr>";
  }

}



















# ===========================================
# GET PESERTA YANG LULUS
# ===========================================
$s = "SELECT 
*,
(SELECT singkatan_prodi from tb_prodi where id_prodi=b.id_prodi1) as singkatan_prodi,
(SELECT singkatan_jalur from tb_jalur where id_jalur=b.id_jalur) as singkatan_jalur

from tb_peserta_tes a 
join tb_daftar b on a.id_daftar=b.id_daftar 
join tb_akun c on b.email=c.email 
where a.id_jadwal_tes = '$id_jadwal_tes' 

AND  b.tanggal_lulus_tes is not null 

";

// die($s);
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
$rows_peserta_lulus_tes = "<tr><td colspan='7' style='color:red'>Jadwal ini belum punya peserta yang lulus tes.</td></tr>";
if(mysqli_num_rows($q)){
  $rows_peserta_lulus_tes = '';
  while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $id_daftar = $d['id_daftar'];
    $id_gelombang = $d['id_gelombang'];
    $nama_calon = $d['nama_calon'];
    $id_jalur = $d['id_jalur'];
    $id_prodi = $d['id_prodi1'];
    $folder_uploads = $d['folder_uploads'];
    $status_lulus = $d['status_lulus'];
    $tanggal_lulus_tes = $d['tanggal_lulus_tes'];
    $grade_lulus = $d['grade_lulus'];
    $alasan_tidak_tes = $d['alasan_tidak_tes'];

    $singkatan_prodi = $d['singkatan_prodi'];
    $singkatan_jalur = $d['singkatan_jalur'];

    $btn_drop = "<button class='btn btn-danger btn-sm btn_drop' id='btn_drop__$id_daftar'>Drop</button>";






    # ===========================================
    # CEK PERSYARATAN
    # ===========================================
    $link_img_syarat[1] = $img_not_exist;
    $link_img_syarat[2] = $img_not_exist;
    $link_img_syarat[3] = $img_not_exist;



    $file_profil_calon = "../uploads/profile_na.jpg";


    if($id_jalur==3){
      $link_img_syarat[2] = $img_un;
    }else{
      $link_img_syarat[3] = $img_un;
    }

    $s2 = "SELECT * from tb_verifikasi_upload a 
    join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
    where id_daftar=$id_daftar";
    $q2 = mysqli_query($cn,$s2) or die("This jadwal :: Tidak dapat mengakses data upload. ".mysqli_error($cn));
    if(mysqli_num_rows($q2)){
      while ($d2=mysqli_fetch_assoc($q2)) {

        $id_verifikasi = $d2['id_verifikasi'];
        $id_persyaratan = $d2['id_persyaratan'];
        $ekstensi_file = $d2['ekstensi_file'];
        $status_upload = $d2['status_upload'];
        $link_img_syarat[$id_persyaratan] = $img_warning;

        $tanggal_verifikasi_upload = $d2['tanggal_verifikasi_upload'];
        if($tanggal_verifikasi_upload!=""){
          if($status_upload){
            $link_img_syarat[$id_persyaratan] = $img_check;
          }else{
            $link_img_syarat[$id_persyaratan] = $img_reject;
          }
        }

        if($id_persyaratan==1) $file_profil_calon = "../uploads/$folder_uploads/img_profile__$id_daftar.$ekstensi_file";

        $link_img_syarat[$id_persyaratan] = "<a href='?verif_upload&id_verifikasi=$id_verifikasi'>$link_img_syarat[$id_persyaratan]</a>";

      }
    }

    $img_profil_calon = "<img src='$file_profil_calon' class='img-rounded' width='50px' style='margin: 0 10px'>";


    $persyaratan = " $link_img_syarat[1] $link_img_syarat[2] $link_img_syarat[3]  ";
    $nama_calon_show = "$img_profil_calon <a href='?pendaftar&id_daftar=$id_daftar'>$nama_calon</a>";



    $status_lulus_ket = "<span style='color:red'>Tidak Lulus<br>$alasan_tidak_tes</span>";
    if($status_lulus) $status_lulus_ket = "<span style='color:green; font-weight:bold'>Lulus</span>";

    $grade_lulus_show = $grade_lulus;
    if($grade_lulus!="") $grade_lulus_show = " / $grade_lulus";

    $rows_peserta_lulus_tes .= "
    <tr id='rows_peserta_lulus_tes__$id_daftar'>
      <td>$i</td>
      <td>$id_gelombang</td>
      <td>$singkatan_prodi</td>
      <td>$singkatan_jalur</td>
      <td style='text-align:left'>$nama_calon_show</td>
      <td>$id_daftar $grade_lulus_show</td>
      <td>$status_lulus_ket</td>
      <td>$btn_drop</td>
    </tr>";
  }

}
















?>