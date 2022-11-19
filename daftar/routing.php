
<style type="text/css">
  #navigasi a{padding: 5px} 
  #navigasi a:hover{color: yellow; font-weight: bold}

  #navigasi {padding: 0; margin-top: 20px;} 
  #navigasi li{padding: 5px} 

</style>




<nav id="navbar" class="nav-menu navbar">
  <ul id="navigasi">
    <li><a href="?" class="navi" id="navi__dashboard" style="color: yellow; font-weight: bold"><i class="bx bxs-analyse"></i> <span>Dashboard</span></a></li>
    <li><a href="?formulir" class="navi" id="navi__formulir"><i class="bx bx-file"></i> <span>Isi Formulir <!-- [<span id="persen_isi_form">100</span>%] --></span></a></li>
    <li><a href="?upload" class="navi" id="navi__upload"><i class="bx bx-upload"></i> <span>Upload<!--  [1 of 2] --></span></a></li>
    <li><a href="?jadwal_tes" class="navi" id="navi__jadwal_tes"><i class="bx bx-calendar"></i> <span>Jadwal Tes</span></a></li>
    <li><a href="?hasil_tes" class="navi" id="navi__hasil_tes"><i class="bx bx-medal"></i> <span>Hasil Tes</span></a></li>
    <li><a href="?logout" onclick="return confirm('Yakin untuk logout?')"><i class="bx bx-exit"></i> <span>Logout</span></a></li>
    <!-- <li><a href="#" class="navi" id="navi__resign"><i class="bx bx-file-blank"></i> <span>Resign</span></a></li> -->
  </ul>
</nav>


<?php 
$page_content = "pages/$parameter.php";
if($parameter=="") $page_content = "pages/dashboard.php";
echo "<input type='hidden' id='menu_aktif' value='$parameter'>";

?>




<script type="text/javascript">
  $(document).ready(function(){

    var menu_aktif = $("#menu_aktif").val();
    $(".navi").prop("style","");
    $("#navi__"+menu_aktif).prop("style","color:yellow; font-weight:bold");


    // $.ajax({
    //   url:"pages/dashboard.php",
    //   success:function(a){
    //     $("#main").html(a)
    //   }
    // }) 


    // $(".navi").click(function(){
      // var id = $(this).prop("id");
      // var rid = id.split("__");
      // var page = rid[1];
      // var menu_aktif = $("#menu_aktif").val();
      // if(menu_aktif!="") page = menu_aktif;



      // $(".navi").prop("style","");
      // $("#"+id).prop("style","color:yellow; font-weight:bold");

      // var link_ajax = "pages/"+page+".php";
      // alert(link_ajax);

      // $.ajax({
      //   url:link_ajax,
      //   success:function(a){
      //     $("#main").html(a);
      //     $("#menu_aktif").val("");
      //   }
      // })      
    // })

  })
</script>

