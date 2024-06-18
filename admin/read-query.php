    <?php 
    $id =$_GET['id'];
    include '../database/config.php';
    include '../essentials.php';
        $sql = "UPDATE `contact` SET `status` = 'Seen' WHERE `id` = '$id' ";
        if ($conn->query($sql) == true) {
            $msg = "Msg Seen";
            alert($msg);
            header("Location: customer-queries.php");
        }
    ?>