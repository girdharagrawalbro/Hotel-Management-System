<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$room_id = $_GET['id'];
include "navbar.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo "<script>alert('Please login to continue the booking!')</script>";
    $url = "roomdetail.php?id=$room_id";
    redirect($url);
}
?>
<head>
    <title>CONFIRM BOOKING |
        <?php echo $data[1]; ?>
    </title>
    <?php
    $mail = $_SESSION['useremail'];
    $sql = "Select * from customer_details where Email = '$mail'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $customer_id = $row[0];
    $sql = "Select * from room where id='$room_id';";
    $result1 = mysqli_query($conn, $sql);
    $rooms = mysqli_fetch_array($result1);
    $pay = 0;
    $days = 1;
    $numrooms = 1;
    $bookid = "";
    $tot = 0;
    $total = 0;
    ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="css/user.css">
    <style>
        .room-image {
            width: 420px;
            object-fit: cover;
            border-radius: 8px;
        }
        .room-data {
            padding: 10px 10px 0px 3 0px;
        }
        .book-button {
            width: 100%;
            padding: 10px;
            text-align: center;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border: none;
            /* margin-top: -20px; */
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
<body>
    <br><br><br>
    <br>
    <br>
    <?php ?>
    <section class="main">
        <div class="container">
            <div class="hero">
                <h2>CONFIRM BOOKING</h2>
                <h6>HOME > <span>ROOMS > CONFIRM</span></h6>
            </div>
            <br>
            <div class="pro">
                <div class="data" style="width:100%;">
                    <div class="room_image">
                        <img class="room-image" src="resources/rooms_img/<?php echo $rooms[6]; ?>" alt="">
                        <br>
                        <h2>
                            <?php echo $rooms[1]; ?>
                        </h2>
                        <h4>Rs. <span id="price">
                                <?php echo $rooms[4]; ?>
                            </span>/ night</h4>
                    </div>
                    <div class="room-data" style="width:100%;">
                        <h4>BOOKING DETAILS</h4>
                        <form action="#" method="post">
                            <div class="data">
                                <div class="in">
                                    <label for="">Name </label><br>
                                    <input type="text" placeholder="" name="Name" value="<?php echo $row[1]; ?>"
                                        readonly>
                                </div>
                                <div class="in">
                                    <label for="">Phone </label><br>
                                    <input type="text" placeholder="" name="Phone" value="<?php echo $row[4]; ?>">
                                </div>
                            </div>
                            <div class="data">
                                <div class="in">
                                    <label for="">Address</label><br>
                                    <input type="text" placeholder="" name="Address" value="<?php echo $row[5]; ?>">
                                </div>
                            </div>
                            <div class="data">
                                <div class="in">
                                    <label for="">Check in </label><br>
                                    <input type="date" placeholder="" name="cin" id="startDate"
                                        onchange="getDatesBetween()" required>
                                </div>
                                <div class="in">
                                    <label for="">Check out </label><br>
                                    <input type="date" placeholder="" name="cout" id="endDate"
                                        onchange="getDatesBetween()" required>
                                </div>
                            </div>
                            <div class="data">
                                <div class="in">
                                    <h4 id="mess" style="color:#333;margin-bottom:5px;">Enter checkin & checkout date!
                                    </h4>
                                    <label id="no-days-label"></label><br>
                                    <label id="pay-label"> </label><br>
                                    <label id="advance-pay-label"> </label>
                                </div>
                            </div>
                            <input style="display:none;" name="days" type="text" id="no-days" readonly>
                            <input style="display:none;" type="text" name="pay" id="pay" readonly>
                            <input style="display:none;" type="text" name="adv-pay" id="advance-pay" readonly>
                            <button class="book-button" name="submit" value="submit" id="paybtn">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include 'database/config.php';
    $today = date('Y-m-d');
    if (isset($_POST['submit'])) {
        $Name = $_POST['Name'];
        $Address = $_POST['Address'];
        $Phone = $_POST['Phone'];
        $cin = $_POST['cin'];
        $cout = $_POST['cout'];
        $days = $_POST['days'];
        $pay = $_POST['pay'];
        $advpay = $_POST['adv-pay'];
        $dueamt = $pay - $advpay;
        $sql1 ="SELECT * FROM roombooking_details WHERE (cin <= '$cout' AND cout >= '$cin') and room_id='$room_id';";
        $rres = mysqli_query($conn, $sql1);
        $num = mysqli_num_rows($rres);
        if ($num > 0) {
            $msg = "Room Not Available on given dates. Please check again.";
            alert($msg);
            echo "<script>window.location.href='$currentURL';</script>";
        } 
        else {
            $sql1 = "UPDATE `customer_details` SET `phone` = '$Phone', `address` = '$Address' WHERE `customer_details`.`UserID` = '$row[0]' ";
            mysqli_query($conn, $sql1);
            $sql2 = "INSERT INTO roombooking_details(customer_id,room_id,cin,cout,nodays,total_bill,advance_pay,due_amount,advance_pay_status,booking_status,final_pay_status) VALUES ('$customer_id','$room_id','$cin','$cout','$days','$pay','$advpay','$dueamt','Not_Paid','Waiting_for_Advance_Pay','Not_Paid')";
            mysqli_query($conn, $sql2);
            $sql3 = "UPDATE `room` SET `status` = 'Booked' where `room`.`id` = '$room_id' ";
            mysqli_query($conn, $sql3);
            $sql4 = "select * from roombooking_details where customer_id='$customer_id' and room_id='$room_id' and bookdate='$today'";
            $res4 = mysqli_query($conn, $sql4);
            $booking_d = mysqli_fetch_array($res4);
            $bookid = $booking_d['id'];
            echo "<script>window.location.href='userpay.php?id=$bookid';</script>";
            $Name = "";
            $Email = "";
            $Address = "";
            $Phone = "";
            $cin = "";
            $cout = "";
        }
    }
    ?>
</body>
<script>
    function getDatesBetween() {
        var spanElement = document.getElementById("price");
        var price = spanElement.textContent || spanElement.innerText;
        var startDate = new Date(document.getElementById("startDate").value);
        var endDate = new Date(document.getElementById("endDate").value);
        var message = document.getElementById("mess");
        var paylabel = document.getElementById("pay-label");
        var advpaylabel = document.getElementById("advance-pay-label");
        var pay = document.getElementById("pay");
        var advpay = document.getElementById("advance-pay");
        var dayslabel = document.getElementById("no-days-label");
        var days = document.getElementById("no-days");
        var paybtn = document.getElementById("paybtn");
        let todayDate = new Date();
        if (startDate == endDate) {
            message.style.color = 'red';
            message.innerHTML = 'checkin date and checkout date must be different';
            paybtn.style.display = 'none';
            return;
        }
        else if(startDate > endDate){
            message.style.color = 'red';
            message.innerHTML = 'checkin date must be before checkout date';
            paybtn.style.display = 'none';
            return;
        }
        else if(startDate < todayDate){
            message.style.color = 'red';
            message.innerHTML = 'checkin date must be after todays date';
            paybtn.style.display = 'none';
            return;
        }else{
        var datesArray = [];
        var currentDate = new Date(startDate);
        while (currentDate <= endDate) {
            datesArray.push(new Date(currentDate));
            currentDate.setDate(currentDate.getDate() + 1);
        }
        message.innerHTML = '';
        paybtn.style.display = 'block';
        //calculate total amount to show in the text box
        var advance = price * datesArray.length;
        days.value = datesArray.length;
        dayslabel.innerHTML = "Number of Days : " + datesArray.length;
        paylabel.innerHTML = "Total Price for Stay : " + (price * datesArray.length);
        advpaylabel.innerHTML = "Advance payment : " + (Math.round(0.5 * advance));
        pay.value = (price * datesArray.length);
        advpay.value = Math.round(0.5 * advance);
    }
}
</script>
</html>