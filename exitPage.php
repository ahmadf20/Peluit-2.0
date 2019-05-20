<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

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
        <a class="btn btn-primary" href="login.php" role="button">Kembali ke halaman login</a>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendo r /jquer y /jquer y .mi n .j s"></script>
    <script src="vendo r /bootstra p /j s /bootstra p .bundl e .mi n .j s"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendo r /jquer y -easin g /jquer y .easin g .mi n .j s"></script>

    <!-- Custom scripts for all pages-->
    <script src="j s /s b -admi n -2 .mi n .j s"></script>

</body>

</html>

