<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username = 'itysug.network@gmail.com';
$mail->Password = 'samarind4';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom('itysug.network@gmail.com', 'PT. INDEXIM COALINDO');
$mail->addAddress($email, 'IC-SYSTEM');
$mail->isHTML(true);
$mail->Subject = "Pengingat Masa Akhir Perizinan";
$mail->Body = "<div style='text-align:center;'>
                    <h1>PT. INDEXIM COALINDO - PERIZINAN</h1>
                    <h3 style='margin-top:-15px'>Surat perizinan telah mendekati masa akhir, dengan data sebagai berikut : </h3>
                    <h6>No. Perizinan :</h6>
                    <h6>Perizinan :</h6>
                    <h6>Tanggal Terbit :</h6>
                    <h6>Tanggal Berakhir :</h6>
                </div>";
$mail->send();
//echo 'Message has been sent';