<!DOCTYPE html>
<html lang="en">
<?php
$bookid = $_GET['id'];
include "links.php";
include "database/config.php"; 
$adv = 0;
$sql4 = "select * from roombooking_details where id= '$bookid' ";
    $res4 = mysqli_query($conn, $sql4);
    $booking_d = mysqli_fetch_array($res4);
    $roomid = $booking_d[2];
    if($booking_d[9] == "Not_Paid")
    {
            $adv = 1;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/roombook.css">
    <title>Payment Page</title>
</head>
<body>
    <div class="modal" style="display:block;">
    <div class="modal-content" style="width:100%">
        <div class="log-flex-col">
            <div class="log-name" style="width:100%;text-align:center">
                <h4> PAYMENT PORTAL</h4>
            </div>       
        </div>
        <hr>
        <div class="log-main" style="width:100%;">
            <img src="resources/qr.jpeg" style="width:230px; margin:auto; display:block;" alt="">
            <h4 style="text-align:center">Scan & Pay Rs - 
            <?php 
            if($adv == 1)
            {
                echo $booking_d[7];;
            }
            else{
                echo $booking_d[8];
            }?>
            </h4>
        </div>
        <hr>
        <div class="log-flex-col" style="width:100%">
            <div class="log-btn" style="width:100%">
                <form action="#" method="post">
                    <button type="submit" name="paid" class="btn" style="margin:auto;display:block;">Paid</button>
                </form>
                <h4 style="text-align:center" id="secdis"></h4>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    var seconds = 60;
    function displaysec() {
        seconds -=1;
    document.getElementById("secdis").innerText="This Page will be Redirected in "+seconds+" Seconds...";
        }
        setInterval(displaysec, 1000);
        function redirectpage(){
            window.location='http://localhost/hotel-management-system/user.php';
        }
        setTimeout('redirectpage()',60000);
</script>
</html>
  <?php 
  if (isset($_POST['paid'])) {
    if($adv == 1)
            {
    $sql = "UPDATE `roombooking_details` SET `advance_pay_status` = 'Paid' WHERE `roombooking_details`.`id` = '$bookid';";
    mysqli_query($conn, $sql);
    echo "<script>window.location.href='customer/customer_bookings.php';</script>";
            }
    else{
        $sql = "UPDATE `roombooking_details` SET `final_pay_status` = 'Paid' , `booking_status` = 'Checked_Out', `due_amount` = '0' WHERE `roombooking_details`.`id` = '$bookid';";
        $sql = "UPDATE `room` SET `status` = 'Available'WHERE `id` = '$roomid';";
        mysqli_query($conn, $sql);
        echo "<script>window.location.href='customer/customer_bookings.php';</script>";
    }
}
 ?>
