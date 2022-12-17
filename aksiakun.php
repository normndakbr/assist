<?php
include 'dbconn.php';
include 'dbwilayah.php';
include 'dbconnlegal.php';
include 'dbconnaset.php';

if (isset($_GET['stt'])) {
    $stt = $_GET['stt'];
} else {
    $stt = "";
}

date_default_timezone_set("Asia/Makassar");
$tglnow = date('Y-m-d H:i:s');

if ($stt == "tglaktif") {
    if (isset($_POST['tglaktif'])) {
        $tglaktif = date('Y-m-d 00:00:00', strtotime($_POST['tglaktif']));
    } else {
        $tglaktif = "";
    }

    if ($tglaktif != "") {
        $tglmulai = strtotime($tglaktif);
        $tglkadaluarsa = date('Y-m-d', strtotime("+365 days", $tglmulai));

        echo $tglkadaluarsa;
    }
} else if ($stt == "simpan") {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $tglaktif = date('Y-m-d 00:00:00', strtotime($_POST['tglaktif']));
    $tglkadaluarsa = date('Y-m-d 23:59:59', strtotime($_POST['tglkadaluarsa']));
    $token = md5($email . $tglnow);
    $aksesakun = $_POST['aksesakun'];

    $sqluser = mysqli_query($conn, "SELECT * FROM tbmuser WHERE emailLogin='" . $email . "'");

    if ($sqluser->num_rows > 0) {
        echo json_encode(array("statusCode" => 201, "pesan" => "Email sudah digunakan"));
        return;
    } else {
        $insuser = mysqli_query($conn, "INSERT INTO tbmuser (namaUser, emailLogin, sesi, token, statUser, tglAktif, tglKadaluarsa, tgljamBuat, tglLastEdited, picUser,idkary, aksesAkun) " .
            " VALUES('" . $nama . "','" . $email . "','','" . $token . "','NONAKTIF','" . $tglaktif . "','" . $tglkadaluarsa . "','" . $tglnow . "','" . $tglnow . "','',0,'" . $aksesakun . "')");

        if ($insuser) {
            $strakun = "SELECT * FROM tbmuser ORDER BY idUser DESC LIMIT 1";
            $sqlakun = mysqli_query($conn, $strakun);
            if ($sqlakun->num_rows > 0) {
                $rwakun = mysqli_fetch_assoc($sqlakun);
                $iduser = $rwakun['idUser'];
            } else {
                $iduser = "0";
            }

            $insprofil = mysqli_query($conn, "INSERT INTO tbmprofil (idUser, namaDisplay, nikKary, perusahaan, depart, divisi, posisi) " .
                " VALUES(" . $iduser . ",'" . $nama . "','','','','')");

            echo json_encode(array("statusCode" => 200,  "pesan" => "User baru berhasil dibuat", "iduser" => $iduser));
            return;
        } else {
            echo json_encode(array("statusCode" => 201,  "pesan" => "User baru gagal dibuat"));
            return;
        }
    }

    mysqli_close($conn);
} else if ($stt == "akses") {
    $idapp = $_POST['idapp'];
    $iduser = $_POST['iduser'];
    $idakses = $_POST['idakses'];

    $sqluser = mysqli_query($conn, "SELECT * FROM tbmappuser WHERE idUser=" . $iduser . " AND idApp=" . $idapp);

    if ($sqluser->num_rows > 0) {
        echo json_encode(array("statusCode" => 201, "pesan" => "Aplikasi sudah ada"));
        return;
    } else {
        $insuser = mysqli_query($conn, "INSERT INTO tbmappuser (idApp, idMenu, idUser) " .
            " VALUES(" . $idapp . "," . $idakses . "," . $iduser . ")");

        if ($insuser) {
            echo json_encode(array("statusCode" => 200,  "pesan" => "Aplikasi berhasil disimpan", "iduser" => $iduser));
            return;
        } else {
            echo json_encode(array("statusCode" => 201,  "pesan" => "Aplikasi gagal disimpan"));
            return;
        }
    }

    mysqli_close($conn);
} else if ($stt == "profil") {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $iduser = $_POST['iduser'];
    $perusahaan = $_POST['perusahaan'];
    $depart = $_POST['depart'];
    $divisi = $_POST['divisi'];
    $posisi = $_POST['posisi'];

    $sqluser = mysqli_query($conn, "SELECT * FROM tbmprofil WHERE idUser=" . $iduser);

    if ($sqluser->num_rows == 0) {
        $insprofil = mysqli_query($conn, "INSERT INTO tbmprofil (idUser, namaDisplay, nikKary, perusahaan, depart, divisi, posisi) " .
            " VALUES(" . $iduser . ",'" . $nama . "','" . $nik . "','" . $perusahaan . "','" . $depart . "','" . $divisi . "','" . $posisi . "')");

        if ($insprofil) {
            $_SESSION['namaaliaslogmsys']  = $nama;
            echo json_encode(array(
                "statusCode" => 200,
                "pesan" => "Profil berhasil diupdate",
                "iduser" => $iduser,
                "nama" => $nama,
                "namaper" => $perusahaan,
                "depart" => $depart,
                "divisi" => $divisi,
                "posisi" => $posisi,
                "nik" => $nik
            ));
            return;
        } else {
            echo json_encode(array("statusCode" => 201,  "pesan" => "Profil gagal diupdate"));
            return;
        }
    } else {
        $rwuser = mysqli_fetch_assoc($sqluser);
        $idprofil = $rwuser['idProfil'];

        $insuser = mysqli_query($conn, "UPDATE tbmprofil SET namaDisplay='" . $nama . "', nikKary='" . $nik . "', perusahaan='" . $perusahaan .
            "', depart='" . $depart . "', divisi='" . $divisi . "', posisi='" . $posisi . "' WHERE idProfil=" . $idprofil);

        if ($insuser) {
            $_SESSION['namaaliaslogmsys']  = $nama;
            echo json_encode(array(
                "statusCode" => 200,
                "pesan" => "Profil berhasil diupdate",
                "iduser" => $iduser,
                "nama" => $nama,
                "namaper" => $perusahaan,
                "depart" => $depart,
                "divisi" => $divisi,
                "posisi" => $posisi,
                "nik" => $nik
            ));
            return;
        } else {
            echo json_encode(array("statusCode" => 201,  "pesan" => "Profil gagal diupdate"));
            return;
        }
    }

    mysqli_close($conn);
} else if ($stt == "kirimulang") {
    $id = $_POST['id'];

    $sqluser = mysqli_query($conn, "SELECT * FROM tbmuser WHERE idUser=" . $id);

    if ($sqluser->num_rows > 0) {
        $rwuser = mysqli_fetch_assoc($sqluser);
        $token =  $rwuser['token'];
        $nama =  $rwuser['namaUser'];
        $email =  $rwuser['emailLogin'];

        $sqlcek = mysqli_query($conn, "SELECT * FROM tbmemailkirim LIMIT 1");

        if ($sqlcek->num_rows > 0) {
            $rwemail = mysqli_fetch_assoc($sqlcek);
            $namakirim = $rwemail['NamaPengirim'];
            $emailkirim = $rwemail['EmailKirim'];
            $sandiemail = $rwemail['SandiEmail'];
            $alamatsmtp = $rwemail['AlamatSMTP'];
            $portemail = $rwemail['PortEmail'];

            include('mailakun.php');
        } else {
            echo json_encode(array("statusCode" => 201,  "pesan" => "link aktivasi akun tidak dapat dikirim, email pengirim tidak ditemukan"));
            return;
        }
    } else {
        echo json_encode(array("statusCode" => 201,  "pesan" => "link aktivasi akun tidak dapat dikirim, akun tidak ditemukan"));
        return;
    }

    mysqli_close($conn);
} else if ($stt == "hapus") {
    $email = $_POST['email'];
    $id = $_POST['id'];

    $sqlapp = mysqli_query($conn, "SELECT * FROM tbmappuser WHERE idUser=" . $id);
    if ($sqlapp->num_rows > 0) {
        while ($rwcek = mysqli_fetch_assoc($sqlcek)) {
            $rwapp = mysqli_fetch_assoc($sqlapp);
            $idapp = $rwapp['idApp'];
            $koneksi = $rwapp['koneksi'];

            $sqlcek = mysqli_query($conn, "SELECT * FROM vwcekperusahaan WHERE idApp=" . $idap . " AND kategori='User'");
            if ($sqlcek->num_rows > 0) {
                while ($rwcek = mysqli_fetch_assoc($sqlcek)) {
                    $colField = $rwcek['colField'];
                    $namaTable = $rwcek['namaTable'];
                    $pesan = $rwcek['pesan'];
                    $namaApp = $rwcek['namaApp'];

                    $query = "SELECT " . $colField . " FROM " . $namaTable . " WHERE " . $colField . "=" . $id;

                    $sqlck = mysqli_query(${$koneksi}, $query);
                    if ($sqlck->num_rows > 0) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Data akun tidak dapat dihapus, digunakan pada " . $pesan . " aplikasi " . $namaApp));
                        return;
                    }
                }
            }
        }
    } else {
        echo json_encode(array("statusCode" => 201, "pesan" => "Data akun gagal dihapus"));
        return;
    }

    $deluser = mysqli_query($conn, "DELETE FROM tbmuser WHERE idUser=" . $id);

    if ($deluser) {
        $delapp = mysqli_query($conn, "DELETE FROM tbmappuser WHERE idUser=" . $id);
        if ($delapp) {

            echo json_encode(array("statusCode" => 200,  "pesan" => "Akun berhasil dihapus"));
            return;
        } else {
            echo json_encode(array("statusCode" => 200,  "pesan" => "Akun berhasil dihapus, data aplikasi gagal dihapus"));
            return;
        }
    } else {
        echo json_encode(array("statusCode" => 201,  "pesan" => "Akun gagal dihapus"));
        return;
    }
} else if ($stt == "tampil") {
    date_default_timezone_set("Asia/Makassar");
    $tglnow = date('Y-m-d H:i:s');
    $email = $_POST['email'];
    $id = $_POST['id'];

    $sqluser = mysqli_query($conn, "SELECT * FROM tbmuser WHERE emailLogin='" . $email . "' AND idUser=" . $id);

    if ($sqluser->num_rows > 0) {
        $rwuser = mysqli_fetch_assoc($sqluser);
        $nama =  $rwuser['namaUser'];
        $tglaktif =  date('Y-m-d', strtotime($rwuser['tglAktif']));
        $tglkd =  date('Y-m-d', strtotime($rwuser['tglKadaluarsa']));
        $tglaktifshow =  date('d-M-Y', strtotime($rwuser['tglAktif']));
        $tglkdshow =  date('d-M-Y', strtotime($rwuser['tglKadaluarsa']));
        $stat =  $rwuser['statUser'];
        $aksesakun =  $rwuser['aksesAkun'];
        $pic =  $rwuser['picUser'];

        echo json_encode(array(
            "statusCode" => 200, "nama" => $nama, "tglaktif" => $tglaktif, "tglkd" => $tglkd, "tglaktifshow" => $tglaktifshow,
            "tglkdshow" => $tglkdshow, "stat" => $stat, "pic" => $pic, "aksesakun" => $aksesakun
        ));
    }
} else if ($stt == "edit") {
    date_default_timezone_set("Asia/Makassar");
    $tglnow = date('Y-m-d H:i:s');

    $id = $_POST['iduser'];
    $nama = $_POST['nama'];
    $tglaktif = date('Y-m-d 00:00:00', strtotime($_POST['tglaktif']));
    $tglkd = date('Y-m-d 23:59:59', strtotime($_POST['tglkd']));
    $stat = $_POST['stat'];
    $aksesakun = $_POST['aksesakun'];

    $updtuser = mysqli_query($conn, "UPDATE tbmuser SET namaUser='" . $nama . "', tglAktif='" . $tglaktif .
        "', tglKadaluarsa='" . $tglkd . "', statUser = '" . $stat . "', tglLastEdited='" . $tglnow . ", aksesAkun='" . $aksesakun .
        "' WHERE idUser=" . $id);

    if ($updtuser) {
        echo json_encode(array(
            "statusCode" => 200, "pesan" => "Akun berhasil diedit"
        ));
    } else {
        echo json_encode(array(
            "statusCode" => 201, "pesan" => "Akun gagal diedit"
        ));
    }

    mysqli_close($conn);
} else if ($stt == "selesai") {
    date_default_timezone_set("Asia/Makassar");
    $tglnow = date('Y-m-d H:i:s');

    $token = md5($tglnow);
    $iduser = $_POST['iduser'];

    $sqlcek = mysqli_query($conn, "SELECT * FROM vwappuser WHERE idUser=" . $iduser);
    if ($sqlcek->num_rows > 0) {
        while ($rwcek = mysqli_fetch_assoc($sqlcek)) {
            $email = $rwcek['emailLogin'];
            $nama = $rwcek['namaUser'];
            $koneksi = $rwcek['koneksi'];
            $database = $rwcek['database'];
            $tglAktif = date("Y-m-d", strtotime($rwcek['tglAktif']));
            $tglKadaluarsa = date("Y-m-d", strtotime($rwcek['tglKadaluarsa']));
            $database = $rwcek['database'];
            $filekoneksi = $rwcek['filekoneksi'];
            $idmenu = $rwcek['idMenu'];

            include $filekoneksi;

            $sqlcekusr = mysqli_query(${$koneksi}, "SELECT * FROM tbmuser WHERE EmailLogin='" . $email . "'");
            if ($sqlcekusr->num_rows > 0) {
                $insuser = mysqli_query(${$koneksi}, "UPDATE tbmuser SET  IdMenu=" . $idmenu . " WHERE EmailLogin='" . $email . "'");
            } else {
                $insuser = mysqli_query(${$koneksi}, "INSERT INTO tbmuser (EmailLogin, NamaLogin, TglAktif, TglKadaluarsa," .
                    " Sesi, IdMenu, StatUser, PicUser, TglJamBuat, TglLastEdit, Token) values('" . $email . "','" . $nama .
                    "','1970-01-01','1970-01-01',''," . $idmenu . ",'AKTIF','','" . $tglnow . "','" . $tglnow .
                    "','')");
            }
        }

        $sqluser = mysqli_query($conn, "SELECT * FROM tbmuser WHERE idUser=" . $iduser);

        if ($sqluser->num_rows > 0) {
            $rwuser = mysqli_fetch_assoc($sqluser);
            $nama =  $rwuser['namaUser'];
            $tglaktif =  date('Y-m-d', strtotime($rwuser['tglAktif']));
            $tglkd =  date('Y-m-d', strtotime($rwuser['tglKadaluarsa']));
            $tglaktifshow =  date('d-M-Y', strtotime($rwuser['tglAktif']));
            $tglkdshow =  date('d-M-Y', strtotime($rwuser['tglKadaluarsa']));
            $stat =  $rwuser['statUser'];
            $token =  $rwuser['token'];
            $pic =  $rwuser['picUser'];

            $sqlcek = mysqli_query($conn, "SELECT * FROM tbmemailkirim LIMIT 1");

            if ($sqlcek->num_rows > 0) {
                $rwemail = mysqli_fetch_assoc($sqlcek);
                $namakirim = $rwemail['NamaPengirim'];
                $emailkirim = $rwemail['EmailKirim'];
                $sandiemail = $rwemail['SandiEmail'];
                $alamatsmtp = $rwemail['AlamatSMTP'];
                $portemail = $rwemail['PortEmail'];

                include('mailakun.php');
            } else {
                echo json_encode(array("statusCode" => 201,  "pesan" => "link aktivasi akun tidak dapat dikirim, email pengirim tidak ditemukan"));
                return;
            }
        } else {
            echo json_encode(array("statusCode" => 201,  "pesan" => "link aktivasi akun tidak dapat dikirim, akun tidak ditemukan"));
            return;
        }
    } else {
        echo json_encode(array("statusCode" => 201,  "pesan" => "link aktivasi akun tidak dapat dikirim, aplikasi user tidak ditemukan"));
        return;
    }

    mysqli_close($conn);
} else if ($stt == "aktivasi") {
    date_default_timezone_set("Asia/Makassar");
    $tglnow = date('Y-m-d H:i:s');

    $token = $_POST['token'];
    $email = $_POST['email'];
    $sesi = md5($_POST['sandi']);

    $updtuser = mysqli_query($conn, "UPDATE tbmuser SET sesi='" . $sesi . "', statUser ='AKTIF', token='', tglLastEdited='" . $tglnow .
        "' WHERE emailLogin='" . $email . "'");

    if ($updtuser) {
        echo json_encode(array(
            "statusCode" => 200, "pesan" => "Aktivasi akun berhasil, klik tombol login untuk mulai menggunakan aplikasi"
        ));
    } else {
        echo json_encode(array(
            "statusCode" => 201, "pesan" => "Aktivasi akun gagal, hubungi administrator"
        ));
    }

    mysqli_close($conn);
} else if ($stt == "lupasandi") {

    $email = $_POST['email'];
    $tglnow = date('Y-m-d H:i:s');

    $updtuser = mysqli_query($conn, "SELECT * FROM tbmuser WHERE emailLogin='" . $email . "'");

    if ($updtuser) {
        $rwcek = mysqli_fetch_assoc($updtuser);
        $nama = $rwcek['namaUser'];
        $token = md5($email . $tglnow);

        $upduser = mysqli_query($conn, "UPDATE tbmuser SET token='" . $token . "' WHERE emailLogin='" . $email . "'");

        if ($upduser) {
            $sqlcek = mysqli_query($conn, "SELECT * FROM tbmemailkirim LIMIT 1");

            if ($sqlcek->num_rows > 0) {
                $rwemail = mysqli_fetch_assoc($sqlcek);
                $namakirim = $rwemail['NamaPengirim'];
                $emailkirim = $rwemail['EmailKirim'];
                $sandiemail = $rwemail['SandiEmail'];
                $alamatsmtp = $rwemail['AlamatSMTP'];
                $portemail = $rwemail['PortEmail'];

                include('maillupa.php');
            } else {
                echo json_encode(array("statusCode" => 200,  "pesan" => "Link reset sandi gagal dikirim ke alamat email anda"));
                return;
            }
        } else {
            echo json_encode(array("statusCode" => 200,  "pesan" => "Link reset sandi gagal dikirim ke alamat email anda"));
            return;
        }
    } else {
        echo json_encode(array(
            "statusCode" => 201, "pesan" => "Email anda tidak terdaftar"
        ));
    }

    mysqli_close($conn);
} else if ($stt == "resetsandi") {
    date_default_timezone_set("Asia/Makassar");
    $tglnow = date('Y-m-d H:i:s');

    $token = $_POST['token'];
    $email = $_POST['email'];
    $sesi = md5($_POST['sandi']);

    $updtuser = mysqli_query($conn, "UPDATE tbmuser SET Sesi='" . $sesi . "', Token='' WHERE EmailLogin='" . $email . "'");

    if ($updtuser) {
        echo json_encode(array(
            "statusCode" => 200, "pesan" => "Reset sandi berhasil"
        ));
    } else {
        echo json_encode(array(
            "statusCode" => 201, "pesan" => "Reset sandi gagal, hubungi administrator"
        ));
    }

    mysqli_close($conn);
}
