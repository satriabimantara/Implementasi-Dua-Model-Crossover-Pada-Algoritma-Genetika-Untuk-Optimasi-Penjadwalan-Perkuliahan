<script type="text/javascript" src="../../assets/js/Chart.js"></script>
<?php
if (isset($_SESSION['btn-submit-modal-proses-genetika'])) {
    //session akan dihancurkan setelah 1 jam
    if (isset($_SESSION['time_stamp']) && time() - $_SESSION['time_stamp'] > 3600) {
        session_destroy();
        session_start();
        $objFlash->showSimpleFlash("EXPIRED", "warning", "Waktu telah kadaluarsa. Silahkan generate ulang jadwal", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
    } else {
        //echo '<pre>'; print_r($_SESSION['fitness_cycle']); echo '</pre>';
        echo "<h4 class='display-4'>Grafik Nilai Fitness</h4>";
        if (isset($_SESSION['fitness_npoint'])) {
            $fitness_npoint = json_encode($_SESSION['fitness_npoint']);
            $generasi_npoint = array();
            for ($i = 0; $i < count($_SESSION['fitness_npoint']); $i++) {
                $generasi_npoint[$i] = $i;
            }
            $x_npoint = json_encode($generasi_npoint);
?>
            <br>
            <h4 class="display-5">
                N Point Crossover
            </h4>
            <div class="row">
                <div class="col-auto" style="margin:auto;">
                    <p style="writing-mode: tb-rl; transform: rotate(-180deg); margin:auto;">Nilai Fitness</p>
                </div>
                <div class="col-8">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <script>
                        var ctx = document.getElementById("myChart").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: <?php echo $x_npoint; ?>,
                                datasets: [{
                                    label: 'N Point',
                                    backgroundColor: 'rgb(255, 0, 0)',
                                    borderColor: 'rgb(255, 0, 0)',
                                    fill: false,
                                    data: <?php echo $fitness_npoint; ?>
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                },
                            }
                        });
                    </script>
                </div>
                <div class="col" style="margin:auto;">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan=2>Keterangan</th>
                            </tr>
                        </thead>
                        <tr>
                            <th scope="row">Waktu Komputasi</th>
                            <td><?= round(($_SESSION['waktu_komputasi_akhir_npoint'] - $_SESSION['waktu_komputasi_awal_npoint']) / 60, 3); ?> Menit</td>
                        </tr>
                        <tr>
                            <th scope="row">Generasi</th>
                            <td><?= $_SESSION['max_generasi_npoint']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Kromosom</th>
                            <td><?= $_SESSION['jumlah_kromosom_npoint']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Probabilitas Cross Over</th>
                            <td><?= $_SESSION['crossover_rate_npoint']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Probabilitas Mutasi</th>
                            <td><?= $_SESSION['mutation_rate_npoint']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Generasi Optimal</th>
                            <td>
                                <?php
                                if ($_SESSION['optimal_npoint'] != 0) {
                                    echo $_SESSION['optimal_npoint'];
                                } else {
                                    echo "Belum Optimal";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-bottom:5%">
                <div class="col-9">
                    <p style="margin:auto; text-align:center;">Generasi</p>
                </div>
            </div>
        <?php
        }
        if (isset($_SESSION['fitness_cycle'])) {
            $fitness_cycle = json_encode($_SESSION['fitness_cycle']);
            $generasi_cycle = array();
            for ($i = 0; $i < count($_SESSION['fitness_cycle']); $i++) {
                $generasi_cycle[$i] = $i;
            }
            $x_cycle = json_encode($generasi_cycle);
        ?>
            <h4 class="display-5">
                Cycle Crossover
            </h4>
            <div class="row">
                <div class="col-auto" style="margin:auto;">
                    <p style="writing-mode: tb-rl; transform: rotate(-180deg); margin:auto;">Nilai Fitness</p>
                </div>
                <div class="col-8">
                    <div>
                        <canvas id="myChart2"></canvas>
                    </div>
                    <script>
                        var ctx = document.getElementById("myChart2").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: <?php echo $x_cycle; ?>,
                                datasets: [{
                                    label: 'Cycle',
                                    backgroundColor: 'rgb(0, 0, 255)',
                                    borderColor: 'rgb(0, 0, 255)',
                                    fill: false,
                                    data: <?php echo $fitness_cycle; ?>
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                },
                                margin: {
                                    left: 0,
                                    right: 0,
                                    top: 0,
                                    bottom: 0
                                }
                            }
                        });
                    </script>
                </div>
                <div class="col" style="margin:auto;">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan=2>Keterangan</th>
                            </tr>
                        </thead>
                        <tr>
                            <th scope="row">Waktu Komputasi</th>
                            <td><?= round(($_SESSION['waktu_komputasi_akhir_cycle'] - $_SESSION['waktu_komputasi_awal_cycle']) / 60, 3); ?> Menit</td>
                        </tr>
                        <tr>
                            <th scope="row">Generasi</th>
                            <td><?= $_SESSION['max_generasi_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Kromosom</th>
                            <td><?= $_SESSION['jumlah_kromosom_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Probabilitas Cross Over</th>
                            <td><?= $_SESSION['crossover_rate_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Probabilitas Mutasi</th>
                            <td><?= $_SESSION['mutation_rate_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Generasi Optimal</th>
                            <td>
                                <?php
                                if ($_SESSION['optimal_cycle'] != 0) {
                                    echo $_SESSION['optimal_cycle'];
                                } else {
                                    echo "Belum Optimal";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-bottom:5%">
                <div class="col-9">
                    <p style="margin:auto; text-align:center;">Generasi</p>
                </div>
            </div>
        <?php
        }
        if (isset($_SESSION['fitness_cycle']) && isset($_SESSION['fitness_npoint'])) {
            $generasi = array();
            for ($i = 0; $i < max(count($_SESSION['fitness_cycle']), count($_SESSION['fitness_npoint'])); $i++) {
                $generasi[$i] = $i;
            }
            $x = json_encode($generasi);
        ?>
            <h4 class="display-5">
                Perbandingan
            </h4>
            <div class="row">
                <div class="col-auto" style="margin:auto;">
                    <p style="writing-mode: tb-rl; transform: rotate(-180deg); margin:auto;">Nilai Fitness</p>
                </div>
                <div class="col-8">
                    <div>
                        <canvas id="myChart3"></canvas>
                    </div>
                    <script>
                        var ctx = document.getElementById("myChart3").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: <?php echo $x; ?>,
                                datasets: [{
                                        label: 'N Point',
                                        backgroundColor: 'rgb(255, 0, 0)',
                                        borderColor: 'rgb(255, 0, 0)',
                                        fill: false,
                                        data: <?php echo $fitness_npoint; ?>
                                    },
                                    {
                                        label: 'Cycle',
                                        backgroundColor: 'rgb(0, 0, 255)',
                                        borderColor: 'rgb(0, 0, 255)',
                                        fill: false,
                                        data: <?php echo $fitness_cycle; ?>
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                </div>
                <div class="col" style="margin:auto;padding:0;">
                    <table class="table" width=100%>
                        <thead class="thead-dark">
                            <tr>
                                <th>Keterangan</th>
                                <th style="text-align:center">N Point</th>
                                <th style="text-align:center">Cycle</th>
                            </tr>
                        </thead>
                        <tr>
                            <th scope="row">Waktu Komputasi</th>
                            <td><?= round(($_SESSION['waktu_komputasi_akhir_npoint'] - $_SESSION['waktu_komputasi_awal_npoint']) / 60, 3); ?> Menit</td>
                            <td><?= round(($_SESSION['waktu_komputasi_akhir_cycle'] - $_SESSION['waktu_komputasi_awal_cycle']) / 60, 3); ?> Menit</td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Kromosom</th>
                            <td align="center"><?php echo $_SESSION['jumlah_kromosom_npoint']; ?></td>
                            <td align="center"><?php echo $_SESSION['jumlah_kromosom_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Maksimum Generasi</th>
                            <td align="center"><?php echo $_SESSION['max_generasi_npoint']; ?></td>
                            <td align="center"><?php echo $_SESSION['max_generasi_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Crossover Rate</th>
                            <td align="center"><?php echo $_SESSION['crossover_rate_npoint']; ?></td>
                            <td align="center"><?php echo $_SESSION['crossover_rate_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Mutation Rate</th>
                            <td align="center"><?php echo $_SESSION['mutation_rate_npoint']; ?></td>
                            <td align="center"><?php echo $_SESSION['mutation_rate_cycle']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Generasi Optimal</th>
                            <td>
                                <?php
                                if ($_SESSION['optimal_npoint'] != 0) {
                                    echo $_SESSION['optimal_npoint'];
                                } else {
                                    echo "Belum Optimal";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($_SESSION['optimal_cycle'] != 0) {
                                    echo $_SESSION['optimal_cycle'];
                                } else {
                                    echo "Belum Optimal";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-bottom:5%">
                <div class="col-9">
                    <p style="margin:auto; text-align:center;">Generasi</p>
                </div>
            </div>
<?php
        }
    }
} else {
    //pesan jadwal belum ada yang digenerate
    $objFlash->showSimpleFlash("JADWAL BELUM DIGENERATE!", "error", "Belum ada informasi jadwal yang dihasilkan! Silahkan generate jadwal terlebih dahulu", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
    exit();
}
?>