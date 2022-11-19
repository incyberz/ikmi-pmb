
<!-- === BUKTI BAYAR ======================================== -->
<?php 
if ($id_jndaftar==1 or $id_jndaftar==2) {
?>
<div class="form-group col-md-5 blok_input_persyaratan" id="input_bukti_bayar" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Bukti Bayar Biaya Formulir<?=$bm?></b>
        <br><small>Silahkan Anda transfer ke:
              <br> - Bank BRI 
              <br> - No Rek. 4149-01-000004-30-5
              <br> - a.n IKMI CIREBON
              <br> - Jalur Reguler: Rp 200.000,-
              <br> - Jalur Transfer: Rp 350.000,-
          </small>
      </td>
    </tr>
    <?php if (file_exists($file_bukti_bayar)) {
      $btn_upload_bukti_bayar_cap = "Replace Bukti Bayar";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_bukti_bayar?>')"><img class="img-fluid rounded" src="<?=$file_bukti_bayar?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_bukti_bayar_cap = "Upload Bukti Bayar"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_bukti_bayar" name="file_bukti_bayar" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_bukti_bayar");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_bukti_bayar").disabled = true;
              }else{
                document.getElementById("btn_upload_bukti_bayar").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_bukti_bayar" name="btn_upload_bukti_bayar" disabled><?=$btn_upload_bukti_bayar_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END BUKTI BAYAR ======================================== -->
<?php } ?>
<!-- === PAS PHOTO ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_pas_photo" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Pas Photo <?=$bm?></b>
        <br><small>)* Silahkan Anda upload <span class="biru tebal">Scan Pas foto formal</span> berlatar biru/merah polos (disarankan berlatar biru). Mohon tidak mengupload foto selfie atau foto tidak formal. Pas Foto Anda akan digunakan untuk mencetak Kartu Tanda Mahasiswa (KTM).</small>
      </td>
    </tr>
    <?php if (file_exists($file_pas_photo)) {
      $btn_upload_pas_photo_cap = "Replace Pas Photo";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_pas_photo?>')"><img class="img-fluid rounded" src="<?=$file_pas_photo?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_pas_photo_cap = "Upload Pas Photo"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_pas_photo" name="file_pas_photo" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_pas_photo");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_pas_photo").disabled = true;
              }else{
                document.getElementById("btn_upload_pas_photo").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_pas_photo" name="btn_upload_pas_photo" disabled><?=$btn_upload_pas_photo_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END PAS PHOTO ======================================== -->


<!-- === IJAZAH SMA ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_ijazah_sma" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Ijazah SMA <?=$bm?></b>
        <br><small>Sediakan hasil scan atau cukup foto dg baik ijazah Anda. Jika ijazah belum terbit, maka sementara dapat digantikan dengan Surat Keterangan Lulus (SKL) atau Surat Keterangan Siswa Tingkat Akhir dari Sekolah Anda.</small>
      </td>
    </tr>
    <?php if (file_exists($file_ijazah_sma)) {
      $btn_upload_ijazah_sma_cap = "Replace Ijazah SMA";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_ijazah_sma?>')"><img class="img-fluid rounded" src="<?=$file_ijazah_sma?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_ijazah_sma_cap = "Upload Ijazah SMA"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_ijazah_sma" name="file_ijazah_sma" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_ijazah_sma");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_ijazah_sma").disabled = true;
              }else{
                document.getElementById("btn_upload_ijazah_sma").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_ijazah_sma" name="btn_upload_ijazah_sma" disabled><?=$btn_upload_ijazah_sma_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === IJAZAH SMA ======================================== -->


<!-- === TRANSKRIP SMA ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_transkrip_sma" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Transkrip UN/UAS SMA <?=$bm?></b>
        <br><small>Sediakan hasil scan atau cukup foto dg baik transkrip Anda. Jika belum ada, maka sementara dapat digantikan dengan raport semester terakhir.</small>
      </td>
    </tr>
    <?php if (file_exists($file_transkrip_sma)) {
      $btn_upload_transkrip_sma_cap = "Replace Transkrip SMA";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_transkrip_sma?>')"><img class="img-fluid rounded" src="<?=$file_transkrip_sma?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_transkrip_sma_cap = "Upload Transkrip SMA"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_transkrip_sma" name="file_transkrip_sma" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_transkrip_sma");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_transkrip_sma").disabled = true;
              }else{
                document.getElementById("btn_upload_transkrip_sma").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_transkrip_sma" name="btn_upload_transkrip_sma" disabled><?=$btn_upload_transkrip_sma_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END TRANSKRIP SMA ======================================== -->


<!-- === KARTU KELUARGA ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_kartu_keluarga" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Kartu Keluarga <?=$bm?></b>
        <br><small>Scan atau foto KK dengan resolusi tinggi agar Nomor NIK dapat terbaca dengan jelas.</small>
      </td>
    </tr>
    <?php if (file_exists($file_kartu_keluarga)) {
      $btn_upload_kartu_keluarga_cap = "Replace Kartu Keluarga";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_kartu_keluarga?>')"><img class="img-fluid rounded" src="<?=$file_kartu_keluarga?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_kartu_keluarga_cap = "Upload Kartu Keluarga"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_kartu_keluarga" name="file_kartu_keluarga" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_kartu_keluarga");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_kartu_keluarga").disabled = true;
              }else{
                document.getElementById("btn_upload_kartu_keluarga").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_kartu_keluarga" name="btn_upload_kartu_keluarga" disabled><?=$btn_upload_kartu_keluarga_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END KARTU KELUARGA ======================================== -->


<!-- === KTP ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_ktp" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">KTP <?=$bm?></b>
        <br><small>Scan atau foto KTP Anda dengan resolusi tinggi agar data KTP dapat terbaca dengan jelas.</small>

      </td>
    </tr>
    <?php if (file_exists($file_ktp)) {
      $btn_upload_ktp_cap = "Replace KTP";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_ktp?>')"><img class="img-fluid rounded" src="<?=$file_ktp?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_ktp_cap = "Upload KTP"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_ktp" name="file_ktp" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_ktp");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_ktp").disabled = true;
              }else{
                document.getElementById("btn_upload_ktp").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_ktp" name="btn_upload_ktp" disabled><?=$btn_upload_ktp_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END KTP ======================================== -->
