<?php

session_start();

include 'dbconn.php';
include 'dbwilayah.php';
include 'dbconnlegal.php';
include 'dbconnaset.php';

$iduser = $_SESSION['idusermsys'];

if (isset($_GET['stt'])) {
    $stt = $_GET['stt'];
} else {
    $stt = "";
}

date_default_timezone_set("Asia/Makassar");
$tglnow = date('Y-m-d H:i:s');

if ($stt == "simpan") {
    $kode = str_replace("'", "", trim($_POST['txtkodepertambah']));
    $nama = str_replace("'", "",  trim($_POST['txtnamapertambah']));
    $alamat = str_replace("'", "",  trim($_POST['txtalamatpertambah']));
    $prov = $_POST['lstprovpertambah'];
    $kab =  $_POST['lstkabpertambah'];
    $kec =  $_POST['lstkecpertambah'];
    $kel = $_POST['lstkelpertambah'];

    if (isset($_POST['txttelppertambah'])) {
        $telp = str_replace("'", "",  trim($_POST['txttelppertambah']));
    } else {
        $telp = "";
    }

    if (isset($_POST['txtemailpertambah'])) {
        $email = str_replace("'", "",  trim($_POST['txtemailpertambah']));
    } else {
        $email = "";
    }

    if (isset($_POST['txtwebpertambah'])) {
        $web = str_replace("'", "",  trim($_POST['txtwebpertambah']));
    } else {
        $web = "";
    }

    if (isset($_POST['txtnpwppertambah'])) {
        $npwp = str_replace("'", "",  trim($_POST['txtnpwppertambah']));
    } else {
        $npwp = "";
    }

    $sqlcek = mysqli_query($conn, "SELECT * FROM tbmperusahaan where Kodeperusahaan='" . $kode . "' OR NamaPerusahaan='" . $nama . "'");

    if ($sqlcek->num_rows > 0) {
        echo json_encode(array("statusCode" => 201, "pesan" => "Kode atau nama perusahaan sudah digunakan"));
        return;
    } else {
        $instperus = mysqli_query($conn, "INSERT INTO tbmperusahaan (KodePerusahaan, NamaPerusahaan, AlamatPerusahaan,
            KelPerusahaan, KecPerusahaan, KotaPerusahaan, ProvPerusahaan, TelpPerusahaan, EmailPerusahaan, WebsitePerusahaan, NPWPPerusahaan,
            StatPerusahaan, TglJamBuat) VALUES('" . $kode .
            "','" . $nama . "','" . $alamat . "','" . $kel . "','" . $kec . "','" . $kab . "','" . $prov . "','" . $telp . "','" . $email . "','" . $web . "','" . $npwp . "','AKTIF','" . $tglnow . "')");

        if ($instperus) {
            $sqlcek = mysqli_query($conn, "SELECT * FROM tbmperusahaan ORDER BY IdPerusahaan DESC LIMIT 1");

            if ($sqlcek->num_rows > 0) {
                $rwcek = mysqli_fetch_assoc($sqlcek);
                $idper = $rwcek['IdPerusahaan'];

                $instaudit = mysqli_query($conn, "INSERT INTO tbmaudit (TipeData, JenisData, IdData, NamaData, TglEdit, IdPerusahaan, IdUser) 
                        VALUES ('BUAT','Perusahaan'," . $idper . ",'" . $nama . "','" . $tglnow . "',0," . $iduser . ")");
            }

            echo json_encode(array("statusCode" => 200, "pesan" => "Data Perusahaan berhasil disimpan"));
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data Perusahaan gagal disimpan"));
        }
    }
} else if ($stt == 'hapus') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    $sqlapp = mysqli_query($conn, "SELECT * FROM vwappuser WHERE idUser=" . $id);
    if ($sqlapp->num_rows > 0) {
        while ($rwcek = mysqli_fetch_assoc($sqlcek)) {
            $rwapp = mysqli_fetch_assoc($sqlapp);
            $idapp = $rwapp['idApp'];
            $koneksi = $rwapp['koneksi'];

            $sqlcek = mysqli_query($conn, "SELECT * FROM vwcekperusahaan WHERE idApp=" . $idapp . " AND kategori='Perusahaan'");
            if ($sqlcek->num_rows > 0) {
                while ($rwcek = mysqli_fetch_assoc($sqlcek)) {
                    $colField = $rwcek['colField'];
                    $namaTable = $rwcek['namaTable'];
                    $pesan = $rwcek['pesan'];
                    $namaApp = $rwcek['namaApp'];

                    $query = "SELECT " . $colField . " FROM " . $namaTable . " WHERE " . $colField . "=" . $id;

                    $sqlck = mysqli_query(${$koneksi}, $query);
                    if ($sqlck->num_rows > 0) {
                        echo json_encode(array("statusCode" => 201, "pesan" => "Data perusahaan tidak dapat dihapus, digunakan pada " . $pesan . " aplikasi " . $namaApp));
                        return;
                    }
                }
            }
        }
    } else {
        echo json_encode(array("statusCode" => 201, "pesan" => "Data akun gagal dihapus"));
        return;
    }

    $delperus = mysqli_query($conn, "DELETE FROM tbmperusahaan where IdPerusahaan=" . $id);

    if ($delperus) {
        $instaudit = mysqli_query($conn, "INSERT INTO tbmaudit (TipeData, JenisData, IdData, NamaData, TglEdit, IdPerusahaan, IdUser) 
            VALUES ('HAPUS','Perusahaan'," . $id . ",'" . $nama . "','" . $tglnow . "',0," . $iduser . ")");

        echo json_encode(array("statusCode" => 200, "pesan" => "Data perusahan berhasil dihapus"));
    } else {
        echo json_encode(array("statusCode" => 201, "pesan" => "Data perusahan gagal dihapus"));
    }
} else if ($stt == 'tampil') {
    $id = $_POST['id'];

    $sqlcek = mysqli_query($conn, "SELECT * FROM tbmperusahaan where IdPerusahaan=" . $id);

    if ($sqlcek->num_rows > 0) {
        $rwcek = mysqli_fetch_assoc($sqlcek);

        $idkel = $rwcek['KelPerusahaan'];
        $sqlkel = mysqli_query($connwil, "SELECT * FROM villages where id='$idkel'");
        if ($sqlkel->num_rows > 0) {
            $rwpkel = mysqli_fetch_assoc($sqlkel);
            $kel = $rwpkel['name'];
        } else {
            $kel = "";
        }

        $idkec = $rwcek['KecPerusahaan'];
        $sqlkec = mysqli_query($connwil, "SELECT * FROM districts where id='$idkec'");
        if ($sqlkec->num_rows > 0) {
            $rwpkec = mysqli_fetch_assoc($sqlkec);
            $kec = $rwpkec['name'];
        } else {
            $kec = "";
        }

        $idkota = $rwcek['KotaPerusahaan'];
        $sqlkab = mysqli_query($connwil, "SELECT * FROM regencies where id='$idkota'");
        if ($sqlkab->num_rows > 0) {
            $rwpkab = mysqli_fetch_assoc($sqlkab);
            $kab = $rwpkab['name'];
        } else {
            $kab = "";
        }

        $idprov = $rwcek['ProvPerusahaan'];
        $sqlprov = mysqli_query($connwil, "SELECT * FROM provinces where id='$idprov'");
        if ($sqlprov->num_rows > 0) {
            $rwprov = mysqli_fetch_assoc($sqlprov);
            $prov = $rwprov['name'];
        } else {
            $prov = "";
        }

        echo json_encode(array(
            "statusCode" => 200,
            "kode" =>  $rwcek['KodePerusahaan'],
            "nama" =>  $rwcek['NamaPerusahaan'],
            "alamat" =>  $rwcek['AlamatPerusahaan'],
            "kel" =>  $kel,
            "kec" =>  $kec,
            "kab" =>  $kab,
            "prov" =>  $prov,
            "idkel" =>  $idkel,
            "idkec" =>  $idkec,
            "idkab" =>  $idkota,
            "idprov" =>  $idprov,
            "telp" =>  $rwcek['TelpPerusahaan'],
            "email" =>  $rwcek['EmailPerusahaan'],
            "web" =>  $rwcek['WebsitePerusahaan'],
            "npwp" =>  $rwcek['NPWPPerusahaan'],
            "stat" =>  $rwcek['StatPerusahaan'],
        ));
        return;
    }
} else if ($stt == "edit") {
    $id = $_POST['id'];
    $kode = str_replace("'", "", $_POST['kode']);
    $nama = str_replace("'", "", $_POST['nama']);
    $alamat = str_replace("'", "", $_POST['alamat']);
    $prov = $_POST['prov'];
    $kab =  $_POST['kab'];
    $kec =  $_POST['kec'];
    $kel = $_POST['kel'];
    $status = $_POST['status'];

    if (isset($_POST['telp'])) {
        $telp = str_replace("'", "", $_POST['telp']);
    } else {
        $telp = "";
    }

    if (isset($_POST['email'])) {
        $email = str_replace("'", "", $_POST['email']);
    } else {
        $email = "";
    }

    if (isset($_POST['web'])) {
        $web = str_replace("'", "", $_POST['web']);
    } else {
        $web = "";
    }

    if (isset($_POST['npwp'])) {
        $npwp = str_replace("'", "", $_POST['npwp']);
    } else {
        $npwp = "";
    }

    $sqlcek = mysqli_query($conn, "SELECT * FROM tbmperusahaan where (Kodeperusahaan='" . $kode . "' OR NamaPerusahaan='" . $nama . "') AND IdPerusahaan<>" . $id);

    if ($sqlcek->num_rows > 0) {
        echo json_encode(array("statusCode" => 201, "pesan" => "Kode atau nama perusahaan sudah digunakan"));
        return;
    } else {
        $instperus = mysqli_query($conn, "UPDATE tbmperusahaan SET KodePerusahaan='" . $kode . "', NamaPerusahaan='" . $nama . "', AlamatPerusahaan='" . $alamat .
            "', KelPerusahaan='" . $kel . "', KecPerusahaan='" . $kec . "', KotaPerusahaan='" . $kab . "', ProvPerusahaan='" . $prov . "', TelpPerusahaan='" . $telp .
            "', EmailPerusahaan='" . $email . "', WebsitePerusahaan='" . $web . "', NPWPPerusahaan='" . $npwp . "', StatPerusahaan='" . $status .
            "', TglJamBuat='" . $tglnow . "' WHERE IdPerusahaan=" . $id);

        if ($instperus) {
            $instaudit = mysqli_query($conn, "INSERT INTO tbmaudit (TipeData, JenisData, IdData, NamaData, TglEdit, IdPerusahaan, IdUser) 
            VALUES ('EDIT','Perusahaan'," . $id . ",'" . $nama . "','" . $tglnow . "'," . $id . "," . $iduser . ")");

            echo json_encode(array("statusCode" => 200, "pesan" => "Data Perusahaan berhasil diedit"));
        } else {
            echo json_encode(array("statusCode" => 201, "pesan" => "Data Perusahaan gagal diedit"));
        }
    }
}
