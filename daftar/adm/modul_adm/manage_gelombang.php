<link rel="stylesheet" type="text/css" href="modul_adm/manage.css">
<?php
$rows = "<tr><td colspan=5>No Data Gelombang</td></tr>";


$s = "SELECT * from tb_gelombang WHERE id_angkatan=$id_angkatan";
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

    $border = $status_gel ? " style='border: solid 4px blue; font-weight:bold' " : '';

    $rows .= "
    <tr>
    <td $border>$id_gelombang</td>
    <td class='editable' id='nama_gel__$id_gelombang' $border>$nama_gel</td>
    <td class='editable' id='tanggal_awal_gel__$id_gelombang' $border>$tanggal_awal_gel</td>
    <td class='editable' id='tanggal_akhir_gel__$id_gelombang' $border>$tanggal_akhir_gel</td>
    <td class='editable' id='status_gel__$id_gelombang' $border>$status_gel</td>
    <td class='deletable' id='del__$id_gelombang' $border>Del</td>
    </tr>
    ";
  }
}

$judultb = "
<tr>
<td class='tbheader'>Id</td>
<td class='tbheader'>Gelombang</td>
<td class='tbheader'>Tanggal Awal</td>
<td class='tbheader'>Tanggal Akhir</td>
<td class='tbheader'>Status</td>
<td class='tbheader'>Del</td>
</tr>
";


?>


<p><span class="manage_judul">Manage Gelombang</span> :: Gelombang aktif: <?=$id_gelombang ?> | Angkatan: <?=$id_angkatan?></p>
<table width="100%" id="tbpop">
  <?=$judultb?>
  <?=$rows?>
</table>

<button id="btn_tambah_gelombang" class="btn btn-primary" style="margin: 15px 0">Tambah Gelombang</button>








































<script type="text/javascript">
  $(document).ready(function(){

    var manage = $("#manage").val();
    $("#btn_tambah_"+manage).fadeIn();



    $("#btn_tambah_gelombang").click(function(){
      // var x = confirm("Tambah Gelombang baru?"); if(!x) return;
      var id_gelombang = prompt("Gelombang baru: (5 digit, contoh: 20221, artinya gel 1 TA 2022)","20221");
      if(!id_gelombang) return;

      var link_ajax = "ajax_adm/ajax_tambah_gelombang.php?id_gelombang="+id_gelombang;
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
      var x = confirm("Hapus Gelombang ini?"); if(!x) return;
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var id_gelombang = rid[1];

      var link_ajax = "ajax_adm/ajax_hapus_gelombang.php?id_gelombang="+id_gelombang;
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
      var id_gelombang = rid[1];
      var isi = $(this).text();

      var isi2 = prompt("New value:",isi); if(isi2.trim()=="") return;
      // var x = confirm("Yakin untuk mengubah data:\n\n"+isi+"\n\n-- menjadi --\n\n"+isi2+" ?"); if(!x) return;
      




      var link_ajax = "ajax_adm/ajax_ubah_gelombang.php?id_gelombang="+id_gelombang+"&field="+field+"&isi="+isi2+"";
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