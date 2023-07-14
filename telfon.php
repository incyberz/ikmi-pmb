<?php 
session_start(); 
$dm = 0;

$petugas = "--All--";
if(isset($_GET['petugas'])) $petugas = $_GET['petugas'];

$is_login = 0; 
$is_terdaftar=0;

$email= '';
$nama_calon= '';
$link_panduan = "assets/files/panduan_upload_persyaratan_pmb_ikmi_2021.pdf";
$link_login = "<a href='?p=login_email' class='btn btn-primary'>Login Pendaftaran PMB</a>";

function tampil_error($a){return "<br><br><div class='alert alert-danger'>$a</div>";}

include "config.php";
// include "assets/include/fungsi.php";





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
  <div class="container">


    <h1>List Kirim Surat PDF - KIP Kuliah</h1>
    <form>
      <select name="petugas">
        <option selected="" value="--All--">--All-Soldiers--</option>
        <option>Ade Irma Purnama Sari, M.Kom</option>
        <option>Agus Bahtiar, M.Kom</option>
        <option>Anamdari</option>
        <option>Arif Rinaldi Dikananda, M.Kom</option>
        <option>Bani Nurhakim</option>
        <option>Fadhil Muhamad Basysyar, M.Kom</option>
        <option>Gifthera Dwilestari, M.Kom</option>
        <option>Iin Sholihin, M.Kom</option>
        <option>Irfan Ali, M.Kom</option>
        <option>Nana Suarna, M.Kom</option>
        <option>Odi Nurdiawan, M.Kom</option>
        <option>Saeful Anwar, M.Pd</option>
        <option>Yudhistira Arie Wijaya, M.Kom</option>
      </select>
      <!-- <input type="text" id="petugas_hidden" value="<?=$petugas?>"> -->

      <button type="submit" class="btn btn-primary btn-sm" style="margin: 5px">Filter</button>
      <span><b>Petugas: <span style="color:red"><?=$petugas?></span></b></span>
    </form>
    <style type="text/css"> th{background-color: #efe}</style>
    <table class="table-bordered" width="100%">
      <thead>
        <th>No</th><th>Nama</th><th>Prodi</th><th>Petugas</th><th>Kab / Kec</th><th>Alamat</th><th>WA</th><th>SendWA</th>
      </thead>

      <?php 
      $sql_petugas = " petugas='$petugas' ";
      if($petugas=="--All--") $sql_petugas = " 1 ";

      $s = "SELECT * 
      from tb_telpon 
      WHERE $sql_petugas 
      order by petugas";
      $q = mysqli_query($cn,$s)or die("zzz");
      $i=0;
      while ($d=mysqli_fetch_assoc($q)) {
        $i++;
        $nama_calon = $d['nama_calon'];
        $nik = $d['nik'];
        $petugas = $d['petugas'];

        $ss = "SELECT 

        a.no_hp,
        a.no_wa,
        a.alamat_jalan,
        b.id_prodi,
        c.singkatan_prodi,
        d.nama_kec,
        e.nama_kab,
        c.nama_prodi   
        
        from tb_calon a 
        JOIN tb_daftar b ON a.id_calon=b.id_calon 
        JOIN tb_prodi c ON b.id_prodi=c.id_prodi  
        JOIN tb_nik_kec d ON a.id_kec_nik=d.id_kec 
        JOIN tb_nik_kab e ON d.id_kab=e.id_kab 
        where a.nik='$nik' 
        ";
        $qq = mysqli_query($cn,$ss)or die("zzzxxx $ss");
        $dd = mysqli_fetch_assoc($qq);
        $no_wa = $dd['no_wa'];
        $no_hp = $dd['no_hp'];
        $singkatan_prodi = $dd['singkatan_prodi'];
        $nama_prodi = $dd['nama_prodi'];
        $nama_kec = $dd['nama_kec'];
        $nama_kab = $dd['nama_kab'];
        $alamat_jalan = $dd['alamat_jalan'];


        # =============================================
        # TRY GET NO_WA FROM NAMA
        # =============================================
        if ($no_wa=="") {
          $ss = "SELECT a.no_wa from tb_calon a 
          JOIN tb_daftar b ON a.id_calon=b.id_calon 
          JOIN tb_daftar_gel c ON b.id_gel=c.id_gel 
           where a.nama_calon like '%$nama_calon%' AND c.id_angkatan=2021";
          $qq = mysqli_query($cn,$ss)or die("zzzxxxasde $ss, ".mysqli_error($cn));
          if(mysqli_num_rows($qq)==1){
            $dd = mysqli_fetch_assoc($qq);
            $no_wa = $dd['no_wa'];

          }
        }


        $nama_calon = ucwords(strtolower($nama_calon));
        $nama_prodi = ucwords(strtolower($nama_prodi));
        $petugas = ucwords(strtolower($petugas));

        $pesan = "Assalamualaikum wr, wb. --- Perkenalkan saya $petugas dari Panitia PMB program Beasiswa KIP Kuliah STMIK IKMI Cirebon. Kami informasikan bahwa *Ananda $nama_calon telah dinyatakan LULUS dan DITERIMA pada jalur Beasiswa KIP Kuliah STMIK IKMI Cirebon Program Studi $nama_prodi TA 2021/2022*. Selanjutnya Ananda dipersilahkan untuk Daftar Ulang (Registrasi) dengan cara mengirimkan Dokumen Fisik Persyaratan (bagi yang belum melengkapi) sesuai dengan surat yang kami lampirkan. --- Adapun surat fisik pemberitahuan tersebut di atas telah kami kirimkan juga melalui ekspedisi pengiriman. --- Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih. --- Wasalamualaikum wr, wb. --- [Tim PMB IKMI, ".date("M d, Y h:i")."]
        ";
        $link_wa = "https://api.whatsapp.com/send?phone=62$no_wa&text=$pesan";
        $link_wa_hp = "https://api.whatsapp.com/send?phone=62$no_wa&text=$pesan";

        echo "
        <tr>
          <td>
            $i
          </td>
          <td>
            $nama_calon
          </td>
          <td>
            $singkatan_prodi 
          </td>
          <td>
            $petugas
          </td>
          <td>
            $nama_kab, Kec $nama_kec 
          </td>
          <td>
            $alamat_jalan 
          </td>
          <td>
            $no_wa
          </td>
          <td>
            <a href='$link_wa' class='btn btn-primary btn-sm' target='_blank' class='btn_send_wa'>Send WA</a>
          </td>


        </tr>
        ";
      }

       ?>
     
    </table>





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
  </div>

</body>

</html>


<!-- <script type="text/javascript">
  $(document).ready(function(){
    var zz = $("#petugas_hidden").val();
    $("#petugas").val(zz);
    console.log(zz);
  })
</script> -->