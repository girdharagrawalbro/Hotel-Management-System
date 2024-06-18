<?php

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

include 'database/config.php';

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['send']) and isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $existSql = "SELECT * FROM `contact` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        echo "<script>alert('Email Already Exists..');</script>";
        echo "<script>window.location.href='index.php#contact';</script>";
    } else {
        $sql = "INSERT INTO `hotel`.`contact` (`name`, `email`, `message`, `dt`)VALUES ('$name', '$email','$message', current_timestamp());";
        if ($conn->query($sql) == true) {
            echo
                "
            <script>
            alert('Thanks for Contacting');
            </script>
            ";
            // echo "<br><center>Thanks <u>$name</u> for Contacting</center>";
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'hotelbluebird.girdharagrawal@gmail.com';
            $mail->Password = 'rajlavqjdibssmbe';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('hotelbluebird.girdharagrawal@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = "Welcome to Hotel BlueBird";
            $mail->Body = "<center><h2>Dear $name</h2>,<br>
                  <h2>We are delighted that you have chosen our <b>Hotel BlueBird</b>,         We have recieved your query we will connect to you shortly</h2></center> ";
            $mail->send();
            
            echo "<script>window.location.href='index.php';</script>";
        
        } else {
            echo "Error:";
        }
    
    }
}
?>
