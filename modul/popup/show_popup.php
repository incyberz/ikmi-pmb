<?php 
$is_popup = 1;

$s = "SELECT * from tb_popup where status_popup = 1 order by date_created desc limit 1";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

if(mysqli_num_rows($q)==0){
  $is_popup = 0;
}else{
  $d = mysqli_fetch_array($q);

  $id_popup = $d['id_popup'];
  $ekstensi_file = $d['ekstensi_file'];
  $date_created = $d['date_created'];
  $judul_popup = $d['judul_popup'];
  $ket_popup = $d['ket_popup'];
  $upload_by = $d['upload_by'];

}

















if($is_popup){
?>

<style>
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; 
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }

  .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
  }

  .modal-content, #caption {  
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
  }

  @keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
  }

  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px){
    .modal-content {
      width: 100%;
    }
  }
</style>


<div id="modal_gue" class="modal">
  <img class="modal-content" id="img01"  src="assets/img/popups/<?=$id_popup?>.<?=$ekstensi_file?>">
  <!-- <div id="caption"></div> -->
  <div class="row" style="color:white;">
    <div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-6">
      <p>
        <h4><?=$judul_popup ?></h4>
        <div><?=$ket_popup ?></div>
        <hr>
      </p>
      <p style="text-align:center; margin-top: 15px;">

        <button class="btn btn-danger btn-block" id="close_popup">Close</button>
      </p>

    </div>
  </div>
</div>

<script>

  $(document).ready(function(){
    $("#modal_gue").fadeIn();

    $("#close_popup").click(function(){
      $("#modal_gue").fadeOut();      
    })
  })

</script>

<?php } ?>