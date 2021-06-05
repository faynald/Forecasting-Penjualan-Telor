<?php

?>
<div class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Data</h2>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="row mx-0 px-0 my-0 py-0 pb-3">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Tahun</label><br>
                                </div>
                                <div class="col mx-0 px-0">
                                    <select name="tahun">
                                        <option value="2020">2020</option>
                                        <option value="2021" selected>2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mx-0 px-0 my-0 py-0 pb-3">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Bulan</label><br>
                                </div>
                                <div class="col mx-0 px-0">
                                    <select name="bulan">
                                        <option value="January">Januari</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mx-0 px-0 my-0 py-0 pb-2">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Telur Ayam Kampung</label>
                                </div>
                                <div class="col-lg-1 mx-0 px-0">
                                    <input name="selectpenerbit" type="number" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="row mx-0 px-0 my-0 py-0">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Telur Ayam Kota</label>
                                </div>
                                <div class="col-lg-1 mx-0 px-0">
                                    <input name="harga" type="number" class="form-control" type="text" placeholder="0">
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div class="card-footer">
                            <div style="margin: 35px;" class="position-absolute bottom-0 end-0"><button type=" button" class="btn btn-primary btn-lg">Simpan</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2>Daftar Data</h2>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>