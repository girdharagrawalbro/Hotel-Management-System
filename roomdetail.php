<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include "navbar.php";
$id = $_GET['id'];
?>

    <head>
        <title>ROOM DETAIL |
            <?php echo $data[1]; ?>
        </title>
      

        <style>
        .room-image {
            width: 420px;
            object-fit: cover;
            border-radius: 8px;
        }
        .room-data{
            padding: 10px 10px 10px 30px;
        }
        .book-button {
            display: block;
            width: 80%;
            margin: auto;
            padding: 10px;
            text-align: center;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container .hero h6{
                color: lightslategray;
        }

    </style>    
        <body>
    <br>
    <br>
        <br>

<?php        $sql = "Select * from room where id='$id';";
                $result1 = mysqli_query($conn, $sql);
                $rooms = mysqli_fetch_array($result1)?>
                        <br>
                        <br>
                    <section class="main">
                    <div class="container">
                        <div class="hero">
                            <h2><?php echo $rooms[1];?> Room</h2>
                            <h6 style="margin-top:8px">HOME > <span>ROOMS</span></h6>
                        </div>
                        <br>
            
                        
                        <div class="pro">
                            <div class="data" style="width:100%;">
                                <div class="room_image" style="text-align:left; width:40%">
                                    <img  class="room-image" src="resources/rooms_img/<?php echo $rooms[6];?>" alt="">
                                </div>
            
                                <div class="room-data"  style="width:100%;">
                                    <h2>Rs. <?php echo $rooms[4];?> /night</h2>
                                    <br>

                                    <h4>Bedding : <?php echo $rooms[2];?> </h4>
                                    <br>
                      <h4 style="margin-top:8px;">
                               Capacity :  <?php echo $rooms[3]; ?>
                            </h4>  <h4 style="margin-top:8px;">
                              Desc :  <span><?php echo $rooms[5]; ?></span>
                           <p>Features: Wifi Television, Ac, Room heater</p>
<br>
<br>    
        <a href="roombook.php?id=<?php echo $id;?>" class="book-button">Book Now</a>
                                  
                                </div>
                            </div>
                        </div>
            
                    </div>
                </section>


                
</body>

</html>
