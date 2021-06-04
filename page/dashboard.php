<?php
$may = 0;
if (isset($_POST['submitbutton'])) {
    $january = $_POST['january'];
    $february = $_POST['february'];
    $march = $_POST['march'];
    $april = $_POST['april'];
    $monthlist = [$january, $february, $march];
    $count = count($monthlist);
    $weight = [0.1, 0.2, 0.7];
    $may = ($monthlist[$count - 3] * $weight[0]) + ($monthlist[$count - 2] * $weight[1]) + ($monthlist[$count - 1] * $weight[2]);
    // 1. deklarasi variable array
    // 2. mengetahui banyaknya data. jika data 4 = pake weight 4321
    //      jika data 3 = pake weight 532 atay 721
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-md-4 mx-auto">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <img src="./images/book sold.png" class="card-img" alt="" style="width: 9rem;">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Penjualan Hari Ini </h5>
                                <!--<span class="h2 font-weight-bold mb-0">
                                    <label id="periodBalance">
                                        <?= $count_terjual ?>
                                    </label> -->
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                    <i class="ni ni-chart-bar-32"></i>
                                </div>
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
                    <img src="./images/book.png" class="card-img" alt="" style="width: 9rem;">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 ">Perkiraan Penjualan Bulan depan</h5>
                                <!--<span class="h2 font-weight-bold mb-0"><label id="balance"><?= $count_stoktersedia ?></label></span> -->
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="ni ni-chart-pie-35"></i>
                                </div>
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
                </div>
                <form action="" method="POST">
                    <div class="card-body">
                        <label for="">January :</label>
                        <input name="january" type="number" size="10"><br>
                        <label for="">February :</label>
                        <input name="february" type="number" size="10"><br>
                        <label for="">March :</label>
                        <input name="march" type="number" size="10"><br>
                        <label for="">April :</label>
                        <input name="april" type="number" size="10"><br>
                        <!-- <label for="">May : <?= $may ?></label> -->
                        <label for="">=====hasil======</label><br>
                        <label for="">perkiraan april : <?= $may ?></label><br>
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
                    <div class="position-absolute top-0 start-0"></div>
                    <button type="button" class="btn btn-primary">Primary</button>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Waktu</th>
                                            <th scope="col">Judul Buku</th>
                                            <th scope="col">Jumlah Terjual</th>
                                            <th scope="col">Nama Pembeli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($select_terjual_from_tbriwayat as $data) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $data['waktu'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['judul_buku'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['perubahan_stok'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['nama_pembeli'] ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
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