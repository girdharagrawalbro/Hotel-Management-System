<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include "navbar.php";
?>
<head>
    <title>Rooms | <?php echo $data[1]; ?>   </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .room-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 30px;
        height: 230px;
        width: 900px;
        display: flex;
        justify-content: space-between;
    }
    .room-card .btn {
        color: white;    
        padding: 4px 8px;
        text-align: center;
        border-radius: 5px;
    } 
    .room-card .price span,.room-card .btn span {
        font-size: 20px;
        font-weight: bold;
    }
    .room-contain {
        display: flex;
        width: 90%;
        margin: auto;
    }
    .room-contain .sidenav {
        position: fixed;
        width: 220px;
        height: 80vh;
        text-align: center;
        padding: 10px;
        border: 1px solid gray;
        background-color: whitesmoke;
    }
    .room-contain .room_list {
        margin-left: 240px;
        /* text-align: center; */
    }
    .room-contain .sidenav .sub-filter {
        padding: 10px;
    }
    .room-contain .sidenav .sub-filter .form-group,
    .room-contain .sidenav input {
        text-align: left;
        padding: 5px;
    }
    @media screen and (max-width: 768px) {
        .room-contain {
            flex-direction: column;
        }
        .room-contain .sidenav{
        width: 90%;
        height: 400px;
      
        }
        .room-contain .sidenav .sub-filter{
            display: flex;
            flex-direction: column;

        }
        .room-card{
            flex-direction: column;
            height: 700px;
        width: 320px;
        }
        .room-card img{
            width:280px;
        }
        #search_bar{
            display: none;
        }
        .room-contain .room_list {
        margin-left: 0px;
        margin-top: 420px;
    }

    }
</style>
<body>
      <br><br><br><br><br>
    <div class="room-contain">
        <div class="sidenav">
            <h2>FILTER</h2>
            <form method="post" action="#" style="margin-top:8px">
                <input class="form-control me-2" id="search_bar" name="search_bar" type="search" placeholder="Search"
                    aria-label="Search" onkeyup="searchFun()" readonly>
                <div class="sub-filter check-avail" style="margin-top:8px">
                    <H4>CHECK AVALIBLITY</H4>
                    <div class="form-floating" style="margin-top:8px" >
                        <label for="floatingInput" >Check-in</label>
                        <input type="date" class="form-control" name="checkindate" id="" placeholder="" style="margin:8px 0">
                    </div>
                    <div class="form-floating">
                        <label for="floatingPassword">Check-out</label>
                        <input type="date" class="form-control" id="" placeholder="" name="checkoutdate" style="margin-top:8px">
                    </div>
                </div>
                <div class="sub-filter facility">
                    <H4>ROOM TYPE</H4>
                    <div class="form-check" style="margin-top:8px">
                        <input class="form-check-input" type="radio" id="flexCheckDefault" name="roomtype"
                            value="Superior" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                            Superior
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexCheckDefault" name="roomtype"
                            value="Delux">
                        <label class="form-check-label" for="flexCheckDefault">
                            Delux
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexCheckDefault" name="roomtype"
                            value="Single">
                        <label class="form-check-label" for="flexCheckDefault">
                            Single
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexCheckDefault" name="roomtype"
                            value="Guest">
                        <label class="form-check-label" for="flexCheckDefault">
                            Guest
                        </label>
                    </div>
                </div>
                <!-- <br> -->
                <!-- <div class="sub-filter persons"> -->
                    <!-- <H6>PERSONS</H6> -->
                    <!-- <select class="form-select" aria-label="Default select example">
                    <option selected value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select> -->
                <!-- </div>
                <br> -->
                <button type="submit" value="submit" name="submit" class="btn">Submit</button>
            </form>
        </div>
        <div class="room_list" id="room-list">
            <?php
            if (
                isset($_POST['submit'])
            ) {
                $roomtype = $_POST['roomtype'];
                $cout = $_POST['checkoutdate'];
                $cin = $_POST['checkindate'];
                $roomid1 ="";
                $sql1 ="SELECT * FROM roombooking_details WHERE (cin <= '$cout' AND cout >= '$cin');";
                $rres = mysqli_query($conn, $sql1);
                while($data = mysqli_fetch_array($rres))
                {                                   
                                    $roomid1 = $data[2];
                }
                $sql = "SELECT * FROM `room` WHERE `id` <> '$roomid1' and `status`='Available' and rtype= '$roomtype';";  //select available rooms of the same type as booked one
                get_Data($sql);}
             elseif (!isset($_POST['submit'])) {
                $sql = "SELECT * FROM `room`";
                get_Data($sql);
            } else {
                $sql = "SELECT * FROM `room`";
                get_Data($sql);
            }
            function get_Data($sql)
            {
                include("database/config.php");
                $rooms_fetch = mysqli_query($conn, $sql);
                while ($rfd = mysqli_fetch_array($rooms_fetch)) {
                ?>
                
                    <div class="room-card" id="room-card">
                    <div>
                    <a href="roomdetail.php?id=<?php echo $rfd[0]?>">  <img width="250px" src='resources/rooms_img/<?php echo $rfd[6];?>' alt="img"></a>
                    </div>    
                    <div style="margin-left:15px;">
                        <h2 id="data">
                 <?php echo $rfd[1]; ?> Room
                </h2>
                <br>
                <h4 style="margin-top:8px;">
                                <?php echo $rfd[2]; ?> Bedding
                            </h4>
                             <h4 style="margin-top:8px;">
                               Capacity :  <?php echo $rfd[3]; ?>
                            </h4>  <h4 style="margin-top:8px;">
                              Desc :  <span><?php echo $rfd[5]; ?></span>
                           <p>Features: Wifi Television, Ac, Room heater</p>
                    </div>
                    <div style="margin-top:15px">
                    <div class="btn status" style="background-color:#ff0000b3;">
                            <span>
                                <?php echo $rfd[7]; ?>
                            </span>
                        </div>
                        <br>
                        <div class=" btn price" style="background-color:#1cbcf1;">
                            <span>Rs.
                                <?php echo $rfd[4]; ?>
                            </span>/ night
                        </div>
                        <br>
                        <a href="roomdetail.php?id=<?php echo $rfd[0]?>">
                        <div class="btn" style="background-color:#37da37;">
                            <span>Details
                            </span>
                        </div></a> 
                    </div>  
                    </div>
                
                <?php }
            } ?>
        </div>
    </div>
</body>
<script>const searchFun = () => {
        let filter = document.getElementById('search_bar').value.toUpperCase();
        let myTable = document.getElementById("table-data");
        let tr = myTable.getElementsByTagName('tr');
        for (var i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td')[0];
            if (td) {
                let textvalue = td.textContent || td.innerHTML;
                if (textvalue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" -->
<!-- integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" -->
<!-- crossorigin="anonymous"></script> -->
</html>