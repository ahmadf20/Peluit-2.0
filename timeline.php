<?php require_once("auth.php"); ?>
<?php require_once("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesbuk Timeline</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-body text-center">

                    <img class="img img-responsive rounded-circle mb-3" width="160" src="img/<?php echo $_SESSION['user']['photo'] ?>" />

                    
                    <h3><?php echo $_SESSION["user"]["USERNAME"] ?></h3>

                    <?php
                        $npm = $_SESSION["user"]["USERNAME"];

                        class TableRows extends RecursiveIteratorIterator { 
                            function __construct($it) { 
                                parent::__construct($it, self::LEAVES_ONLY); 
                            }
                        
                            function current() {
                                return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
                            }
                        
                            function beginChildren() { 
                                echo "<tr>"; 
                            } 
                        
                            function endChildren() { 
                                echo "</tr>" . "\n";
                            } 
                        } 

                        $sql = "SELECT * FROM mahasiswa WHERE npm=mahasiswa.npm";
                        $stmt = $db->prepare($sql);
                        
                        $stmt->execute();
                        
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        // print_r($result);
                        // echo $result["Nama"];
                        //loop print data
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                            echo $v;
                        }
                    ?>
                    <p><a href="logout.php">Logout</a></p>
                </div>
            </div>

            
        </div>


        <div class="col-md-8">

            <form action="" method="post" />
                <div class="form-group">
                    <textarea class="form-control" placeholder="Apa yang kamu pikirkan?"></textarea>
                </div>
            </form>

            <?php for($i=0; $i < 6; $i++){ ?>
            <div class="card mb-3">
                <div class="card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis veritatis nemo ad recusandae labore nihil iure qui eum consequatur, officiis facere quis sunt tempora impedit ullam reprehenderit facilis ex amet!
                </div>
            </div>
            <?php } ?>
            
        </div>
    
    </div>
</div>

</body>
</html>