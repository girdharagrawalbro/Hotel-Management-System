<?php
include 'essentials.php';
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

                table tr td button{
                    background-color: green;
                    padding: 5px 8px;
                }
                table tr td .action{
                    background-color: lightskyblue;
                    padding: 5px 15px;
                }
            </style>


    <script src="table2excel.js"></script>

    <br>
    <br>
    <!-- ================================================= -->
    <center>
        <h2>CUSTOMER DETAILS</h2>
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
    
        $sql = "SELECT * FROM `customer_details`";
        get_Data($sql);
    
       ?>


        <?php
function get_Data($sql){
            include("../database/config.php");
?>
        <div class="roombooktable" class="table-responsive-xl">

            <table class="table table-bordered" id="table-data">
                <thead>
                    <tr class="head">
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
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
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php echo $row[7]; ?></td>
                    <td>
                        <?php 
                        if($row[7]== 'not-verified'){
                            echo "
                            <a href='verify-customer.php?id=$row[0];' style='color:black;'>
                            <i class='fa fa-thumbs-up' aria-hidden='true' style='width:25px;'></i>
                            </a>
                        ";
                        }
                        else{
                            echo "

                            <a href='unverify-customer.php?id=$row[0];'>
<lord-icon
    src='https://cdn.lordicon.com/ysheqztl.json'
    trigger='hover'
    style='width: 25px;px'>
</lord-icon>
                            </a>
                      ";
                        }
                        ?>
                       
                    </td>


                    
                </tr>


                <?php
            }} }
        ?>

                <script src="../javascript/roombook.js"></script>
</body>
<script>
    document.getElementById('downloadexcel').addEventListener('click', function()
    {
        var table2excel = new Table2Excel();
  table2excel.export(document.querySelectorAll("#table-data"));
    });
</script>
</html>     