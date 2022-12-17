<?php

include 'dbconn.php';

$sqlprov = "SELECT * FROM tbmmenu where StatMenu='AKTIF' ORDER BY IdMenu ASC";
$rstprov = mysqli_query($conn, $sqlprov);

if ($rstprov->num_rows > 0) {
    $output = "<option value='semua'>-- Pilih tipe pengguna --</option>";
    while ($rwkab = mysqli_fetch_array($rstprov)) {
        $output = $output . "<option value=" . $rwkab['IdMenu'] . ">" . $rwkab['NamaMenu'] . "</option>";
    }

    echo $output;
} else {
    $output = "<option value=''>-- Tipe pengguna tidak ada --</option>";
    echo $output;
}
