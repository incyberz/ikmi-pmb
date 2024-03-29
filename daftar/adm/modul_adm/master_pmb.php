<?php
include 'include_adm/include_rget.php';
$get = $_GET['get'] ?? 'all_data';
$opt_get='';
foreach ($rget as $key => $val){
  $selected = $key==$get ? 'selected' : '';
  $opt_get .= "<option $selected>$val</option>";
}
?>
<style type="text/css">
  .img_aksi, .img_aksi_disabled{
    width: 20px;
  }.img_aksi{
    transition: transform 0.2s;
    cursor: pointer;
  }.img_aksi:hover{
    transform: scale(1.3);
  }.blok_filter{
    display:flex;
    flex-wrap: wrap;
    gap: 7px;
  }
</style>

<h4>Master PMB <?=$id_angkatan ?></h4>
<div class="debug" id=state>state</div>
<div class="blok_filter mb2">
  <div>
    <select class="form-control input-sm filter filter_select" id=get_data>
      <?=$opt_get?>
    </select>
  </div>

  <div>
    <input class="form-control input-sm" placeholder='keyword' id=nama_calon_filter>
  </div>

  <div>
    <select class="form-control input-sm filter filter_select" id="id_gelombang_filter">
      <option value=all>All Gel</option>
      <?php 
      $s = "SELECT id_gelombang FROM tb_gelombang WHERE id_angkatan=$tahun_pmb";
      $q = mysqli_query($cn,$s) or die(mysqli_error($cn));
      while ($d=mysqli_fetch_assoc($q)) {
        echo "<option value=$d[id_gelombang]>".str_replace($tahun_pmb,'',$d['id_gelombang']).'</option>';
      }
      ?>
    </select>
  </div>

  <div>
    <select class="form-control input-sm filter filter_select" id="id_jalur_filter">
      <option value=all>All Jalur</option>
      <option value="-3">Reg</option>
      <option value="3">KIP</option>
    </select>
  </div>

  <div>
    <select class="form-control input-sm filter filter_select" id="id_prodi_filter">
      <option value=all>All Prodi</option>
      <?php 
      for ($i=0; $i < count($rsingkatan_prodi) ; $i++) { 
        echo "<option value='$rid_prodi[$i]'>$rsingkatan_prodi[$i]</option>";
      }
      ?>
    </select>
  </div>

  <div class=hideit>
    <select class="form-control input-sm filter filter_select" id="page_ke">
      <?php for ($i=1; $i <=30 ; $i++) echo "<option value=$i>Page $i</option>";?>
    </select>
  </div>

  <div>
    <select class="form-control input-sm filter filter_select" id="show_count">
      <option value=10>Show 10</option>
      <option value=25>Show 25</option>
      <option value=50>Show 50</option>
      <option value=100>Show 100</option>
      <option value=500>Show 500</option>
      <option value=9999>Show All</option>
    </select>
  </div>

  <div>
    <select class="form-control input-sm filter filter_select" id="order_by">
      <option value="tanggal_daftar desc">Terbaru</option>
      <option value="tanggal_daftar">Terlama</option>
      <option value="nama_calon">By Nama</option>
    </select>
  </div>

  <div>
    <button class="btn btn-success btn-sm" id="btn_get_csv">Get CSV</button>
  </div>

  <div>
    <label><input type="checkbox" id="show_foto"> <small>Show Foto</small></label>
  </div>

</div>

<div id="rows_pendaftar" style=margin-top:10px></div>






















<script>
  $(function(){


    var is_get_csv = 0;

    $("#btn_toggle_filter").click(function(){
      let cap = $(this).text();
      if(cap=="Filter"){
        $("#tb_filter").slideDown();
        $("#btn_toggle_filter").text("Hide");
      }else{
        $("#btn_toggle_filter").text("Filter");
        $("#tb_filter").slideUp();
      }
    })

    $("#show_foto").click(function(){
      if($(this).prop('checked')){
        let y = confirm('Yakin untuk menampilkan gambar? \n\nFile foto membutuhkan bandwidth internet yang jauh lebih besar.');
        if(!y){
          $(this).prop('checked',false);
          return;
        }
      }
      $("#nama_calon_filter").keyup();
    });

    $(".filter_select").click(function(){
      $("#nama_calon_filter").keyup();
    });

    $("#nama_calon_filter").keyup(function(){

      let get_data = $("#get_data").val();
      let id_gelombang_filter = $("#id_gelombang_filter").val();
      let id_jalur_filter = $("#id_jalur_filter").val();
      let id_prodi_filter = $("#id_prodi_filter").val();
      let nama_calon_filter = $("#nama_calon_filter").val().trim();
      let show_count = $("#show_count").val();
      let order_by = $("#order_by").val();
      let page_ke = $("#page_ke").val();
      let show_foto = $("#show_foto").prop('checked');

      let old_state = $('#state').text();
      let new_state = `${get_data}|${id_gelombang_filter}|${id_jalur_filter}|${id_prodi_filter}|${nama_calon_filter}|${show_count}|${order_by}|${page_ke}|${show_foto}|${is_get_csv}`;

      if(old_state==new_state) return;
      $('#state').text(new_state);

      let link_ajax = "ajax_adm/ajax_master_pmb.php"
      +"?id_gelombang_filter="+id_gelombang_filter
      +"&id_jalur_filter="+id_jalur_filter
      +"&id_prodi_filter="+id_prodi_filter
      +"&nama_calon_filter="+nama_calon_filter
      +"&show_count="+show_count
      +"&order_by="+order_by
      +"&page_ke="+page_ke
      +"&is_get_csv="+is_get_csv
      +"&get_data="+get_data
      +"&show_foto="+show_foto
      ;
      console.log(link_ajax);

      $.ajax({
        url:link_ajax,
        success:function(a){
          $("#rows_pendaftar").html(a);
          is_get_csv = 0;

          new_state = `${get_data}|${id_gelombang_filter}|${id_jalur_filter}|${id_prodi_filter}|${nama_calon_filter}|${show_count}|${order_by}|${page_ke}|${show_foto}|${is_get_csv}`;
          $('#state').text(new_state);
        }
      })

    })



    $("#btn_get_csv").click(function(){
      is_get_csv = 1; 
      $("#nama_calon_filter").keyup();
    })

    $("#nama_calon_filter").keyup()


  })
</script>