<?php 
$id_gelombang_filter = "all";
$id_jalur_filter = "all";
$id_prodi_filter = "all";
$nama_calon_filter = "";
$show_count = 25;
$page_ke = 1;
$order_by = "nama_calon";

if(isset($_GET['id_gelombang_filter'])) $id_gelombang_filter=$_GET['id_gelombang_filter'];
if(isset($_GET['id_jalur_filter'])) $id_jalur_filter=$_GET['id_jalur_filter'];
if(isset($_GET['id_prodi_filter'])) $id_prodi_filter=$_GET['id_prodi_filter'];
if(isset($_GET['nama_calon_filter'])) $nama_calon_filter=$_GET['nama_calon_filter'];
if(isset($_GET['show_count'])) $show_count=$_GET['show_count'];
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];

$limit_akhir = $page_ke * $show_count;
$limit_awal = $limit_akhir - $show_count + 1;













$rows_pendaftar = "<tr><td colspan=9>No Data Available.</td></tr>";

$sql_status_akun = "1";
if($admin_level==1) $sql_status_akun = " a.status_akun=1 ";

$s = "SELECT 

a.nama_calon,
a.email,
a.no_wa,
a.status_no_wa,
a.status_email,
b.*,
c.*,
(select nama_prodi from tb_prodi where id_prodi=c.id_prodi1) as nama_prodi1, 
(select nama_prodi from tb_prodi where id_prodi=c.id_prodi2) as nama_prodi2, 
(select singkatan_prodi from tb_prodi where id_prodi=c.id_prodi1) as singkatan_prodi1, 
(select singkatan_prodi from tb_prodi where id_prodi=c.id_prodi2) as singkatan_prodi2, 
(select jenjang from tb_prodi where id_prodi=c.id_prodi1) as jenjang1, 
(select jenjang from tb_prodi where id_prodi=c.id_prodi2) as jenjang2, 
(select singkatan_jalur from tb_jalur where id_jalur=c.id_jalur) as singkatan_jalur 


from tb_akun a 
join tb_calon b on a.email=b.email 
join tb_daftar c on a.email=c.email

WHERE $sql_status_akun 


ORDER BY a.akun_created DESC, c.tanggal_daftar DESC 

LIMIT $limit_awal, $limit_akhir 

";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

if(mysqli_num_rows($q)){
  $rows_pendaftar = "";
  $i=0;
  while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    # ===========================================
    # DATA AKUN
    # ===========================================
    $nama_calon = $d['nama_calon'];
    $no_wa = $d['no_wa'];
    $status_no_wa = $d['status_no_wa'];
    $status_email = $d['status_email'];
    $email_calon = $d['email'];

    # ===========================================
    # DATA CALON
    # ===========================================
    $no_hp   = $d['no_hp'];
    $no_ayah  = $d['no_ayah'];
    $no_ibu  = $d['no_ibu'];
    $no_saudara  = $d['no_saudara'];

    # ===========================================
    # DATA DAFTAR
    # ===========================================
    $id_daftar = $d['id_daftar'];
    $id_gelombang = $d['id_gelombang'];
    $id_prodi1 = $d['id_prodi1'];
    $id_prodi2 = $d['id_prodi2'];
    $id_jalur = $d['id_jalur'];
    $id_kelas = $d['id_kelas'];
    $id_jadwal_tes = $d['id_jadwal_tes'];
    $status_daftar = $d['status_daftar'];
    $status_lulus = $d['status_lulus'];
    $tanggal_daftar = $d['tanggal_daftar'];
    $tanggal_submit_formulir = $d['tanggal_submit_formulir'];
    $tanggal_tes_pmb = $d['tanggal_tes_pmb'];
    $tanggal_lulus_tes = $d['tanggal_lulus_tes'];
    $folder_uploads = $d['folder_uploads'];

    # ===========================================
    # GET NAMA PRODI/SINGKATAN PRODI
    # ===========================================
    $nama_prodi1 = $d['nama_prodi1'];
    $nama_prodi2 = $d['nama_prodi2'];
    $singkatan_prodi1 = $d['singkatan_prodi1'];
    $singkatan_prodi2 = $d['singkatan_prodi2'];
    $jenjang1 = $d['jenjang1'];
    $jenjang2 = $d['jenjang2'];

    $singkatan_jalur = $d['singkatan_jalur'];


    # ===========================================
    # CASE NAME
    # ===========================================
    $nama_calon = ucwords(strtolower($nama_calon));



    # ===========================================
    # SHOW VARIABLES
    # ===========================================
    $tanggal_daftar_show = date("M d", strtotime($tanggal_daftar));
    $formulir_show = $img_reject;
    if($tanggal_submit_formulir!="") $formulir_show = $img_check;
    $formulir_show = "<a href='?pendaftar&id_daftar=$id_daftar'>$formulir_show</a>";
    $nama_calon_show = "<a href='?pendaftar&id_daftar=$id_daftar'>$nama_calon</a>";



    # ===========================================
    # CELL COLORRING
    # ===========================================
    $rwarna_jalur = ["","#def","#ffc","#cff","#fcc"];
    
    $sty_jalur = "";
    $sty_prodi = "";
    if($id_jalur!="")$sty_jalur = "background-color:". $rwarna_jalur[$id_jalur];
    // echo "<hr>id_daftar: $id_daftar";

    $rwarna_prodi = ["","#def","#ffc","#cff","#fcc","#fcf"];
    if($id_prodi1!="")$sty_prodi = "background-color:". $rwarna_prodi[$id_prodi1];
    // echo "<hr>id_prodi: $id_prodi1";


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
    $q2 = mysqli_query($cn,$s2) or die("Tidak dapat mengakses data upload. ".mysqli_error($cn));
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

    $img_wa_calon = $img_wa_unverified; if($status_no_wa) $img_wa_calon = $img_wa; 
    $img_email_calon = $img_email_unverified; if($status_email) $img_email_calon = $img_email; 


    $link_wa_calon = "<a href='?verif_akun&email_calon=$email_calon&field=no_wa'>$img_wa_calon</a>";
    $link_email_calon = "<a href='?verif_akun&email_calon=$email_calon&field=email'>$img_email_calon</a>";

    $akun_show = "$link_wa_calon $link_email_calon";

    $rows_pendaftar .= "
    <tr>
      <td align=center>$i</td>
      <td align=center>$id_gelombang</td>
      <td align=center>$tanggal_daftar_show</td>
      <td align=center style='$sty_jalur'>$singkatan_jalur</td>
      <td align=center style='$sty_prodi'>$singkatan_prodi1</td>
      <td>$img_profil_calon $nama_calon_show</td>
      <td align=center>$akun_show</td>
      <td align=center>$formulir_show</td>
      <td align=center>$link_img_syarat[1] $link_img_syarat[2] $link_img_syarat[3] </td>
      <td align=center>Del</td>
    </tr>";






  }
}

?>