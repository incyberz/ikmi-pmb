<?php include 'pendaftar_logic.php'; ?>
<h4>Data Pendaftar</h4>
<hr>

<style type="text/css">
  .bordered {
  	/*border: solid 1px #ccc;*/ 
  	margin-bottom: 15px;
  }

  .img_zoom{
  	transition: .2s;
  	opacity: 50%;
  	cursor: pointer;
  }

  .img_zoom:hover{
  	transform: scale(1.3);
  	opacity: 100%;
  }
</style>
<style type="text/css">ul {padding: 0 15px;}</style>


<div class="row">
	<div class="col-lg-2 bordered">
		<img src="<?=$img_profile?>" width="100%" class="img-rounded" style='margin-bottom: 15px;'>
	</div>
	<div class="col-lg-5 bordered">
		<?=$data_akun?>
		<hr>
		<a href='#' class='btn btn-success btn-sm' id="btn_reset_password">Reset Password Pendaftar</a> 
		<?php 
		echo "
		<a href='?login_as_pendaftar&email_calon=$email_calon&nama_calon=$nama_calon&id_calon=$id_calon&id_daftar=$id_daftar' class='btn btn-success btn-sm' id='btn_login_as'>Login As</a>
		"; 
		?> 		
		 

	</div>
	<div class="col-lg-5 bordered">
		<?=$data_jurusan?>

	</div>
	
</div>
<hr>
<div class="row">
	<div class="col-lg-6">
		<h5>Biodata Calon</h5>
		<?=$biodata_calon?>
	</div>
	<div class="col-lg-6">
		<h5>Sekolah Asal</h5>
		<?=$data_sekolah_asal?>
		<h5>Data Ortu</h5>
		<?=$data_ortu?>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-6">
		<h5>Upload Persyaratan</h5>
		<?=$data_persyaratan?>
	</div>
	<div class="col-lg-6">
		<h5>Kelulusan Tes PMB</h5>
		<?=$data_tes_pmb?>
	</div>
</div>






<script type="text/javascript">
	$(document).ready(function(){

		
		$("#btn_reset_password").click(function(){
			let id = $(this).prop("id");
			let email_calon = $("#email_calon").text();
			let no_wa = $("#no_wa").text();

			let y = confirm("Yakin untuk reset??\n\n\nPassword akan dikembalikan secara default (password = nomor WA)."); 
			if(!y) return;

			let lz = "ajax_adm/ajax_update_data_akun.php"
			+"?field=password"
			+"&isi="+no_wa
			+"&email_calon="+email_calon;

			// alert(lz); return;
			$.ajax({
				url:lz,
				success:function(h){
					if(h=="1__"){
						alert('Reset berhasil.\n\nSilahkan konfirmasikan ke WhatsApp Calon!');
					}else{
						alert(h);
					}
				}
			})

		})

		$(".icon_edit").click(function(){
			// alert(0)
			let id = $(this).prop("id");
			let field= '';

			if(id=="icon_edit__nama_calon") field = "nama_calon";
			if(id=="icon_edit__no_wa") field = "no_wa";
			if(field=="") return;

			let nama_calon = $("#nama_calon").text();
			let email_calon = $("#email_calon").text();
			let no_wa = $("#no_wa").text();

			let default_isi = '';
			if(field=="nama_calon") default_isi = nama_calon;
			if(field=="no_wa") default_isi = no_wa;


			let isi = prompt("New value:", default_isi); 
			if(!isi || isi==default_isi) return;

			let lz = "ajax_adm/ajax_update_data_akun.php"
			+"?field="+field
			+"&isi="+isi
			+"&email_calon="+email_calon;

			// alert(lz)
			$.ajax({
				url:lz,
				success:function(h){
					if(h=="1__"){
						$("#"+field).text(isi);
					}else{
						alert(h);
					}
				}
			})

		})
	})
</script>