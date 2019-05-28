<?php
require_once("auth.php");
require_once("config.php");
require('Library.php');

// echo ($_GET['kode']);
if (isset($_GET['kode'])) {
    $Lib = new Library();
    $mhs = $Lib->editMhs($_GET['kode']);
    $edit = $mhs->fetch(PDO::FETCH_OBJ);
} else {
    header('Location: verifDPT.php');
};

if (isset($_POST['edit'])) {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $ttl = $_POST['ttl'];
    $telp = $_POST['telp'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!isset($_FILES['Foto'])) {
        $Foto = $_FILES['Foto']['name'];
        $tmp = $_FILES['Foto']['tmp_name'];
        
        //rename foto
        $fotobaru = "$npm";
        // Set path folder tempat menyimpan fotonya
        $path = "images/$fotobaru";
        move_uploaded_file($tmp, $path);
    } else {
        $fotobaru = $npm;
    }
    
    $Lib = new Library();
    $upd = $Lib->updateMhs($npm, $nama, $ttl, $telp, $jurusan, $angkatan, $alamat, $email, $password, $fotobaru);
    if($upd == "Success"){
        header('Location: verifDPT.php');
    };
};
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin Dashboard</title>
        <link rel="icon" href="vote.jpg">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
                <li class="nav-item">
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
                        <i class="fas fa-fw fa-user-tie"></i>
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
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-users"></i>
                        <span>DPT</span>
                    </a>
                    <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
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

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <h1 class="h3 mt-2 ml-2 text-gray-800">Edit Data DPT</h1>

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
                        <?php
                        if (isset($_POST['register'])) {
                            if ($saved) {
                                echo "<div class='alert alert-success alert-dismissible fade show' style='margin-top:15px;' role='alert'>
                        <strong>Selamat!</strong> Data berhasil ditambahkan.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' style='margin-top:15px;' role='alert'>
                          <strong>Error!</strong> Silakan coba lagi.
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>";
                            }
                        }
                        ?>

                        <div class="card o-hidden shadow border-0  mb-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="p-5">
                                        <div class="text-center">
                                        </div>
                                        <form class="user" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <h1 class="h6  text-gray-800">Student ID : </h1>
                                                <input type="text" readonly class="form-control" id="exampleFirstName" placeholder="Student ID" value="<?php echo $edit->NPM; ?>" name="npm" maxlength="12">
                                            </div>
                                            <div class="form-group">
                                                <h1 class="h6  text-gray-800">Nama Lengkap : </h1>
                                                <input type="text" class="form-control " id="exampleFirstName" placeholder="Full Name" value="<?php echo $edit->Nama; ?>" name="nama" maxlength="30">
                                            </div>
                                            <div class="form-group">
                                                <h1 class="h6  text-gray-800">Tempat & Tanggal Lahir : </h1>
                                                <input type="text" class="form-control " id="exampleFirstName" placeholder="Place & Birth Date" value="<?php echo $edit->TTL; ?>" name="ttl">
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <h1 class="h6  text-gray-800">Jurusan : </h1>
                                                    <input type="text" class="form-control " id="exampleInputPassword" placeholder="Major" value="<?php echo $edit->Jurusan; ?>" name="jurusan">
                                                </div>
                                                <div class="col-sm-6">
                                                    <h1 class="h6  text-gray-800">Angkatan : </h1>
                                                    <input type="number" class="form-control " id="exampleRepeatPassword" placeholder="Graduation Year" value="<?php echo $edit->Angkatan; ?>" name="angkatan" maxlength="4">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h1 class="h6  text-gray-800">Alamat : </h1>
                                                <input type="text" class="form-control " id="exampleFirstName" placeholder="Address" value="<?php echo $edit->Alamat; ?>" name="alamat">
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <h1 class="h6  text-gray-800">Email : </h1>
                                                    <input type="email" class="form-control " id="exampleInputEmail" placeholder="Email Address" value="<?php echo $edit->Email; ?>" name="email">
                                                </div>
                                                <div class="col-sm-6">
                                                    <h1 class="h6  text-gray-800">No Telepon : </h1>
                                                    <input type="number" class="form-control " id="exampleRepeatPassword" placeholder="Phone Number" value="<?php echo $edit->No_Telepon; ?>" name="telp" maxlength="12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h1 class="h6  text-gray-800">Password : </h1>
                                                <input type="text" class="form-control " id="exampleInputPassword" placeholder="Password" value="<?php 
                                                    $sql = "SELECT * FROM akun WHERE username='$edit->NPM'";
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                                    echo $result['PASSWORD'];
                                                ?>" name="password" maxlength="16">
                                            </div>
                                            <div class="form-group">
                                                <p>Upload foto anda di sini: </p>
                                                <input type="file" class="mb-2" name="Foto">
                                            </div>
                                            <input type="submit" value="Done" name="edit" class="float-right mb-2 mt-3 btn btn-primary">
                                            <a href="javascript:history.go(-1)" class="btn float-right mb-2 mr-2 mt-3 btn-secondary">Cancel</a>
                                        </form>
                                    </div>

                                    <div class="col-lg-6 d-none d-lg-block" style="background:url('images/<?php echo $edit->NPM ?>');background-position:center;background-size:cover">
                                        <!-- <img src="vendor/calon2.jpg" alt=""" height="7%" class="rounded mx-auto d-block"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- End of Content Wrapper -->

        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

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
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

    </body>

    </html>

