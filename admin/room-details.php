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
        width: 90%;
        margin: auto;
        margin-top: 15px;
        text-align: center;
        border-collapse: collapse;
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
    <h2 style="margin-top:10px">ROOM DETAILS</h2>
    <br>
</center>
<div class="filter" style="width:100%;background-color:white;">
    <div class="searchsection" style="width:80%;margin:auto;justify-content:space-between;display:flex;">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()"
            style="width:85%;padding:10px;border-radius:25px;border:1px solid #333;">
          <a href="addroom.php"><button>Add Room</button></a>
    </div>
</div>
<?php
$sql = "SELECT * FROM room ";
get_Data($sql);
function get_Data($sql)
{
    include("../database/config.php");
    ?>
    <div class="roombooktable" class="table-responsive-xl">
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr class="head ">
                    <th scope="col">Id</th>
                    <th scope="col">Type</th>
                    <th scope="col">Bedding</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td>
                            <?php echo $row[0]; ?>
                        </td>
                        <td>
                            <?php echo $row[1]; ?>
                        </td>
                        <td>
                            <?php echo $row[2]; ?>
                        </td>
                        <td>
                            <?php echo $row[3]; ?>
                        </td>
                        <td>₹
                            <?php echo $row[4]; ?>
                        </td>
                        <td>
                           <a href="editroom.php?id=<?php echo $row[0]; ?>">
<lord-icon
    src="https://cdn.lordicon.com/zfzufhzk.json"
    trigger="hover"
    style="width:25px">
</lord-icon>   
                         </a>         </td>
                    </tr>
                    <?php
                }
            }
}
?>
    </table>
</div>
<script src="../javascript/roombook.js"></script>
 <script>document.addEventListener('DOMContentLoaded', function () {
            const openModalBtn = document.getElementById('openroomadd');
            const loginModal = document.getElementById('RoomAdd');
            const closeModalBtn = document.getElementById('closeroomadd');
            openModalBtn.addEventListener('click', function () {
                loginModal.style.display = 'block';
            });
            closeModalBtn.addEventListener('click', function () {
                loginModal.style.display = 'none';
            });
            window.addEventListener('click', function (event) {
                if (event.target === loginModal) {
                    loginModal.style.display = 'none';
                }
            });
        });
    </script>
</div>
<br>
