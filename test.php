<?php
// $db_host = "localhost";
// $db_user = "root";
// $db_pass = "";
// $db_name = "peluit";

// $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);


// $sql = "SELECT * FROM mahasiswa";

// $query = $db->query($sql);

// while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
//     echo "$data[NPM] . $data[Angkatan] .";
//     };

$koneksi     = mysqli_connect("localhost", "root", "", "peluit");
$bulan       = mysqli_query($koneksi, "SELECT NPM FROM voting ");
$penghasilan = mysqli_query($koneksi, "SELECT KODE_TPS FROM voting");
?>

<html>

<head>
    <title>Belajarphp.net - ChartJS</title>
    <style type="text/css">
        .container {
            width: 50%;
            margin: 15px auto;
        }
    </style>
    <script src="vendor/chart.js/Chart.bundle.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script> -->

</head>

<body>

    <div class="container">
        <canvas id="myChart" width="500" height="500"></canvas>
    </div>

    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [<?php while ($b = mysqli_fetch_array($bulan)) {
                                echo '"' . $b['NPM'] . '",';
                            } ?>],
                datasets: [{
                    label: '# of Votes',
                    data: [<?php while ($p = mysqli_fetch_array($penghasilan)) {
                                echo '"' . $p['KODE_TPS'] . '",';
                            } ?>],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 70,
            },
        });
    </script>
</body>

</html>