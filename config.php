<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pemilu";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}

// $server = "localhost";
// $user = "root";
// $password = "";
// $nama_database = "pemilu";

// $db = mysqli_connect($server, $user, $password, $nama_database);

// if( !$db ){
//     die("Gagal terhubung dengan database: " . mysqli_connect_error());
// } 
?>