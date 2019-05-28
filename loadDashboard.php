<?php
require_once("auth.php");
require_once("config.php");

$koneksi     = mysqli_connect("localhost", "root", "", "peluit");
$noUrut       = mysqli_query($koneksi, "SELECT * FROM VOTE GROUP BY NO_URUT");
$count     = mysqli_query($koneksi, "SELECT COUNT(NO_URUT) as A FROM VOTE GROUP BY NO_URUT");
$angkatan    = mysqli_query($koneksi, "SELECT mahasiswa.angkatan as angkatan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Angkatan");
$countAngkatan   = mysqli_query($koneksi, "SELECT COUNT(Angkatan) as FrekuensiAngkatan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Angkatan");
$jurusan   = mysqli_query($koneksi, "SELECT mahasiswa.Jurusan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Jurusan");
$countJurusan   = mysqli_query($koneksi, "SELECT COUNT(Jurusan) as FrekuensiJurusan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Jurusan");

$sql = "SELECT count(*) as A FROM vote";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT count(*) as A FROM mahasiswa WHERE validasi = 1";
$stmt = $db->prepare($sql);
$stmt->execute();
$jumlahMhs = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>
    <link rel="icon" href="vote.jpg">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="vendor/chart.js/Chart.bundle.js"></script>



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pemilih</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlahMhs["A"] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sudah memilih</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result["A"] . " (" . number_format(($result["A"] / $jumlahMhs["A"] * 100), 2, ".", "") . "%)"; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum memilih</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlahMhs["A"] - $result["A"] . " (" . number_format(((($jumlahMhs["A"] - $result["A"]) / $jumlahMhs["A"]) * 100), 2, ".", "") . "%)"; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-times fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Chart berdasarkan angkatan</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="BarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Perolehan Suara</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-4">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> #1
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> #2
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> #3
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">
                            <!-- Bar Chart 2-->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart berdararkan Jurusan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="BarChart#2"></canvas>
                                    </div>
                                    <hr>
                                    Chart ini menunjukkan jumlah suara yang diperoleh oleh masing - masing calon berdasarkan Jurusan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';


        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [<?php while ($b = mysqli_fetch_array($noUrut)) {
                                echo '"' . $b['NO_URUT'] . '",';
                            } ?>],
                datasets: [{
                    label: '# of Votes',
                    data: [<?php while ($b = mysqli_fetch_array($count)) {
                                echo '"' . $b['A'] . '",';
                            } ?>],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', ],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                animation: {
                    duration : 0,
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                    fullWidth: false,
                    position: 'bottom',
                    boxWidth: '1000',
                    padding: 30,
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

        // Bar Chart Angkatan
        var ctx = document.getElementById("BarChart");
        var BarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php while ($b = mysqli_fetch_array($angkatan)) {
                                echo '"' . $b['angkatan'] . '",';
                            } ?>],
                datasets: [{
                    label: '# of Votes',
                    data: [<?php while ($b = mysqli_fetch_array($countAngkatan)) {
                                echo '"' . $b['FrekuensiAngkatan'] . '",';
                            } ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                animation: {
                    duration : 0,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            autoSkip: false,
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 50,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }]
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                    fullWidth: false,
                    position: 'bottom',
                    boxWidth: '1000',
                    padding: 10,
                    labels: {
                        fontColor: 'rgb(255, 255, 132)'
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
            },
        });

        // Bar Chart Jurusan
        var ctx = document.getElementById("BarChart#2");
        var BarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php while ($b = mysqli_fetch_array($jurusan)) {
                                echo '"' . $b['Jurusan'] . '",';
                            } ?>],
                datasets: [{
                    label: '# of Votes',
                    data: [<?php while ($b = mysqli_fetch_array($countJurusan)) {
                                echo '"' . $b['FrekuensiJurusan'] . '",';
                            } ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                animation: {
                    duration : 0,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 50,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }]
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                    fullWidth: false,
                    position: 'bottom',
                    boxWidth: '1000',
                    padding: 10,
                    labels: {
                        fontColor: 'rgb(255, 255, 132)'
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
            },
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>