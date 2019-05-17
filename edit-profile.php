<!-- 
    TAMBAHKAN FUNGSI UPDATE SAAT DI PENCET TOMBOL DONE, LALU MENAMPIKAN PROFILE.PHP KEMBALI
 -->

 <?php

  require_once("config.php");
  require_once("auth.php");

  //---select data-----
  $npm = $_SESSION["user"]["USERNAME"];
  
  $sql = "SELECT * FROM mahasiswa WHERE $npm=mahasiswa.npm";
  $stmt = $db->prepare($sql);

  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  

   //----updating data-----
if(isset($_POST['edit'])){

  // ambil data dari formulir
  $ttl = $_POST['ttl'];
  $telp = $_POST['telp'];
  $jurusan = $_POST['jurusan'];
  $angkatan = $_POST['angkatan'];
  $alamat = $_POST['alamat'];
  $password = $_POST['password'];

  // filter data yang diinputkan
  $name = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
  $npm = filter_input(INPUT_POST, 'npm', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'npm', FILTER_SANITIZE_STRING);
  //! $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  // enkripsi password
  // $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

  // menyiapkan query untuk table mahasiswa
  $sql = "UPDATE mahasiswa SET npm=:npm, nama=:nama, ttl=:ttl, no_telepon=:telp, email=:email, jurusan=:jurusan, angkatan=:angkatan, alamat=:alamat WHERE npm=:npm";
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
      ":alamat" => $alamat
  );

 
  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);

  // jika query simpan berhasil, maka user sudah terdaftar
  // maka alihkan ke halaman login
  if($saved) {
    header("Location: profile.php");
    $_SESSION["alert"] = true;
  };
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

  <title>Edit Profile</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit Your Data!</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group">
                  <input type="text" readonly class="form-control form-control-user" id="exampleFirstName" placeholder="Student ID" value="<?php echo $result["NPM"]; ?>" name="npm" maxlength="12">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Full Name" value="<?php echo $result["Nama"]; ?>" name="nama" maxlength="30">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Place & Birth Date" value="<?php echo $result["TTL"]; ?>" name="ttl">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleInputPassword" placeholder="Major" value="<?php echo $result["Jurusan"]; ?>" name="jurusan">
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Graduation Year" value="<?php echo $result["Angkatan"]; ?>" name="angkatan" maxlength="4">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Address" value="<?php echo $result["Alamat"]; ?>" name="alamat">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" value="<?php echo $result["Email"]; ?>" name="email">
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Phone Number" value="<?php echo $result["No_Telepon"]; ?>" name="telp" maxlength="12">
                  </div>
                </div>
                <div class="form-group">
                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" value="<?php echo $_SESSION["user"]["PASSWORD"]; ?>" name="password" maxlength="16">
                </div>
                <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                  Register Account
                </a> -->
                <input type="submit" value="Done" name="edit" class="btn btn-primary btn-user btn-block" style="display:inline;width:30%; margin-right:0px; margin-left:auto; margin-top:8px; float:right; margin-bottom:50px">
                <a href="profile.php" class="btn btn-secondary btn-user btn-block" style="display:inline;width:30%; margin-right:10px; margin-left:auto; margin-top:8px; float:right">Cancel</a>
              </form>
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
