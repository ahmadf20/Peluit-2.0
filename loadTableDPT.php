<?php
require_once("auth.php");
require_once("config.php");
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

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Calon Pemilih</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th>NPM</th>
                                            <th>Nama</th>
                                            <th>Jurusan</th>
                                            <th>Angkatan</th>
                                            <th>TTL</th>
                                            <th>No Telp</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th colspan="3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require("Library.php");
                                        $Lib = new Library();
                                        $show = $Lib->showMhsNoVerif();
                                        while ($data = $show->fetch(PDO::FETCH_OBJ)) {
                                            echo "
                                            <tr>
                                            <td>$data->NPM</td>
                                            <td>$data->Nama</td>
                                            <td>$data->Jurusan</td>
                                            <td>$data->Angkatan</td>
                                            <td>$data->TTL</td>
                                            <td>$data->No_Telepon</td>
                                            <td>$data->Email</td>
                                            <td>$data->Alamat</td>
                                            <td><img src='images/$data->NPM' width='100' height='100'></td>
                                            
                                            <td><a class='btn btn-outline-danger btn-sm' href='verifDPT.php?delete=$data->NPM'><i class='fas fa-user-times'></i></td>
                                            <td><a class='btn btn-outline-secondary btn-sm' href='editDPT.php?kode=$data->NPM'><i class='fas fa-user-cog'></i></td>
                                            <td><a class='btn btn-outline-success btn-sm' href='verifDPT.php?NPM=$data->NPM&check=1'><i class='fas fa-user-check'></i></td>
                                            </tr>";
                                        };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>