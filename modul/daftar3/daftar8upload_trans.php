
<!-- === IJAZAH PT ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_ijazah_pt" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Ijazah PT Asal <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_ijazah_pt)) {
      $btn_upload_ijazah_pt_cap = "Replace Ijazah PT";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_ijazah_pt?>')"><img class="img-fluid rounded" src="<?=$file_ijazah_pt?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_ijazah_pt_cap = "Upload Ijazah PT"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_ijazah_pt" name="file_ijazah_pt" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_ijazah_pt");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_ijazah_pt").disabled = true;
              }else{
                document.getElementById("btn_upload_ijazah_pt").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_ijazah_pt" name="btn_upload_ijazah_pt" disabled><?=$btn_upload_ijazah_pt_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END IJAZAH PT ======================================== -->


<!-- === TRANSKRIP PT ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_transkrip_pt" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Transkrip PT Asal <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_transkrip_pt)) {
      $btn_upload_transkrip_pt_cap = "Replace Transkrip PT";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_transkrip_pt?>')"><img class="img-fluid rounded" src="<?=$file_transkrip_pt?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_transkrip_pt_cap = "Upload Transkrip PT"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_transkrip_pt" name="file_transkrip_pt" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_transkrip_pt");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_transkrip_pt").disabled = true;
              }else{
                document.getElementById("btn_upload_transkrip_pt").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_transkrip_pt" name="btn_upload_transkrip_pt" disabled><?=$btn_upload_transkrip_pt_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END TRANSKRIP PT ======================================== -->


<!-- === KTM ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_ktm" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">KTM <?=$bm?></b>
        <br><small>Jika KTM tidak ada/hilang, silahkan minta Surat Keterangan sebagai Mahasiswa dari PT Asal</small>
      </td>
    </tr>
    <?php if (file_exists($file_ktm)) {
      $btn_upload_ktm_cap = "Replace KTM";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_ktm?>')"><img class="img-fluid rounded" src="<?=$file_ktm?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_ktm_cap = "Upload KTM"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_ktm" name="file_ktm" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_ktm");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_ktm").disabled = true;
              }else{
                document.getElementById("btn_upload_ktm").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_ktm" name="btn_upload_ktm" disabled><?=$btn_upload_ktm_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END KTM ======================================== -->


<!-- === SKET PINDAH STUDI ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_sk_pindah_studi" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">S.Ket Pindah Prodi <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_sk_pindah_studi)) {
      $btn_upload_sk_pindah_studi_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_sk_pindah_studi?>')"><img class="img-fluid rounded" src="<?=$file_sk_pindah_studi?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_sk_pindah_studi_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_sk_pindah_studi" name="file_sk_pindah_studi" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_sk_pindah_studi");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_sk_pindah_studi").disabled = true;
              }else{
                document.getElementById("btn_upload_sk_pindah_studi").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_sk_pindah_studi" name="btn_upload_sk_pindah_studi" disabled><?=$btn_upload_sk_pindah_studi_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END SKET PINDAH STUDI ======================================== -->


<!-- === LAP PDPT ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_laporan_pdpt" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Laporan PDPT/EPSBED <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_laporan_pdpt)) {
      $btn_upload_laporan_pdpt_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_laporan_pdpt?>')"><img class="img-fluid rounded" src="<?=$file_laporan_pdpt?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_laporan_pdpt_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_laporan_pdpt" name="file_laporan_pdpt" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_laporan_pdpt");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_laporan_pdpt").disabled = true;
              }else{
                document.getElementById("btn_upload_laporan_pdpt").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_laporan_pdpt" name="btn_upload_laporan_pdpt" disabled><?=$btn_upload_laporan_pdpt_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END LAP PDPT ======================================== -->


<!-- === S.REKOM LLDIKTI ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_s_rekom_lldikti" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Surat Rekomendasi LLDIKTI <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_s_rekom_lldikti)) {
      $btn_upload_s_rekom_lldikti_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_s_rekom_lldikti?>')"><img class="img-fluid rounded" src="<?=$file_s_rekom_lldikti?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_s_rekom_lldikti_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_s_rekom_lldikti" name="file_s_rekom_lldikti" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_s_rekom_lldikti");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_s_rekom_lldikti").disabled = true;
              }else{
                document.getElementById("btn_upload_s_rekom_lldikti").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_s_rekom_lldikti" name="btn_upload_s_rekom_lldikti" disabled><?=$btn_upload_s_rekom_lldikti_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END S.REKOM LLDIKTI ======================================== -->

