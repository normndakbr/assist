<?php

// include 'dbconn.php';

// error_reporting(0);

session_start();

if (!isset($_SESSION['idusermsys'])) {
  header("Location: login.php");
}

if (isset($_SESSION['namaaliaslogmsys'])) {
  $namaUser =  $_SESSION['namaaliaslogmsys'];
} else {
  $namaUser = "";
}

$aksesakun = $_SESSION['aksesakunmsys'];
if ($aksesakun == "T") {
  $akun = "none";
} else {
  $akun = "block";
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
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.dataTables.css">
  <link rel="stylesheet" href="assets/select2.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="js/sweetalert2.all.min.js"></script>

  <style>
    .form-group .select2-container {
      position: relative;
      z-index: 2;
      float: left;
      width: 100%;
      margin-bottom: 0;
      display: table;
      table-layout: fixed;
    }

    .kotak_app {
      cursor: pointer;
    }
  </style>
</head>

<body class="overflow-hidden">
  <div class="content">
    <header id="header" class="fixed-top d-flex justify-content-end" style="background-color:rgba(255, 255, 255, 0.5);">
      <div class="btn-group">
        <div class="mt-3 font-weight-bold" id="txtberandamain" onClick="frmmain();"><a href="#">Beranda</a></div>
        <div style="padding-left:20px;display:<?php echo $akun; ?>" class="mt-3 font-weight-bold" id="txtnamausermsys">
          <a href="#" class="dropdown-toggle" id="btnprofile" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data Master</a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuBtn">
            <!--li><a class="dropdown-item" href="#" onClick="frmperusahaan();">Perusahaan</a></!-->
            <!--li><a class="dropdown-item" href="#" onClick="frmkaryawan();">Karyawan</a></!-->
            <li><a class="dropdown-item" href="#" onClick="frmuser();">Akun</a></li>
          </ul>
        </div>
        <!--div style="padding-left:20px;" class="mt-3 font-weight-bold" id="txtnamausermsys"><a href="#">Pengaturan</a></div-->
        <div style="padding-left:20px;" class="mt-3 font-weight-bold" id="txtnamausermsys"> | </div>
        <div style="padding-left:15px;" class="mt-3 font-weight-bold" id="txtnamausermsys"><b><?php echo $namaUser; ?></b></div>
        <a class="nav-link mr-5 dropdown-toggle" href="#" id="btnprofile" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="image/profile.png" class="img-circle" style="height: 40px;width:40px;border-radius: 50%;border:0px solid;">
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuBtn">
          <li><a class="dropdown-item" onclick="callProfil();" href="#">Profil</a></li>
          <li><a class="dropdown-item" onclick="callGantiSandi();" href="#">Ganti Sandi</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a></li>
        </ul>
      </div>
    </header><!-- End Header -->
  </div>

  <!-- ======= Hero Section ======= -->
  <section id="hero" name="" class="align-items-center">
    <div id="menu1" class="container position-relative align-items-center " data-aos="fade-up" data-aos-delay="100">
    </div>

    <!-- Modal tambah perusahaan -->
    <div class=" modal fade" id="mdlpertambah" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:90%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-building"></i> <small id="jdltambahper"> Perusahaan</small></h5>
          </div>

          <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#tbdetper" type="button" role="tab" aria-controls="tbdetper" aria-selected="false"><i class="fa fa-list"></i></button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tbtambahperusahaan" type="button" role="tab" aria-controls="tbtambahperusahaan" aria-selected="false"><i class="fas fa-plus"></i></button>
              </li>
            </ul>

            <div class="tab-content" id="tbdetailperusahaan">
              <div class="tab-pane fade show active" id="tbdetper" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <div class="col-lg-2 col-md-12 col-sm-12 mt-3">
                    <button id="btnrefreshperusahaan" class="btn font-weight-bold btn-primary" titile="Refresh Perusahaan" style='color:white;' value=""><i class="fas fa-sync-alt"></i></button>
                  </div>
                </div>
                <div id="tabelperusahaan" class="data mt-3"></div>
              </div>

              <div class="tab-pane fade" id="tbtambahperusahaan" role="tabpanel" aria-labelledby="profile-tab">
                <form id="frmperusahaan" METHOD="POST" action="">
                  <div class="row mt-3 p-3">
                    <div class="col-lg-2 col-md-12 col-sm-12">
                      <label for="txtkodepertambah"><span class="text-danger"> *</span> Kode : </label><br>
                      <input type="text" class="form-control form-control-user" name="txtkodepertambah" id="txtkodepertambah" value="">
                      <input type="hidden" name="idperusahaantambah" id="idperusahaantambah">
                      <small id="txtkodepertambah_err" class="text-danger"></small><br>
                    </div>

                    <div class="col-lg-10 col-md-12 col-sm-12">
                      <label for="txtnamapertambah"><span class="text-danger"> *</span> Nama Perusahaan :</label><br>
                      <input type="text" class="form-control form-control-user" name="txtnamapertambah" id="txtnamapertambah" value="">
                      <small id="txtkodepertambah_err" class="text-danger"></small><br>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <label for="txtalamatpertambah"><span class="text-danger"> *</span> Alamat Perusahaan :</label><br>
                      <input type="text" class="form-control form-control-user" name="txtalamatpertambah" id="txtalamatpertambah" value="">
                      <small id="txtalamatpertambah_err" class="text-danger"></small><br>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                      <label for="lstprovpertambah"><span class="text-danger"> *</span> Provinsi :</label><br>
                      <select class="form-control form-control-user" name="lstprovpertambah" id="lstprovpertambah"></select>
                      <small id="lstprovpertambah_err" class="text-danger"></small><br>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                      <label for="lstkabpertambah"><span class="text-danger"> *</span> Kabupaten :</label><br>
                      <select class="form-control form-control-user" name="lstkabpertambah" id="lstkabpertambah"></select>
                      <small id="lstkabpertambah_err" class="text-danger"></small><br>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                      <label for="lstkecpertambah"><span class="text-danger"> *</span> Kecamatan :</label><br>
                      <select class="form-control form-control-user" name="lstkecpertambah" id="lstkecpertambah"></select>
                      <small id="lstkecpertambah_err" class="text-danger"></small><br>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                      <label for="lstkelpertambah"><span class="text-danger"> *</span> Kelurahan :</label><br>
                      <select class="form-control form-control-user" name="lstkelpertambah" id="lstkelpertambah"></select>
                      <small id="lstkelpertambah_err" class="text-danger"></small><br>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12">
                      <label for="txttelppertambah">Telepon :</label><br>
                      <input type="text" class="form-control form-control-user" name="txttelppertambah" id="txttelppertambah" value=""><br>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12">
                      <label for="txtemailpertambah">Email :</label><br>
                      <input type="email" class="form-control form-control-user" name="txtemailpertambah" id="txtemailpertambah" value=""><br>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12">
                      <label for="txtwebpertambah">Website :</label><br>
                      <input type="text" class="form-control form-control-user" name="txtwebpertambah" id="txtwebpertambah" value=""><br>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12">
                      <label for="txtnpwppertambah">NPWP Perusahaan :</label><br>
                      <input type="text" class="form-control form-control-user" name="txtnpwppertambah" id="txtnpwppertambah" value=""><br>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12">
                      <button type="button" name="btnsimpanpertambah" id="btnsimpanpertambah" class="btn font-weight-bold btn-primary">Simpan Data</button>
                      <button type="button" name="btnkeluarpertambah" id="btnkeluarpertambah" class="btn font-weight-bold btn-danger">Batal</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
            <hr>
            <button type="button" name="btnselesaipertambah" id="btnselesaipertambah" class="btn font-weight-bold btn-danger">Selesai</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal posisi edit-->
    <div class="modal fade" id="mdlalamatper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="margin-left: auto; margin-right: auto;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title" id="jdlalamatper"><i class="fas fa-info-circle"></i> Detail Alamat Perusahaan</h5>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="txtalamatperdetalamat">Alamat :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtalamatperdetalamat" id="txtalamatperdetalamat" value="" readonly><br>
                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="txtkelperdetalamat">Kelurahan :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtkelperdetalamat" id="txtkelperdetalamat" value="" readonly><br>
                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="txtkecperdetalamat">Kecamatan :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtkecperdetalamat" id="txtkecperdetalamat" value="" readonly>
                    <input id='idperalamat' type="hidden" value=""><br>
                  </div>

                  <div class="col-lg-6 col-md-4 col-sm-12">
                    <label for="txtkabperdetalamat">Kabupaten / Kota :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtkabperdetalamat" id="txtkabperdetalamat" value="" readonly><br>
                  </div>

                  <div class="col-lg-6 col-md-4 col-sm-12">
                    <label for="txtprovperdetalamat">Provinsi :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtprovperdetalamat" id="txtprovperdetalamat" value="" readonly><br>
                  </div>
                </div>

                <div class="modal-footer d-flex justify-content-center" style="margin-top:10px;">
                  <hr>
                  <button type="button" name="btnselesaiperdetail" id="btnselesaiperdetail" class="btn font-weight-bold btn-danger">Selesai</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal edit perusahaan -->
    <div class=" modal fade" id="mdlperedit" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:90%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-edit"></i> <small id="jdleditper">Perusahaan</small></h5>
          </div>

          <div class="modal-body">
            <div class="row p-2">
              <div class="col-lg-2 col-md-12 col-sm-12">
                <label for="txtkodeperedit">Kode :</label><br>
                <input type="text" class="form-control form-control-user" name="txtkodeperedit" id="txtkodeperedit" value="">
                <input type="hidden" name="idperusahaanedit" id="idperusahaanedit"><br>
              </div>

              <div class="col-lg-10 col-md-12 col-sm-12">
                <label for="txtnamaperedit">Nama Perusahaan :</label><br>
                <input type="text" class="form-control form-control-user" name="txtnamaperedit" id="txtnamaperedit" value="">
                <input id='idperpenerbitedit' type="hidden" value=""><br>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="txtalamatperedit">Alamat Perusahaan :</label><br>
                <input type="text" class="form-control form-control-user" name="txtalamatperedit" id="txtalamatperedit" value="">
                <input id='idperpenerbitedit' type="hidden" value=""><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstprovperedit">Provinsi :</label><br>
                <select class="form-control form-control-user" name="lstprovperedit" id="lstprovperedit"> </select>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstkabperedit">Kabupaten :</label><br>
                <select class="form-control form-control-user" name="lstkabperedit" id="lstkabperedit"></select><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstkecperedit">Kecamatan :</label><br>
                <select class="form-control form-control-user" name="lstkecperedit" id="lstkecperedit"> </select>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstkelperedit">Kelurahan :</label><br>
                <select class="form-control form-control-user" name="lstkelperedit" id="lstkelperedit"></select><br>
              </div>

              <div class="col-lg-2 col-md-12 col-sm-12">
                <label for="txttelpperedit">Telepon :</label><br>
                <input type="text" class="form-control form-control-user" name="txttelpperedit" id="txttelpperedit" value="">
                <input id='idperpenerbitedit' type="hidden" value=""><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="txtemailperedit">Email :</label><br>
                <input type="email" class="form-control form-control-user" name="txtemailperedit" id="txtemailperedit" value="">
                <input id='idperpenerbitedit' type="hidden" value=""><br>
              </div>

              <div class="col-lg-2 col-md-12 col-sm-12">
                <label for="txtwebperedit">Website :</label><br>
                <input type="text" class="form-control form-control-user" name="txtwebperedit" id="txtwebperedit" value="">
                <input id='idperpenerbitedit' type="hidden" value=""><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="txtnpwpperedit">NPWP Perusahaan :</label><br>
                <input type="text" class="form-control form-control-user" name="txtnpwpperedit" id="txtnpwpperedit" value="">
                <input id='idperpenerbitedit' type="hidden" value=""><br>
              </div>

              <div class="col-lg-2 col-md-4 col-sm-12">
                <label for="txtstatperedit">Status :</label><br>
                <select class="form-control form-control-user" name="txtstatperedit" id="txtstatperedit">
                  <option value='AKTIF'>AKTIF</option>
                  <option value='NONAKTIF'>NONAKTIF</option>
                </select><br>
              </div>

            </div>
          </div>

          <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
            <hr>
            <button type="button" name="btnsimpanperedit" id="btnsimpanperedit" class="btn font-weight-bold btn-primary">Update Data</button>
            <button type="button" name="btnkeluarperedit" id="btnkeluarperedit" class="btn font-weight-bold btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <div class=" modal fade" id="mdlperdetail" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:90%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-asterisk"></i><small id="jdldetailper">Perusahaan</small></h5>
          </div>

          <div class="modal-body">
            <div class="row p-2">
              <div class="col-lg-2 col-md-12 col-sm-12">
                <label for="txtkodeperdetail">Kode :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txtkodeperdetail" id="txtkodeperdetail" value="" disabled><br>
              </div>

              <div class="col-lg-10 col-md-12 col-sm-12">
                <label for="txtnamaperdetail">Nama Perusahaan :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txtnamaperdetail" id="txtnamaperdetail" value="" disabled><br>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="txtalamatperdetail">Alamat Perusahaan :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txtalamatperdetail" id="txtalamatperdetail" value="" disabled><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstprovperdetail">Provinsi :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="lstprovperdetail" id="lstprovperdetail" disabled>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstkabperdetail">Kabupaten :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="lstkabperdetail" id="lstkabperdetail" disabled><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstkecperdetail">Kecamatan :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="lstkecperdetail" id="lstkecperdetail" disabled>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstkelperdetail">Kelurahan :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="lstkelperdetail" id="lstkelperdetail" disabled><br>
              </div>

              <div class="col-lg-2 col-md-12 col-sm-12">
                <label for="txttelpperdetail">Telepon :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txttelpperdetail" id="txttelpperdetail" value="" disabled><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="txtemailperdetail">Email :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txtemailperdetail" id="txtemailperdetail" value="" disabled>
                <input id='idperpenerbitdetail' type="hidden" value=""><br>
              </div>

              <div class="col-lg-2 col-md-12 col-sm-12">
                <label for="txtwebperdetail">Website :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txtwebperdetail" id="txtwebperdetail" value="" disabled><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="txtnpwpperdetail">NPWP Perusahaan :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txtnpwpperdetail" id="txtnpwpperdetail" value="" disabled><br>
              </div>

              <div class="col-lg-2 col-md-4 col-sm-12">
                <label for="txtstatperdetail">Status :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="txtstatperdetail" id="txtstatperdetail" disabled><br>
              </div>

            </div>
          </div>

          <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
            <hr>
            <button type="button" name="btnkeluarperdetail" id="btnkeluarperdetail" class="btn font-weight-bold btn-danger">Selesai</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal tambah user -->
    <div class=" modal fade" id="mdlusertambah" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:90%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-users"></i></i> <small id="jdltambahuser"> Akun</small></h5>
          </div>

          <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#tbdtakun" type="button" role="tab" aria-controls="tbdtakun" aria-selected="false"><i class="fa fa-list"></i></button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tbtambahakun" type="button" role="tab" aria-controls="tbtambahakun" aria-selected="false"><i class="fas fa-plus"></i></button>
              </li>
            </ul>

            <div class="tab-content" id="tbdetailperusahaan">
              <div class="tab-pane fade show active" id="tbdtakun" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <div class="col-lg-2 col-md-12 col-sm-12 mt-3">
                    <button id="btnrefreshakun" class="btn font-weight-bold btn-primary" titile="Refresh Akun" style='color:white;' value=""><i class="fas fa-sync-alt"></i></button>
                  </div>
                </div>
                <div id="tabelakun" class="data mt-3"></div>
              </div>

              <div class="tab-pane fade" id="tbtambahakun" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="frmuser" METHOD="POST" action="">
                      <div class="row mt-3 p-3">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                          <label for="txtemailakun"><span class="text-danger"> *</span> Email :</label><br>
                          <input type="email" class="form-control form-control-user" id="txtemailakun" name="txtemailakun" value="">
                          <small class="text-danger" id="txtemailakun_err"></small><br>
                        </div>

                        <div class="col-lg-8 col-md-12 col-sm-12">
                          <label for="txtnamaakun"><span class="text-danger"> *</span> Nama :</label><br>
                          <input type="text" class="form-control form-control-user" id="txtnamaakun" name="txtnamaakun" value="">
                          <small class="text-danger" id="txtnamaakun_err"></small><br>
                        </div>

                        <div class="col-lg-3 col-md-12 col-sm-12">
                          <label for="lstaksesakun"><span class="text-danger"> *</span> Akses Buat Akun :</label><br>
                          <select type="text" class="form-control form-control-user" id="lstaksesakun" name="lstaksesakun" value="">
                            <option value="T">Tidak</option>
                            <option value="Y">Ya</option>
                          </select>
                          <small class="text-danger" id="txtnamaakun_err"></small><br>
                        </div>

                        <div class="col-lg-3 col-md-12 col-sm-12">
                          <label for="dtptglaktifakun"><span class="text-danger"> *</span> Tanggal Aktif :</label><br>
                          <input type="date" class="form-control form-control-user" id="dtptglaktifakun" name="dtptglaktifakun" value="">
                          <small class="text-danger" id="dtptglaktifakun_err"></small><br>
                        </div>

                        <div class="col-lg-3 col-md-12 col-sm-12">
                          <label for="dtptglkadaluarsaakun"><span class="text-danger"> *</span> Tanggal Expired :</label><br>
                          <input type="date" class="form-control form-control-user" id="dtptglkadaluarsaakun" name="dtptglkadaluarsaakun" value="">
                          <small class="text-danger" id="dtptglkadaluarsaakun_err"></small><br>
                        </div>
                      </div>
                    </form>

                    <div class="row" style="padding-right:15px;">
                      <div class="col-lg-12 col-md-12 col-sm-12 text-end">
                        <button id="btnsimpanakun" class="btn font-weight-bold btn-primary" style='color:white;' value="">Buat Akun</button>
                        <button id="btnresetakun" class="btn font-weight-bold btn-danger" value="">Reset</button>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 text-end">
                        <hr>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>

          <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
            <hr>
            <button type="button" name="btnselesaiakuntambah" id="btnselesaiakuntambah" class="btn font-weight-bold btn-danger">Selesai</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal tambah user -->
    <div class=" modal fade" id="mdlappuser" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-users"></i></i> <small id="jdltambahappuser"> Akun</small></h5>
          </div>

          <div class="modal-body">
            <div class="row mt-3 p-3">
              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstapps"><span class="text-danger"> *</span> Aplikasi :</label><br>
                <select class="form-control form-control-user" id="lstapps" name="lstapps" value=""></select>
                <small class="text-danger" id="lstapps_err"></small>
                <input type="hidden" id="txtiduser" name="txtiduser"><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lsttipeakses"><span class="text-danger"> *</span> Akses :</label><br>
                <select class="form-control form-control-user" id="lsttipeakses" name="lsttipeakses" value=""></select>
                <small class="text-danger" id="lsttipeakses_err"></small><br>
              </div>

              <div style="margin-top:25px;" class="col-lg-2 col-md-12 col-sm-12">
                <button id="btnsimpanappakun" class="btn font-weight-bold btn-primary" titile="Simpan Aplikasi" style='color:white;' value=""><i class="fas fa-save"></i></button>
                <br>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 p-3">
                <div id="tabeltipeakses" class="data mt-3"></div>
                <br>
              </div>
            </div>
          </div>

          <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
            <hr>
            <button type="button" name="btnselesaitipeakun" id="btnselesaitipeakun" class="btn font-weight-bold btn-danger">Selesai & Kirim Email Aktivasi</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal tambah user -->
    <div class=" modal fade" id="mdlappdetail" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-users"></i></i> <small id="jdlappdetail"> Aplikasi Akun</small></h5>
          </div>

          <div class="modal-body">
            <div class="row mt-3 p-3">
              <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="txtemailappdetail">Email :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" id="txtemailappdetail" name="txtemailappdetail" value="" disabled><br>
              </div>

              <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="txtnamaappdetail">Nama :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" id="txtnamaappdetail" name="txtnamaappdetail" value="" disabled>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="dtptglaktifappdetail">Tanggal Aktif :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="dtptglaktifappdetail" id="dtptglaktifappdetail" value="" disabled><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="dtptglkdappdetail">Tanggal Expired :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="dtptglkdappdetail" id="dtptglkdappdetail" value="" disabled><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lstaksesakundetail">Akses Akun :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="lstaksesakundetail" id="lstaksesakundetail" value="" disabled><br>
              </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <label for="lststatusappdetail">Status :</label><br>
                <input type="text" style="background-color:white;" class="form-control form-control-user" name="lststatusappdetail" id="lststatusappdetail" value="" disabled><br>
              </div>
            </div>

            <div class="row p-3">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="tabelappdetail" class="data"></div>
              </div>
            </div>
          </div>

          <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
            <hr>
            <button type="button" name="btnselesaappdetail" id="btnselesaappdetail" class="btn font-weight-bold btn-danger">Selesai</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal edit user -->
    <div class="modal fade" id="mdleditakun" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-edit"></i></i> <small id="jdleditakun">Edit Akun</small></h5>
          </div>

          <div class="modal-body">
            <div class="row mt-3 p-3">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="txtemailakunedit">Email :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtemailakunedit" id="txtemailakunedit" value="">
                    <input type="hidden" name="iduseredit" id="iduseredit" value=""><br>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="txtnamaakunedit">Nama :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtnamaakunedit" id="txtnamaakunedit" value="">
                    <small style="font-style:italic" class="text-danger justify-content-end" id="txtnamaakunedit_err"></small><br>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="dtptglaktifakunedit">Tanggal Aktif :</label><br>
                    <input type="date" class="form-control form-control-user" name="dtptglaktifakunedit" id="dtptglaktifakunedit" value="">
                    <small style="font-style:italic" class="text-danger justify-content-end" id="dtptglaktifakunedit_err"></small><br>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="dtptglkdakunedit">Tanggal Expired :</label><br>
                    <input type="date" class="form-control form-control-user" name="dtptglkdakunedit" id="dtptglkdakunedit" value="">
                    <small style="font-style:italic" class="text-danger justify-content-end" id="dtptglkdakunedit_err"></small><br>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="lstaksesakunedit">Status :</label><br>
                    <select type="text" class="form-control form-control-user" name="lstaksesakunedit" id="lstaksesakunedit" value="">
                      <option value="Y">YA</option>
                      <option value="T">TIDAK</option>
                    </select><br>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="lststatusakunedit">Status :</label><br>
                    <select type="text" class="form-control form-control-user" name="lststatusakunedit" id="lststatusakunedit" value="">
                      <option value="AKTIF">AKTIF</option>
                      <option value="NONAKTIF">NONAKTIF</option>
                    </select><br>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="tabelappedit" class="data"></div>
                  </div>

                  <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
                    <hr>
                    <button type="button" name="btnupdateakunedit" id="btnupdateakunedit" class="btn font-weight-bold btn-primary">Update Data</button>
                    <button type="button" name="btnbatalakunedit" id="btnbatalakunedit" class="btn font-weight-bold btn-danger">Batal</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal ganti sandi -->
    <div class="modal fade" id="mdlgantisandi" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:40%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-edit"></i></i> <small id="jdlgantisandi">Ganti Sandi</small></h5>
          </div>

          <div class="modal-body">
            <div class="row mt-3 p-3">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="txtSandiLama">Sandi Lama :</label><br>
                    <input type="password" class="form-control form-control-user" name="txtSandiLama" id="txtSandiLama" value="">
                    <small style="font-style:italic" class="text-danger justify-content-end" id="txtSandiLama_err"></small><br>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="txtSandiBaru">Sandi Baru :</label><br>
                    <input type="password" class="form-control form-control-user" name="txtSandiBaru" id="txtSandiBaru" value="">
                    <small style="font-style:italic" class="text-danger" id="txtSandiBaru_err"></small><br>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="txtUlangSandiBaru">Konfirmasi Sandi Baru :</label><br>
                    <input type="password" class="form-control form-control-user" name="txtUlangSandiBaru" id="txtUlangSandiBaru" value="">
                    <small style="font-style:italic" class="text-danger" id="txtUlangSandiBaru_err"></small><br>
                  </div>

                  <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
                    <hr>
                    <button type="button" name="btnBatalGantiSandi" id="btnBatalGantiSandi" class="btn font-weight-bold btn-danger">Batal</button>
                    <button type="button" name="btnSimpanSandi" id="btnSimpanSandi" class="btn font-weight-bold btn-primary">Simpan Sandi</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal ganti sandi -->
    <div class="modal fade" id="mdlgantipic" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:30%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-edit"></i></i> <small id="jdlgantisandi">Foto Profil</small></h5>
          </div>

          <div class="modal-body">
            <div class="row p-5">
              <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <div class="imgProfil">
                  <img href="#"><img src="image/profile.png" class="img-circle" style="height: 300px;width:300px;border-radius: 50%;border:5px solid white;">
                </div>
                <input id="txtUploadProfile" type="file" style="display:none;">
                <button type="button" name="btnPilihFoto" id="btnPilihFoto" class="btn font-weight-bold btn-primary mt-4">Pilih Foto</button>
                <br>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
              <hr>
              <button type="button" name="btnBatalFoto" id="btnBatalFoto" class="btn font-weight-bold btn-danger">Batal</button>
              <button type="button" name="btnSimpanFoto" id="btnSimpanFoto" class="btn font-weight-bold btn-primary">Simpan Foto</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal edit profile-->
    <div class="modal fade" id="mdleditprofil" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:70%;">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#00005c;color: white; ">
            <h5 class="modal-title"><i class="fas fa-edit"></i></i> <small id="jdleditprofil">Edit Akun</small></h5>
          </div>

          <div class="modal-body">
            <div class="row mt-3 p-3">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-4 col-md-12 col-sm-12">
                    <label for="txtemaileditprofil">Email :</label><br>
                    <input type="email" class="form-control form-control-user" name="txtemaileditprofil" id="txtemaileditprofil" value="" disabled><br>
                  </div>

                  <div class="col-lg-4 col-md-12 col-sm-12">
                    <label for="txtnamaeditprofil">Nama Alias :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtnamaeditprofil" id="txtnamaeditprofil" value="">
                    <small style="font-style:italic" class="text-danger" id="txtnamaeditprofil_err"></small>
                    <input type="hidden" name="txtidusreditprofil" id="txtidusreditprofil" value=""><br>
                  </div>

                  <div class="col-lg-4 col-md-12 col-sm-12">
                    <label for="txtnikeditprofil">NIK :</label><br>
                    <input type="text" class="form-control form-control-user" name="txtnikeditprofil" id="txtnikeditprofil" value=""><br>
                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="lstperusahaaneditprofil">Perusahaan :</label><br>
                    <input type="text" class="form-control form-control-user" name="lstperusahaaneditprofil" id="lstperusahaaneditprofil" value=""><br>
                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="lstdeparteditprofil">Departemen :</label><br>
                    <input type="text" class="form-control form-control-user" name="lstdeparteditprofil" id="lstdeparteditprofil" value=""><br>
                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="lstdiveditprofil">Section :</label><br>
                    <input type="text" class="form-control form-control-user" name="lstdiveditprofil" id="lstdiveditprofil" value=""><br>
                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="lstposisieditprofil">Jabatan :</label><br>
                    <input type="text" class="form-control form-control-user" name="lstposisieditprofil" id="lstposisieditprofil" value=""><br>
                  </div>
                </div>

                <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
                  <hr>
                  <button type="button" name="btnupdateeditprofil" id="btnupdateeditprofil" class="btn font-weight-bold btn-primary">Update Profil</button>
                  <button type="button" name="btnbataleditprofil" id="btnbataleditprofil" class="btn font-weight-bold btn-danger">Batal</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

    <!-- Modal tambah user -->
    <div class=" modal fade" id="mdlappuseredit" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="margin-left: auto; margin-right: auto;max-width:50%;">
        <div class="modal-content">
          <div class="modal-header" style="background-image: linear-gradient(to right, #1e81b0, #00005c);color:white">
            <h5 class="modal-title"><i class="fas fa-users"></i></i> <small id="jdltambahappuseredit"> Akun</small></h5>
          </div>

          <div class="modal-body">
            <div class="row mt-3 p-3">

              <div class="col-lg-5 col-md-12 col-sm-12">
                <label for="lstappsedit"><span class="text-danger"> *</span> Aplikasi :</label><br>
                <select class="form-control form-control-user" id="lstappsedit" name="lstappsedit" value=""></select>
                <small class="text-danger" id="lstapps_err"></small>
                <input type="hidden" id="txtiduseredit" name="txtiduser"><br>
              </div>

              <div class="col-lg-5 col-md-12 col-sm-12">
                <label for="lsttipeaksesedit"><span class="text-danger"> *</span> Akses :</label><br>
                <select class="form-control form-control-user" id="lsttipeaksesedit" name="lsttipeaksesedit" value=""></select>
                <small class="text-danger" id="lsttipeakses_err"></small><br>
              </div>

              <div style="margin-top:25px;" class="col-lg-2 col-md-12 col-sm-12">
                <button id="btnsimpanappakunedit" class="btn font-weight-bold btn-primary" titile="Simpan Aplikasi" style='color:white;' value="">Simpan Data</button>
                <br>
              </div>
            </div>
          </div>

          <div class="modal-footer d-flex justify-content-end" style="margin-top:10px;">
            <hr>
            <button type="button" name="btnselesaitipeakunedit" id="btnselesaitipeakunedit" class="btn font-weight-bold btn-danger">Selesai</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Keluar dari system?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">Pilih "Keluar" jika anda ingin mengakhiri pekerjaan.</div>
          <div class="modal-footer">
            <button id="btnBatalKeluarApp" class="btn btn-danger" type="button">Batal</button>
            <button id="btnKeluarApp" class="btn btn-primary" type="button">Keluar</button>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

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

    function frmperusahaan() {
      $("#mdlpertambah").modal("show");

      $('#lstkabpertambah').html("<option value=''>-- Pilih Kabupaten Kota --</option>");
      $('#lstkabpertambah').select2({
        dropdownParent: $('#mdlpertambah'),
        theme: "bootstrap4",
      });

      $('#lstkecpertambah').html("<option value=''>-- Pilih Kecamatan --</option>");
      $('#lstkecpertambah').select2({
        dropdownParent: $('#mdlpertambah'),
        theme: "bootstrap4",
      });

      $('#lstkelpertambah').html("<option value=''>-- Pilih Kelurahan --</option>");
      $('#lstkelpertambah').select2({
        dropdownParent: $('#mdlpertambah'),
        theme: "bootstrap4",
      });

      $.post('cariprov?stt=prov', {},
        function(data) {
          $('#lstprovpertambah').html(data);

          $('#lstprovpertambah').select2({
            dropdownParent: $('#mdlpertambah'),
            theme: "bootstrap4",
          });
        });
      $("#tabelperusahaan").load("fetch_perusahaan.php");
    }

    function callGantiSandi() {
      $("#txtSandiLama").val("");
      $("#txtSandiBaru").val("");
      $("#txtUlangSandiBaru").val("");
      $("#txtSandiLama_err").text("");
      $("#txtSandiBaru_err").text("");
      $("#txtUlangSandiBaru_err").text("");
      $("#mdlgantisandi").modal("show");
    }

    function callProfil() {
      $("#menu1").empty();
      $("#menu1").load("profil.php");
    }

    function frmuser() {
      $("#mdlusertambah").modal("show");
    }

    function frmmenuutama() {
      $("#menu1").empty();
      $("#menu1").load("menuUtama.php");
    }

    function frmmain() {
      window.location.href = "menu.php";
    }

    frmmenuutama();

    var isNS = (navigator.appName == "Netscape") ? 1 : 0;
    if (navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN || Event.MOUSEUP);

    function mischandler() {
      return false;
    }

    function mousehandler(e) {
      var myevent = (isNS) ? e : event;
      var eventbutton = (isNS) ? myevent.which : myevent.button;
      if ((eventbutton == 2) || (eventbutton == 3)) return false;
    }
    document.oncontextmenu = mischandler;
    document.onmousedown = mousehandler;
    document.onmouseup = mousehandler;
  </script>

  <!-- Vendor JS Files -->
  <script src="jquery-3.5.1.min.js"></script>
  <script src="assets/select2.full.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script type="text/javascript" charset="utf8" src="assets/loadingoverlay.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="assets/jquery.dataTables.min.js"></script>

  <script>
    $("#loginPanel").LoadingOverlay("hide");

    $(document).ready(function() {
      $("#btnselesaiperdetail").click(function() {
        $("#mdlalamatper").modal('hide');
      });

      $("#btnselesaappdetail").click(function() {
        $("#mdlappdetail").modal('hide');
      });

      $("#btnbatalakunedit").click(function() {
        $("#mdleditakun").modal('hide');
      });

      $("#btnBatalGantiSandi").click(function() {
        $("#mdlgantisandi").modal('hide');
      });

      $("#btnBatalKeluarApp").click(function() {
        $("#logoutModal").modal('hide');
      });

      $("#btnKeluarApp").click(function() {
        window.location.href = "logout.php";
      });

      $(function() {
        $('#txtSandiLama').on('input', function(e) {
          $("#txtSandiLama_err").text("");
        });

        $('#txtSandiBaru').on('input', function(e) {
          $("#txtSandiBaru_err").text("");
        });

        $('#txtUlangSandiBaru').on('input', function(e) {
          $("#txtUlangSandiBaru_err").text("");
        });
      });

      $("#btnBatalFoto").click(function() {
        $("#mdlgantipic").modal("hide");
      });

      $("#btnbataleditprofil").click(function() {
        $("#mdleditprofil").modal("hide");
      });

      // $("#btnupdateakunedittambah").click(function() {
      //   $("#mdlappuseredit").modal("show");
      // });

      $("#btnselesaitipeakunedit").click(function() {
        $("#mdlappuseredit").modal("hide");
      });

      $("#btnupdateeditprofil").click(function() {
        var nama = $("#txtnamaeditprofil").val();
        var nik = $("#txtnikeditprofil").val();
        var perusahaan = $("#lstperusahaaneditprofil").val();
        var depart = $("#lstdeparteditprofil").val();
        var divisi = $("#lstdiveditprofil").val();
        var posisi = $("#lstposisieditprofil").val();
        var iduser = $("#txtidusreditprofil").val();

        if (nama == "") {
          nama_err = "Nama wajib diisi";
        } else {
          nama_err = "";
        }

        // alert(iduser);

        if (nama_err == "") {
          // $.LoadingOverlay('show');
          $.ajax({
            type: 'POST',
            url: 'aksiakun?stt=profil',
            data: {
              iduser: iduser,
              nik: nik,
              nama: nama,
              perusahaan: perusahaan,
              depart: depart,
              divisi: divisi,
              posisi: posisi
            },
            timeout: 10000,
            success: function(dtAkary) {
              // alert(dtAkary);
              var datakary = JSON.parse(dtAkary);
              if (datakary.statusCode == 200) {
                swal('Berhasil', datakary.pesan, 'info');
                $("#menu1").empty();
                $("#menu1").load("profil.php");
                $("#mdleditprofil").modal('hide');
              } else {
                swal('Error', datakary.pesan, 'error');
              }
            }
          });
        } else {
          $("#txtnamaeditprofil_err").text(nama_err);
        }
      });

      $(document).on("click", "#btnPilihFoto", function(e) {
        e.preventDefault();
        $("#txtUploadProfile").trigger("click")
      });

      $("#btnupdateakunedit").click(function() {
        var nama = $("#txtnamaakunedit").val();
        var tglaktif = $("#dtptglaktifakunedit").val();
        var tglkd = $("#dtptglkdakunedit").val();
        var iduser = $("#iduseredit").val();
        var stat = $("#lststatusakunedit").val();
        var aksesakun = $("#lstaksesakunedit").val();

        if (nama == "") {
          nama_err = "Isi nama";
        } else {
          nama_err = "";
        }

        if (tglaktif == "") {
          tglaktif_err = "Isi tanggal Aktif";
        } else {
          tglaktif_err = "";
        }

        if (tglkd == "") {
          tglkd_err = "Isi tanggal kadaluarsa";
        } else {
          tglkd_err = "";
        }

        if (tglaktif > tglkd) {
          tglsalah = "Atur tanggal aktif dan expired dengan benar";
          return;
        }

        if (nama_err == "" && tglaktif_err == "" && tglkd_err == "") {
          $.LoadingOverlay('show');
          $.ajax({
            type: 'POST',
            url: 'aksiakun?stt=edit',
            data: {
              iduser: iduser,
              nama: nama,
              tglaktif: tglaktif,
              tglkd: tglkd,
              stat: stat,
              aksesakun: aksesakun
            },
            timeout: 10000,
            success: function(dtAkary) {
              // alert(dtAkary);
              var datakary = JSON.parse(dtAkary);
              if (datakary.statusCode == 200) {
                $("#tabelakun").load("fetch_akun.php");
                swal('Berhasil', datakary.pesan, 'info');
                // $("#mdleditakun").modal('hide');
              } else {
                swal('Error', datakary.pesan, 'error');
              }
            }
          });
        } else {
          $("#txtnamaakunedit_err").text(nama_err);
          $("#dtptglaktifakunedit_err").text(tglaktif_err);
          $("#dtptglkdakunedit_err").text(tglkd_err);
        }
      });

      $("#btnSimpanSandi").click(function() {
        var lama = $("#txtSandiLama").val();
        var baru = $("#txtSandiBaru").val();
        var ulang = $("#txtUlangSandiBaru").val();

        if (lama == "") {
          lama_err = "Isi sandi lama anda";
        } else {
          lama_err = "";
        }

        if (baru == "") {
          baru_err = "Isi sandi baru anda";
        } else {
          baru_err = "";
        }

        if (ulang == "") {
          ulang_err = "Isi konfimasi ulang sandi baru anda";
        } else {
          ulang_err = "";
        }

        if (ulang != "" && baru != "") {
          if (ulang != baru) {
            sama_err = "Sandi baru dan konfirmasi sandi baru tidak sama";
          } else {
            sama_err = "";
          }
        } else {
          sama_err = "";
        }

        if (lama_err == "" && baru_err == "" && ulang_err == "" && sama_err == "") {
          $.LoadingOverlay("show");
          $.ajax({
            type: 'POST',
            url: "aksisandi",
            data: {
              lama: lama,
              baru: baru,
              ulang: ulang
            },
            timeout: 20000,
            success: function(data) {
              alert(data);
              var dtresult = JSON.parse(data);
              if (dtresult.statusCode == 200) {
                $.LoadingOverlay("hide");
                swal('Berhasil', dtresult.pesan, 'info');
                $("#txtSandiLama").val("");
                $("#txtSandiBaru").val("");
                $("#txtUlangSandiBaru").val("");
                $("#txtSandiLama_err").text("");
                $("#txtSandiBaru_err").text("");
                $("#txtUlangSandiBaru_err").text("");
              } else {
                $.LoadingOverlay("hide");
                swal('Error', dtresult.pesan, 'error');
              }
            }
          });
        } else {
          $("#txtSandiLama_err").text(lama_err);
          $("#txtSandiBaru_err").text(baru_err);

          if (ulang_err != "") {
            $("#txtUlangSandiBaru_err").text(ulang_err);
          } else if (sama_err != "") {
            $("#txtUlangSandiBaru_err").text(sama_err);
          }

        }
      });

      $("#btnselesaitipeakun").click(function() {
        var iduser = $("#txtiduser").val();

        if (iduser != "") {
          $.LoadingOverlay('show');
          $.ajax({
            type: 'POST',
            url: "aksiakun?stt=selesai",
            data: {
              iduser: iduser
            },
            timeout: 20000,
            success: function(dtAbsen) {
              // alert(dtAbsen);
              dtuser = JSON.parse(dtAbsen);
              if (dtuser.statusCode == 200) {
                swal('Berhasil', dtuser.pesan, 'info');
                $("#mdlappuser").modal('hide');
                $.LoadingOverlay('Hide');
              } else {
                swal('Error', dtuser.pesan, 'error');
                $.LoadingOverlay('Hide');
              }
            }
          });
        }

        $("#mdlappuser").modal('hide');
      });

      $("#btnselesaiakuntambah").click(function() {
        $("#mdlusertambah").modal('hide');
      });

      $("#btnselesaipertambah").click(function() {
        $("#mdlpertambah").modal('hide');
      });

      $("#btnsimpanappakunedit").click(function() {
        var iduser = $("#txtiduseredit").val();
        var idapp = $("#lstappsedit").val();
        var idakses = $("#lsttipeaksesedit").val();

        if (idapp == "") {
          idapp_err = "Pilih aplikasi";
          swal('Error', idapp_err, 'error');
        } else {
          idapp_err = "";
        }

        if (idakses == "") {
          idakses_err = "Pilih akses aplikasi";
          swal('Error', idakses_err, 'error');
        } else {
          idakses_err = "";
        }

        if (idapp_err == "" && idakses_err == "") {
          $.LoadingOverlay('show');
          $.ajax({
            type: 'POST',
            url: "aksiakun?stt=akses",
            data: {
              iduser: iduser,
              idapp: idapp,
              idakses: idakses
            },
            timeout: 20000,
            success: function(dtAbsen) {
              // alert(dtAbsen);
              dtuser = JSON.parse(dtAbsen);
              if (dtuser.statusCode == 200) {
                $("#tabelappedit").load("fetch_appedit.php?iduser=" + iduser);
                swal('Berhasil', dtuser.pesan, 'info');
                $("#mdlappuseredit").modal('show');
              } else {
                swal('Error', dtuser.pesan, 'error');
                $.LoadingOverlay('Hide');
              }
            }
          });
        }
      });

      $("#btnsimpanappakun").click(function() {
        var iduser = $("#txtiduser").val();
        var idapp = $("#lstapps").val();
        var idakses = $("#lsttipeakses").val();

        if (idapp == "") {
          idapp_err = "Pilih aplikasi";
          swal('Error', idapp_err, 'error');
        } else {
          idapp_err = "";
        }

        if (idakses == "") {
          idakses_err = "Pilih akses aplikasi";
          swal('Error', idakses_err, 'error');
        } else {
          idakses_err = "";
        }

        if (idapp_err == "" && idakses_err == "") {
          $.LoadingOverlay('show');
          $.ajax({
            type: 'POST',
            url: "aksiakun?stt=akses",
            data: {
              iduser: iduser,
              idapp: idapp,
              idakses: idakses
            },
            timeout: 20000,
            success: function(dtAbsen) {
              // alert(dtAbsen);
              dtuser = JSON.parse(dtAbsen);
              if (dtuser.statusCode == 200) {
                $("#tabeltipeakses").load("fetch_appuser.php?iduser=" + iduser);
                $("#tabelakun").load("fetch_akun.php");
                swal('Berhasil', dtuser.pesan, 'info');
                // $("#mdlakunperbaru").modal('show');
                // $("#tabelperakun").load("fetch_akunperusahaan.php");
                // $.LoadingOverlay('Hide');
              } else {
                swal('Error', dtuser.pesan, 'error');
                $.LoadingOverlay('Hide');
              }
            }
          });
        }
      });

      $("#btnsimpanakun").click(function() {
        var email = $("#txtemailakun").val().trim().replace("'", "");
        var nama = $("#txtnamaakun").val().trim().replace("'", "");
        var tglaktif = $("#dtptglaktifakun").val();
        var aksesakun = $("#lstaksesakun").val();
        var tglkadaluarsa = $("#dtptglkadaluarsaakun").val();
        var iduser = 0;

        if (email == "") {
          email_err = "Isi email aktif";
          swal('Error', email_err, 'error');
        } else {
          email_err = "";
          if (IsEmail(email) == false) {
            swal('Error', 'Isi email dengan benar', 'error');
            return;
          }
        }

        if (nama == "") {
          nama_err = "Isi nama akun";
          swal('Error', nama_err, 'error');
        } else {
          nama_err = "";
        }

        if (tglaktif == "") {
          tglaktif_err = "Isi tanggal aktif";
          swal('Error', tglaktif_err, 'error');
        } else {
          tglaktif_err = "";
        }

        if (tglkadaluarsa == "") {
          tglkadaluarsa_err = "Isi tanggal expired";
          swal('Error', tglkadaluarsa_err, 'error');
        } else {
          tglkadaluarsa_err = "";
        }

        if (tglaktif > tglkadaluarsa) {
          tglsalah = "Atur tanggal aktif dan expired dengan benar";
          swal('Error', tglsalah, 'error');
          return;
        }

        if (email_err == "" && nama_err == "" && tglaktif_err == "" && tglkadaluarsa_err == "") {
          $.LoadingOverlay('show');
          $.ajax({
            type: 'POST',
            url: "aksiakun?stt=simpan",
            data: {
              email: email,
              nama: nama,
              tglaktif: tglaktif,
              aksesakun: aksesakun,
              tglkadaluarsa: tglkadaluarsa
            },
            timeout: 20000,
            success: function(dtAbsen) {
              // alert(dtAbsen);
              dtuser = JSON.parse(dtAbsen);
              if (dtuser.statusCode == 200) {
                var iduser = dtuser.iduser;

                // alert(iduser);
                $("#txtiduser").val(iduser);
                $("#mdlappuser").modal("show");
                $("#tabeltipeakses").load("fetch_appuser.php?iduser=" + iduser);
                $("#jdltambahappuser").text(" Akses Aplikasi Akun : " + email + " | " + nama);

                $.post("cariapps?stt=app", {},
                  function(data) {
                    $("#lstapps").html(data);
                    $("#lsttipeakses").html("<option value=''>-- Data akses tidak ditemukan --</option>");
                  });

                $("#tabelakun").load("fetch_akun.php");
                $("#txtemailakun").val('');
                $("#txtnamaakun").val('');
                $("#dtptglaktifakun").val('');
                $("#dtptglkadaluarsaakun").val('');
                // swal('Berhasil', dtuser.pesan, 'info');
                // $("#mdlakunperbaru").modal('show');
                // $("#tabelperakun").load("fetch_akunperusahaan.php");
                // $.LoadingOverlay('Hide');
              } else {
                swal('Error', dtuser.pesan, 'error');
                $.LoadingOverlay('Hide');
              }
            }
          });
        }

      });

      $('#lstappsedit').change(function() {
        var idapp = $('#lstappsedit').val();

        if (idapp != "") {
          $.post('cariapps?stt=akses', {
              idapp: idapp
            },
            function(data) {
              // alert(data);
              $('#lsttipeaksesedit').html(data);
            });
        } else {
          $('#lsttipeaksesedit').html("<option value=''> -- Tipe akses tidak ditemukan --</option>");
        }
      });

      $('#lstapps').change(function() {
        var idapp = $('#lstapps').val();

        if (idapp != "") {
          $.post('cariapps?stt=akses', {
              idapp: idapp
            },
            function(data) {
              // alert(data);
              $('#lsttipeakses').html(data);
            });
        } else {
          $('#lsttipeakses').html("<option value=''> -- Tipe akses tidak ditemukan --</option>");
        }
      });

      $('#lstprovpertambah').change(function() {
        var prov = $('#lstprovpertambah').val();

        if (prov != "") {
          $.post('carikabupaten', {
              kdprov: prov
            },
            function(data) {
              // alert(data);
              $('#lstkabpertambah').html(data);
            });

          $('#lstkecpertambah').html("<option value=''> -- Pilih Kecamatan --</option>");
          $('#lstkelpertambah').html("<option value=''> -- Pilih Kelurahan --</option>");

        } else {
          $('#lstkabpertambah').html("<option value=''> -- Pilih Kabupaten Kota --</option>");
          $('#lstkecpertambah').html("<option value=''> -- Pilih Kecamatan --</option>");
          $('#lstkelpertambah').html("<option value=''> -- Pilih Kelurahan --</option>");
        }
      });

      $('#lstkabpertambah').change(function() {
        var kab = $('#lstkabpertambah').val();

        if (kab != "") {
          $.post('carikec', {
              kdkota: kab
            },
            function(data) {
              $('#lstkecpertambah').html(data);
            });

          $('#lstkecpertambah').html("<option value=''> -- Pilih Kecamatan --</option>");
          $('#lstkelpertambah').html("<option value=''> -- Pilih Kelurahan --</option>");
        } else {
          $('#lstkecpertambah').html("<option value=''> -- Pilih Kecamatan --</option>");
          $('#lstkelpertambah').html("<option value=''> -- Pilih Kelurahan --</option>");
        }
      });

      $('#lstkecpertambah').change(function() {
        var kec = $('#lstkecpertambah').val();

        if (kec != "") {
          $.post('carikel', {
              kdkec: kec
            },
            function(data) {
              $('#lstkelpertambah').html(data);
            });
        } else {
          $('#lstkelpertambah').html("<option value=''> -- Pilih Kelurahan --</option>");
        }

      });

    });

    $.post('carimenu', {},
      function(data) {
        $("#lsttipeakun").html(data);
      });

    $("#tabelakun").load("fetch_akun.php");

    $("#btnresetakun").click(function() {
      $("#txtnamaakun").val('');
      $("#txtemailakun").val('');
      $("#dtptglaktifakun").val('');
      $("#dtptglkadaluarsaakun").val('');
    });

    $("#btnrefreshakun").click(function() {
      $("#tabelakun").LoadingOverlay("show");
      $("#tabelakun").load("fetch_akun.php");
    });

    $("#btnrefreshperusahaan").click(function() {
      $("#tabelperusahaan").LoadingOverlay("show");
      $("#tabelperusahaan").load("fetch_perusahaan.php");
    });

    $("#dtptglaktifakun").change(function() {
      var tglaktif = $("#dtptglaktifakun").val()

      $.post('aksiakun?stt=tglaktif', {
          tglaktif: tglaktif
        },
        function(data) {
          // alert(data)
          $("#dtptglkadaluarsaakun").val(data);
        });
    });

    $("#btnkeluarperdetail").click(function() {
      $("#mdlperdetail").modal("hide");
    });

    $("#btnkeluarperedit").click(function() {
      $("#mdlperedit").modal("hide");
    });

    $("#btnsimpanperedit").click(function() {
      var id = $('#idperusahaanedit').val();
      var kode = $("#txtkodeperedit").val().trim().replace("'", "");
      var nama = $("#txtnamaperedit").val().trim().replace("'", "");
      var alamat = $("#txtalamatperedit").val().trim().replace("'", "");
      var prov = $("#lstprovperedit").val();
      var kab = $("#lstkabperedit").val();
      var kec = $("#lstkecperedit").val();
      var kel = $("#lstkelperedit").val();
      var telp = $("#txttelpperedit").val().trim().replace("'", "");
      var email = $("#txtemailperedit").val().trim().replace("'", "");
      var web = $("#txtwebperedit").val().trim().replace("'", "");
      var npwp = $("#txtnpwpperedit").val().trim().replace("'", "");
      var status = $("#txtstatperedit").val();

      if (kode == "") {
        kode_err = "Isi kode perusahaan";
        swal('Error', kode_err, 'error');
        return;
      } else {
        kode_err = "";
      }

      if (nama == "") {
        nama_err = "Isi nama perusahaan";
        swal('Error', nama_err, 'error');
        return;
      } else {
        nama_err = "";
      }

      if (prov == "") {
        prov_err = "Pilih provinsi";
        swal('Error', prov_err, 'error');
        return;
      } else {
        prov_err = "";
      }

      if (kab == "") {
        kab_err = "Pilih kabupaten / kota";
        swal('Error', kab_err, 'error');
        return;
      } else {
        kab_err = "";
      }

      if (kec == "") {
        kec_err = "Pilih kecamatan";
        swal('Error', kec_err, 'error');
        return;
      } else {
        kec_err = "";
      }

      if (kel == "") {
        kel_err = "Pilih kelurahan";
        swal('Error', kel_err, 'error');
        return;
      } else {
        kel_err = "";
      }

      if (kode_err == "" && nama_err == "" && prov_err == "" && kab_err == "" && kec_err == "" && kel_err == "") {
        $.LoadingOverlay("show");
        $.ajax({
          type: 'POST',
          url: "aksiperusahaan?stt=edit",
          data: {
            kode: kode,
            nama: nama,
            alamat: alamat,
            prov: prov,
            kab: kab,
            kec: kec,
            kel: kel,
            telp: telp,
            email: email,
            web: web,
            npwp: npwp,
            status: status,
            id: id
          },
          success: function(dataResult) {
            // alert(dataResult);
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $.post('cariprov?stt=prov', {},
                function(data) {
                  $('#lstprovperedit').html(data);
                  $('#lstprovperedit').select2({
                    dropdownParent: $('#mdlperedit'),
                    theme: "bootsrap4"
                  });

                  $('#lstkabperedit').html("<option value=''> -- Pilih Kabupaten Kota --</option>");
                  $('#lstkecperedit').html("<option value=''> -- Pilih Kecamatan --</option>");
                  $('#lstkelperedit').html("<option value=''> -- Pilih Kelurahan --</option>");

                });

              $("#tabelperusahaan").load("fetch_perusahaan.php");
              swal('Berhasil', dataResult.pesan, 'info');
              $("#mdlperedit").modal('hide');
            } else {
              $.LoadingOverlay("hide");
              swal('Error', dataResult.pesan, 'error');
            }
          }
        });
      }
    });

    $("#btnsimpanpertambah").click(function() {
      var kode = $('#txtkodepertambah').val().trim().replace("'", "");
      var nama = $('#txtnamapertambah').val().trim().replace("'", "");
      var alamat = $('#txtalamatpertambah').val().trim().replace("'", "");
      var prov = $('#lstprovpertambah').val();
      var kab = $('#lstkabpertambah').val();
      var kec = $('#lstkecpertambah').val();
      var kel = $('#lstkelpertambah').val();

      if (kode == "") {
        kode_err = "Isi kode perusahaan";
        swal('Error', kode_err, 'error');
        return;
      } else {
        kode_err = "";
      }

      if (nama == "") {
        nama_err = "Isi nama perusahaan";
        swal('Error', nama_err, 'error');
        return;
      } else {
        nama_err = "";
      }

      if (alamat == "") {
        alamat_err = "Isi alamat perusahaan";
        swal('Error', alamat_err, 'error');
        return;
      } else {
        alamat_err = "";
      }

      if (prov == "") {
        prov_err = "Pilih provinsi";
        swal('Error', prov_err, 'error');
        return;
      } else {
        prov_err = "";
      }

      if (kab == "") {
        kab_err = "Pilih kabupaten";
        swal('Error', kab_err, 'error');
        return;
      } else {
        kab_err = "";
      }

      if (kec == "") {
        kec_err = "Pilih kecamatan";
        swal('Error', kode_err, 'error');
        return;
      } else {
        kec_err = "";
      }

      if (kel == "") {
        kel_err = "Pilih kelurahan";
        swal('Error', kel_err, 'error');
        return;
      } else {
        kel_err = "";
      }

      if (kode_err == "" && nama_err == "" && alamat_err == "" && prov_err == "" && kab_err == "" &&
        kec_err == "" && kel_err == "") {
        var data = $('#frmperusahaan').serialize();
        $.LoadingOverlay("show");
        $.ajax({
          type: 'POST',
          url: "aksiperusahaan?stt=simpan",
          data: data,
          success: function(dataResult) {
            // alert(dataResult);
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $('#txtkodepertambah').val('');
              $('#txtnamapertambah').val('');
              $('#txtalamatpertambah').val('');
              $.post('cariprov?stt=prov', {},
                function(data) {
                  $('#lstprovpertambah').html(data);
                  $('#lstkabpertambah').html("<option value=''> -- Pilih Kabupaten Kota --</option>");
                  $('#lstkecpertambah').html("<option value=''> -- Pilih Kecamatan --</option>");
                  $('#lstkelpertambah').html("<option value=''> -- Pilih Kelurahan --</option>");

                });
              $('#txttelppertambah').val('');
              $('#txtemailpertambah').val('');
              $('#txtwebpertambah').val('');
              $('#txtnpwppertambah').val('');

              $("#tabelperusahaan").load("fetch_perusahaan.php");
              swal('Berhasil', dataResult.pesan, 'info');
              $.LoadingOverlay("hide");
            } else {
              swal('Error', dataResult.pesan, 'error');
              $.LoadingOverlay("hide");
            }
          }
        });
      } else {
        $('#txtkodepertambah_err').text(kode_err);
        $('#txtnamapertambah_err').text(nama_err);
        $('#txtalamatpertambah_err').text(alamat_err);
        $('#lstprovpertambah_err').text(prov_err);
        $('#lstkabpertambah_err').text(kab_err);
        $('#lstkecpertambah_err').text(kec_err);
        $('#lstkelpertambah_err').text(kel_err);
      }

    });
  </script>
  <script src="assets/js/main.js"></script>

</body>

</html>