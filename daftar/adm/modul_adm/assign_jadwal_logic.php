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
where a.id_jadwal_tes = '$id_jadwal_tes'";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
$rows_peserta_this_tes = "<tr><td colspan='' style='color:red'>Jadwal ini belum punya peserta tes.</td></tr>";
if(mysqli_num_rows($q)){
  $rows_peserta_this_tes = '';
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

    $btn_drop = "<button class='btn btn-danger btn-sm btn_drop' id='btn_drop__$id_daftar'>Drop</button>";

    $tanggal_lulus_tes = $d['tanggal_lulus_tes'];
    $status_lulus = $d['status_lulus'];
    if($tanggal_lulus_tes!=""){
      $btn_drop = "Lulus";
      if($status_lulus!=1) $btn_drop = "Tidak Lulus";
    }







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





    $rows_peserta_this_tes .= "
    <tr id='rows_peserta_this_tes__$id_daftar'>
      <td>$i</td>
      <td>$id_gelombang</td>
      <td>$singkatan_prodi</td>
      <td>$singkatan_jalur</td>
      <td style='text-align:left'>$nama_calon_show</td>
      <td>$id_daftar</td>
      <td>$btn_drop</td>
    </tr>";
  }

}













# ===========================================
# GET ALL CALON PESERTA
# ===========================================
$s = "SELECT 


a.id_daftar,
a.id_jalur,
a.id_gelombang,
b.nama_calon,
a.folder_uploads,
d.singkatan_prodi,  
e.singkatan_jalur  


from tb_daftar a 
join tb_akun b on a.email=b.email 
join tb_prodi d on a.id_prodi1 = d.id_prodi 
join tb_jalur e on a.id_jalur = e.id_jalur 
left join tb_peserta_tes c on a.id_daftar=c.id_daftar 
where c.id_daftar is null 
and a.id_jadwal_tes is null 
and a.tanggal_submit_formulir is not null 
and b.status_akun = 1 

";

// die($s);
// echo "<hr>$s<hr>";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
if(mysqli_num_rows($q)==0){
  $rows_calon_peserta_tes = "<tr><td colspan=6 style='padding: 15px 0'>Semua pendaftar sudah mendapatkan Jadwal Tes $img_check</td></tr>";
}else{
  $i=0;
  $j=0;
  $rows_calon_peserta_tes = '';

  // echo "<pre>"; echo var_dump($q); echo "</pre>"; exit();
  while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $id_jalur = $d['id_jalur'];
    $id_daftar = $d['id_daftar'];
    $id_gelombang = $d['id_gelombang'];
    $nama_calon = $d['nama_calon'];
    $folder_uploads = $d['folder_uploads'];
    $singkatan_prodi1 = $d['singkatan_prodi'];
    $singkatan_jalur = $d['singkatan_jalur'];













    # ===========================================
    # CEK PERSYARATAN
    # ===========================================
    $link_img_syarat[1] = $img_not_exist;
    $link_img_syarat[2] = $img_not_exist;
    $link_img_syarat[3] = $img_not_exist;
    $file_profil_calon = "../uploads/profile_na.jpg";

    $status_persyaratan = [0,0,0,0];

    if($id_jalur==3){
      $link_img_syarat[2] = $img_un;
    }else{
      $link_img_syarat[3] = $img_un;
    }

    $s2 = "SELECT * from tb_verifikasi_upload a 
    join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
    where id_daftar=$id_daftar";
    // die($s2);

    // echo "<hr>$s2<hr>";

    $q2 = mysqli_query($cn,$s2) or die("All pendaftar :: Tidak dapat mengakses data upload. <hr>$s2<hr> ".mysqli_error($cn));
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
            $status_persyaratan[$id_persyaratan] = 1;

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
    $btn_add = "<button class='btn btn-primary btn-sm btn_add' id='btn_add__$id_daftar'>Add</button>";

    $nama_calon = strtolower($nama_calon);
    $nama_calon = str_replace("muhammad ","m ",$nama_calon);
    $nama_calon = str_replace("muhamad ","m ",$nama_calon);
    if(strlen($nama_calon)>15) $nama_calon = substr($nama_calon, 0,12)."...";
    $nama_calon = ucwords($nama_calon);
    $nama_calon_show = "<a href='?pendaftar&id_daftar=$id_daftar'>$nama_calon</a>";

    // if($status_persyaratan[1] and ($status_persyaratan[2] or $status_persyaratan[3])){

      $j++;
      $rows_calon_peserta_tes .= "
      <tr id='rows_calon_peserta_tes__$id_daftar'>
        <td>$j</td>
        <td>$id_gelombang</td>
        <td style='text-align:left'>$img_profil_calon $nama_calon_show</td>
        <td>
          $singkatan_prodi1
          <br>$singkatan_jalur
        </td>
        <td>$persyaratan</td>
        <td>$btn_add</td>
      </tr>";
    // }else{
      // $rows_calon_peserta_tes .= "
      // <tr>
      //   <td>$link_img_syarat[1]  $img_check $status_persyaratan[1] $status_persyaratan[2] $status_persyaratan[3] </td>
      // </tr>";
    // }
  }

}





?>