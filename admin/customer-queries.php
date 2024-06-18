<?php
include 'essentials.php';
?>
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
<center>
    <h2 style="margin-top:10px">Customer Queries</h2>
    <br>
</center>
<div class="filter" style="width:100%;background-color:white;">
    <div class="searchsection" style="width:80%;margin:auto;justify-content:space-between;display:flex;">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()"
        style="width:85%;padding:10px;border-radius:25px;border:1px solid #333;">
        <button id="downloadexcel">Download</button>
    </div>
</div>
<?php
$sql  = "SELECT * FROM contact";
get_Data($sql);
function get_Data($sql){
            include("../database/config.php");
?>
        <div class="roombooktable" class="table-responsive-xl">
            <table class="table table-bordered" id="table-data">
                <thead>
                    <tr class="head ">
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                        <th scope="col">Contacted Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0)
            {
              while ($row=mysqli_fetch_array($result)){?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['dt']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>    
                    <?php 
                    if($row['status'] == 'Seen')
                    {
                        echo "";
                    }else{
                    ?>
                    <a href="read-query.php?id=<?php echo $row['id']?>"><lord-icon
    src="https://cdn.lordicon.com/fmjvulyw.json"
    trigger="hover"
    style="width:25px;">
</lord-icon></a><?php }?></td>
                </tr>
                <?php
            }} }
        ?>
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
