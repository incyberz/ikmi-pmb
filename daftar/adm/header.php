<?php 

# ========================================================
# GET REALTIME DATA 
# ========================================================
$jumlah_notif = 0;
// $s = "SELECT 
// a.*, 
// from tb_event a  
// join tb_calon c on a.id_calon = c.id_calon 
// where a.status_event = 0";
// $q = mysqli_query($cn,$s) or die(mysqli_error($cn));
// $jumlah_notif = mysqli_num_rows($q);
 // die("id_petugas: $id_petugas<br>SQL: $s");

// $i=0;
// while ($d = mysqli_fetch_array($q)) {
//   $i++;
//   $id_event = $d['id_event'];
//   $id_calon = $d['id_calon'];
//   $tipe_event = $d['tipe_event'];
//   $nama_event = $d['nama_event'];
//   $date_event = $d['date_event'];
//   $notif[$i] = "$id_event - $nama_event - $date_event";
// }

?>

<header class="header dark-bg">
  <div class="toggle-nav">
    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
  </div>

  <a href="index.php" class="logo">PMB <span class="lite">Admin</span></a>
  <div class="top-nav notification-row">
    <ul class="nav pull-right top-menu">
      <li id="alert_notificatoin_bar" class="dropdown">
        <a data-toggle='dropdown' class='dropdown-toggle' href='#'>
          <i class='icon-bell-l'></i>
          <span class='badge bg-important'><?=$jumlah_notif?></span>
        </a>

        <ul class='dropdown-menu extended notification'>
          

          <?php 
          for ($i=1; $i <= $jumlah_notif; $i++) {
            $n = $notif[$i];
            $z = explode(" - ", $n);
            $id_event=$z[0];
            $tipe_notif=$z[1];
            $waktu_notif=$z[2];
            echo "
            <li>
              <a href='?vfsyarat&id_event_db=$id_event'>
                <span class='label label-primary'><i class='icon_profile'></i></span>
                  $tipe_notif
                <span class='small italic pull-right'>$waktu_notif</span>
              </a>
            </li>";
          }
          ?>



          <li>
            <a href='?allnotif'>See all notifications</a>
          </li>
        </ul>
      </li>





      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <span class="profile-ava">
            <img width="30px" height="30px" alt="" src="<?=$img_petugas?>">
          </span>
          <span class="username"><?=$nama_petugas?></span>
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu extended logout">
          <div class="log-arrow-up"></div>
          <li class="eborder-top">
            <a href="?profile"><i class="icon_profile"></i> My Profile</a>
          </li>
          <li>
            <a href="?logout" onclick="return confirm('Yakin untuk logout?')"><i class="icon_key_alt"></i> Log Out</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</header>

<script type="text/javascript">
  $(document).ready(function(){

    // var x = setInterval(function(){
    //   var link_ajax = "ajax/ajax_update_notif.php";

    //   $.ajax({
    //     url:link_ajax,
    //     success:function(a){
    //       $("#alert_notificatoin_bar").html(a);
    //     }
    //   });

    // },10000);
  })
</script>