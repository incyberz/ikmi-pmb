<?php 
$id_verifikasi = $_GET['id_verifikasi'];
echo "<input type='hidden' id='id_verifikasi' value='$id_verifikasi'>";


// ganti * dg spesifik
$s = "SELECT *,(SELECT nama_petugas from tb_petugas where id_petugas=a.id_petugas) as nama_petugas from tb_verifikasi_upload a 
join tb_daftar b on a.id_daftar=b.id_daftar 
join tb_calon c on b.email=c.email 
join tb_akun d on b.email=d.email 
join tb_persyaratan e on a.id_persyaratan=e.id_persyaratan 
where a.id_verifikasi='$id_verifikasi'";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
if(mysqli_num_rows($q)!=1) die("Data upload tidak ditemukan.");

$d = mysqli_fetch_assoc($q);

$tanggal_upload = $d['tanggal_upload'];
$id_petugas = $d['id_petugas'];
$tanggal_verifikasi_upload = $d['tanggal_verifikasi_upload'];
$nama_calon = $d['nama_calon'];
$email = $d['email'];
$id_persyaratan = $d['id_persyaratan'];
$nama_persyaratan = $d['nama_persyaratan'];
$folder_uploads = $d['folder_uploads'];
$ekstensi_file = $d['ekstensi_file'];
$format_nama_file = $d['format_nama_file'];
$id_daftar = $d['id_daftar'];
$nama_petugas = $d['nama_petugas'];
$alasan_reject = $d['alasan_reject'];
$no_wa = $d['no_wa'];
$status_upload = intval($d['status_upload']);


$max_width = 40; if($id_persyaratan!=1) $max_width = 80;
$img_upload = "<img src='../uploads/$folder_uploads/$format_nama_file"."__$id_daftar.$ekstensi_file' style='max-width: $max_width%' />";

$btn_verifikasi_disabled = '';
$status_upload_show = "<span style='color:red'>Belum diverifikasi</span>";
if($id_petugas!=""){
  if($status_upload === 1){
    $status_upload_show = "<span style='color:#050'>Telah diverifikasi oleh $nama_petugas at ".date("d M Y, H:i", strtotime($tanggal_verifikasi_upload))." </span>";
    $btn_verifikasi_disabled = "disabled";

  }else{
    $status_upload_show = "<span style='color:red'>Telah di-Reject oleh $nama_petugas at ".date("d M Y, H:i", strtotime($tanggal_verifikasi_upload))." dengan alasan: $alasan_reject</span>";
    $btn_verifikasi_disabled = '';

  }
}


$link_wa_notif_upload = '';
if($id_petugas!=""){
  $tanggal_upload_show = date("d F Y H:i");

  $keputusan_verifikasi = "mohon maaf kami nyatakan $nama_persyaratan Anda BELUM VALID dengan alasan $alasan_reject. Mohon segera Anda upload ulang! Terimakasih";
  if($status_upload)$keputusan_verifikasi = "kami nyatakan $nama_persyaratan Anda telah valid. Terimakasih";

  $link_wa_verifikasi = "https://api.whatsapp.com/send?phone=62$no_wa&text=[No-Reply] Kepada $nama_calon! Dari hasil verifikasi $nama_persyaratan yang Anda upload pada $tanggal_upload_show dan $keputusan_verifikasi. [Petugas PMB STMIK IKMI Cirebon, ".date("F d, Y, H:i:s")."] [No-Reply]";

  $link_wa_notif_upload = "
  <div style='margin: 10px 0'>
    <a class='btn btn-success' href='$link_wa_verifikasi' target='_blank'>$img_wa Send Notif Upload</a>
  </div>
  ";
}

?>

<h4>Verifikasi Upload <span style="color:#007"><?=$nama_persyaratan ?></span> atas nama <?=$nama_calon ?></h4>
<p><small>ID: <?=$id_verifikasi ?> :: Tanggal Upload: <?=date("d M Y, H:i", strtotime($tanggal_upload))?></small></p>

<div style="margin: 10px 0"><?=$img_upload?></div>
<div style="margin: 10px 0; padding: 10px 0; border-top: solid 1px #ccc; border-bottom: solid 1px #ccc;">
  Status: <?=$status_upload_show?>
  <?=$link_wa_notif_upload?>
</div>
<button id="btn_verif__1" class="btn_verif btn btn-primary" <?=$btn_verifikasi_disabled?>>Terima</button> 
<button id="btn_verif__0" class="btn_verif btn btn-danger">Reject</button> 
<!-- <button class="btn btn-success" onclick="history.go(-1)">Back</button>  -->













<script type="text/javascript">
  $(document).ready(function(){
    $(".btn_verif").click(function(){
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var nilai = parseInt(rid[1]);
      var alasan_reject = '';

      if(!nilai){
        alasan_reject = prompt("Alasan reject:");
        if(alasan_reject==="") return;
      }


      var id_verifikasi = $("#id_verifikasi").val();

      var x = confirm("Apakah Anda yakin set:\n\nStatus Upload = "+nilai); if(!x) return;

      var link_ajax = "ajax_adm/ajax_set_upload.php?id_verifikasi="+id_verifikasi+"&nilai="+nilai+"&alasan_reject="+alasan_reject+"";

      $.ajax({
        url:link_ajax,
        success:function(a){
          alert(a);
          location.reload();
        }
      })
    })
  })
</script>