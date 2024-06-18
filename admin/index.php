<?php
include "../essentials.php";
include "../links.php";
adminLogin();
$sql = "Select * from hotel";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/hotel-management-system/css/admin.css">
    <title>Admin Panel</title>
</head>
<body>
    <!-- mobile view -->
    <div id="mobileview">
        <!-- <h5>Admin panel doesn't show in mobile view</h4> -->
    </div>
    <!-- admin navbar -->
    <header class="header">
        <nav class="navbar flex1">
            <div class="logo">
                <img src="http://localhost/hotel-management-system/resources/logo.jpg" alt="logo">
                <!-- <img src="https://drive.google.com/thumbnail?id=<?php echo $data['logo'];?>" alt="logo"> -->
            </div>
            <div>
                <h3>ADMIN PANEL</h3>
            </div>
            <div class="btn-sec">
                <a href="../logout.php">
                    <button class="btn">Logout</button>
                </a>
            </div>
        </nav>
    </header>
    <div class="main-content" style="display:flex;width:100%;height:100vh;  ">
        <nav class="sidenav">
            <ul >
                <li class="pagebtn active"> Dashboard</li>
                <li class="pagebtn">Todys's In / Out </li>
                <li class="pagebtn">New Bookings </li>  
                <li class="pagebtn">Refund Bookings </li>
                <li class="pagebtn">Bookings Record </li>
                <li class="pagebtn">Customer Info</li>
                <li class="pagebtn">Queries</li>
                <li class="pagebtn">Rooms</li>
                <li class="pagebtn">Chart Analysis</li>
                <li class="pagebtn">Settings</li>
            </ul>
        </nav>
        <!-- i frame section-->
        <div class="mainscreen">
            <iframe class="frames frame1 active" src="dashboard.php" frameborder="0"></iframe>
            <iframe class="frames frame2" src="today-in-out.php" frameborder="0"></iframe>
            <iframe class="frames frame2" src="new-booking-details.php" frameborder="0"></iframe>
            <iframe class="frames frame2" src="refund-booking.php" frameborder="0"></iframe>
            <iframe class="frames frame2" src="booking-details.php" frameborder="0"></iframe>
            <iframe class="frames frame4" src="customer-details.php " frameborder="0"></iframe>
            <iframe class="frames frame4" src="customer-queries.php" frameborder="0"></iframe>
            <iframe class="frames frame4" src="room-details.php" frameborder="0"></iframe>
            <iframe class="frames frame4" src="chart.php" frameborder="0"></iframe>
            <iframe class="frames frame4" src="settings.php" frameborder="0"></iframe>
        </div>
    </div>
</body>
<script src="../javascript/script.js"></script>
</html>