<?php
include 'essentials.php';
$roomid = $_GET['id'];
$sql = "Select * from room where id ='$roomid'";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($res);
?>
<div id="RoomAdd" class="modal" style="display:block;">
    <div class="modal-content">
        <div class="log-flex-col" style="justify-content:center;">
            <div class="log-name">
                <h4>Edit Room</h4>
            </div>
        </div>
        <hr>
        <br>
        <div class="log-main">
            <form action="#" method="post">
                <div class="log-input">
                    <label for="troom">Type of Room : </label><br>
                    <select name="troom" class="form-control" style="width:100%;    padding: 5px;
    margin-top: 4px;" required>
                        <option value="<?php echo $data[1]; ?>">
                            <?php echo $data[1]; ?>
                        </option>
                        <option value="Superior">Superior Room</option>
                        <option value="Deluxe">Delux Room</option>
                        <option value="Guest">Guest Room</option>
                        <option value="Single">Single Room</option>
                    </select>
                </div>
                <br>
                <div class="log-input">
                    <label for="bed">Bedding :</label><br>
                    <select name="bed" class="form-control" style="width:100%;    padding: 5px;
    margin-top: 4px;" required>
                        <option value="<?php echo $data[2]; ?>">
                            <?php echo $data[2]; ?>
                        </option>
                        <option value="Single">Single Bedding</option>
                        <option value="Double">Double Bedding</option>
                    </select>
                </div>
                <br>
                <div class="log-input">
                    <label for="price">Price : </label><br>
                    <input type="int" name="price" value="<?php echo $data[5]; ?>"
                        placeholder="Rs.<?php echo $data[5]; ?>" required>
                </div>
        </div>
        <div class="log-flex-col">
            <div class="log-btn">
                <button type="submit" name="update" class="btn">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['update'])) {
    $typeofroom = $_POST['troom'];
    $typeofbed = $_POST['bed'];
    $price = $_POST['price'];
        $sql = "update `room` SET `rtype`='$typeofroom' ,`bedding` = '$typeofbed' , price= '$price' where id='$roomid'";
        if ($conn->query($sql) == true) {
            echo "Changes Saved in Database";
            echo "<script>window.location.href='room-details.php';</script>";
        }
    }
?>