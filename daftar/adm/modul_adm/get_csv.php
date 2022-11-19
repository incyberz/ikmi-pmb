<h1>GET CSV</h1>

<?php 

$id_gelombang_filter = isset($_GET['id_gelombang_filter']) ? $_GET['id_gelombang_filter'] : die("idx id_gelombang_filter not set."); 
$id_jalur_filter = isset($_GET['id_jalur_filter']) ? $_GET['id_jalur_filter'] : die("idx id_jalur_filter not set."); 
$id_prodi_filter = isset($_GET['id_prodi_filter']) ? $_GET['id_prodi_filter'] : die("idx id_prodi_filter not set."); 
$nama_calon_filter = isset($_GET['nama_calon_filter']) ? $_GET['nama_calon_filter'] : die("idx nama_calon_filter not set."); 
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : die("idx order_by not set.");   


?>