<h2>Perform All Rekap Update</h2>
<?php 
$max_rekap_kec_ktp = 15;
$max_rekap_kec_dom = 15;
$max_rekap_kab = 10;
$max_limit_sekolah = 15;




echo "<hr>Updating Rekap Kecamatan KTP...<hr>";
$s = "SELECT a.id_kec, a.nama_kec, b.nama_kab, 
(SELECT COUNT(1) from tb_calon WHERE id_nama_kec_ktp=a.id_kec) as jml_kec  
FROM tb_kec a 
join tb_kab b on a.id_kab=b.id_kab 
where b.nama_kab like '%cirebon%' 
ORDER BY jml_kec DESC 
LIMIT $max_rekap_kec_ktp
";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$i++;
	$id_kec = $d['id_kec'];
	$jml_kec = $d['jml_kec'];
	$nama_kec = $d['nama_kec'];
	$nama_kab = $d['nama_kab'];

	$label = strtoupper("KEC. $nama_kec $nama_kab");
	echo "#$i $label - $jml_kec<br>";

	$id_rekap_det = "kec_ktp_$i";

	$s2 = "INSERT INTO tb_rekap_det (id_rekap_det,kode_rekap,label,nilai) 
	VALUES ('$id_rekap_det','kec_ktp','$label',$jml_kec) ON DUPLICATE KEY UPDATE nilai=$jml_kec,label='$label'";
	$q2 = mysqli_query($cn,$s2) or die(mysqli_error($cn));
}











echo "<hr>Updating Rekap Kecamatan Domisili...<hr>";
$s = "SELECT a.id_kec, a.nama_kec, b.nama_kab, 
(SELECT COUNT(1) from tb_calon WHERE id_nama_kec_domisili=a.id_kec) as jml_kec  
FROM tb_kec a 
join tb_kab b on a.id_kab=b.id_kab 
where b.nama_kab like '%cirebon%' 
ORDER BY jml_kec DESC 
LIMIT $max_rekap_kec_dom
";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$i++;
	$id_kec = $d['id_kec'];
	$jml_kec = $d['jml_kec'];
	$nama_kec = $d['nama_kec'];
	$nama_kab = $d['nama_kab'];

	$label = strtoupper("KEC. $nama_kec $nama_kab");
	echo "#$i $label - $jml_kec<br>";

	$id_rekap_det = "kec_dom_$i";

	$s2 = "INSERT INTO tb_rekap_det (id_rekap_det,kode_rekap,label,nilai) 
	VALUES ('$id_rekap_det','kec_dom','$label',$jml_kec) ON DUPLICATE KEY UPDATE nilai=$jml_kec,label='$label'";
	$q2 = mysqli_query($cn,$s2) or die(mysqli_error($cn));
}












echo "<hr>Updating Rekap Kabupaten...<hr>";
$s = "SELECT d.id_kab, d.nama_kab, 

(SELECT COUNT(1) from tb_calon a 
JOIN tb_kec b ON a.id_nama_kec_ktp=b.id_kec 
JOIN tb_kab c ON b.id_kab=c.id_kab 
WHERE b.id_kab = d.id_kab) as jml_kab 

FROM tb_kab d 
ORDER BY jml_kab DESC 
LIMIT $max_rekap_kab 
";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$i++;
	$id_kab = $d['id_kab'];
	$jml_kab = $d['jml_kab'];
	$nama_kab = $d['nama_kab'];

	$label = strtoupper("$nama_kab");
	echo "#$i $label - $jml_kab<br>";

	$id_rekap_det = "kab_ktp_$i";

	$s2 = "INSERT INTO tb_rekap_det (id_rekap_det,kode_rekap,label,nilai) 
	VALUES ('$id_rekap_det','kab_ktp','$label',$jml_kab) ON DUPLICATE KEY UPDATE nilai=$jml_kab,label='$label'";
	$q2 = mysqli_query($cn,$s2) or die(mysqli_error($cn));
}











echo "<hr>Updating Rekap Kabupaten...<hr>";
$s = "SELECT e.id_prov, e.nama_prov, 

(SELECT COUNT(1) from tb_calon a 
JOIN tb_kec b ON a.id_nama_kec_ktp=b.id_kec 
JOIN tb_kab c ON b.id_kab=c.id_kab 
JOIN tb_prov d ON c.id_prov=d.id_prov 
WHERE d.id_prov = e.id_prov) as jml_prov 

FROM tb_prov e 
ORDER BY jml_prov DESC 
";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$i++;
	$id_prov = $d['id_prov'];
	$jml_prov = $d['jml_prov'];
	$nama_prov = $d['nama_prov'];

	if($jml_prov==0) break;

	$label = strtoupper("$nama_prov");
	echo "#$i $label - $jml_prov<br>";

	$id_rekap_det = "prov_ktp_$i";

	$s2 = "INSERT INTO tb_rekap_det (id_rekap_det,kode_rekap,label,nilai) 
	VALUES ('$id_rekap_det','prov','$label',$jml_prov) ON DUPLICATE KEY UPDATE nilai=$jml_prov,label='$label'";
	$q2 = mysqli_query($cn,$s2) or die(mysqli_error($cn));

}













echo "<hr>Updating Rekap Sekolah...<hr>";
$s = "SELECT a.id_sekolah, a.nama_sekolah,
(SELECT COUNT(1) FROM tb_calon b WHERE b.id_sekolah = a.id_sekolah ) as jml_sekolah 
FROM tb_sekolah a 
ORDER BY jml_sekolah DESC 
LIMIT $max_limit_sekolah
";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$i++;
	$id_sekolah = $d['id_sekolah'];
	$jml_sekolah = $d['jml_sekolah'];
	$nama_sekolah = $d['nama_sekolah'];

	$label = strtoupper("$nama_sekolah");
	echo "#$i $label - $jml_sekolah<br>";

	$id_rekap_det = "sekolah_$i";

	$s2 = "INSERT INTO tb_rekap_det (id_rekap_det,kode_rekap,label,nilai) 
	VALUES ('$id_rekap_det','sekolah','$label',$jml_sekolah) ON DUPLICATE KEY UPDATE nilai=$jml_sekolah,label='$label'";
	$q2 = mysqli_query($cn,$s2) or die(mysqli_error($cn));
}







?>