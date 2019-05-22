<?php
    
$koneksi     = mysqli_connect("localhost", "root", "", "peluit");
$noUrut       = mysqli_query($koneksi, "SELECT * FROM VOTE GROUP BY NO_URUT");
$count     = mysqli_query($koneksi, "SELECT COUNT(NO_URUT) as A FROM VOTE GROUP BY NO_URUT");
$byAngkatan     = mysqli_query($koneksi, "SELECT mahasiswa.angkatan, COUNT(Angkatan) as FrekuensiAngkatan from vote join mahasiswa WHERE mahasiswa.npm = vote.NPM GROUP By Angkatan");
?>
<html>
    <head>
        
        <title>Belajarphp.net - ChartJS</title>
        <script src="Chart.bundle.js"></script>
        <script src="vendor/chart.js/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
        <!-- <div class="container">
            <canvas id="myChart" width="100" height="100"></canvas>
        </div> -->

        [<?php while ($b = mysqli_fetch_array($byAngkatan)) {
                                echo '"' . $b['angkatan'] . '",';
                            } ?>],
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($noUrut)) {
                            echo '"' . $b['NO_URUT'] . '",';
                        } ?>],
                    datasets: [{
                            label: '# of Votes',
                            data:   [<?php while ($b = mysqli_fetch_array($count)) {
                                echo '"' . $b['A'] . '",';
                            } ?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
        
    </body>
</html>


      
// Bar Chart Jurusan
// var ctx = document.getElementById("BarChart#2");
//             var BarChart#2 = new Chart(ctx, {
//                 type: 'bar',
//                 data: {
//                     labels: [<?php while ($b = mysqli_fetch_array($jurusan)) {
//                                 echo '"' . $b['Jurusan'] . '",';
//                             } ?>],
//                     datasets: [{
//                             label: '# of Votes',
//                             data:   [<?php while ($b = mysqli_fetch_array($countJurusan)) {
//                                 echo '"' . $b['FrekuensiJurusan'] . '",';
//                             } ?>],
//                     backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', ],
//                     hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
//                     hoverBorderColor: "rgba(234, 236, 244, 1)",
//                     borderWidth: 2
//                     }]
//                 },
//                 options: {
//                     scales: {
//                         yAxes: [{
//                                 ticks: {
//                                     beginAtZero: true
//                                 }
//                             }]
//                     },                
//                 maintainAspectRatio: false,
//                 tooltips: {
//                     backgroundColor: "rgb(255,255,255)",
//                     bodyFontColor: "#858796",
//                     borderColor: '#dddfeb',
//                     borderWidth: 1,
//                     xPadding: 15,
//                     yPadding: 15,
//                     displayColors: true,
//                     caretPadding: 10,
//                 },
//                 legend: {
//                     display: false,
//                     fullWidth : false,
//                     position : 'bottom',
//                     boxWidth : '1000',
//                     padding : 10,
//                     labels: {
//                         fontColor: 'rgb(255, 255, 132)'
//                     }
//                 },
//                 layout: {
//                     padding: {
//                         left: 0,
//                         right: 0,
//                         top: 0,
//                         bottom: 0
//                     }
//                 },
//             },
//         });