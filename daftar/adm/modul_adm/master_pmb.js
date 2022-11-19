
$(document).ready(function(){

  var is_get_csv = 0;

  $("#btn_toggle_filter").click(function(){
    var cap = $(this).text();
    if(cap=="Filter"){
      $("#tb_filter").slideDown();
      $("#btn_toggle_filter").text("Hide");
    }else{
      $("#btn_toggle_filter").text("Filter");
      $("#tb_filter").slideUp();
    }
  })

  $(".filter_select").click(function(){
    $("#nama_calon_filter").keyup();
  });

  $("#nama_calon_filter").keyup(function(){

    var id_gelombang_filter = $("#id_gelombang_filter").val();
    var id_jalur_filter = $("#id_jalur_filter").val();
    var id_prodi_filter = $("#id_prodi_filter").val();
    var nama_calon_filter = $("#nama_calon_filter").val();
    var show_count = $("#show_count").val();
    var order_by = $("#order_by").val();
    var page_ke = $("#page_ke").val();

    var link_ajax = "ajax_adm/ajax_master_pmb.php"
    +"?id_gelombang_filter="+id_gelombang_filter
    +"&id_jalur_filter="+id_jalur_filter
    +"&id_prodi_filter="+id_prodi_filter
    +"&nama_calon_filter="+nama_calon_filter
    +"&show_count="+show_count
    +"&order_by="+order_by
    +"&page_ke="+page_ke
    +"&is_get_csv="+is_get_csv
    ;
    console.log(link_ajax);

    $.ajax({
      url:link_ajax,
      success:function(a){
        $("#rows_pendaftar").html(a);
        is_get_csv = 0;
      }
    })

  })



  $("#btn_get_csv").click(function(){
    is_get_csv = 1; 
    $("#nama_calon_filter").keyup();
  })

  $("#nama_calon_filter").keyup()
})