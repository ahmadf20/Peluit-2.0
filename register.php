<?php
  require_once("config.php");
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>
  <link rel="icon" href="vote.jpg">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    <?php 
      if (isset($_POST['register']) && isset($_SESSION['alert'])){
      echo "<div class='alert alert-danger alert-dismissible fade show' style='margin-top:15px; margin-bottom:-30px;' role='alert'>
        <strong>Ditolak!</strong> NPM anda sudah terdaftar, klik <a class='alert-link' href='login.php'> di sini</a> untuk login.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>"; }
    ?>
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block" style="background:url(vendor/register.jpg);background-position:center;background-size:cover"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="NPM" name="npm" maxlength="12" autofocus required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="Nama Lengkap" name="nama" maxlength="30" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="Tempat, tangal lahir" name="ttl" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" placeholder="Jurusan" name="jurusan" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" placeholder="Angkatan" name="angkatan" maxlength="4" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="Alamat" name="alamat" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-control-user" placeholder="Email" name="email" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" placeholder="Nomor Telp" name="telp" maxlength="12" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" placeholder="Password" name="pass" maxlength="12" required>
                </div>
                <div class="form-group">
                  <p>Upload foto anda di sini: </p>
                  <input type="file" class="mb-2" name="Foto" required>
                </div>
                <input type="submit" value="Register Account" name="register" class="btn btn-primary btn-user btn-block">
              </form>

              <?php
              if (isset($_POST['register'])) {
                // ambil data dari formulir
                $ttl = $_POST['ttl'];
                $telp = $_POST['telp'];
                $jurusan = $_POST['jurusan'];
                $angkatan = $_POST['angkatan'];
                $alamat = $_POST['alamat'];

                $Foto = $_FILES['Foto']['name'];
                $tmp = $_FILES['Foto']['tmp_name'];

                // filter data yang diinputkan
                $name = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                $npm = filter_input(INPUT_POST, 'npm', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

                //rename foto
                $fotobaru = "$npm";

                // Set path folder tempat menyimpan fotonya
                $path = "images/$fotobaru";
                move_uploaded_file($tmp, $path);
                // menyiapkan query untuk table mahasiswa
                $sql = "INSERT INTO mahasiswa (npm, nama, ttl, no_telepon, email, jurusan, angkatan, alamat, Foto) 
                          VALUES (:npm, :nama, :ttl, :telp, :email, :jurusan, :angkatan, :alamat, :fotobaru)";
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
                  ":fotobaru" => $fotobaru
                );

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($params);
                $username = filter_input(INPUT_POST, 'npm', FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
  
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
                  header("Location: login.php");
                } else {
                  $_SESSION["alert"] = true;
                }
              }

              ?>
              <hr>
              <div class="text-center">
                <a class="small" href="forgotPassword.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
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

</body>

</html>