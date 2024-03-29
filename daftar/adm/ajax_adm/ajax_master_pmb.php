<?php
include 'cek_login_petugas.php';

# ========================================
# ARRAY GET HANDLER
# ========================================
include '../include_adm/include_rget.php';
$get_data = $_GET['get_data'] ?? die(undef('get_data'));
if(!in_array($get_data,$rget)) die("Get_data: $get_data tidak ada pada array_get.");



# ========================================
# OTHERS GET HANDLER
# ========================================
Global $is_get_csv;
$id_gelombang_filter = $_GET['id_gelombang_filter'] ?? die(undef('id_gelombang_filter'));
$id_jalur_filter = $_GET['id_jalur_filter'] ?? die(undef('id_jalur_filter'));
$id_prodi_filter = $_GET['id_prodi_filter'] ?? die(undef('id_prodi_filter'));
$nama_calon_filter = $_GET['nama_calon_filter'] ?? die(undef('nama_calon_filter'));
$show_count = $_GET['show_count'] ?? die(undef('show_count'));
$page_ke = $_GET['page_ke'] ?? die(undef('page_ke'));
$order_by = $_GET['order_by'] ?? die(undef('order_by'));
$is_get_csv = $_GET['is_get_csv'] ?? die(undef('is_get_csv'));
$show_foto = $_GET['show_foto'] ?? die(undef('show_foto'));

$show_foto = $show_foto=='true' ? 1 : 0;

$isi_csv = '';
$path_csv = '';


$limit = $show_count;
$limit_awal = ($page_ke-1) * $show_count  ;

$sql_id_gelombang = " 1 ";
if ($id_gelombang_filter!="all") {
    $sql_id_gelombang = " c.id_gelombang='$id_gelombang_filter' ";
}

$sql_id_prodi = " 1 ";
if ($id_prodi_filter!="all") {
    $sql_id_prodi = " c.id_prodi1='$id_prodi_filter' ";
}

$sql_id_jalur = " 1 ";
if($id_jalur_filter==-3){
    $sql_id_jalur = " c.id_jalur!=3 ";
}elseif ($id_jalur_filter!="all") {
    $sql_id_jalur = " c.id_jalur='$id_jalur_filter' ";
}

$sql_nama_calon = " 1 ";
if ($nama_calon_filter!="") {
    $sql_nama_calon = " a.nama_calon like '%$nama_calon_filter%' ";
}










$rows_pendaftar = "<tr><td colspan=10>No Data Available.</td></tr>";

$sql_status_wa_or_mail = "1";
$sql_status_akun = "1";
$sql_tanggal_submit = "1";
if ($admin_level==1) {
    $sql_status_akun = " a.status_akun=1 ";
}
// if ($admin_level==1) {
//     $sql_status_wa_or_mail = " (status_no_wa = 1 OR status_email = 1) ";
// }
if ($admin_level==1) {
    $sql_tanggal_submit = " c.tanggal_submit_formulir is not null ";
}


# =======================================
# SQL WHERE GET
# =======================================
// a=tb_akun b=tb_calon c=tb_daftar
$sudah_submit = 'a.status_akun=1 AND c.tanggal_submit_formulir is not null';
$reg_aktif = "$sudah_submit AND c.id_jalur!=3";
$kip_aktif = "$sudah_submit AND c.id_jalur=3";
$rwhere = [
  'All Data' => '1',
  'Data Aktif' => 'a.status_akun=1',
  'Sudah Submit' => $sudah_submit,
  'Belum Submit' => 'a.status_akun=1 AND c.tanggal_submit_formulir is null',
  'Data Sampah' => 'a.status_akun!=1',

  'Reguler Aktif' => $reg_aktif,
  'KIP Aktif' => $kip_aktif,

  'Reg Sudah Bayar' => $reg_aktif,
  'Reg Sudah Dijadwalkan' => $reg_aktif,
  'Reg Lulus' => $reg_aktif,
  'Reg Reg-Ulang' => $reg_aktif,
  'Reg Belum Bayar' => $reg_aktif,
  'Reg Belum Dijadwalkan' => $reg_aktif,

  'KIP Sudah Verif' => $kip_aktif,
  'KIP Sudah Dijadwalkan' => $kip_aktif,
  'KIP Lulus' => $kip_aktif,
  'KIP Reg-Ulang' => $kip_aktif,
  'KIP Belum Verif' => $kip_aktif,
  'KIP Belum Dijadwalkan' => $kip_aktif

];

$where_get = $rwhere[$get_data];

include '../../config.php';
include '../../global_var.php';
include '../global_var_adm.php';

$s = "SELECT 

a.nama_calon,
a.email,
a.no_wa,
a.status_no_wa,
a.status_email,
a.alasan_resign,
b.*,
c.*,
(select nama_prodi from tb_prodi where id_prodi=c.id_prodi1) as nama_prodi1, 
(select nama_prodi from tb_prodi where id_prodi=c.id_prodi2) as nama_prodi2, 
(select singkatan_prodi from tb_prodi where id_prodi=c.id_prodi1) as singkatan_prodi1, 
(select singkatan_prodi from tb_prodi where id_prodi=c.id_prodi2) as singkatan_prodi2, 
(select jenjang from tb_prodi where id_prodi=c.id_prodi1) as jenjang1, 
(select jenjang from tb_prodi where id_prodi=c.id_prodi2) as jenjang2, 
(select singkatan_jalur from tb_jalur where id_jalur=c.id_jalur) as singkatan_jalur, 

(
  SELECT 1 FROM tb_peserta_tes WHERE id_daftar=c.id_daftar 
) sudah_dijadwalkan,

(select tanggal_verifikasi_upload from tb_verifikasi_upload where id_daftar=c.id_daftar and id_persyaratan=1 and status_upload=1) as tanggal_verifikasi_profil,
(select tanggal_verifikasi_upload from tb_verifikasi_upload where id_daftar=c.id_daftar and id_persyaratan=2 and status_upload=1) as tgver_bayar_or_verif 



from tb_akun a 
join tb_calon b on a.email=b.email 
join tb_daftar c on a.email=c.email

WHERE $sql_status_akun 

AND $sql_status_wa_or_mail
AND $sql_tanggal_submit  

AND $sql_id_gelombang 
AND $sql_id_prodi 
AND $sql_id_jalur 
AND $sql_nama_calon 

AND $where_get 

ORDER BY $order_by 
";

$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$jumlah_rows = mysqli_num_rows($q);

Global $jumlah_rows_get;
Global $isi_csv;
Global $remail;

$jumlah_rows_get = 0;
$isi_csv = '';
$remail = [];

$rows = '';

function add_row($d,$i){
    global $jumlah_rows_get;
    global $isi_csv;
    global $remail;
    global $is_get_csv;

    array_push($remail,$d['email']);
    $jumlah_rows_get++;

    if($is_get_csv){
        // header CSV
        if ($isi_csv=='') {
            foreach ($d as $key=>$value) {
                $isi_csv .= ",\"$key\"";
            }
            $isi_csv .= "\n";
        }

        // isi CSV
        foreach ($d as $value) {
            $value = strtoupper(trim($value));
            $value = str_replace('"', '', $value);
            $value = $value=='' ? ',NULL' : ",\"$value\"";
            $isi_csv .= $value;
        }
        $isi_csv .= "\n";        
    }
}

if ($jumlah_rows) {
    $i=0;
    $no=0;
    while ($d=mysqli_fetch_assoc($q)) {
        $i++;

        if(
            $get_data=='Reg Sudah Bayar'
            ||$get_data=='Reg Lulus'
            ||$get_data=='Reg Reg-Ulang'
            ||$get_data=='KIP Sudah Bayar'
            ||$get_data=='KIP Lulus'
            ||$get_data=='KIP Reg-Ulang'
        ){
            if($d['tgver_bayar_or_verif']!=''){
                if($get_data=='Reg Lulus'||$get_data=='KIP Lulus'){
                    if($d['tanggal_lulus_tes']!='') add_row($d,$i);
                }elseif($get_data=='Reg Reg-Ulang'||$get_data=='KIP Reg-Ulang'){
                    if($d['tanggal_registrasi_ulang']!='') add_row($d,$i);
                }else{
                    add_row($d,$i);
                }
            } 
        }elseif($get_data=='Reg Belum Dijadwalkan'||$get_data=='KIP Belum Dijadwalkan'){
            if(!$d['sudah_dijadwalkan'] and $d['tgver_bayar_or_verif']!='') add_row($d,$i);
        }elseif($get_data=='Reg Sudah Dijadwalkan'||$get_data=='KIP Sudah Dijadwalkan'){
            if($d['sudah_dijadwalkan']) add_row($d,$i);
        }elseif($get_data=='Reg Belum Bayar'||$get_data=='KIP Belum Verif'){
            if($d['tgver_bayar_or_verif']=='') add_row($d,$i);
        }else{
            add_row($d,$i);
        }

        if(in_array($d['email'],$remail) and $no < $show_count){
            $no++;
            # ===========================================
            # DATA AKUN
            # ===========================================
            $nama_calon = $d['nama_calon'];
            // $no_wa = $d['no_wa'];
            $status_no_wa = $d['status_no_wa'];
            $status_email = $d['status_email'];
            $email_calon = $d['email'];

            # ===========================================
            # DATA CALON
            # ===========================================
            $id_calon   = $d['id_calon'];
            // $no_hp   = $d['no_hp'];

            # ===========================================
            # DATA DAFTAR
            # ===========================================
            $id_daftar = $d['id_daftar'];
            $id_gelombang_show = str_replace($tahun_pmb,'',$d['id_gelombang']);
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
            $grade_lulus = $d['grade_lulus'];

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
            if ($tanggal_submit_formulir!='') {
                $formulir_show = $img_check;
            }
            $formulir_show = "<a href='?pendaftar&id_daftar=$id_daftar'>$formulir_show</a>";
            $nama_calon_show = "<a href='?pendaftar&id_daftar=$id_daftar'>$nama_calon</a>";



            # ===========================================
            # CELL COLORRING
            # ===========================================
            $rwarna_jalur = ['',"#def","#ffc","#cff","#fcc"];

            $sty_jalur = '';
            $sty_prodi = '';
            if ($id_jalur!='') {
                $sty_jalur = "background-color:". $rwarna_jalur[$id_jalur];
            }
            // echo "<hr>id_daftar: $id_daftar";

            $rwarna_prodi = ['',"#def","#ffc","#cff","#fcc","#fcf"];
            if ($id_prodi1!="") {
                $sty_prodi = "background-color:". $rwarna_prodi[$id_prodi1];
            }
            // echo "<hr>id_prodi: $id_prodi1";


            # ===========================================
            # CEK PERSYARATAN
            # ===========================================
            $link_img_syarat[1] = $img_not_exist;
            $link_img_syarat[2] = $img_not_exist;
            $file_profil_calon = "../uploads/profile_na.jpg";



            $s2 = "SELECT * from tb_verifikasi_upload a 
            join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
            where id_daftar=$id_daftar";
            $q2 = mysqli_query($cn, $s2) or die("Tidak dapat mengakses data upload. ".mysqli_error($cn));
            if (mysqli_num_rows($q2)) {
                while ($d2=mysqli_fetch_assoc($q2)) {
                    $id_verifikasi = $d2['id_verifikasi'];
                    $id_persyaratan = $d2['id_persyaratan'];
                    $ekstensi_file = $d2['ekstensi_file'];
                    $status_upload = $d2['status_upload'];
                    $link_img_syarat[$id_persyaratan] = $img_warning;

                    $tanggal_verifikasi_upload = $d2['tanggal_verifikasi_upload'];
                    if ($tanggal_verifikasi_upload!="") {
                        if ($status_upload) {
                            $link_img_syarat[$id_persyaratan] = $img_check;
                        } else {
                            $link_img_syarat[$id_persyaratan] = $img_reject;
                        }
                    }

                    if ($id_persyaratan==1) {
                        $file_profil_calon = "../uploads/$folder_uploads/img_profile__$id_daftar.$ekstensi_file";
                    }

                    $link_img_syarat[$id_persyaratan] = "<a href='?verif_upload&id_verifikasi=$id_verifikasi'>$link_img_syarat[$id_persyaratan]</a>";
                }
            }

            $img_profil_calon = $show_foto ? "<img src='$file_profil_calon' class='img-rounded' width='50px' style='margin: 0 10px'>" : '';

            $img_wa_calon = $img_wa_unverified;
            if ($status_no_wa) {
                $img_wa_calon = $img_wa;
            }
            $img_email_calon = $img_email_unverified;
            if ($status_email) {
                $img_email_calon = $img_email;
            }


            $link_wa_calon = "<a href='?verif_akun&email_calon=$email_calon&field=no_wa'>$img_wa_calon</a>";
            $link_email_calon = "<a href='?verif_akun&email_calon=$email_calon&field=email'>$img_email_calon</a>";

            $akun_show = "$link_wa_calon $link_email_calon";

            $login_as = "
            <a href='?login_as_pendaftar&email_calon=$email_calon&nama_calon=$nama_calon&id_calon=$id_calon&id_daftar=$id_daftar' target='_blank'>
            <img class='img_aksi' id='img_aksi__login_as' src='img/icons/login_as.png'>
            </a>";

            $set_pass = '';

            $switch_prodi = "<img class='img_aksi_disabled' id='img_aksi__switch_prodi' src='img/icons/switch_prodi_disabled.png'>";

            if (($grade_lulus=="B" or $grade_lulus=="C")  and $tanggal_lulus_tes!="" and $status_lulus) {
                $switch_prodi = "<a href='?switch_prodi&id_daftar=$id_daftar' target='_blank'><img class='img_aksi' id='img_aksi__switch_prodi' src='img/icons/switch_prodi.png'></a>";
            }


            $super_delete = '';

            $rows .= "
            <tr>
                <td align=center>$no</td>
                <td align=center>$id_gelombang_show</td>
                <td align=center>$tanggal_daftar_show</td>
                <td align=center style='$sty_jalur'>$singkatan_jalur</td>
                <td align=center style='$sty_prodi'>$singkatan_prodi1</td>
                <td>$img_profil_calon $nama_calon_show <span class=debug>tanggal_lulus_tes:$tanggal_lulus_tes</span></td>
                <td align=center>$akun_show</td>
                <td align=center>$formulir_show</td>
                <td align=center>$link_img_syarat[1] $link_img_syarat[2] </td>
                <td align=center>$login_as $set_pass $switch_prodi $super_delete</td>
            </tr>";        
        }
    }

    if($is_get_csv){
        // write to CSV
        if (!file_exists("../csv")) mkdir("../csv");
        $path_csv = "csv/pmb_master.csv";
        $fcsv = fopen("../$path_csv", "w+") or die("$path_csv cannot accesible.");
        fwrite($fcsv, $isi_csv);
        fclose($fcsv);
    }
}

// $s .= " LIMIT  $limit_awal,$limit";
// die("<h3>$s</h3>");
// $q = mysqli_query($cn, $s) or die(mysqli_error($cn));


// if ($jumlah_rows) {
//     $rows_pendaftar = '';
//     $i=0;
//     while ($d=mysqli_fetch_assoc($q)) {
//         $i++;

//     }
// }




$dw_csv = $is_get_csv ? "<a href='$path_csv' class='btn btn-primary btn-sm' target='_blank'>Download CSV</a>" : '';

$limit = $limit>$jumlah_rows_get ? $jumlah_rows_get : $limit;
die(" <div> <pre> $jumlah_rows_get records found | Show  $limit  $dw_csv</pre></div>
  <table class='table-bordered' width='100%'>
    <thead>
      <th>No</th>
      <th>Gel</th>
      <th>Tanggal</th>
      <th>Jalur</th>
      <th>Prodi</th>
      <th>Nama</th>
      <th>Akun</th>
      <th>Formulir</th>
      <th>Persyaratan</th>
      <th>Aksi</th>
    </thead>

    $rows

  </table>
  
  <pre class=debug>$s</pre>

  ");
