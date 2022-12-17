<?php
$servername = "localhost";
$database = "wilayah_indonesia";
$username = "root";
$password = "";

// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$connwil = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$connwil) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
"Koneksi berhasil";
//mysqli_close($conn);
