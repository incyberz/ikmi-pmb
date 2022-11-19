function set_href(id,val){
  // var val = $("#nama_kec_ktp").val();
  val = val.replace("  "," ");
  val = val.replace(/ /g,"+");
  val = val.toLowerCase();
  val = "https://www.google.com/search?q=kode+pos+kecamatan+"+val;
  $("#"+id).prop("href",val);
  // alert(val);
}

function update_data_calon(nama_tabel, field, isi, field_acuan, isi_acuan){

  isi = isi.replace(/'/g,"`");

  var link_ajax = "ajax/update_data_calon.php?nama_tabel="+nama_tabel
  +"&field="+field
  +"&isi="+isi
  +"&field_acuan="+field_acuan
  +"&isi_acuan="+isi_acuan
  +"";
  $.ajax({
    url:link_ajax,
    success:function(a){
      a = a.trim();
      var x = a.substring(0,3);
      if(x!="1__"){
        alert(a);
      }else{
        console.log("reply: "+a);
        // console.log("update_data_calon success nama_tabel:"+nama_tabel+"; field:"+field+"; isi:"+isi);
      }
    }
  })
}


$(document).ready(function(){

  var tanggal_lahir = $("#tanggal_lahir").val();
  if(tanggal_lahir!=""){
    var d = new Date(tanggal_lahir);
    $("#ttl_tanggal").val(d.getDate()).change();
    $("#ttl_bulan").val(d.getMonth()+1).change();
    $("#ttl_tahun").val(d.getFullYear()).change();
  }

  var nama_kec_ktp = $("#nama_kec_ktp").val().toLowerCase();
  var nama_kec_domisili = $("#nama_kec_domisili").val().toLowerCase();
  if(nama_kec_ktp!="")
    $("#cari_kode_pos_nama_kec_ktp").prop("href","https://www.google.com/search?q=kode+pos+kecamatan+"
      +nama_kec_ktp.replace(/ /g,"+"));
  if(nama_kec_domisili!="")
    $("#cari_kode_pos_nama_kec_domisili").prop("href","https://www.google.com/search?q=kode+pos+kecamatan+"
      +nama_kec_domisili.replace(/ /g,"+"));
  


  (function($) {
    $.fn.inputFilter = function(inputFilter) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    };
  }(jQuery));
  //=======================================================================
  // INPUT NUMBER ONLY
  //=======================================================================
  $("#tahun_lulus").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#nik").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#nisn").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#no_hp").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#no_ayah").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#no_ibu").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#no_saudara").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#kode_pos_nama_kec_ktp").inputFilter(function(value) {return /^\d*$/.test(value); });
  $("#kode_pos_nama_kec_domisili").inputFilter(function(value) {return /^\d*$/.test(value); });


  $(".pp1").click(function(){

    var val = $(this).val();
    $(".pp2").show();
    $(".pp2").prop("disabled",false);
    $(".pp2").prop("checked",false);
    $("#pp2"+val).prop("disabled",true);

  })


  // =====================================================
  // VALIDASI FORMULIR
  // =====================================================

  // =====================================================
  // TAHUN LULUS
  // =====================================================
  $("#tahun_lulus").focusout(function(){

    var x = parseInt($(this).val());
    var d = new Date();
    var y = d.getFullYear();

    if(x<=y && x>=(y-40)){
      $("#tahun_lulus_ket").hide();

      $(".input_jalur").prop("checked",false);

      if(x<(y-2)){
        $("#input_jalur__3").prop("disabled",true);
      }else{
        $("#input_jalur__3").prop("disabled",false);
      }

    }else{
      $("#tahun_lulus").val("");
      $("#tahun_lulus_ket").show();
    }
  })



  // =====================================================
  // ASAL SEKOLAH
  // =====================================================
  $("#asal_sekolah").keyup(function(){
    var k = $(this).val();
    if(k.length < 3){
      $("#asal_sekolah_list").hide();
      return;
    }else{

      $(".jenis_sekolah_radio").prop("checked",false);
      $(".status_sekolah_radio").prop("checked",false);
      $(".jenis_sekolah_radio").prop("disabled",false);
      $(".status_sekolah_radio").prop("disabled",false);
      $("#nama_kec_sekolah").prop("disabled",false);
      $("#nama_kec_sekolah").val("");
      $("#prodi_asal").val("");

      var link_ajax = "ajax/ajax_list_sekolah_asal.php?k="+k;

      $.ajax({
        url:link_ajax,
        success:function(a){
          if(a=="0__"){
            $("#asal_sekolah_list").html("");
            $("#asal_sekolah_list").hide();
          }else{
            $("#asal_sekolah_list").show();
            $("#asal_sekolah_list").html(a);
          }
          $("#id_sekolah").val("");
        }
      })
    }
  })


  $("#tempat_lahir").keyup(function(){
    var k = $(this).val();
    if(k.length < 3){
      $("#list_tempat_lahir").hide();
      return;
    }else{
      var link_ajax = "ajax/ajax_list_kabupaten.php?k="+k;
      $("#id_kab_tempat_lahir").val("");

      $.ajax({
        url:link_ajax,
        success:function(a){

          if(a=="0__"){
            $("#list_tempat_lahir").html("");
            $("#list_tempat_lahir").hide();
          }else{
            $("#list_tempat_lahir").show();
            $("#list_tempat_lahir").html(a);
          }
        }
      })
    }
  })

  // $("#tempat_lahir").focusout(function(){
    // if($("#id_kab_tempat_lahir").val() == "") $("#tempat_lahir").val("");
    // $("#list_tempat_lahir").hide();
  // })



  // =====================================================
  // ASAL SEKOLAH
  // =====================================================
  $(".nama_kec").keyup(function(){
    var k = $(this).val();
    var id = $(this).prop("id");
    if(k.length < 3){
      $("#id_kec_list").hide();
      return;
    }else{

      var link_ajax = "ajax/ajax_list_kecamatan.php?k="+k+"&id="+id;
      // alert(link_ajax);

      $.ajax({
        url:link_ajax,
        success:function(a){
          if(a=="0__"){
            $("#list_"+id).html("");
            $("#list_"+id).hide();
          }else{
            $("#list_"+id).show();
            $("#list_"+id).html(a);
          }
          $("#id_kec_sekolah").val("");
        }
      })
    }
  })



  









  $(".ttl").change(function(){
    var ttl_tanggal = $("#ttl_tanggal").val();
    var ttl_bulan = $("#ttl_bulan").val();
    var ttl_tahun = $("#ttl_tahun").val();
    $("#tanggal_lahir").val(ttl_tahun+"-"+ttl_bulan+"-"+ttl_tanggal);
  })




  $("#cek_domi_as_ktp").click(function(){
    if($(this).prop("checked")){

      var id_nama_kec_ktp = $("#id_nama_kec_ktp").val();
      var alamat_desa_ktp = $("#alamat_desa_ktp").val();
      var kode_pos_nama_kec_ktp = $("#kode_pos_nama_kec_ktp").val();

      update_data_calon("tb_calon","id_nama_kec_domisili",id_nama_kec_ktp);
      update_data_calon("tb_calon","alamat_desa_domisili",alamat_desa_ktp);
      update_data_calon("tb_calon","kode_pos_nama_kec_domisili",kode_pos_nama_kec_ktp);

      $("#id_nama_kec_domisili").val(id_nama_kec_ktp);
      $("#alamat_desa_domisili").val(alamat_desa_ktp);
      $("#kode_pos_nama_kec_domisili").val(kode_pos_nama_kec_ktp);

      $("#nama_kec_domisili").val($("#nama_kec_ktp").val());

    }else{
      alert("Silahkan masukan alamat domisili atau alamat kost Anda!");
    }
  })

  $("#cek_no_hp_as_no_wa").click(function(){
    if($(this).prop("checked")){
      var no_wa = $("#no_wa").val();
      update_data_calon("tb_calon","no_hp",no_wa);
      $("#no_hp").val(no_wa);
    }else{
      alert("Silahkan masukan nomor handphone Anda!");
    }
  })

  $("#no_ayah").keyup(function(){ $("#cek_nowa__no_ayah").prop("checked",false);})
  $("#no_ibu").keyup(function(){ $("#cek_nowa__no_ibu").prop("checked",false);})

  $(".cek_nowa").click(function(){
    var tid = $(this).prop("id");
    var rid = tid.split("__");
    var id = rid[1];

    if($(this).prop("checked")){
      $("#"+id).val("-");
      $("#"+id).prop("required",false);
    }else{
      $("#"+id).prop("required",true);
    }
  })



  $(".sy").click(function(){
    var is_sy1 = $("#sy1").prop("checked");
    var is_sy2 = $("#sy2").prop("checked");
    var is_sy3 = $("#sy3").prop("checked");

    if(is_sy1 && is_sy2 && is_sy3){
      // zzz cek jika belum ketik dan pilih: namaKec sekolah/ktp/domisili namaKabLahir

      // var 



      $("#btn_submit_formulir").prop("disabled",false);

    }else{
      $("#btn_submit_formulir").prop("disabled",true);
    }
  })
})