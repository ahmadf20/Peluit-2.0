 <?php

  require_once("config.php");
  require_once("auth.php");

  $npm = $_SESSION["user"]["USERNAME"];
  
  $sql = "SELECT * FROM mahasiswa WHERE $npm=mahasiswa.npm";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Profile</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    <?php
      if(isset($_SESSION["alert"])) {
        echo "<div class='alert alert-primary alert-dismissible fade show' style='margin-top:15px; margin-bottom:-30px;' role='alert'>
        <strong>Congratulations!</strong> Your data has been updated.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";  
      };
    ?>
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Make sure your data is correct!</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group">
                  <input type="text" disabled class="form-control form-control-user" id="exampleFirstName" placeholder="Student ID : <?php echo $result["NPM"]; ?>" name="npm">
                </div>
                <div class="form-group">
                  <input type="text" disabled class="form-control form-control-user" id="exampleFirstName" placeholder="Full Name : <?php echo $result["Nama"]; ?>" name="nama">
                </div>
                <div class="form-group">
                  <input type="text" disabled class="form-control form-control-user" id="exampleFirstName" placeholder="Place & Birth Date : <?php echo $result["TTL"]; ?>" name="ttl">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" disabled class="form-control form-control-user" id="exampleInputPassword" placeholder="Major : <?php echo $result["Jurusan"]; ?>" name="jurusan">
                  </div>
                  <div class="col-sm-6">
                    <input type="number" disabled class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Graduation Year : <?php echo $result["Angkatan"]; ?>" name="angkatan">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" disabled class="form-control form-control-user" id="exampleFirstName" placeholder="Address : <?php echo $result["Alamat"]; ?>" name="alamat">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="email" disabled class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address : <?php echo $result["Email"]; ?>" name="email">
                  </div>
                  <div class="col-sm-6">
                    <input type="number" disabled class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Phone Number : <?php echo $result["No_Telepon"]; ?>" name="telp">
                  </div>
                </div>
                <div class="form-group">
                <input type="password" disabled class="form-control form-control-user" id="exampleInputPassword" placeholder="Password : <?php echo $_SESSION["user"]["PASSWORD"]; ?>" name="password">
                </div>
                <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                  Register Account
                </a> -->
                <a href="voting.php" class="btn btn-primary btn-user btn-block" style="display:inline;width:30%; margin-right:0px; margin-left:auto; margin-top:8px; float:right">Next</a>
                <a href = "edit-profile.php" class="btn btn-secondary btn-user btn-block" style="display:inline;width:30%;margin-right:10px; margin-left:auto; float:right; margin-bottom:50px;">Edit</a>
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
