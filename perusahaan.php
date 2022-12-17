<?php

// session_start();

?>
<div class="col-xl-12 col-lg-12 d-xl-block d-lg-block d-md-block d-sm-none">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-image: linear-gradient(to right, #1e81b0, #00005c);">
            <h6 class="m-0 font-weight-bold" style="color: white;"><i class="fas fa-building"></i> Data Perusahaan</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <!-- Tabs Lokker-->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tb1dataperusahaan" name="tb1dataperusahaan" title="Data" class="nav-link active" data-toggle="tab" href="#tabdataperusahaan"><i class="fa fa-list"></i></a>
                </li>
                <li class="nav-item">
                    <a id="tb1dataperusahaantambah" class="nav-link" data-toggle="tab" title="Tambah Perusahaan" href="#tambahperusahaan"><i class="fas fa-plus"></i></a>
                </li>
            </ul>

            <!-- isi tablokker -->
            <div class="tab-content">
                <!-- tab - 1 -->
                <div id="tabdataperusahaan" class="container-fluid tab-pane active"><br>
                    <div id="tabelperusahaan" class="data"></div>
                </div>

                <!-- tab - tambah -->
                <div id="tambahperusahaan" class="container-fluid tab-pane fade"><br>
                    <form id="frmperusahaan" METHOD="POST" action="">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-12">
                                <label for="txtkodeperusahaan">Kode Perusahaan<span class="text-danger"> *</span></label><br>
                                <input type="text" class="form-control form-control-user" name="txtkodeperusahaan" id="txtkodeperusahaan" value="">
                                <input id='tbmhperusahaan' type="hidden" value=<?php echo $_SESSION['tbmhperusahaan']  ?>>
                                <small class="text-danger" id="txtkodeperusahaan_err"></small>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <label for="txtnamaperusahaan">Nama Perusahaan<span class="text-danger"> *</span></label><br>
                                <input type="text" class="form-control form-control-user" name="txtnamaperusahaan" id="txtnamaperusahaan" value="">
                                <small class="text-danger" id="txtnamaperusahaan_err"></small><br>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="txtalamatperusahaan">Alamat Perusahaan<span class="text-danger"> *</span></label><br>
                                <input type="text" class="form-control form-control-user" name="txtalamatperusahaan" id="txtalamatperusahaan" value="">

                                <small class="text-danger" id="txtalamatperusahaan_err"></small><br>
                            </div>
                        </div>
                        <div id="row1" class="row">
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="lstprovperusahaan">Provinsi :<span class="text-danger"> *</span></label><br>
                                <select class="form-control form-control-user" name="lstprovperusahaan" id="lstprovperusahaan" style="width: 100%;">

                                </select>
                                <small class="text-danger" id="lstprovperusahaan_err"></small>

                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="lstkabperusahaan">Kabupaten/Kota<span class="text-danger"> *</span></label><br>
                                <select class="form-control form-control-user" name="lstkabperusahaan" id="lstkabperusahaan" style="width: 100%;">
                                    <option value=''>-- Pilih Kabupaten Kota --</option>
                                </select>
                                <small class="text-danger" id="lstkabperusahaan_err"></small>
                                <br>
                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="lstkecperusahaan">Kecamatan<span class="text-danger"> *</span></label><br>
                                <select class="form-control form-control-user" name="lstkecperusahaan" id="lstkecperusahaan" style="width: 100%;">
                                    <option value=''>-- Pilih Kecamatan --</option>
                                </select>
                                <small class="text-danger" id="lstkecperusahaan_err"></small>
                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="lstkelperusahaan">Kelurahan<span class="text-danger"> *</span></label><br>
                                <select class="form-control form-control-user" name="lstkelperusahaan" id="lstkelperusahaan" style="width: 100%;">
                                    <option value=''>-- Pilih Kelurahan --</option>
                                </select>
                                <small class="text-danger" id="lstkelperusahaan_err" style="position: absolute;"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="txttelpperusahaan">Telepon</label><br>
                                <input type="text" class="form-control form-control-user" name="txttelpperusahaan" id="txttelpperusahaan" value="">
                                <small class="text-danger" id="txttelpperusahaan_err"></small><br>
                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="txtemailperusahaan">Email</label><br>
                                <input type="text" class="form-control form-control-user" name="txtemailperusahaan" id="txtemailperusahaan" value="">
                                <small class="text-danger" id="txtemailperusahaan_err"></small>
                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="txtwebperusahaan">Website</label><br>
                                <input type="text" class="form-control form-control-user" name="txtwebperusahaan" id="txtwebperusahaan" value="">
                                <small class="text-danger" id="txtwebperusahaan_err"></small>
                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <label for="txtnpwpperusahaan">NPWP Perusahaan</label><br>
                                <input type="text" class="form-control form-control-user" name="txtnpwpperusahaan" id="txtnpwpperusahaan" value="">
                                <small class="text-danger" id="txtnpwpperusahaan_err"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:10px;">
                                <small style="color:red"><b>Catatan : Sebelum menyimpan pastikan data yang anda input benar.</b></small>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="button" name="btnsimpanperusahaan" id="btnsimpanperusahaan" class="btn font-weight-bold btn-primary" value="Simpan Data">
                                <button type="button" name="btnresetperusahaan" id="btnresetperusahaan" class="btn font-weight-bold btn-secondary">Reset Data</button>
                                <!--<button type="submit"  class="btn btn-info font-weight-bold" style='background-color:#00005c; color:white;'>Simpan Data</button>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var tambah = $('#tbmhperusahaan').val();
        if (tambah != "") {
            eval(tambah);
        }

        $('#lstkabperusahaan').html("<option value=''>-- Pilih Kabupaten Kota --</option>");
        $('#lstkabperusahaan').select2({
            theme: "bootstrap4",
        });

        $('#lstkecperusahaan').html("<option value=''>-- Pilih Kecamatan --</option>");
        $('#lstkecperusahaan').select2({
            theme: "bootstrap4",
        });

        $('#lstkelperusahaan').html("<option value=''>-- Pilih Kelurahan --</option>");
        $('#lstkelperusahaan').select2({
            theme: "bootstrap4",
        });

        $.post('cariprov?stt=prov', {},
            function(data) {
                $('#lstprovperusahaan').html(data);

                $('#lstprovperusahaan').select2({
                    theme: "bootstrap4",
                });
            });

        $("#tabelperusahaan").load("fetch_perusahaan.php");

        $('#lstprovperusahaan').change(function() {
            var prov = $('#lstprovperusahaan').val();

            if (prov != "") {
                $.post('carikabupaten', {
                        kdprov: prov
                    },
                    function(data) {
                        $('#lstkabperusahaan').html(data);
                    });

                $('#lstkecperusahaan').html("<option value=''> -- Pilih Kecamatan --</option>");
                $('#lstkelperusahaan').html("<option value=''> -- Pilih Kelurahan --</option>");

            } else {
                $('#lstkabperusahaan').html("<option value=''> -- Pilih Kabupaten Kota --</option>");
                $('#lstkecperusahaan').html("<option value=''> -- Pilih Kecamatan --</option>");
                $('#lstkelperusahaan').html("<option value=''> -- Pilih Kelurahan --</option>");
            }
        });

        $('#lstkabperusahaan').change(function() {
            var kab = $('#lstkabperusahaan').val();

            if (kab != "") {
                $.post('carikec', {
                        kdkota: kab
                    },
                    function(data) {
                        $('#lstkecperusahaan').html(data);
                    });

                $('#lstkecperusahaan').html("<option value=''> -- Pilih Kecamatan --</option>");
                $('#lstkelperusahaan').html("<option value=''> -- Pilih Kelurahan --</option>");
            } else {
                $('#lstkecperusahaan').html("<option value=''> -- Pilih Kecamatan --</option>");
                $('#lstkelperusahaan').html("<option value=''> -- Pilih Kelurahan --</option>");
            }
        });

        $('#lstkecperusahaan').change(function() {
            var kec = $('#lstkecperusahaan').val();

            if (kec != "") {
                $.post('carikel', {
                        kdkec: kec
                    },
                    function(data) {
                        $('#lstkelperusahaan').html(data);
                    });
            } else {
                $('#lstkelperusahaan').html("<option value=''> -- Pilih Kelurahan --</option>");
            }

        });

        //simpan data lokasi kerja
        $("#btnresetperusahaan").click(function() {
            $.LoadingOverlay('show');
            $('#txtkodeperusahaan').val('');
            $('#txtnamaperusahaan').val('');
            $('#txtalamatperusahaan').val('');
            $.post('cariprov?stt=prov', {},
                function(data) {
                    $('#lstprovperusahaan').html(data);
                });
            $('#lstkabperusahaan').html("<option value=''>-- Pilih Kabupaten Kota --</option>");
            $('#lstkecperusahaan').html("<option value=''>-- Pilih Kecamatan --</option>");
            $('#lstkelperusahaan').html("<option value=''>-- Pilih Kelurahan --</option>");
            $('#txttelpperusahaan').val('');
            $('#txtemailperusahaan').val('');
            $('#txtwebperusahaan').val('');
            $('#txtnpwpperusahaan').val('');
            $('#txttipeperusahaan').val('');
            $('#lststatperusahaan').val('');
            $('#txtkodeperusahaan_err').text('');
            $('#txtnamaperusahaan_err').text('');
            $('#txtalamatperusahaan_err').text('');
            $('#lstprovperusahaan_err').text('');
            $('#lstkabperusahaan_err').text('');
            $('#lstkecperusahaan_err').text('');
            $('#lstkelperusahaan_err').text('');
            $('#txttipeperusahaan_err').text('');
            $('#lststatperusahaan_err').text('');
            $.LoadingOverlay('hide');
        });

        $("#btnsimpanperusahaan").click(function() {

            var kode = $('#txtkodeperusahaan').val();
            var nama = $('#txtnamaperusahaan').val();
            var alamat = $('#txtalamatperusahaan').val();
            var prov = $('#lstprovperusahaan').val();
            var kab = $('#lstkabperusahaan').val();
            var kec = $('#lstkecperusahaan').val();
            var kel = $('#lstkelperusahaan').val();
            var tipe = $('#txttipeperusahaan').val();
            var stat = $('#lststatperusahaan').val();

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
                        //alert(dataResult.statusCode);
                        if (dataResult.statusCode == 200) {
                            $('#txtkodeperusahaan').val('');
                            $('#txtnamaperusahaan').val('');
                            $('#txtalamatperusahaan').val('');
                            $.post('cariprov?stt=prov', {},
                                function(data) {
                                    $('#lstprovperusahaan').html(data);
                                    $('#lstkabperusahaan').html("<option value=''> -- Pilih Kabupaten Kota --</option>");
                                    $('#lstkecperusahaan').html("<option value=''> -- Pilih Kecamatan --</option>");
                                    $('#lstkelperusahaan').html("<option value=''> -- Pilih Kelurahan --</option>");

                                });
                            $('#txttelpperusahaan').val('');
                            $('#txtemailperusahaan').val('');
                            $('#txtwebperusahaan').val('');
                            $('#txtnpwpperusahaan').val('');

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
                $('#txtkodeperusahaan_err').text(kode_err);
                $('#txtnamaperusahaan_err').text(nama_err);
                $('#txtalamatperusahaan_err').text(alamat_err);
                $('#lstprovperusahaan_err').text(prov_err);
                $('#lstkabperusahaan_err').text(kab_err);
                $('#lstkecperusahaan_err').text(kec_err);
                $('#lstkelperusahaan_err').text(kel_err);
                $('#txttipeperusahaan_err').text(tipe_err);
                $('#lststatperusahaan_err').text(stat_err);

            }

        });
    });
</script>