<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../navbar.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Bookings |
        <?php echo $data[1]; ?>
    </title>
</head>
<?php
userLogin();
$mail = "";
$mail = $_SESSION['useremail'];
$sql = "Select * from customer_details where Email = '$mail'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$customer_id = $row[0];
$sql = "select * from roombooking_details where customer_id='$customer_id'";
$res = mysqli_query($conn, $sql);
$today = date('Y-m-d');
?>
<body>
    <br><br><br>
    <section class="main">
        <div class="hero">
            <h2>BOOKINGS</h2>
            <h6>HOME > <span>BOOKINGS</span></h6>
        </div>
        <br>
        <div class="container" style="display:flex; flex-wrap: wrap;row-gap: 30px;max-width:95%">
            <?php
            while ($bookd = mysqli_fetch_array($res)) {
                $bookid = $bookd[0];
                $roomid = $bookd[2];
                $s = "SELECT * FROM `room` WHERE `id` = '$roomid';";
                $r = mysqli_query($conn, $s);
                $rinfo = mysqli_fetch_array($r);
                ?>
                <div class="pro bookings-card" style="margin-right:30px;flex-wrap: wrap;">
                    <h4 style="font-size:18px">
                        <?php echo $rinfo[1]; ?> Room
                    </h4>
                    <h4><span> Per Night: ₹</span>
                        <?php echo $rinfo[4]; ?>
                    </h4>
                    <br>
                    <h4>Check in : <span> </span>
                        <?php echo $bookd[3]; ?>
                    </h4>
                    <h4>Check out :
                        <?php echo $bookd[4]; ?>
                    </h4>
                    <br>
                    <h4>Amount :
                        ₹
                        <?php echo $bookd[6]; ?>
                    </h4>
                    <h4>Booking Id :
                        <?php echo $bookid; ?>
                    </h4>
                    <h4>Book Date :
                        <?php echo $bookd[12]; ?>
                    </h4><br>
                    <h6 style="text-align:center;padding:2px;background-color:lightgreen;color:white">
                        <?php echo $bookd[10]; ?>
                    </h6>
                    <div class="data" style="margin:8px 0">
                        <?php
                        if ($bookd[10] == "Checked_Out") {
                            echo "  <a href='../admin/invoice.php?id=$bookid'><button style='padding:5px 10px'>Invoice</button>   </a>";
                        } elseif ($bookd[10] == "Waiting_for_Advance_Pay") {
                            echo "  <a href='../userpay.php?id=$bookid'><button style='padding:5px 10px'>Pay Advance</button>   </a>";
                        } elseif ($bookd[10] == "Active") {
                            if ($today < $bookd[3]) {
                                echo "  <form action='#' method='post'>
                                <input type='hidden' name='bkid' value='$bookid' readonly>
                                <button type='submit' name='cancel' value='cancel' style='padding:5px 10px;background-color:red;'>Cancel Booking</button></a>
                                </form>";
                            } elseif ($today == $bookd[3]) {
                                echo "<button style='padding:5px 10px'>Todays Check In</button>";
                            } elseif ($today > $bookd[3]) {
                                echo "  <a href='../userpay.php?id=$bookid'><button style='padding:5px 10px'>Check Out</button></a>";
                            } elseif ($today == $bookd[4]) {
                                echo "<button style='paddi  ng:5px 10px'>Todays Check Out</button>";
                            } else {
                                echo "";
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
            <br>
<?php 
if (isset($_POST['cancel'])) {
$bookid = $_POST['bkid'];
$sc = "UPDATE `roombooking_details` SET `advance_pay_status` = 'Waiting-for-Refund' , `booking_status` = 'Waiting-for-Refund', `advance_pay`='0' WHERE `roombooking_details`.`id` = '$bookid';";
mysqli_query($conn, $sc);
echo "<script>alert('Booking Cancelled, Waiting for refund intialize')</script>";
}
?>
        </div>
    </section>
</body>
</html>