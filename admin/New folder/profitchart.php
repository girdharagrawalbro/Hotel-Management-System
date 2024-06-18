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

  <!-- chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
</body>
<style>
    .chartbox{
    width: 100%;
    display: flex;
    justify-content: space-evenly;
    padding: 10px 0;
}


.bookroomchart{
    padding: 5px;
    padding-bottom: 0;
    width: 550px;
    height:500px;
    background-color: #ffff;
    border-radius:3px;
} 

.bookroomchart .frame {
    width: 70%;
    margin-left: 80px;
    height: 80vh;
}
</style>

</html>
