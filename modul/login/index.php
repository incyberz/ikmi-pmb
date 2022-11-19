
<?php

include('gconfig.php');

$login_button = '';

if(isset($_GET["code"])){
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error'])) {
  $google_client->setAccessToken($token['access_token']);

  $_SESSION['access_token'] = $token['access_token'];

  $google_service = new Google_Service_Oauth2($google_client);

  $data = $google_service->userinfo->get();

  if(!empty($data['given_name'])) {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name'])) {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email'])) {
   $_SESSION['user_email_address'] = $data['email'];
  }

  // if(!empty($data['gender']))
  // {
  //  $_SESSION['user_gender'] = $data['gender'];
  // }

  if(!empty($data['picture'])) {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img class="img-fluid" width=400px src="assets/img/icons/sign_in_with_google.png" /></a>';
}

?>

<br>
<br>
<section id="lupa_pas" class="about">
  <div class="container" data-aos="fade-up">


  <div class="container">
   <br />
   <p align="center" class="note_blue">Untuk memverifikasi email, silahkan Anda login via Google !</p>
   <br />
   <div class="panel panel-default">
   <?php
   if($login_button == '')
   {

    if ($debug_mode) {
      echo "<hr>";
      echo "Access Token: ".$_SESSION['access_token'];
      echo "<hr>";
    }

    echo '
    <div class="panel-heading"><center>Selamat Datang Calon Mahasiswa Baru</center></div><div class="panel-body">
    <div class="row">
    <div class="col-md-5">
    <img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />
    <p>Status: Anda sedang login
    <br>Email yang Anda gunakan : '.$_SESSION['user_email_address'].'</p>
    <a href="?p=daftar3" class="btn btn-primary btn-block">Next</a>
    </div>
    </div>
    </div>
    ';
    
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>

</div>
</section>
