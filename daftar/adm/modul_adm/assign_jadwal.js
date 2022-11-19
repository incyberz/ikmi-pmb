$(document).ready(function(){

  var id_jadwal_tes = $("#id_jadwal_tes").val();

  $(".btn_add").click(function(){
    let tid = $(this).prop("id");
    let rid = tid.split("__");
    let id_daftar = rid[1];

    let link_ajax = "ajax_adm/ajax_assign_jadwal.php"
    +"?id_daftar="+id_daftar
    +"&id_jadwal_tes="+id_jadwal_tes
    +"";

    $.ajax({
      url:link_ajax,
      success:function(a){
        if(a.trim()=="1__"){
          //row hide
          // alert("OK");
          $("#rows_calon_peserta_tes__"+id_daftar).fadeOut();
        }else{
          alert(a);
        }
      }
    })
  })

  $(".btn_drop").click(function(){
    var tid = $(this).prop("id");
    var rid = tid.split("__");
    var id_daftar = rid[1];
    var link_ajax = "ajax_adm/ajax_drop_peserta_jadwal.php?id_daftar="+id_daftar+"&id_jadwal_tes="+id_jadwal_tes+"";

    $.ajax({
      url:link_ajax,
      success:function(a){
        if(a.trim()=="1__"){
          //row hide
          // alert("OK");
          $("#rows_peserta_this_tes__"+id_daftar).fadeOut();
        }else{
          alert(a);
        }
      }
    })
  })

})