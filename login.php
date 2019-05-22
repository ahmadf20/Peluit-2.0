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

    <title>Login</title>
    <link rel="icon" href="vote.jpg">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <?php
                        if(isset($_POST['login'])){

                            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                            $password = $_POST['password'];
                        
                            $sql = "SELECT * FROM akun join mahasiswa WHERE username=:username and password=:password and username=NPM";
                            $stmt = $db->prepare($sql);
                            
                            $params = array(
                                ":username" => $username,
                                ":password" => $password
                            );
                            $stmt->execute($params);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                            // print_r($user);
                        
                            // jika user terdaftar
                            if($user){
                                //jika admin
                                if ($user["ADMIN"] == 1) {
                                        $_SESSION["user"] = $user;
                                        header("Location: dashboard.php");
                                } else {
                                    //jika user sudah divalidasi
                                    if ($user["Validasi"]) {
                                            $_SESSION["user"] = $user;
                                            header("Location: voting.php");
                                    } else {
                                        echo "<div class='alert text-center alert-dismissible fade show text-danger' style='margin-top:15px;' role='alert'>
                                        <strong>Akses ditolak!</strong> User anda belum divalidasi.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>";
                                    }
                                }
                                
                            } else {    
                                echo "<div class='alert text-center alert-dismissible fade show text-danger' style='margin-top:15px;' role='alert'>
                                <strong>Akses ditolak!</strong> Username atau Password yang anda masukkan salah atau anda belum terdaftar. Klik <a href='register.php' class='alert-link'> di sini </a> untuk mendaftar.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }
                        }
                    ?>
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background:url(vendor/login.jpg);background-position:center;background-size:cover"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-5">SELAMAT DATANG DI PEMILIHAN KETUA BEM KEMA FMIPA UNPAD 2019!</h1>
                                    </div>
                                    <form class="user was-validated" method="post">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Your Student ID" name="username" maxlength="12" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password" maxlength="16" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" required>
                                                <label class="custom-control-label" for="customCheck">I agree to the Terms and Conditions</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block mb-4 mt-3" name="login" value="Login">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgotPassword.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
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