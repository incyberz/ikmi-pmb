<?php


$img_help = "<img src='../assets/img/icons/help.png' width='20px'>";
$img_check = "<img src='../assets/img/icons/check.png' width='20px'>";
$img_loading = "<img src='../assets/img/icons/loading6.gif' width='20px'>";
$img_warning = "<img src='../assets/img/icons/warning.png' width='20px'>";
$img_reject = "<img src='../assets/img/icons/reject.png' width='20px'>";
$img_un = "<img src='../assets/img/icons/un.png' width='20px'>";

$img_wa = "<img src='../assets/img/icons/wa.png' width='25px'>";
$img_wa_unverified = "<img src='../assets/img/icons/wa_unverified.png' width='25px'>";
$img_wa_reject = "<img src='../assets/img/icons/wa_reject.png' width='25px'>";

$img_email = "<img src='../assets/img/icons/email.png' height='25px'>";
$img_email_unverified = "<img src='../assets/img/icons/email_unverified.png' height='25px'>";
$img_email_reject = "<img src='../assets/img/icons/email_reject.png' height='25px'>";


$s = "SELECT 
(SELECT count(email) from tb_akun where status_akun=1) as jumlah_aktif,  
(SELECT count(a.email) from tb_akun a join tb_daftar b on a.email=b.email where a.status_akun=1 and b.tanggal_submit_formulir is not null) as jumlah_submit_formulir,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.id_jalur=3 
) as jumlah_kip,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.id_jalur!=3 
) as jumlah_reg,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.id_jalur!=3 
AND b.tanggal_registrasi_ulang is not null 
) as jumlah_daftar_ulang_reg,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.id_jalur=3 
AND b.tanggal_registrasi_ulang is not null 
) as jumlah_daftar_ulang_kip,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
) as jumlah_peserta_tes,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
) as jumlah_lulus_tes, 

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_registrasi_ulang is not null 
) as jumlah_daftar_ulang,









(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur = 3 
) as jumlah_lulus_tes_kip,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur = 3 
AND b.id_prodi1 = 1 
) as jumlah_lulus_tes_kip_ti,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur = 3 
AND b.id_prodi1 = 2
) as jumlah_lulus_tes_kip_rpl,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur = 3 
AND b.id_prodi1 = 3 
) as jumlah_lulus_tes_kip_si,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur = 3 
AND b.id_prodi1 = 4 
) as jumlah_lulus_tes_kip_mi,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur = 3 
AND b.id_prodi1 = 5 
) as jumlah_lulus_tes_kip_ka,














(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur != 3 
) as jumlah_lulus_tes_reg,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur != 3 
AND b.id_prodi1 = 1 
) as jumlah_lulus_tes_reg_ti,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur != 3 
AND b.id_prodi1 = 2
) as jumlah_lulus_tes_reg_rpl,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur != 3 
AND b.id_prodi1 = 3 
) as jumlah_lulus_tes_reg_si,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur != 3 
AND b.id_prodi1 = 4 
) as jumlah_lulus_tes_reg_mi,

(SELECT count(a.email) FROM tb_akun a 
JOIN tb_daftar b on a.email=b.email 
JOIN tb_peserta_tes c on b.id_daftar=c.id_daftar 
WHERE a.status_akun=1 
AND b.tanggal_submit_formulir is not null 
AND b.tanggal_lulus_tes is not null 
AND b.status_lulus = 1 
AND b.id_jalur != 3 
AND b.id_prodi1 = 5 
) as jumlah_lulus_tes_reg_ka

















";

$q = mysqli_query($cn, $s) or die("Tidak bisa merekap data. ".mysqli_error($cn));
$d = mysqli_fetch_assoc($q);

$jumlah_aktif = $d['jumlah_aktif'];
$jumlah_submit_formulir = $d['jumlah_submit_formulir'];

$jumlah_kip = $d['jumlah_kip'];
$jumlah_reg = $d['jumlah_reg'];

$jumlah_peserta_tes = $d['jumlah_peserta_tes'];
$jumlah_lulus_tes = $d['jumlah_lulus_tes'];
$jumlah_belum_tes = $jumlah_peserta_tes - $jumlah_lulus_tes;


$jumlah_lulus_tes_kip = $d['jumlah_lulus_tes_kip'];
$jumlah_lulus_tes_kip_ti = $d['jumlah_lulus_tes_kip_ti'];
$jumlah_lulus_tes_kip_rpl = $d['jumlah_lulus_tes_kip_rpl'];
$jumlah_lulus_tes_kip_si = $d['jumlah_lulus_tes_kip_si'];
$jumlah_lulus_tes_kip_mi = $d['jumlah_lulus_tes_kip_mi'];
$jumlah_lulus_tes_kip_ka = $d['jumlah_lulus_tes_kip_ka'];


$jumlah_lulus_tes_reg = $d['jumlah_lulus_tes_reg'];
$jumlah_lulus_tes_reg_ti = $d['jumlah_lulus_tes_reg_ti'];
$jumlah_lulus_tes_reg_rpl = $d['jumlah_lulus_tes_reg_rpl'];
$jumlah_lulus_tes_reg_si = $d['jumlah_lulus_tes_reg_si'];
$jumlah_lulus_tes_reg_mi = $d['jumlah_lulus_tes_reg_mi'];
$jumlah_lulus_tes_reg_ka = $d['jumlah_lulus_tes_reg_ka'];


$jumlah_daftar_ulang = $d['jumlah_daftar_ulang'];
$jumlah_daftar_ulang_kip = $d['jumlah_daftar_ulang_kip'];
$jumlah_daftar_ulang_reg = $d['jumlah_daftar_ulang_reg'];
$jumlah_belum_daftar_ulang = $jumlah_lulus_tes - $jumlah_daftar_ulang;


























$hari_tgl = "$nama_hari[$weekday], $tanggal_skg $jam_skg WIB";

$sisa_hari_gelombang = durasi_hari(date("Y-m-d"), $tanggal_akhir_gel);
$sisa_hari_gelombang_sty = "purple";
if ($sisa_hari_gelombang>7) {
    $sisa_hari_gelombang_sty = "blue";
}
if ($sisa_hari_gelombang<1) {
    $sisa_hari_gelombang_sty = "red";
}
$sisa_hari_gelombang_show = "<span class='badge' style='margin: 5px; background-color:$sisa_hari_gelombang_sty'>$sisa_hari_gelombang hari lagi</span>";

if ($sisa_hari_gelombang<=0) {
    # ============================================
    # AUTO-UBAH GELOMBANG DAFTAR
    # ============================================
    // die($id_angkatan);
    $s = "UPDATE tb_gelombang SET status_gel=0 WHERE 1";
    $q = mysqli_query($cn, $s) or die("Set unaktif id_gelombang: $id_gelombang. ".mysqli_error($cn));

    $id_gelombang_tmp = $id_gelombang;
    $id_gelombang++;

    $nid_gelombang = $id_gelombang;
    $nnama_gel = "'Gelombang $id_gelombang'";
    $ntanggal_awal_gel = "'".date("Y-m-d")."'";
    $ntanggal_akhir_gel = "'".date("Y")."-".(date("m")+2)."-".date("d")."'";

    $s = "INSERT INTO tb_gelombang 
  (id_gelombang, id_angkatan, nama_gel, tanggal_awal_gel, tanggal_akhir_gel, status_gel) VALUES 
  ($nid_gelombang, $id_angkatan, $nnama_gel, $ntanggal_awal_gel, $ntanggal_akhir_gel, 1) 
  ON DUPLICATE KEY UPDATE status_gel=1";

    // die($s);


    // $s = "UPDATE tb_gelombang SET status_gel=1 WHERE id_gelombang=$id_gelombang";
    $q = mysqli_query($cn, $s) or die("Set aktif new id_gelombang: $id_gelombang. ".mysqli_error($cn));

    echo "
  <p style='color:red'>Gelombang Pendaftaran $id_gelombang_tmp telah habis.</p>
  <hr>
  <h4>Perform Auto Switch Gelombang Pendaftaran</h4>
  <hr>
  Execute Query: 
  <pre>$s</pre>
  <hr>
  <b style='color:green'>Auto Switch Gelombang Success. Gelombang aktif saat ini: $id_gelombang</b><hr>Silahkan Refresh atau Manage Gelombang PMB
  <hr>
  <a href='#' class='btn btn-success btn-sm' onclick=\"location.reload()\">Refresh</a> 
  <a href='?manage_gelombang' class='btn btn-primary btn-sm'>Manage Gelombang PMB</a>
  ";
    exit();
}

// echo "<pre>";
// echo var_dump($_SESSION);
// echo "</pre>";

$zzz = "<small><i>[var]</i></small>";

// $s = "SELECT 1 from kip_prio where status=1";
// $q = mysqli_query($cn,$s) or die("Tidak bisa menghitung KIP Prio. ".mysqli_error($cn));
// $jumlah_kip_prio = mysqli_num_rows($q);
$jumlah_kip_prio = 0;

$jumlah_submit_formulir_plus_kip_prio = $jumlah_submit_formulir + $jumlah_kip_prio;

$jumlah_lulus_tes_kip_plus_kip_prio = $jumlah_lulus_tes_kip+$jumlah_kip_prio;


$jumlah_total_pendaftar = ($jumlah_kip+$jumlah_reg+$jumlah_kip_prio);
$jumlah_total_peserta = ($jumlah_peserta_tes+$jumlah_kip_prio);
$jumlah_total_lulus_tes = ($jumlah_lulus_tes+$jumlah_kip_prio);
$jumlah_total_registran = ($jumlah_daftar_ulang+$jumlah_kip_prio);

# ==========================================
# AUTO-SAVE REKAP
# ==========================================
$rid_rekap_det = ["'total_pmb_1'","'total_pmb_2'","'total_pmb_3'","'total_pmb_4'"];
$rlabel = ["'Total Pendaftar'","'Total Peserta Tes'","'Total Lulus Tes'","'Total Registran'"];
$rnilai = [$jumlah_total_pendaftar,$jumlah_total_peserta,$jumlah_total_lulus_tes,$jumlah_total_registran];

for ($i=0; $i < count($rid_rekap_det); $i++) {
    $s = "INSERT INTO tb_rekap_det 
  (id_rekap_det,kode_rekap,label,nilai) VALUES 
  ($rid_rekap_det[$i],'total_pmb',$rlabel[$i],$rnilai[$i])
  ON DUPLICATE KEY UPDATE nilai = $rnilai[$i]
  ";
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
}


$s = "SELECT singkatan_prodi from tb_prodi order by id_prodi";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

$i=0;
$rsingkatan_prodi = [];
while ($d=mysqli_fetch_assoc($q)) {
    $rsingkatan_prodi[$i+1] = $d['singkatan_prodi'];
}















































?>


<style type="text/css">
.pointList{text-align: center; background: linear-gradient(#dfd,#afa);}
.kabid, .kabid td{background-color: #fbb;}
.cell_total{background-color: #ffd;}

#blok_step{
  /*background-color: #afa;*/
  /*background-image: url('img/alur_pmb.png');*/
}

#blok_steps{
  width: 100%;
  display: grid;
  grid-template-columns: 25% 25% 25% 25%;
}

#blok_steps div{
  /*border: solid 1px red;*/
  text-align: center;
  /*margin-bottom: 20px;*/
}

.jumlah_pmb{
  font-family: verdana;
  font-size: 25pt;
}
</style>


<div class="row">
  <div class="col-lg-6">

    <h4>Dashboard</h4>



    <div id="blok_step">
      <img src="img/alur_pmb.png" width="100%">
    </div>
    <div id="blok_steps">
      <div>Pendaftar <br><span class="jumlah_pmb"><?=$jumlah_total_pendaftar ?></span></div>
      <div>Peserta <br><span class="jumlah_pmb"><?=$jumlah_total_peserta ?></span></div>
      <div>Lulus <br><span class="jumlah_pmb"><?=$jumlah_total_lulus_tes ?></span></div>
      <div>Registran <br><span class="jumlah_pmb"><?=$jumlah_total_registran ?></span></div>
    </div>

    <style type="text/css">
      #blok_gap{
        display: grid;
        grid-template-columns: 12.5% 25% 25% 25% auto;
      }
      #blok_gap div{
        text-align: center;
        margin-bottom: 20px;
      }
    </style>
    <div id="blok_gap">
      <div>&nbsp;</div>
      <div class="gap" id="gap_peserta">-</div>
      <div class="gap" id="gap_lulus">-</div>
      <div class="gap" id="gap_registran">-</div>
    </div>

    <table class="table table-bordered">
      <tr>
        <td>Saat ini</td>
        <td><?=$hari_tgl?></td>
      </tr>
      <tr>
        <td>
          Gelombang aktif
        </td>
        <td>
          <?=$nama_gel ?> 
          <br>~ Awal: <?=$tanggal_awal_gel_show ?>
          <br>~ Akhir: <?=$tanggal_akhir_gel_show ?> <?=$sisa_hari_gelombang_show ?> 
          <div style="text-align:right"><a href="?manage_gelombang">Ubah Gelombang</a></div>
        </td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr><td colspan="2" class="pointList">Jumlah Pendaftar 2022 + KIP Prioritas</td></tr>
      <?php if ($admin_level==2) { ?>
        <tr class="kabid">
          <td>Jumlah Pendaftar All</td>
          <td><?=$zzz?></td>
        </tr>
        <tr class="kabid">
          <td>Jumlah Pendaftar Aktif</td>
          <td><?=$jumlah_aktif ?></td>
        </tr>
      <?php } ?>
      <tr>
        <td>Pendaftar 2022</td>
        <td><?=($jumlah_reg+$jumlah_kip) ?></td>
      </tr>
      <tr>
        <td>KIP Prioritas</td>
        <td><?=$jumlah_kip_prio ?></td>
      </tr>
      <tr>
        <td>Jumlah Pendaftar Total</td>
        <td><?=$jumlah_submit_formulir_plus_kip_prio ?> </td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr><td colspan="3" class="pointList">Jumlah Pendaftar per Jalur</td></tr>
      <tr>
        <td>KIP</td>
        <td><?=$jumlah_kip ?> </td>
        <td><?=round(100*$jumlah_kip/$jumlah_submit_formulir_plus_kip_prio, 1)."%" ?> </td>
      </tr>
      <tr>
        <td>KIP Prioritas 2021</td>
        <td><?=$jumlah_kip_prio ?> </td>
        <td><?=round(100*$jumlah_kip_prio/$jumlah_submit_formulir_plus_kip_prio, 1)."%" ?> </td>
      </tr>
      <tr>
        <td>Reguler</td>
        <td><?=$jumlah_reg ?> </td>
        <td><?=round(100*$jumlah_reg/$jumlah_submit_formulir_plus_kip_prio, 1)."%" ?> </td>
      </tr>
      <tr>
        <td class="cell_total">TOTAL PENDAFTAR</td>
        <td class="cell_total"><?=$jumlah_submit_formulir_plus_kip_prio ?> </td>
        <td class="cell_total">%</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr><td colspan="2" class="pointList">Peserta Tes</td></tr>
      <tr>
        <td>Sudah Diluluskan</td>
        <td><?=$jumlah_lulus_tes ?></td>
      </tr>
      <tr>
        <td>Belum Tes / Tidak Lulus</td>
        <td><?=$jumlah_belum_tes ?></td>
      </tr>
      <tr>
        <td class="cell_total">Peserta Tes</td>
        <td class="cell_total"><?=$jumlah_peserta_tes ?></td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr><td colspan="3" class="pointList">Yang Sudah Lulus</td></tr>
      <tr>
        <td>#</td>
        <td>KIP</td>
        <td>REG</td>
      </tr>
      <tr>
        <td>S1-TI</td>
        <td><?=$jumlah_lulus_tes_kip_ti ?> </td>
        <td><?=$jumlah_lulus_tes_reg_ti ?> </td>
      </tr>
      <tr>
        <td>S1-RPL</td>
        <td><?=$jumlah_lulus_tes_kip_rpl ?> </td>
        <td><?=$jumlah_lulus_tes_reg_rpl ?> </td>
      </tr>
      <tr>
        <td>S1-SI</td>
        <td><?=$jumlah_lulus_tes_kip_si ?> </td>
        <td><?=$jumlah_lulus_tes_reg_si ?> </td>
      </tr>
      <tr>
        <td>D3-MI</td>
        <td><?=$jumlah_lulus_tes_kip_mi ?> </td>
        <td><?=$jumlah_lulus_tes_reg_mi ?> </td>
      </tr>
      <tr>
        <td>D3-KA</td>
        <td><?=$jumlah_lulus_tes_kip_ka ?> </td>
        <td><?=$jumlah_lulus_tes_reg_ka ?> </td>
      </tr>
      <tr>
        <td>KIP Prioritas</td>
        <td><?=$jumlah_kip_prio ?> </td>
        <td>0</td>
      </tr>
      <tr>
        <td class="cell_total">TOTAL</td>
        <td class="cell_total"><?=$jumlah_lulus_tes_kip_plus_kip_prio ?> </td>
        <td class="cell_total"><?=$jumlah_lulus_tes_reg ?> </td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr><td colspan="2" class="pointList">Daftar Ulang</td></tr>
      <tr>
        <td>Sudah Daftar Ulang</td>
        <td><?=$jumlah_daftar_ulang ?></td>
      </tr>
      <tr>
        <td>Belum Daftar Ulang</td>
        <td><?=$jumlah_belum_daftar_ulang ?></td>
      </tr>
      <tr>
        <td class="cell_total">Peserta Tes Sudah Diluluskan</td>
        <td class="cell_total"><?=$jumlah_lulus_tes ?></td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr><td colspan="2" class="pointList">Daftar Ulang per Jalur</td></tr>
      <tr>
        <td>Daftar Ulang KIP</td>
        <td><?=$jumlah_daftar_ulang_kip ?> </td>
      </tr>
      <tr>
        <td>Daftar Ulang Reguler</td>
        <td><?=$jumlah_daftar_ulang_reg ?> </td>
      </tr>
      <tr>
        <td class="cell_total">Total Pendaftar Ulang</td>
        <td class="cell_total"><?=$jumlah_daftar_ulang_reg+$jumlah_daftar_ulang_kip ?> </td>
      </tr>
    </table>


    <table class="table table-bordered">
      <tr><td colspan="2" class="pointList">Daftar Ulang KIP-2022 + KIP Prioritas</td></tr>
      <tr>
        <td>Daftar Ulang KIP</td>
        <td><?=$jumlah_daftar_ulang_kip ?> </td>
      </tr>
      <tr>
        <td>Daftar KIP Prioritas</td>
        <td><?=$jumlah_kip_prio?></td>
      </tr>
      <tr>
        <td class="cell_total">Total</td>
        <td class="cell_total"><?=($jumlah_daftar_ulang_kip+$jumlah_kip_prio) ?> </td>
      </tr>
    </table>


  </div>

































  <!-- =============================================== -->
  <!-- INFOGRAFIS -->
  <!-- =============================================== -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

  <style type="text/css">
  .infograf{
    border: solid 1px #ccc;
    padding: 10px;
    margin: 15px 0;
    background-color: white;
  }
  .tb_infograf{
    margin-top: 15px;
  }
</style>

<div class="col-lg-6">
  <h4>Infografis</h4>



  <?php
  $s = "SELECT * from tb_rekap";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $kode_rekap = $d['kode_rekap'];
    $judul_rekap = $d['judul_rekap'];
    $chart_type = $d['chart_type'];
    $index_axis = $d['index_axis'];

    $row_det = "";
    $s2 = "SELECT * from tb_rekap_det WHERE kode_rekap='$kode_rekap' order by nilai desc";
    $q2 = mysqli_query($cn, $s2) or die(mysqli_error($cn));

    $labels = "";
    $nilais = "";
    $j=0;
    while ($d2=mysqli_fetch_assoc($q2)) {
        $j++;
        $id_rekap_det = $d2['id_rekap_det'];
        $label = $d2['label'];
        $nilai = $d2['nilai'];

        $labels .= "Rank $j;";
        $nilais .= "$nilai;";

        $row_det .= "
      <tr>
      <td>Rank $j</td>
      <td>$label</td>
      <td>$nilai</td>
      </tr>
      ";
    }

    echo "<input type='hidden' id='labels$i' value='$labels'>";
    echo "<input type='hidden' id='nilais$i' value='$nilais'>";



    ?>

    <div class='infograf'>
      <h4><?=$judul_rekap ?></h4>
      <canvas id='myChart<?=$i?>'></canvas>

      <table class="table table-striped table-hover tb_infograf">
        <thead>
          <th>No</th>
          <th>Label</th>
          <th>Jumlah</th>
        </thead>
        <?=$row_det ?>
      </table>
    </div>
    <script>
      // let label = [''];
      let tag_labels<?=$i?> = document.getElementById('labels'+<?=$i?>).value;
      let labels<?=$i?> = tag_labels<?=$i?>.split(";");

      let tag_nilais<?=$i?> = document.getElementById('nilais'+<?=$i?>).value;
      let nilais<?=$i?> = tag_nilais<?=$i?>.split(";");

      const ctx<?=$i?> = document.getElementById('myChart<?=$i?>').getContext('2d');
      const myChart<?=$i?> = new Chart(ctx<?=$i?>, {
        type: 'bar',
        data: {
          labels: labels<?=$i?>,
          datasets: [{
            label: '',
            data: nilais<?=$i?>,
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          indexAxis: 'y',
          scales: {
            x: {
              beginAtZero: true
            }
          }
        }
      });
    </script>


    <?php
}


?>





</div>


</div>

