<div class="position-relative" data-aos="fade-up" data-aos-delay="100">
    <div class="row icon-boxes bg-white" style="margin-top:-10px;">
        <div id="loginPanel" class="col-lg-12 col-xl-12 col-sm-12 border shadow-sm">
            <div class="bg-primary text-white rounded-1 text-center mt-2">
                <p class="text-white" style="font-size:50px;"><b>Perusahaan</b></p>
            </div>

            <div class="row p-3">
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

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="txttelppertambah">Telepon :</label><br>
                                    <input type="text" class="form-control form-control-user" name="txttelppertambah" id="txttelppertambah" value=""><br>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="txtemailpertambah">Email :</label><br>
                                    <input type="email" class="form-control form-control-user" name="txtemailpertambah" id="txtemailpertambah" value=""><br>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="txtwebpertambah">Website :</label><br>
                                    <input type="text" class="form-control form-control-user" name="txtwebpertambah" id="txtwebpertambah" value=""><br>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
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
        </div>
    </div>
</div>

<script>
    // $("#mdlpertambah").modal("show");

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