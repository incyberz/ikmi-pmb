<?php //include 'master_pmb_logic.php'; ?>

<style type="text/css">
  .img_aksi, .img_aksi_disabled{
    width: 30px;
  }

  .img_aksi{
    transition: transform 0.2s;
    cursor: pointer;
  }

  .img_aksi:hover{
    transform: scale(1.3);
  }
</style>

<h4>Pendaftar PMB <?=$id_angkatan ?></h4>

<button class="btn btn-success btn-sm" style="padding: 0 5px; margin-bottom: 5px;" id="btn_toggle_filter">Hide</button>



<table class="table-bordered" width="100%" id="tb_filter" style="margin-bottom: 5px;">
  <style type="text/css">#tb_filter td{padding: 5px;}</style>
  <tr>
    <td>
      Gel
      <select class="filter filter_select" id="id_gelombang_filter">
        <option value="all">-All-</option>
        <?php 
        for ($i=0; $i < count($rid_gelombang) ; $i++) { 
          echo "<option>$rid_gelombang[$i]</option>";
        }
        ?>
      </select>
    </td>
    <td>
      Jalur
      <select class="filter filter_select" id="id_jalur_filter">
        <option value="all">-All-</option>
        <?php 
        for ($i=0; $i < count($rsingkatan_jalur) ; $i++) { 
          echo "<option value='$rid_jalur[$i]'>$rsingkatan_jalur[$i]</option>";
        }
        ?>
      </select>
    </td>
    <td>
      Prodi
      <select class="filter filter_select" id="id_prodi_filter">
        <option value="all">-All-</option>
        <?php 
        for ($i=0; $i < count($rsingkatan_prodi) ; $i++) { 
          echo "<option value='$rid_prodi[$i]'>$rsingkatan_prodi[$i]</option>";
        }
        ?>
      </select>
    </td>
    <td>
      Nama
      <input type="text" class="" id="nama_calon_filter" size="5">
    </td>

    <td>
      Page:
      <select class="filter filter_select" id="page_ke">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
      </select>
    </td>
    <td>
      Show:
      <select class="filter filter_select" id="show_count">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
        <option>500</option>
      </select>
    </td>
    <td>
      Sort:
      <select class="filter filter_select" id="order_by">
        <option value="tanggal_daftar desc">Terbaru</option>
        <option value="tanggal_daftar">Terlama</option>
        <option value="nama_calon">Nama</option>
      </select>
    </td>
    <tr>
      <td colspan="7">
        <!-- <label><input type="checkbox" id="enable" checked="" disabled=""> enable</label>
        <label><input type="checkbox" id="disable" checked="" disabled=""> disable</label>
        <label><input type="checkbox" id="wa_verified" checked="" disabled=""> wa_verified</label>
        <label><input type="checkbox" id="mail_verified" checked="" disabled=""> mail_verified</label>
        <label><input type="checkbox" id="submitted" checked="" disabled=""> submitted</label>
        <label><input type="checkbox" id="foto_profil" checked="" disabled=""> foto_profil</label>
        <label><input type="checkbox" id="sudah_bayar" checked="" disabled=""> sudah_bayar</label>
        <label><input type="checkbox" id="bukti_kip" checked="" disabled=""> bukti_kip</label> -->
        <button id='btn_get_csv' class="btn btn-primary btn-sm">Get CSV</button>
      </td>
      
    </tr>
  </tr>
</table>




<div id="rows_pendaftar"></div>



<script type="text/javascript" src="modul_adm/master_pmb.js"></script>