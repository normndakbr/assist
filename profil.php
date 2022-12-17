<?php

session_start();
include "dbconn.php";
$idUser = $_SESSION['idusermsys'];

$sqlcek = mysqli_query($conn, "SELECT * FROM tbmuser WHERE idUser=" . $idUser);
if ($sqlcek->num_rows > 0) {
    $rwcek = mysqli_fetch_assoc($sqlcek);
    $nama = $rwcek['namaUser'];
    $email = $rwcek['emailLogin'];
    $tglAktif = date("d-M-Y", strtotime($rwcek['tglAktif']));
    $tglExp = date("d-M-Y", strtotime($rwcek['tglKadaluarsa']));
    $picUser = $rwcek['picUser'];

    if ($picUser == "") {
        $picUser = "image/profile.png";
    }

    $idKary = $rwcek['idKary'];
    $sqlprofil = mysqli_query($conn, "SELECT * FROM tbmprofil WHERE idUser=" . $idUser);
    if ($sqlprofil->num_rows > 0) {
        $rwprofil = mysqli_fetch_assoc($sqlprofil);

        if ($rwprofil['namaDisplay'] != "") {
            $namakary = $rwprofil['namaDisplay'];
        } else {
            $namakary = "-";
        }

        if ($rwprofil['nikKary'] != "") {
            $nik = $rwprofil['nikKary'];
        } else {
            $nik = "-";
        }

        if ($rwprofil['perusahaan'] != "") {
            $namaPer = $rwprofil['perusahaan'];
        } else {
            $namaPer = "-";
        }

        if ($rwprofil['depart'] != "") {
            $depart = $rwprofil['depart'];
        } else {
            $depart = "-";
        }

        if ($rwprofil['divisi'] != "") {
            $divisi = $rwprofil['divisi'];
        } else {
            $divisi = "-";
        }

        if ($rwprofil['posisi'] != "") {
            $jabatan = $rwprofil['posisi'];
        } else {
            $jabatan = "-";
        }
    } else {
        $namakary = "-";
        $nik = "-";
        $namaPer = "-";
        $depart = "-";
        $divisi = "-";
        $jabatan = "-";
    }
} else {
    $nama = "-";
    $email = "-";
    $tglAktif = "-";
    $tglExp = "-";
    $picUser = "image/profile.png";
    $idKary = "0";
    $namakary = "-";
    $nik = "-";
    $namaPer = "-";
    $depart = "-";
    $divisi = "-";
    $jabatan = "-";
}

?>

<div class="position-relative" data-aos="fade-up" data-aos-delay="100">
    <div class="row icon-boxes bg-white" style="margin-top:10px;">
        <div id="loginPanel" class="col-lg-12 col-xl-12 col-sm-12 border shadow-sm">
            <div class="">
                <div class="row">
                    <div class="col-lg-4 text-center p-5 bg-primary">
                        <div>
                            <div class="imgProfil" style="margin-top:25%;">
                                <a title="Klik untuk mengganti gambar profil" href="#"><img src=<?php echo $picUser; ?> class="img-circle" style="height: 200px;width:200px;border-radius: 50%;border:5px solid white;"></a>
                            </div>
                        </div>

                        <div class="mt-3">
                            <p class="h3 font-weight-bold text-white"><b><?php echo $nama; ?></b></p>
                            <p class="h5 mb-4 text-white"><i><?php echo $email; ?></i></p>
                            <input type="hidden" id="txtIdUser" value="<?php echo $idUser; ?>">
                        </div>
                    </div>

                    <div class="col-lg-8" style="border-left:1px solid;border-color:lightgrey;">
                        <div class="row">
                            <div class="col-lg-12 p-3">
                                <div class="form-group" style="text-align:end; font-size:x-large;">
                                    <a title="Edit Profil" href="#" id="btnEditProfil"><i class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 p-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="h5 font-weight-bold"><i>Email Akun</i></p>
                                            <p class="h4 mb-4"><b><?php echo $email; ?></b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="h5 font-weight-bold"><i>Nama</i></p>
                                            <p class="h4 mb-4"><b><?php echo $namakary; ?></b></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <p class="h5 font-weight-bold"><i>NIK</i></p>
                                            <p class="h4 mb-4"><b><?php echo $nik; ?></b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="h5 font-weight-bold"><i>Perusahaan</i></p>
                                            <p class="h4 mb-4"><b><?php echo $namaPer; ?></b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="h5 font-weight-bold"><i>Departemen</i></p>
                                            <p class="h4 mb-4"><b><?php echo $depart; ?></b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="h5 font-weight-bold"><i>Section</i></p>
                                            <p class="h4 mb-4"><b><?php echo $divisi; ?></b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="h5 font-weight-bold"><i>Jabatan</i></p>
                                            <p class="h4 mb-4"><b><?php echo $jabatan; ?></b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <hr>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <p class="h5 font-weight-bold"><i>Tanggal Aktif</i></p>
                                                    <p class="h4 mb-4"><b><?php echo $tglAktif; ?></b></p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <p class="h5 font-weight-bold"><i>Tanggal Expired</i></p>
                                                    <p class="h4 mb-4"><b><?php echo $tglExp; ?></b></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".imgProfil", function() {
        $("#mdlgantipic").modal("show");
    });

    $(document).on("click", "#btnEditProfil", function() {
        var nama = "<?php echo $namakary; ?>";
        var email = "<?php echo $email; ?>";
        var iduser = "<?php echo $idUser; ?>";
        var namaPer = "<?php echo $namaPer; ?>";
        var depart = "<?php echo $depart; ?>";
        var divisi = "<?php echo $divisi; ?>";
        var jabatan = "<?php echo $jabatan; ?>";
        var nik = "<?php echo $nik; ?>";

        // alert(iduser);
        if (nama == "-" || nama == "") {
            nama = "";
        }

        if (namaPer == "-" || namaPer == "") {
            namaPer = "";
        }

        if (depart == "-" || depart == "") {
            depart = "";
        }

        if (divisi == "-" || divisi == "") {
            divisi = "";
        }

        if (jabatan == "-" || jabatan == "") {
            jabatan = "";
        }

        if (nik == "-" || nik == "") {
            nik = "";
        }

        $("#mdleditprofil").modal("show");
        $("#txtemaileditprofil").val(email);
        $("#txtnamaeditprofil").val(nama);
        $("#txtnikeditprofil").val(nik);
        $("#jdleditprofil").text(" Edit Profil : " + email);
        $("#lstperusahaaneditprofil").val(namaPer);
        $("#txtidusreditprofil").val(iduser);
        $("#lstdeparteditprofil").val(depart);
        $("#lstdiveditprofil").val(divisi);
        $("#lstposisieditprofil").val(jabatan);
    });
</script>