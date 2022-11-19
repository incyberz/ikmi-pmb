<?php 
$isi_csv = "";
$path_csv = "csv/pmb_master__".date("Y-m-d").".csv";
if(!file_exists($path_csv)){
  $s = "SELECT * from tb_akun a 
  join tb_calon b on a.email=b.email 
  join tb_daftar c on a.email=c.email
  ";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));
  $jumlah_rows = mysqli_num_rows($q);
  if($jumlah_rows){
    $i=0;
    while ($d=mysqli_fetch_assoc($q)) {
      $i++;

      // header CSV
      if($i===1){
        foreach($d as $key=>$value) {
          $isi_csv .= ",\"$key\"";
        }
        $isi_csv .= "\n";
      }
      
      // isi CSV
      foreach($d as $value) {
        $value = strtoupper(trim($value));
        $value = str_replace('"','', $value);
        $value = $value=="" ? ",NULL" : ",\"$value\"";
        $isi_csv .= $value;
      }
      $isi_csv .= "\n";
    }

    // write to CSV
    $fcsv = fopen("$path_csv","w+") or die("$path_csv cannot accesible.");
    fwrite($fcsv, $isi_csv);
    fclose($fcsv);
  }
}
?>