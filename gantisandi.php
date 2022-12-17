<!-- Area Chart -->
<div class="col-xl-12 col-lg-12 d-xl-block d-lg-block d-md-block d-none">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color:#00005c;">
            <h6 class="m-0 font-weight-bold" style="color: white;">Ganti Sandi</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <label for="fnama">Sandi lama :</label><br>
                    <input type="password" class="form-control form-control-user" id="txtsandilama" name="txtsandilama" value="" required><br>

                    <label for="fnama">Sandi Baru :</label><br>
                    <input type="password" class="form-control form-control-user" id="txtsandibaru" name="txtsandibaru" value="" required><br>

                    <label for="fnama">Konfirmasi Ulang Sandi :</label><br>
                    <input type="password" class="form-control form-control-user" id="txtulangsandi" name="txtulangsandi" value="" required><br>
                    <hr>
                    <input type="button" id="btnsimpansandi" name="btnsimpansandi" class="btn font-weight-bold btn-primary" style='color:white;' value="Simpan Sandi">
                    <input type="button" id="btnresetsandi" name="btnresetsandi" class="btn font-weight-bold btn-secondary" style='color:white;' value="Reset">
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#btnsimpansandi").click(function() {

        var sandilama = $("#txtsandilama").val();
        var sandibaru = $("#txtsandibaru").val();
        var ulangsandi = $("#txtulangsandi").val();

        if (sandilama != "" && sandibaru != "" && ulangsandi != "") {
            if (sandibaru == ulangsandi) {
                $.LoadingOverlay("show");

                $.post('aksisandi', {
                        sandilama: sandilama,
                        sandibaru: sandibaru,
                        ulangsandi: ulangsandi
                    },
                    function(data) {
                        // alert(data);
                        var dtresult = JSON.parse(data);
                        if (dtresult.statusCode == 200) {
                            $.LoadingOverlay("hide");
                            swal('Berhasil', dtresult.pesan, 'info');

                            $("#txtsandilama").val('');
                            $("#txtsandibaru").val('');
                            $("#txtulangsandi").val('');

                        } else {
                            $.LoadingOverlay("hide");
                            swal('Error', dtresult.pesan, 'error');
                        }
                    })
            } else {
                swal('Error', 'Sandi baru dan konfirmasi ulang sandi baru tidak sama', 'error');
                return;
            }

        } else {
            if (sandilama == "") {
                swal('Error', 'Sandi lama tidak boleh kosong', 'error');
                return;
            }

            if (sandibaru == "") {
                swal('Error', 'Sandi baru tidak boleh kosong', 'error');
                return;
            }

            if (ulangsandi == "") {
                swal('Error', 'Konfirmasi sandi baru tidak boleh kosong', 'error');
                return;
            }
        }

    });

    $("#btnresetsandi").click(function() {

        $("#txtsandilama").val('');
        $("#txtsandibaru").val('');
        $("#txtulangsandi").val('');

    });
</script>