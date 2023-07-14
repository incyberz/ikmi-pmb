<?php

# ========================================================
# MANAGE URI
# ========================================================
$a = $_SERVER['REQUEST_URI'];
if (!strpos($a, "?")) {
    $a.="?";
}
if (!strpos($a, "&")) {
    $a.="&";
}

$b = explode("?", $a);
$c = explode("&", $b[1]);
$parameter = $c[0];
if ($parameter=="") {
    $parameter = "dashboard";
}

$page_content = "modul_adm/$parameter.php";





$li_sty['dashboard'] = '';
$li_sty['master_pmb'] = '';
$li_sty['verif_akun'] = '';
$li_sty['verif_upload'] = '';
$li_sty['post_jadwal'] = '';
$li_sty['regulang'] = '';


$li_sty[$parameter] = "style='color: yellow; font-weight:bold'";

?>

<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu">

      <li><a <?=$li_sty['dashboard']?> href='?'><i class='icon_house_alt'></i><span>Dashboard</span></a></li>
      <li><a <?=$li_sty['master_pmb']?> href='?master_pmb'><i class='icon_documents_alt'></i><span>Master PMB</span></a></li>
      <!-- <li><a <?=$li_sty['verif_akun']?> href='?verif_akun'><i class='icon_check_alt'></i><span>Verifikasi Akun</span></a></li> -->
      <!-- <li><a <?=$li_sty['verif_upload']?> href='?verif_upload'><i class='icon_check_alt'></i><span>Verifikasi Upload</span></a></li> -->
      <?php if($_SESSION['admpmb_admin_level']==2){?>
      <li><a <?=$li_sty['post_jadwal']?> href='?post_jadwal'><i class='icon_calendar'></i><span>Jadwal Tes</span></a></li>
      <li><a <?=$li_sty['regulang']?> href='?regulang'><i class='icon_refresh'></i><span>Reg Ulang</span></a></li>
      <li><a href='?manage'><i class='icon_cogs'></i><span>Manage</span></a></li>
      <?php } ?>

      <li><a href='https://pmb.ikmi.ac.id/daftar/kip_prioritas_2021.php' target="_blank"><i class='icon_documents_alt'></i><span>KIP Prioritas</span></a></li>
      <li><a href='?archive'><i class='icon_documents_alt'></i><span>Arsip PMB</span></a></li>

    </ul>
  </div>
</aside>