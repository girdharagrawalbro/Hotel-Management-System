<?php
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
include 'database/config.php';
require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
if (isset($_POST['otpsend'])) {
    $otp= rand(100000, 999999);
  $email = $_POST['email'];
  $sql = "SELECT * FROM `customer_details` where Email = '$email'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $sql1 = "UPDATE `customer_details` SET `otp` = '$otp' WHERE `customer_details`.`Email` = '$email';";
    $result1= mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result);
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
    $mail->Subject = "Hotel BlueBird | Reset Password";
    $mail->Body = "<h2><b>
Hi " . $row['Username'] . ", <br>
    Forget your password? <br><br>
We received a request about forgot password from your acccount. <br>
Here is Your One Time Password(OTP) to verify - " . $otp . "
</h2>";
    $mail->send();
    echo
      "<script>alert('Sent successfully')</script>";
  } 
  else {
    echo  "<script>alert('User Not Found...')</script>";
    echo "<script>window.location.href='index.php';</script>";
  }
}
include "links.php"; 
?>
<div id="verifyModal" class="modal" style="display:block;top:25%;">
        <div class="modal-content" >
            <div class="log-flex-col" style="justify-content:center;">
                <div class="log-name">
                    <h4>Verify OTP</h4>
                </div>
            </div>
            <hr>
            <br>
            <div class="log-main">
                <form action="#" method="post">
                    <div class="log-input">
                        <p>Please enter OTP send to your email address.</p>
                    </div>
                    <div class="log-input">
                        <label for="password">OTP</label><br>
                        <input type="int" name="verifyotp" placeholder="" required>
                    </div>
                </div>
                <br>
                <div class="log-flex-col">
                    <div class="log-btn">
                        <button type="submit" name="verify" class="btn">Verify</button>
                    </div>
                </form>
            </div>
                <?php
    if (isset($_POST['verify'])) {
        $enteredOTP = $_POST['verifyotp'];
        $sql = "SELECT * FROM `customer_details` where otp = '$enteredOTP'";
        $result1 = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result1);
        $pass = $data[3];
        $email1 = $data[2];
        $num = mysqli_num_rows($result1);
        if ($num ==1) {
            echo "<script>alert('OTP verification successful!, Password sended to Email')</script>";
            $sql1 = "UPDATE `customer_details` SET `otp` = '0' WHERE `otp` = '$enteredOTP';";
            $result1= mysqli_query($conn, $sql1);
            $mail1 = new PHPMailer(true);
            $mail1->isSMTP();
            $mail1->Host = 'smtp.gmail.com';
            $mail1->SMTPAuth = true;
            $mail1->Username = 'hotelbluebird.girdharagrawal@gmail.com';
            $mail1->Password = 'rajlavqjdibssmbe';
            $mail1->SMTPSecure = 'ssl';
            $mail1->Port = 465;
            $mail1->setFrom('hotelbluebird.girdharagrawal@gmail.com');
            $mail1->addAddress($email1);
            $mail1->isHTML(true);
            $mail1->Subject = "Hotel BlueBird | Reset Password";
            $mail1->Body = "<h2><b>
        Hi " . $data['Username'] . ", <br>
            Forget your password? <br><br>
       Your Password is - " . $pass . "
        </h2>";
            $mail1->send();
    echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "Incorrect OTP. Please try again.";
        }
    }
?>
        </div>
    </div>
