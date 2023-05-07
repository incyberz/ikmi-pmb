<link rel="stylesheet" type="text/css" href="modul_adm/manage.css">
<?php
$rows = "<tr><td colspan=5>No Data Jalur</td></tr>";


$s = "SELECT * from tb_jalur";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

if(mysqli_num_rows($q)>0){
  $rows = "";
  $i=0;
  while ($d = mysqli_fetch_array($q)) {
    $i++;
    $id_jalur = $d['id_jalur'];
    $id_angkatan = $d['id_angkatan'];
    $nama_jalur = $d['nama_jalur'];
    $singkatan_jalur = $d['singkatan_jalur'];
    $status_jalur = $d['status_jalur'];

    $rows .= "
    <tr>
    <td>$i</td>
    <td class='editablezzz' id='id_angkatan__$id_jalur'>$id_angkatan</td>
    <td class='editable' id='nama_jalur__$id_jalur'>$nama_jalur</td>
    <td class='editable' id='singkatan_jalur__$id_jalur'>$singkatan_jalur</td>
    <td class='editable' id='status_jalur__$id_jalur'>$status_jalur</td>
    <td class='deletable' id='del__$id_jalur'>Del</td>
    </tr>
    ";
  }
}

$judultb = "
<tr>
<td class='tbheader'>No</td>
<td class='tbheader'>Angkatan</td>
<td class='tbheader'>Nama Jalur</td>
<td class='tbheader'>Singkatan Jalur</td>
<td class='tbheader'>Status</td>
<td class='tbheader'>Del</td>
</tr>
";

?>


<p><span class="manage_judul">Manage Jalur</span>  </p>
<table width="100%" id="tbpop">
  <?=$judultb?>
  <?=$rows?>
</table>

<button id="btn_tambah_jalur" class="btn btn-primary" style="margin: 15px 0">Tambah Jalur</button>








































<script type="text/javascript">
  $(document).ready(function(){

    let manage = $("#manage").val();
    $("#btn_tambah_"+manage).fadeIn();



    $("#btn_tambah_jalur").click(function(){
      // let x = confirm("Tambah Jalur baru?"); if(!x) return;
      let nama_jalur = prompt('Jalur baru:','NEW JALUR');
      if(!nama_jalur) return;

      let link_ajax = "ajax_adm/ajax_tambah_jalur.php?nama_jalur="+nama_jalur;
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
      let x = confirm("Hapus Jalur ini?"); if(!x) return;
      let tid = $(this).prop("id");
      let rid = tid.split("__");
      let id_jalur = rid[1];

      let link_ajax = "ajax_adm/ajax_hapus_jalur.php?id_jalur="+id_jalur;
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
      let tid = $(this).prop("id");
      let rid = tid.split("__");
      let kolom = rid[0];
      let id_jalur = rid[1];
      let isi = $(this).text();

      let isi2 = prompt("New value:",isi); if(isi2.trim()=="") return;
      // let x = confirm("Yakin untuk mengubah data:\n\n"+isi+"\n\n-- menjadi --\n\n"+isi2+" ?"); if(!x) return;
      
      let link_ajax = "ajax_adm/ajax_ubah_jalur.php?id_jalur="+id_jalur+"&kolom="+kolom+"&isi="+isi2+"";
      // alert(link_ajax); return;
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