<?php
$conn = mysqli_connect("localhost","root","", "hotel"); 
 if(!$conn){
    die("<script>alert('connection Failed.')</script>");
}
echo "<script>alert('connection Failed.')</script>";

?>