<?php
$tahap_tes = isset($_GET['tahap_tes']) ? $_GET['tahap_tes'] : 1;
echo "<input type='hidden' id='ctahap_tes' value='$tahap_tes'>";

# ===========================================
# GET PESERTA SUDAH LULUS
# ===========================================
$s = "SELECT 
a.*,
b.*,
c.*,
d.tahap_tes,

(SELECT singkatan_prodi from tb_prodi where id_prodi=b.id_prodi1) as singkatan_prodi,
(SELECT singkatan_jalur from tb_jalur where id_jalur=b.id_jalur) as singkatan_jalur

from tb_peserta_tes a 
join tb_daftar b on a.id_daftar=b.id_daftar 
join tb_akun c on b.email=c.email 
join tb_jadwal_tes d on a.id_jadwal_tes=d.id_jadwal_tes 
where b.tanggal_lulus_tes is NOT null 
and d.tahap_tes = $tahap_tes 
";

// die("<pre>$s</pre>");

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
$rows_peserta_lulus_tes = "<tr><td colspan='7' style='color:red'>Jadwal ini belum punya peserta tes.</td></tr>";
// die("mysqli_num_rows:".mysqli_num_rows($q));
$jumlah_peserta_lulus_tes = mysqli_num_rows($q);
if($jumlah_peserta_lulus_tes){
  $rows_peserta_lulus_tes = "";
  while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $id_daftar = $d['id_daftar'];
    $id_gelombang = $d['id_gelombang'];
    $nama_calon = $d['nama_calon'];
    $id_jalur = $d['id_jalur'];
    $id_prodi = $d['id_prodi1'];
    $folder_uploads = $d['folder_uploads'];

    $singkatan_prodi = $d['singkatan_prodi'];
    $singkatan_jalur = $d['singkatan_jalur'];

    $tahap_tes = $d['tahap_tes'];
    $tanggal_registrasi_ulang = $d['tanggal_registrasi_ulang'];

    if(strlen($nama_calon)>15) $nama_calon = substr($nama_calon,0,15)."...";
    $nama_calon = ucwords(strtolower($nama_calon));

    $btn_sudah_reg = "<button class='btn btn-success btn-sm btn_sudah_reg' id='btn_sudah_reg__$id_daftar'>Sudah Reg</button>";
    if($tanggal_registrasi_ulang!="") $btn_sudah_reg = "Sudah Reg<br><small>$tanggal_registrasi_ulang</small>";

    # ===========================================
    # CEK PERSYARATAN
    # ===========================================
    $file_profil_calon = "../uploads/profile_na.jpg";

    $s2 = "SELECT * from tb_verifikasi_upload a 
    join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
    where id_daftar=$id_daftar 
    and a.id_persyaratan=1";
    $q2 = mysqli_query($cn,$s2) or die("This jadwal :: Tidak dapat mengakses data upload. ".mysqli_error($cn));
    if(mysqli_num_rows($q2)){
      $d2=mysqli_fetch_assoc($q2);
      $id_verifikasi = $d2['id_verifikasi'];
      $id_persyaratan = $d2['id_persyaratan'];
      $ekstensi_file = $d2['ekstensi_file'];
      $status_upload = $d2['status_upload'];

      $file_profil_calon = "../uploads/$folder_uploads/img_profile__$id_daftar.$ekstensi_file";
    }

    $img_profil_calon = "<img src='$file_profil_calon' class='img-rounded' width='50px' style='margin: 0 10px'>";
    $nama_calon_show = "$img_profil_calon <a href='?pendaftar&id_daftar=$id_daftar'>$nama_calon</a>";

    $rows_peserta_lulus_tes .= "
    <tr id='rows_peserta_lulus_tes__$id_daftar'>
      <td>$i</td>
      <td>$id_gelombang-$singkatan_prodi-$singkatan_jalur</td>
      <td style='text-align:left'>$nama_calon_show</td>
      <td>$btn_sudah_reg</td>
    </tr>";
  }

}


















# ===========================================
# GET PESERTA YANG SUDAH REG
# ===========================================
$s = "SELECT 
a.*,
b.*,
c.*,
d.tahap_tes,
(SELECT singkatan_prodi from tb_prodi where id_prodi=b.id_prodi1) as singkatan_prodi,
(SELECT singkatan_jalur from tb_jalur where id_jalur=b.id_jalur) as singkatan_jalur

from tb_peserta_tes a 
join tb_daftar b on a.id_daftar=b.id_daftar 
join tb_akun c on b.email=c.email 
join tb_jadwal_tes d on a.id_jadwal_tes=d.id_jadwal_tes 
where b.tanggal_registrasi_ulang is not null 
and d.tahap_tes = $tahap_tes 
";

// die($s);
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
$rows_peserta_sudah_reg = "<tr><td colspan='8' style='color:red'>Belum ada peserta yang sudah registrasi ulang.</td></tr>";
$jumlah_peserta_sudah_reg = mysqli_num_rows($q);
if($jumlah_peserta_sudah_reg){
  $rows_peserta_sudah_reg = "";
  while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $id_daftar = $d['id_daftar'];
    $id_gelombang = $d['id_gelombang'];
    $nama_calon = $d['nama_calon'];
    $id_jalur = $d['id_jalur'];
    $id_prodi = $d['id_prodi1'];
    $folder_uploads = $d['folder_uploads'];
    $status_lulus = $d['status_lulus'];
    $tanggal_registrasi_ulang = $d['tanggal_registrasi_ulang'];

    $singkatan_prodi = $d['singkatan_prodi'];
    $singkatan_jalur = $d['singkatan_jalur'];
    $tahap_tes = $d['tahap_tes'];

    if(strlen($nama_calon)>15) $nama_calon = substr($nama_calon,0,15)."...";
    $nama_calon = ucwords(strtolower($nama_calon));

    $btn_drop_reg = "<button class='btn btn-danger btn-sm btn_sudah_reg' id='btn_drop_reg__$id_daftar'>Drop Reg</button>";


    # ===========================================
    # CEK PERSYARATAN
    # ===========================================
    $file_profil_calon = "../uploads/profile_na.jpg";

    $s2 = "SELECT * from tb_verifikasi_upload a 
    join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
    where id_daftar=$id_daftar 
    and a.id_persyaratan = 1    
    ";
    $q2 = mysqli_query($cn,$s2) or die("This jadwal :: Tidak dapat mengakses data upload. ".mysqli_error($cn));
    if(mysqli_num_rows($q2)){
      while ($d2=mysqli_fetch_assoc($q2)) {

        $id_verifikasi = $d2['id_verifikasi'];
        $id_persyaratan = $d2['id_persyaratan'];
        $ekstensi_file = $d2['ekstensi_file'];
        $status_upload = $d2['status_upload'];

        $file_profil_calon = "../uploads/$folder_uploads/img_profile__$id_daftar.$ekstensi_file";
      }
    }

    $img_profil_calon = "<img src='$file_profil_calon' class='img-rounded' width='50px' style='margin: 0 10px'>";
    $nama_calon_show = "$img_profil_calon <a href='?pendaftar&id_daftar=$id_daftar'>$nama_calon</a>";

    $rows_peserta_sudah_reg .= "
    <tr id='rows_peserta_sudah_reg__$id_daftar'>
      <td>$i</td>
      <td>$id_gelombang-$singkatan_prodi-$singkatan_jalur</td>
      <td style='text-align:left'>$nama_calon_show</td>
      <td>$tanggal_registrasi_ulang</td>
      <td>$btn_drop_reg</td>
    </tr>";
  }

}

?>








































<style type="text/css">
  #regisu{font-size: 20px;}
  #pj table {width: 100%;}
  #pj td,th {text-align: center;}
  #pj th {background: linear-gradient(#ffe,#cfc);}
  .btnz{font-size: 30px; }
  .tahap_tes_aktif{
    background-color: #dfd;
    border: solid 1px #ccc;
    padding: 5px 15px;
    border-radius: 10px;
  }
</style>

<span id="regisu">Registrasi Ulang</span> :: 
Tahap: 

<?php 

$s = "SELECT tahap_tes from tb_jadwal_tes order by tahap_tes";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)) {
  while ($d=mysqli_fetch_assoc($q)) {
    $tahap_tes = $d['tahap_tes'];
    echo "
    <a class='menu_tahap_tes' id='menu_tahap_tes__$tahap_tes' href='?regulang&tahap_tes=$tahap_tes'>$tahap_tes</a> |
    ";
  }
}

?>
<!-- <a class="menu_tahap_tes" id="menu_tahap_tes__1" href="?regulang&tahap_tes=1">1</a> | 
<a class="menu_tahap_tes" id="menu_tahap_tes__2" href="?regulang&tahap_tes=2">2</a> | 
<a class="menu_tahap_tes" id="menu_tahap_tes__3" href="?regulang&tahap_tes=3">3</a> | 
<a class="menu_tahap_tes" id="menu_tahap_tes__4" href="?regulang&tahap_tes=4">4</a> | 
<a class="menu_tahap_tes" id="menu_tahap_tes__5" href="?regulang&tahap_tes=5">5</a> | 
<a class="menu_tahap_tes" id="menu_tahap_tes__5" href="?regulang&tahap_tes=6">6</a> | 
<a class="menu_tahap_tes" id="menu_tahap_tes__5" href="?regulang&tahap_tes=7">7</a> | 
<a class="menu_tahap_tes" id="menu_tahap_tes__6" href="?regulang&tahap_tes=8">8</a>
 -->
<hr> 
<div class="row" id="pj">
  <div class="col-lg-6">
    <p>Pendaftar lulus Tahap <?=$tahap_tes?> : <?=$jumlah_peserta_lulus_tes?> peserta</p>
    <table>
      <thead>
        <th>No</th>
        <th>Gelombang</th>
        <th>Pendaftar Lulus Tes</th>
        <th>Set</th>
      </thead>

      <?=$rows_peserta_lulus_tes ?>

    </table>
  </div>

  <div class="col-lg-6">

    
    <p>Jumlah : <?=$jumlah_peserta_sudah_reg?> orang</p>

    <table>
      <thead>
        <th>No</th>
        <th>Gelombang</th>
        <th>Registran</th>
        <th>Tanggal Reg</th>
        <th>Aksi</th>
      </thead>

      <?=$rows_peserta_sudah_reg ?>


    </table>
  </div>
  
</div>






















<script type="text/javascript">
  $(document).ready(function(){

    var id_jadwal_tes = $("#id_jadwal_tes").val();
    var tanggal_lulus_tes = $("#tanggal_lulus_tes").val();

    $(".btn_sudah_reg").click(function(){
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var id_daftar = rid[1];
      var btn_id = rid[0];
      // alert("btn_id: "+btn_id);

      let set_reg = btn_id=="btn_sudah_reg" ? 1 : 0;
      // alert("set_reg: "+set_reg);

      let tgl_reg = "";
      if(set_reg){
        let d = new Date();
        let saat_ini = d.getFullYear()
        +"-"
        +(d.getMonth()+1)
        +"-"
        +d.getDay()
        +" "
        +d.getHours()
        +":"
        +d.getMinutes()
        ;

        let input_tgl_reg = prompt("Tanggal Registrasi Ulang: (yyyy-mm-dd hh:nn)", saat_ini);
        if(!input_tgl_reg) return;
        tgl_reg = input_tgl_reg;
      }else{
        let j = confirm("Yakin untuk DROP registran?"); if(!j) return;
      }


      var link_ajax = "ajax_adm/ajax_regulang.php?id_daftar="+id_daftar
      +"&set_reg="+set_reg
      +"&tgl_reg="+tgl_reg
      +"";
      // alert(link_ajax);

      $.ajax({
        url:link_ajax,
        success:function(a){
          if(a.trim()=="1__"){
            //row hide
            // alert("OK");
            if(set_reg){
              $("#rows_peserta_lulus_tes__"+id_daftar).fadeOut();
            }else{
              $("#rows_peserta_sudah_reg__"+id_daftar).fadeOut();
            }
          }else{
            alert(a);
          }
        }
      })
    })


    let ctahap_tes = $("#ctahap_tes").val();
    $(".menu_tahap_tes").removeClass("tahap_tes_aktif");
    $("#menu_tahap_tes__"+ctahap_tes).addClass("tahap_tes_aktif");

  })
</script>