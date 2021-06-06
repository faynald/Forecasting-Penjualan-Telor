<?php
function barColor($color, $height){
    $height = $height;
    echo "style='background: $color; height: $height%;'";
}
$monthIND = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$select_forecasting_tahun = mysqli_query($connection, "SELECT DISTINCT tahun FROM forecasting ORDER BY tahun");
$tipe_telur_list = ['telur_ayam_kampung', 'telur_ayam_kota'];
$tipe_telur_label = ['Telur Ayam Kampung', 'Telur Ayam Kota'];
$tahun_list = [];
foreach ($select_forecasting_tahun as $row){
    array_push($tahun_list, $row['tahun']);
}
if (isset($_POST['select_tahun_grafik'])){
    $_SESSION['tahun_grafik'] = $_POST['select_tahun_grafik'];
    $_SESSION['tipe_telur'] = $_POST['select_tipe_telur'];
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-md-4 mx-auto">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <img src="./images/egg-sold.png" class="card-img" alt="" style="width: 8rem;">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Bulan ini </h5>
                                <span class="h2 font-weight-bold mb-0">
                                    <label id="periodBalance">
                                        55
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mx-auto">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <img src="./images/forecasting-icon.png" class="card-img" alt="" style="width: 9rem;">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Perkiraan Bulan Depan </h5>
                                <span class="h2 font-weight-bold mb-0">
                                    <label id="periodBalance">
                                        58
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1>Forecasting</h1>
                    <form action="" method="POST">
                        <select name="select_tahun_grafik" onchange="submit()">
                            <?php 
                                foreach ($tahun_list as $array_value){
                                    if ($array_value == $_SESSION['tahun_grafik']){
                                        echo "<option value='$array_value' selected>$array_value</option>";
                                    }else{
                                        echo "<option value='$array_value'>$array_value</option>";
                                    }
                                } 
                            ?>
                        </select>
                        <select name="select_tipe_telur" onchange="submit()">
                            <?php
                                for ($i = 0; $i<2; $i++ ){
                                    if ($tipe_telur_list[$i] == $_SESSION['tipe_telur']){
                                        echo "<option value='$tipe_telur_list[$i]' selected>$tipe_telur_label[$i]</option>";
                                    }else{
                                        echo "<option value='$tipe_telur_list[$i]'>$tipe_telur_label[$i]</option>";
                                    }
                                } 
                            ?>
                        </select>
                    </form>
                </div>
                <form action="" method="POST">
                    <div class="card-body barchart">
                        <table>
                            <tr class="tr-bar">
                            <?php 
                                $selected_tahun_grafik = $_SESSION['tahun_grafik'];
                                $selected_tipe_telur = $_SESSION['tipe_telur'];
                                $select_from_forecasting = mysqli_query($connection,"SELECT * FROM forecasting WHERE tahun = $selected_tahun_grafik");
                                $nilai_yang_lalu = 0;
                                $warna_bar = 'green';
                                for ($i = 0; $i<12; $i++ ){
                                    foreach ($select_from_forecasting as $row){ 
                                        if ($row[$selected_tipe_telur] < $nilai_yang_lalu){
                                            $warna_bar = 'red';
                                        }else{
                                            $warna_bar = 'green';
                                        }
                                        if ($monthIND[$i] == $row['bulan']){ ?>
                                            <td class="td-bar">
                                                <div class="div-bar" <?= barColor($warna_bar, $row[$selected_tipe_telur]) ?>><?= $row[$selected_tipe_telur] ?></div>
                                            </td>
                                        <?php $nilai_yang_lalu = $row[$selected_tipe_telur];
                                    }}} ?>
                            </tr>
                            <tr>
                                <td>
                                    <!-- divider -->
                                </td>
                            </tr>
                            <tr>
                                <td>Januari</td>
                                <td>Februari</td>
                                <td>Maret</td>
                                <td>April</td>
                                <td>Mei</td>
                                <td>Juni</td>
                                <td>Juli</td>
                                <td>Agustus</td>
                                <td>September</td>
                                <td>Oktober</td>
                                <td>November</td>
                                <td>Desember</td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1>Data Penjualan</h1>
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                2021
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="#">2022</a></li>
                                <li><a class="dropdown-item" href="#">2023</a></li>
                            </ul>
                        </div>
                    </div>
                    <div style="margin: 35px;" class="position-absolute top-0 end-0"><button type=" button" class="btn btn-primary btn-lg">Edit</button></div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Telur Ayam Kampung</th>
                                            <th scope="col">Telur Ayam Kota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--
                                        <?php
                                        foreach ($select_terjual_from_tbriwayat as $data) {
                                        ?> -->
                                        <tr>
                                            <td>
                                                <!-- <?= $data['waktu'] ?> -->
                                            </td>
                                            <td>
                                                <!-- <?= $data['judul_buku'] ?> -->
                                            </td>
                                            <td>
                                                <!--  <?= $data['perubahan_stok'] ?> -->
                                            </td>
                                        </tr>
                                        <!--<?php } ?> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>