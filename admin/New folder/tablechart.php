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
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<?php
        include '../database/config.php';


    $year =date("y");
    
    //roombook roomtype
    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-01-01' and '$year-01-31'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow1 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-02-01' and '$year-02-28'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow2 = mysqli_num_rows($monre1);
    
    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-03-01' and '$year-03-31'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow3 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-04-01' and '$year-04-30'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow4 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-05-01' and '$year-05-31'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow5 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-06-01' and '$year-06-30'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow6 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-07-01' and '$year-07-31'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow7 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-08-01' and '$year-08-31'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow8 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-09-01' and '$year-09-30'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow9 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-10-01' and '$year-10-31'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow10 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-11-01' and '$year-11-30'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow11 = mysqli_num_rows($monre1);

    $monsql1 = "SELECT * FROM roombook WHERE BOOKDATE between '$year-12-01' and '$year-12-31'";
    $monre1 = mysqli_query($conn, $monsql1);
    $monrow12 = mysqli_num_rows($monre1);

?>
<body>
    <div style="width: 100%"> <canvas id="tabularChart"></canvas> </div>
    <script> 
    var ctx = document.getElementById('tabularChart').getContext('2d'); 
    var chart = new Chart(ctx, { type: 'bar', 
    data: { 
        labels: ['January','Febuary','March', 'April', 'May','June','July','August','September','Octubar','November','December'], 
        datasets: [ {
            label: 'No. of Rooms', 
            data: [<?php echo $monrow1 ?>,<?php echo $monrow2 ?>,<?php echo $monrow3 ?>,<?php echo $monrow4 ?>,<?php echo $monrow5 ?>,<?php echo $monrow6 ?>,<?php echo $monrow7 ?>,<?php echo $monrow8 ?>,<?php echo $monrow9 ?>,<?php echo $monrow10 ?>,<?php echo $monrow11 ?>,<?php echo $monrow12 ?>], 
            backgroundColor: 'rgba(75, 192, 192, 0.2)', 
            borderColor: ['rgba(75, 192, 192, 1)'], 
            borderWidth: 1  }] 
        }, 
        options: { responsive: true, scales: { y: { beginAtZero: true } } } }); </script>   
</body>

</html>