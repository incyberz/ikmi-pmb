<?php $sel_g = isset($_GET['sel_g']) ? $_GET['sel_g'] : 1; ?>
<style type="text/css">
  hr{border-color: #ccc;}
  #pj table {width: 100%;}
  #pj td,th {text-align: center;}
  #pj th {background: linear-gradient(#ffe,#cff);}
  .btnz{font-size: 30px; }
  .nama_tes {color: #008;cursor: pointer;}
  .nama_tes:hover {font-weight: bold;}
  .row_jadwal td{color: #008;cursor: pointer;}
  .row_jadwal:hover{color: #0fa; font-weight: bold;}
  .hideit{ display: none;}
</style>

<h4>List Jadwal Tes :: Gelombang <?=$sel_g ?> - <?=$id_angkatan ?></h4>

  Gelombang: 
  <?php 
  for ($i=1; $i < 5; $i++) echo "<a = href='?post_jadwal&sel_g=$i'>$i</a> | ";

  $s = "SELECT * from tb_jadwal_tes where id_gelombang = $id_angkatan$sel_g";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));
  if(mysqli_num_rows($q)==0) {
    $rows_jadwal_tes = "<tr><td colspan='11' style='color:red'>Belum ada Jadwal Tes untuk Gelombang $sel_g</td></tr>";
  }else{
    $i=0;
    $rows_jadwal_tes = "";
    while ($d=mysqli_fetch_assoc($q)) {
      $i++;
      $id_jadwal_tes = $d['id_jadwal_tes'];
      $tanggal_tes = $d['tanggal_tes'];
      $id_gelombang = $d['id_gelombang'];
      $tahap_tes = $d['tahap_tes'];
      $nama_tes = $d['nama_tes'];
      $keterangan = $d['keterangan'];
      $link_tes = $d['link_tes'];
      $link_hasil_kip = $d['link_hasil_kip'];
      $link_hasil_reg = $d['link_hasil_reg'];
      $tanggal_pelaksanaan = $d['tanggal_pelaksanaan'];
      $titi_mangsa = $d['titi_mangsa'];
      $tanggal_deadline = $d['tanggal_deadline'];

      $tanggal_tes_show = date("d M Y H:i", strtotime($tanggal_tes));

      $tanggal_pelaksanaan_show = "<span style='color:red'>Belum dilaksanakan</span>";
      if($tanggal_pelaksanaan!="") $tanggal_pelaksanaan_show = "Terlaksana pada $tanggal_pelaksanaan";

      $link_delete = "<a href='#' class='not_ready delete_jadwal' id='delete_jadwal__$id_jadwal_tes' style='color:red'>Delete</a>";
      $link_assign = "<a href='?assign_jadwal&id_jadwal_tes=$id_jadwal_tes' >Assign</a>";
      $link_kelulusan = "<a href='?set_kelulusan&id_jadwal_tes=$id_jadwal_tes' >Kelulusan</a>";

      $rows_jadwal_tes .= "<tr class='row_jadwala' id='row_jadwal__$id_jadwal_tes'>
        <td id='tahap_tes__$id_jadwal_tes' class='editable'>$tahap_tes</td>
        <td id='nama_tes__$id_jadwal_tes' class='editable'>$nama_tes</td>
        <td id='id_gelombang__$id_jadwal_tes' class='editable'>$id_gelombang</td>
        <td id='tanggal_tes__$id_jadwal_tes' class='editable'>$tanggal_tes</td>
        <td id='tanggal_pelaksanaan__$id_jadwal_tes' class='editable'>$tanggal_pelaksanaan</td>
        <td id='link_tes__$id_jadwal_tes' class='editable'>$link_tes</td>
        <td id='keterangan__$id_jadwal_tes' class='editable'>$keterangan</td>
        <td id='titi_mangsa__$id_jadwal_tes' class='editable'>$titi_mangsa</td>
        <td id='tanggal_deadline__$id_jadwal_tes' class='editable'>$tanggal_deadline</td>
        <td>$link_delete<br>$link_assign<br>$link_kelulusan</td>
      </tr>";
    }
  }



?>

<div class="div_view" id="div_list">
  <!-- <p>Berikut adalah list jadwal test yang dapat Anda assign.</p> -->

  <table class="table table-bordered" id="pj">
    <thead>
      <th>Tahap</th>
      <th>Nama Tes</th>
      <th>Gel</th>
      <th>Jadwal Tes</th>
      <th>Pelaksanaan tes</th>
      <th>Link</th>
      <th>Keterangan</th>
      <th>Titi Mangsa Surat PDF</th>
      <th>Tanggal Deadline Registrasi Ulang</th>
      <th>Aksi</th>
    </thead>
    <?=$rows_jadwal_tes ?>
  </table>

  <button class="btn btn-success " id="btn_tambah_jadwal_tes" style="margin:15px 0">Tambah Jadwal Tes</button>

</div>




<script type="text/javascript" src="modul_adm/post_jadwal.js"></script>
