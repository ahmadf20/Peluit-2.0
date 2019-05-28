<?php
require_once("auth.php");
require_once("config.php");

if (isset($_POST['register'])) {

    // ambil data dari formulir
    $ttl = $_POST['ttl'];
    $telp = $_POST['telp'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];

    $Foto = $_FILES['Foto']['name'];
    $tmp = $_FILES['Foto']['tmp_name'];

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $npm = filter_input(INPUT_POST, 'npm', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'npm', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $validasi = 1; 
    //rename foto
    $fotobaru = "$npm";

    // Set path folder tempat menyimpan fotonya
    $path = "images/$fotobaru";
    move_uploaded_file($tmp, $path);
    // menyiapkan query untuk table mahasiswa
    $sql = "INSERT INTO mahasiswa (npm, nama, ttl, no_telepon, email, jurusan, angkatan, alamat, Foto, Validasi) 
    VALUES (:npm, :nama, :ttl, :telp, :email, :jurusan, :angkatan, :alamat, :fotobaru, :validasi)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":npm" => $npm,
        ":nama" => $name,
        ":ttl" => $ttl,
        ":telp" => $telp,
        ":email" => $email,
        ":jurusan" => $jurusan,
        ":angkatan" => $angkatan,
        ":alamat" => $alamat,
        ":fotobaru" => $fotobaru,
        ":validasi" => $validasi
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // menyiapkan query untuk table akun
    $sql = "INSERT INTO akun (username, password) 
            VALUES (:username, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":password" => $password
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if ($saved) {
        header("tambahDPT.php");
    } else {
        $_SESSION["alert"] = true;
    }
}
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="daftarKandidat.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-vote-yea"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PEMILU <sup>2.0</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="daftarKandidat.php">
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
                        <a class="collapse-item active" href="tambahDPT.php">Tambah DPT</a>
                        <a class="collapse-item" href="verifDPT.php">Verifikasi DPT</a>
                        <a class="collapse-item" href="editDPT.php">Edit Data</a>
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
                        <!-- <a class="collapse-item" href="for`got`-password.html">Forgot Password</a>
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

                    <h1 class="h3 mt-2 ml-2 text-gray-800">Tambah Daftar Pemilih</h1>

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
                <div class="container-fluid pr-3 pl-3">
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
                            echo "<div class='alert alert-danger alert-dismissible fade show ml-4 mr-4' style='margin-top:15px; margin-bottom:-20px' role='alert'>
                                <strong>Error!</strong> NPM yang anda masukkan sudah terdaftar. Silakan coba lagi.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                        }
                    }
                    ?>
                    
                    <div class="card o-hidden shadow border-0 ml-4 mr-4 mb-5 mt-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="p-5">
                                    <div class="text-center">
                                    </div>
                                    <form class="user" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <h1 class="h6  text-gray-800">Student ID : </h1>
                                            <input type="text" class="form-control" id="customControlValidation1" name="npm" maxlength="12" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <h1 class="h6  text-gray-800">Nama Lengkap : </h1>
                                            <input type="text" class="form-control  " id="exampleFirstName" name="nama" maxlength="30" required>
                                        </div>
                                        <div class="form-group">
                                            <h1 class="h6  text-gray-800">Tempat & Tanggal Lahir : </h1>
                                            <input type="text" class="form-control  " id="exampleFirstName" name="ttl" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <h1 class="h6  text-gray-800">Jurusan : </h1>
                                                <input type="text" class="form-control  " id="exampleInputPassword" name="jurusan" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <h1 class="h6  text-gray-800">Angkatan : </h1>
                                                <input type="number" class="form-control  " id="exampleRepeatPassword" name="angkatan" maxlength="4" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h1 class="h6  text-gray-800">ِِAlamat : </h1>
                                            <input type="text" class="form-control  " id="exampleFirstName" name="alamat" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <h1 class="h6  text-gray-800">Email : </h1>
                                                <input type="email" class="form-control  " id="exampleInputEmail" name="email" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <h1 class="h6  text-gray-800">No Telepon : </h1>
                                                <input type="number" class="form-control  " id="exampleRepeatPassword" name="telp" maxlength="12" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h1 class="h6  text-gray-800">Password : </h1>
                                            <input type="password" class="form-control  " id="exampleInputPassword" name="password" maxlength="12" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Upload foto anda di sini: </p>
                                            <input type="file" class="mb-2" name="Foto" required>
                                        </div>

                                        <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">Register Account</a> -->
                                        <input type="submit" value="Tambah Data" name="register" class="float-right mb-5 mt-3 btn btn-primary">
                                    </form>
                                </div>

                                <div class="col-lg-6 d-none d-lg-block" style="background:url(vendor/calon2.jpg);background-position:center;background-size:cover">
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

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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