<?php

require_once("config.php");
require("Library.php");
require("auth.php");

$npm = $_SESSION["user"]["USERNAME"];
    //select dari table mahasiswa untuk mengambil nama pemilih
    $sql = "SELECT * FROM mahasiswa WHERE NPM=$npm";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $kode = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pengambilan Suara</title>
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

                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <!-- Page Heading -->
                    <div class="container">
                        <div class="row ml-2">
                            <div class="col-1">
                                <img class="img-profile rounded-circle border shadow" src="images/<?php echo $npm?>" width='65' height='65'>
                            </div>
                            <div class="col">
                                <h1 class="h3 mb-2 text-gray-800">Selamat datang, <strong><?php echo $kode['Nama']; ?>!</strong></h1>
                                <p class="mb-4">Silakan klik tombol <span class="badge badge-primary">Vote</span> untuk memilih. Anda dapat membaca visi dan misi masing masing calon di bawah ini.</p>
                            </div>
                        </div>
                        <hr class="mt-0 mb-3">
                        <div class='row justify-content-around align-items-around' style='margin-bottom:50px;'>
                                <?php
                            $Lib = new Library();
                            //mengambil data dari tabel kandidat
                            $show = $Lib->showKandidatVote();
                            while ($data = $show->fetch(PDO::FETCH_OBJ)) { ?>
                                <?php
                                    //select dari table mahasiswa untuk mengambil data kandidat dari mahasiswa
                                    $showData = $Lib->showPerson($data->NPM);
                                    $dataMhs = $showData->fetch(PDO::FETCH_OBJ);
                                ?>

                                <div class='col-md-6 col-sm-12 col-bg-4 align-items-around text-center' style='margin-top:10px;'>
                                    <div class='card shadow-lg mb-5' style='max-width:500px; margin:0 auto;'>
                                        <img src='images/<?php echo $data->NPM?>' class='card-img-top' alt='...'>
                                        <!-- <img src='images/$data->NPM' width='100' height='100'> -->
                                        <div class='card-body'>
                                            <h5 class='card-title'> <?php echo $dataMhs->Nama ?> </h5>
                                            <p class='card-text'><?php echo substr($data->VISI, 0, 100) ?>...</p>
                                            <a href='exitPage.php?<?php echo "NPM=$npm&noUrut=$data->NO_URUT&kodeTPS=12345" ?>' class='btn btn-primary' style=' padding-left: 30px; padding-right: 30px'> Vote </a>
                                            <hr>
                                            <!-- Button trigger modal -->
                                            <a href="#" class="card-link"" data-toggle="modal" data-target="#exampleModalScrollable<?php echo $dataMhs->NPM ?>">
                                            Lihat profil
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalScrollable<?php echo $dataMhs->NPM ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <div class="form-group">
                                                        <h1 class="h6  text-gray-800">Student ID : </h1>
                                                        <input type="text" readonly class="form-control" value="<?php echo $dataMhs->NPM ?>" name="npm">
                                                    </div>
                                                    <div class="form-group">
                                                        <h1 class="h6  text-gray-800">Nama Lengkap : </h1>
                                                        <input type="text" class="form-control " value="<?php echo $dataMhs->Nama ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <h1 class="h6  text-gray-800">Tempat & Tanggal Lahir : </h1>
                                                        <input type="text" class="form-control " value="<?php echo $dataMhs->TTL; ?>" readonly>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <h1 class="h6  text-gray-800">Jurusan : </h1>
                                                            <input type="text" class="form-control" value="<?php echo $dataMhs->Jurusan; ?>" readonly>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h1 class="h6  text-gray-800">Angkatan : </h1>
                                                            <input type="number" class="form-control" value="<?php echo $dataMhs->Angkatan; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h1 class="h6  text-gray-800">Alamat : </h1>
                                                        <input type="text" class="form-control " value="<?php echo $dataMhs->Alamat; ?>" readonly>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <h1 class="h6  text-gray-800">Email : </h1>
                                                            <input type="email" class="form-control " Address" value="<?php echo $dataMhs->Email; ?>" name="email" readonly>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h1 class="h6  text-gray-800">No Telepon : </h1>
                                                            <input type="number" class="form-control" value="<?php echo $dataMhs->No_Telepon; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary">Done</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- <a href='#' class='card-link'>Another link</a> -->
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

