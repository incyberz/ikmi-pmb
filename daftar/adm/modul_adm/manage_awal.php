<?php 
$manage = isset($_GET['manage']) ? $_GET['manage'] : "angkatan";
echo "<input type='hidden' id='manage' value='$manage'>";
$rows = '';
$manage_proper = ucwords(strtolower($manage));

?>

<style type="text/css">
.tbheader{
  background: linear-gradient(#eef,#ccf);
  font-weight: bold;
}

#tbpop td{
  border: solid 1px #ccc; padding: 10px; margin: 0;
}

.deletable{
  cursor: pointer;
  background-color: #faa;
}
.deletable:hover{
  background: linear-gradient(#ffa,#f55);
}
.editable{
  cursor: pointer;
  background-color: #9f9 !important;
}
.editable:hover{
  background: linear-gradient(#bfb,#fbb);
}
</style>













<?php
$rows = "<tr><td colspan=5>No Data $manage_proper</td></tr>";

if($manage=="angkatan"){
  $s = "SELECT * from tb_angkatan";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));

  if(mysqli_num_rows($q)>0){
    $rows = '';
    $i=0;
    while ($d = mysqli_fetch_array($q)) {
      $i++;
      $id_angkatan = $d['id_angkatan'];
      $tgl_pembukaan = $d['tgl_pembukaan'];
      $tgl_penutupan = $d['tgl_penutupan'];

      $rows .= "
      <tr>
      <td>$i</td>
      <td class='editable' id='id_angkatan__$id_angkatan'>$id_angkatan</td>
      <td class='editable' id='tgl_pembukaan__$id_angkatan'>$tgl_pembukaan</td>
      <td class='editable' id='tgl_penutupan__$id_angkatan'>$tgl_penutupan</td>
      <td class='deletable' id='del__$id_angkatan'>Del</td>
      </tr>
      ";
    }
  }

  $judultb = "
  <tr>
  <td class='tbheader'>No</td>
  <td class='tbheader'>Angkatan</td>
  <td class='tbheader'>Tanggal Pembukaan</td>
  <td class='tbheader'>Tanggal Penutupan</td>
  <td class='tbheader'>Del</td>
  </tr>
  ";
}













if($manage=="gelombang"){

  if(!isset($id_angkatan)) $id_angkatan = date("Y");

  $s = "SELECT * from tb_gelombang a 
  JOIN tb_angkatan b on a.id_angkatan=b.id_angkatan  
  ";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));

  if(mysqli_num_rows($q)>0){
    $rows = '';
    $i=0;
    while ($d = mysqli_fetch_array($q)) {
      $i++;
      $id_gelombang = $d['id_gelombang'];
      $nama_gel = $d['nama_gel'];
      $tanggal_awal_gel = $d['tanggal_awal_gel'];
      $tanggal_akhir_gel = $d['tanggal_akhir_gel'];
      $status_gel = $d['status_gel'];
      $tgl_pembukaan = $d['tgl_pembukaan'];
      $tgl_penutupan = $d['tgl_penutupan'];

      $rows .= "
      <tr>
      <td>$i</td>
      <td>
        $id_angkatan<br>
        <small><i>
          ~ Pembukaan: $tgl_pembukaan<br>
          ~ Penutupan: $tgl_penutupan
        </i></small>
      </td>
      <td class='editable' id='nama_gel__$id_gelombang'>$nama_gel</td>
      <td class='editable' id='tanggal_awal_gel__$id_gelombang'>$tanggal_awal_gel</td>
      <td class='editable' id='tanggal_akhir_gel__$id_gelombang'>$tanggal_akhir_gel</td>
      <td class='editable' id='status_gel__$id_gelombang'>$status_gel</td>
      <td class='deletable' id='del__$id_gelombang'>Del</td>
      </tr>
      ";
    }
  }

  $judultb = "
  <tr>
  <td class='tbheader'>No</td>
  <td class='tbheader'>Angkatan</td>
  <td class='tbheader'>Gelombang</td>
  <td class='tbheader'>Tanggal Awal</td>
  <td class='tbheader'>Tanggal Akhir</td>
  <td class='tbheader'>Status</td>
  <td class='tbheader'>Del</td>
  </tr>
  ";
}















?>


<h4 style="text-transform: uppercase; margin-top: 0;">Manage <?=$manage?></h4>
<p>Angkatan aktif: <?=$id_angkatan ?>. Gelombang aktif: <?=$id_gelombang ?></p>
<table width="100%" id="tbpop">
  <?=$judultb?>
  <?=$rows?>
</table>

<button id="btn_tambah_angkatan" class="btn btn-primary hideit" style="margin: 15px 0">Tambah Angkatan</button>
<button id="btn_tambah_gelombang" class="btn btn-primary hideit" style="margin: 15px 0">Tambah Gelombang</button>








































<script type="text/javascript">
  $(document).ready(function(){

    var manage = $("#manage").val();
    $("#btn_tambah_"+manage).fadeIn();



    $("#btn_tambah_angkatan").click(function(){
      var x = confirm("Tambah Angkatan baru?"); if(!x) return;

      var link_ajax = "ajax_tambah_angkatan.php";
      $.ajax({
        url:link_ajax,
        success:function(a){
          if(a.trim()=="1__"){
            location.reload()
          }else{
            alert(a)
          }
        }
      })
    })

    $(".deletable").click(function(){
      var x = confirm("Hapus Angkatan ini?"); if(!x) return;
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var id_angkatan = rid[1];

      var link_ajax = "ajax_hapus_angkatan.php?id_angkatan="+id_angkatan;
      $.ajax({
        url:link_ajax,
        success:function(a){
          if(a.trim()=="1__"){
            location.reload()
          }else{
            alert(a)
          }
        }
      })
    })


    $(".editable").click(function(){
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var field = rid[0];
      var id_angkatan = rid[1];
      var isi = $(this).text();

      var isi2 = prompt("New value:",isi); if(isi2.trim()=="") return;
      // var x = confirm("Yakin untuk mengubah data:\n\n"+isi+"\n\n-- menjadi --\n\n"+isi2+" ?"); if(!x) return;
      




      var link_ajax = "ajax_ubah_angkatan.php?id_angkatan="+id_angkatan+"&field="+field+"&isi="+isi2+"";
      // alert(link_ajax);
      // return;
      $.ajax({
        url:link_ajax,
        success:function(a){
          if(a.trim()=="1__"){
            location.reload()
          }else{
            alert(a)
          }
        }
      })
    })



    
  })
</script>