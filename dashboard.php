<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Voting</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <h2>Daftar Buku yang Tersedia</h2>
        <table class="table">
            <tr>
                <td>NPM</td>
                <td>Nama</td>
                <td>Jurusan</td>
                <td>Angkatan</td>
                <td>TTL</td>
                <td>No Telp</td>
                <td>Email</td>
                <td>Alamat</td>
                <td>Action</td>
            </tr>
            <?php
            require("Library.php");
            $Lib = new Library();
            $show = $Lib->showMhs();
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
                <td><a class='btn btn-danger' href='list.php?delete=$data->NPM'>Delete</a></td>
                <td><a class='btn btn-info' href='edit.php?kode=$data->NPM'>Edit</td>
                <td><a class='btn btn-success' href='edit.php?kode=$data->NPM'>Validasi</td>
                </tr>";
            };
            ?>
        </table>
        <a href="index.php" class="btn btn-success">Tambah Buku Baru</a>
    </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
if (isset($_GET['delete'])) {
    $del = $Lib->deleteBook($_GET['delete']);
}
?>