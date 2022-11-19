<h1>Upload Popup Process</h1>
<div>
  <a href="manage_popup.php">Back to Manage</a> | 
  <a href="../../" target="_blank">Preview Popup</a>
</div>

<?php 
// include 'cek_login_petugas.php';

echo "<pre>";
echo var_dump($_POST);
echo var_dump($_FILES);
echo "</pre>";

$id_popup = $_POST['id_popup'];

$filename = $_FILES['file_popup']['name'];
$tmp_name = $_FILES['file_popup']['tmp_name'];
$size = $_FILES['file_popup']['size'];

$ekstensi_file = pathinfo($filename, PATHINFO_EXTENSION);

$target_path = "../../assets/img/popups/$id_popup.$ekstensi_file";

# =====================================
# UPDATE EKSTENSION OF FILE
# =====================================
include '../../config.php';
$s= "UPDATE tb_popup SET ekstensi_file = '$ekstensi_file' where id_popup=$id_popup ";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));


# =====================================
# MOVE FILE
# =====================================
if(move_uploaded_file($tmp_name,$target_path)){


  echo "<img src='$target_path' width='200px' /><hr>Upload OK | 
  <a href='manage_popup.php'>Back to Manage</a>
  ";
}else{
  echo "Upload Gagal.";
}
?>
