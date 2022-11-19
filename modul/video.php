<?php include "count_pmb_2022.php"; ?>

<section id='video' class="video">
  <div class="container" data-aos="fade-up">

    <hr>
    <h4>Video Profil STMIK IKMI Cirebon</h4>
    <hr>

    <div id="blok_video"></div>
    <hr>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function(){

    $("#blok_video").html(
      "<iframe style='width:100%!important;height:auto!important;min-height: 400px;' src='https://www.youtube.com/embed/gOP8BYlhMAs' title='Profil STMIK IKMI' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"
      );

  })
</script>


<?php include "gallery.php"; ?>
