$(document).ready(function(){



  $("#btn_tambah_popup").click(function(){
    var x = confirm("Tambah Popup baru?"); if(!x) return;

    var link_ajax = "ajax_tambah_popup.php";
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

  $(".deletable").click(function(){
    var x = confirm("Hapus Popup ini?"); if(!x) return;
    var tid = $(this).prop("id");
    var rid = tid.split("__");
    var id_popup = rid[1];

    var link_ajax = "ajax_hapus_popup.php?id_popup="+id_popup;
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
    var id_popup = rid[1];
    var isi = $(this).text();

    var isi2 = prompt("New value:",isi); if(isi2.trim()=="") return;
    // var x = confirm("Yakin untuk mengubah data:\n\n"+isi+"\n\n-- menjadi --\n\n"+isi2+" ?"); if(!x) return;
    




    var link_ajax = "ajax_ubah_popup.php?id_popup="+id_popup+"&field="+field+"&isi="+isi2+"";
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