$(document).ready(function(){
  $("#nik").keyup(function(){

    var nik = $(this).val();

    if(nik.length!=16){
      $("#nik_ket").show();
      $("#nik_divide").show();
      $("#div_nik").hide();
      $("#nik_divide").text(nik.substring(0,4)+"-"+nik.substring(4,8)+"-"+nik.substring(8,12)+"-"+nik.substring(12,16));
      // $("#nama_kec").text("");
      // $("#nama_kab").text("");
      // $("#nama_prov").text("");

    }else{

      $("#nik_ket").hide();
      $("#div_nik").fadeIn();
      $("#nik_divide").hide();

      var err_nik = 0;

      var prv = nik.substring(0,2);
      var kab = nik.substring(2,4);
      var kec = nik.substring(4,6);
      var tgl = nik.substring(6,8);
      var bln = nik.substring(8,10);
      var thn = nik.substring(10,12);
      var nur = nik.substring(12,16); //no_urut
      // var akh = nik.substring(15,16); //1 digit terakhir


      // =======================================================================
      // CEK FORMAT NIK
      // =======================================================================
      if(parseInt(prv)<11) err_nik=1;
      if(parseInt(kab)==0) err_nik=1;
      if(parseInt(kec)==0) err_nik=1;
      if(parseInt(tgl)==0) err_nik=1;
      if(parseInt(bln)==0) err_nik=1;
      if(parseInt(nur)==0) err_nik=1;
      // if(parseInt(akh)==0) err_nik=1;

      if(parseInt(tgl)>71 || (parseInt(tgl)>31 && parseInt(tgl)<41)) err_nik=1;
      if(parseInt(bln)>12) err_nik=1;
      if(parseInt(thn)>10 && parseInt(thn)<60) err_nik=1;

      if(err_nik) {
        $("#nik_ket").show();
        $("#nik_ket").text("Format NIK yang Anda masukan tidak benar. Silahkan lihat pada KTP/KK Anda."); 
        // setview_input(id,0);
        return;
      }
      // =======================================================================
      // CEK FORMAT NIK
      // =======================================================================

      var gender = "Laki-laki";
      var jenis_kelamin = "L";
      var true_tgl = parseInt(tgl);
      if(parseInt(tgl)>40) {
        gender = "Perempuan"; 
        jenis_kelamin = "P"; 
        true_tgl = parseInt(tgl)-40; 
        $("#jenis_kelamin").val("P")
      }else{
        $("#jenis_kelamin").val("L")
      }


      var nama_bulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

      var tahun = "";
      if(parseInt(thn)<50) tahun = "20"+thn;
      if(parseInt(thn)>=50) tahun = "19"+thn;

      var ttl = true_tgl+" "+nama_bulan[parseInt(bln)]+" "+tahun;
      var tanggal_lahir = tahun+"-"+bln+"-"+true_tgl;

      $("#ttl_tanggal").val(true_tgl).change();
      $("#ttl_bulan").val(parseInt(bln)).change();
      $("#ttl_tahun").val(parseInt(tahun)).change();

      var today = new Date();
      var birthday = new Date(bln+"/"+true_tgl+"/"+tahun);

      var ageDifMs = Date.now() - birthday.getTime();
      var ageDate = new Date(ageDifMs); // miliseconds from epoch
      var usia = Math.abs(ageDate.getUTCFullYear() - 1970);

      $("#ket_gender").text("Anda "+gender+", ");
      $("#ket_ttl").text("TL-NIK: "+ttl+", ");
      $("#ket_usia").text("Usia "+usia+" tahun");

      var link_ajax = "ajax/get_nama_daerah_by_nik.php?nik="+nik;

      $.ajax({
        url:link_ajax,
        success:function(a){
          if(a.substring(0,3)=="1__"){
            // alert("Sukses, a: "+a);
            var z = a.split("__");
            var ra = z[1].split(";");
            var nama_kec = ra[0];
            var nama_kab = ra[1];
            var nama_prov = ra[2];
            var kode_pos = ra[3];

            $("#lokasi_kec").text(nama_kec+" - "+nama_kab+" - "+nama_prov);

            var kecamatan = "kec "+nama_kec+" "+nama_kab;
            set_href("cari_kode_pos_nama_kec_ktp",kecamatan);

            $("#tempat_lahir").val(nama_kab);
            $("#nama_kec_ktp").val(kecamatan.toUpperCase());

            $("#id_kab_tempat_lahir").val(prv+kab);
            $("#id_nama_kec_ktp").val(prv+kab+kec);

            $("#kode_pos_nama_kec_ktp").val(kode_pos);

            update_data_calon("tb_calon", "jenis_kelamin", jenis_kelamin);
            update_data_calon("tb_calon", "tanggal_lahir", tanggal_lahir);
            update_data_calon("tb_calon", "id_kab_tempat_lahir", prv+kab);
            update_data_calon("tb_calon", "id_nama_kec_ktp", prv+kab+kec);
            update_data_calon("tb_calon", "nik", nik); //zzz

          }else{
            $("#nik_ket").show();
            $("#nik_ket").text("Error on AJAX-NIK; return: "+a);
          }
        }
      })
    }
  })
})