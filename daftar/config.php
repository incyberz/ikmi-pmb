<?php

# ============================================================
# CONFIG PHP v.3
# ============================================================
$tahun_pmb = 2023;


# ============================================================
# DATABASE CONNECTION
# ============================================================
$online_version = 1;
if ($_SERVER['SERVER_NAME'] == "localhost") {
    $online_version = 0;
}

if ($online_version) {
    $db_server = "localhost";
    $db_user = "pmbikmiac_admikmi";
    $db_pass = "e%]Uzmix[A;m";
    $db_name = "pmbikmiac_pmb";
    // include 'insho_styles.php';
    
} else {
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = '';
    $db_name = "db_pmb62";
    // include '../../../insho_styles.php';
}

Global $cn;
$cn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($cn -> connect_errno) {
    echo "Error Konfigurasi# Tidak dapat terhubung ke MySQL Server :: $db_name";
    exit();
}


# ============================================================
# TIMEZONES
# ============================================================
date_default_timezone_set("Asia/Jakarta");
$tanggal_skg = date("Y-m-d");
$tanggaljam_skg = date("Y-m-d H:i:sa");
$jam_skg = date("H:i:sa");
$tahun_skg = date("Y");
$thn_skg = date("y");
$waktu = "Pagi";
if (date("H")>=9) {
    $waktu = "Siang";
}
if (date("H")>=15) {
    $waktu = "Sore";
}
if (date("H")>=18) {
    $waktu = "Malam";
}


# ============================================================
# SELECT ANGKATAN AKTIF
# ============================================================
$s = "SELECT id_angkatan from tb_angkatan WHERE status_angkatan=1";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)==1) {
    $d = mysqli_fetch_assoc($q);
    $id_angkatan = $d['id_angkatan'];
} else {
    die("Data Angkatan Error. Minimal satu angkatan yang aktif");
}

# ============================================================
# SELECT GELOMBANG AKTIF
# ============================================================
$s = "SELECT id_gelombang from tb_gelombang WHERE status_gel=1";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)==1) {
    $d = mysqli_fetch_assoc($q);
    $id_gelombang_aktif = $d['id_gelombang'];
} elseif (mysqli_num_rows($q)>1) {
    die("Terdapat 2 Gelombang Pendaftaran yang aktif. Silahkan hubungi Programmer!");
} else { // all inaktif
    $s2 = "SELECT id_gelombang FROM tb_gelombang WHERE tanggal_awal_gel > '".date("Y-m-d")."' LIMIT 1";
    $q2 = mysqli_query($cn, $s2) or die(mysqli_error($cn));

    if (mysqli_num_rows($q2)==1) {
        $d2 = mysqli_fetch_assoc($q2);
        $id_gelombang = $d2['id_gelombang'];
        $s3 = "UPDATE tb_gelombang SET status_gel=1 WHERE id_gelombang=$id_gelombang";
        $q3 = mysqli_query($cn, $s3) or die("Set aktif id_gelombang: $id_gelombang. ".mysqli_error($cn));
    } else { // tidak ada gel yg cocok dg tgl saat ini
        $nid_angkatan = date("Y");
        $nid_gelombang = $nid_angkatan."1";
        $nnama_gel = "'Gelombang $nid_angkatan'";
        $ntanggal_awal_gel = "'".date("Y-m-d")."'";
        $ntanggal_akhir_gel = "'".date("Y")."-".(date("m")+2)."-".date("d")."'";

        //looping for $nid_angkatan yg baru

        $s3 = "INSERT INTO tb_gelombang 
    (id_gelombang, id_angkatan, nama_gel, tanggal_awal_gel, tanggal_akhir_gel, status_gel) VALUES 
    ($nid_gelombang, $nid_angkatan, $nnama_gel, $ntanggal_awal_gel, $ntanggal_akhir_gel, 1) 
    ";

        // $q3 = mysqli_query($cn,$s3) or die("Auto Crete New Gelombang Failed. ".mysqli_error($cn));
        // zzz debug
    }
}



# ============================================================
# SELECT ALL PRODI
# ============================================================
$s = "SELECT id_prodi, jenjang, nama_prodi, singkatan_prodi from tb_prodi WHERE status_prodi=1";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)>0) {
    $i=0;
    while ($d = mysqli_fetch_assoc($q)) {
        $rid_prodi[$i] = $d['id_prodi'];
        $rjenjang[$i] = $d['jenjang'];
        $rnama_prodi[$i] = $d['nama_prodi'];
        $rsingkatan_prodi[$i] = $d['singkatan_prodi'];
        $i++;
    }
} else {
    die("Data prodi Error. Minimal satu prodi yang aktif");
}


# ============================================================
# SELECT ALL JALUR THIS ANGKATAN
# ============================================================
$s = "SELECT id_jalur, nama_jalur, singkatan_jalur from tb_jalur WHERE status_jalur=1 AND id_angkatan=$id_angkatan";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)>0) {
    $i=0;
    while ($d = mysqli_fetch_assoc($q)) {
        $rid_jalur[$i] = $d['id_jalur'];
        $rnama_jalur[$i] = $d['nama_jalur'];
        $rsingkatan_jalur[$i] = $d['singkatan_jalur'];
        $i++;
    }
} else {
    die("Data jalur Error. Minimal satu jalur yang aktif");
}


# ============================================================
# SELECT ALL GELOMBANG THIS ANGKATAN
# ============================================================
$s = "SELECT id_gelombang, nama_gel from tb_gelombang WHERE id_angkatan=$id_angkatan";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)>0) {
    $i=0;
    while ($d = mysqli_fetch_assoc($q)) {
        $rid_gelombang[$i] = $d['id_gelombang'];
        $rnama_gel[$i] = $d['nama_gel'];
        $i++;
    }
} else {
    die("Data gelombang Error. Minimal satu gelombang yang aktif");
}



# ============================================================
# PUBLIC FUNCTIONS
# ============================================================
function artikan_kode($nama_kode, $nilai)
{
    switch (strtolower($nama_kode)) {
        case 'status_menikah':
            if ($nilai==1) {
                return "Belum Menikah";
            }
            if ($nilai==2) {
                return "Menikah";
            }
            if ($nilai==3) {
                return "Janda/Duda";
            }
            break;
        case 'jk':
            if (strtoupper($nilai)=="L") {
                return "Laki-laki";
            }
            if (strtoupper($nilai)=="P") {
                return "Perempuan";
            }
            break;
        case 'agama':
            if ($nilai==1) {
                return "Islam";
            }
            if ($nilai==2) {
                return "Katolik";
            }
            if ($nilai==3) {
                return "Protestan";
            }
            if ($nilai==4) {
                return "Hindu";
            }
            if ($nilai==5) {
                return "Budha";
            }
            if ($nilai==6) {
                return "Konghucu";
            }
            if ($nilai==7) {
                return "Lainnya";
            }
            break;
        case 'warga_negara':
            if ($nilai==1) {
                return "WNI";
            }
            if ($nilai==2) {
                return "WNA";
            }
    }
}



function durasi_hari($a, $b)
{
    if (intval($a) == 0 || intval($b) == 0) {
        return "-";
    }
    $dStart = new DateTime($a);
    $dEnd  = new DateTime($b);
    $dDiff = $dStart->diff($dEnd);
    return $dDiff->format('%r%a');
}


function frp($x)
{
    return "Rp ".fnum($x).",-";
}

function fnum($x)
{
    switch (strlen($x)) {
        case 1:
        case 2:
        case 3: $y = $x;
            break;

        case 4: $y = substr($x, 0, 1).".".substr($x, 1, 3);
            break;
        case 5: $y = substr($x, 0, 2).".".substr($x, 2, 3);
            break;
        case 6: $y = substr($x, 0, 3).".".substr($x, 3, 3);
            break;

        case 7: $y = substr($x, 0, 1).".".substr($x, 1, 3).".".substr($x, 4, 3);
            break;
        case 8: $y = substr($x, 0, 2).".".substr($x, 2, 3).".".substr($x, 5, 3);
            break;
        case 9: $y = substr($x, 0, 3).".".substr($x, 3, 3).".".substr($x, 6, 3);
            break;

        default: $y = "Out of length digit.";
            break;
    }

    if ($y == 0) {
        return "-";
    } else {
        return "$y";
    }
}




function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = '';
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } elseif ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } elseif ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } elseif ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } elseif ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } elseif ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } elseif ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } elseif ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } elseif ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } elseif ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
