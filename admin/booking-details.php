<?php
include 'essentials.php';
?>
    <style>
        .filter select,
        .filter input,
        .filter option {
            width: 200px;
        }
        button {
            background-color: blue;
            padding: 5px 10px;
        }
    </style>
    <style>
        table {
            width: 95%;
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
            text-align: left;
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
            background-color: #57c957;
            padding: 2px 8px;
            margin-top: 5px;
        }
        table tr td .action {
            background-color: lightskyblue;
            padding: 5px 15px;
        }
    </style>
<br>
<center>
    <h2 style="margin-top:10px">BOOKING DETAILS</h2>
    <br>
</center>
<div class="filter" style="width:100%;background-color:white;">
    <form action="#" method="post" class="filter">
        <div class="searchsection" style="width:80%;margin:auto;justify-content:space-between;display:flex;">
            <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()"
                style="width:85%;padding:10px;border-radius:25px;border:1px solid #333;">
            <button id="downloadexcel">Download</button>
        </div>
        <br>
        <div style="width:85%;margin:auto;justify-content:space-between;display:flex;">
            <div>
                <label for="">Room Type </label>
                <select name="roomtype" id="">
                    <option value="0">select</option>
                    <option value="Delux">Delux</option>
                    <option value="Superior">Superior</option>
                    <option value="Guest">Guest</option>
                    <option value="Single">Single</option>
                </select>
            </div>
            <div>
                <label for="">Bed Type</label>
                <select name="bedtype" id="">
                    <option value="0">select</option>
                    <option value="Single">single</option>
                    <option value="Double">double</option>
                </select>
            </div>
            <div>
                <label for="">Booking Status </label>
                <select name="bookstatus" id="">
                    <option value="">select</option>
                    <option value="Active">Active</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Checked_Out">Checked_Out</option>
                    <option value="Waiting_for_Advance_Pay">Waiting_for_Advance_Pay</option>
                    <option value="Waiting_for_confirmation">Waiting_for_confirmation</option>
                </select>
            </div>
            <div>
                <label for="">Payment Status</label>
                <select name="paystatus" id="">
                    <option value="">select</option>
                    <option value="Paid">Paid</option>
                    <option value="Not_Paid">Not_Paid</option>
                </select>
            </div>
        </div>
        <br>
        <div style="width:85%;margin:auto;justify-content:space-between;display:flex;">
            <div>
                <label for="">Checkin Date</label>
                <input type="date" name="checkindate" id="checkindate">
            </div>
            <div>
                <label for="">Checkout Date</label>
                <input type="date" name="checkoutdate" id="checkindate" />
            </div>
            <div><Label>Booking From Date </Label>
                <Input type="Date" id="fromdate" name="fromdate" />
            </div>
            <div><Label>To Date </Label>
                <Input type="Date" id="todate" name="todate" />
                <!-- <input type="text" name="sta" value="Active"> -->
            </div>
        </div>
        <div>
            <button type="submit "value="submit" name="submit" style="position:absolute;right:50px;top:170px">Submit</button>
        </div>
    </form>
</div>
<div class="roombooktable" class="table-responsive-xl">
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr class="head">
                    <th scope="col">#</th>
                    <th scope="col">User Details</th>
                    <th scope="col">Room Details</th>
                    <th scope="col">Booking Details</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="action">Print</th>
                </tr>
            </thead>    
<?php
include("../database/config.php");
if(isset($_POST['submit'])) {
// if (isset($_POST['submit']) && (($_POST['roomtype']) || (($_POST['bedtype']) || ($_POST['checkindate']) || ($_POST['checkoutdate']) || ($_POST['fromdate']) || ($_POST['todate']) || ($_POST['todate']) || ($_POST['todate'])))) {
    $roomtype = $_POST['roomtype'];
    $bedtype = $_POST['bedtype'];
    $bookstatus = $_POST['bookstatus'];
    $paystatus = $_POST['paystatus'];
    $checkindate = $_POST['checkindate'];
    $checkoutdate = $_POST['checkoutdate'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
        $tr = "SELECT *
        FROM `roombooking_details`
        WHERE `room_id` IN (SELECT id FROM `room`
                          WHERE `rtype` = '$roomtype' OR `bedding` = '$bedtype')
              or booking_status = '$bookstatus' OR final_pay_status = '$paystatus' OR cin = '$checkindate' OR cout = '$checkoutdate' OR bookdate BETWEEN '$fromdate' AND '$todate'";
get_Data($tr);
} elseif (!isset($_POST['submit'])) {
    $sql = "SELECT * FROM `roombooking_details`";
    get_Data($sql);
} else {
    $sql = "SELECT * FROM `roombooking_details`";
    get_Data($sql);
}
?>
<!-- function data section -->
<?php
function get_Data($tr)
{
    include("../database/config.php");
    ?>
            <?php
            $result = mysqli_query($conn, $tr);
            $numrows = mysqli_num_rows($result);
$totalrevenue= 0;
    $profit = 0;
            while ($row = mysqli_fetch_array($result)) {
                $totalrevenue = $totalrevenue + $row[6];
                $profit = $totalrevenue * .8;
                $userid = $row[1];
                $roomid = $row[2];
                $usersql = "SELECT * from `customer_details`  where `UserId` = '$userid'";
                $r1 = mysqli_query($conn, $usersql);
                $userrow = mysqli_fetch_array($r1);
                $roomsql = "SELECT * FROM `room` WHERE `id`='$roomid'";
                $r2 = mysqli_query($conn, $roomsql);
                $roomrow = mysqli_fetch_array($r2);
                ?>
                <tr>
                    <td>
                        <?php echo $row[0]; ?>
                    </td>
                    <td>
                        <ul>
                            <li>User ID: <span>
                                    <?php echo $userrow[0]; ?>
                                </span> </li>
                            <li>Name: <span>
                                    <?php echo $userrow[1]; ?>
                                </span></li>
                            <li>Phone: <span>
                                    <?php echo $userrow[4]; ?>
                                </span></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li></li>
                            <li>Room: <span>
                                    <?php echo $roomrow[1]; ?>
                                </span></li>
                            <li>Bedding:<span>
                                    <?php echo $roomrow[2]; ?>
                                </span></li>
                            <li>Price:<span>
                                    ₹
                                    <?php echo $roomrow[4]; ?>
                                </span></li>
                        </ul>
                    </td>
                    <td>
                        <li>Amount:<span>
                                ₹
                                <?php echo $row[6]; ?>
                            </span></li>
                        <li>C-In:<span>
                                <?php echo $row[3]; ?>
                            </span> </li>
                        <li>C-Out:<span>
                                <?php echo $row[4]; ?>
                            </span> </li>
                        <li>Book Date:<span>
                                <?php echo $row[13]; ?>
                            </span> </li>
                    </td>
                    <td>Booking : <button class="sta-btn">
                            <?php echo $row[10]; ?>
                        </button><br>Adv-Pay :
                        <button class="sta-btn">
                            <?php echo $row[9]; ?>
                        </button><br>Final-Pay : <button class="sta-btn">
                            <?php echo $row[11]; ?>
                        </button>
                    </td>
                    <td>
<?php 
if($row[10]== 'Active' || $row[10] == 'Checked_Out')
{?>
    <a href="invoice.php?id= <?php echo $row[0]; ?>">
                                <lord-icon
        src="https://cdn.lordicon.com/ujxzdfjx.json"
        trigger="hover"
        style="width:35px">
    </lord-icon>
                                </a>
    <?php
}
else{
    echo "X";
}
?>
                        </td>
                </tr>
                <?php
            }
            echo "<br>
            <div style='display:flex;justify-content:center;column-gap:100px'>
               <h3>Row Count  : $numrows</h3> <h3>Revenve : ₹ $totalrevenue</h3> <h3>Profit : ₹ $profit</h3>
            </div>";
} ?>
    </table>
</div>
<script src="../javascript/roombook.js"></script>
<script src="table2excel.js"></script>
<script>
    document.getElementById('downloadexcel').addEventListener('click', function () {
        var table2excel = new Table2Excel();
        table2excel.export(document.querySelectorAll("#table-data"));
    });
</script>