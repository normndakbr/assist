<table id="tblappuser" class="display table border order-column table-hover" style="width:100%">
    <thead>
        <tr class="font-weight-bold bg-primary" style="color:white;">
            <th style="text-align:center;">No.</th>
            <th style="text-align:center;">Aplikasi</th>
            <th style="text-align:center;">Keterangan</th>
            <th style="text-align:center;">Tipe Akses</th>
            <th style="text-align:center;">Proses</th>
        </tr>
    </thead>
    <tbody>
        <?php

        session_start();

        include 'dbconn.php';
        // include 'dbconnaset.php';

        $no = 1;

        $iduser = $_GET['iduser'];
        $query = "SELECT * FROM vwappuser WHERE idUser=" . $iduser . " ORDER BY idAppUser ASC";

        $akun = $conn->prepare($query);
        $akun->execute();
        $rstakun = $akun->get_result();

        if ($rstakun->num_rows > 0) {
            while ($row = $rstakun->fetch_assoc()) {
                $id = $row['idUser'];
                $apps = $row['namaApp'];
                $ket = $row['subApp'];
                $idmenu = $row['idMenu'];
                $koneksi = $row['koneksi'];
                $database = $row['database'];
                $filekoneksi = $row['filekoneksi'];

                include $filekoneksi;

                $strsql = "SELECT * FROM tbmmenu WHERE IdMenu=" . $idmenu;
                $sqlmenu = mysqli_query(${$koneksi}, $strsql);
                if ($sqlmenu->num_rows > 0) {
                    $rwmenu = mysqli_fetch_assoc($sqlmenu);
                    $menu = $rwmenu['NamaMenu'];
                }
        ?>
                <tr>
                    <td style="text-align:center;width:1%;"><?php echo $no++; ?></td>
                    <td style="width:15%;"><?php echo $apps; ?></td>
                    <td style="width:25%;"><?php echo $ket; ?></td>
                    <td style="width:20%;"><?php echo $menu; ?></td>
                    <td style="text-align:center;width:10%;">
                        <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_akun" title="Edit" value="<?php echo  $email; ?>"> <i class="fa fa-edit"></i> </button>
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_akun" title="Hapus" value="<?php echo $email; ?>"> <i class="fa fa-trash"></i> </button>
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
                text: "Yakin pengguna " + email + " akan dihapus?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#36c6d3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batalkan'
            }).then(function(result) {
                if (result.value) {
                    // $.LoadingOverlay("show");
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
                                // $.LoadingOverlay("hide");
                            } else {
                                swal('Error', dtResult.pesan, 'error');
                                // $.LoadingOverlay("hide");
                            }
                        }
                    });
                } else if (result.dismiss == 'cancel') {
                    swal('Batal', 'Data akun batal dihapus', 'error');
                    return false;
                }
            });
        });

        $(document).on('click', '.edit_akun', function() {
            var email = $(this).attr('value');
            var id = $(this).attr('id');
            var idper = $('#ip' + id).attr('value');

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
                        $("#txtemailakunedit").prop('disabled', true);
                        $("#txtnamaakunedit").val(dtResult.nama);
                        $("#dtptglaktifakunedit").val(dtResult.tglaktif);
                        $("#dtptglkdakunedit").val(dtResult.tglkd);

                        $.post('carimenu', {
                                idper: idper
                            },
                            function(data) {
                                $("#lsttipeakunedit").html(data);
                                $("#lsttipeakunedit").val(dtResult.idmenu);
                            })

                        $("#lststatusakunedit").val(dtResult.stat);
                        $("#iduseredit").val(id);
                        $("#idperakunedit").val(idper);
                        $("#jdleditakun").text('Edit Akun - ' + email);

                        $.LoadingOverlay("hide");
                    } else {
                        swal('Error', dtResult.pesan, 'error');
                        $.LoadingOverlay("hide");
                    }
                }
            });
        });

        $('#tblappuser').DataTable().destroy();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        });

        $('#tblappuser').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            fixedHeader: {
                header: true,
                footer: true
            }
        });

        $.LoadingOverlay("hide");
    });
</script>