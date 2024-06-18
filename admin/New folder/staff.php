<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!= true){
        echo "Cant Accessible";
        exit;
    }

include '../database/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBird - Admin</title>
    <link rel="stylesheet" href="../css/room.css">
    <link rel="stylesheet" href="../css/roombook.css">

    <style>
        .roombox{
            background-color: #d1d7ff;
            padding: 10px;
        }
    </style>
</head>

<body>
<br>
    <center>
        <h3>Staff Information</h3>
    </center>
    <br>
    <div class="addroomsection">
        <form action="" method="POST">
            <label for="troom">Name :</label>
            <input type="text" name="staffname" class="form-control">

            <label for="bed">Work :</label>
            <select name="staffwork" class="form-control">
                <option value selected></option>
                <option value="Manager">Manager</option>
                <option value="Cook">Cook</option>
                <option value="Helper">Helper</option>
                <option value="cleaner">cleaner</option>
                <option value="weighter">weighter</option>
            </select>

            <button type="submit" class="btn btn-success" name="addstaff">Add Staff</button>
        </form>

        <?php
        if (isset($_POST['addstaff'])) {
            $staffname = $_POST['staffname'];
            $staffwork = $_POST['staffwork'];

            $sql = "INSERT INTO staff(name,work) VALUES ('$staffname', '$staffwork')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: staff.php");
            }
        }
        ?>
    </div>

    <br>

    <!-- here room add because room.php and staff.php both css is similar -->
    <div class="room">
    <?php
        $sql = "select * from staff";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {

?>

<div class='roombox'>
            <div class="flex">
                <div>
<lord-icon
    src="https://cdn.lordicon.com/ozckswtv.json"
    trigger="hover"
    style="width:35px;">
</lord-icon>
                </div>
                <hr>
                <div>
                    <h3>
                        <?php echo $row['name'] ?><br>
                        <?php echo $row['work'] ?>
                    </h3>
                </div>
            </div>
            <br>
            <center><a href='staffdelete.php?id=<?php echo $row[' id'] ?>' >Delete</a></center>
        </div>
       <?php
        }
        ?>
    </div>

</body>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
</html>