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

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Charts</title>
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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-vote-yea"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PEMILU <sup>2.0</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Perolehan Suara
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="perolehanSuara.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Database
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kandidat</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Kandidat:</h6> -->
                        <a class="collapse-item" href="tambahKandidat.php">Tambah Kandidat</a>
                        <a class="collapse-item" href="daftarKandidat.php">Daftar Kandidat</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>DPT</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Daftar Pemilih Tetap</h6> -->
                        <a class="collapse-item" href="tambahDPT.php">Tambah DPT</a>
                        <a class="collapse-item" href="verifDPT.php">Verifikasi DPT</a>
                        <a class="collapse-item" href="dataDPT.php">DPT Terverifikasi</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-map-marker-alt"></i>
                    <span>TPS</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Login Screens:</h6> -->
                        <a class="collapse-item" href="tambahTPS.php">Tambah TPS</a>
                        <a class="collapse-item" href="daftarTPS.php">Daftar TPS</a>
                        <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a> -->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
                    <h1 class="h3 mt-2 ml-2 text-gray-800">Grafik</h1>
                   
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["user"]["USERNAME"] ?></span>
                                <img class="img-profile rounded-circle" src="images/default.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->

                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik bar berdararkan Angkatan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="BarChart" ></canvas>
                                    </div>
                                    <hr>
                                    Chart ini menunjukkan jumlah suara yang diperoleh oleh masing - masing calon berdasarkan Angkatan.
                                </div>
                            </div>

                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Suara Masuk</h6>
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
                                    <hr>
                                    Chart ini menunjukkan jumlah suara yang diperoleh oleh masing - masing calon.
                                </div>
                            </div>
                        </div>

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
                    data:   [<?php while ($b = mysqli_fetch_array($count)) {
                                echo '"' . $b['A'] . '",';
                            } ?>],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', ],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 2
                }]
            },
            options: {
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
                // scales: {
                //     xAxes: [{
                //         barPercentage: 0.5,
                //         barThickness: 6,
                //         maxBarThickness: 8,
                //         minBarLength: 2,
                //         gridLines: {
                //             offsetGridLines: true
                //         }
                //     }]
                // },
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
                            data:   [<?php while ($b = mysqli_fetch_array($countAngkatan)) {
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
                    fullWidth : false,
                    position : 'bottom',
                    boxWidth : '1000',
                    padding : 10,
                    labels: {
                        fontColor: 'rgb(255, 255, 132)'
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
                        data:   [<?php while ($b = mysqli_fetch_array($countJurusan)) {
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
                    fullWidth : false,
                    position : 'bottom',
                    boxWidth : '1000',
                    padding : 10,
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