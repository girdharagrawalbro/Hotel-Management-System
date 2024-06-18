<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!= true){
        echo "Cant Accessible";
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Pie Chart in HTML using JavaScript</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<style>
 canvas {
    max-width: 500px;
    max-height: 500px;
 }
</style>
</head>
<?php

    include '../database/config.php';

    $todaydate = date("y/m/d");

    //roombook roomtype
    $chartroom1 = "SELECT * FROM roombook WHERE RoomType='Superior' and bookdate='$todaydate'";
    $chartroom1re = mysqli_query($conn, $chartroom1);
    $chartroom1row = mysqli_num_rows($chartroom1re);

    $chartroom2 = "SELECT * FROM roombook WHERE RoomType='Deluxe' and bookdate='$todaydate'";
    $chartroom2re = mysqli_query($conn, $chartroom2);
    $chartroom2row = mysqli_num_rows($chartroom2re);

    $chartroom3 = "SELECT * FROM roombook WHERE RoomType='Guest' and bookdate='$todaydate'";
    $chartroom3re = mysqli_query($conn, $chartroom3);
    $chartroom3row = mysqli_num_rows($chartroom3re);

    $chartroom4 = "SELECT * FROM roombook WHERE RoomType='Single' and BOOKDATE= '$todaydate'";
    $chartroom4re = mysqli_query($conn, $chartroom4);
    $chartroom4row = mysqli_num_rows($chartroom4re);
?>
<body>

<canvas id="myChart"></canvas>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Superior', 'Delux', 'Guest', 'Single'],
        datasets: [{
            label: 'of Rooms',
            data: [<?php echo $chartroom1row ?>, <?php echo $chartroom2row ?>, <?php echo $chartroom3row ?>, <?php echo $chartroom4row ?>],
            backgroundColor: [
                'red',
                'green',
                'blue',
                'yellow',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
               
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>