

function set_show(id){
  $(".div_view").hide();
  if(id==="div_list") $("#div_list").slideDown();
  if(id==="div_selected") $("#div_selected").slideDown();

}

$(document).ready(function(){
  $(".nama_tes").click(function(){
    var val = $(this).val();
    var tid = $(this).prop("id");
    var rid = tid.split("__");
    var id_jadwal_tes = rid[1];

    $("#selected__nama_tes").text($("#nama_tes__"+id_jadwal_tes).text());
    $("#selected__id_jadwal_tes").text(id_jadwal_tes);
    $("#selected__nama_tes").text($("#nama_tes__"+id_jadwal_tes).text());
    $("#selected__nama_tes2").text($("#nama_tes__"+id_jadwal_tes).text());
    $("#selected__tanggal_tes").text($("#tanggal_tes__"+id_jadwal_tes).text());
    $("#selected__tanggal_pelaksanaan").text($("#tanggal_pelaksanaan__"+id_jadwal_tes).text());
    $("#selected__id_gelombang").text($("#id_gelombang__"+id_jadwal_tes).text());
    $("#selected__link_tes").text($("#link_tes__"+id_jadwal_tes).text());
    $("#selected__keterangan").text($("#keterangan__"+id_jadwal_tes).text());

    $("#btn_assign_peserta_tes").prop("href","?assign_jadwal&id_jadwal_tes="+id_jadwal_tes+"");
    set_show("div_selected");

  })

  $("#back_to_list").click(function(){
    set_show("div_list");
  })


  $("#btn_tambah_jadwal_tes").click(function(){
    var x = confirm("Tambah Jadwal baru?"); if(!x) return;

    var link_ajax = "ajax_adm/ajax_tambah_jadwal_tes.php";
    $.ajax({
      url:link_ajax,
      success:function(a){
        if(a.trim()=="1__"){
          location.reload()
        }else{
          alert(a)
        }
      }
    })
  })

  $(".delete_jadwal").click(function(){
    var x = confirm("Hapus Jadwal ini?"); if(!x) return;
    var tid = $(this).prop("id");
    var rid = tid.split("__");
    var id_jadwal_tes = rid[1];

    var link_ajax = "ajax_adm/ajax_hapus_jadwal_tes.php?id_jadwal_tes="+id_jadwal_tes;
    $.ajax({
      url:link_ajax,
      success:function(a){
        if(a.trim()=="1__"){
          location.reload()
        }else{
          alert(a)
        }
      }
    })
  })


  $(".editable").click(function(){
    var tid = $(this).prop("id");
    var rid = tid.split("__");
    var field = rid[0];
    var id_jadwal_tes = rid[1];
    var isi = $(this).text();

    var isi2 = prompt("New value:",isi); if(isi2.trim()=="") return;
    // var x = confirm("Yakin untuk mengubah data:\n\n"+isi+"\n\n-- menjadi --\n\n"+isi2+" ?"); if(!x) return;
    




    var link_ajax = "ajax_adm/ajax_ubah_jadwal_tes.php?id_jadwal_tes="+id_jadwal_tes+"&field="+field+"&isi="+isi2+"";
    // alert(link_ajax);
    // return;
    $.ajax({
      url:link_ajax,
      success:function(a){
        if(a.trim()=="1__"){
          location.reload()
        }else{
          alert(a)
        }
      }
    })
  })



  
})