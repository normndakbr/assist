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
$mail->Password = $sandiemail;
$mail->SMTPSecure = 'tls';
$mail->Port = $portemail;
$mail->setFrom($emailkirim, $namakirim);
$mail->addAddress($email, $nama);
$mail->isHTML(true);
$mail->Subject = "RESET SANDI ADMINISTRATION INTEGRATED SYSTEM";
$mail->Body =  "<div class='row'>
                    <p>Klik link berikut untuk reset sandi akun Administration Integrated System anda :<p>
                    <a href='http://localhost:8080/IndeximLP/resetsandi.php?token=" . $token . "'><b>Reset sandi</b></a>
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
    echo json_encode(array("statusCode" => 200, "pesan" => 'Link reset sandi berhasil diikirm, periksa email anda'));
} else {
    echo json_encode(array("statusCode" => 200, "pesan" => 'Link reset sandi gagal diikirm'));
}
