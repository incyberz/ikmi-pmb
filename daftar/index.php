<?php
session_start();
// session_destroy(); die("Session destroyed!");
if (0) {
    session_unset();
    exit();
}
// if(!isset($_SESSION['pendaftar_email'])){
//   header("Location: ../?");
//   die("Anda belum login. Silahkan <a href='../'>login dahulu</a>.");
// }








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
$is_edit = 0;
if ($parameter=="edit") {
    $is_edit=1;
}



if ($parameter=="logout") {
    include 'logout.php';
    exit();
}



if (!isset($_SESSION['pendaftar_email'])) {
    if ($parameter=="daftar_akun") {
        include "daftar_akun.php";
    } else {
        include "login.php";
    }
    exit();


    // $_SESSION['pendaftar_email'] = "insho@gmail.com";
    // $_SESSION['pendaftar_nama'] = "Wulan Yulianti";
    // $_SESSION['pendaftar_admin_level'] = 1;
    // $_SESSION['pendaftar_id_daftar'] = 10001;
    // $_SESSION['pendaftar_id_calon'] = 10001;
    // die("Auto Login enabled. Please Refresh!");
}

# ========================================================
# GLOBAL VARIABLE FILES
# ========================================================
require_once "config.php";
// require_once "mhs_var.php";
require_once "pendaftar_var.php";


$img_ucons="<img src='assets/img/under_cons.jpg' width='150px' class='img_zoom'>";

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PMB6</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/pmb.css" rel="stylesheet">

  <script src="assets/vendor/jquery/jquery.min.js"></script>


  <!-- =======================================================
  * Template Name: iPortfolio - v3.7.0
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <?php include 'header.php'; ?>
  <?php //include 'hero.php';?>

  <main id="main">
    <?php
    if ($status_akun) {
        include $page_content;
    } else {
        include 'akun_suspended.php';
    }
?>

  </main>

  <?php include 'footer.php'; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <!-- <script src="assets/vendor/purecounter/purecounter.js"></script> -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <!-- <script src="assets/vendor/swiper/swiper-bundle.min.js"></script> -->
  <!-- <script src="assets/vendor/typed.js/typed.min.js"></script> -->
  <!-- <script src="assets/vendor/waypoints/noframework.waypoints.js"></script> -->
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>



<script type="text/javascript">
  $(document).ready(function(){
    $(".not_ready").click(function(){
      alert("Maaf, fitur ini masih dalam tahap pengembangan. Terima kasih sudah mencoba!")
    })
  })
</script>