<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = $alamatsmtp;
$mail->SMTPAuth = true;
$mail->Username = $emailkirim;
$mail->Password = "$sandiemail";
$mail->SMTPSecure = 'tls';
$mail->Port = $portemail;
$mail->setFrom($emailkirim, $namakirim);
$mail->addAddress($email, $nama);
$mail->isHTML(true);
$mail->Subject = "AKTIVASI AKUN ADMINISTRATION INTEGRATED SYSTEM";
$mail->Body =  "<div class='row'>
                    <p>Akun akses Administration Integrated System telah dibuat, klik link berikut untuk melakukan aktivasi akun anda :<p>
                    <a href='http://localhost:8080/IndeximLP/aktivasi.php?token=" . $token . "'><b>Aktivasi dan buat sandi baru</b></a>
                <br>
                <div class='row'>
                    <hr>
                    <i>CATATAN :<br>
                    INI ADALAH EMAIL OTOMATIS DARI ADMINISTRATION INTEGRATED SYSTEM, MOHON UNTUK TIDAK MEMBALAS EMAIL INI

                    <p><b>Administration Integrated System</b></i></p>
                </div>

";
$mail->send();
if ($mail->Send()) {
    echo json_encode(array("statusCode" => 200, "pesan" => 'Link aktivasi berhasil diikirm, periksa email anda'));
} else {
    echo json_encode(array("statusCode" => 200, "pesan" => 'Link aktivasi gagal diikirm'));
}
