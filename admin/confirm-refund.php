<?php 
$id =$_GET['id'];
include '../database/config.php';
include '../essentials.php';
    $sql = "UPDATE `roombooking_details` SET `advance_pay_status` = 'Refunded' , booking_status='Cancelled' WHERE `id` = '$id' ";
    if ($conn->query($sql) == true) {
        $msg = "Refund Confirmed";
        alert($msg);
        header("Location: refund-booking.php");
    }
?>
