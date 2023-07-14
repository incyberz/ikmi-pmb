<?php
session_start();
$dm = 0;

// if(1) {include "maintenance.php"; exit();}

$is_login = 0;
$is_terdaftar=0;

$email= '';
$nama_calon= '';
$link_panduan = "files/panduan-pmb-stmik-ikmi-2022.pdf";
$link_login = "<a href='?p=login_email' class='btn btn-primary'>Login Pendaftaran PMB</a>";

function tampil_error($a)
{
    return "<br><br><div class='alert alert-danger'>$a</div>";
}

include 'global_const.php';
include 'config.php';
// include "assets/include/fungsi.php";





if (isset($_SESSION['email'])) {
    $is_login=1;
    $email=$_SESSION['email'];

    if (isset($_SESSION['nama_calon'])) {
        $is_terdaftar=1;
        include "user_var.php";
        include "cek_stsyarat.php";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PMB IKMI</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/pmb.css" rel="stylesheet">
  <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
  <link href="assets/css/chosen.min.css" rel="stylesheet">

  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="assets/js/chosen.jquery.min.js"></script>
</head>

<body>






  <?php
  include "modul/popup/show_popup.php";
include "header.php";

if ($dm) {
    echo "<br><br><br><br><br><br>";
} else {
    echo "<br><br>";
}


$na = "na.php";
// $mdas = ["dashboard", "dashboard.php", "Dashboard", "tachometer"];

$cmb1  = ["daftar"          , "modul/daftar3/daftar.php"];
$cmb1b = ["daftar2isiform"  , "modul/daftar3/daftar2.php"];
$cmb1c = ["daftar3"     , "modul/daftar3/daftar3.php"];
$cmb1d = ["daftar4"     , "modul/daftar3/daftar4lengkapi.php"];
$cmb1e = ["daftar5"     , "modul/daftar3/daftar5pdd.php"];
$cmb1f = ["daftar6"     , "modul/daftar3/daftar6jur.php"];
$cmb1g = ["daftar7"     , "modul/daftar3/daftar7jalur.php"];
$cmb1h = ["daftar8"     , "modul/daftar3/daftar8upload.php"];
$cmb1i = ["daftar9"     , "modul/daftar3/daftar9status.php"];
$cmb1j = ["daftar10"    , "modul/daftar3/daftar10.php"];

$cmb2 = ["about"      , "modul/about.php"];
$cmb3 = ["prodi"      , "modul/prodi.php"];
$cmb4 = ["civitas"    , "modul/civitas.php"];
$cmb5 = ["keunggulan" , "modul/keunggulan.php"];
$cmb6 = ["alur"       , "modul/alur.php"];
$cmb7 = ["brosur_ti"  , "modul/brosur/brosur_ti.php"];
$cmb8 = ["brosur_rpl" , "modul/brosur/brosur_rpl.php"];
$cmb9 = ["brosur_si"  , "modul/brosur/brosur_si.php"];
$cmb10 = ["brosur_mi"  , "modul/brosur/brosur_mi.php"];
$cmb11 = ["brosur_ka"  , "modul/brosur/brosur_ka.php"];
$cmb12 = ["biaya"      , "modul/biaya.php"];
$cmb13 = ["lokasi"     , "modul/lokasi.php"];
$cmb14 = ["trans"      , "modul/trans.php"];
$cmb15 = ["ukm"        , "modul/ukm.php"];
$cmb16 = ["kontak"     , "modul/kontak.php"];
$cmb17 = ["logout"     , "logout.php"];
$cmb18 = ["lupa_pas"   , "lupa_pas.php"];
$cmb19 = ["login_gmail", "modul/login/index.php"];
$cmb20 = ["login_email", "modul/login/login_email.php"];
$cmb21 = ["daftar_baru", "modul/login/daftar_baru.php"];
$cmb22 = ["ubahpass"   , "modul/login/ubah_password.php"];



if (isset($_GET['p'])) {
    switch ($_GET['p']) {
        // case $mdas[0] : if(file_exists($mdas[1])) {include $mdas[1];}else{include $na;} break;

        case $cmb1[0]: if (file_exists($cmb1[1])) {
            include $cmb1[1];
        } else {
            include $na;
        } break;

        case $cmb1b[0]: if (file_exists($cmb1b[1])) {
            include $cmb1b[1];
        } else {
            include $na;
        } break;
        case $cmb1c[0]: if (file_exists($cmb1c[1])) {
            include $cmb1c[1];
        } else {
            include $na;
        } break;
        case $cmb1d[0]: if (file_exists($cmb1d[1])) {
            include $cmb1d[1];
        } else {
            include $na;
        } break;
        case $cmb1e[0]: if (file_exists($cmb1e[1])) {
            include $cmb1e[1];
        } else {
            include $na;
        } break;
        case $cmb1f[0]: if (file_exists($cmb1f[1])) {
            include $cmb1f[1];
        } else {
            include $na;
        } break;
        case $cmb1g[0]: if (file_exists($cmb1g[1])) {
            include $cmb1g[1];
        } else {
            include $na;
        } break;
        case $cmb1h[0]: if (file_exists($cmb1h[1])) {
            include $cmb1h[1];
        } else {
            include $na;
        } break;
        case $cmb1i[0]: if (file_exists($cmb1i[1])) {
            include $cmb1i[1];
        } else {
            include $na;
        } break;

        case $cmb2[0]: if (file_exists($cmb2[1])) {
            include $cmb2[1];
        } else {
            include $na;
        } break;
        case $cmb3[0]: if (file_exists($cmb3[1])) {
            include $cmb3[1];
        } else {
            include $na;
        } break;
        case $cmb4[0]: if (file_exists($cmb4[1])) {
            include $cmb4[1];
        } else {
            include $na;
        } break;
        case $cmb5[0]: if (file_exists($cmb5[1])) {
            include $cmb5[1];
        } else {
            include $na;
        } break;
        case $cmb6[0]: if (file_exists($cmb6[1])) {
            include $cmb6[1];
        } else {
            include $na;
        } break;
        case $cmb7[0]: if (file_exists($cmb7[1])) {
            include $cmb7[1];
        } else {
            include $na;
        } break;
        case $cmb8[0]: if (file_exists($cmb8[1])) {
            include $cmb8[1];
        } else {
            include $na;
        } break;
        case $cmb9[0]: if (file_exists($cmb9[1])) {
            include $cmb9[1];
        } else {
            include $na;
        } break;
        case $cmb10[0]: if (file_exists($cmb10[1])) {
            include $cmb10[1];
        } else {
            include $na;
        } break;
        case $cmb11[0]: if (file_exists($cmb11[1])) {
            include $cmb11[1];
        } else {
            include $na;
        } break;
        case $cmb12[0]: if (file_exists($cmb12[1])) {
            include $cmb12[1];
        } else {
            include $na;
        } break;
        case $cmb13[0]: if (file_exists($cmb13[1])) {
            include $cmb13[1];
        } else {
            include $na;
        } break;
        case $cmb14[0]: if (file_exists($cmb14[1])) {
            include $cmb14[1];
        } else {
            include $na;
        } break;
        case $cmb15[0]: if (file_exists($cmb15[1])) {
            include $cmb15[1];
        } else {
            include $na;
        } break;
        case $cmb16[0]: if (file_exists($cmb16[1])) {
            include $cmb16[1];
        } else {
            include $na;
        } break;
        case $cmb17[0]: if (file_exists($cmb17[1])) {
            include $cmb17[1];
        } else {
            include $na;
        } break;
        case $cmb18[0]: if (file_exists($cmb18[1])) {
            include $cmb18[1];
        } else {
            include $na;
        } break;
        case $cmb19[0]: if (file_exists($cmb19[1])) {
            include $cmb19[1];
        } else {
            include $na;
        } break;
        case $cmb20[0]: if (file_exists($cmb20[1])) {
            include $cmb20[1];
        } else {
            include $na;
        } break;
        case $cmb21[0]: if (file_exists($cmb21[1])) {
            include $cmb21[1];
        } else {
            include $na;
        } break;
        case $cmb22[0]: if (file_exists($cmb22[1])) {
            include $cmb22[1];
        } else {
            include $na;
        } break;

        default: include "na.php";
    }
} else {
    include 'welcome.php';
    // include "modul/count_pmb_2022.php";
    include "modul/video.php";
    include "modul/team.php";
    include "modul/prodi.php";
}



?>

  <?php include "footer.php";?>

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>