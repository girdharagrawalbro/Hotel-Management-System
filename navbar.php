    <?php
    include 'essentials.php';
    include 'links.php';
    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // Hotel data fetch 
        $sql = "Select * from hotel";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
    // rooms data 
    $sql = "Select * from room";
    $roomres = mysqli_query($conn, $sql);
    //customer data fetch 
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $mail = $_SESSION['useremail'];
        $sql = "Select * from customer_details where Email = '$mail'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header class="header">
            <nav class="navbar flex1">
                <div class="logo">
                    <!-- <img src="https://drive.google.com/thumbnail?id=<?php echo $data['logo']; ?>" alt="logo"> -->
                    <!-- <img src="https://lh3.googleusercontent.com/d/<?php echo $data['logo']; ?>  =s220?authuser=0" alt="logo"> -->
                    <img src="http://localhost/hotel-management-system/resources/logo.jpg" alt="logo">
                    <!-- <img src="http://localhost/hotel-management-system/resources/logo.webm" alt="logo"> -->
                    <!-- <video autoplay muted width="100px">
                        <source src="http://localhost/hotel-management-system/resources/logo.webm" type="video/webm" >
                    </video> -->
                </div>
                <div class="menu-icon" onclick="toggleMenu()">☰</div>
                <ul class="nav-menu">
                    <li> <a href="http://localhost/hotel-management-system/index.php#home">Home</a> </li>
                    <li> <a href="http://localhost/hotel-management-system/index.php#about">About</a> </li>
                    <li> <a href="http://localhost/hotel-management-system/index.php#facility">Facilities</a> </li>
                    <li> <a href="http://localhost/hotel-management-system/rooms.php">Room</a> </li>
                    <li> <a href="http://localhost/hotel-management-system/index.php#contact">Contact</a> </li>
                </ul>
                <div class="btn-sec">
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        ?>
                        <div class="dropdown">
                            <button class="dropdown-button" onmouseover="toggleDropdown()">#
                                <?php echo $row[1]; ?>
                            </button>
                            <div class="dropdown-content" id="myDropdown">
                                <!-- <a href="http://localhost/hotel-management-system/customer/index.php">Home</a> -->
                                <a href="http://localhost/hotel-management-system/customer/index.php">Profile</a>
                                <a href="http://localhost/hotel-management-system/customer/customer_bookings.php">Bookings</a>
                                <a href="http://localhost/hotel-management-system/logout.php">Logout</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <button class="btn" id="openLogin">LogIn</button>
                        <button class="btn" id="openRegister">Register</button>
                        <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
        <!-- Login Popup  -->
        <div id="loginModal" class="modal">
            <div class="modal-content">
                <div class="log-flex-col">
                    <div class="log-name">
                        <h4>Customer Login</h4>
                    </div>
                    <div class="cancel">
                        <span class="close" id="closeLogin">&times;</span>
                    </div>
                </div>
                <hr>
                <br>
                <div class="log-main">
                    <form action="" method="post">
                        <div class="log-input">
                            <label for="email">Email</label><br>
                            <input type="email" name="Email" required>
                        </div>
                        <br>
                        <div class="log-input">
                            <label for="password">Password</label><br>
                            <input type="password" name="Password" required style="width:93%;" id="id_password">
                            <i class="far fa-eye" id="togglePassword"
                                style="margin-top:12px; cursor: pointer;float:right;"></i>
                        </div>
                </div>
                <br>
                <div class="log-flex-col">
                    <div class="log-btn">
                        <button type="submit" name="user_login_submit" class="btn">Log in</button>
                    </div>
                    <div class="log-forget">
                        <button style="border:none;background:transparent;color:#333;" id="openForgot">Forgot Passoword
                            ?</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Login Popup Php -->
        <?php
        include 'database/config.php';
        if (isset($_POST['user_login_submit'])) {
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            if ($Email == "admin@gmail.com" && $Password == "admin") {
                session_start();
                $_SESSION['adminloggedin'] = true;
                $_SESSION['useremail'] = $Email;
                alert('Admin Login Successfull');
                echo "<script>location.replace('admin/index.php');</script>";
            } else {
                $sql = "SELECT * FROM customer_details WHERE `Email` = '$Email' AND `Password` = BINARY'$Password' And `status`= 'Verified'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                $sql2 = "SELECT * FROM customer_details WHERE `Email` = '$Email' AND `Password` = BINARY'$Password' And `status`= 'not-verified' or `status`='waiting_for_verify'";
                $result2 = mysqli_query($conn, $sql2);
                $num2 = mysqli_num_rows($result2);
                if ($num == 1) {
                    $login = true;
                    session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['useremail'] = $Email;
                    $msg = "Logged In...";
                    alert($msg);
                    redirect($currentURL);
                } elseif ($num2 == 1) {
                    $msg = "Customer Not Verified";
                    alert($msg);
                } else {
                    $msg = "Invalid Credentials";
                    alert($msg);
                }
            }
            $Email = "";
            $Password = "";
        }
        ?>
        <!-- Register Popup  -->
        <div id="registerModal" class="modal">
            <div class="modal-content">
                <div class="log-flex-col">
                    <div class="log-name">
                        <h4>Customer Registration</h4>
                    </div>
                    <div class="cancel">
                        <span class="close" id="closeRegister">&times;</span>
                    </div>
                </div>
                <hr>
                <br>
                <div class="log-main">
                    <form action="#" method="post">
                        <div class="log-input">
                            <label for="username">Usermame</label><br>
                            <input type="username" name="Username" required>
                        </div>
                        <br>
                        <div class="log-input">
                            <label for="email">Email</label><br>
                            <input type="email" name="Email" required>
                        </div>
                        <br>
                        <div class="log-input">
                            <label for="password">Password</label><br>
                            <input type="password" name="Password" id="password1" required onInput="check()"
                                style="width:93%">
                            <i class="far fa-eye" id="togglePassword1"
                                style="margin-top:12px; cursor: pointer;float:right;"></i>
                            <p id="message"></p>
                        </div>
                        <div class="log-input">
                            <label for="cpassword">Confirm Password</label><br>
                            <input type="password" name="CPassword" id="password2" required style="width:93%">
                            <i class="far fa-eye" id="togglePassword2"
                                style="margin-top:12px; cursor: pointer;float:right;"></i>
                        </div>
                </div>
                <div class="log-flex-col">
                    <div class="log-btn">
                        <button type="submit" name="user_signup_submit" class="btn">Register</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Register Popup Php -->
        <?php
        include 'database/config.php';
        if (isset($_POST['user_signup_submit'])) {
            $Username = $_POST['Username'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $CPassword = $_POST['CPassword'];
            if ($Password == $CPassword) {
                $sql = "SELECT * FROM customer_details WHERE Email = '$Email'";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        $msg = "Email already exists";
                        alert($msg);
                } else {
                    $sql = "INSERT INTO customer_details (`Username`,`Email`,`Password`) VALUES ('$Username', '$Email', '$Password')";
                    $result = mysqli_query($conn, $sql);
                    $msg = "Registration Successfull";
                    alert($msg);
                    $Password = "";
                    $CPassword = "";
                    $Username = "";
                    $Email = "";
                    redirect($currentURL);
                }
            } else {
                $msg = "Password does not match";
                alert($msg);
            }
        }
        ?>
        <!-- forget password popup  -->
        <div id="forgotModal" class="modal">
            <div class="modal-content">
                <div class="log-flex-col">
                    <div class="log-name">
                        <h4>Forgot Passoword</h4>
                    </div>
                    <div class="cancel">
                        <span class="close" id="closeforgot">&times;</span>
                    </div>
                </div>
                <hr>
                <br>
                <div class="log-main">
                    <form method="post" action="verify-otp.php">
                        <div class="log-input">
                            <p>Please enter your email address. You will get your Username and Password.</p>
                        </div>
                        <div class="log-input">
                            <label for="password">Email</label><br>
                            <input type="email" name="email" placeholder="Enter your email address" required>
                        </div>
                </div>
                <br>
                <div class="log-flex-col">
                    <div class="log-btn">
                        <button type="submit" name="otpsend" value="otpsend" class="btn">Send</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- forgot password  -->
        <!-- menu  -->
        <script>
            function toggleMenu() {
                const menu = document.querySelector('.nav-menu');
                menu.classList.toggle('show');
            }
        </script>
        <!-- login register popup  -->
        <script>document.addEventListener('DOMContentLoaded', function () {
                const openModalBtn = document.getElementById('openLogin');
                const loginModal = document.getElementById('loginModal');
                const closeModalBtn = document.getElementById('closeLogin');
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
        <script>document.addEventListener('DOMContentLoaded', function () {
                const openModalBtn = document.getElementById('openRegister');
                const loginModal = document.getElementById('registerModal');
                const closeModalBtn = document.getElementById('closeRegister');
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
        <script>document.addEventListener('DOMContentLoaded', function () {
                const openModalBtn = document.getElementById('openForgot');
                const loginModal = document.getElementById('forgotModal');
                const closeModalBtn = document.getElementById('closeforgot');
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
        <script src="javascript/index.js"></script>
        <!-- password toggel eyes  -->
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#id_password');
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
            const togglePassword1 = document.querySelector('#togglePassword1');
            const password1 = document.querySelector('#password1');
            togglePassword1.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                password1.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
            const togglePassword2 = document.querySelector('#togglePassword2');
            const password2 = document.querySelector('#password2');
            togglePassword2.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                password2.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            }); 
        </script>
        <!-- Strong password check -->
        <script>
            function check() {
                var password = document.getElementById("password1").value;
                var message = document.getElementById("message");
                let reg = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,15}$/;
                if (reg.test(password)) {
                    message.style.color = 'green';
                    message.innerHTML = 'Strong password!';
                } else {
                    message.style.color = 'red';
                    message.innerHTML = 'Weak password! Should contain at least 8 characters, 1 digit, 1 special character';
                }
            }
        </script>
        <script>
            // Custom JavaScript for dropdown functionality
            function toggleDropdown() {
                var dropdownContent = document.getElementById("myDropdown");
                dropdownContent.style.display = (dropdownContent.style.display === "block") ? "none" : "block";
            }
            // Close the dropdown if the user clicks outside of it
            window.onclick = function (event) {
                if (!event.target.matches('.dropdown-button')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    for (var i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.style.display === "block") {
                            openDropdown.style.display = "none";
                        }
                    }
                }
            }
        </script>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </html>