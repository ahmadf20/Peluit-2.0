<?php
 /*** mysql hostname ***/
 $hostname = 'localhost';
 /*** mysql username ***/ 
$username = 'root'; 
/*** mysql password ***/
 $password = '';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=pemilu", $username, $password);
    /*** echo a message saying we have connected ***/
    echo 'Connected to database<br />';

    /*** The SQL SELECT statement ***/
    $sql = "SELECT * FROM mahasiswa";

    /*** fetch into an PDOStatement object ***/
    $stmt = $dbh->query($sql);

    /*** echo number of columns ***/
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    /*** loop over the object directly ***/
    foreach($result as $key=>$val)
    {
    echo $key.' - '.$val.'<br />';
    }






    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }?>