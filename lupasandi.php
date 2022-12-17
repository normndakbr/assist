<?php

include 'dbconn.php';

error_reporting(0);

if (isset($_POST['email'])) {
  $eml = $_POST['email'];

  $sql = "SELECT * FROM tbmuser WHERE EmailLogin='$eml'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['email'];
    header("Location: dashboard.php");
  } else {
    echo "<script>alert('email anda tidak terdaftar')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Main System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='css/sweetalert2.min.css'>
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
        <div style='background:rgba(255,255,255,0.5)' class="col-lg-6 offset-3 col-lg-6 col-xl-6 col-sm-12 offset-xl-3 border rounded shadow-sm">
          <div class="p-5">
            <div class="text-center">
              <p class="h4 mb-4 font-weight-bold">Administration Integrated System</p>
              <hr>
              <p class="h5 text-gray-900 mb-4">Ketikkan Email Yang Terdaftar</p>
            </div>
            <form id="form_login" action="" class="user" method="POST">
              <div class="form-group">
                <input type="email" class="form-control text-center" name="email" id="email" aria-describedby="emailHelp" placeholder="Ketikkan Email Anda..." value="" required>
              </div>
            </form>
            <button id="kirim" name="kirim" class="btn btn-user btn-block" style="background-color:#00005c; color: white;">Kirim Link</button>
            <hr>
            <div class="text-center">
              <a class="medium" href="login.php">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End login -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>
    function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if (!regex.test(email)) {
        return false;
      } else {
        return true;
      }
    }

    $(document).ready(function() {

      $("#kirim").click(function() {
        var email = $("#email").val();

        if (email == "") {
          email_err = 'Isi email anda';
          swal('Error', email_err, 'error');
          return;
        } else {
          if (IsEmail(email) == false) {
            swal('Error', 'Isi email dengan benar', 'error');
            return;
          }

          $.LoadingOverlay('show');
          $.ajax({
            type: 'POST',
            url: "aksiakun?stt=lupasandi",
            data: {
              email: email,
            },
            success: function(dataResult) {
              // alert(dataResult);
              var dtResult = JSON.parse(dataResult);
              if (dtResult.statusCode == 200) {
                $("#email").val('');
                window.location.href = "sukseskirim.php";
                $.LoadingOverlay('hide');
              } else {
                swal('Error', dtResult.pesan, 'error');
                $.LoadingOverlay('Hide');
              }
            }
          });
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

</html>