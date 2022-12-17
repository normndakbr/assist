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
                                <label for="txtalamatperdetail">Alamat :</label><br>
                                <input type="text" class="form-control form-control-user" name="txtalamatperdetail" id="txtalamatperdetail" value="" readonly><br>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="txtkelperdetail">Kelurahan :</label><br>
                                <input type="text" class="form-control form-control-user" name="txtkelperdetail" id="txtkelperdetail" value="" readonly><br>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="txtkecperdetail">Kecamatan :</label><br>
                                <input type="text" class="form-control form-control-user" name="txtkecperdetail" id="txtkecperdetail" value="" readonly>
                                <input id='idperalamat' type="hidden" value=""><br>
                            </div>

                            <div class="col-lg-6 col-md-4 col-sm-12">
                                <label for="txtkabperdetail">Kabupaten / Kota :</label><br>
                                <input type="text" class="form-control form-control-user" name="txtkabperdetail" id="txtkabperdetail" value="" readonly><br>
                            </div>

                            <div class="col-lg-6 col-md-4 col-sm-12">
                                <label for="txtprovperdetail">Provinsi :</label><br>
                                <input type="text" class="form-control form-control-user" name="txtprovperdetail" id="txtprovperdetail" value="" readonly><br>
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
<div class=" modal fade" id="mdlperedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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

                    <div class="col-lg-12 col-md-4 col-sm-12">
                        <button type="button" name="btnsimpanperedit" id="btnsimpanperedit" class="btn font-weight-bold btn-primary">Update Data</button>
                        <button type="button" name="btnkeluarperedit" id="btnkeluarperedit" class="btn font-weight-bold btn-danger">Batal</button>
                    </div>

                </div>
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
                <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="logout.php">Keluar</a>
            </div>
        </div>
    </div>
</div>