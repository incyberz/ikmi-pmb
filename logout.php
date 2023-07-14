<?php 
if (!isset($_SESSION)) session_start();
// if (!isset($_SESSION)) session_start();
// if (!isset($dm)) die("Error #logout Can't Access Directly.");
 ?>
<section id="lupa_pas" class="about">
  <div class="container" data-aos="fade-up">

<?php 
echo "<br><br>";


if(isset($_SESSION['user_email_address']) or isset($_SESSION['email'])){
	unset($_SESSION['email']);
	unset($_SESSION['nama_calon']);

	//include('modul/login/gconfig.php');

	//Reset OAuth access token
	//$google_client->revokeToken();

	//Destroy entire session data.
	// session_unset();
	// session_destroy();

	echo '
	<div class="alert alert-success col-md-4">
	    <h5><center>Anda telah logout!</center></h5>
	    <br>
	    <br>
	    <a class="btn btn-primary btn-block" href="index.php">Next</a>
	</div>';

	// echo "Anda telah logout.";
}else{
	echo "<br><br><br><br><br><div class='alert alert-danger'>Error Logout.. Sesi login telah hilang. <hr><a href='index.php'>Go to Home</a></div>";
	if(isset($_SESSION))session_destroy();

}

?>

</div>
</section>