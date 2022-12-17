<?php
$servername = "localhost";
$database = "db_equipment";
// $database = "db_equipment";
$username = "root";
$password = "";

// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$connaset = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
"Koneksi berhasil";
//mysqli_close($conn);
