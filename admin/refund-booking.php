<?php
include 'essentials.php';
?>


<br>
<!-- ================================================= -->

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
        border-collapse: collapse;   text-align: center;

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
        background-color: green;
        padding: 5px 8px;
    }

    table tr td .action {
        background-color: lightskyblue;
        padding: 5px 15px;
    }
</style>
<center>
    <h2 style="margin-top:10px">CANCELLED BOOKING DETAILS</h2>
    <br>
</center>
<div class="filter" style="width:100%;background-color:white;">
    <form action="" method="POST" class="filter">
    <div class="searchsection" style="width:80%;margin:auto;justify-content:space-between;display:flex;">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()"
        style="width:85%;padding:10px;border-radius:25px;border:1px solid #333;">
        <!-- <button id="downloadexcel">Download</button> -->
    </div>
      </form>
</div>

<?php
include("../database/config.php");


    
    $sql = "SELECT * FROM `roombooking_details` where booking_status='Waiting-for-Refund' and `advance_pay_status` = 'Waiting-for-Refund'";
    get_Data($sql);

?>



<!-- function data section -->

<?php
function get_Data($sql)
{
    include("../database/config.php");
    ?>
    <div class="roombooktable" class="table-responsive-xl">
        <table class="table table-bordered" id="table-data">
            <thead>

                <tr class="head">
                    <th scope="col">#</th>
                    <th scope="col">User Details</th>
                    <th scope="col">Room Details</th>
                    <th scope="col">Booking Details</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="action">Action</th>
                </tr>
            </thead>


            <?php
            $result = mysqli_query($conn, $sql);
            $todaydate = date("20y-m-d");

            while ($row = mysqli_fetch_array($result)) {
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
                                    <?php echo $roomrow[5]; ?>
                                </span></li>
                        </ul>
                    </td>
                    <td>
                        <li>Amount:<span>
                                ₹
                                <?php echo $row[6]; ?>
                            </span></li>
                        <li>Date:<span>
                                <?php echo $row[13]; ?>
                            </span> </li>
                    </td>

                    <td><button class="sta-btn">
                            <?php echo $row[10]; ?>

                        </button></td>
                    <td>
                            <a href="confirm-refund.php?id= <?php echo $row[0]; ?>">
                            <button class="action">
                               Confirm
                               </button>
                            </a>
                        </td>
                </tr>



                <?php
            } }?>

    </table>
</div>

<script src="../javascript/roombook.js"></script>
<script src="table2excel.js"></script>
<script>
    document.getElementById('downloadexcel').addEventListener('click', function()
    {
        var table2excel = new Table2Excel();
  table2excel.export(document.querySelectorAll("#table-data"));
    });
</script>