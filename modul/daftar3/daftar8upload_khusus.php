
<!-- === JALUR KHUSUS ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="jalur_khusus">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">SK / S.Keterangan <?=$bm?></b>
        <br>
        <small>
          Silahkan upload Surat Keterangan (SK Ngajar Orang Tua, SK Pengurus Mesjid, dll) yang menunjukan bahwa Anda layak menerima beasiswa dari IKMI Cirebon. SK wajib di cap dan ditandatangani oleh lembaga dan pejabat yang berwenang mengeluarkan SK tersebut.
        </small>
      </td>
    </tr>
    <?php if (file_exists($file_sk_jalur_khusus)) {
      $btn_upload_sk_jalur_khusus_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_sk_jalur_khusus?>')"><img class="img-fluid rounded" src="<?=$file_sk_jalur_khusus?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_sk_jalur_khusus_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_sk_jalur_khusus" name="file_sk_jalur_khusus" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_sk_jalur_khusus");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_sk_jalur_khusus").disabled = true;
              }else{
                document.getElementById("btn_upload_sk_jalur_khusus").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_sk_jalur_khusus" name="btn_upload_sk_jalur_khusus" disabled><?=$btn_upload_sk_jalur_khusus_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END JALUR KHUSUS ======================================== -->