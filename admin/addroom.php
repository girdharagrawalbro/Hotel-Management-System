<?php
include 'essentials.php';
?>
<div id="RoomAdd" class="modal" style="display:block;">
    <div class="modal-content">
        <div class="log-flex-col" style="justify-content:center;">
            <div class="log-name">
                <h4>Add Room</h4>
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
                                               <option value="Single">Single Bedding</option>
                        <option value="Double">Double Bedding</option>
                    </select>
                </div>
                <br>
                <div class="log-input">
                    <label for="price">Price : </label><br>
                    <input type="int" name="price"
                        placeholder="Rs." required>
                </div>
        </div>
        <div class="log-flex-col">
            <div class="log-btn">
                <button type="submit" name="submit" class="btn">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $typeroom = $_POST['troom'];
    $typeofbed = $_POST['bed'];
    $price = $_POST['price'];
        $sql = "insert into room (`rtype`,`bedding`,`price`) values ('$typeroom' , '$typeofbed','$price')";
        if ($conn->query($sql) == true) {
            echo "New room added";
            echo "<script>window.location.href='room-details.php';</script>";
        }
    }
?>