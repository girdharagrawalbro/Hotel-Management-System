<?php 
$id =$_GET['id'];
include '../database/config.php';
include '../essentials.php';
    $sql = "UPDATE `roombooking_details` SET booking_status = 'Active' WHERE `id` = '$id' ";

    if ($conn->query($sql) == true) {
        $msg = "Booking Confirmed";
        alert($msg);
        header("Location: new-booking-details.php");
    }
?>

