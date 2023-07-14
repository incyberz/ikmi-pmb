
<!-- === Foto Keluarga ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_foto_keluarga" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Foto Bersama Keluarga <?=$bm?></b>
        <br><small>Silahkan Anda upload <span class="biru tebal">Foto Formal Bersama Keluarga</span>. Diusahakan menyertakan seluruh anggota yang tinggal serumah bersama Anda (sesuai Kartu Keluarga). Minimal ada Ayah, Ibu, Wali (jika ada), dan Saudara Kandung (jika ada).</small>

      </td>
    </tr>
    <?php if (file_exists($file_foto_keluarga)) {
      $btn_upload_foto_keluarga_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_foto_keluarga?>')"><img class="img-fluid rounded" src="<?=$file_foto_keluarga?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_foto_keluarga_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_foto_keluarga" name="file_foto_keluarga" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_foto_keluarga");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_foto_keluarga").disabled = true;
              }else{
                document.getElementById("btn_upload_foto_keluarga").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_foto_keluarga" name="btn_upload_foto_keluarga" disabled><?=$btn_upload_foto_keluarga_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END Foto Keluarga ======================================== -->





<!-- === Dok Eko ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_dok_eko" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Dokumen Pendukung Keadaan Ekonomi <?=$bm?></b>
        <br><small>Silahkan Anda upload Dokumen Pendukung bahwa Anda layak mendapatkan bantuan Beasiswa Pemerintah (KIP). Dokumen dapat berupa KIP-Pelajar, Surat Keterangan Tidak Mampu dari Desa, Kartu Keluarga Sejahtera, Kartu PKH (Program Keluarga Harapan), atau Dokumen Formal lainnya.</small>

      </td>
    </tr>
    <?php if (file_exists($file_dok_eko)) {
      $btn_upload_dok_eko_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_dok_eko?>')"><img class="img-fluid rounded" src="<?=$file_dok_eko?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_dok_eko_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_dok_eko" name="file_dok_eko" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_dok_eko");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_dok_eko").disabled = true;
              }else{
                document.getElementById("btn_upload_dok_eko").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_dok_eko" name="btn_upload_dok_eko" disabled><?=$btn_upload_dok_eko_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END Dok Eko ======================================== -->




<!-- === Foto Rumah ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_foto_rumah" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Foto Rumah Tampak Depan <?=$bm?></b>
        <br><small>Silahkan Anda Foto tempat tinggal Anda dari tampak depan. Foto harus menunjukan tampilan rumah Anda secara keseluruhan.</small>
      </td>
    </tr>
    <?php if (file_exists($file_foto_rumah)) {
      $btn_upload_foto_rumah_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_foto_rumah?>')"><img class="img-fluid rounded" src="<?=$file_foto_rumah?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_foto_rumah_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_foto_rumah" name="file_foto_rumah" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_foto_rumah");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_foto_rumah").disabled = true;
              }else{
                document.getElementById("btn_upload_foto_rumah").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_foto_rumah" name="btn_upload_foto_rumah" disabled><?=$btn_upload_foto_rumah_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END Foto Rumah ======================================== -->





<!-- === Foto Ruang Keluarga ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_foto_ruang_klg" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Foto Ruang Keluarga <?=$bm?></b>
        <br><small>Silahkan Anda Foto Ruang Keluarga Anda dari posisi pintu rumah. Foto harus dalam keadaan tidak ada orang. Foto harus menunjukan keseluruhan isi ruang keluarga Anda berikut kelengkapan rumahnya.</small>

      </td>
    </tr>
    <?php if (file_exists($file_foto_ruang_klg)) {
      $btn_upload_foto_ruang_klg_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_foto_ruang_klg?>')"><img class="img-fluid rounded" src="<?=$file_foto_ruang_klg?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_foto_ruang_klg_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_foto_ruang_klg" name="file_foto_ruang_klg" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_foto_ruang_klg");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_foto_ruang_klg").disabled = true;
              }else{
                document.getElementById("btn_upload_foto_ruang_klg").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_foto_ruang_klg" name="btn_upload_foto_ruang_klg" disabled><?=$btn_upload_foto_ruang_klg_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END Foto Ruang Keluarga ======================================== -->
