$(document).ready(function(){

  var id_jadwal_tes = $("#id_jadwal_tes").val();
  var tanggal_lulus_tes = $("#tanggal_lulus_tes").val();

  $(".btn_lulus").click(function(){
    // alert(tanggal_lulus_tes.trim().length);
    // if(tanggal_lulus_tes.trim().length!=10){

    //   alert("Silahkan isi dahulu Tanggal Kelulusan !\n\nFormat: YYYY-MM-DD");
    //   return;
    // }
    var tid = $(this).prop("id");
    var rid = tid.split("__");
    var id_daftar = rid[1];
    var id = rid[0];
    let status_lulus = (id=="btn_lulus") ? 1 : 0;

    let id_jalur = parseInt($("#id_jalur__"+id_daftar).val());
    // alert(id_jalur);

    var grade_lulus = "";
    var alasan_tidak_tes="";
    if(!status_lulus){
      // tanggal_lulus_tes="";
      alasan_tidak_tes = prompt("Alasan tidak ikut tes?");
      if(!alasan_tidak_tes) return;
    }else{
      grade_lulus = prompt("Grade Lulus:","A"); 
      if(!grade_lulus) return;
      grade_lulus = grade_lulus.toUpperCase().trim();

      if(!(grade_lulus=="A" || grade_lulus=="B" || grade_lulus=="C")){
        alert("Nilai Grade : A, B, atau C.");
        return;
      }
    }


    var link_ajax = "ajax_adm/ajax_set_kelulusan.php?id_daftar="+id_daftar
    +"&id_jadwal_tes="+id_jadwal_tes
    +"&status_lulus="+status_lulus
    +"&tanggal_lulus_tes="+tanggal_lulus_tes
    +"&grade_lulus="+grade_lulus
    +"&alasan_tidak_tes="+alasan_tidak_tes
    +"";

    $.ajax({
      url:link_ajax,
      success:function(a){
        if(a.trim()=="1__"){
          //row hide
          // alert("OK");
          $("#rows_peserta_ikut_tes__"+id_daftar).fadeOut();
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
    var link_ajax = "ajax_adm/ajax_drop_peserta_lulus.php?id_daftar="+id_daftar+"&id_jadwal_tes="+id_jadwal_tes+"";

    $.ajax({
      url:link_ajax,
      success:function(a){
        if(a.trim()=="1__"){
          //row hide
          // alert("OK");
          $("#rows_peserta_lulus_tes__"+id_daftar).fadeOut();
        }else{
          alert(a);
        }
      }
    })
  })

})