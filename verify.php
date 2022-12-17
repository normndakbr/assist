<?php

session_start();
include "dbconn.php";

if (isset($_GET["app"])) {
    $app = $_GET["app"];
} else {
    $app = "";
}

if ($app != "") {
    $sqlapp = mysqli_query($conn, "SELECT * FROM tbmapp WHERE idApp=" . $app);
    if ($sqlapp->num_rows > 0) {
        $rwapp = mysqli_fetch_assoc($sqlapp);
        $idapp = $rwapp['idApp'];
        $koneksi = $rwapp['koneksi'];
        $database = $rwapp['database'];
        $filekoneksi = $rwapp['filekoneksi'];
        $linkapp = $rwapp['linkApp'];

        if (isset($_SESSION['emailmsys'])) {
            $email = $_SESSION['emailmsys'];

            include  $filekoneksi;

            $sqluser = mysqli_query(${$koneksi}, "SELECT * FROM tbmuser WHERE EmailLogin='" . $email . "'");
            if ($sqluser->num_rows > 0) {
                $rwapp = mysqli_fetch_assoc($sqluser);
                $_SESSION["idapp" . $idapp] =  $idapp;
                $_SESSION["apps" . $idapp] = 1;
                $link = $linkapp . "aksilogin.php";
                header("Location: " .  $link);
            } else {
                header("Location: http://localhost:8080/IndeximLP/");
            }
        } else {
            echo "gagal";
            header("Location: login.php");
        }
    }
} else {
    echo "gagassl";
    header("Location: login.php");
}
