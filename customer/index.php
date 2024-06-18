<!DOCTYPE html>
<html lang="en">
    <?php  include "../navbar.php"; ?>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile |  <?php echo $data[1]; ?> </title>
<?php
userLogin();    
$mail = "";     
$mail = $_SESSION['useremail'];
$sql = "Select * from customer_details where Email = '$mail'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$customer_id = $row[0];
?>
  <link rel="stylesheet" href="http://localhost/hotel-management-system/css/user.css">
    <link rel="stylesheet" href="http://localhost/hotel-management-system/css/style.css">
</head>
<body>
<br>
    <section class="main">
        <div class="container">
            <div class="hero">
                <h2>PROFILE</h2>
                <h6>HOME > <span>PROFILE</span></h6>
            </div>
            <br>
            <div class="pro profile1">
                <h4>Basic Information</h4>
                <form action="" method="post">
                    <div class="data">
                        <div class="in">
                            <label for="">Name </label><br>
                            <input type="text" placeholder="" name="Name" value="<?php echo $row[1]; ?>" required>
                        </div>
                        <div class="in">
                            <label for="">Email </label><br>
                            <input type="text" placeholder="" name="Email" value="<?php echo $row[2]; ?>" required>
                        </div>
                        <div class="in">
                            <label for="">Phone </label><br>
                            <input type="text" placeholder="" name="Phone" value="<?php echo $row[4]; ?>" required>
                        </div>
                    </div>
                    <div class="data">
                        <div class="in">
                            <label for="">Address </label><br>
                            <input type="text" placeholder="" name="Address" value="<?php echo $row[5]; ?>" required>
                        </div>
                    </div>
                    <button name="update" value="update">Save Changes</button>
                </form>
                <?php 
    if (isset($_POST['update'])) {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        $Phone = $_POST['Phone'];
    $sql1 = "UPDATE `customer_details` SET Username='$Name',Email='$Email',`phone` = '$Phone', `address` = '$Address' WHERE `customer_details`.`UserID` = '$customer_id' ";
    mysqli_query($conn, $sql1);
    $msg = "Changes Saved in Database";
    alert($msg);
    echo "<script>window.location.href='$currentURL';</script>";
    }
    ?>
            </div>
            <br>
            <div class="pro profile2">
                <div class="data" style="width:100%;">
                    <div class="pro_img" style="text-align:left widht:40%;">
                        <h4>Picture</h4>
                        <img src="../resources/Profile.png" alt="" width="240px" style="margin:auto; display:block;">
                    </div>
                    <div class="c_pass"  style="width:60%; margin-left:20px;">
                        <h4>Change Password</h4>
                        <form action="" method="post">
                        <div class="data">
                            <div class="in">
                                <label for="">New Password </label><br>
                                <input type="text" placeholder="" name="pass" required>
                            </div>
                            <div class="in">
                                <label for="">Confirm Password</label><br>
                                <input type="text" placeholder="" name="cpass" required>
                            </div>
                        </div>
                        <button class="update" name="passchange" value="update">Save Changes</button>
                        </form>
                        <?php 
    if (isset($_POST['passchange'])) {
     $pass = $_POST['pass'];
     $cpass = $_POST['cpass'];
     if ($pass != $cpass) {
         $error = "Password does not match the confirm password.";
         alert($error);
         }else{
    $sql1 = "UPDATE `customer_details` SET `Password`='$pass' WHERE `customer_details`.`UserID` = '$customer_id'";
    mysqli_query($conn, $sql1);
    $msg = "Password Changed";
    alert($msg);
    echo "<script>window.location.href='$currentURL';</script>";
    }}?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>
</html>
