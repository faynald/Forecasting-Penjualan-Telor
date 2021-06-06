<?php
function barColor($color, $height){
    $height = $height;
    echo "style='background: $color; height: $height%;'";
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
                    Tahun : 
                    <select name="select_tahun">
                        <option value="2020">2020</option>
                        <option value="2021" selected>2021</option>
                        <option value="2022">2022</option>
                    </select>
                </div>
                <form action="" method="POST">
                    <div class="card-body barchart">
                        <table>
                            <tr class="tr-bar">
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('green', '50') ?>>50</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('red', '46') ?>>46</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('red', '44') ?>>44</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('green', '58') ?>>58</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('green', '71') ?>>71</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('red', '65') ?>>75</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('green', '73') ?>>73</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('green', '78') ?>>78</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('green', '80') ?>>80</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('red', '90') ?>>90</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('green', '100') ?>>100</div>
                                </td>
                                <td class="td-bar">
                                    <div class="div-bar" <?= barColor('red', '97') ?>>97</div>
                                </td>
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
                    <div class="card-footer">
                        <button type="submit" name="submitbutton" class="btn btn-primary">Hitung</button>
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