<?php
  require_once("config.php");
  require("Library.php");

    //---select data-----
    $sql = "SELECT count(*) as A FROM vote";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT count(*) as A FROM mahasiswa WHERE validasi = 1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $jumlahMhs = $stmt->fetch(PDO::FETCH_ASSOC);

    $koneksi     = mysqli_connect("localhost", "root", "", "peluit");
    $noUrut       = mysqli_query($koneksi, "SELECT * FROM VOTE GROUP BY NO_URUT");
    $count     = mysqli_query($koneksi, "SELECT COUNT(NO_URUT) as A FROM VOTE GROUP BY NO_URUT");
    $angkatan    = mysqli_query($koneksi, "SELECT mahasiswa.angkatan as angkatan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Angkatan");
    $countAngkatan   = mysqli_query($koneksi, "SELECT COUNT(Angkatan) as FrekuensiAngkatan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Angkatan");
    $jurusan   = mysqli_query($koneksi, "SELECT mahasiswa.Jurusan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Jurusan");
    $countJurusan   = mysqli_query($koneksi, "SELECT COUNT(Jurusan) as FrekuensiJurusan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Jurusan");
    $No = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>

<body class="bg-primary">
                
    <!-- Earnings (Monthly) Card Example -->
    <div class="mt-5">
        <div class="card border-left-success shadow ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Suara Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format(($result["A"] / $jumlahMhs["A"] * 100), 2, ".", "") . "%"; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class='row justify-content-around align-items-around' style='margin-bottom:50px;'>
            

            <?php
            $Lib = new Library();
            //mengambil data dari tabel kandidat
            $show = $Lib->showKandidatVote();
            
            while (($data = $show->fetch(PDO::FETCH_OBJ)) && ($b = mysqli_fetch_array($count))) { 
                    $no[] = $b['A'];
                ?>
                <?php
                    //select dari table mahasiswa untuk mengambil data kandidat dari mahasiswa
                    $showData = $Lib->showPerson($data->NPM);
                    $dataMhs = $showData->fetch(PDO::FETCH_OBJ);
                ?>


            <!-- Card Example -->
            <div class="col-xl-4 col-md-6 mt-4">
                <div class="card border-left-primary shadow">
                <div class="card-body pb-0 pt-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-6 pl-3">
                            <div class="h1 font-weight-bold text-primary text-uppercase mb-1">#<?php echo $data->NO_URUT ?></div>
                            <div class="h7 font-weight-bold text-secondary text-uppercase mb-1"><?php echo $dataMhs->Nama ?></div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($b['A']*100/$jumlahMhs['A'],2,'.','') ?>%</div>
                        </div>
                        <div class="col-6">
                            <div class="chart-pie w-5 pr-3 pl-3">
                                <canvas id="myPieChart<?php echo $data->NO_URUT ?>"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <?php }; ?>
    <?php
?>



<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

    <script>
         // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';


        var ctx = document.getElementById("myPieChart1");
        ctx.height = 50;
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [ "A", "null"],
                datasets: [{
                    label: '# of Votes',
                    data:   [<?php echo number_format($no[0]*100/$jumlahMhs['A'],2,'.','') ?>, 100-<?php echo number_format($no[0]*100/$jumlahMhs['A'],2,'.','') ?>],
                    backgroundColor: ['#4e73df'],
                    hoverBackgroundColor: ['#4e73df'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 0
                }]
            },
            options: {
                animation: {
                    duration : 0,
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgba(0,0,0,0)",
                    bodyFontColor: "rgba(255,255,255,0)",
                    borderColor: 'rgba(255,255,255,0)',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                    fullWidth : false,
                    position : 'bottom',
                    boxWidth : '1000',
                    padding : 30,
                    labels: {
                        fontColor: 'rgb(255, 99, 132)'
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                cutoutPercentage: 80,
            },
        });
        var ctx = document.getElementById("myPieChart2");
        ctx.height = 50;
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [ "A", "null"],
                datasets: [{
                    label: '# of Votes',
                    data:   [<?php echo number_format($no[1]*100/$jumlahMhs['A'],2,'.','') ?>, 100-<?php echo number_format($no[1]*100/$jumlahMhs['A'],2,'.','') ?>],
                    backgroundColor: ['#4e73df'],
                    hoverBackgroundColor: ['#4e73df'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 0
                }]
            },
            options: {
                animation: {
                    duration : 0,
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgba(0,0,0,0)",
                    bodyFontColor: "rgba(255,255,255,0)",
                    borderColor: 'rgba(255,255,255,0)',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                    fullWidth : false,
                    position : 'bottom',
                    boxWidth : '1000',
                    padding : 30,
                    labels: {
                        fontColor: 'rgb(255, 99, 132)'
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                cutoutPercentage: 80,
            },
        });
        var ctx = document.getElementById("myPieChart3");
        ctx.height = 50;
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [ "A", "null"],
                datasets: [{
                    label: '# of Votes',
                    data:   [<?php echo number_format($no[2]*100/$jumlahMhs['A'],2,'.','') ?>, 100-<?php echo number_format($no[2]*100/$jumlahMhs['A'],2,'.','') ?>],
                    backgroundColor: ['#4e73df'],
                    hoverBackgroundColor: ['#4e73df'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 0
                }]
            },
            options: {
                animation: {
                    duration : 0,
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgba(0,0,0,0)",
                    bodyFontColor: "rgba(255,255,255,0)",
                    borderColor: 'rgba(255,255,255,0)',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                    fullWidth : false,
                    position : 'bottom',
                    boxWidth : '1000',
                    padding : 30,
                    labels: {
                        fontColor: 'rgb(255, 99, 132)'
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                cutoutPercentage: 80,
            },
        });
        
    </script>
</body>

</html>

