<?php
include 'essentials.php';
$booksql = " SELECT * FROM `roombooking_details`";
$bookre = mysqli_query($conn, $booksql);
$book = mysqli_num_rows($bookre);
$totalrevenue = 0;
while ($bookdata = mysqli_fetch_array($bookre)) {
    $totalrevenue = $totalrevenue + $bookdata[6];
}
$profit = $totalrevenue * .8;
$activebooksql = " SELECT * FROM `roombooking_details` where booking_status='Active'";
$activebookre = mysqli_query($conn, $activebooksql);
$activebook = mysqli_num_rows($activebookre);
$activerevenue = 0;
while ($activebookdata = mysqli_fetch_array($activebookre)) {
    $activerevenue = $activerevenue + $activebookdata[6];
}
$cancelledbooksql = " SELECT * FROM `roombooking_details` where booking_status='Cancelled'";
$cancelledbookre = mysqli_query($conn, $cancelledbooksql);
$cancelledbook = mysqli_num_rows($cancelledbookre);
$refunded = 0;
while ($refunddata = mysqli_fetch_array($cancelledbookre)) {
    $refunded = $refunded + $refunddata[7];
}
$newbooksql = " SELECT * FROM `roombooking_details` where booking_status='Waiting_for_confirmation'";
$newbookre = mysqli_query($conn, $newbooksql);
$newbook = mysqli_num_rows($newbookre);
$refundbooksql = " SELECT * FROM `roombooking_details` where advance_pay_status='Waiting-for-Refund' and  booking_status='Waiting-for-Refund' ";
$refundbookre = mysqli_query($conn, $refundbooksql);
$refundbook = mysqli_num_rows($refundbookre);
$newcustomersql = " SELECT * FROM `customer_details` where `status`='waiting_for_verify'";
$newcustomerre = mysqli_query($conn, $newcustomersql);
$newcustomer = mysqli_num_rows($newcustomerre);
$verifiedcustomersql = " SELECT * FROM `customer_details` where `status`='verified'";
$verifiedcustomerre = mysqli_query($conn, $verifiedcustomersql);
$verifiedcustomer = mysqli_num_rows($verifiedcustomerre);
$notverifiedcustomersql = " SELECT * FROM `customer_details` where `status`='not-verified'";
$notverifiedcustomerre = mysqli_query($conn, $notverifiedcustomersql);
$notverifiedcustomer = mysqli_num_rows($notverifiedcustomerre);
$customersql = " SELECT * FROM `customer_details`";
$customerre = mysqli_query($conn, $customersql);
$customer = mysqli_num_rows($customerre);
$querysql = " SELECT * FROM `contact`";
$queryre = mysqli_query($conn, $querysql);
$query = mysqli_num_rows($queryre);
$newquerysql = " SELECT * FROM `contact` where `status`='not_readed'";
$newqueryre = mysqli_query($conn, $newquerysql);
$newquery = mysqli_num_rows($newqueryre);
$seenquerysql = " SELECT * FROM `contact` where `status`='Seen'";
$seenqueryre = mysqli_query($conn, $seenquerysql);
$seenquery = mysqli_num_rows($seenqueryre);
?>
<div class="dash">
    <br>
    <br>
    <center>
        <h1 style="">DASHBOARD</h1>
    </center>
    <style>
    </style>
    <div class="databox">
        <div class="box roombookbox" style="color:green">
            <h3>
                <?php echo $newbook ?>
            </h3>
            <h5>New Bookings</h5>
        </div>
        <div class="box roombookbox" style="color:red">
            <h3>
                <?php echo $refundbook ?>
            </h3>
            <h5>Refund Bookings</h5>
        </div>
        <div class="box roombookbox" style="color:blue">
            <h3>
                <?php echo $newcustomer ?>
            </h3>
            <h5>New Registration</h5>
        </div>
        <div class="box roombookbox" style="color:cyan">
            <h3>
                <?php echo $newquery ?>
            </h3>
            <h5>Customer Queries</h5>
        </div>
    </div>
    <br>
    <h2>Booking Analytics</h2>
    <div class="databox">
        <div class="box roombookbox" style="color:green">
            <h5>Total Bookings</h5>
            <h3>
                <?php echo $book ?>
            </h3>
            <h5>₹
                <?php echo $totalrevenue ?>
            </h5>
        </div>
        <div class="box roombookbox" style="color:cyan">
            <h5>Active Bookings</h5>
            <h3>
                <?php echo $activebook ?>
            </h3>
            <h5>₹
                <?php echo $activerevenue ?>
            </h5>
        </div>
        <div class="box roombookbox" style="color:red">
            <h5>Cancelled Bookings</h5>
            <h3>
                <?php echo $cancelledbook ?>
            </h3>
            <h5>₹
                <?php echo $refunded ?>
            </h5>
        </div>
    </div>
    <br>
        <h2>Customer Queries</h2>
    </div>
    <div class="databox">
        <div class="box roombookbox">
            <h3>
                <?php echo $query ?>
            </h3>
            <h5>Total Queries</h5>
        </div>
        <div class="box roombookbox">
            <h3>
                <?php echo $seenquery ?>
            </h3>
            <h5>Seen Queries</h5>
        </div>
    </div>
    <br>
    <h2>Customer Details</h2>
    <div class="databox">
        <div class="box roombookbox" style="color:blue">
            <h3>
                <?php echo $customer ?>
            </h3>
            <h5>Total Customer</h5>
        </div>
        <div class="box roombookbox" style="color:cyan">
            <h3>
                <?php echo $verifiedcustomer ?>
            </h3>
            <h5>Verifed Customer</h5>
        </div>
        <div class="box roombookbox" style="color:red">
            <h3>
                <?php echo $notverifiedcustomer ?>
            </h3>
            <h5>Not Verified Customer</h5>
        </div>
    </div>
    <br>
    <h2>Revenue & Profit Details</h2>
    <div class="databox">
        <div class="box roombookbox" style="color:green">
            <h3>
                ₹
                <?php echo $totalrevenue ?>
            </h3>
            <h5>Total Revenue</h5>
        </div>
        <div class="box roombookbox" style="color:green">
            <h3>
                ₹
                <?php echo $profit ?>
            </h3>
            <h5>Total Profit</h5>
        </div>
    </div>
    <br>
    <br>