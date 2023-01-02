<?php
$link_reenable = urlencode("https://pmb.ikmi.ac.id/daftar/adm/index.php?verif_akun&email_calon=$email_calon&field=no_wa
");
$text_wa = "Yth. Petugas PMB STMIK IKMI Cirebon%0a%0aAkun saya terkena suspend mohon untuk diaktifkan kembali agar saya dapat melanjutkan proses pendaftaran PMB. Terimakasih.%0a%0aemail: $email_calon%0aWhatsapp: $no_wa%0a%0a$link_reenable%0a%0a[IKMI-PMB-System, ".date("F d, Y, H:i:s")."]";
$link_wa_hubungi_petugas = "https://api.whatsapp.com/send?phone=62$no_wa_petugas&text=$text_wa";


?>
<section id="dashboard" class="">
  <div class="container">
    <div class="alert alert-danger">
      Maaf, akun Anda telah di-suspend oleh Petugas. Silahkan hubungi Petugas untuk mengaktifkannya kembali.<hr><a href="<?=$link_wa_hubungi_petugas?>" class="btn btn-primary" target="_blank">Hubungi Petugas</a>
    </div>
</div>
</section>