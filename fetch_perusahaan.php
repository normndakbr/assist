<table id="tblmainperusahaan" class="display table border order-column table-hover" style="width:100%">
    <thead>
        <tr class="font-weight-bold bg-primary" style="color:white;">
            <th style="text-align:center;">No.</th>
            <th style="text-align:center;">Kode</th>
            <th style="text-align:center;">Nama</th>
            <th style="text-align:center;">Alamat</th>
            <th style="text-align:center;">Status</th>
            <th style="text-align:center;">Proses</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'dbconn.php';
        include 'dbwilayah.php';

        session_start();

        $no = 1;
        // $idmenu = $_SESSION['idmenuLA'];
        $query = "SELECT * FROM tbmperusahaan ORDER BY KodePerusahaan ASC";

        $prus = $conn->prepare($query);
        $prus->execute();
        $rstprus = $prus->get_result();

        if ($rstprus->num_rows > 0) {
            while ($row = $rstprus->fetch_assoc()) {
                $id = $row['IdPerusahaan'];
                $kode = $row['KodePerusahaan'];
                $nama = $row['NamaPerusahaan'];
                $alamat = $row['AlamatPerusahaan'];

                $idkel = $row['KelPerusahaan'];
                $sqlkel = mysqli_query($connwil, "SELECT * FROM villages where id='$idkel'");
                if ($sqlkel->num_rows > 0) {
                    $rwpkel = mysqli_fetch_assoc($sqlkel);
                    $kel = $rwpkel['name'];
                } else {
                    $kel = "";
                }

                $idkec = $row['KecPerusahaan'];
                $sqlkec = mysqli_query($connwil, "SELECT * FROM districts where id='$idkec'");
                if ($sqlkec->num_rows > 0) {
                    $rwpkec = mysqli_fetch_assoc($sqlkec);
                    $kec = $rwpkec['name'];
                } else {
                    $kec = "";
                }

                $idkota = $row['KotaPerusahaan'];
                $sqlkab = mysqli_query($connwil, "SELECT * FROM regencies where id='$idkota'");
                if ($sqlkab->num_rows > 0) {
                    $rwpkab = mysqli_fetch_assoc($sqlkab);
                    $kab = $rwpkab['name'];
                } else {
                    $kab = "";
                }

                $idprov = $row['ProvPerusahaan'];
                $sqlprov = mysqli_query($connwil, "SELECT * FROM provinces where id='$idprov'");
                if ($sqlprov->num_rows > 0) {
                    $rwprov = mysqli_fetch_assoc($sqlprov);
                    $prov = $rwprov['name'];
                } else {
                    $prov = "";
                }

                $telp = $row['TelpPerusahaan'];
                $email   = $row['EmailPerusahaan'];
                $website = $row['WebsitePerusahaan'];
                $npwp = $row['NPWPPerusahaan'];
                $stat = $row['StatPerusahaan'];
                $tgljambuat = date('d-m-Y', strtotime($row['TglJamBuat']));
        ?>
                <tr>
                    <td style="text-align:center;width:1%;"><?php echo $no++; ?></td>
                    <td style="text-align:center;width:10%;"><?php echo $kode; ?></td>
                    <td style="width:30%;"><?php echo $nama; ?></td>
                    <td style="width:35%;">
                        <a id="<?php echo $id; ?>" href="#" class='alamat' value="<?php echo $alamat; ?>"><?php echo $alamat; ?></a>
                        <input id="<?php echo "kel" . $id; ?>" type="hidden" value="<?php echo $kel; ?>">
                        <input id="<?php echo "kec" . $id; ?>" type="hidden" value="<?php echo $kec; ?>">
                        <input id="<?php echo "kab" . $id; ?>" type="hidden" value="<?php echo $kab; ?>">
                        <input id="<?php echo "prov" . $id; ?>" type="hidden" value="<?php echo $prov; ?>">
                    </td>
                    <td style="text-align:center;width:5%;"><?php echo $stat; ?></td>
                    <td style="text-align:center;width:12%;">
                        <button id="<?php echo $id; ?>" class="btn btn-primary btn-sm detail_perusahaan" title="Detail" value="<?php echo $nama; ?>"> <i class="fas fa-asterisk"></i> </button>
                        <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_perusahaan" title="Edit" value="<?php echo $nama; ?>"> <i class="fa fa-edit"></i> </button>
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_perusahaan" title="Hapus" value="<?php echo $nama; ?>"> <i class="fa fa-trash"></i> </button>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.alamat', function() {

            var id = $(this).attr('id');
            var alamat = $(this).attr('value');
            var kel = $("#kel" + id).val();
            var kec = $("#kec" + id).val();
            var kab = $("#kab" + id).val();
            var prov = $("#prov" + id).val();

            $("#txtalamatperdetalamat").val(alamat);
            $("#txtkelperdetalamat").val(kel);
            $("#txtkecperdetalamat").val(kec);
            $("#txtkabperdetalamat").val(kab);
            $("#txtprovperdetalamat").val(prov);

            $("#mdlalamatper").modal('show');
        });

        $(document).on('click', '.detail_perusahaan', function() {
            var id = $(this).attr('id');

            $.LoadingOverlay("show");
            $.ajax({
                type: 'POST',
                url: "aksiperusahaan?stt=tampil",
                data: {
                    id: id
                },
                success: function(dResult) {
                    // alert(dResult);
                    var dtResult = JSON.parse(dResult);
                    if (dtResult.statusCode == 200) {
                        $('#txtkodeperdetail').val(dtResult.kode);
                        $('#txtnamaperdetail').val(dtResult.nama);
                        $('#txtalamatperdetail').val(dtResult.alamat);
                        $('#lstprovperdetail').val(dtResult.prov);
                        $('#lstkabperdetail').val(dtResult.kab);
                        $('#lstkecperdetail').val(dtResult.kec);
                        $('#lstkelperdetail').val(dtResult.kel);
                        $('#txttelpperdetail').val(dtResult.telp);
                        $('#txtemailperdetail').val(dtResult.email);
                        $('#txtwebperdetail').val(dtResult.web);
                        $('#txtnpwpperdetail').val(dtResult.npwp);
                        $('#txtstatperdetail').val(dtResult.stat);
                        $('#jdldetailper').text(" Detail Perusahaan - " + dtResult.nama);
                        $('#mdlperdetail').modal('show');
                        $.LoadingOverlay("hide");
                    }
                }
            });
        });


        // var edit = $('#editperusahaan').val();
        // if (edit == "T") {
        //     $('.edit_perusahaan').prop('disabled', true);
        // } else {
        //     $('.edit_waktuingat').prop('disabled', false);
        // }

        // var hapus = $('#hapusperusahaan').val();
        // if (hapus == "T") {
        //     $('.hapus_perusahaan').prop('disabled', true);
        // } else {
        //     $('.hapus_perusahaan').prop('disabled', false);
        // }

        // $(document).on('click', '.alamat', function() {
        //     var id = $(this).attr('id');
        //     var alamat = $(this).attr('value');

        //     var kel = $("#kel" + kode).val();
        //     var kec = $("#kec" + kode).val();
        //     var kab = $("#kab" + kode).val();
        //     var prov = $("#prov" + kode).val();

        //     $("#txtalamatkary").val(alamat);
        //     $("#txtkelkary").val(kel);
        //     $("#txtkeckary").val(kec);
        //     $("#txtkotakary").val(kab);
        //     $("#txtprovkary").val(prov);
        //     $("#txtkodeposkary").val("-");

        //     $("#mdlalamatkary").modal('show');

        // });

        $(document).on('click', '.hapus_perusahaan', function() {
            var nama = $(this).attr('value');
            var id = $(this).attr('id');

            swal({
                title: "Hapus",
                text: "Yakin perusahaan " + nama + " akan dihapus?",
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
                        url: "aksiperusahaan?stt=hapus",
                        data: {
                            id: id,
                            nama: nama
                        },
                        success: function(dataResult) {
                            // alert(dataResult);
                            var dtResult = JSON.parse(dataResult);
                            if (dtResult.statusCode == 200) {
                                $("#tabelperusahaan").load("fetch_perusahaan.php?");
                                swal('Berhasil', dtResult.pesan, 'info');
                                $.LoadingOverlay("hide");
                            } else {
                                swal('Error', dtResult.pesan, 'error');
                                $.LoadingOverlay("hide");
                            }
                        }
                    });
                } else if (result.dismiss == 'cancel') {
                    swal('Batal', 'Data perusahaan batal dihapus', 'error');
                    return false;
                }
            });
        });

        $(document).on('click', '.edit_perusahaan', function() {
            var id = $(this).attr('id');

            $.LoadingOverlay("show");
            $.ajax({
                type: 'POST',
                url: "aksiperusahaan?stt=tampil",
                data: {
                    id: id
                },
                success: function(dResult) {
                    // alert(dResult);
                    var dtResult = JSON.parse(dResult);
                    if (dtResult.statusCode == 200) {
                        $('#idperusahaanedit').val(id);
                        $('#txtkodeperedit').val(dtResult.kode);
                        $('#txtnamaperedit').val(dtResult.nama);
                        $('#txtalamatperedit').val(dtResult.alamat);

                        $.post('cariprov?stt=prov', {},
                            function(data) {
                                // alert(data);
                                $('#lstprovperedit').html(data);
                                $('#lstprovperedit').val(dtResult.idprov);
                                $('#lstprovperedit').select2({
                                    dropdownParent: $('#mdlperedit'),
                                    theme: "bootstrap4",
                                });

                                $.post('carikabupaten', {
                                        kdprov: dtResult.idprov
                                    },
                                    function(data) {
                                        // alert(data);
                                        $('#lstkabperedit').html(data);
                                        $('#lstkabperedit').val(dtResult.idkab);
                                        $('#lstkabperedit').select2({
                                            dropdownParent: $('#mdlperedit'),
                                            theme: "bootstrap4",
                                        });
                                        $('#row2').css('padding-bottom', '26px');
                                    });

                                $.post('carikec', {
                                        kdkota: dtResult.idkab
                                    },
                                    function(data) {
                                        // alert(data);
                                        $('#lstkecperedit').html(data);
                                        $('#lstkecperedit').val(dtResult.idkec);
                                        $('#lstkecperedit').select2({
                                            dropdownParent: $('#mdlperedit'),
                                            theme: "bootstrap4",
                                        });
                                        $('#row3').css('padding-bottom', '26px')
                                    });

                                $.post('carikel', {
                                        kdkec: dtResult.idkec
                                    },
                                    function(data) {
                                        $('#lstkelperedit').html(data);
                                        $('#lstkelperedit').val(dtResult.idkel);
                                        $('#lstkelperedit').select2({
                                            dropdownParent: $('#mdlperedit'),
                                            theme: "bootstrap4",
                                        });
                                    });
                            });

                        $('#txttelpperedit').val(dtResult.telp);
                        $('#txtemailperedit').val(dtResult.email);
                        $('#txtwebperedit').val(dtResult.web);
                        $('#txtnpwpperedit').val(dtResult.npwp);
                        $('#txtstatperedit').val(dtResult.stat);
                        $('#jdleditper').text(" Edit Perusahaan - " + dtResult.nama);

                        $('#mdlperedit').modal('show');
                        $.LoadingOverlay("hide");
                    }
                }
            });
        });

        $('#tblmainperusahaan').DataTable().destroy();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        });

        $('#tblmainperusahaan').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            fixedHeader: {
                header: true,
                footer: true
            }
        });

        $.LoadingOverlay("hide");
        $("#tabelperusahaan").LoadingOverlay("hide");
    });
</script>