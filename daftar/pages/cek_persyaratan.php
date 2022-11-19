<?php 
$img_pdf = "<img src='assets/img/icons/pdf.png' height='40px'>";

$btn_download_formulir = "Belum bisa Download Formulir.";
$true_count=0;
$li_sub = "<span class='red'>Anda belum melengkapi Formulir Pendaftaran | <a href='?formulir'>Isi Formulir</a> $img_warning</span>";
$li_up = "<span class='red'>Jumlah Upload: $jumlah_uploads of $total_uploads | <a href='?upload'>Goto Upload</a> $img_warning</span>";
$li_diterima = "<span class='red'>Upload Terverifikasi Petugas: $jumlah_uploads_diterima of $total_uploads | <a href='?upload'>Hubungi Petugas $img_wa</a></span>";

if($tanggal_submit_formulir!=""){
  $li_sub = "<span class='ijo'>Tanggal Submit Formulir: ".date("d M Y, H:i",strtotime($tanggal_submit_formulir))." WIB $img_check</span>";
  $true_count++;
}

if($jumlah_uploads==$total_uploads){
  $li_up = "<span class='ijo'>Jumlah Upload: $jumlah_uploads of $total_uploads $img_check</span>";
  $true_count++;
}

if($jumlah_uploads==$jumlah_uploads_diterima+$jumlah_uploads_ditolak){
  if($jumlah_uploads==$jumlah_uploads_diterima){
    $li_diterima = "<span class='ijo'>Jumlah Upload Diterima: $jumlah_uploads_diterima of $total_uploads $img_check</span>";
    $true_count++;
  }else{
    $li_diterima = "<span class='red'>Jumlah Upload Ditolak: $jumlah_uploads_ditolak $img_reject</span> | 
    <a href='?upload'>Go to Upload</a>
    ";
    // $true_count++;
  }
}



?>