<?php include "../pendaftar_var.php"; ?>
<style type="text/css">
	#resign table{width: 100%; margin-bottom: 30px;}
	#resign th,td{padding: 10px; border: solid 1px #afa;}
  #resign th{padding: 9px 5px;text-align: center;background: linear-gradient(#fff,#afa)}
	#resign td{padding: 10px; background-color: #eff;}
	.bundle{border: solid 1px #afa; padding: 15px; border-radius: 10px; background-color: #ffe; margin: 20px 0;}

  /*.form-group {margin-bottom: 10px;}*/
  #resign label {margin: 10px 0  5px 0;font-sizea: small;}
</style>

<section id="resign" class="">
  <div class="container">

    <div class="section-title">
      <h2>Resign Persyaratan</h2>
      <p><span class="merah bold">Perhatian!</span> Jika Anda ingin menyatakan resign dari Proses Pendaftaran maka Anda wajib memberikan alasan yang jelas disertai dengan bukti formal dari institusi lain.</p>
    </div>

    <div class="form-group bundle">
    	Alasan saya resign:
    	<div>
    		<div><label><input type="radio" name="alasan_resign" value="1"> Diterima di PTN</label></div>
    		<div><label><input type="radio" name="alasan_resign" value="2"> Diterima di PTS lain</label></div>
    		<div><label><input type="radio" name="alasan_resign" value="3"> Diterima bekerja di Perusahaan</label></div>
    		<div><label><input type="radio" name="alasan_resign" value="9"> Alasan lainnya:</label></div>
    	</div>
    	<hr>
    	Alasan lainnya: 
    	<input type="text" class="form-control" id="alasan_lainnya">
    </div>

    <table>
    	<tr>
    		<td colspan="2">
    			Dokumen Formal
    			<div><small>
    				<ul>
    					<li>Dokumen dapat berupa Surat Keterangan di PTN/PTS, Surat Keterangan Bekerja dani perusahaan, Surat Pernyataan Orang Tua, dll.</li>
    					<li>Dokumen wajib ditanda-tangani dan di cap basah.</li>
    					<li>Khusus untuk Surat Pernyataan Orang Tua cukup ditandatangani dan disertai materai Rp 10.000,-</li>
    				</ul>
    			</small></div>
    			
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<input type="file" name="">
    		</td>
    		<td>
    			<button class="btn btn-success btn-sm not_ready">Upload</button>
    		</td>
    	</tr>
    </table>



    <table>
      <tr>
        <td>

          <div class="form-group">
            <label><input type="checkbox" name=""> Saya menyatakan bahwa saya menyatakan <u>Mengundurkan Diri</u> dari proses Penerimaan Mahasiswa Baru STMIK IKMI Cirebon periode <?=$periode_ta ?> dengan kehendak sendiri tanpa paksaan dari orang lain dan sudah memberikan alasan formal yang dapat dipertanggungjawabkan</label>
          </div>

          <hr>
          <button class="btn btn-danger not_ready" disableda="">Resign Pendaftaran</button>

        </td>
      </tr>
    </table>







  </div>
</section>