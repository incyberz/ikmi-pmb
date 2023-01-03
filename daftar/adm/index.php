<?php
session_start();
// session_unset(); die("Session Unsetted! Welcome Programmer!");
$debug_mode = 0;

include "../config.php";
include "../global_var.php";
include "../../global_const.php";
include "../assets/include/fungsi.php";

echo "<input type='hidden' id='id_gelombang_aktif' value='$id_gelombang_aktif' />";


# ========================================================
# PROCESS SUBMIT LOGIN
# ========================================================
$username = "";
$password = "";
$pesan_login = "";

if (isset($_POST['btn_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $s = "SELECT id_petugas from tb_petugas where username='$username'";
    $q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data petugas #1");
    if (mysqli_num_rows($q)==1) {
        $d = mysqli_fetch_assoc($q);
        $id_petugas = $d['id_petugas'];

        $ss = "SELECT 
    nama_petugas, 
    nik_petugas, 
    jabatan_petugas,
    email_petugas,
    admin_level 
    from tb_petugas where id_petugas=$id_petugas and password='$password'";
        // die($ss);

        $qq = mysqli_query($cn, $ss) or die("Tidak bisa mengakses data petugas #2");

        if (mysqli_num_rows($qq)==1) {
            $is_login = 1;

            $dd = mysqli_fetch_assoc($qq);
            $_SESSION['admpmb_email'] = $dd['email_petugas'];
            $_SESSION['admpmb_id_petugas'] = $id_petugas;
            $_SESSION['admpmb_nama_petugas'] = $dd['nama_petugas'];
            $_SESSION['admpmb_admin_level'] = $dd['admin_level'];
            $_SESSION['admpmb_jabatan_petugas'] = $dd['jabatan_petugas'];
        } else {
            $pesan_login = "Password dan username Anda tidak cocok";
        }
    } else {
        $pesan_login = "Username dan Password Anda tidak cocok";
    }
}
if ($pesan_login!="") {
    $pesan_login="<div class='alert alert-danger'>Login gagal. $pesan_login</div>";
}



# ========================================================
# INITIALIZATION VAR
# ========================================================
$is_login = 0;
$nama_petugas = "";
$g_nama_petugas = "";
$g_email_petugas = "";
$g_gender_petugas = "";
$g_img_petugas = "";
$img_petugas = "../adm/img/petugas/admin.jpg";
// $id_angkatan = date("Y");
$id_angkatan = '2023'; //set manual
$option_gel = "";
$option_tahap = "";
$rlist_tahap = "";


include "global_var_adm.php";


# ========================================================
# DATABASE VAR
# ========================================================
// $s = "SELECT * FROM tb_gelombang  WHERE id_angkatan=$id_angkatan ORDER BY nama_gel";
// $q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data Gelombang dan Tahapan Tes");


// while ($d=mysqli_fetch_assoc($q)) {
//   $id_gelombang = $d['id_gelombang'];
//   $nama_gel = $d['nama_gel'];
//   $option_gel.= "<option value='$id_gelombang'>Gel $nama_gel</option>";

//   $ss = "SELECT * FROM tb_gelombang_tahap WHERE id_gelombang=$id_gelombang ORDER BY tanggal_tes";
//   $qq = mysqli_query($cn,$ss) or die("Tidak bisa mengakses data tahapan pada Gelombang ke-$id_gelombang");
//   while ($dd=mysqli_fetch_assoc($qq)) {
//     $id_tahap = $dd['id_tahap'];
//     $nama_tahap = $dd['nama_tahap'];
//     $tanggal_tes = $dd['tanggal_tes'];
//     $rlist_tahap.= "<li id='id_tahap__$id_tahap' class='hideit list_tahap list_tahap_gel__$id_gelombang'>Tahap $nama_tahap | $tanggal_tes | <a href='#' class='merah delete_list' id='del_id_tahap__$id_tahap'>Delete</a></li>";
//     $option_tahap.= "<option value='$id_tahap' class='option_tahap option_tahap_gel__$id_gelombang'>Gel$nama_gel - Tahap $nama_tahap [id:$id_tahap]</li>";
//   }
// }




# ========================================================
# REQUEST TO ADMIN
# ========================================================
if (!isset($_SESSION['admpmb_email'])) {
    // $_SESSION['admpmb_email'] = "isholihin87@gmail.com";
    // $_SESSION['admpmb_id_petugas'] = "1";
    // $_SESSION['admpmb_nama_petugas'] = "Iin Sholihin";
    // $_SESSION['admpmb_admin_level'] = 9;
    // $_SESSION['admpmb_jabatan_petugas'] = "Programmer";

    // die("Auto-login enabled. Login as Programmer [AdmLv:9] Welcome Iin Sholihin!");
    // zzz here

    $page_content = "login.php";
} else {
    $is_login = 1;

    $admpmb_email = $_SESSION['admpmb_email'];
    $id_petugas = $_SESSION['admpmb_id_petugas'];
    $nama_petugas = $_SESSION['admpmb_nama_petugas'];
    $admin_level = $_SESSION['admpmb_admin_level'];
    $jabatan_petugas = $_SESSION['admpmb_jabatan_petugas'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="PMB Admin STMIK IKMI Cirebon">
  <meta name="author" content="Iin Sholihin">
  <meta name="keyword" content="PMB, Dashboard, Admin, STMIK, IKMI, Cirebon, Pendaftaran, Kuliah">
  <link rel="shortcut icon" href="../assets/img/favicon.png">

  <title>PMB Admin</title>

  <!-- <script src="../assets/js/jquery.min.js"></script> -->
  <!-- <script src="../assets/js/bootstrap.min.js"></script> -->
  <!-- <script src="../pimpinan/js/mdb.js"></script> -->
  <!-- <script src="../pimpinan/js/chart.js"></script> -->

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">

  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">

  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet">
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">

  <script src="js/jquery.min.js"></script>
  <style type="text/css">
    .help{
      cursor: pointer;
      vertical-align: super;
      opacity: 0.7;
    }
    .help:hover{
      opacity: 1;
      border: solid 1px white;
    }
    .help2{
      cursor: pointer;
      border: solid 1px white;
    }
    .help2:hover{
      border: solid 2px yellow;
    }
    .deletable,.detkel{
      cursor: pointer;
      background-color: #fcc;
    }
    .deletable:hover,.detkel:hover{
      background: linear-gradient(#fcc,#faa);
    }
    .editable{
      cursor: pointer;
      background-color: #cfc;
    }
    .editable:hover{
      background: linear-gradient(#fcf,#ccc);
    }
    .wadah{
      border: solid 1px #777; border-radius: 10px; padding: 15px;
    }
    .img_wa{
      cursor: pointer;
    }
    .img_wa_disabled{
      cursor: not-allowed;
    }
  </style>
  <style type="text/css">
    td,th{
      font-size: 10pt;

    }
    td{
      padding: 5px;
      background-color: #fefefe;
    }
    th,.tdheader{
      padding: 8px;
      text-align: center;
      background-color: #cfc
    }
    .tdcenter{
      text-align: center;
    }
    .tdright{
      text-align: right;
    }
  </style>

</head>

<body>
  <!-- =================================================================== -->
  <!-- HTML BODY BEGIN -->
  <!-- =================================================================== -->
  <section id="container" class="">

    <?php if ($is_login) {
        include "header.php";
        include "sidebar.php";
    } ?>
    <?php if (!isset($parameter)) {
        $page_content = "modul_adm/login.php";
    } ?>

    <section id="main-content">
      <section class="wrapper">
        <?php if (file_exists($page_content)) {
            include $page_content;
        } else {
            include "na.php";
        }  ?>
      </section>

      <div class="text-right">
        <div class="credits" style="color: #eeeeee">
          Designed by <a href="https://bootstrapmade.com/" style="color: #eee">BootstrapMade</a>
        </div>
      </div>
    </section>
  </section>

  <!-- javascripts -->
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

  <script src="js/scripts.js"></script>
</body>
</html>





<script type="text/javascript">
  $(document).on("click",".not_ready",function(){
    return alert("Maaf, fitur ini sedang dalam tahap pengembangan. Terimakasih sudah mencoba!");
  })
</script>