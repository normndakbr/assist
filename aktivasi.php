<?php
// Create database connection using config file
include "dbconn.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sqlcek = mysqli_query($conn, "Select * from tbmuser where token='" . $token . "'");

    if ($sqlcek->num_rows > 0) {
        $rwuser = mysqli_fetch_assoc($sqlcek);
        $email = $rwuser['emailLogin'];
        $nama = $rwuser['namaUser'];
    } else {
        header("Location: http://localhost:8080/IndeximLP/erroraktivasi.php");
    }
} else {
    header("Location: http://localhost:8080/IndeximLP/erroraktivasi.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-tkn" content="<?= $_SESSION['csrf_tkn'] ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Main System</title>

    <script src="assets/jquery-3.3.1.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='css/sweetalert2.min.css'>
    <script type="text/javascript" src="chartjs/Chart.js"></script>
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.dataTables.css">
</head>

<body>
    <div class="container">
        <div class="hd">
        </div>
        <br>
        <br>
        <br>

        <div class="content shadow rounded bg-white">
            <div class="content rounded-top" style='background-color:#00005c;'>
                <br>
                <h3 style='text-align: center; font-weight:bold; color: yellow;'>Aktivasi akun Administration Integrated System</h3>
                <h5 style='text-align: center; color: white;'>Dengan membuat sandi baru, maka akun anda telah aktif :</h5>
                <br>
            </div>
            <br>

            <div class="container bg_white text-Align:Center">
                <label for="txtemail">Email :</label><br>
                <input type="text" class="form-control form-control-user" name="txtemail" id="txtemail" value="<?php echo $email; ?>" readonly>
                <input type="hidden" name="txttoken" id="txttoken" value="<?php echo $token; ?>"><br>
                <label for="txtnama">Nama :</label><br>
                <input type="text" class="form-control form-control-user" name="txtnama" id="txtnama" value="<?php echo $nama; ?>" readonly><br>
                <label for="txtsandibaru">Sandi Baru :</label><br>
                <input type="password" class="form-control form-control-user" name="txtsandibaru" id="txtsandibaru" placeholder="Ketikkan sandi anda minimal 6 huruf" value=""><br>
                <label for="txtulangsandi">Konfirmasi Ulang Sandi :</label><br>
                <input type="password" class="form-control form-control-user" name="txtulangsandi" id="txtulangsandi" placeholder="Ketikkan ulang sandi anda minimal 6 huruf" value=""><br>
                <div class="row text-center">
                    <div class="col-lg-12">
                        <button id="btnsimpansandi" class="btn font-weight-bold btn-primary" style='color:white;' value="">Aktivasi Akun</button>
                    </div>
                    <br>
                </div>
                <br>
            </div>
        </div>
        <br>
    </div>

    <script src="jquery-3.5.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script type='text/javascript' src="dist/jquery.inputmask.bundle.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="assets/loadingoverlay.min.js"></script>


    <script>
        $(document).ready(function() {
            $("#btnsimpansandi").click(function() {
                var btnaktif = $("#btnsimpansandi").text();

                if (btnaktif == "Aktivasi Akun") {
                    var token = $("#txttoken").val();
                    var email = $("#txtemail").val();
                    var sandi = $("#txtsandibaru").val();
                    var ulangsandi = $("#txtulangsandi").val();

                    if (sandi == "") {
                        sandi_err = "Isi sandi anda";
                        swal('Error', sandi_err, 'error');
                    } else {
                        var jmlsandi = $("#txtsandibaru").val().length;

                        if (jmlsandi < 6) {
                            swal('Error', 'Sandi minimal 6 karakter', 'error');
                            return;
                        }

                        sandi_err = "";
                    }

                    if (ulangsandi == "") {
                        ulangsandi_err = "Isi konfirmasi ulang sandi";
                        swal('Error', ulangsandi_err, 'error');
                    } else {
                        ulangsandi_err = "";
                    }

                    if (sandi_err == "" && ulangsandi_err == "") {
                        if (sandi != ulangsandi) {
                            swal('Error', 'Sandi baru dan konfirmasi ulang sandi tidak cocok', 'error');
                            return;
                        } else {
                            $.LoadingOverlay('show');
                            $.ajax({
                                type: 'POST',
                                url: "aksiakun?stt=aktivasi",
                                data: {
                                    email: email,
                                    token: token,
                                    sandi: sandi
                                },
                                success: function(dataResult) {
                                    // alert(dataResult);
                                    var dtResult = JSON.parse(dataResult);
                                    if (dtResult.statusCode == 200) {
                                        $("#txtsandibaru").prop('disabled', true);
                                        $("#txtulangsandi").prop('disabled', true);
                                        $("#btnsimpansandi").text('Login');
                                        swal('Berhasil', dtResult.pesan, 'info');
                                        $.LoadingOverlay('Hide');
                                    } else {
                                        swal('Error', dtResult.pesan, 'error');
                                        $.LoadingOverlay('Hide');
                                    }
                                }
                            });
                        }
                    }
                } else {
                    window.location.href = 'http://localhost:8080/IndeximLP/';
                }
            });
        });
    </script>
</body>

</html>