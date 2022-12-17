<?php

include 'dbconn.php';

if (isset($_GET['stt'])) {
    $stt = $_GET['stt'];
} else {
    $stt = "";
}

if ($stt == "app") {
    $sqlapp = "SELECT * FROM tbmapp ORDER BY idApp ASC";
    $rstapp = mysqli_query($conn, $sqlapp);
    if ($rstapp->num_rows > 0) {
        $output = "<option value='semua'>-- Pilih Aplikasi --</option>";
        while ($rwapps = mysqli_fetch_array($rstapp)) {
            $output = $output . "<option value=" . $rwapps['idApp'] . ">" . $rwapps['namaApp'] . "</option>";
        }

        echo $output;
    } else {
        $output = "<option value=''>-- Aplikasi tidak ditemukan --</option>";
        echo $output;
    }
} else if ($stt == "akses") {
    $idapp = $_POST['idapp'];

    $sqlapp = "SELECT * FROM tbmapp WHERE idApp=" . $idapp . " ORDER BY idApp ASC";
    $rstapp = mysqli_query($conn, $sqlapp);
    if ($rstapp->num_rows > 0) {
        $rwapp = mysqli_fetch_assoc($rstapp);
        $filekoneksi = $rwapp['filekoneksi'];
        $koneksi = $rwapp['koneksi'];

        if ($filekoneksi != "") {
            include $filekoneksi;

            $sqlakses = "SELECT * FROM tbmmenu ORDER BY IdMenu ASC";
            $rstakses = mysqli_query(${$koneksi}, $sqlakses);
            if ($rstakses->num_rows > 0) {
                $rwakses = mysqli_fetch_assoc($rstakses);

                $output = "<option value='semua'>-- Pilih Akses --</option>";
                while ($rwaksess = mysqli_fetch_array($rstakses)) {
                    $output = $output . "<option value=" . $rwaksess['IdMenu'] . ">" . $rwaksess['NamaMenu'] . "</option>";
                }
            } else {
                $output = "<option value=''>-- Data akses tidak ditemukan --</option>";
            }
        } else {
            $output = "<option value=''>-- Data akses tidak ditemukan --</option>";
        }

        echo $output;
    } else {
        $output = "<option value=''>-- Data akses tidak ditemukan --</option>";
        echo $output;
    }
}
