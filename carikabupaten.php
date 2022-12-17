<?php

include 'koneksi.php';

$kdprov = $_POST['kdprov'];

$sqlprov = "SELECT * FROM regencies WHERE province_id = '" . $kdprov . "' ORDER BY name ASC";
$rstprov = mysqli_query($con, $sqlprov);

if ($rstprov->num_rows > 0) {
    $output = "<option value=''>-- Pilih Kabupaten Kota --</option>";
    while ($rwkab = mysqli_fetch_array($rstprov)) {
        $output = $output . "<option value=" . $rwkab['id'] . ">" . $rwkab['name'] . "</option>";
    }

    echo $output;
} else {
    $output = "<option value=''>-- Pilih Kabupaten Kota --</option>";
    echo $output;
}
