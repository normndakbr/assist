<?php
$servername = "localhost";
$database = "db_legal";
// $database = "db_equipment";
$username = "root";
$password = "";

// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$connlegal = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
"Koneksi berhasil";
//mysqli_close($conn);
