<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username = 'ihf44n.noifara@gmail.com';
$mail->Password = 'Samarind4';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom('ihf44n.noifara@gmail.com', 'LICENSING SYSTEM');
$mail->addAddress($email, $nama);
$mail->isHTML(true);
$mail->Subject = "AKTIVATION AKUN LICENSING SYSTEM";
$mail->Body =  "<div class='row'>
                    <p>Akun pengguna Licensing System teh dibuat, klik Link berikut untuk membuat sandi<p>
                    <a href='#'>Aktifkan dan Buat Sandi</a>
                <br>
                <div class='row'>
                    <hr>
                    <i>CATATAN :<br>
                    INI ADALAH EMAIL OTOMATIS DARI LICENSUING SYSTEM, MOHON UNTUK TIDAK MEMBALAS EMAIL INI

                    <p><b>LICENSING SYSTEM</b></i></p>
                </div>

";
$mail->send();
//echo json_encode(array("statusCode"=>200,"pesan"=>"Pengajuan cuti berhasil, Email approval telah dikirim"));
