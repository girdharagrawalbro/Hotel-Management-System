<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!= true){
        echo "Cant Accessible";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/dashboard.css">
  <!-- <link rel="stylesheet" href="./css/roombook.css"> -->

  <!-- chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- morish bar -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  <title>BlueBird - Admin </title>
</head>

<body>
<div class="dash">
  
  <div class="chartbox">
  <div class="bookroomtablechart">
<h3 style="text-align: center;margin:10px 0;">Yearly Profit Analysis</h3>
      <iframe class="frame" src="linechart.php" frameborder="0"></iframe>
    </div>
    </div>

</div>
<br>
<br>

</body>
</html>

