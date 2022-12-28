$(document).ready(function () {
  $(".input_isian").focusout(function () {
    var id = $(this).prop("id");
    var isi = $(this).val();

    switch (id) {
      case "prodi_asal":
      case "nisn":
      case "alamat_desa_ktp":
      case "alamat_desa_domisili":
      case "nama_ayah":
      case "nama_ibu":

      case "tahun_lulus":
        update_data_calon("tb_calon", id, isi);
        break;
      case "nik":
        break;
      case "kode_pos_nama_kec_ktp":
      case "kode_pos_nama_kec_domisili":
        if (isi.trim().length == 5) update_data_calon("tb_calon", id, isi);
        break;
      case "no_hp":
      case "no_ayah":
      case "no_ibu":
      case "no_saudara":
        if (
          isi.trim().length >= 10 &&
          isi.trim().length <= 13 &&
          isi.substring(0, 2) == "08"
        ) {
          update_data_calon("tb_calon", id, isi);
        } else {
          if (isi != "")
            alert(
              "Untuk Nomor HP/WA awali dengan 08... dan antara 10 s.d 13 digit"
            );
          $("#" + id).val("");
        }
        break;
      default:
        alert("Belum terdapat handle untuk input_isian dg id:" + id);
    }
  });

  $(".input_radio").click(function () {
    var name = $(this).prop("name");
    var val = $(this).val();

    switch (name) {
      case "id_prodi1":
      case "id_prodi2":
      case "id_jalur":
        update_data_calon("tb_daftar", name, val);
        break;
      case "status_menikah":
      case "agama":
      case "warga_negara":
        update_data_calon("tb_calon", name, val);
        break;
      case "status_sekolah":
      case "jenis_sekolah":
        var id_sekolah = parseInt($("#id_sekolah").val());
        if (id_sekolah)
          update_data_calon("tb_sekolah", name, val, "id_sekolah", id_sekolah);
        break;
      default:
        alert("Belum terdapat handle untuk input_radio dengan id:" + id);
    }
  });

  $(".input_select").change(function () {
    var id = $(this).prop("id");
    var val = $(this).val();

    switch (id) {
      case "id_referal":
        update_data_calon("tb_referal", id, val);
        break;
      case "id_pekerjaan_ayah":
      case "id_pekerjaan_ibu":
        update_data_calon("tb_calon", id, val);
        break;
      default:
        alert("Belum terdapat handle untuk input_select dengan id:" + id);
    }
  });

  $(".input_checkbox").click(function () {
    var id = $(this).prop("id");
    var val = 0;
    if ($(this).prop("checked")) val = 1;

    switch (id) {
      case "is_wirausaha":
      case "is_bekerja":
        update_data_calon("tb_calon", id, val);
        break;
      default:
        alert("Belum terdapat handle untuk input_select dengan id:" + id);
    }
  });

  $(".input_select_ttl").change(function () {
    var ttl_tahun = $("#ttl_tahun").val();
    var ttl_bulan = $("#ttl_bulan").val();
    var ttl_tanggal = $("#ttl_tanggal").val();
    var tanggal_lahir = ttl_tahun + "-" + ttl_bulan + "-" + ttl_tanggal;
    var d = new Date(tanggal_lahir);

    if (Object.prototype.toString.call(d) === "[object Date]") {
      // it is a date
      if (isNaN(d.getTime())) {
        // d.valueOf() could also work
        alert("date is not valid.");
        return;
      } else {
        // date is valid
      }
    } else {
      alert("thats not a date. " + tanggal_lahir);
      return;
    }

    update_data_calon("tb_calon", "tanggal_lahir", tanggal_lahir);
  });
});
