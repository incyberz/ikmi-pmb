<?php 
$id_daftar = isset($_GET['id_daftar'])?$_GET['id_daftar']:die("id_daftar not set.");
$btn_switch_prodi = "
<span style='color:red'>
  Belum memenuhi kriteria untuk Switching Prodi.
  <ul>
    <li>Grade Lulus harus B atau C</li>
    <li>Tanggal Lulus tidak kosong</li>
    <li>Harus sudah lulus tes</li>
  </ul>
</span>
";


if (isset($_POST['btn_switch_prodi'])){
  $id_prodi1 = $_POST['id_prodi1'];
  $id_prodi2 = $_POST['id_prodi2'];

  $s = "UPDATE tb_daftar SET id_prodi1=$id_prodi2, id_prodi2=$id_prodi1 WHERE id_daftar=$id_daftar";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));

  echo "
  <div class='alert alert-success'>
    Switching Prodi Sukses.
  </div>
  ";

}


$s = "SELECT 

a.tanggal_lulus_tes,
a.grade_lulus,
a.status_lulus,
a.id_prodi1,
a.id_prodi2,
b.nama_calon,
(SELECT nama_prodi from tb_prodi where id_prodi=a.id_prodi1) as nama_prodi1,
(SELECT nama_prodi from tb_prodi where id_prodi=a.id_prodi2) as nama_prodi2,
b.nama_calon,  
d.nama_jalur 


from tb_daftar a 
join tb_akun b on a.email=b.email 
join tb_calon c on a.email=c.email 
join tb_jalur d on a.id_jalur=d.id_jalur 

where a.id_daftar=$id_daftar 
";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$d = mysqli_fetch_assoc($q);

$tanggal_lulus_tes = $d['tanggal_lulus_tes'];
// $tanggal_lulus_tes = "";
$grade_lulus = $d['grade_lulus'];
// $grade_lulus = "A";
$status_lulus = $d['status_lulus'];
$status_lulus_show = $status_lulus ? "<span style='color:green'>Lulus</span>" : "<span style='color:red'>Tidak/Belum Lulus</span>";

$nama_calon = $d['nama_calon'];
$nama_jalur = $d['nama_jalur'];
$nama_prodi1 = $d['nama_prodi1'];
$nama_prodi2 = $d['nama_prodi2'];
$id_prodi1 = $d['id_prodi1'];
$id_prodi2 = $d['id_prodi2'];


if(($grade_lulus=="B" OR $grade_lulus=="C")  AND $tanggal_lulus_tes!="" AND $status_lulus){
  $btn_switch_prodi = "<button onclick=\"return confirm('Yakin untuk Switching? Harap konfirmasi terlebih dahulu kepada yang bersangkutan a.n $nama_calon')\" class='btn btn-danger btn-block' name='btn_switch_prodi' >Switch Prodi</button>";
}

?>

<div class="" id="switch_prodi">
  <p>Switch Prodi atas nama <?=$nama_calon ?></p>
  <ul>
    <li>Prodi Utama saat ini: <span style="color:blue; font-weight:bold"><?=$nama_prodi1 ?></span></li>
    <li>Jalur Daftar: <?=$nama_jalur ?></li>
    <li>Tanggal Lulus: <?=$tanggal_lulus_tes ?></li>
    <li>Status Kelulusan: <?=$status_lulus_show ?></li>
    <li>Grade: <?=$grade_lulus ?></li>
  </ul>

  <div style="max-width: 400px;">
    <form method="post" action="?switch_prodi&id_daftar=<?=$id_daftar?>">
      <table class="table table-bordered">
        <tr>
          <td colspan="2" align="center">
            Pilihan Prodi
          </td>
        </tr>
        <tr>
          <td width="50%">
            <i><small>Prodi 1:</small></i><br>
            <?=$nama_prodi1?>
            <input type="hidden" name="id_prodi1" value="<?=$id_prodi1?>">
          </td>
          <td>
            <i><small>Prodi 2:</small></i><br>
            <?=$nama_prodi2?>
            <input type="hidden" name="id_prodi2" value="<?=$id_prodi2?>">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <?=$btn_switch_prodi ?>
          </td>
        </tr>
      </table>
    </form>
  </div>


</div>




<script type="text/javascript" src="modul_adm/post_jadwal.js"></script>
