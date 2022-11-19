<h3 style="margin-top:0; color:#88f; font-weight:bold">Arsip PMB</h3>
<?php 
$rows = '';


$btn_delete = '<img class="btn_aksi" src="../../assets/img/icons/delete.png">';
$btn_login_as = '<img class="btn_aksi" src="../../assets/img/icons/login_as.png">';

$capt =      ['no', 'is_reg',	'tahun_angkatan',	'gelombang_pendaftaran',	'pilihan_prodi_pertama',	'pilihan_prodi_kedua',	'jalur_daftar',	'shift_kelas',	'nama_calon',	'email',	'no_wa',	'tahun_lulus',	'nisn',	'prodi_asal',	'nik',	'tanggal_lahir',	'jenis_kelamin',	'status_menikah',	'agama',	'warga_negara',	'alamat_lengkap_di_ktp',	'alamat_lengkap_domisili',	'nama_ayah',	'nama_ibu',	'pekerjaan_ayah',	'pekerjaan_ibu',	'no_hp',	'no_ayah',	'no_ibu',	'no_saudara',	'is_bekerja',	'is_wirausaha',	'kode_pos_ktp',	'kode_pos_domisili',	'nama_kecamatan_sekolah_asal',	'nama_kecamatan_di_ktp',	'nama_kecamatan_domisili',	'tempat_lahir',	'dapat_info_dari',	'tanggal_daftar',	'tanggal_submit_formulir',	'tanggal_tes_pmb',	'tanggal_lulus_tes',	'tanggal_registrasi_ulang',	'folder_uploads',	'grade_lulus',	'alasan_tidak_tes',	'alasan_tidak_daftar_ulang'
];
$lebar_tabel = [20,	20,	20,	20,	20,	20,	40,	20,	110,	120,	60,	20,	40,	60,	70,	25,	20,	20,	20,	20,	220,	215,	100,	60,	20,	20,	20,	60,	20,	20,	20,	20,	20,	20,	20,	30,	20,	20,	35,	80,	80,	80,	80,	80,	20,	20,	20,	20
];
$tdsize = [];
for ($i=0; $i < count($lebar_tabel); $i++) { 
	$tdsize[$i] = "$lebar_tabel[$i]px";
}

$rows .= '<thead>';
for ($i=0; $i < count($capt) ; $i++) $rows.= "<th>$capt[$i]</th>";
$rows .= '</thead>';


// echo "<pre>";
// var_dump($lebar_tabel);
// echo "</pre>";

// echo "<pre>";
// var_dump($_GET);
// echo "</pre>";

// echo "<pre>";
// var_dump($_SERVER['REQUEST_URI']);
// echo "</pre>";

$furl = '';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
if(intval($page)<1) $page=1;

for ($i=1; $i < count($capt); $i++) { 
	if(isset($_POST['filter'][$i-1])){
		$filter[$i] = $_POST['filter'][$i-1];
		$furl .= '&filter[]='. $_POST['filter'][$i-1];
	}else{
		$filter[$i] = '';
	}
}

$sql_is_reg = " is_reg = 'YA' ";
$filter[1] = strtolower($filter[1]);
if($filter[1]=='ya'){
	$sql_is_reg = " is_reg = 'YA' ";
}elseif($filter[1]=='tidak'){
	$sql_is_reg = " is_reg is null ";
}elseif($filter[1]=='all'){
	$sql_is_reg = " 1 ";
}


$s = "SELECT * FROM tb_arsip 
WHERE $sql_is_reg  
AND tahun_angkatan LIKE '%$filter[2]%' 
AND gelombang_pendaftaran LIKE '%$filter[3]%' 
AND pilihan_prodi_pertama LIKE '%$filter[4]%' 

AND nama_calon LIKE '%$filter[8]%' 

";

// echo "<h1>$s</h1>";

$s_all = $s;

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
$jumlah_rows = mysqli_num_rows($q);
$page_nav = 'Page: ';
$total_page = 0;
if($jumlah_rows==0){
	$rows = "<tr><td colspan='9'>No Data found.</td></tr>";
	$page_nav = "Silahkan filter dengan kriteria lainnya!";
	$page=0;
}else{
	$total_page = ceil($jumlah_rows/10);
	if($total_page<$page and $total_page>0) $page = $total_page;

	$limit_dari = 0 + ($page-1)*10;
	$jumlah_limit = 10;


	// <a href="?page=1$furl">1</a> | 
	for ($i=1; $i <= $total_page; $i++) { 
		if($total_page>10 and $i>10 and $i<($total_page-2)){
			continue;
		}
		$page_nav .= "<a href='?archive&page=$i$furl'>$i</a> | ";
	}


	$s .= " LIMIT $limit_dari, $jumlah_limit";

	$q = mysqli_query($cn,$s) or die("jumlah_rows:$jumlah_rows page:$page $s<hr>".mysqli_error($cn));
	$i=0+($page-1)*10;

	$jumlah_kolom = mysqli_num_fields($q);


	while ($d=mysqli_fetch_array($q)) {
		$i++;

		$rows.="<tr id='tr__$d[0]'><td>$i</td>";

		for ($j=1; $j < $jumlah_kolom; $j++) { 
			$rows.="<td>$d[$j]</td>";
		}

		$rows.="</tr>";

	}
}


?>



<form method="post" action="?archive">
	<table class="tb_header kecil">
		<tr>
			<td>
				is_reg
			</td>
			<td>
				<select name='filter[]' class='filter' style='width:50px'>
					<option>Ya</option>
					<option>Tidak</option>
					<option value="">All</option>
				</select>
				<!-- <input name='filter[]' placeholder='YA' class='filter text-center' maxlength='5' value='YA' style='width:30px'> -->
			</td>
			<td>
				<span class="kecil">~</span>
			</td>

			<?php 
			for ($i=2; $i < 9; $i++){
				if($i != (count($capt)-1)){
					if($i==2 || $i==3 || $i==4){
						echo "
						<td>
							<input name='filter[]' placeholder='$capt[$i]' class='filter text-center' maxlength='10' value='$filter[$i]' style='width:40px'>
						</td>
						";
					}elseif($i<8){
						echo "
						<td class='hideit'>
							<input name='filter[]' placeholder='$capt[$i]' class='filter text-center' maxlength='10' value='$filter[$i]' style='width:100px'>
						</td>
						";
					}else{
						echo "
						<td>
							<input name='filter[]' placeholder='$capt[$i]' class='filter text-center' maxlength='10' value='$filter[$i]' style='width:70px'>
						</td>
						";
					}
				}else{
					echo "
					<td>&nbsp;</td>
					";
				}
			}?>

			<td>
				<button style="display:nonea">Filter</button>
			</td>

		</tr>
	</table>

	<p class="records_found" style="margin-top:10px">
		<span style="color: blue; font-size:16px; font-weight:bolda"><?=$jumlah_rows ?> records found</span> | 
		Page <?=$page ?> of <?=$total_page ?>
	</p>
	<table class="table table-hover table-striped kecil">
		<?=$rows?>
	</table>
	<div class="kecils">
		<input name="page" value="<?=$page?>" type="hidden">
		<?=$page_nav ?>
	</div>
</form>

<div class="blok_get_csv">
	<form method="post" action="csv/" target="_blank">
		<input type="hidden" name="sql_get_csv" value="<?=$s_all ?>">
		<button class="btn btn-success btn-sm hideit" name="btn_get_csv" onclick="return confirm('Ingin mendownload CSV dari data diatas?')">Get CSV</button> 
		<span class="btn btn-warning btn-sm hideit" id="btn_show_import_data">Import Data</span>
	</form>
</div>

<div class="wadah blok_import_data hideit">
	Cara import data:
	<ol>
		<li>Download dahulu <a href="csv/template_data_mhs.csv">Template Mhs</a></li>
		<li>Copy Paste dari file Excel Anda ke Template (values only), Save</li>
		<li>Klik tombol Browse, pilih file template yang sudah Anda isi</li>
		<li>Klik tombol Import</li>
	</ol>
	<div class="wadah ">
		<form method="post" action="csv/" enctype="multipart/form-data">
			<table>
				<tr>
					<td>
						<input type="file" name="file_csv" accept=".csv">
					</td>
					<td>
						<button class="btn btn-success btn-sm" name="btn_import_data">Import Data</button>
					</td>
				</tr>
			</table>

		</form>
	</div>
</div>






<div style="height:400px"></div>


<script type="text/javascript">
	$(document).ready(function(){
		$(".span_delete").click(function(){
			let tid = $(this).prop('id');
			let rid = tid.split("__");
			let id_mhs = rid[1];

			let yakin = confirm("Perhatian! Tidak ada Fitur Rollback/Undo untuk aksi ini.\n\nYakin untuk delete?");
			if(!yakin) return;

			let link_ajax = `../../ajax/ajax_global/ajax_global_delete.php?table=tb_arsip&field_acuan=id_mhs&acuan_val=${id_mhs}`;

			$.ajax({
				url:link_ajax,
				success:function(h){
					if(h.trim()=="sukses"){
						$("#tr__"+id_mhs).fadeOut();
					}else{
						alert(h);
					}
				}
			})
		})
	})
</script>  