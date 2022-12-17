<?php

include 'dbwilayah.php';


if (isset($_GET['stt'])) {
    $stt = $_GET['stt'];
} else {
    $stt = "";
}

if ($stt == "prov") {

    $sqlprov = "SELECT * FROM provinces order by id asc";
    $rstprov = mysqli_query($connwil, $sqlprov);

    if ($rstprov->num_rows > 0) {
        $output = "<option value=''>-- Pilih Provinsi --</option>";
        while ($rwreg = mysqli_fetch_array($rstprov)) {
            $output = $output . "<option value=" . $rwreg['id'] . ">" . $rwreg['name'] . "</option>";
        }

        echo $output;
    } else {
        $output = "<option value=''>-- Pilih Provinsi --</option>";
        echo $output;
    }
} else if ($stt == "kabu") {
    $idprov = $_POST['idprov'];

    $sqlkabu = "SELECT * FROM regencies where province_id='$idprov' order by id asc";
    $rstkabu = mysqli_query($connwil, $sqlkabu);

    if ($rstkabu->num_rows > 0) {
        $output = "<option value=''>-- Pilih Kabupaten --</option>";
        while ($rwreg = mysqli_fetch_array($rstkabu)) {
            $output = $output . "<option value=" . $rwreg['id'] . ">" . $rwreg['name'] . "</option>";
        }

        echo $output;
    } else {
        $output = "<option value=''>-- Pilih Kabupaten --</option>";
        echo $output;
    }
}
