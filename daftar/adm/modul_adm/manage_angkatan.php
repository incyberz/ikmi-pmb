<link rel="stylesheet" type="text/css" href="modul_adm/manage.css">
<?php
$rows = "<tr><td colspan=5>No Data Angkatan</td></tr>";


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

?>


<p><span class="manage_judul">Manage Angkatan</span> :: Angkatan aktif: <?=$id_angkatan ?></p>
<table width="100%" id="tbpop">
  <?=$judultb?>
  <?=$rows?>
</table>

<button id="btn_tambah_angkatan" class="btn btn-primary" style="margin: 15px 0">Tambah Angkatan</button>








































<script type="text/javascript">
  $(document).ready(function(){

    var manage = $("#manage").val();
    $("#btn_tambah_"+manage).fadeIn();



    $("#btn_tambah_angkatan").click(function(){
      // var x = confirm("Tambah Angkatan baru?"); if(!x) return;
      var id_angkatan = prompt("Angkatan baru: (4 digit, contoh: 2022)","2022");
      if(!id_angkatan) return;

      var link_ajax = "ajax_adm/ajax_tambah_angkatan.php?id_angkatan="+id_angkatan;
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

      var link_ajax = "ajax_adm/ajax_hapus_angkatan.php?id_angkatan="+id_angkatan;
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
      




      var link_ajax = "ajax_adm/ajax_ubah_angkatan.php?id_angkatan="+id_angkatan+"&field="+field+"&isi="+isi2+"";
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