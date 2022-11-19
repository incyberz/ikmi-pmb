<?php 
include '../../config.php';

$rows = "<tr><td colspan=7>No Data Popup</td></tr>";


$s = "SELECT * from tb_popup order by date_created desc";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

if(mysqli_num_rows($q)>0){
  $rows = "";
  $i=0;
  while ($d = mysqli_fetch_array($q)) {
    $i++;
    $id_popup = $d['id_popup'];
    $ekstensi_file = $d['ekstensi_file'];
    $date_created = $d['date_created'];
    $judul_popup = $d['judul_popup'];
    $ket_popup = $d['ket_popup'];
    $upload_by = $d['upload_by'];
    $status_popup = $d['status_popup'];

    $path_popup = "../../assets/img/popups/$id_popup.$ekstensi_file";
    $img_popup = "<img src='$path_popup' height='100px' />";
    $link_popup = "<a href='$path_popup' target='_blank'>$img_popup</a>";

    $rows .= "
    <tr>
      <td>$i</td>
      <td class='editable' id='judul_popup__$id_popup'>$judul_popup</td>
      <td class='editable' id='date_created__$id_popup'>$date_created</td>
      <td>
        $link_popup
      </td>
      <td>
        <form method=post action='upload_popup.php' enctype='multipart/form-data'>
        <input type='hidden' name='id_popup' value='$id_popup'>
        <table>
          <tr>
            <td>
              <input type=file name='file_popup'>
            </td>
            <td>
              <button name='btn_upload'>Upload</button>
            </td>
          </tr>
        </table>
        </form>
      </td>
      <td class='editable' id='ket_popup__$id_popup'>$ket_popup</td>
      <td>$upload_by</td>
      <td class='editable' id='status_popup__$id_popup'>$status_popup</td>
      <td class='deletable' id='del__$id_popup'>Del</td>
    </tr>
    ";
  }
}

$judultb = "
<tr>
  <td class='tbheader'>No</td>
  <td class='tbheader'>Judul Popup</td>
  <td class='tbheader'>Dibuat Tanggal</td>
  <td class='tbheader'>Popup</td>
  <td class='tbheader'>Upload/Replace Gambar Popup</td>
  <td class='tbheader'>Keterangan</td>
  <td class='tbheader'>By</td>
  <td class='tbheader'>Aktif</td>
  <td class='tbheader'>Del</td>
</tr>
";
















?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Manage Popup</title>
  <script type="text/javascript" src="../../assets/js/jquery.min.js"></script>
  <style type="text/css">
    .tbheader{
      background: linear-gradient(#ccf,#88f);
    }

    #tbpop td{
      border: solid 1px #ccc; padding: 10px; margin: 0;
    }

    .deletable{
      cursor: pointer;
      background-color: #faa;
    }
    .deletable:hover{
      background: linear-gradient(#ffa,#f55);
    }
    .editable{
      cursor: pointer;
      background-color: #9d9 !important;
    }
    .editable:hover{
      background: linear-gradient(#faf,#888);
    }
  </style>
</head>
<body style="padding:15px">
  <h1>Manage Popup</h1>
  <p align="right"><button id="btn_tambah_popup">Tambah Popup</button></p>
  <table width="100%" id="tbpop">
    <?=$judultb?>
    <?=$rows?>
  </table>
  <hr>
  <div>
    <a href="../../" target="_blank">Preview Popup</a>
  </div>
  <hr>
  <small><i>Catatan: hanya 1 popup terbaru dengan status aktif yang akan ditampilkan.</i></small>


</body>
</html>


<script type="text/javascript" src="manage_popup.js"></script>