<?php 
if(isset($_POST['btn_upload'])){
  echo "<div style='margin:15px'>
  <h4>Upload Processing</h4><hr>
  ";



  $id_persyaratan = $_POST['id_persyaratan'];

  $s = "SELECT a.* from tb_persyaratan a where a.id_persyaratan=$id_persyaratan";
  $q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data persyaratan. ".mysqli_error($cn));
  if(mysqli_num_rows($q)){
    $rows_persyaratan = '';
    $i=0;
    while ($d=mysqli_fetch_assoc($q)) {
      $id_persyaratan = $d['id_persyaratan'];
      $nama_persyaratan = $d['nama_persyaratan'];
      $id_persyaratan = $d['id_persyaratan'];
      $format_nama_file = $d['format_nama_file'];

      $s2 = "SELECT ekstensi_file from tb_verifikasi_upload where id_persyaratan=$id_persyaratan and id_daftar=$id_daftar";
      $q2 = mysqli_query($cn,$s2) or die("Tidak dapat mengakses data verifikasi upload");
      if(mysqli_num_rows($q2)>1) die("Tidak boleh ganda. id_persyaratan=$id_persyaratan and id_daftar=$id_daftar");

      $ekstensi_file = '';
      if(mysqli_num_rows($q2)){
        $d2 = mysqli_fetch_assoc($q2);
        $ekstensi_file = $d2['ekstensi_file'];
      }

      if($ekstensi_file==""){$status_replace = "new upload";}
      else{ $status_replace = "replaced";}





    }
  }


  // if($_FILES[''])
  // echo "Jenis persyaratan... $format_nama_file<br>";
  // echo "Cek persyaratan terdahulu... $status_replace<hr>";

  // echo "<pre>";
  // echo var_dump($_FILES);
  // echo "</pre>";

  $file_name = $_FILES['file__'.$id_persyaratan]['name'];
  $tmp_name = $_FILES['file__'.$id_persyaratan]['tmp_name'];
  $file_type = $_FILES['file__'.$id_persyaratan]['type'];
  $file_size = $_FILES['file__'.$id_persyaratan]['size'];

  $file_ext = strrev(substr(strrev($file_name),0,strpos(strrev($file_name), ".")));

  echo "
  <b>Nama file</b>: $file_name<br>
  <b>Size</b>: $file_size<br>
  <b>Type</b>: $file_type<br>
  <b>Ekstensi</b>: $file_ext<br>
  <b>Mode</b>: $status_replace<hr>
  ";

  $ext_allowed = ["jpg","jpeg","png","pdf"];

  if(!in_array($file_ext, $ext_allowed)) die("<span class='red'>Ekstensi $file_ext tidak diperbolehkan</span>. Silahkan upload file dg ekstensi: <u>".implode(", ", $ext_allowed)."</u>");
  
  if(!file_exists("uploads/$folder_uploads")) mkdir("uploads/$folder_uploads");

  if(move_uploaded_file($tmp_name, "uploads/$folder_uploads/$format_nama_file"."__$id_daftar.$file_ext")){
    $id_verifikasi = $id_daftar."_$id_persyaratan";
    $s = "INSERT into tb_verifikasi_upload 
    (id_verifikasi,id_daftar,id_persyaratan,ekstensi_file) values 
    ('$id_verifikasi',$id_daftar,$id_persyaratan,'$file_ext') 
    ON DUPLICATE KEY UPDATE 
    ekstensi_file='$file_ext',
    id_petugas=NULL,
    alasan_reject=NULL,
    status_upload=NULL,
    tanggal_verifikasi_upload=NULL

    ";

    $q = mysqli_query($cn, $s) or die("Tidak bisa menyimpan data verifikasi upload. ".mysqli_error($cn));
  }

  echo "
  <div class='alert alert-success'>Upload Berhasil.
  <hr><a href='?upload' class='btn btn-primary'>Kembali ke Upload List</a></div>";

  echo "</div>";
  exit();
}
?>