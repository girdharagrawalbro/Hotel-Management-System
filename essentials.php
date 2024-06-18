<?php
include 'database/config.php';
session_start();
// redirect function 
function redirect($url)
{
    echo "<script>window.location.href='$url';</script>";
}
// user_login check 
function userLogin()
{
    session_start();
    if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
    }
// admin_login check 
function adminLogin()
{
    // session_start();
    if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!= true){
        echo "<script>window.location.href='../index.php';</script>";
        exit();
    }
}
function alert($msg)
{
    echo "<script>alert('$msg')</script>";
}
?>
 <!-- not resubmit function -->
 <script>
    if(window.history.replaceState){
        window.history.replaceState(null,null, window.location.href);
    }
 </script>
