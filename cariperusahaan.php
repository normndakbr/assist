<?php

include 'dbconn.php';
session_start();

if (isset($_GET['stt'])) {
    $stt = $_GET['stt'];
} else {
    $stt =  "";
}

if ($stt == "pilih") {

    $sqldept = mysqli_query($conn, "SELECT * FROM tbmperusahaan where StatPerusahaan ='AKTIF' order by NamaPerusahaan ASC");

    $output = "<option value=''>-- Pilih Perusahaan --</option>";
    if ($sqldept->num_rows > 0) {
        while ($rwdep = mysqli_fetch_array($sqldept)) {
            $output = $output . "<option value='" . $rwdep['IdPerusahaan'] . "'>" . $rwdep['NamaPerusahaan'] . "</option>";
        }
        echo $output;
    } else {
        echo "<option value=''>-- Perusahaan tidak ditemukan --</option>";
    }
}
