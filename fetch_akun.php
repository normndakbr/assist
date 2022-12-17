<table id="tblakun" class="display table border order-column table-hover" style="width:100%">
    <thead>
        <tr class="font-weight-bold bg-primary" style="color:white;">
            <th style="text-align:center;">No.</th>
            <th style="text-align:center;">Email</th>
            <th style="text-align:center;">Nama</th>
            <th style="text-align:center;">Status</th>
            <th style="text-align:center;">Proses</th>
        </tr>
    </thead>
    <tbody>
        <?php

        session_start();

        include 'dbconn.php';
        // include 'dbconnlegal.php';

        $no = 1;

        $query = "SELECT * FROM tbmuser  ORDER BY iduser ASC";

        $akun = $conn->prepare($query);
        $akun->execute();
        $rstakun = $akun->get_result();

        if ($rstakun->num_rows > 0) {
            while ($row = $rstakun->fetch_assoc()) {
                $id = $row['idUser'];
                $email = $row['emailLogin'];
                $nama = $row['namaUser'];
                $status = $row['statUser'];
                $token = $row['token'];
                $tglaktif = date('d-m-Y', strtotime($row['tglAktif']));
                $tglkd = date('d-m-Y', strtotime($row['tglKadaluarsa']));

                if ($token != "") {
                    $kirim = "";
                } else {
                    $kirim = "disabled";
                }
        ?>
                <tr>
                    <td style="text-align:center;width:1%;"><?php echo $no++; ?></td>
                    <td style="width:10%;"><?php echo $email; ?></td>
                    <td style="width:25%;"><?php echo $nama; ?></td>
                    <td style="text-align:center;width:5%;"><?php echo $status; ?></td>
                    <td style="text-align:center;width:12%;">
                        <button id="<?php echo $id; ?>" class="btn btn-primary btn-sm app_akun" title="Detail" value="<?php echo  $email; ?>"> <i class="fas fa-asterisk"></i> </button>
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm email_akun" title="Kirim Email Verifikasi" value="<?php echo  $email; ?>" <?php echo  $kirim; ?>> <i class="far fa-envelope"></i></button>
                        <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_akun" title="Edit" value="<?php echo  $email; ?>"> <i class="fa fa-edit"></i> </button>
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_akun" title="Hapus" value="<?php echo $email; ?>"> <i class="fa fa-trash"></i> </button>
                        <input type="hidden" id="nama<?php echo $id; ?>" value="<?php echo $nama; ?>">
                        <input type="hidden" id="tkn<?php echo $id; ?>" value="<?php echo $token; ?>">
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {

        var edit = $('#editakun').val();
        if (edit == "T") {
            $('.edit_akun').prop('disabled', true);
        } else {
            $('.edit_akun').prop('disabled', false);
        }

        var hapus = $('#hapusakun').val();
        if (hapus == "T") {
            $('.hapus_akun').prop('disabled', true);
        } else {
            $('.hapus_akun').prop('disabled', false);
        }

        $(document).on('click', '.hapus_akun', function() {
            var email = $(this).attr('value');
            var id = $(this).attr('id');

            swal({
                title: "Hapus",
                text: "Yakin akun " + email + " akan dihapus?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: 'POST',
                        url: "aksiakun?stt=hapus",
                        data: {
                            id: id,
                            email: email
                        },
                        success: function(dataResult) {
                            alert(dataResult);
                            var dtResult = JSON.parse(dataResult);
                            if (dtResult.statusCode == 200) {
                                $("#tabelakun").load("fetch_akun.php");
                                swal('Berhasil', dtResult.pesan, 'info');
                                $.LoadingOverlay("hide");
                            } else {
                                swal('Error', dtResult.pesan, 'error');
                                $.LoadingOverlay("hide");
                            }
                        }
                    });
                } else if (result.dismiss == 'cancel') {
                    swal('Batal', 'Data Akun batal dihapus', 'error');
                    return false;
                }
            });
        });

        $(document).on('click', '.app_akun', function() {
            var email = $(this).attr('value');
            var id = $(this).attr('id');

            $.LoadingOverlay("show");
            $.ajax({
                type: 'POST',
                url: "aksiakun?stt=tampil",
                data: {
                    id: id,
                    email: email
                },
                success: function(dataResult) {
                    // alert(dataResult);
                    var dtResult = JSON.parse(dataResult);
                    if (dtResult.statusCode == 200) {
                        $("#mdlappdetail").modal('show');
                        $("#txtemailappdetail").val(email);
                        $("#txtemailappdetail").prop('disabled', true);
                        $("#txtnamaappdetail").val(dtResult.nama);
                        $("#dtptglaktifappdetail").val(dtResult.tglaktifshow);
                        $("#dtptglkdappdetail").val(dtResult.tglkdshow);
                        $("#lststatusappdetail").val(dtResult.stat);
                        $("#iduseredit").val(id);
                        $("#lstaksesakundetail").val(dtResult.aksesakun);
                        $("#jdlappdetail").text('Detail Akun - ' + email);
                        $("#tabelappdetail").load("fetch_appdetail.php?iduser=" + id);
                        $.LoadingOverlay("hide");
                    } else {
                        swal('Error', dtResult.pesan, 'error');
                        $.LoadingOverlay("hide");
                    }
                }
            });
        });

        $(document).on('click', '.email_akun', function() {
            var email = $(this).attr('value');
            var id = $(this).attr('id');
            var token = $('#tkn' + id).attr('value');

            if (token != "") {
                $.LoadingOverlay("show");
                $.ajax({
                    type: 'POST',
                    url: "aksiakun?stt=kirimulang",
                    data: {
                        id: id
                    },
                    success: function(dataResult) {
                        alert(dataResult);
                        var dtResult = JSON.parse(dataResult);
                        if (dtResult.statusCode == 200) {
                            swal('Berhasil', dtResult.pesan, 'info');
                            $.LoadingOverlay("hide");
                        } else {
                            swal('Error', dtResult.pesan, 'error');
                            $.LoadingOverlay("hide");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.edit_akun', function() {
            var email = $(this).attr('value');
            var id = $(this).attr('id');

            $.LoadingOverlay("show");
            $.ajax({
                type: 'POST',
                url: "aksiakun?stt=tampil",
                data: {
                    id: id,
                    email: email
                },
                success: function(dataResult) {
                    // alert(dataResult);
                    var dtResult = JSON.parse(dataResult);
                    if (dtResult.statusCode == 200) {
                        $("#mdleditakun").modal('show');
                        $("#txtemailakunedit").val(email);
                        $("#txtiduseredit").val(id);
                        $("#txtemailakunedit").prop('disabled', true);
                        $("#txtnamaakunedit").val(dtResult.nama);
                        $("#dtptglaktifakunedit").val(dtResult.tglaktif);
                        $("#dtptglkdakunedit").val(dtResult.tglkd);
                        $("#lststatusakunedit").val(dtResult.stat);
                        $("#lstaksesakunedit").val(dtResult.aksesakun);
                        $("#iduseredit").val(id);
                        $("#tabelappedit").load("fetch_appedit.php?iduser=" + id);
                        $("#jdleditakun").text('Edit Akun - ' + email);

                        $.LoadingOverlay("hide");
                    } else {
                        swal('Error', dtResult.pesan, 'error');
                        $.LoadingOverlay("hide");
                    }
                }
            });
        });

        $('#tblakun').DataTable().destroy();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        });

        $('#tblakun').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            fixedHeader: {
                header: true,
                footer: true
            }
        });

        $("#tabelakun").LoadingOverlay("hide");
        $.LoadingOverlay("hide");
    });
</script>