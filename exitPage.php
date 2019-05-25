<?php
  session_start();
  session_destroy();
  require_once("config.php");

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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="5"></meta>

    <title>Logout</title>
    <link rel="icon" href="vote.jpg">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">
    <div class="container mt-5">
        <?php
        require_once("Library.php");
        if (isset($_GET['noUrut'])) {
            $Lib = new Library();
            $validasi = $Lib->voteKandidat($_GET['noUrut'], $_GET['NPM'], $_GET['kodeTPS']);

            if ($validasi == "Success") { ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Berhasil!</h4>
                    <p>Selamat! suara anda telah masuk ke sistem database kami. Silakan klik tombol <strong>Login</strong> dibawah ini untuk kembali ke halaman login.</p>
                    <hr>
                    <p class="mb-0">Untuk informasi lebih lanjut, silakan hubungi admin.</p>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Sistem Gagal!</h4>
                    <p>Mohon maaf, suara ditolak! Anda tidak dapat meberikan suara lagi. Sistem kami mendeteksi bahwa suara anda telah masuk ke database kami.</p>
                    <hr>
                    <p class="mb-0">Untuk informasi lebih lanjut, silakan hubungi admin.</p>
                </div>
            <?php
           }
        };
        ?>
                
        <a href="login.php" role="button">← Kembali ke halaman login</a>
        
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
        </div>
<?php
    // print_r($no);
    // echo $no[0];
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

