<?php 
$id =$_GET['id'];
include '../database/config.php';
include '../essentials.php';
    $sql = "UPDATE `customer_details` SET `status` = 'Verified' WHERE `UserID` = '$id' ";
    if ($conn->query($sql) == true) {
        $msg = "Customer Verified";
        alert($msg);
        header("Location: customer-details.php");
    }
?>
