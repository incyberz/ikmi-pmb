<?php
if (!isset($online_version)) die("Error #gconfig Online version can't Access Directly.");

require_once 'vendors/google/autoload.php';

$google_client = new Google_Client();

if ($online_version) {
	$google_client->setClientId('521817106432-c01li2ptjrg78r25ugltjas4ip3h7u5c.apps.googleusercontent.com');
	$google_client->setClientSecret('HYgKpNamUIcvKtp6mQflnm1O');
	$google_client->setRedirectUri('https://pmb.ikmi.ac.id/index.php?p=daftar3');
	$google_client->setAccessType("offline");
	
}else{
	$google_client->setClientId('555052709247-vum374s14lhb8aac3c8s1t69kedjvs1j.apps.googleusercontent.com');
	$google_client->setClientSecret('uJZF05DohPLsg9RDdKHXCGSB');
	$google_client->setRedirectUri('http://localhost/ikmi/pmb2/index.php?p=daftar3');

}

$google_client->addScope('email');
$google_client->addScope('profile');

if (!isset($_SESSION)) {session_start();}

?>