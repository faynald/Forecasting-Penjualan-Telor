<?php
function barColor($color, $height, $nilaiterbesar){
    $height = $height/$nilaiterbesar*100;
    echo "style='background: $color; height: $height%;'";
}
$monthIND = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$select_forecasting = mysqli_query($connection, "SELECT * FROM forecasting");
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
$selected_tahun_grafik = $_SESSION['tahun_grafik'];
$selected_tipe_telur = $_SESSION['tipe_telur'];
$select_from_forecasting = mysqli_query($connection,"SELECT * FROM forecasting WHERE tahun = $selected_tahun_grafik");
// mulai mencari nilai terbesar
$select_from_forecasting_nilai_terbesar = mysqli_query($connection,"SELECT * FROM forecasting WHERE tahun = $selected_tahun_grafik ORDER BY $selected_tipe_telur DESC LIMIT 1");
$temp_nilai_terbesar = 0;
foreach ($select_from_forecasting_nilai_terbesar as $row){
    $temp_nilai_terbesar = $row[$selected_tipe_telur];
} // akhir dari mencari nilai terbesar
$list_nilai = []; // wadah nilai dari semua data yang diinputkan pada tahun tertentu
$nilai_3_terakhir = []; // untuk mendapatkan nilai 3 bulan terakhir
$data_bulan_terakhir = "";
$list_bulan_yang_ada = [];
for ($i = 0; $i<count($monthIND); $i++ ){
    foreach ($select_from_forecasting as $row){
        if ($monthIND[$i] == $row['bulan']){
            array_push($list_nilai, $row[$selected_tipe_telur]);
            array_push($list_bulan_yang_ada, $row['bulan']);
        }
    }
}
for ($i = 0; $i<3; $i++){ // memasukkan nilai 3 bulan terakhir ke variabel
    array_push($nilai_3_terakhir,$list_nilai[count($list_nilai)-3+$i]);
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
                <div class="card-body barchart">
                    <table>
                        <tr class="tr-bar">
                        <?php 
                            // menampilkan data ke grafik
                            $nilai_yang_lalu = 0;
                            $warna_bar = 'green';
                            for ($i = 0; $i < count($list_bulan_yang_ada); $i++ ){
                                $kosong = true;
                                foreach ($select_from_forecasting as $row){ 
                                    if ($row[$selected_tipe_telur] < $nilai_yang_lalu){
                                        $warna_bar = 'red';
                                    }elseif(($row[$selected_tipe_telur] > $nilai_yang_lalu)){
                                        $warna_bar = 'green';
                                    }
                                    if ($monthIND[$i] == $row['bulan']){ ?>
                                        <td class="td-bar">
                                            <div class="div-bar" <?= barColor($warna_bar, $row[$selected_tipe_telur], $temp_nilai_terbesar) ?>><?= $row[$selected_tipe_telur] ?></div>
                                        </td>
                                    <?php $kosong = false;
                                    }
                                    $nilai_yang_lalu = $row[$selected_tipe_telur];
                                }
                                if ($kosong == true){
                                    echo "<td class='td-bar'><div class='div-bar' id='bar_$monthIND[$i]_$selected_tipe_telur'></div></td>";
                                    $kosong = false;
                                }
                            } 
                            // variabel untuk mencari nilai bulan yang akan diramal
                            $bulan_yang_diramal = [];
                            $tambahkan_bulan = false;
                            foreach ($monthIND as $array_value){ // mencari bulan apa saja yang diramal
                                if($tambahkan_bulan == true){
                                    array_push($bulan_yang_diramal, $array_value);
                                }elseif ($array_value == $list_bulan_yang_ada[count($list_bulan_yang_ada)-1]){
                                    $tambahkan_bulan = true;
                                }
                            }
                            if (count($bulan_yang_diramal) == 2){ // menambahkan bulan januari jika bulan yang diramal hanya 2
                                array_push($bulan_yang_diramal, "Januari");
                            }
                            if (count($bulan_yang_diramal) == 1){ // menambahkan bulan januari dan februari jika bulan yang diramal hanya 3
                                array_push($bulan_yang_diramal, "Januari");
                                array_push($bulan_yang_diramal, "Februari");
                            }
                            // MENGHITUNG / MERAMAL Nilai Bulan Depan
                            $weight = [0.1, 0.2, 0.7];
                            for ($i = 0; $i < 3; $i++){
                                array_push($nilai_3_terakhir, ($nilai_3_terakhir[$i] * $weight[0]) + ($nilai_3_terakhir[$i+1] * $weight[1]) + ($nilai_3_terakhir[$i+2] * $weight[2]));
                            }
                            for ($i = 0; $i < count($bulan_yang_diramal); $i++ ){?>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('#DBA800', $nilai_3_terakhir[$i+3], $temp_nilai_terbesar) ?>><?= $nilai_3_terakhir[$i+3] ?></div>
                                </td>
                            <?php
                            } 
                            ?>
                        </tr>
                        <tr>
                            <td>
                                <!-- divider -->
                            </td>
                        </tr>
                        <tr>
                            <?php 
                                foreach ($list_bulan_yang_ada as $array_value){
                                    echo "<td>$array_value</td>";
                                }
                                foreach ($bulan_yang_diramal as $array_value){
                                    echo "<td>$array_value</td>";
                                }
                            ?>
                        </tr>
                    </table>
                </div>
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
    </div>
</div>
