<?php 
$id =$_GET['id'];
include '../database/config.php';
include '../essentials.php';
    $sql = "UPDATE `customer_details` SET `status` = 'not-verified' WHERE `UserID` = '$id' ";
    if ($conn->query($sql) == true) {
        $msg = "Customer UnVerified";
        alert($msg);
        header("Location: customer-details.php");
    }
?>
