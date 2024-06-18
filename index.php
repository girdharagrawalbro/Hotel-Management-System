<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include 'navbar.php';?>
<head>
    <title>Home |
        <?php echo $data[1]; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>

    /* Custom CSS Styles */
    .card {
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        margin: 10px;
    }
    #rooms .scroll-container::-webkit-scrollbar {
        width: 0;
        auto-sc
    }
    .card-img-top {
        width: 230px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .card-body {
        padding: 5px;
    }
    .card-body h4,
    .card-body h5 {
        margin-top: 8px;
    }
    .cardlink {
        display: flex;
    }
    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .card-text {
        font-size: 1rem;
        margin-bottom: 1rem;
    }
    .card-link {
        display: inline-block;
        background-color: #CC8C18;
        ;
        padding: 5px 8px;
        margin-right: 10px;
        border-radius: 5px;
        margin-top: 10px;
        color: #fff;
        text-decoration: none;
    }
    .card-link:hover {
        background-color: #ffa400;
    }
    
    .check-avail {
        margin: auto;
        margin-top: -15%;
        background-color: white;
        width: 80%;
        text-align: center;
        padding: 10px;
        /* position:relative;            */
    }
    .check-avail form {
        display: flex;
        margin: auto;
        width: 80%;
        padding: 10px;
    }
    .check-avail .form-group {
        padding: 10px;
    }
    .check-avail form input,
    .check-avail form select {
        padding: 5px;
    }

</style>
<body>
    <section class="home" id="home">
        <div class="container">
            <br><br>
            <h1>
                <?php echo $data[4]; ?>
            </h1>
            <center>
                <p>
                    <?php echo $data[5]; ?>
                </p>
            </center>
        </div>
    </section>
    <div class="check-avail">
        <h2>Check Booking Availability</h2>
        <form method="post" action="rooms.php">
            <div class="form-group">
                <label for="check-in">Check-in</label>
                <input type="date" id="check-in" name="checkindate">
            </div>
            <div class="form-group">
                <label for="check-out">Check-out</label>
                <input type="date" id="check-out" name="checkoutdate">
            </div>
            <div class="form-group">
                <label for="roomtype">RoomType</label>
                <select id="roomtype" name="roomtype" required>
                    <option selected>select</option>
                    <option value="Superior">Superior</option>
                    <option value="Delux">Delux</option>
                    <option value="Single">Single</option>
                    <option value="Guest">Guest</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" value="submit">Submit</button>
            </div>
        </form>
    </div>
    <br><br><br><br><br>

    <section class="about" id="about">
        <div class="container">
            <div class="heading">
                <h5>
                    <?php echo $data[6]; ?>
                </h5>
                <h2>
                    <?php echo $data[7]; ?>
                </h2>
            </div>
            <div class="content flex">
                <div class="left">
                    <h3>
                        <?php echo $data[8]; ?>
                    </h3>
                    <p style="text-align:justify;">
                        <?php echo $data[9]; ?>
                    </p>
                    <button class="flex1">
                        <a href="rooms.php"><span>Check Avaity</span></a>
                    </button>
                </div>
                <div class="right" id="right">
                    <img src="resources/hotel2photo.jpg" alt="img" width="110%">
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper">
        <div class="container">
            <div class="item">
                <div class="heading">
                    <h5>
                        <?php echo $data[10]; ?>
                    </h5>
                    <h3>
                        <?php echo $data[11]; ?>
                    </h3>
                </div>
                <p style="text-align:justify;">
                    <?php echo $data[12]; ?>
                </p>
            </div>
        </div>
    </section>
    <br><br>
    <br><br>
    <section class="wrapper2" id="facility">
        <div class="container">
            <div class="heading mtop">
                <h5>FACILITIES</h5>
                <h2>Giving Entirely Awesome </h2>
            </div>
            <div class="content grid">
                <div class="box">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <p>Free Cost</p>
                    <h3>Best Rate Guarantee</h3>
                    <span>
                        <>
                    </span>
                </div>
                <div class="box">
                    <i class="fab fa-resolving"></i>
                    <p>Free Cost</p>
                    <h3>Reservations 24/7</h3>
                    <span>
                        <>
                    </span>
                </div>
                <div class="box">
                    <i class="fa fa-wifi" aria-hidden="true"></i>
                    <p>Free Cost</p>
                    <h3>High-Speed Wi-Fi</h3>
                    <span>
                        <>
                    </span>
                </div>
                <div class="box">
                    <i class="fa fa-coffee" aria-hidden="true"></i>
                    <p>Free Cost</p>
                    <h3>Free Breakfast</h3>
                    <span>
                        <>
                    </span>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="offer mtop" id="rooms">
        <div class="scroll-container" style="display:flex; overflow-x: auto;  scroll-behavior: smooth;">
            <?php
            while ($rooms = mysqli_fetch_array($roomres)) {
                ?>
                <div class="card">
                    <img src="resources/rooms_img/<?php echo $rooms[6]; ?>" class="card-img-top" alt="Card Image">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $rooms[1]; ?> Room
                        </h5>
                        <p class="card-text">
                            <?php echo $rooms[5]; ?>
                        </p>
                        <h4>Price : <span>Rs.
                                <?php echo $rooms[4]; ?>
                            </span></h4>
                        <h5>Bedding : <span>
                                <?php echo $rooms[2]; ?>
                            </span></h5>
                        <h5>Status : <span>
                                <?php echo $rooms[7]; ?>
                            </span></h5>
                    </div>
                    <div class="card-body cardlink">
                        <a href="roomdetail.php?id=<?php echo $rooms[0]; ?>" class="card-link">Detail</a>
                        <a href="roombook.php?id=<?php echo $rooms[0]; ?>" class="card-link">Book Now</a>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </section>
    <section class="map top">
        <iframe src="https://maps.google.com/maps?q=raipur&t=&z=12&ie=UTF8&iwloc=&output=embed" width="100%"
            height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>
    <footer>
        <div class="container top">
            <div class="subscribe" id="contact">
                <h2>Contact Us</h2>
                <p>Send your query to us, we will respond to you shortly.</p>
                <div class="input flex">
                    <form action="contact-email.php" method="post">
                        <div class="form-flex">
                            <input type="text" placeholder="Enter your name" name="name">
                            <input type="email" placeholder="Your Email address" name="email">
                            <textarea name="message" id="" cols="1" rows="1" placeholder="Any Message"></textarea>
                            <button class="flex1" type="submit" name="send">Contact Us</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
    </footer>
</body>
</html>