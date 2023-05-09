<style type="text/css">
  #pj table {width: 100%;}
  #pj td,th {text-align: center;}
  #pj th {background: linear-gradient(#ffe,#cfc);}
  .btnz{font-size: 30px; }
</style>

<?php include "set_kelulusan_logic.php"; ?>
<h4>
  Assign Jadwal Tes | 
  <a href="?assign_jadwal&id_jadwal_tes=<?=$id_jadwal_tes?>">Edit Peserta</a>
</h4>
<hr>

<div class="row" id="pj">
  <div class="col-lg-6">
    <p>
      Tanggal Kelulusan (YYYY-MM-DD): <input type="text" class="form-control" id="tanggal_lulus_tes" placeholder="<?=date("Y-m-d") ?>" maxlength='10' value='<?=$tanggal_lulus_tes?>'><hr>
      <a href="?post_jadwal">List Jadwal</a> | 
      Peserta tes <span style="color:#008"><?=$nama_tes?></span> tanggal <span style="color:#008"><?=date("d M Y, H:i", strtotime($tanggal_tes)) ?></span>
    </p>

    <table>
      <thead>
        <th>No</th>
        <th colspan="3">Gelombang</th>
        <th>Pendaftar</th>
        <th>ID</th>
        <th>Aksi</th>
      </thead>

      <?=$rows_peserta_ikut_tes ?>

    </table>
  </div>

  <div class="col-lg-6">

    
    <p>Peserta yang lulus Tes</p>

    <table>
      <thead>
        <th>No</th>
        <th colspan="3">Gelombang</th>
        <th>Pendaftar</th>
        <th>ID / Grade</th>
        <th>Ket</th>
        <th>Aksi</th>
      </thead>

      <?=$rows_peserta_lulus_tes ?>


    </table>
  </div>
  
</div>


<script type="text/javascript" src="modul_adm/set_kelulusan.js"></script>