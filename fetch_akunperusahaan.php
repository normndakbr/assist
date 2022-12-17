<table id="tbldetailizin" class="display responsive table row-border table-hover" style="width:100%">
    <thead>
        <tr class="font-weight-bold bg-primary" style="color:white;">
            <th style="text-align:center;">No.</th>
            <th style="text-align:center;">Kode</th>
            <th style="text-align:center;">Perusahaan</th>
            <th style="text-align:center;">Proses</th>
        </tr>
    </thead>
    <tbody>
        <?php
        session_start();
        include 'dbconn.php';

        $allcom = $_GET['AllComICLA'];
        $query = "SELECT * FROM vwuser_perusahaan ORDER BY IdUser ASC, IdPerusahaan ASC";

        $no = 1;

        $suratizin = $conn->prepare($query);
        $suratizin->execute();
        $rstsuratizin = $suratizin->get_result();

        if ($rstsuratizin->num_rows > 0) {
            while ($row = $rstsuratizin->fetch_assoc()) {
                $id  = $row['IdUP'];
                $iduser  = $row['IdUser'];
                $idper = $row['IdPerusahaan'];
                $perusahaan = $row['NamaPerusahaan'];
                $kode = $row['KodePerusahaan'];
        ?>
                <tr>
                    <td style="text-align:center;"><?php echo $no++; ?></td>
                    <td><?php echo $kode; ?></td>
                    <td><?php echo $perusahaan; ?></td>
                    <td style="text-align:center;">
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_izin" title="Hapus data izin" value="<?php echo $namaizin; ?>"> <i class="fa fa-trash"></i> </button>
                        <input type="hidden" id="<?php echo 'ip' . $id; ?>" value="<?php echo $idper; ?>">
                        <input type="hidden" id="<?php echo 'kd' . $id; ?>" value="<?php echo $perusahaan; ?>">
                        <input id='editizin' type='hidden' value=<?php echo $_SESSION['editizin'] ?>>
                        <input id='hapusizin' type='hidden' value=<?php echo $_SESSION['hapusizin'] ?>>
                        <input id='tambahizin' type='hidden' value=<?php echo $_SESSION['tambahizin'] ?>>
                    </td>

                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {

        var edit = $('#editizin').val();
        if (edit == "T") {
            $('.edit_izin').prop('disabled', true);
        } else {
            $('.edit_izin').prop('disabled', false);
        }

        var hapus = $('#hapusizin').val();
        if (hapus == "T") {
            $('.hapus_izin').prop('disabled', true);
        } else {
            $('.hapus_izin').prop('disabled', false);
        }

        var tambah = $('#tambahizin').val();
        if (tambah == "T") {
            $('.izin_baru').prop('disabled', true);
        } else {
            $('.izin_baru').prop('disabled', false);
        }

        $(document).on('click', '.izin_baru', function() {
            var namaizin = $(this).attr('value');
            var idizinmaster = $(this).attr('id');
            var idper = $("#ip" + idizinmaster).attr('value');
            var kdper = $("#kd" + idizinmaster).attr('value');
            var namafolder = $("#nf" + idizinmaster).attr('value');

            $('#idperu').val(idper);
            $('#kdper').val(kdper);
            $('#idizinmaster').val(idizinmaster);
            $('#lokfolder').val(namafolder);
            $('#lstuploaddari').val('');
            $('#txtketdetail').val('');
            $('#dtptglterbitdetail').val('');
            $('#dtptglakhirdetail').val('');
            $('#txtnoizindetail').val('');
            $('#txtuploadizin').val('');
            $('#jdldetailizintambah').text('Perizinan Baru - ' + namaizin);
            $('#lstuploaddari').val('Site');

            $('#mdldetailizintambah').modal('show');
        });

        //======================= edit =========================
        $(document).on('click', '.edit_izin', function() {
            var idizinmaster = $(this).attr('id');

            $.ajax({
                type: 'POST',
                url: 'aksimasterizin',
                data: {
                    idizinmaster: idizinmaster
                },
                timeout: 10000,
                success: function(data) {
                    // alert(data);
                    dtdetizin = JSON.parse(data);
                    if (dtdetizin.statusCode == 200) {
                        $('#mdleditmasterizin').modal('show');
                        $("#idizinmasteredit").val(idizinmaster);
                        $("#lstperusahaanmasterizin").val(dtdetizin.idperusahaan);
                        $("#txtnamasuratmasterizinedit").val(dtdetizin.nama);
                        $("#txtnamalamamasterizinedit").val(dtdetizin.nama);
                        $("#jdleditmasterizin").text("Edit Perizinan - " + dtdetizin.nama);
                        $("#txtlevelmasterizin").val(dtdetizin.waktu);
                        $("#txtidlevelmasterizin").val(dtdetizin.idwaktu);
                        $("#txtgroupmasterizin").val(dtdetizin.katpenerima);
                        $("#txtidgroupmasterizin").val(dtdetizin.idkatpenerima);
                        $("#txtketmasterizinedit").val(dtdetizin.ketizinmaster);
                        $("#lststatusmasterizinedit").val(dtdetizin.statmaster);

                        $.post('cariperusahaan?stt=perusahaan', {},
                            function(data) {
                                $("#lstperusahaanmasterizin").html(data);
                                $("#lstperusahaanmasterizin").val(dtdetizin.idperusahaan);
                                $("#lstperusahaanmasterizin").prop('disabled', true);
                            });

                        $.post('aksipenerbit?stt=posisidetail', {
                                idper: dtdetizin.idperusahaan
                            },
                            function(data) {

                                $("#lstpenerbitmasterizin").html(data);
                                $("#lstpenerbitmasterizin").val(dtdetizin.idpenerbit);
                            });

                        $.post('aksikategoriizin?stt=posisidetail', {
                                idper: dtdetizin.idperusahaan
                            },

                            function(data) {

                                $("#lstkategorimasterizin").html(data);
                                $("#lstkategorimasterizin").val(dtdetizin.idkat);
                            });

                        $.post('carifolder?idper=' + dtdetizin.idperusahaan, {},

                            function(data) {
                                $("#lstfoldermasteredit").html(data);
                                $("#lstfoldermasteredit").val(dtdetizin.idfolder);
                            });


                    }
                }
            });
        });

        $(document).on('click', '.detail_izin', function() {
            var idizinmaster = $(this).attr('id');
            var namaizin = $("#iz" + idizinmaster).attr('value');
            var ketmaster = $("#km" + idizinmaster).attr('value');
            var namafolder = $("#nf" + idizinmaster).attr('value');
            var statmaster = $("#sm" + idizinmaster).attr('value');

            $.ajax({
                type: 'POST',
                url: 'aksimasterizin',
                data: {
                    idizinmaster: idizinmaster
                },
                timeout: 10000,
                success: function(data) {
                    // alert(data);
                    dtdetizin = JSON.parse(data);
                    if (dtdetizin.statusCode == 200) {
                        $("#txtperusahaandetailizin").val(dtdetizin.perusahaan);
                        $("#txtpenerbitdetailizin").val(dtdetizin.penerbit);
                        $("#txtkatdetailizin").val(dtdetizin.kat);
                        $("#txtnamasuratdetail").val(namaizin);
                        $("#txtlvlizindetail").val(dtdetizin.waktu);

                        $("#txtketmasterdet").val(ketmaster);
                        $("#txtfoldermaster").val(namafolder);
                        $("#txtstatmasterdet").val(statmaster);

                        $("#txtgroupizindetail").val(dtdetizin.katpenerima);
                        $("#jdlmasterizin").text('Perizinan - ' + namaizin);
                        $("#tabelizindetail").load('fetch_izindetail.php?idizin=' + idizinmaster);
                        $("#mdldetailizin").modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.hapus_izin', function() {
            var namaizin = $(this).attr('value');
            var idizinmaster = $(this).attr('id');

            swal({
                title: "Hapus",
                text: "Yakin data " + namaizin + " akan dihapus? semua data yang terhubung dengan " + namaizin,
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
                        url: "aksidetailizin?stt=hapus",
                        data: {
                            idizinmaster: idizinmaster
                        },
                        success: function(dataResult) {
                            // alert(dataResult);
                            var dtResult = JSON.parse(dataResult);
                            if (dtResult.statusCode == 200) {
                                // $.LoadingOverlay("hide");

                                var allcom = $("#allcom").val();

                                if (allcom == "Y") {
                                    $("#lstperusahaandetail").prop('disabled', false);
                                } else {
                                    $("#lstperusahaandetail").prop('disabled', true);
                                }

                                $("#tabeldetailizin").load('fetch_detailizin.php?allcom=' + allcom);
                                swal('Berhasil', dtResult.pesan, 'info');
                            } else {
                                $.LoadingOverlay("hide");
                                swal('Error', dtResult.pesan, 'error');
                            }
                        }
                    });
                } else if (result.dismiss == 'cancel') {
                    swal('Batal', 'Data perizinan batal dihapus', 'error');
                    return false;
                }
            });
        });

        $('#tbldetailizin').DataTable().destroy();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        });

        $('#tbldetailizin').DataTable({
            searching: true,
            scrollY: 550,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 2,
                rightColumns: 1
            },
            columnDefs: [{
                targets: [6],
                visible: false,
                searchable: true
            }]
        });

        $.LoadingOverlay("hide");
    });
</script>