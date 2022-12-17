<?php

session_start();

include 'dbconn.php';

$user = trim(str_replace("'", "", $_POST['user']));
$sandi = trim(str_replace("'", "", $_POST['sandi']));
$sesi = md5($sandi);
$ingatkan = $_POST['ingatsaya'];
$tglnow = date("Y-m-d H:i:s");

$ceklogin = "SELECT * FROM tbmuser WHERE emailLogin = '" . $user . "' AND sesi ='" . $sesi . "'";
$rst = mysqli_query($conn, $ceklogin);

if (!empty($rst) && $rst->num_rows > 0) {
    $row = mysqli_fetch_assoc($rst);
    $iduser = $row['idUser'];
    $statuser = $row['statUser'];
    $token = $row['token'];
    $tglkd = date("Y-m-d H:i:s", strtotime($row['tglKadaluarsa']));

    $sqlapp = mysqli_query($conn, "SELECT * FROM tbmappuser WHERE idUser=" . $iduser);
    if ($sqlapp->num_rows == 0) {
        echo json_encode(array("statusCode" => 201, "log" => "tidak ada aplikasi yang dapat anda akses, hubungi administrator"));
        return;
    }

    if ($statuser == "NONAKTIF") {
        if ($token != "") {
            echo json_encode(array("statusCode" => 201, "log" => "Anda belum melakukan aktivasi akun, cek email anda"));
            return;
        } else {
            echo json_encode(array("statusCode" => 201, "log" => "Akun anda telah dinonaktifkan, hubungi administrator"));
            return;
        }
    }

    if ($tglkd < $tglnow) {
        echo json_encode(array("statusCode" => 201, "log" => "masa aktif akun anda telah berakhir, hubungi administrator"));
        return;
    }

    $_SESSION['emailmsys'] = $row['emailLogin'];
    $_SESSION['namalogmsys'] = $row['namaUser'];
    $_SESSION['idusermsys'] = $row['idUser'];
    $_SESSION['aksesakunmsys'] = $row['aksesAkun'];

    $cekprofil = "SELECT * FROM tbmprofil WHERE idUser = " . $row['idUser'];
    $rstprofil = mysqli_query($conn, $cekprofil);
    $rwprofil = mysqli_fetch_assoc($rstprofil);

    if ($rstprofil->num_rows > 0) {
        $_SESSION['namaaliaslogmsys'] = $rwprofil['namaDisplay'];
    } else {
        $_SESSION['namaaliaslogmsys'] = $_SESSION['namalogmsys'];
    }

    // $ingatkan = "kosong";
    if ($ingatkan == "true") {
        setcookie('unmsys', $user, time() + (60 * 60 * 24 * 2), '/', NULL);
        setcookie('sdmsys', $sandi, time() + (60 * 60 * 24 * 2), '/', NULL);
        // $ingatkan = "cetang";
    }

    echo json_encode(array("statusCode" => 200, "sesi" => $sesi, "log" => "Login berhasil", "ingatkan" => $ingatkan));
} else {
    echo json_encode(array("statusCode" => 201, "sesi" => $sesi, "log" => "Email atau Sandi anda salah."));
}

mysqli_close($conn);
