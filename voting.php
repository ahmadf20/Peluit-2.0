<?php

require_once("config.php");
require_once("auth.php");

$npm = $_SESSION["user"]["USERNAME"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

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

                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <!-- Page Heading -->
                    <div class="container">
                        <h1 class="h3 ml-3 mb-2 text-gray-800">Daftar Calon</h1>
                        <p class="mb-4 ml-3">Pilih calon yang sesuai dengan hati nurani anda.</p>
                        <div class='alert alert-primary alert-dismissible fade show' style='margin-top:10px; margin-bottom:30px; ' role='alert'>
                            <strong>Selamat Datang!</strong> Silakan klik tombol <strong>Vote</strong> untuk memilih. Anda dapat membaca visi, misi dan profil masing masing calon di bawah ini.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='row justify-content-around align-items-around' style='margin-bottom:50px;'>
                            <?php
                            require("Library.php");
                            $Lib = new Library();
                            $show = $Lib->showKandidatVote();
                            while ($data = $show->fetch(PDO::FETCH_OBJ)) { ?>
                                <?php
                                //select dari table mahasiswa untuk mengambil nama
                                $sql = "SELECT * FROM mahasiswa WHERE NPM=$data->NPM";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>

                                <div class='col-md col-sm-12 col-bg-4 align-items-around text-center' style='margin-top:10px;'>
                                    <div class='card shadow-lg mb-5' style='max-width:500px; margin:0 auto;'>
                                        <img src='vendor/calon1.jpg' class='card-img-top' alt='...'>
                                        <div class='card-body'>
                                            <h5 class='card-title'> <?php echo $result["Nama"] ?> </h5>
                                            <p class='card-text'><?php echo substr($data->VISI, 0, 100) ?>...</p>
                                            <a href='exitPage.php?<?php echo "NPM=$npm&noUrut=$data->NO_URUT&kodeTPS=12345" ?>' class='btn btn-primary' style=' padding-left: 30px; padding-right: 30px'> Vote </a>
                                            <hr>
                                            <a href='#' class='card-link'>Card link</a>
                                            <a href='#' class='card-link'>Another link</a>
                                        </div>
                                        <div class='card-footer'>
                                            <small class='text-muted'><?php echo $data->NPM ?></small>
                                        </div>
                                        <div class='accordion' id='accordionExample<?php echo $data->NO_URUT ?>'>

                                            <div class='card'>
                                                <div class='card-header' id='headingOne<?php echo $data->NO_URUT ?>'>
                                                    <h2 class='mb-0'>
                                                        <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapseOne<?php echo $data->NO_URUT ?>' aria-expanded='true' aria-controls='collapseOne'>
                                                            VISI
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id='collapseOne<?php echo $data->NO_URUT ?>' class='collapse' aria-labelledby='headingOne' data-parent='#accordionExample<?php echo $data->NO_URUT ?>'>
                                                    <div class='card-body'>
                                                        <?php echo $data->VISI ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='card'>
                                                <div class='card-header' id='headingTwo<?php echo $data->NO_URUT ?>'>
                                                    <h2 class='mb-0'>
                                                        <button class='btn btn-link collapsed' type='button' data-toggle='collapse' data-target='#collapseTwo<?php echo $data->NO_URUT ?>' aria-expanded='false' aria-controls='collapseTwo'>
                                                            MISI
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id='collapseTwo<?php echo $data->NO_URUT ?>' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionExample<?php echo $data->NO_URUT ?>'>
                                                    <div class='card-body'>
                                                        <?php echo $data->MISI ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->


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

