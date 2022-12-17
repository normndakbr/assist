<?php

session_start();

include('dbconn.php');

$iduser = $_SESSION['idusermsys'];
$sandilama = $_POST['lama'];
$sandibaru = $_POST['baru'];
$ulangsandi = $_POST['ulang'];

$sqluser = mysqli_query($conn, "SELECT * FROM tbmuser WHERE idUser=" . $iduser);

if ($sqluser->num_rows > 0) {
    $rwuser = mysqli_fetch_assoc($sqluser);
    $sesi = $rwuser['sesi'];
    $sesibaru = md5($sandibaru);

    if ($sesi == md5($sandilama)) {
        $updsandi = mysqli_query($conn, "UPDATE tbmuser SET sesi = '" . $sesibaru . "' WHERE idUser=" . $iduser);

        if ($updsandi) {
            echo json_encode(array("statusCode" => 200, "pesan" => "Sandi berhasil diganti, ingat baik-baik sandi anda"));
            return;
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Sandi gagal diganti"));
            return;
        }
    } else {
        echo json_encode(array("statusCode" => 201, "pesan" => "Sandi lama salah"));
        return;
    }
} else {
    echo json_encode(array("statusCode" => 201, "pesan" => "Akun tidak ditemukan"));
    return;
}
