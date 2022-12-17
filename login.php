<?php

// include 'dbconn.php';

// error_reporting(0);

session_start();

if (isset($_SESSION['idusermsys'])) {
  $userid = $_SESSION['idusermsys'];

  if ($userid != "") {
    header("Location: menu.php");
  }
}

if (isset($_COOKIE['unmsys']) && isset($_COOKIE['sdmsys'])) {
  $lgusr = $_COOKIE['unmsys'];
  $snd = $_COOKIE['sdmsys'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Csrf Token -->
  <meta name="csrf-token" content="<?= $_SESSION['csrf_tkn'] ?>">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Main System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-message-box@3.2.2/dist/messagebox.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-message-box@3.2.2/dist/messagebox.min.css">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel='stylesheet' href='css/sweetalert2.min.css'>
  <script src="js/sweetalert2.all.min.js"></script>
</head>

<body>
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row icon-boxes" style="margin-top:-50px;">
        <div id="loginPanel" style='background:rgba(255,255,255,0.5)' class="col-lg-6 col-xl-6 col-sm-12 offset-xl-3 border rounded shadow-sm">
          <div class="p-5">
            <div class="text-center">
              <p class="h4 mb-4 font-weight-bold">Administration Integrated System</p>
              <hr>
              <p class="h4 font-weight-bold">Selamat Datang</p>
              <p class="h5 mb-4">Silahkan login untuk memulai aplikasi</p>
            </div>

            <form id="form_login" action="" class="user" method="POST">
              <div class="form-group mb-4">
                <div class="input-group">
                  <input type="email" class="form-control" id="fuser" name="fuser" placeholder=" Ketikkan Email Anda" value="">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <small id="txtemail_err"></small><br>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <input type="password" class="form-control" id="fsandi" name="fsandi" placeholder="Ketikkan Sandi Anda" value="">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                  <small id="txtemail_err"></small><br>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="fingat" id="fingat" value="">
                      <label class="custom-control-label " for="fingat"> Ingatkan Saya</label>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 text-right">
                  <a class="" href="lupasandi.php">Lupa Sandi?</a>
                </div>

              </div>
            </form>
            <button id="login" name="login" class="btn btn-user btn-block mb-4" style="background-color:#00005c; color: white;">Login</button>
            <p class="text-center">
              --------- atau hubungkan dengan ---------
            </p>
            <button id="login" name="login" class="btn btn-user btn-block mt-4" style="background-color:#00005c; color: white;"><i class="fab fa-windows"></i> Microsoft</button>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End login -->

  <script>
    $(document).ready(function() {

      $.LoadingOverlaySetup({
        background: "rgba(255, 255, 255, 1)"
      });

      $("#fuser").focus();

      $.loginuser = function() {
        var data = $('#form_login').serialize();
        var usr = $("#fuser").val();
        var sandi = $("#fsandi").val();
        var ingatsaya = document.getElementById("fingat").checked;

        if (usr == "") {
          swal('Error', 'Isi Email', 'error');
          return;
        }

        if (sandi == "") {
          swal('Error', 'Isi Sandi', 'error');
          return;
        }

        if (usr != "" && sandi != "") {
          // $("#loginPanel").LoadingOverlay("show");
          $.post('aksilogin', {
              user: usr,
              sandi: sandi,
              ingatsaya: ingatsaya
            },
            function(data) {
              // alert(data);
              var dataResult = JSON.parse(data);
              if (dataResult.statusCode == 200) {
                // $("#hero").LoadingOverlay("show");
                // $.LoadingOverlay("show");
                window.location.href = 'menu.php';
                $("#loginPanel").LoadingOverlay("hide");
              } else {
                swal('Error', dataResult.log, 'error', );
              }
            });
        }
      }

      $("#login").click(function() {
        $.loginuser();
        // window.location.href = "menu.php";
      });

      $("#fuser").keypress(function(e) {
        if (e.which == 13) {
          $("#fsandi").focus();
          //return false; 
        }
      });

      $("#fsandi").keypress(function(e) {
        if (e.which == 13) {
          $.loginuser();
          //return false;  
        }
      });
    });
  </script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script type="text/javascript" charset="utf8" src="assets/loadingoverlay.min.js"></script>
  <!--script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script-->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html