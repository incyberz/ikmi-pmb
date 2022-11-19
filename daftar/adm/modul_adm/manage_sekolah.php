<?php $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : ""; ?>
<p><b>Manage Data Sekolah</b> :: Ceklis 2 sekolah lalu Merge Data jika sekolah tersebut sama.</p>
<form method="post" action="index.php?manage_sekolah">
	<input type="text" name="keyword" value="<?=$keyword?>" style='text-align: center;'> <button>Filter</button>
</form>

<?php 
$rows_data = "";

$s = "
SELECT a.id_sekolah, a.nama_sekolah,
(SELECT COUNT(1) FROM tb_calon b WHERE b.id_sekolah = a.id_sekolah ) as jumlah_sekolah, 
(SELECT c.nama_kec FROM tb_kec c WHERE c.id_kec=a.id_kec_sekolah) as nama_kec, 
(SELECT d.nama_kab FROM tb_kab d JOIN tb_kec e ON d.id_kab=e.id_kab WHERE e.id_kec=a.id_kec_sekolah) as nama_kab  
FROM tb_sekolah a 
WHERE a.nama_sekolah LIKE '%$keyword%'
ORDER BY nama_sekolah  
LIMIT 150 
";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

if(mysqli_num_rows($q)==0){
	$rows_data .= "<tr><td align=center colspan=5 style='color:red'><b>No Data Available with keyword: $keyword.</b></td></tr>";
}else{
	$i=0;
	while ($d=mysqli_fetch_assoc($q)) {
		$i++;
		$id_sekolah = $d['id_sekolah'];
		$jumlah_sekolah = $d['jumlah_sekolah'];
		$nama_sekolah = strtoupper($d['nama_sekolah']);
		$nama_kec = strtoupper($d['nama_kec']);
		$nama_kab = strtoupper($d['nama_kab']);

		$nama_kec_show = $nama_kec==""?"-":"KEC $nama_kec $nama_kab";

		if($jumlah_sekolah>0){
			$input_cb = "<input type='checkbox' id='cb__$id_sekolah' class='cb'>";
			$btn_delete = "-";
		}else{
			$input_cb = "-";
			$btn_delete = "<button class='btn btn-danger btn-sm btn_delete' id='btn_delete__$id_sekolah'>Delete</button>";
		}

		$rows_data .= "
		<tr id='row__$id_sekolah'>
			<td align=center>$i</td>
			<td>
			  <span id='nama_sekolah__$id_sekolah'>$nama_sekolah</span>
			  <span id='id_sekolah__$id_sekolah' style='display:none'>$id_sekolah</span>
			</td>
			<td>
				$nama_kec_show
			</td>
			<td align=center>
			  <span id='jumlah_sekolah__$id_sekolah'>$jumlah_sekolah</span> Peserta
			</td>
			<td align=center>$input_cb</td>
			<td>$btn_delete</td>
		</tr>
		";
	}
}






?>

<style type="text/css">
	#blok_sekolah{
		height: 300px;
		overflow-y: scroll;
		margin: 15px 0;
		border: solid 1px #ccc;
		border-radius: 10px;
		background-color: white;
	}

	#tb_merge td{
		vertical-align: middle;
		text-align: center;
	}

	#blok_merge{
		display: grid;
		grid-template-columns: auto 150px;
		border: solid 1px #ccc;
		border-radius: 10px;
		padding: 10px;
		background-color: white;
	}
</style>
<div id="blok_sekolah">
	<table class="table table-striped table-hover">
		<thead>
			<th>Rank</th>
			<th>Nama Sekolah</th>
			<th>Kecamatan</th>
			<th>Jumlah Pendaftar</th>
			<th>Merge</th>
			<th>Aksi</th>
		</thead>

		<?=$rows_data ?>

	</table>
</div>

<div id="blok_merge">
	<div>
		<table width="100%" id="tb_merge">
			<tr>
				<td width="40%">
					<span id="nama_sekolah_1">[Belum Memilih]</span>
					 ~ 
					<span id="id_sekolah_1">?</span>
					 ~ 
					<span id="jumlah_sekolah_1">?</span>
				</td>
				<td>merge with</td>
				<td width="40%">
					<span id="nama_sekolah_2">[Belum Memilih]</span>
					 ~ 
					<span id="id_sekolah_2">?</span>
					 ~ 
					<span id="jumlah_sekolah_2">?</span>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<button class="btn btn-success" id="btn_clear">Clear</button>
		<button class="btn btn-primary" id="btn_merge" disabled="">Merge</button>
	</div>
	
</div>




<!-- <button id="btn_delete_all_sekolah" class="btn btn-danger">Delete All Sekolah Non Peserta</button> -->
















<script type="text/javascript">
	var belum_memilih = "[Belum Memilih]";
	$(document).ready(function(){
		$(".btn_delete").click(function(){

			let j = confirm("Yakin untuk menghapus data sekolah ini?"); 
			if(!j) return;
			
			let tid = $(this).prop("id");
			let rid = tid.split("__");
			let id_sekolah = rid[1];

			let lz = "ajax_adm/ajax_hapus_data_sekolah.php?id_sekolah="+id_sekolah;

			$.ajax({
				url:lz,
				success:function(h){
					if(h.trim()=="1__"){
						$("#row__"+id_sekolah).fadeOut();
					}else{
						alert(h);
					}
				}
			})

		})

		$("#btn_clear").click(function(){
			$("#nama_sekolah_1").text(belum_memilih);
			$("#nama_sekolah_2").text(belum_memilih);
			$("#id_sekolah_1").text("?");
			$("#id_sekolah_2").text("?");
			$("#jumlah_sekolah_1").text("?");
			$("#jumlah_sekolah_2").text("?");
			$("#btn_merge").prop("disabled", true);
			$(".cb").prop("disabled", false);
			$(".cb").prop("checked", false);
		})

		$(".cb").click(function(){
			$(this).prop("disabled",true);
			let tid = $(this).prop("id");
			let rid = tid.split("__");
			let id_sekolah = rid[1];

			let nama_sekolah_1 = $("#nama_sekolah_1").text();
			if(nama_sekolah_1==belum_memilih){
				$("#nama_sekolah_1").text($("#nama_sekolah__"+id_sekolah).text());
				$("#id_sekolah_1").text($("#id_sekolah__"+id_sekolah).text());
				$("#jumlah_sekolah_1").text($("#jumlah_sekolah__"+id_sekolah).text());
			}else{
				$("#nama_sekolah_2").text($("#nama_sekolah__"+id_sekolah).text());
				$("#id_sekolah_2").text($("#id_sekolah__"+id_sekolah).text());
				$("#jumlah_sekolah_2").text($("#jumlah_sekolah__"+id_sekolah).text());
				$(".cb").prop("disabled", true);
				$("#btn_merge").prop("disabled", false);
			}
		})

		$("#btn_merge").click(function(){

			let j = confirm("Yakin untuk merge 2 sekolah tsb?"); 
			if(!j) return;
			
			let id_sekolah_1 = $("#id_sekolah_1").text();
			let id_sekolah_2 = $("#id_sekolah_2").text();
			let jumlah_sekolah_1 = parseInt($("#jumlah_sekolah_1").text());
			let jumlah_sekolah_2 = parseInt($("#jumlah_sekolah_2").text());

			let lz = "ajax_adm/ajax_merge_data_sekolah.php"
			+"?id_sekolah_1="+id_sekolah_1
			+"&id_sekolah_2="+id_sekolah_2
			;

			$.ajax({
				url:lz,
				success:function(h){
					if(h.trim()=="1__"){
						// $("#row__"+id_sekolah_1).fadeOut();
						$("#jumlah_sekolah__"+id_sekolah_1).text((jumlah_sekolah_1+jumlah_sekolah_2));
						$("#row__"+id_sekolah_2).fadeOut();
						$("#btn_clear").click();
					}else{
						alert(h);
					}
				}
			})

		})
	})
</script>