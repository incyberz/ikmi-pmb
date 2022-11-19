$(document).on("click",".li_sekolah_asal",function(){
  var id = $(this).prop("id");
  var nama_sekolah = $(this).text();
  var rid = id.split("__");
  var id_sekolah = rid[1];

  var link_ajax = "ajax/get_data_sekolah.php?id_sekolah="+id_sekolah;
  console.log("onclick li_sekolah_asal link_ajax:"+link_ajax);

  $.ajax({
    url:link_ajax,
    success:function(a){
      if(a.substring(0,4)=="1 ~ "){

        console.log(a);

        var ra = a.split(" ~ ");

        var jenis_sekolah = parseInt(ra[1]);
        var status_sekolah = parseInt(ra[2]);
        var id_kec_sekolah = parseInt(ra[3]);
        var nama_kec_sekolah = ra[4];

        console.log("ra: "+nama_kec_sekolah);


        $(".jenis_sekolah_radio").prop("checked",false);
        if(jenis_sekolah){
          $("#jenis_sekolah_"+jenis_sekolah).prop("checked",true);
          $(".jenis_sekolah_radio").prop("disabled",true);
        }

        $(".status_sekolah_radio").prop("checked",false);
        if(status_sekolah){
          $("#status_sekolah_"+status_sekolah).prop("checked",true);
          $(".status_sekolah_radio").prop("disabled",true);
        }

        $("#nama_kec_sekolah").val(nama_kec_sekolah);
        $("#id_kec_sekolah").val(id_kec_sekolah);
        if(nama_kec_sekolah!="") $("#nama_kec_sekolah").prop("disabled",true);


        $("#id_sekolah").val(id_sekolah);
        $("#asal_sekolah_list").hide();
        $("#asal_sekolah").val(nama_sekolah);

        update_data_calon("tb_calon","id_sekolah",id_sekolah);

      }else{
        alert(a)
      }
    }
  })
})

$(document).on("click",".li_kab",function(){
  var id = $(this).prop("id");
  var text = $(this).text();
  var rid = id.split("__");
  var id_kab = rid[1];

  $("#id_kab_tempat_lahir").val(id_kab);
  $("#list_tempat_lahir").hide();
  $("#tempat_lahir").val(text);
  console.log("li_kab clicked")
})

$(document).on("click",".li_kec",function(){
  var tid = $(this).prop("id");
  var text = $(this).text();
  var rid = tid.split("__");
  var id_kec = rid[1];
  var id_elemen = rid[0];

  $("#id_"+id_elemen).val(id_kec);
  $("#list_"+id_elemen).hide();
  $("#"+id_elemen).val(text);

  var link_ajax = "ajax/get_kode_pos_by_id_kec.php?id_kec="+id_kec;

  $.ajax({
    url:link_ajax,
    success:function(a){
      if(a.substring(0,3)=="1__"){
        // alert("Sukses, a: "+a);
        var z = a.split("__");
        var ra = z[1].split(";");
        var kode_pos = ra[0];
        var kode_pos_prov = ra[1];

        if(kode_pos=="") kode_pos = "1XXXX";

        $("#kode_pos_"+id_elemen).val(kode_pos);
        var link = "https://www.google.com/search?q=kode+pos+kecamatan+"+text;
        link = link.replace(/ /g,"+").toLowerCase();
        $("#cari_kode_pos_"+id_elemen).prop("href",link);

      }else{
        alert(a)
      }
    }
  })
})
