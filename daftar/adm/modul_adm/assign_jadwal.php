<style type="text/css">
  #pj table {width: 100%;}
  #pj td,th {text-align: center;}
  #pj th {background: linear-gradient(#ffe,#cfc);}
  .btnz{font-size: 30px; }
</style>

<h4>Assign Jadwal Tes</h4>
<hr>
<!-- <div style="background:linear-gradient(#fff,#ffc); border:solid 1px #fcc; border-radius:15px; padding: 15px; margin:15px 0"> -->
  <?php include "assign_jadwal_logic.php"; ?>

<div class="row" id="pj">
  <div class="col-lg-6">
    <p>Berikut adalah seluruh pendaftar yang belum mendapat jadwal tes dan sudah melengkapi seluruh persyaratan.</p>
    <table>
      <thead>
        <th>No</th>
        <th>Gelombang</th>
        <th colspan="2">Pendaftar</th>
        <th>Persyaratan Tes</th>
        <th>Aksi</th>
      </thead>

      <?=$rows_calon_peserta_tes ?>

    </table>
  </div>

  <div class="col-lg-6">
    <p>
      <a href="?post_jadwal">List Jadwal</a> | 
      Peserta tes <span style="color:#008"><?=$nama_tes?></span> tanggal <span style="color:#008"><?=date("d M Y, H:i", strtotime($tanggal_tes)) ?></span></p>
    <table>
      <thead>
        <th>No</th>
        <th>Gelombang</th>
        <th>Prodi</th>
        <th>Jalur</th>
        <th>Pendaftar</th>
        <th>Nomor Tes</th>
        <th>Aksi</th>
      </thead>

      <?=$rows_peserta_this_tes ?>


    </table>
  </div>
  
</div>


<script type="text/javascript" src="modul_adm/assign_jadwal.js"></script>