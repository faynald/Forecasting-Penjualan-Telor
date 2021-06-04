
    <?php 
        $may = 0;
        if (isset($_POST['submitbutton'])){
            $january = $_POST['january'];
            $february = $_POST['february'];
            $march = $_POST['march'];
            $april = $_POST['april'];
            $monthlist = [$january, $february, $march];
            $count = count($monthlist);
            $weight = [0.1, 0.2, 0.7];
            $may = ($monthlist[$count-3]*$weight[0]) + ($monthlist[$count-2]*$weight[1]) + ($monthlist[$count-1]*$weight[2]);
            // 1. deklarasi variable array
            // 2. mengetahui banyaknya data. jika data 4 = pake weight 4321
            //      jika data 3 = pake weight 532 atay 721
        }
    ?>
    <div class="container-fluid">
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
    </div>