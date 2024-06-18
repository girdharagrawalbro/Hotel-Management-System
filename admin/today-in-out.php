<?php
include 'essentials.php';
$today = date('Y-m-d');
?>
<style>
    table {
        width: 90%;
        margin: auto;
        margin-top: 15px;
        border-collapse: collapse;
        text-align: center;
    }
    table .head {
        background-color: #333;
        color: white;
        border-collapse: collapse;
    }
    table .head th {
        padding: 10px;
        border-collapse: collapse;
        border: none;
    }
    table tr td {
        padding: 5px 10px;
        border-bottom: .5px solid #333;
    }
    table tr td li {
        text-align: center;
        padding: 0 5px;
        color: black;
        font-weight: 600;
    }
    table tr td li:hover {
        background-color: whitesmoke;
    }
    table tr td li span {
        color: #333;
        font-weight: 400;
    }
    table tr td button {
        background-color: green;
        padding: 5px 8px;
    }
    table tr td .action {
        background-color: lightskyblue;
        padding: 5px 15px;
    }
</style>
<br>
<br>
<!-- ================================================= -->
<center>
    <h2>TODAY CIN COUT DETAILS</h2>
    <br>
</center>
<div style="display:flex;column-gap:50px">
    <div class="bookroomchart">
        <h3 style="text-align: center;margin:10px 0;">Today Check-Ins</h3>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr class="head">
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Room</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $todayinsql = " SELECT * FROM `roombooking_details` where cin = '$today'";
                $todayinre = mysqli_query($conn, $todayinsql);
                while ($todayindata = mysqli_fetch_array($todayinre)) {
                    $usersql = "SELECT * from `customer_details`  where `UserId` = '$todayindata[1]'";
                    $r1 = mysqli_query($conn, $usersql);
                    $userrow = mysqli_fetch_array($r1);
                    $roomsql = "SELECT * FROM `room` WHERE `id`='$todayindata[2]'";
                    $r2 = mysqli_query($conn, $roomsql);
                    $roomrow = mysqli_fetch_array($r2);
                    ?>
                    <tr>
                        <td>
                            <?php echo $userrow[1] ?>
                        </td>
                        <td>
                            <?php echo $userrow[4] ?>
                        </td>
                        <td>
                            <?php echo $roomrow[1] ?>
                        </td>
                    <?php } ?>
            <tbody>
        </table>
    </div>
    <div class="bookroomchart">
        <h3 style="text-align: center;margin:10px 0;">Today Check-Outs</h3>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr class="head">
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Room</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $todayoutsql = " SELECT * FROM `roombooking_details` where cout = '$today'";
                $todayoutre = mysqli_query($conn, $todayoutsql);
                while ($todayoutdata = mysqli_fetch_array($todayoutre)) {
                    $usersql = "SELECT * from `customer_details`  where `UserId` = '$todayoutdata[1]'";
                    $r1 = mysqli_query($conn, $usersql);
                    $userrow = mysqli_fetch_array($r1);
                    $roomsql = "SELECT * FROM `room` WHERE `id`='$todayoutdata[2]'";
                    $r2 = mysqli_query($conn, $roomsql);
                    $roomrow = mysqli_fetch_array($r2);
                    ?>
                    <tr>
                        <td>
                            <?php echo $userrow[1] ?>
                        </td>
                        <td>
                            <?php echo $userrow[4] ?>
                        </td>
                        <td>
                            <?php echo $roomrow[1] ?>
                        </td>
                    <?php } ?>
            <tbody>
        </table>
    </div>
</div>
