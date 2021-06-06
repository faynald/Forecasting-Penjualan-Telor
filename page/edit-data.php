<?php
    include("system/connection.php");
    $select_forecasting = mysqli_query($connection, "SELECT * FROM forecasting");
    $monthIND = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $monthENG = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $ayamkampung_inputvalue = "";
    $ayamkota_inputvalue = "";
    $row_find_data = 0;
    if (isset($_POST['submitdata'])){
        $input_tahun = $_POST['hiddenTahunModal'];
        $input_bulan = $_POST['hiddenBulanModal'];
        $input_telur_ayam_kampung = $_POST['hiddenAyamKampungModal'];
        $input_telur_ayam_kota = $_POST['hiddenAyamKotaModal'];
        $find_data = mysqli_query($connection, "SELECT * FROM forecasting WHERE tahun = $input_tahun AND bulan = '$input_bulan'");
        $row_find_data = mysqli_num_rows($find_data);
        if ($row_find_data == 0){
            mysqli_query($connection, "INSERT INTO forecasting VALUES(NULL, $input_tahun, '$input_bulan', $input_telur_ayam_kampung, $input_telur_ayam_kota)");
            echo "<script> alert('Berhasil menambahkan data')</script>";
            echo "<script> document.location = window.location.href </script>";
        }else{
            mysqli_query($connection, "UPDATE forecasting SET telur_ayam_kampung = $input_telur_ayam_kampung, telur_ayam_kota = $input_telur_ayam_kota WHERE tahun = $input_tahun AND bulan = '$input_bulan'");
            echo "<script> alert('Berhasil mengubah data')</script>";
            echo "<script> document.location = window.location.href </script>";
        } 
    } 
    if (isset($_POST['bulan'])){
        $_SESSION['tahun'] = $_POST['tahun'];
        $_SESSION['bulan'] = $_POST['bulan'];
    }
    $input_tahun = $_SESSION['tahun'];
    $input_bulan = $_SESSION['bulan'];
    $find_data = mysqli_query($connection, "SELECT * FROM forecasting WHERE tahun = $input_tahun AND bulan = '$input_bulan'");
    $row_find_data = mysqli_num_rows($find_data);
    if ($row_find_data != 0){
        foreach($find_data as $row){
            $ayamkampung_inputvalue = $row['telur_ayam_kampung'];
            $ayamkota_inputvalue = $row['telur_ayam_kota'];
        }
    }else{
        // echo "<script> alert('data tidak ditemukan')</script>";
    }
    function selectedBulan($bulan){
        if ($bulan == $_SESSION['bulan']){
            echo "selected";
        }
    }
    function jika_data_ada($data){
        if ($data == 0){ // jika data belum ada
            echo "Tambah Data";
        }else{
            echo "Edit Data";
        }
    }
?>

<div class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Data</h2>
                    </div>
                        <div class="card-body">
                        <form action="" method="POST">
                            <div class="row mx-0 px-0 my-0 py-0 pb-3">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Tahun</label><br>
                                </div>
                                <div class="col-lg-2 mx-0 px-0">
                                    <input name="tahun" id="inputTahun" type="number" class="form-control" value="<?= $_SESSION['tahun'] ?>" onchange="submit()">
                                </div>
                            </div>
                            <div class="row mx-0 px-0 my-0 py-0 pb-3">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Bulan</label><br>
                                </div>
                                <div class="col mx-0 px-0">
                                    <select name="bulan" id="selectBulan" onchange="submit()">
                                        <?php 
                                            for ($i = 0; $i<12; $i++ ){
                                                if ($monthIND[$i] == $_SESSION['bulan']){
                                                    echo "<option value='$monthIND[$i]' selected>$monthIND[$i]</option>";
                                                }else{
                                                    echo "<option value='$monthIND[$i]'>$monthIND[$i]</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    <form action="" method="POST">
                            <div class="row mx-0 px-0 my-0 py-0 pb-2">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Telur Ayam Kampung</label>
                                </div>
                                <div class="col-lg-2 mx-0 px-0">
                                    <input name="ayamkampung" id="inputAyamKampung" type="number" class="form-control" value="<?= $ayamkampung_inputvalue ?>" onchange="warningOnChange('warningInputAyamKampung',this.value)">
                                </div>
                                <div class="col mx-0 px-0 ms-2" id="warningInputAyamKampung" style="display: none;">
                                    <i class="fa fa-exclamation-circle fa-2x"></i>
                                    Data tidak boleh kosong
                                </div>
                            </div>
                            <div class="row mx-0 px-0 my-0 py-0">
                                <div class="col-lg-3 mx-0 px-0">
                                    <label>Telur Ayam Kota</label>
                                </div>
                                <div class="col-lg-2 mx-0 px-0">
                                    <input name="ayamkota" id="inputAyamKota" type="number" class="form-control" type="text" value="<?= $ayamkota_inputvalue ?>" onchange="warningOnChange('warningInputAyamKota',this.value)">
                                </div>
                                <div class="col mx-0 px-0 ms-2" id="warningInputAyamKota" style="display: none;">
                                    <i class="fa fa-exclamation-circle fa-2x"></i>
                                    Data tidak boleh kosong
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div class="card-footer">
                            <div style="margin: 35px;" class="position-absolute bottom-0 end-0">
                                <button type="button" onclick="submitEditData()" class="btn btn-primary btn-lg">Simpan</button>
                            </div>
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
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Telur Ayam Kampung</th>
                                    <th>Telur Ayam Kota</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <?php 
                                    $select_forecasting_tahun = mysqli_query($connection, "SELECT DISTINCT tahun FROM forecasting ORDER BY tahun");
                                    $tahun_list = [];
                                    foreach ($select_forecasting_tahun as $row){
                                        array_push($tahun_list, $row['tahun']);
                                    }
                                    foreach ($tahun_list as $urutan_tahun){
                                        for ($i = 0; $i<12; $i++ ){
                                            foreach ($select_forecasting as $row){ 
                                                if ($monthIND[$i] == $row['bulan'] && $urutan_tahun == $row['tahun'] ){ ?>
                                                    <tr>
                                                        <td><?= $row['tahun']?> <?= $row['bulan'] ?></td>
                                                        <td><?= $row['telur_ayam_kampung'] ?></td>
                                                        <td><?= $row['telur_ayam_kota'] ?></td>
                                                    </tr>
                                <?php }}}} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pop up EDIT DATA CONFIRMATION -->
<div class="modal" id="editdata" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editbuku_label"><?= jika_data_ada($row_find_data) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <?php if ($row_find_data == 1){ ?>
                        <label>Data yang akan diupdate :</label>
                        <table class="table table-light">
                            <thead class="thead-light">
                                <th>Waktu</th>
                                <th>Telur Ayam Kampung</th>
                                <th>Telur Ayam Kota</th>
                            </thead>
                            <tbody>
                                <td>
                                    <?= $input_tahun ?>
                                    <?= $input_bulan ?>
                                </td>
                                <td align="center">
                                    <?= $ayamkampung_inputvalue ?>
                                </td>
                                <td align="center">
                                    <?= $ayamkota_inputvalue ?>
                                </td>
                            </tbody>
                        </table>
                        <label>Menjadi :</label>
                    <?php } ?>
                    
                    <table class="table table-light">
                        <thead class="thead-light">
                            <th>Waktu</th>
                            <th>Telur Ayam Kampung</th>
                            <th>Telur Ayam Kota</th>
                        </thead>
                        <tbody>
                            <td>
                                <label id="labelTahunModal"></label>
                                <label id=labelBulanModal></label>
                            </td>
                            <td align="center">
                                <label id="labelAyamKampungModal"></label>
                            </td>
                            <td align="center">
                                <label id="labelAyamKotaModal"></label>
                            </td>
                        </tbody>
                    </table>
                    <input type="number" name="hiddenTahunModal" id="hiddenTahunModal" hidden>
                    <input type="text" name="hiddenBulanModal" id="hiddenBulanModal" hidden>
                    <input type="number" name="hiddenAyamKampungModal" id="hiddenAyamKampungModal" hidden>
                    <input type="number" name="hiddenAyamKotaModal" id="hiddenAyamKotaModal" hidden>
                </div>
                <div class="modal-footer">
                    <input type="number" name="idbuku" value="" hidden>
                    <button name="submitdata" type="submit" name="submitdeletebuku" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- end of pop up DELETE CONFIRMATION -->
