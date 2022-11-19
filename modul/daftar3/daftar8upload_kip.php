
<!-- === KIP ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_kip" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Scan KIP Kuliah <?=$bm?></b>
        <br><small>Scan atau foto Kartu-KIP Kuliah Anda dengan resolusi tinggi agar data KTP dapat terbaca dengan jelas. Jika KIP-Kuliah belum terbit maka dapat digantikan dengan KIP-Pelajar atau Bukti Scan/Screenshoot bahwa Anda sedang mengajukan KIP Kuliah.</small>

      </td>
    </tr>
    <?php if (file_exists($file_kip)) {
      $btn_upload_kip_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_kip?>')"><img class="img-fluid rounded" src="<?=$file_kip?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_kip_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_kip" name="file_kip" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_kip");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_kip").disabled = true;
              }else{
                document.getElementById("btn_upload_kip").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_kip" name="btn_upload_kip" disabled><?=$btn_upload_kip_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END KIP ======================================== -->
