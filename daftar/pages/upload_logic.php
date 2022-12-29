<?php


$s = "SELECT a.* from tb_persyaratan a";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data persyaratan. ".mysqli_error($cn));

$rows_persyaratan = "<tr><td colspan=4>No Persyaratan available.</td></tr>";

if (mysqli_num_rows($q)) {
    $rows_persyaratan = "";
    $i=0;
    while ($d=mysqli_fetch_assoc($q)) {
        $id_persyaratan = $d['id_persyaratan'];
        $format_nama_file = $d['format_nama_file'];
        $nama_persyaratan = $d['nama_persyaratan'];
        $ext_allowed = $d['ext_allowed'];
        $id_persyaratan = $d['id_persyaratan'];

        $s2 = "SELECT a.*,
    (select nama_petugas from tb_petugas where id_petugas=a.id_petugas) as verified_by  
    from tb_verifikasi_upload a 
    where a.id_persyaratan=$id_persyaratan and a.id_daftar=$id_daftar";
        $q2 = mysqli_query($cn, $s2) or die("Tidak dapat mengakses data verifikasi upload");
        if (mysqli_num_rows($q2)>1) {
            die("Tidak boleh dua persyaratan sejenis dalam 1 pendaftaran, id_persyaratan=$id_persyaratan, id_daftar=$id_daftar");
        }

        $ekstensi_file = "";
        $tanggal_verifikasi_upload = "";
        $status_upload = "";
        $alasan_reject = "";
        if (mysqli_num_rows($q2)) {
            $d2 = mysqli_fetch_assoc($q2);
            $ekstensi_file = $d2['ekstensi_file'];
            $tanggal_verifikasi_upload = $d2['tanggal_verifikasi_upload'];
            $verified_by = $d2['verified_by'];
            $status_upload = $d2['status_upload'];
            $alasan_reject = $d2['alasan_reject'];
        }







        $softcopy[$id_persyaratan] = "uploads/$folder_uploads/$format_nama_file"."__$id_daftar.$ekstensi_file";
        $softcopy_exist[$id_persyaratan] = 1;
        $img_persyaratan = "<div style='margin-top:10px'><a href='$softcopy[$id_persyaratan]' target='_blank'><img src='$softcopy[$id_persyaratan]' width='100px'></a></div>";
        if (!file_exists($softcopy[$id_persyaratan])) {
            $softcopy_exist[$id_persyaratan] = 0;
            $softcopy[$id_persyaratan] = "uploads/img_na.jpg";
            $img_persyaratan = "";
        }





        $status_upload_show = "<small><i class='merah'>Belum Upload</i></small>";
        if ($softcopy_exist[$id_persyaratan]) {
            $status_upload_show = "<small><i class='ijo'>Sudah Upload $img_check</i></small>";
        }





        $link_wa_hubungi_petugas = "https://api.whatsapp.com/send?phone=62$no_wa_petugas&text=Yth. Petugas PMB STMIK IKMI Cirebon - Saya $nama_calon, email: $email_calon, telah mengupload file persyaratan: $nama_persyaratan. Mohon segera diverifikasi. Terimakasih. [IKMI-PMB-System, ".date("F d, Y, H:i:s")."]";

        if ($tanggal_verifikasi_upload=="") {
            $status_verifikasi = "<span class='red'>Belum diverifikasi</span><br><a href='$link_wa_hubungi_petugas' target='_blank'>Hubungi Petugas $img_wa</a>";
            $disable_upload = "";
        } else {
            if ($status_upload) {
                $status_verifikasi = "<span class='green'>Terverifikasi $img_check<br>
        <small>at: $tanggal_verifikasi_upload<br>by: $verified_by</small>
        </span>";
                $disable_upload = "disabled";
            } else {
                $status_verifikasi = "<span class='red'>Ditolak $img_reject<br>
        <small>at: $tanggal_verifikasi_upload<br>alasan: $alasan_reject</small>
        </span> <br>Silahkan Anda tekan tombol Browse - Upload untuk upload ulang!";
                $disable_upload = "";
            }
        }

        $rket_upload[1] = "
    Silahkan Anda upload foto formal Anda. Disarankan berlatar polos merah atau biru.
    ";
        $rket_upload[2] = "
    Silahkan Anda upload bukti transfer ke:
    <br> - Bank BRI. No Rek. 4149-01-000004-30-5
    <br> - a.n IKMI CIREBON
    <br> - Nominal: $biaya_daftar
    ";
        $rket_upload[3] = "
    Sistem KIPK Kemdikbud 2022 belum dibuka. Untuk saat ini Anda boleh uploadkan KIP pelajar, PKH, KKS, atau cukup scan SKTM 
    ";

        $ket_upload = "<small>$rket_upload[$id_persyaratan]</small>";


        $blok_upload = "
    <form method='post' enctype='multipart/form-data'>
    <input type='hidden' id='ext_allowed_file__$id_persyaratan' value='$ext_allowed'>
    <input type='hidden' name='id_persyaratan' value='$id_persyaratan'>
    <div class='row' style='margin-bottom:10px'>
      <div class='col-6'>
        <input type='file' name='file__$id_persyaratan' id='file__$id_persyaratan' class='file' $disable_upload>
      </div>
      <div class='col-6 text-end'>
        <button class='btn btn-success btn-sm' name='btn_upload' id='btn_file__$id_persyaratan' disabled>Upload</button>
      </div>
    </div>
    $ket_upload
    </form>

    <script type=\"text/javascript\">
      var uploadField = document.getElementById(\"file__$id_persyaratan\");

      uploadField.onchange = function() {
          if(this.files[0].size > 512000){
            alert(\"Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.\");
            this.value = \"\";
          }
      };
    </script>
    ";

        if (($id_jalur==3 and $id_persyaratan==2) or ($id_jalur!=3 and $id_persyaratan==3)) {
        } else {
            $i++;
            $rows_persyaratan .= "
      
      <div class='row' style='margin-bottom: 20px'>
        <div class='col-lg-6'>
          <h5 style='color: #005; font-weight:bold'>$i. $nama_persyaratan</h5>
          <div style='background: linear-gradient(#fff,#adf); margin:10px 0; padding: 10px; border-radius:10px; border: solid 1px #eee'>
          $blok_upload
          </div>
        </div>
        <div class='col-lg-6'>
          <div class='row'>
            <div class='col-5'>
              $status_upload_show        
              $img_persyaratan
            </div>
            <div class='col-7'>
              $status_verifikasi
            </div>
          </div>
        </div>
      </div>
      ";
        }
    }
}
?>

